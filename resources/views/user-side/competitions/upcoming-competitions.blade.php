{{-- UPCOMING COMPETITIONS --}}
<section class="upcoming-comp">
    <div class="container">
        <h2 class="upcoming-title text-center">Upcoming Competitions</h2>

        <div class="row g-4 justify-content-center">

            {{-- Card 1 --}}
            <div class="col-lg-6">
                <div class="up-card up-card--purple">
                    <img class="up-person" src="{{ asset('assets/images/up-producer1.png') }}" alt="Artist">

                    <div class="up-top">
                        <span class="up-chip">RAP / HIP-HOP</span>
                        <div class="up-date">
                            <span class="d">25</span>
                            <span class="m">MAY</span>
                        </div>
                    </div>

                    <h3 class="up-h">Freestyle Rap Cypher –<br>Global Edition</h3>

                    <a href="{{ url('/competitions/1') }}" class="btn up-btn">
                        View Competition <span class="up-arrow">→</span>
                    </a>
                </div>
            </div>

            {{-- Card 2 --}}
            <div class="col-lg-6">
                <div class="up-card up-card--purple">
                    <img class="up-person" src="{{ asset('assets/images/up-producer2.png') }}" alt="Producer">

                    <div class="up-top">
                        <span class="up-chip">MUSIC PRODUCER</span>
                        <div class="up-date">
                            <span class="d">11</span>
                            <span class="m">MARCH</span>
                        </div>
                    </div>

                    <h3 class="up-h">Beat Producers<br>World Cup</h3>

                    <a href="{{ url('/competitions/2') }}" class="btn up-btn">
                        View Competition <span class="up-arrow">→</span>
                    </a>
                </div>
            </div>

            {{-- Card 3 (full width) --}}
            <div class="col-lg-12">
                <div class="up-card up-card--maroon">
                    <img class="up-person up-person--right" src="{{ asset('assets/images/up-producer3.png') }}"
                        alt="Singer">

                    <div class="up-top">
                        <span class="up-chip">ARTIST / SINGER</span>
                        <div class="up-date">
                            <span class="d">11</span>
                            <span class="m">MARCH</span>
                        </div>
                    </div>

                    <h3 class="up-h">Global Artist Vocal Championship</h3>

                    <a href="{{ url('/competitions/3') }}" class="btn up-btn">
                        View Competition <span class="up-arrow">→</span>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>
