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
                        <span class="crumb-strong">Radio</span>
                    </div>

                    <h1 class="page-hero__title">
                        The Big Come Up Radio
                    </h1>

                    <p class="page-hero__desc">
                        24/7 entertainment — live mixes, artist shows, conversations, and community energy.
                    </p>
                    <div class="d-flex justify-content-center gap-3 flex-wrap mt-4">
                        <a href="#" class="btn btn-cta-amber">
                            <span class="btn-text">Listen Live</span>
                            <span class="btn-arrow">→</span>
                        </a>

                        <a href="#" class="btn btn-cta-outline">
                            <span class="btn-text">View Radio Schedule</span>
                            <span class="btn-arrow">→</span>
                        </a>
                    </div>
                </div>
            </div>

        </section>
    </div>
    <section class="radio-live-section py-5 bg-white">
        <div class="container">

            {{-- NOW LIVE --}}
            <div class="radio-show-card">
                <!-- Thumbnail -->
                <div class="radio-show-thumb">
                    <img src="{{ asset('assets/images/dj-nova.jpg') }}" alt="DJ Nova">
                </div>

                <!-- Content -->
                <div class="radio-show-content">
                    <!-- Top Row -->
                    <div class="radio-show-header">
                        <div>
                            <span class="radio-live-dot">● LIVE</span>
                            <h4 class="radio-show-title">DJ Nova – The Late Night Set</h4>
                            <span class="radio-show-desc">
                                A high-energy blend of beats, music, and live audience vibes — the perfect late-night
                                experience.
                            </span>
                        </div>
                        <span class="radio-show-duration">45 mins</span>
                    </div>

                    <!-- Waveform -->
                    <div class="radio-show-wave">
                        <button class="radio-play-btn">
                            ▶
                        </button>
                        <div class="radio-waveform"></div>
                    </div>

                    <!-- Footer -->
                    <div class="radio-show-footer">
                        <span class="radio-listening">
                            2,300+ Listening Now
                        </span>

                        <div class="radio-actions">
                            <a href="#" class="radio-play-link">
                                Play Now →
                            </a>
                            <a href="#" class="btn radio-follow-btn">
                                Follow Host
                            </a>
                        </div>
                    </div>
                </div>
            </div>


            {{-- UP NEXT --}}
            <h2 class="radio-up-next-heading text-center mb-4">Up Next</h2>

            @for ($i = 0; $i < 3; $i++)
                <div class="radio-show-card up-next">
                    <div class="radio-show-thumb">
                        <img src="{{ asset('assets/images/dj-nova.jpg') }}">
                    </div>

                    <div class="radio-show-content">
                        <div class="radio-show-header">
                            <div>
                                <small class="text-muted">Starts in: 1 Hour</small>
                                <h4 class="radio-show-title">DJ Nova – The Late Night Set</h4>
                                <span class="radio-show-desc">
                                    A high-energy blend of beats, music, and live audience vibes — the perfect late-night
                                    experience.
                                </span>
                            </div>
                            <span class="radio-show-duration">45 mins</span>
                        </div>

                        <div class="radio-show-wave">
                            <button class="radio-play-btn">▶</button>
                            <div class="radio-waveform"></div>
                        </div>

                        <div class="radio-show-footer">
                            <span class="radio-listening text-muted">– Listening Now</span>
                            <a href="#" class="btn radio-follow-btn">Follow Host</a>
                        </div>
                    </div>
                </div>
            @endfor

            <div class="text-center mt-4">
                <a href="#" class="btn btn-cta-amber">
                    View Full Schedule →
                </a>
            </div>
        </div>
    </section>
@endsection
