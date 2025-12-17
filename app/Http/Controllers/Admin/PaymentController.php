<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::query()
            ->with([
                'order:id,order_number,total,currency,payment_status',
                'user:id,name,email',
            ])
            ->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('method')) {
            $query->where('method', $request->method);
        }

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('payment_number', 'like', "%{$q}%")
                    ->orWhere('transaction_id', 'like', "%{$q}%");
            });
        }

        $payments = $query->paginate(10)->withQueryString();

        return view('admin.payments.index', compact('payments'));
    }

    public function create()
    {
        $orders = Order::query()
            ->with('user:id,name,email')
            ->latest()
            ->limit(200)
            ->get();

        $users = User::query()->orderBy('name')->limit(200)->get(['id', 'name', 'email']);

        return view('admin.payments.create', compact('orders', 'users'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'order_id' => ['required', 'exists:orders,id'],
            'user_id' => ['required', 'exists:users,id'],

            'amount' => ['required', 'numeric', 'min:0'],
            'currency' => ['required', 'string', 'max:10'],

            'method' => ['required', Rule::in(['card', 'bank', 'paypal', 'stripe', 'cash', 'other'])],
            'status' => ['required', Rule::in(['pending', 'paid', 'failed', 'refunded'])],

            'provider' => ['nullable', 'string', 'max:255'],
            'transaction_id' => ['nullable', 'string', 'max:255', 'unique:payments,transaction_id'],

            'notes' => ['nullable', 'string'],
        ]);

        DB::transaction(function () use ($data) {
            $payment = Payment::create([
                ...$data,
                'payment_number' => $this->generatePaymentNumber(),
            ]);

            $this->syncOrderPaymentStatus($payment);
        });

        toast_created('Payment');

        return redirect()->route('admin.payments.index');
    }

    public function edit(Payment $payment)
    {
        $payment->load(['order', 'user']);

        $orders = Order::query()
            ->with('user:id,name,email')
            ->latest()
            ->limit(200)
            ->get();

        $users = User::query()->orderBy('name')->limit(200)->get(['id', 'name', 'email']);

        return view('admin.payments.edit', compact('payment', 'orders', 'users'));
    }

    public function update(Request $request, Payment $payment)
    {
        $data = $request->validate([
            'order_id' => ['required', 'exists:orders,id'],
            'user_id' => ['required', 'exists:users,id'],

            'amount' => ['required', 'numeric', 'min:0'],
            'currency' => ['required', 'string', 'max:10'],

            'method' => ['required', Rule::in(['card', 'bank', 'paypal', 'stripe', 'cash', 'other'])],
            'status' => ['required', Rule::in(['pending', 'paid', 'failed', 'refunded'])],

            'provider' => ['nullable', 'string', 'max:255'],
            'transaction_id' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('payments', 'transaction_id')->ignore($payment->id),
            ],

            'notes' => ['nullable', 'string'],
        ]);

        DB::transaction(function () use ($data, $payment) {
            $payment->update($data);

            $this->syncOrderPaymentStatus($payment);
        });

        toast_updated('Payment');

        return redirect()->route('admin.payments.index');
    }

    public function destroy(Payment $payment)
    {
        try {
            $payment->delete();
            toast_deleted('Payment');
        } catch (\Throwable $e) {
            toast_error('Payment cannot be deleted right now.');
        }

        return back();
    }

    public function show(Payment $payment)
    {
        return redirect()->route('admin.payments.edit', $payment);
    }

    private function generatePaymentNumber(): string
    {
        return 'PAY-' . now()->format('Ymd') . '-' . Str::upper(Str::random(6));
    }

    private function syncOrderPaymentStatus(Payment $payment): void
    {
        $order = $payment->order;
        if (!$order) return;

        if ($payment->status === 'paid') {
            $order->update(['payment_status' => 'paid']);
        } elseif ($payment->status === 'refunded') {
            $order->update(['payment_status' => 'refunded']);
        } elseif ($payment->status === 'failed') {
            $order->update(['payment_status' => 'unpaid']);
        }
        // pending -> no forced change
    }
}
