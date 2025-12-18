{{-- LIVE COMPETITION --}}
<section class="comp-live">
    <div class="container">

        {{-- Filters row --}}
        <div class="comp-filters d-flex flex-wrap justify-content-center gap-3">
            <div class="filter-pill dropdown">
                <button class="btn filter-btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    Genre
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Hip-Hop</a></li>
                    <li><a class="dropdown-item" href="#">EDM</a></li>
                    <li><a class="dropdown-item" href="#">Pop</a></li>
                </ul>
            </div>

            <div class="filter-pill dropdown">
                <button class="btn filter-btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    Prize
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">$500</a></li>
                    <li><a class="dropdown-item" href="#">$1,000</a></li>
                    <li><a class="dropdown-item" href="#">$6,500</a></li>
                </ul>
            </div>

            <div class="filter-pill dropdown">
                <button class="btn filter-btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    Country
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">USA</a></li>
                    <li><a class="dropdown-item" href="#">UK</a></li>
                    <li><a class="dropdown-item" href="#">Pakistan</a></li>
                </ul>
            </div>

            <div class="filter-pill dropdown">
                <button class="btn filter-btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    Status
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Live</a></li>
                    <li><a class="dropdown-item" href="#">Upcoming</a></li>
                    <li><a class="dropdown-item" href="#">Ended</a></li>
                </ul>
            </div>

            <div class="filter-pill dropdown">
                <button class="btn filter-btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    Category
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Artist</a></li>
                    <li><a class="dropdown-item" href="#">Singer</a></li>
                    <li><a class="dropdown-item" href="#">Producer</a></li>
                </ul>
            </div>
        </div>

        <h2 class="comp-live__title text-center">Live Competition</h2>

        {{-- Slider --}}
        <div id="liveCompCarousel" class="carousel slide comp-carousel" data-bs-ride="carousel">
            <div class="carousel-inner">

                {{-- Slide 1 --}}
                <div class="carousel-item active">
                    <div class="comp-card">
                        {{-- image (video later) --}}
                        <img class="comp-card__img" src="{{ asset('assets/images/competition-live.jpg') }}"
                            alt="Live Competition">

                        {{-- overlays --}}
                        <div class="comp-card__overlay"></div>

                        <div class="comp-card__badges">
                            <span class="badge-left">ARTIST / SINGER</span>
                            <span class="badge-right">ENDS IN 24 HOURS</span>
                        </div>

                        <div class="comp-card__content">
                            <div class="comp-card__meta">
                                <span class="meta-live">
                                    <i class="bi bi-mic-fill"></i> LIVE
                                </span>
                            </div>

                            <h3 class="comp-card__name">Underground Rap &amp; Hip-Hop Showdown</h3>

                            <span class="comp-card__subpill">
                                Total Submissions: 723 Entries
                            </span>

                            <a href="{{ url('/competitions/1') }}" class="comp-card__link">
                                View Competition <span class="arrow">→</span>
                            </a>

                            <div class="comp-card__prize">
                                <strong>Prize:</strong> $6,500 + Music Video Shoot
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Slide 2 (duplicate for UI) --}}
                <div class="carousel-item">
                    <div class="comp-card">
                        <img class="comp-card__img" src="{{ asset('assets/images/competition-live.jpg') }}"
                            alt="Live Competition">

                        <div class="comp-card__overlay"></div>

                        <div class="comp-card__badges">
                            <span class="badge-left">PRODUCER</span>
                            <span class="badge-right">ENDS IN 48 HOURS</span>
                        </div>

                        <div class="comp-card__content">
                            <div class="comp-card__meta">
                                <span class="meta-live">
                                    <i class="bi bi-mic-fill"></i> LIVE
                                </span>
                            </div>

                            <h3 class="comp-card__name">Beat Battle Challenge</h3>

                            <span class="comp-card__subpill">
                                Total Submissions: 410 Entries
                            </span>

                            <a href="{{ url('/competitions/2') }}" class="comp-card__link">
                                View Competition <span class="arrow">→</span>
                            </a>

                            <div class="comp-card__prize">
                                <strong>Prize:</strong> $2,000 + Feature Promo
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Dots (pagination) --}}
            <div class="carousel-indicators comp-dots">
                <button type="button" data-bs-target="#liveCompCarousel" data-bs-slide-to="0"
                    class="active"></button>
                <button type="button" data-bs-target="#liveCompCarousel" data-bs-slide-to="1"></button>
            </div>
        </div>

    </div>
</section>
