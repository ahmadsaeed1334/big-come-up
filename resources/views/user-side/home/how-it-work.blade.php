<section class="howitworks py-5 py-lg-6 bg-white">
    <div class="container">
        <h2 class="how-title text-center mb-5">How It Works</h2>

        <div class="row g-4 g-lg-0 how-row align-items-stretch">
            {{-- Card 1 --}}
            @foreach ($steps as $step)
                <div class="col-12 col-lg-4 how-col">
                    <div class="how-card text-center h-100">
                        <div class="how-badge mx-auto mb-4"> {{ sprintf('%02d', $step->step_number) }}</div>

                        <h5 class="how-heading mb-2">{{ $step->title }}</h5>
                        <p class="how-text mb-0">
                            {!! $step->description !!}
                        </p>
                    </div>
                </div>
            @endforeach

            {{-- Card 2 --}}
            {{-- <div class="col-12 col-lg-4 how-col how-divider">
                <div class="how-card text-center h-100">
                    <div class="how-badge mx-auto mb-4">02</div>

                    <h5 class="how-heading mb-2">Get Votes &amp; Judge Scores</h5>
                    <p class="how-text mb-0">
                        Fans vote globally. Judges score using a fair &amp; transparent scoring system enhanced with AI
                        assistance.
                    </p>
                </div>
            </div> --}}

            {{-- Card 3 --}}
            {{-- <div class="col-12 col-lg-4 how-col how-divider">
                <div class="how-card text-center h-100">
                    <div class="how-badge mx-auto mb-4">03</div>

                    <h5 class="how-heading mb-2">Win Prizes &amp; Get Exposure</h5>
                    <p class="how-text mb-0">
                        Top performers earn rewards, visibility, global recognition, and potential brand/sponsor
                        outreach.
                    </p>
                </div>
            </div> --}}
        </div>

        <div class="text-center mt-5">
            <a href="#" class="btn how-cta">
                Submit Your Entry
                <span class="how-cta-arrow" aria-hidden="true">→</span>
            </a>
        </div>
    </div>
</section>
