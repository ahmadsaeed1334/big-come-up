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
                        <span class="crumb-strong">Card</span>
                    </div>

                    <h1 class="page-hero__title">
                        My Card
                    </h1>
                </div>
            </div>
        </section>
    </div>
    <section class="cart-section py-5 bg-white">
        <div class="container">

            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="cart-title mb-0">Your cart</h2>
                <a href="#" class="cart-continue">Continue Shopping</a>
            </div>

            <!-- Cart Table -->
            <div class="cart-table">
                <div class="cart-table-header">
                    <span>Product</span>
                    <span>Price</span>
                    <span>Quantity</span>
                </div>

                <!-- Cart Item -->
                <div class="cart-item">
                    <div class="cart-product">
                        <img src="{{ asset('assets/images/product-1.jpg') }}" alt="Product">
                        <div>
                            <h5>Producer Beat Pack (20 Loops)</h5>
                            <small>Price: $6,500</small>
                        </div>
                    </div>

                    <div class="cart-price">$113.75</div>

                    <div class="cart-qty">
                        <button>-</button>
                        <span>1</span>
                        <button>+</button>
                    </div>
                </div>

                <!-- Cart Item -->
                <div class="cart-item">
                    <div class="cart-product">
                        <img src="{{ asset('assets/images/product-1.jpg') }}" alt="Product">
                        <div>
                            <h5>1 gram Gold Bar - Brand Varies</h5>
                            <small>Price: $6,500</small>
                        </div>
                    </div>

                    <div class="cart-price">$113.75</div>

                    <div class="cart-qty">
                        <button>-</button>
                        <span>1</span>
                        <button>+</button>
                    </div>
                </div>
            </div>

            <!-- Summary -->
            <div class="cart-summary ms-auto mt-4">
                <div class="summary-row">
                    <span>Subtotal:</span>
                    <span>$136.99</span>
                </div>

                <div class="summary-row">
                    <span>Shipping:</span>
                    <span class="text-muted">Enter your address to view shipping options.</span>
                </div>

                <div class="summary-row total">
                    <span>Total:</span>
                    <span>$136.99</span>
                </div>

                <a href="#" class="btn cart-checkout-btn mt-4">
                    Proceed To Checkout →
                </a>
            </div>

        </div>
    </section>
@endsection
