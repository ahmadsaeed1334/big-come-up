@extends('layouts.user-side')


@section('content')
    {{-- Competitions HERO (Navbar aap include kar lo) --}}
    <div class="hero-shell">
        @include('user-side.partials.navbar')
        <section class="page-hero space-bg">
            <div class="container">
                <div class="page-hero__inner text-center mx-auto">
                    {{-- breadcrumb pill --}}
                    <div class="crumb-pill mx-auto">
                        <span class="crumb-muted">Home</span>
                        <span class="crumb-dot">-</span>
                        <span class="crumb-strong">Competitions</span>
                    </div>

                    <h1 class="page-hero__title">
                        Competitions &amp; Opportunities
                    </h1>

                    <p class="page-hero__desc">
                        Compete in global DJ, dance, vocal, and producer challenges. Explore live battles, upcoming
                        tournaments, and past winners across every category.
                    </p>
                </div>
            </div>

        </section>

    </div>
    @include('user-side.competitions.live-competitions')
    @include('user-side.competitions.upcoming-competitions')
    @include('user-side.competitions.comedians')
@endsection
