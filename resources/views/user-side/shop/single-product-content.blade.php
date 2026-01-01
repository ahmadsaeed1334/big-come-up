@extends('layouts.user-side')

@section('content')
    @include('user-side.partials.navbar')
    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <a href="#">Home</a> / <a href="#">Shop</a> / <a href="#">Featured & Trending</a> / <span>Producer
            Zion — Afro House Beat Pack Vol. 1</span>

    </div>
    <section class="product-preview-section py-5 bg-white">
        <div class="container">
            <div class="row g-5 align-items-stretch">


                {{-- LEFT: PREVIEW BEATS --}}
                <div class="col-lg-7">

                    @for ($i = 1; $i <= 2; $i++)
                        <div class="beat-preview-card mb-4">

                            {{-- TOP --}}
                            <div class="beat-top">
                                <span class="beat-time">
                                    ⏱ 3:00
                                </span>

                                <h4 class="beat-title">
                                    Afro Groove 101
                                </h4>

                                <p class="beat-desc">
                                    A warm afro-rhythm groove with energetic drums and smooth melodies....
                                </p>
                            </div>

                            <hr class="beat-divider">

                            {{-- BOTTOM --}}
                            <div class="beat-bottom">
                                <button class="beat-play-btn">
                                    ▶
                                </button>

                                <div class="beat-waveform"></div>
                            </div>

                        </div>
                    @endfor

                    <button class="btn preview-btn w-100 mt-3">
                        Preview Beats
                    </button>

                </div>


                {{-- RIGHT: PRODUCT INFO --}}
                <div class="col-lg-5 d-flex">
                    <div class="product-info-card w-100">

                        <h2 class="product-title">
                            Producer Zion — Afro House Beat Pack Vol. 1
                        </h2>

                        <div class="product-status mb-2">
                            <span class="status-dot"></span>
                            Available for Download
                        </div>

                        <a href="#" class="wishlist-link mb-3 d-inline-block">
                            ♡ Add to Wish List
                        </a>

                        <div class="product-meta mb-4">
                            <strong>Format:</strong> WAV / MP3
                        </div>

                        <div class="d-flex gap-3 mb-3">
                            <button class="btn add-to-cart-btn w-50">
                                🛒 Add to Cart
                            </button>
                            <button class="btn buy-now-btn w-50">
                                Buy Now
                            </button>
                        </div>

                        <div class="artist-support-note mb-4">
                            ❤️ A portion of every purchase goes directly to the artist.
                        </div>

                        <div class="payment-method mt-auto">
                            <div class="mb-2">Payment method</div>
                            <div class="payment-icons">
                                <img src="{{ asset('assets/images/visa.png') }}">
                                <img src="{{ asset('assets/images/mastercard.png') }}">
                                <img src="{{ asset('assets/images/paypal.png') }}">
                                <img src="{{ asset('assets/images/stripe.png') }}">
                                <img src="{{ asset('assets/images/discover.png') }}">
                                <a href="#">Learn more</a>
                            </div>
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </section>
    {{-- PRODUCT EXTRA DETAILS --}}
    <section class="product-extra-section py-5 bg-white">
        <div class="container">

            {{-- TABS --}}
            <ul class="nav product-tabs mb-4" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#pack-info">
                        About This Beat Pack
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#artist-info">
                        About The Artist
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#download-info">
                        Download & Delivery Notes
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#review-info">
                        Reviews
                    </button>
                </li>
            </ul>


            {{-- TAB CONTENT --}}
            <div class="tab-content">

                <!-- TAB 1 -->
                <div class="tab-pane fade show active" id="pack-info">
                    <p>
                        This Afro House Beat Pack includes industry-quality, production-ready beats crafted for creators,
                        DJs, performers, and music producers.
                    </p>

                    <h6 class="fw-bold mt-4">What’s Included</h6>
                    <ul class="content-list">
                        <li>10 Full Beats</li>
                        <li>High-quality WAV Files</li>
                        <li>Mastered & Ready</li>
                        <li>Stems Available (Optional)</li>
                        <li>Instant Download After Purchase</li>
                    </ul>
                </div>

                <!-- TAB 2 -->
                <div class="tab-pane fade" id="artist-info">
                    <p>
                        Producer Zion is an Afro House producer known for deep grooves,
                        rhythmic percussion, and club-ready energy.
                    </p>
                </div>

                <!-- TAB 3 -->
                <div class="tab-pane fade" id="download-info">
                    <ul class="content-list">
                        <li>Instant digital download</li>
                        <li>No physical shipping</li>
                        <li>Accessible via account dashboard</li>
                        <li>Lifetime access</li>
                    </ul>
                </div>

                <!-- TAB 4 -->
                <div class="tab-pane fade" id="review-info">
                    <p class="text-muted">No reviews yet. Be the first to review.</p>
                </div>

            </div>


            {{-- LICENSE CARDS --}}
            <div class="row g-4 mt-5">

                <div class="col-lg-6">
                    <div class="license-card license-standard">
                        <div class="license-content">
                            <h4>Standard License</h4>
                            <p>Use Type: Personal / Non-Commercial</p>
                            <ul>
                                <li>Social media content</li>
                                <li>DJ practice</li>
                                <li>Demo projects</li>
                            </ul>
                        </div>

                        <div class="license-action">
                            <div class="license-price">Price: $39</div>
                            <button class="license-btn">Buy License Now →</button>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="license-card license-extended">
                        <div class="license-content">
                            <h4>Extended License</h4>
                            <p>Use Type: Commercial Allowed</p>
                            <ul>
                                <li>Streaming platforms</li>
                                <li>Monetized content</li>
                                <li>Live performances</li>
                                <li>Commercial projects</li>
                            </ul>
                        </div>

                        <div class="license-action">
                            <div class="license-price">Price: $99</div>
                            <button class="license-btn">Buy License Now →</button>
                        </div>
                    </div>
                </div>

            </div>


            <div class="text-center mt-4">
                <a href="#" class="btn view-license-btn">
                    View Full Licensing Terms →
                </a>
            </div>

        </div>
    </section>
@endsection
