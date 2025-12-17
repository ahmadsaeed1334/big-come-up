@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">Edit Order</h3>
            <small class="text-muted">{{ $order->order_number }}</small>
        </div>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">Back</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.orders.update', $order) }}">
                @csrf
                @method('PUT')

                <div class="row g-3 mb-4">
                    <div class="col-12 col-md-6">
                        <label class="form-label">User *</label>
                        <select name="user_id" class="form-select" required>
                            @foreach ($users as $u)
                                <option value="{{ $u->id }}" @selected(old('user_id', $order->user_id) == $u->id)>
                                    {{ $u->name }} ({{ $u->email }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-3">
                        <label class="form-label">Status *</label>
                        <select name="status" class="form-select" required>
                            @foreach (['pending', 'processing', 'shipped', 'completed', 'cancelled'] as $s)
                                <option value="{{ $s }}" @selected(old('status', $order->status) === $s)>{{ ucfirst($s) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-3">
                        <label class="form-label">Payment *</label>
                        <select name="payment_status" class="form-select" required>
                            @foreach (['unpaid', 'paid', 'refunded'] as $s)
                                <option value="{{ $s }}" @selected(old('payment_status', $order->payment_status) === $s)>{{ ucfirst($s) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-2">
                        <label class="form-label">Currency</label>
                        <input type="text" name="currency" class="form-control"
                            value="{{ old('currency', $order->currency) }}">
                    </div>

                    <div class="col-12 col-md-2">
                        <label class="form-label">Discount</label>
                        <input type="number" step="0.01" min="0" name="discount" class="form-control"
                            value="{{ old('discount', $order->discount) }}">
                    </div>

                    <div class="col-12 col-md-2">
                        <label class="form-label">Tax</label>
                        <input type="number" step="0.01" min="0" name="tax" class="form-control"
                            value="{{ old('tax', $order->tax) }}">
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="form-label">Coupon Code</label>
                        <input type="text" name="coupon_code" class="form-control"
                            value="{{ old('coupon_code', $order->coupon_code) }}" placeholder="e.g. SAVE10">
                        @if ($order->coupon_code)
                            <div class="form-text">
                                Applied: <code>{{ $order->coupon_code }}</code>
                            </div>
                        @endif
                    </div>

                    <div class="col-12">
                        <label class="form-label">Notes</label>
                        <textarea name="notes" class="form-control" rows="2">{{ old('notes', $order->notes) }}</textarea>
                    </div>
                </div>

                <h5 class="mb-2">Order Items *</h5>
                <div class="table-responsive">
                    <table class="table table-bordered align-middle" id="itemsTable">
                        <thead class="table-light">
                            <tr>
                                <th>Product</th>
                                <th style="width:120px;">Qty</th>
                                <th style="width:120px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (old(
            'items',
            $order->items->map(
                    fn($i) => [
                        'product_id' => $i->product_id,
                        'quantity' => $i->quantity,
                    ],
                )->toArray(),
        ) as $idx => $row)
                                <tr>
                                    <td>
                                        <select name="items[{{ $idx }}][product_id]" class="form-select" required>
                                            <option value="">Select Product</option>
                                            @foreach ($products as $p)
                                                <option value="{{ $p->id }}" @selected(($row['product_id'] ?? null) == $p->id)>
                                                    {{ $p->title }} @if ($p->category)
                                                        ({{ $p->category->name }})
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" min="1" name="items[{{ $idx }}][quantity]"
                                            class="form-control" value="{{ $row['quantity'] ?? 1 }}" required>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-outline-danger btn-sm removeRow">
                                            Remove
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <button type="button" id="addRow" class="btn btn-outline-dark btn-sm">
                    + Add Item
                </button>

                <div class="mt-4 d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-light">Cancel</a>
                    <button class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tableBody = document.querySelector('#itemsTable tbody');
            const addBtn = document.getElementById('addRow');
            const productOptions = @json(
                $products->map(fn($p) => [
                        'id' => $p->id,
                        'label' => $p->title . ($p->category ? ' (' . $p->category->name . ')' : ''),
                    ]));

            const makeSelect = (index) => {
                const select = document.createElement('select');
                select.name = `items[${index}][product_id]`;
                select.className = 'form-select';
                select.required = true;

                const opt0 = document.createElement('option');
                opt0.value = '';
                opt0.textContent = 'Select Product';
                select.appendChild(opt0);

                productOptions.forEach(p => {
                    const o = document.createElement('option');
                    o.value = p.id;
                    o.textContent = p.label;
                    select.appendChild(o);
                });

                return select;
            };

            const addRow = () => {
                const index = tableBody.querySelectorAll('tr').length;

                const tr = document.createElement('tr');

                const td1 = document.createElement('td');
                td1.appendChild(makeSelect(index));

                const td2 = document.createElement('td');
                td2.innerHTML =
                    `<input type="number" min="1" name="items[${index}][quantity]" class="form-control" value="1" required>`;

                const td3 = document.createElement('td');
                td3.innerHTML =
                    `<button type="button" class="btn btn-outline-danger btn-sm removeRow">Remove</button>`;

                tr.appendChild(td1);
                tr.appendChild(td2);
                tr.appendChild(td3);
                tableBody.appendChild(tr);

                refreshRemoveButtons();
            };

            const refreshRemoveButtons = () => {
                const rows = tableBody.querySelectorAll('tr');
                rows.forEach((row) => {
                    const btn = row.querySelector('.removeRow');
                    if (!btn) return;
                    btn.disabled = rows.length === 1;
                });
            };

            addBtn.addEventListener('click', addRow);

            tableBody.addEventListener('click', (e) => {
                if (!e.target.classList.contains('removeRow')) return;
                e.target.closest('tr').remove();
                refreshRemoveButtons();
            });

            refreshRemoveButtons();
        });
    </script>
@endsection
