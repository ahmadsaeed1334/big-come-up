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
                        <span class="crumb-strong">On Blast Submisstion</span>
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
                <h1 class="fw-bold mb-0">My Submission</h1>

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

        </div>
    </section>
    <hr>
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
    <section class="submit-story-section">
        <div class="container">

            <h2 class="submit-title text-center">Submit Your Story</h2>

            <div class="submit-card mx-auto">

                <form>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <input type="text" class="submit-input" placeholder="Full Name">
                        </div>
                        <div class="col-md-6">
                            <input type="email" class="submit-input" placeholder="Email">
                        </div>
                    </div>

                    <select class="submit-input mt-4">
                        <option>Category</option>
                        <option>Viral Moment</option>
                        <option>Community Drama</option>
                        <option>Unfair Treatment</option>
                    </select>

                    <input type="text" class="submit-input mt-4" placeholder="Title Of Your Story">

                    <textarea class="submit-textarea mt-4" placeholder="Description"></textarea>

                    <!-- Upload Box -->
                    <div class="upload-box mt-4">
                        <div class="upload-icon"><i class="bi bi-cloud-arrow-up-fill"></i></div>
                        <h6>Select Files To Upload</h6>
                        <p>Drag and drop a file or Click to Upload</p>
                        <input type="file" hidden>
                    </div>

                    <div class="row g-4 mt-3">
                        <div class="col-md-8">
                            <input type="text" class="submit-input" placeholder="Social Media Link">
                        </div>
                        <div class="col-md-4">
                            <select class="submit-input">
                                <option>Instagram</option>
                                <option>TikTok</option>
                                <option>YouTube</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-check mt-4">
                        <input class="form-check-input" type="checkbox">
                        <label class="form-check-label">
                            I confirm this content is public and I have the right to share it.
                        </label>
                    </div>

                    <button type="submit" class="submit-btn mt-4">
                        Submit To On Blast →
                    </button>

                    <p class="submit-note text-center mt-3">
                        Submissions are reviewed. Not all stories will be featured.
                    </p>

                </form>

            </div>
        </div>
    </section>
@endsection
