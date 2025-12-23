@extends('layouts.user-side')

@section('title', 'Profile - ' . config('app.name'))
@section('content')

    {{-- HERO BG (navbar aap include kar lo) --}}
    <section class="judge-hero">
        <div class="judge-hero__bg" style="background-image:url('{{ asset('assets/images/judge-hero.jpg') }}');">
            {{-- overlay to darken --}}
            <div class="judge-hero__overlay"></div>

            {{-- Navbar yahan include kar lo --}}
            @include('user-side.partials.navbar')
        </div>
    </section>

    {{-- MAIN WRAP --}}
    <section class="judge-profile-section">
        <div class="container">
            <div class="row g-4 align-items-start">

                {{-- LEFT: profile card --}}
                <div class="col-lg-3">
                    <div class="judge-profile-card">

                        <!-- Avatar -->
                        <div class="judge-profile-avatar">
                            <img src="{{ asset('assets/images/judge-avatar.jpg') }}" alt="DJ Spectra">
                        </div>

                        <!-- Name -->
                        <h2 class="judge-profile-name">
                            DJ Spectra – Judge
                        </h2>

                        <!-- Location -->
                        <p class="judge-profile-location">
                            <i class="bi bi-geo-alt"></i>
                            London, United Kingdom
                        </p>

                        <hr class="judge-profile-divider">

                        <!-- Bio -->
                        <p class="judge-profile-bio">
                            With over 15 years of experience in the electronic music scene,
                            she brings deep expertise in live performance evaluation,
                            transitions, and energy control.
                        </p>

                        <!-- Tags -->
                        <div class="judge-profile-tags">
                            <span class="judge-tag">15+ Years of Experience</span>
                            <span class="judge-tag">EDM Festival Headliner & Competition Judge</span>
                        </div>

                    </div>
                </div>

                {{-- RIGHT: dotted dark panel --}}
                <div class="col-lg-9">
                    <div class="judge-panel">

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="glass-box">
                                    <h4 class="glass-title">Expertise &amp; Skills Section</h4>
                                    <ul class="checklist">
                                        <li><i class="bi bi-check-circle-fill"></i> EDM &amp; Festival Mixes</li>
                                        <li><i class="bi bi-check-circle-fill"></i> Transition Flow &amp; Precision</li>
                                        <li><i class="bi bi-check-circle-fill"></i> Track Selection &amp; Creativity</li>
                                        <li><i class="bi bi-check-circle-fill"></i> Live Mixing Techniques</li>
                                        <li><i class="bi bi-check-circle-fill"></i> Sound Design &amp; Stage Energy</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="glass-box">
                                    <h4 class="glass-title">Scoring Philosophy</h4>
                                    <ul class="checklist">
                                        <li><i class="bi bi-check-circle-fill"></i> <b>Creativity:</b> How unique the mix
                                            feels</li>
                                        <li><i class="bi bi-check-circle-fill"></i> <b>Technique:</b> Scratching,
                                            transitions, timing</li>
                                        <li><i class="bi bi-check-circle-fill"></i> <b>Energy:</b> Crowd control, intensity,
                                            performance flow</li>
                                        <li><i class="bi bi-check-circle-fill"></i> <b>Originality:</b> Style, approach,
                                            creative risk</li>
                                        <li><i class="bi bi-check-circle-fill"></i> <b>Professionalism:</b> Stage presence,
                                            execution</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="glass-box mt-3">
                            <h4 class="glass-title">Judging Credentials</h4>

                            <div class="cred-table">
                                <div class="cred-row">
                                    <span class="cred-k">Official Judge:</span>
                                    <span class="cred-v">Global DJ Battle 2025</span>
                                </div>
                                <div class="cred-row">
                                    <span class="cred-k">Panelist:</span>
                                    <span class="cred-v">International DJ Conference 2025</span>
                                </div>
                                <div class="cred-row">
                                    <span class="cred-k">Headliner:</span>
                                    <span class="cred-v">EDC Las Vegas, Ultra Miami</span>
                                </div>
                                <div class="cred-row">
                                    <span class="cred-k">Producer:</span>
                                    <span class="cred-v">3 charting tracks in EDM Top 50</span>
                                </div>
                                <div class="cred-row">
                                    <span class="cred-k">Guest Mentor:</span>
                                    <span class="cred-v">DJ Masterclass Workshops</span>
                                </div>
                            </div>
                        </div>

                        <div class="glass-box mt-3">
                            <h4 class="glass-title">Competitions Judged</h4>

                            <div class="row g-3 mt-1">
                                <div class="col-md-6">
                                    <div class="mini-glass">
                                        <h6 class="mini-title">Currently Judging:</h6>
                                        <div class="mini-item">
                                            <span class="live-dot"></span>
                                            <span>Global DJ Battle 2025</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mini-glass">
                                        <h6 class="mini-title">Previously Judged:</h6>
                                        <ul class="mini-list">
                                            <li><i class="bi bi-check-circle-fill"></i> Electro Bass Cup 2024</li>
                                            <li><i class="bi bi-check-circle-fill"></i> Urban Mix Tournament 2023</li>
                                            <li><i class="bi bi-check-circle-fill"></i> SoundStorm DJ Championship 2022</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="glass-cta mt-3">
                            <h5>Want To Impress Judges Like DJ Spectra?</h5>
                            <a href="#" class="btn btn-cta-amber">
                                <span class="btn-text">Join A Competition</span>
                                <span class="btn-arrow">→</span>
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
