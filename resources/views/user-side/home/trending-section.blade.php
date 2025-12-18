<section class="trending-section">
    {{-- Trending Now ke top pe same lines --}}
    <div class="section-drips section-drips--top">
        <span class="drip d1"></span>
        <span class="drip d2"></span>
        <span class="drip d3"></span>
    </div>

    <div class="container">
        <div class="trending-head">
            <h2 class="trending-title">Trending Now</h2>

            <a href="#" class="btn pill-btn">
                View All Videos <span class="pill-btn-arrow" aria-hidden="true">→</span>
            </a>
        </div>

        <div class="row g-4 mt-2">
            {{-- Card 1 --}}
            <div class="col-12 col-lg-4">
                <div class="trend-card">
                    <div class="trend-media">
                        <img src="{{ asset('assets/images/trend1.png') }}" alt="Trending 1">
                        <span class="trend-tag">DJ</span>
                    </div>

                    <div class="trend-body">
                        <div class="trend-meta">
                            <span class="meta-item">
                                <i class="bi bi-mic"></i> DJ Nova 🇺🇸 USA
                            </span>
                            <span class="meta-item">
                                <i class="bi bi-clock"></i> 45 Minutes
                            </span>
                        </div>

                        <h3 class="trend-name">DJ Nova – “Midnight Surge”</h3>
                        <p class="trend-votes mb-3">Votes: 32,480 Votes</p>

                        <a href="#" class="btn trend-watch w-100">
                            Watch Video
                        </a>
                    </div>
                </div>
            </div>

            {{-- Card 2 --}}
            <div class="col-12 col-lg-4">
                <div class="trend-card">
                    <div class="trend-media">
                        <img src="{{ asset('assets/images/trend2.png') }}" alt="Trending 2">
                        <span class="trend-tag">Dancer</span>
                    </div>

                    <div class="trend-body">
                        <div class="trend-meta">
                            <span class="meta-item">
                                <i class="bi bi-mic"></i> Aisha Blaze 🇬🇧 UK
                            </span>
                            <span class="meta-item">
                                <i class="bi bi-clock"></i> 45 Minutes
                            </span>
                        </div>

                        <h3 class="trend-name">Aisha Blaze – “Urban Pulse”</h3>
                        <p class="trend-votes mb-3">Votes: 32,480 Votes</p>

                        <a href="#" class="btn trend-watch w-100">
                            Watch Video
                        </a>
                    </div>
                </div>
            </div>

            {{-- Card 3 --}}
            <div class="col-12 col-lg-4">
                <div class="trend-card">
                    <div class="trend-media">
                        <img src="{{ asset('assets/images/trend3.png') }}" alt="Trending 3">
                        <span class="trend-tag">Producer</span>
                    </div>

                    <div class="trend-body">
                        <div class="trend-meta">
                            <span class="meta-item">
                                <i class="bi bi-mic"></i> Hiro Beats 🇯🇵 Japan
                            </span>
                            <span class="meta-item">
                                <i class="bi bi-clock"></i> 45 Minutes
                            </span>
                        </div>

                        <h3 class="trend-name">Hiro Beats – “Galaxy Drift”</h3>
                        <p class="trend-votes mb-3">Votes: 32,480 Votes</p>

                        <a href="#" class="btn trend-watch w-100">
                            Watch Video
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
