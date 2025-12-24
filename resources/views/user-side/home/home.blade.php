@extends('layouts.user-side')

@section('title', 'Home - ' . config('app.name'))

@section('content')

    <div class="hero-shell">
        @include('user-side.partials.navbar')
        {{-- HERO --}}
        <section class="hero">
            <div class="container">
                <div class="kicker">{{ $hero->subtitle }}</div>

                <h1>{{ $hero->title }}</h1>

                <p>
                    {!! $hero->description !!}

                </p>

                <div class="hero-actions d-flex justify-content-center gap-3 flex-wrap mt-4">
                    <a href="{{ $hero->primary_btn_link }}" class="btn btn-warning hero-btn hero-btn-primary">
                        {{ $hero->primary_btn_text }}<span class="arrow">→</span>
                    </a>

                    <a href=" {{ $hero->secondary_btn_link }}" class="btn hero-btn hero-btn-outline">
                        {{ $hero->secondary_btn_text }} <span class="arrow">→</span>
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
