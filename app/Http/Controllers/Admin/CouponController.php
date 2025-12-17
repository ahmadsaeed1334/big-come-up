<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CouponController extends Controller
{
    public function index(Request $request)
    {
        $query = Coupon::query()->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('code', 'like', "%{$q}%");
            });
        }

        $coupons = $query->paginate(10)->withQueryString();

        return view('admin.coupons.index', compact('coupons'));
    }

    public function create()
    {
        return view('admin.coupons.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['nullable', 'string', 'max:50', 'unique:coupons,code'],
            'type' => ['required', Rule::in(['percent', 'fixed'])],
            'value' => ['required', 'numeric', 'min:0'],

            'min_order_amount' => ['nullable', 'numeric', 'min:0'],
            'max_discount_amount' => ['nullable', 'numeric', 'min:0'],

            'usage_limit' => ['nullable', 'integer', 'min:1'],

            'starts_at' => ['nullable', 'date'],
            'expires_at' => ['nullable', 'date', 'after_or_equal:starts_at'],

            'status' => ['required', Rule::in(['active', 'inactive'])],
            'notes' => ['nullable', 'string'],
        ]);

        // Auto code generate if empty
        $data['code'] = $data['code']
            ? strtoupper($data['code'])
            : $this->generateCode($data['name']);

        // Ensure unique code
        $data['code'] = $this->uniqueCode($data['code']);

        // percent sanity clamp (optional)
        if ($data['type'] === 'percent' && $data['value'] > 100) {
            $data['value'] = 100;
        }

        $data['used_count'] = 0;

        Coupon::create($data);

        toast_created('Coupon');
        return redirect()->route('admin.coupons.index');
    }

    public function edit(Coupon $coupon)
    {
        return view('admin.coupons.edit', compact('coupon'));
    }

    public function update(Request $request, Coupon $coupon)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => [
                'nullable',
                'string',
                'max:50',
                Rule::unique('coupons', 'code')->ignore($coupon->id),
            ],
            'type' => ['required', Rule::in(['percent', 'fixed'])],
            'value' => ['required', 'numeric', 'min:0'],

            'min_order_amount' => ['nullable', 'numeric', 'min:0'],
            'max_discount_amount' => ['nullable', 'numeric', 'min:0'],

            'usage_limit' => ['nullable', 'integer', 'min:1'],

            'starts_at' => ['nullable', 'date'],
            'expires_at' => ['nullable', 'date', 'after_or_equal:starts_at'],

            'status' => ['required', Rule::in(['active', 'inactive'])],
            'notes' => ['nullable', 'string'],
        ]);

        // If code empty, regenerate from name
        $code = $data['code']
            ? strtoupper($data['code'])
            : $this->generateCode($data['name']);

        if ($code !== $coupon->code) {
            $code = $this->uniqueCode($code, $coupon->id);
        }

        $data['code'] = $code;

        if ($data['type'] === 'percent' && $data['value'] > 100) {
            $data['value'] = 100;
        }

        $coupon->update($data);

        toast_updated('Coupon');
        return redirect()->route('admin.coupons.index');
    }

    public function destroy(Coupon $coupon)
    {
        try {
            $coupon->delete();
            toast_deleted('Coupon');
        } catch (\Throwable $e) {
            toast_error('Coupon cannot be deleted right now.');
        }

        return back();
    }

    public function show(Coupon $coupon)
    {
        return redirect()->route('admin.coupons.edit', $coupon);
    }

    private function generateCode(string $name): string
    {
        $base = Str::upper(Str::slug($name, ''));
        $base = substr($base, 0, 8);

        if (strlen($base) < 4) {
            $base = 'COUPON';
        }

        return $base . '-' . Str::upper(Str::random(4));
    }

    private function uniqueCode(string $baseCode, ?int $ignoreId = null): string
    {
        $code = $baseCode;
        $i = 1;

        while (
            Coupon::query()
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->where('code', $code)
            ->exists()
        ) {
            $code = $baseCode . '-' . $i;
            $i++;
        }

        return $code;
    }
}
