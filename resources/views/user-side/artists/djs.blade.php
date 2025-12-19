@extends('layouts.user-side')

@section('content')
    {{-- ===== HERO (dots + wave) ===== --}}
    <div class="dj-hero-shell">
        {{-- navbar include (dropdown baad me) --}}
        @include('user-side.partials.navbar')

        <section class="dj-hero">
            <div class="container">
                <div class="text-center">
                    <div class="crumb-pill mx-auto mb-3">
                        Home - Artists - <strong>DJs</strong>
                    </div>

                    <h1 class="dj-hero-title mb-3">Discover All DJs</h1>

                    <p class="dj-hero-subtitle mx-auto">
                        Explore DJs spinning beats across EDM, Hip-Hop, House,<br class="d-none d-md-block">
                        Afrobeat, and more.
                    </p>
                    <!-- WAVE (buttons ke niche) -->
                    <div class="hero-wave-wrap mt-4">
                        <img src="{{ asset('assets/images/wave.png') }}" class="hero-wave" alt="wave">
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{-- ===== LISTING (cards grid) ===== --}}
    <section class="dj-listing">
        <div class="container">
            <div class="row g-4">
                {{-- CARD 1 --}}
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="spot-card h-100">
                        <div class="spot-cover">
                            <img src="{{ asset('assets/images/trend1.png') }}" alt="cover" class="w-100">
                        </div>

                        <div class="spot-body">
                            <div class="spot-avatar">
                                <img src="{{ asset('assets/images/profile1.jpg') }}" alt="avatar">
                            </div>

                            <div class="spot-followers">128,400 Followers</div>

                            <h5 class="spot-name">DJ Solaris - DJ</h5>

                            <div class="spot-loc">
                                <i class="bi bi-geo-alt"></i> London, United Kingdom
                            </div>

                            <div class="spot-tags">
                                <span class="tag-pill">EDM</span>
                                <span class="tag-pill">Hip-Hop</span>
                                <span class="tag-pill">House</span>
                            </div>

                            <a href="#" class="spot-btn">View Profile</a>
                        </div>
                    </div>
                </div>

                {{-- CARD 2 --}}
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="spot-card h-100">
                        <div class="spot-cover">
                            <img src="{{ asset('assets/images/trend1.png') }}" alt="cover" class="w-100">
                        </div>

                        <div class="spot-body">
                            <div class="spot-avatar">
                                <img src="{{ asset('assets/images/profile1.jpg') }}" alt="avatar">
                            </div>

                            <div class="spot-followers">128,400 Followers</div>

                            <h5 class="spot-name">Maya Vibe - DJ</h5>

                            <div class="spot-loc">
                                <i class="bi bi-geo-alt"></i> London, United Kingdom
                            </div>

                            <div class="spot-tags">
                                <span class="tag-pill">EDM</span>
                                <span class="tag-pill">Hip-Hop</span>
                                <span class="tag-pill">House</span>
                            </div>

                            <a href="#" class="spot-btn">View Profile</a>
                        </div>
                    </div>
                </div>

                {{-- CARD 3 --}}
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="spot-card h-100">
                        <div class="spot-cover">
                            <img src="{{ asset('assets/images/trend1.png') }}" alt="cover" class="w-100">
                        </div>

                        <div class="spot-body">
                            <div class="spot-avatar">
                                <img src="{{ asset('assets/images/profile1.jpg') }}" alt="avatar">
                            </div>

                            <div class="spot-followers">128,400 Followers</div>

                            <h5 class="spot-name">Kaito Drift - DJ</h5>

                            <div class="spot-loc">
                                <i class="bi bi-geo-alt"></i> London, United Kingdom
                            </div>

                            <div class="spot-tags">
                                <span class="tag-pill">EDM</span>
                                <span class="tag-pill">Hip-Hop</span>
                                <span class="tag-pill">House</span>
                            </div>

                            <a href="#" class="spot-btn">View Profile</a>
                        </div>
                    </div>
                </div>

                {{-- CARD 4 --}}
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="spot-card h-100">
                        <div class="spot-cover">
                            <img src="{{ asset('assets/images/trend1.png') }}" alt="cover" class="w-100">
                        </div>

                        <div class="spot-body">
                            <div class="spot-avatar">
                                <img src="{{ asset('assets/images/profile1.jpg') }}" alt="avatar">
                            </div>

                            <div class="spot-followers">128,400 Followers</div>

                            <h5 class="spot-name">Luna Flux - DJ</h5>

                            <div class="spot-loc">
                                <i class="bi bi-geo-alt"></i> London, United Kingdom
                            </div>

                            <div class="spot-tags">
                                <span class="tag-pill">EDM</span>
                                <span class="tag-pill">Hip-Hop</span>
                                <span class="tag-pill">House</span>
                            </div>

                            <a href="#" class="spot-btn">View Profile</a>
                        </div>
                    </div>
                </div>

                {{-- Second row (same cards duplicate for UI) --}}
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="spot-card h-100">
                        <div class="spot-cover">
                            <img src="{{ asset('assets/images/trend1.png') }}" alt="cover" class="w-100">
                        </div>
                        <div class="spot-body">
                            <div class="spot-avatar">
                                <img src="{{ asset('assets/images/profile1.jpg') }}" alt="avatar">
                            </div>
                            <div class="spot-followers">128,400 Followers</div>
                            <h5 class="spot-name">DJ Solaris - DJ</h5>
                            <div class="spot-loc"><i class="bi bi-geo-alt"></i> London, United Kingdom</div>
                            <div class="spot-tags">
                                <span class="tag-pill">EDM</span><span class="tag-pill">Hip-Hop</span><span
                                    class="tag-pill">House</span>
                            </div>
                            <a href="#" class="spot-btn">View Profile</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                    <div class="spot-card h-100">
                        <div class="spot-cover">
                            <img src="{{ asset('assets/images/trend1.png') }}" alt="cover" class="w-100">
                        </div>
                        <div class="spot-body">
                            <div class="spot-avatar">
                                <img src="{{ asset('assets/images/profile1.jpg') }}" alt="avatar">
                            </div>
                            <div class="spot-followers">128,400 Followers</div>
                            <h5 class="spot-name">Maya Vibe - DJ</h5>
                            <div class="spot-loc"><i class="bi bi-geo-alt"></i> London, United Kingdom</div>
                            <div class="spot-tags">
                                <span class="tag-pill">EDM</span><span class="tag-pill">Hip-Hop</span><span
                                    class="tag-pill">House</span>
                            </div>
                            <a href="#" class="spot-btn">View Profile</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                    <div class="spot-card h-100">
                        <div class="spot-cover">
                            <img src="{{ asset('assets/images/trend1.png') }}" alt="cover" class="w-100">
                        </div>
                        <div class="spot-body">
                            <div class="spot-avatar">
                                <img src="{{ asset('assets/images/profile1.jpg') }}" alt="avatar">
                            </div>
                            <div class="spot-followers">128,400 Followers</div>
                            <h5 class="spot-name">Kaito Drift - DJ</h5>
                            <div class="spot-loc"><i class="bi bi-geo-alt"></i> London, United Kingdom</div>
                            <div class="spot-tags">
                                <span class="tag-pill">EDM</span><span class="tag-pill">Hip-Hop</span><span
                                    class="tag-pill">House</span>
                            </div>
                            <a href="#" class="spot-btn">View Profile</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                    <div class="spot-card h-100">
                        <div class="spot-cover">
                            <img src="{{ asset('assets/images/trend1.png') }}" alt="cover" class="w-100">
                        </div>
                        <div class="spot-body">
                            <div class="spot-avatar">
                                <img src="{{ asset('assets/images/profile1.jpg') }}" alt="avatar">
                            </div>
                            <div class="spot-followers">128,400 Followers</div>
                            <h5 class="spot-name">Luna Flux - DJ</h5>
                            <div class="spot-loc"><i class="bi bi-geo-alt"></i> London, United Kingdom</div>
                            <div class="spot-tags">
                                <span class="tag-pill">EDM</span><span class="tag-pill">Hip-Hop</span><span
                                    class="tag-pill">House</span>
                            </div>
                            <a href="#" class="spot-btn">View Profile</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Pagination --}}
            <div class="dj-pagination mt-5">
                <a class="pg-btn disabled" href="#"><i class="bi bi-chevron-left"></i></a>
                <a class="pg-num active" href="#">1</a>
                <a class="pg-num" href="#">2</a>
                <span class="pg-dots">…</span>
                <a class="pg-num" href="#">9</a>
                <a class="pg-num" href="#">10</a>
                <a class="pg-btn" href="#"><i class="bi bi-chevron-right"></i></a>
            </div>
        </div>
    </section>
@endsection
