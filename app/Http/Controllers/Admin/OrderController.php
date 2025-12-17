<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\Coupon;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::query()
            ->with(['user:id,name,email'])
            ->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where('order_number', 'like', "%{$q}%");
        }

        $orders = $query->paginate(10)->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    public function create()
    {
        $users = User::query()->orderBy('name')->limit(200)->get(['id', 'name', 'email']);
        $products = Product::query()
            ->with('category:id,name')
            ->where('status', 'active')
            ->orderBy('title')
            ->get(['id', 'category_id', 'title', 'sku', 'price', 'sale_price']);

        return view('admin.orders.create', compact('users', 'products'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'status' => ['required', Rule::in(['pending', 'processing', 'shipped', 'completed', 'cancelled'])],
            'payment_status' => ['required', Rule::in(['unpaid', 'paid', 'refunded'])],
            'currency' => ['required', 'string', 'max:10'],
            'discount' => ['nullable', 'numeric', 'min:0'],
            'tax' => ['nullable', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string'],

            'items' => ['required', 'array', 'min:1'],
            'items.*.product_id' => ['required', 'exists:products,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'coupon_code' => ['nullable', 'string', 'max:50'],

        ]);

        DB::transaction(function () use ($data) {

            $order = Order::create([
                'user_id' => $data['user_id'],
                'order_number' => $this->generateOrderNumber(),
                'status' => $data['status'],
                'payment_status' => $data['payment_status'],
                'currency' => $data['currency'],
                'discount' => 0,
                'tax' => $data['tax'] ?? 0,
                'notes' => $data['notes'] ?? null,
                'subtotal' => 0,
                'total' => 0,
                'coupon_id' => null,
                'coupon_code' => null,
            ]);

            $subtotal = 0;

            foreach ($data['items'] as $row) {
                $product = Product::findOrFail($row['product_id']);
                $unit = $product->sale_price ?? $product->price;
                $qty = (int) $row['quantity'];

                $line = $unit * $qty;
                $subtotal += $line;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_title' => $product->title,
                    'product_sku' => $product->sku,
                    'quantity' => $qty,
                    'unit_price' => $unit,
                    'line_total' => $line,
                ]);
            }
            // ✅ COUPON APPLY
            $coupon = $this->resolveCoupon($data['coupon_code'] ?? null, $subtotal);
            $discount = $coupon ? $this->calculateDiscount($coupon, $subtotal) : 0;

            if ($coupon) {
                $order->coupon_id = $coupon->id;
                $order->coupon_code = $coupon->code;
            }

            $tax = (float)($order->tax ?? 0);
            $total = max(0, $subtotal - $discount + $tax);

            $order->update([
                'subtotal' => $subtotal,
                'discount' => $discount,
                'total' => $total,
                'coupon_id' => $order->coupon_id,
                'coupon_code' => $order->coupon_code,
            ]);
            $this->incrementCouponUsage($coupon);
        });

        toast_created('Order');
        return redirect()->route('admin.orders.index');
    }

    public function edit(Order $order)
    {
        $order->load(['items', 'user']);

        $users = User::query()->orderBy('name')->limit(200)->get(['id', 'name', 'email']);
        $products = Product::query()
            ->with('category:id,name')
            ->orderBy('title')
            ->get(['id', 'category_id', 'title', 'sku', 'price', 'sale_price']);

        return view('admin.orders.edit', compact('order', 'users', 'products'));
    }

    public function update(Request $request, Order $order)
    {
        $data = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'status' => ['required', Rule::in(['pending', 'processing', 'shipped', 'completed', 'cancelled'])],
            'payment_status' => ['required', Rule::in(['unpaid', 'paid', 'refunded'])],
            'currency' => ['required', 'string', 'max:10'],
            'discount' => ['nullable', 'numeric', 'min:0'],
            'tax' => ['nullable', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string'],

            'items' => ['required', 'array', 'min:1'],
            'items.*.product_id' => ['required', 'exists:products,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'coupon_code' => ['nullable', 'string', 'max:50'],

        ]);

        DB::transaction(function () use ($data, $order) {

            $oldCoupon = $order->coupon; // may be null

            $order->update([
                'user_id' => $data['user_id'],
                'status' => $data['status'],
                'payment_status' => $data['payment_status'],
                'currency' => $data['currency'],
                'tax' => $data['tax'] ?? 0,
                'notes' => $data['notes'] ?? null,
            ]);


            // reset items
            $order->items()->delete();

            $subtotal = 0;

            foreach ($data['items'] as $row) {
                $product = Product::findOrFail($row['product_id']);
                $unit = $product->sale_price ?? $product->price;
                $qty = (int) $row['quantity'];

                $line = $unit * $qty;
                $subtotal += $line;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_title' => $product->title,
                    'product_sku' => $product->sku,
                    'quantity' => $qty,
                    'unit_price' => $unit,
                    'line_total' => $line,
                ]);
            }
            $newCoupon = $this->resolveCoupon($data['coupon_code'] ?? null, $subtotal);

            // If coupon changed, fix used_count
            if (($oldCoupon?->id) !== ($newCoupon?->id)) {
                $this->decrementCouponUsage($oldCoupon);
                $this->incrementCouponUsage($newCoupon);
            }

            $discount = $newCoupon ? $this->calculateDiscount($newCoupon, $subtotal) : 0;

            $couponId = $newCoupon?->id;
            $couponCode = $newCoupon?->code;

            $tax = (float)($order->tax ?? 0);
            $total = max(0, $subtotal - $discount + $tax);

            $order->update([
                'subtotal' => $subtotal,
                'discount' => $discount,
                'total' => $total,
                'coupon_id' => $couponId,
                'coupon_code' => $couponCode,
            ]);
        });
        toast_updated('Order');
        return redirect()->route('admin.orders.index');
    }

    public function destroy(Order $order)
    {
        try {
            $order->delete();
            toast_deleted('Order');
        } catch (\Throwable $e) {
            toast_error('Order cannot be deleted right now.');
        }

        return back();
    }

    public function show(Order $order)
    {
        return redirect()->route('admin.orders.edit', $order);
    }

    private function generateOrderNumber(): string
    {
        return 'ORD-' . now()->format('Ymd') . '-' . Str::upper(Str::random(6));
    }

    private function resolveCoupon(?string $code, float $subtotal): ?Coupon
    {
        if (!$code) return null;

        $code = strtoupper(trim($code));

        $coupon = Coupon::query()
            ->where('code', $code)
            ->first();

        if (!$coupon) return null;

        // status + date window + usage checks
        if (!$coupon->isActiveNow()) return null;

        // min order rule
        if ($coupon->min_order_amount && $subtotal < (float)$coupon->min_order_amount) {
            return null;
        }

        return $coupon;
    }

    private function calculateDiscount(Coupon $coupon, float $subtotal): float
    {
        $discount = 0;

        if ($coupon->type === 'percent') {
            $percent = min(100, (float)$coupon->value);
            $discount = ($subtotal * $percent) / 100;
        } else {
            $discount = (float)$coupon->value;
        }

        // Max discount cap
        if ($coupon->max_discount_amount) {
            $discount = min($discount, (float)$coupon->max_discount_amount);
        }

        // Can't exceed subtotal
        $discount = min($discount, $subtotal);

        return round($discount, 2);
    }

    private function incrementCouponUsage(?Coupon $coupon): void
    {
        if (!$coupon) return;

        $coupon->increment('used_count');
    }

    private function decrementCouponUsage(?Coupon $coupon): void
    {
        if (!$coupon) return;

        if ($coupon->used_count > 0) {
            $coupon->decrement('used_count');
        }
    }
}
