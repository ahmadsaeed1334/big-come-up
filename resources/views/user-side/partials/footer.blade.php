<footer class="site-footer">
    <div class="container">
        <div class="row g-4 align-items-start">
            {{-- Left: logo + text + socials --}}
            <div class="col-12 col-lg-4">
                <a href="{{ url('/') }}"
                    class="footer-brand d-inline-flex align-items-center gap-3 text-decoration-none">
                    <img src="{{ asset('assets/images/logo.jpg') }}" alt="Logo" class="footer-logo">
                </a>

                <p class="footer-desc mt-3 mb-4">
                    Compete Globally, Discover New Talent, Vote<br>
                    For Your Favorites, And Rise To The Top With<br>
                    AI-Powered Scoring &amp; Fair Competition.
                </p>

                <div class="footer-social d-flex gap-3">
                    <a href="#" class="social-btn" aria-label="Facebook">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="#" class="social-btn" aria-label="X">
                        <i class="bi bi-twitter-x"></i>
                    </a>
                    <a href="#" class="social-btn" aria-label="Instagram">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a href="#" class="social-btn" aria-label="TikTok">
                        <i class="bi bi-tiktok"></i>
                    </a>
                </div>
            </div>

            {{-- Quick Links --}}
            <div class="col-12 col-md-4 col-lg-3">
                <h6 class="footer-title">Quick Links</h6>
                <ul class="footer-links list-unstyled m-0">
                    <li><a href="#"><span class="chev">›</span> Home</a></li>
                    <li><a href="#"><span class="chev">›</span> Competitions</a></li>
                    <li><a href="#"><span class="chev">›</span> Videos</a></li>
                    <li><a href="#"><span class="chev">›</span> Artists</a></li>
                    <li><a href="#"><span class="chev">›</span> Shop</a></li>
                    <li><a href="#"><span class="chev">›</span> Help Center</a></li>
                    <li><a href="#"><span class="chev">›</span> Referral Program</a></li>
                </ul>
            </div>

            {{-- Other Links --}}
            <div class="col-12 col-md-4 col-lg-3">
                <h6 class="footer-title">Other Links</h6>
                <ul class="footer-links list-unstyled m-0">
                    <li><a href="#"><span class="chev">›</span> Terms &amp; Condition</a></li>
                    <li><a href="#"><span class="chev">›</span> Privacy Policy</a></li>
                    <li><a href="#"><span class="chev">›</span> Help Center</a></li>
                </ul>
            </div>

            {{-- Contact Info --}}
            <div class="col-12 col-md-4 col-lg-2">
                <h6 class="footer-title">Contact Info</h6>

                <div class="footer-contact">
                    <div class="contact-row">
                        <span class="contact-ic">
                            <i class="bi bi-envelope"></i>
                        </span>
                        <span class="contact-txt">info@thebigcomeup.com</span>
                    </div>

                    <div class="contact-row mt-3">
                        <span class="contact-ic">
                            <i class="bi bi-geo-alt"></i>
                        </span>
                        <span class="contact-txt">
                            1234 Main Street, Suite 100 Los<br>
                            Angeles, CA 90001
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <hr class="footer-line my-4">

        <div class="footer-bottom text-center">
            Copyright © 2025, The Big Come Up. All rights reserved
        </div>
    </div>
</footer>
