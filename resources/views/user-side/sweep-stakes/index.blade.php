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
                        <span class="crumb-strong">Sweepstakes</span>
                    </div>

                    <h1 class="page-hero__title">
                        Ready to Win Big?
                    </h1>

                    <p class="page-hero__desc">
                        Enter our official sweepstakes and stand a chance to win exciting rewards.
                    </p>
                    <div class="d-flex justify-content-center gap-3 flex-wrap mt-4">
                        <a href="#" class="btn btn-cta-amber">
                            <span class="btn-text">Enter Now</span>
                            <span class="btn-arrow">→</span>
                        </a>

                        <a href="#" class="btn btn-cta-outline">
                            <span class="btn-text">View Winners</span>
                            <span class="btn-arrow">→</span>
                        </a>
                    </div>
                </div>
            </div>

        </section>
    </div>
    <section class="howitworks py-5 py-lg-6 bg-white">
        <div class="container">
            <h2 class="how-title text-center mb-5">How It Works</h2>
            <div class="row g-4 g-lg-0 how-row align-items-stretch">
                {{-- Card 1 --}}
                <div class="col-12 col-lg-4 how-col">
                    <div class="how-card text-center h-100">
                        <div class="how-badge mx-auto mb-4">01</div>

                        <h5 class="how-heading mb-2">Submit Your Performance</h5>
                        <p class="how-text mb-0">
                            Upload your YouTube, TikTok, or Instagram link. Our AI extracts your BPM, mood, and genre
                            automatically.
                        </p>
                    </div>
                </div>
                {{-- Card 2 --}}
                <div class="col-12 col-lg-4 how-col how-divider">
                    <div class="how-card text-center h-100">
                        <div class="how-badge mx-auto mb-4">02</div>

                        <h5 class="how-heading mb-2">Get Votes &amp; Judge Scores</h5>
                        <p class="how-text mb-0">
                            Fans vote globally. Judges score using a fair &amp; transparent scoring system enhanced with AI
                            assistance.
                        </p>
                    </div>
                </div>

                {{-- Card 3 --}}
                <div class="col-12 col-lg-4 how-col how-divider">
                    <div class="how-card text-center h-100">
                        <div class="how-badge mx-auto mb-4">03</div>

                        <h5 class="how-heading mb-2">Win Prizes &amp; Get Exposure</h5>
                        <p class="how-text mb-0">
                            Top performers earn rewards, visibility, global recognition, and potential brand/sponsor
                            outreach.
                        </p>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <a href="#" class="btn how-cta">
                    Submit Your Entry
                    <span class="how-cta-arrow" aria-hidden="true">→</span>
                </a>
            </div>
        </div>
    </section>
    <section class="luck-cta-section">
        <div class="luck-overlay"></div>

        <div class="container h-100">
            <div class="row align-items-center h-100">
                <div class="col-12 col-lg-6">
                    <h2 class="luck-title">Ready to try your luck?</h2>
                    <p class="luck-text">
                        Enter now for your shot at amazing prizes.
                    </p>

                    <a href="#" class="btn btn-luck">
                        Enter Now <span class="ms-2">→</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="submit-entry-section">
        <div class="container">
            <h2 class="submit-entry-title text-center mb-4">
                Submit Your Entry
            </h2>

            <div class="submit-entry-card mx-auto">
                <form>
                    <div class="row g-4">
                        <div class="col-12 col-lg-6">
                            <input type="text" class="form-control submit-input" placeholder="First Name*" required>
                        </div>

                        <div class="col-12 col-lg-6">
                            <input type="text" class="form-control submit-input" placeholder="Last Name*" required>
                        </div>

                        <div class="col-12 col-lg-6">
                            <input type="text" class="form-control submit-input" placeholder="Country*" required>
                        </div>

                        <div class="col-12 col-lg-6">
                            <input type="email" class="form-control submit-input" placeholder="Email*" required>
                        </div>

                        <div class="col-12">
                            <div class="form-check submit-check">
                                <input class="form-check-input" type="checkbox" id="agreeRules" required>
                                <label class="form-check-label" for="agreeRules">
                                    Agree to Rules
                                </label>
                            </div>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn submit-entry-btn w-100">
                                Submit To On Blast →
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
