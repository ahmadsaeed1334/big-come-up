@extends('layouts.user-side')

@section('content')
    <div class="hero-shell">
        @include('user-side.partials.navbar')
        <section class="page-hero space-bg">
            <div class="container">
                <div class="page-hero__inner text-center mx-auto">
                    {{-- breadcrumb pill --}}
                    <div class="crumb-pill mx-auto">
                        <span class="crumb-muted">Home</span>
                        <span class="crumb-dot">-</span>
                        <span class="crumb-strong">CheckOut</span>
                    </div>

                    <h1 class="page-hero__title">
                        Checkout Now
                    </h1>
                </div>
            </div>
        </section>
    </div>
    <section class="checkout-section py-5 bg-white">
        <div class="container">
            <div class="row g-4">

                {{-- LEFT SIDE --}}
                <div class="col-lg-8">

                    {{-- Product Summary --}}
                    <div class="checkout-card mb-4">
                        <div class="d-flex gap-3 align-items-center">
                            <img src="{{ asset('assets/images/product-1.jpg') }}" class="checkout-product-img"
                                alt="Product">
                            <div>
                                <h5 class="mb-1">Producer Beat Pack (20 Loops)</h5>
                                <p class="mb-0 text-muted">Price: $6,500</p>
                            </div>
                        </div>
                    </div>

                    {{-- Billing Address --}}
                    <div class="checkout-card mb-4">
                        <h5 class="checkout-title">Billing Address</h5>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <input type="text" class="form-control checkout-input" placeholder="Name">
                            </div>
                            <div class="col-md-6">
                                <input type="email" class="form-control checkout-input" placeholder="Email">
                            </div>

                            <div class="col-md-6">
                                <input type="text" class="form-control checkout-input" placeholder="Phone">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control checkout-input" placeholder="Zip">
                            </div>

                            <div class="col-md-6">
                                <input type="text" class="form-control checkout-input" placeholder="Company Name">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control checkout-input" placeholder="Country">
                            </div>

                            <div class="col-12">
                                <input type="text" class="form-control checkout-input" placeholder="Address">
                            </div>
                        </div>
                    </div>

                    {{-- Card Details --}}
                    <div class="checkout-card">
                        <h5 class="checkout-title">Card Details</h5>

                        <div class="row g-3">
                            <div class="col-12">
                                <input type="text" class="form-control checkout-input" placeholder="Name on Card">
                            </div>

                            <div class="col-md-6">
                                <input type="text" class="form-control checkout-input" placeholder="Card Number">
                            </div>

                            <div class="col-md-6">
                                <input type="text" class="form-control checkout-input" placeholder="MM/YY">
                            </div>

                            <div class="col-md-6">
                                <input type="text" class="form-control checkout-input" placeholder="CVV">
                            </div>

                            <div class="col-12">
                                <button class="btn checkout-pay-btn w-100">
                                    Pay Now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- RIGHT SIDE --}}
                <div class="col-lg-4">

                    <div class="checkout-card">
                        <h5 class="checkout-title">Choose Payment</h5>

                        <div class="payment-option active">
                            <input type="radio" checked>
                            <div>
                                <strong>Pay via credit card</strong>
                                <p>MasterCard, Maestro, Visa, Visa Electron, JCB and American Express</p>
                            </div>
                        </div>

                        <div class="payment-option">
                            <input type="radio">
                            <span>PayPal</span>
                        </div>

                        <div class="payment-option">
                            <input type="radio">
                            <span>Wire Pay</span>
                        </div>

                        <div class="payment-bg-white">
                            <div class="payment-logos mt-4">
                                <img src="{{ asset('assets/images/visa.png') }}">
                                <img src="{{ asset('assets/images/mastercard.png') }}">
                                <img src="{{ asset('assets/images/paypal.png') }}">
                                <img src="{{ asset('assets/images/stripe.png') }}">
                                <img src="{{ asset('assets/images/discover.png') }}">
                            </div>

                            <div class="secure-text mt-3">
                                Guaranteed safe checkout 🔒
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
@endsection
