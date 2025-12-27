@extends('layouts.user-side')

@section('content')
    {{-- HERO + META SECTION --}}
    <section class="story-hero">
        @include('user-side.partials.navbar')

        <div class="container text-center mt-4">

            <div class="story-breadcrumb">
                Home - Community - On Blast - <strong>View Story</strong>
            </div>

            <h1 class="story-title">Exposed On Live Stream</h1>

            <div class="story-meta">
                <span>Category: Viral Moment</span>
                <span>Source: Instagram</span>
                <span>Submitted By: On Blast Community</span>
            </div>

            <div class="story-meta mt-2">
                <span class="status green">● Featured on Podcast</span>
                <span>Date Submitted: Jan 12, 2025</span>
            </div>

        </div>
    </section>


    {{-- VIDEO SECTION (OVERLAP) --}}
    <section class="story-video-wrap">
        <div class="container">
            <div class="story-video-card">

                <span class="video-source">INSTAGRAM</span>

                <img src="https://picsum.photos/1400/700?random=9" alt="video">

                <div class="video-play">▶</div>

                <div class="video-controls">
                    <span>Duration: 4:12</span>
                </div>

            </div>
        </div>
    </section>


    {{-- STORY CONTENT --}}
    <section class="story-content">
        <div class="container">

            <h2>What Happened?</h2>
            <p>
                During a live Instagram session, an unexpected confrontation revealed private details
                that quickly went viral. Viewers watched in real time as the situation escalated,
                sparking massive online discussion and reactions across platforms.
            </p>

            <h2>Why It Matters</h2>
            <p>
                This moment raised questions about accountability, online behavior, and how public
                figures handle conflict when thousands are watching live.
            </p>

        </div>
    </section>
@endsection
