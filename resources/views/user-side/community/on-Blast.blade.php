@extends('layouts.user-side')


@section('content')
    {{-- On Blast HERO (Navbar aap include kar lo) --}}
    <div class="hero-shell">
        @include('user-side.partials.navbar')
        <section class="page-hero space-bg">
            <div class="container">
                <div class="page-hero__inner text-center mx-auto">
                    {{-- breadcrumb pill --}}
                    <div class="crumb-pill mx-auto">
                        <span class="crumb-muted">Home</span>
                        <span class="crumb-dot">-</span>
                        <span class="crumb-muted">Community</span>
                        <span class="crumb-dot">-</span>
                        <span class="crumb-strong">On Blast</span>
                    </div>

                    <h1 class="page-hero__title">
                        On Blast
                    </h1>

                    <p class="page-hero__desc">
                        On Blast is a community-powered news & exposure platform where members submit news-worthy videos,
                        stories, or social media moments that deserve attention — some of which may be featured on The Big
                        Come Up podcast segment: “On Blast.”
                    </p>
                </div>
            </div>

        </section>

    </div>

    <section class="trending-wrapper">
        <div class="container">

            {{-- Section Header --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="fw-bold mb-0">Trending On On Blast</h1>

                <a href="#" class="btn spot-cta">
                    Submit Your Story <span class="spot-cta-arrow" aria-hidden="true">→</span>
                </a>

            </div>


            <div class="row g-4">

                <!-- CARD -->
                <div class="col-lg-4">
                    <div class="trend-card">

                        <!-- IMAGE WRAP -->
                        <div class="trend-image-wrap">
                            <img src="https://picsum.photos/800/500?random=1" alt="story">

                            <span class="trend-badge badge-left">Instagram</span>
                            <span class="trend-badge badge-right">Viral Moment</span>
                        </div>

                        <!-- CONTENT -->
                        <div class="trend-content">
                            <h3>Exposed on Live Stream</h3>
                            <p>
                                A heated live stream took an unexpected turn when
                                shocking details were revealed in front of...
                            </p>

                            <span class="trend-status">Featured on Podcast</span>

                            <a href="#" class="trend-btn">View Story</a>
                        </div>

                    </div>
                </div>

                <!-- CARD -->
                <div class="col-lg-4">
                    <div class="trend-card">

                        <div class="trend-image-wrap">
                            <img src="https://picsum.photos/800/500?random=2" alt="story">

                            <span class="trend-badge badge-left dark">Tiktok</span>
                            <span class="trend-badge badge-right dark">Unfair Treatment</span>
                        </div>

                        <div class="trend-content">
                            <h3>Exposed on Live Stream</h3>
                            <p>
                                A heated live stream took an unexpected turn when
                                shocking details were revealed in front of...
                            </p>

                            <span class="trend-status gray">Under review</span>

                            <a href="#" class="trend-btn">View Story</a>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="trend-card">

                        <div class="trend-image-wrap">
                            <img src="https://picsum.photos/800/500?random=3" alt="story">

                            <span class="trend-badge badge-left dark">Tiktok</span>
                            <span class="trend-badge badge-right dark">Unfair Treatment</span>
                        </div>

                        <div class="trend-content">
                            <h3>Exposed on Live Stream</h3>
                            <p>
                                A heated live stream took an unexpected turn when
                                shocking details were revealed in front of...
                            </p>

                            <span class="trend-status gray">Under review</span>

                            <a href="#" class="trend-btn">View Story</a>
                        </div>

                    </div>
                </div>

            </div>

            <div class="row g-4">

                <!-- CARD -->
                <div class="col-lg-4">
                    <div class="trend-card">

                        <!-- IMAGE WRAP -->
                        <div class="trend-image-wrap">
                            <img src="https://picsum.photos/800/500?random=4" alt="story">

                            <span class="trend-badge badge-left">Instagram</span>
                            <span class="trend-badge badge-right">Viral Moment</span>
                        </div>

                        <!-- CONTENT -->
                        <div class="trend-content">
                            <h3>Exposed on Live Stream</h3>
                            <p>
                                A heated live stream took an unexpected turn when
                                shocking details were revealed in front of...
                            </p>

                            <span class="trend-status">Featured on Podcast</span>

                            <a href="#" class="trend-btn">View Story</a>
                        </div>

                    </div>
                </div>

                <!-- CARD -->
                <div class="col-lg-4">
                    <div class="trend-card">

                        <div class="trend-image-wrap">
                            <img src="https://picsum.photos/800/500?random=5" alt="story">

                            <span class="trend-badge badge-left dark">Tiktok</span>
                            <span class="trend-badge badge-right dark">Unfair Treatment</span>
                        </div>

                        <div class="trend-content">
                            <h3>Exposed on Live Stream</h3>
                            <p>
                                A heated live stream took an unexpected turn when
                                shocking details were revealed in front of...
                            </p>

                            <span class="trend-status gray">Under review</span>

                            <a href="#" class="trend-btn">View Story</a>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="trend-card">

                        <div class="trend-image-wrap">
                            <img src="https://picsum.photos/800/500?random=6" alt="story">

                            <span class="trend-badge badge-left dark">Tiktok</span>
                            <span class="trend-badge badge-right dark">Unfair Treatment</span>
                        </div>

                        <div class="trend-content">
                            <h3>Exposed on Live Stream</h3>
                            <p>
                                A heated live stream took an unexpected turn when
                                shocking details were revealed in front of...
                            </p>

                            <span class="trend-status gray">Under review</span>

                            <a href="#" class="trend-btn">View Story</a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
