@extends('layouts.user-side')

@section('title', 'Home - ' . config('app.name'))

@section('content')

    <div class="hero-shell">
        @include('user-side.partials.navbar')
        {{-- HERO --}}
        <section class="hero">
            <div class="container">
                <div class="kicker">THE BIG COME UP</div>

                <h1>The World’s Biggest DJ, Artist &amp;<br class="d-none d-md-block"> Music Competition Platform</h1>

                <p>
                    Complete globally discover new talent and be discovered, vote for your favorites, chat and connect,
                    sell your music, beats, and merchandise. Even members win cash. Rise to the top with AI powered
                    scoring and fair competition.
                </p>

                <div class="hero-actions d-flex justify-content-center gap-3 flex-wrap mt-4">
                    <a href="{{ route('register') }}" class="btn btn-warning hero-btn hero-btn-primary">
                        Sign Up Now <span class="arrow">→</span>
                    </a>

                    <a href="#" class="btn hero-btn hero-btn-outline">
                        Watch Videos <span class="arrow">→</span>
                    </a>
                </div>

                <!-- WAVE (buttons ke niche) -->
                <div class="hero-wave-wrap mt-4">
                    <img src="{{ asset('assets/images/wave.png') }}" class="hero-wave" alt="wave">
                </div>

            </div>
        </section>
        @include('user-side.home.how-it-work')
        @include('user-side.home.under-the-spotlight')
        @include('user-side.home.ready-to-showcase')

        {{-- CTA band ke bilkul end pe (section close hone se pehle) --}}
        <div class="section-drips">
            <span class="drip d1"></span>
            <span class="drip d2"></span>
            <span class="drip d3"></span>
        </div>
        @include('user-side.home.trending-section')
        @include('user-side.home.ready-to-join')
        @include('user-side.home.official-merch')
    </div>
@endsection
