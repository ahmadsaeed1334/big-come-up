@extends('layouts.user-side')

@section('content')
    @include('user-side.partials.navbar')
    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <a href="#">Home</a> / <a href="#">Shop</a> / <a href="#">Featured & Trending</a> / <span>Camel
            Cuffed Joggers</span>
    </div>

    <!-- Product Section -->
    <div class="product-container">
        <!-- Thumbnail Gallery -->
        <div class="thumbnail-gallery">
            <button class="thumbnail-arrow thumbnail-arrow-up" id="scrollUp">▲</button>
            <div class="thumbnail-wrapper">
                <div class="thumbnail-scroll" id="thumbnailScroll">
                    <div class="thumbnail active" onclick="changeImage(0)">
                        <img src="https://images.unsplash.com/photo-1556821840-3a63f95609a7?w=200&h=300&fit=crop"
                            alt="Thumbnail 1">
                    </div>
                    <div class="thumbnail" onclick="changeImage(1)">
                        <img src="https://images.unsplash.com/photo-1624378439575-d8705ad7ae80?w=200&h=300&fit=crop"
                            alt="Thumbnail 2">
                    </div>
                    <div class="thumbnail" onclick="changeImage(2)">
                        <img src="https://images.unsplash.com/photo-1560243563-062bfc001d68?w=200&h=300&fit=crop"
                            alt="Thumbnail 3">
                    </div>
                    <div class="thumbnail" onclick="changeImage(3)">
                        <img src="https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?w=200&h=300&fit=crop"
                            alt="Thumbnail 4">
                    </div>
                    <div class="thumbnail" onclick="changeImage(4)">
                        <img src="https://images.unsplash.com/photo-1603252109303-2751441dd157?w=200&h=300&fit=crop"
                            alt="Thumbnail 5">
                    </div>
                </div>
            </div>
            <button class="thumbnail-arrow thumbnail-arrow-down" id="scrollDown">▼</button>
        </div>

        <!-- Main Image -->
        <div class="main-image" id="mainImage">
            <img src="https://images.unsplash.com/photo-1556821840-3a63f95609a7?w=800&h=1000&fit=crop" alt="Product Image">
        </div>

        <!-- Product Info -->
        <div class="product-info">
            <h1 class="product-title">Midnight Surge – Exclusive DJ Hoodie</h1>

            <div class="product-rating">
                <div class="stars">★★★★☆</div>
                <span class="rating-text">4.5 (212 reviews)</span>
            </div>

            <div class="product-price">
                <span class="current-price">$ 215.00</span>
                <span class="original-price">$ 290.00</span>
                <button class="wishlist-btn">♡ Add to Wish List</button>
            </div>

            <!-- Color Option -->
            <div class="option-group">
                <div class="option-label">Color: <strong>Black</strong></div>
                <div class="color-selector">
                    <select class="color-dropdown" id="colorSelect">
                        <option value="black">Black</option>
                        <option value="white">White</option>
                        <option value="gray">Gray</option>
                        <option value="navy">Navy</option>
                        <option value="charcoal">Charcoal</option>
                    </select>
                </div>
            </div>

            <!-- Size Option -->
            <div class="option-group">
                <div class="option-label">Size: <strong>5</strong></div>
                <div class="size-buttons">
                    <button class="size-btn active">S</button>
                    <button class="size-btn">M</button>
                    <button class="size-btn">L</button>
                    <button class="size-btn">XL</button>
                    <button class="size-btn">XXL</button>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <button class="add-to-cart-btn">
                    🛒 Add to Cart
                </button>
                <button class="buy-now-btn">Buy Now</button>
            </div>

            <!-- Artist Notice -->
            <div class="artist-notice">
                ❤️ A portion of every purchase goes directly to the artist.
            </div>

            <!-- Payment Methods -->
            <div class="payment-methods">
                <div class="payment-label">Payment method</div>
                <div class="payment-icons">
                    <div class="payment-icon">VISA</div>
                    <div class="payment-icon">MC</div>
                    <div class="payment-icon">AMEX</div>
                    <a href="#" class="learn-more">Learn more</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabs Section -->
    <div class="tabs-section">
        <div class="tabs-header">
            <button class="tab-btn active" onclick="switchTab(0)">Product Details</button>
            <button class="tab-btn" onclick="switchTab(1)">About The Artist</button>
            <button class="tab-btn" onclick="switchTab(2)">Reviews</button>
        </div>

        <!-- Product Details Tab -->
        <div class="tab-content active">
            <p class="product-description">
                Inspired by DJ Nova's electrifying live performances, the Neon Energy Hoodie delivers premium comfort with a
                bold design. Featuring custom graphics, high-quality fabric, and an exclusive artist signature patch — this
                drop is made for fans who live the culture.
            </p>

            <h3 class="highlights-title">Key Highlights</h3>
            <ul class="highlights-list">
                <li>Premium heavyweight cotton</li>
                <li>Artist-approved design</li>
                <li>Signature patch detailing</li>
                <li>Unisex fit</li>
                <li>Limited edition release</li>
            </ul>

            <h3 class="specs-title">Specifications</h3>
            <ul class="highlights-list">
                <li>Material: 80% Cotton / 20% Polyester</li>
                <li>Fit: Regular / Relaxed</li>
                <li>Care: Machine Wash</li>
                <li>Shipping: Worldwide Available</li>
                <li>Returns: Eligible within 14 days</li>
            </ul>
        </div>

        <!-- About The Artist Tab -->
        <div class="tab-content">
            <h3 class="highlights-title">About DJ Nova</h3>
            <p class="product-description">
                DJ Nova is an internationally acclaimed electronic music producer and performer known for pushing boundaries
                in the EDM scene. With sold-out shows across major cities and millions of streams worldwide, DJ Nova brings
                energy, innovation, and unforgettable experiences to every performance.
            </p>
            <p class="product-description">
                This exclusive merchandise line represents DJ Nova's commitment to connecting with fans through
                high-quality, limited-edition products that embody the spirit of the music and the culture.
            </p>
        </div>

        <!-- Reviews Tab -->
        <div class="tab-content">
            <h3 class="highlights-title">Customer Reviews</h3>
            <p class="product-description" style="margin-bottom: 20px;">
                <strong>4.5 out of 5</strong> based on 212 reviews
            </p>
            <div style="border-top: 1px solid #eee; padding-top: 20px;">
                <div style="margin-bottom: 25px; padding-bottom: 25px; border-bottom: 1px solid #eee;">
                    <div class="stars" style="margin-bottom: 10px;">★★★★★</div>
                    <p style="color: #666; margin-bottom: 5px;"><strong>Amazing quality!</strong></p>
                    <p style="color: #999; font-size: 14px; margin-bottom: 10px;">by Sarah M. - December 20, 2025</p>
                    <p style="color: #666;">The hoodie exceeded my expectations. The fabric is thick and comfortable, and
                        the design is exactly as shown. Worth every penny!</p>
                </div>
                <div style="margin-bottom: 25px; padding-bottom: 25px; border-bottom: 1px solid #eee;">
                    <div class="stars" style="margin-bottom: 10px;">★★★★☆</div>
                    <p style="color: #666; margin-bottom: 5px;"><strong>Great but runs large</strong></p>
                    <p style="color: #999; font-size: 14px; margin-bottom: 10px;">by Mike T. - December 18, 2025</p>
                    <p style="color: #666;">Love the design and quality, but I'd recommend sizing down. I got a Large and
                        it fits like an XL.</p>
                </div>
                <div style="margin-bottom: 25px;">
                    <div class="stars" style="margin-bottom: 10px;">★★★★★</div>
                    <p style="color: #666; margin-bottom: 5px;"><strong>Perfect gift for fans</strong></p>
                    <p style="color: #999; font-size: 14px; margin-bottom: 10px;">by Jessica L. - December 15, 2025</p>
                    <p style="color: #666;">Bought this for my brother who's a huge DJ Nova fan. He absolutely loves it!
                        Fast shipping too.</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        const images = [
            'https://images.unsplash.com/photo-1556821840-3a63f95609a7?w=800&h=1000&fit=crop',
            'https://images.unsplash.com/photo-1624378439575-d8705ad7ae80?w=800&h=1000&fit=crop',
            'https://images.unsplash.com/photo-1560243563-062bfc001d68?w=800&h=1000&fit=crop',
            'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?w=800&h=1000&fit=crop',
            'https://images.unsplash.com/photo-1603252109303-2751441dd157?w=800&h=1000&fit=crop'
        ];

        let currentScrollPosition = 0;
        const thumbnailHeight = 180 + 15; // height + gap
        const visibleThumbnails = 3;
        const maxScroll = Math.max(0, images.length - visibleThumbnails);

        function updateArrows() {
            const scrollUp = document.getElementById('scrollUp');
            const scrollDown = document.getElementById('scrollDown');

            if (images.length <= visibleThumbnails) {
                scrollUp.classList.remove('show');
                scrollDown.classList.remove('show');
            } else {
                scrollUp.classList.toggle('show', currentScrollPosition > 0);
                scrollDown.classList.toggle('show', currentScrollPosition < maxScroll);
            }
        }

        function scrollThumbnails(direction) {
            if (direction === 'up' && currentScrollPosition > 0) {
                currentScrollPosition--;
            } else if (direction === 'down' && currentScrollPosition < maxScroll) {
                currentScrollPosition++;
            }

            const thumbnailScroll = document.getElementById('thumbnailScroll');
            thumbnailScroll.style.transform = `translateY(-${currentScrollPosition * thumbnailHeight}px)`;
            updateArrows();
        }

        document.getElementById('scrollUp').addEventListener('click', () => scrollThumbnails('up'));
        document.getElementById('scrollDown').addEventListener('click', () => scrollThumbnails('down'));

        function changeImage(index) {
            const mainImage = document.querySelector('#mainImage img');
            mainImage.src = images[index];

            const thumbnails = document.querySelectorAll('.thumbnail');
            thumbnails.forEach((thumb, i) => {
                thumb.classList.toggle('active', i === index);
            });
        }

        // Initialize arrows
        updateArrows();

        // Color selector change
        document.getElementById('colorSelect').addEventListener('change', function() {
            const selectedColor = this.options[this.selectedIndex].text;
            document.querySelector('.option-label strong').textContent = selectedColor;
        });

        // Size selector
        document.querySelectorAll('.size-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.size-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Tab switching
        function switchTab(index) {
            const tabBtns = document.querySelectorAll('.tab-btn');
            const tabContents = document.querySelectorAll('.tab-content');

            tabBtns.forEach((btn, i) => {
                btn.classList.toggle('active', i === index);
            });

            tabContents.forEach((content, i) => {
                content.classList.toggle('active', i === index);
            });
        }

        // Add to cart functionality
        document.querySelector('.add-to-cart-btn').addEventListener('click', function() {
            alert('Product added to cart!');
            const cartBadge = document.querySelector('.cart-badge');
            cartBadge.textContent = parseInt(cartBadge.textContent) + 1;
        });

        // Buy now functionality
        document.querySelector('.buy-now-btn').addEventListener('click', function() {
            alert('Proceeding to checkout...');
        });
    </script>
@endsection
