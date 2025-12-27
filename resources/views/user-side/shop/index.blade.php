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
                        <span class="crumb-strong">Shop</span>
                    </div>

                    <h1 class="page-hero__title">
                        Official Shop
                    </h1>

                    <p class="page-hero__desc">
                        Shop limited-edition merch, buy original beats, and support your favorite entertainers directly.
                        Every purchase helps creators rise to the top.
                    </p>
                </div>
            </div>
        </section>
    </div>

    {{-- SHOP SECTIONS --}}
    <section class="shop-section bg-white">
        <div class="container">

            @include('user-side.shop.section-header', [
                'title' => '🔥 Featured & Trending',
            ])

            <div class="row g-4">
                @for ($i = 1; $i <= 3; $i++)
                    @include('user-side.shop.product-card')
                @endfor
            </div>

        </div>
    </section>


    <section class="shop-section bg-light-gray">
        <div class="container">

            @include('user-side.shop.section-header', [
                'title' => 'Official Merchandise',
            ])

            <div class="row g-4">
                @for ($i = 1; $i <= 3; $i++)
                    @include('user-side.shop.product-card')
                @endfor
            </div>

        </div>
    </section>


    <section class="shop-section bg-white">
        <div class="container">

            @include('user-side.shop.section-header', [
                'title' => 'Beats & Music Packs',
            ])

            <div class="row g-4">
                @for ($i = 1; $i <= 3; $i++)
                    @include('user-side.shop.product-card')
                @endfor
            </div>

        </div>
    </section>
@endsection
