@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">Create Coupon</h3>
            <small class="text-muted">Add new discount code</small>
        </div>
        <a href="{{ route('admin.coupons.index') }}" class="btn btn-outline-secondary">Back</a>
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
            <form method="POST" action="{{ route('admin.coupons.store') }}">
                @csrf

                <div class="row g-3">

                    <div class="col-12 col-md-6">
                        <label class="form-label">Name *</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}"
                            required>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Code (optional)</label>
                        <input type="text" name="code" id="code" class="form-control" value="{{ old('code') }}"
                            placeholder="Auto-generate">
                        <div class="form-text">Empty choro to system auto code bana dega.</div>
                    </div>

                    <div class="col-12 col-md-3">
                        <label class="form-label">Type *</label>
                        <select name="type" id="type" class="form-select" required>
                            <option value="percent" @selected(old('type', 'percent') === 'percent')>Percent</option>
                            <option value="fixed" @selected(old('type') === 'fixed')>Fixed</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-3">
                        <label class="form-label">Value *</label>
                        <input type="number" step="0.01" min="0" name="value" id="value"
                            class="form-control" value="{{ old('value', 0) }}" required>
                        <div class="form-text" id="valueHint">Percent (0 - 100)</div>
                    </div>

                    <div class="col-12 col-md-3">
                        <label class="form-label">Min Order</label>
                        <input type="number" step="0.01" min="0" name="min_order_amount" class="form-control"
                            value="{{ old('min_order_amount') }}">
                    </div>

                    <div class="col-12 col-md-3">
                        <label class="form-label">Max Discount</label>
                        <input type="number" step="0.01" min="0" name="max_discount_amount" class="form-control"
                            value="{{ old('max_discount_amount') }}">
                    </div>

                    <div class="col-12 col-md-4">
                        <label class="form-label">Usage Limit</label>
                        <input type="number" min="1" name="usage_limit" class="form-control"
                            value="{{ old('usage_limit') }}" placeholder="Unlimited if empty">
                    </div>

                    <div class="col-12 col-md-4">
                        <label class="form-label">Starts At</label>
                        <input type="datetime-local" name="starts_at" class="form-control" value="{{ old('starts_at') }}">
                    </div>

                    <div class="col-12 col-md-4">
                        <label class="form-label">Expires At</label>
                        <input type="datetime-local" name="expires_at" class="form-control"
                            value="{{ old('expires_at') }}">
                    </div>

                    <div class="col-12 col-md-4">
                        <label class="form-label">Status *</label>
                        <select name="status" class="form-select" required>
                            <option value="active" @selected(old('status', 'active') === 'active')>Active</option>
                            <option value="inactive" @selected(old('status') === 'inactive')>Inactive</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Notes</label>
                        <textarea name="notes" class="form-control" rows="3">{{ old('notes') }}</textarea>
                    </div>

                </div>

                <div class="mt-4 d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.coupons.index') }}" class="btn btn-light">Cancel</a>
                    <button class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const type = document.getElementById('type');
            const hint = document.getElementById('valueHint');

            const toggleHint = () => {
                hint.textContent = type.value === 'percent' ?
                    'Percent (0 - 100)' :
                    'Fixed amount (currency)';
            };

            type.addEventListener('change', toggleHint);
            toggleHint();
        });
    </script>
@endsection
