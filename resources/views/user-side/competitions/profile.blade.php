@extends('layouts.user-side')

@section('content')
    <div class="profile-shell">

        {{-- NAVBAR --}}
        @include('user-side.partials.navbar')

        {{-- PROFILE HERO --}}
        <section class="profile-hero">
            <div class="container">
                <div class="profile-hero-inner">

                    {{-- RIGHT SIDE ACTIONS --}}
                    <div class="profile-hero-actions">

                        {{-- social pill --}}
                        <div class="profile-social-pill">
                            <a href="#"><i class="bi bi-facebook"></i></a>
                            <a href="#"><i class="bi bi-twitter-x"></i></a>
                            <a href="#"><i class="bi bi-instagram"></i></a>
                        </div>

                        {{-- follow button --}}
                        <a href="#" class="profile-follow-btn">
                            Follow Artist
                        </a>

                    </div>

                </div>
            </div>
        </section>

    </div>
    {{-- =============================
   PROFILE CONTENT SECTION
============================= --}}
    <section class="profile-content">
        <div class="container">
            <div class="row g-4 ">

                {{-- LEFT SIDEBAR --}}
                <div class="col-lg-3">
                    <div class="profile-sidebar">

                        {{-- avatar --}}
                        <div class="profile-avatar">
                            <img src="{{ asset('assets/images/profile1.jpg') }}" alt="Thomas Moiler">
                        </div>

                        <h3 class="profile-name">Thomas Moiler</h3>

                        <p class="profile-location">
                            <i class="bi bi-geo-alt"></i>
                            London, United Kingdom
                        </p>

                        <hr class="profile-divider">

                        <p class="profile-bio">
                            DJ Nova is a Los Angeles–based electronic DJ blending future bass and electro house.
                            Known for high-energy festival sets and precision transitions.
                        </p>

                        {{-- stats --}}
                        <div class="profile-stats">
                            <span>Followers: 128k</span>
                            <span>Total Votes Earned: 98,400</span>
                            <span>Competitions Participated: 12</span>
                            <span>Wins: 2</span>
                        </div>

                        {{-- tags --}}
                        <h5 class="profile-tags-title">Tags</h5>
                        <div class="profile-tags">
                            <span>EDM</span>
                            <span>Future Bass</span>
                            <span>Electro House</span>
                        </div>

                    </div>
                </div>


                {{-- RIGHT CONTENT --}}
                <div class="col-lg-9">

                    {{-- TABS --}}
                    <div class="profile-tabs mb-4">
                        <button class="tab-btn active" data-tab="all">All Performances</button>
                        <button class="tab-btn" data-tab="current">Current Competition</button>
                        <button class="tab-btn" data-tab="achievements">Achievements</button>
                        <button class="tab-btn" data-tab="history">History</button>
                    </div>

                    {{-- TAB CONTENTS --}}

                    {{-- ALL PERFORMANCES --}}
                    <div class="tab-content-profile  active" id="tab-all">
                        <div class="row g-4">
                            @for ($i = 1; $i <= 4; $i++)
                                <div class="col-md-6">
                                    <div class="performance-card">
                                        <img src="{{ asset('assets/images/trend' . (($i % 3) + 1) . '.png') }}">
                                        <div class="perf-overlay">
                                            <h4>Midnight Surge</h4>
                                            <p>Votes: 15,920 · Rank: Top 10</p>
                                            <a href="#" class="btn-watch">Watch Video</a>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>

                    {{-- CURRENT COMPETITION --}}
                    <div class="tab-content-profile " id="tab-current">
                        <div class="row g-4">
                            <div class="col-md-12">
                                <div class="performance-card">
                                    <img src="{{ asset('assets/images/trend1.png') }}">
                                    <div class="perf-overlay">
                                        <h4>Live DJ Battle</h4>
                                        <p>Currently Competing</p>
                                        <a href="#" class="btn-watch">Watch Video</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ACHIEVEMENTS --}}
                    <div class="tab-content-profile " id="tab-achievements">

                        <div class="achievements-box">

                            <div class="achievement-row">
                                <div class="left">
                                    🏆 <strong>Winner</strong>
                                </div>
                                <div class="right">
                                    “Electric Nights DJ Battle 2024”
                                </div>
                            </div>

                            <div class="achievement-row">
                                <div class="left">
                                    🥈 <strong>Runner Up</strong>
                                </div>
                                <div class="right">
                                    “Urban Bass Tournament 2023”
                                </div>
                            </div>

                            <div class="achievement-row">
                                <div class="left">
                                    🔥 <strong>Featured</strong>
                                </div>
                                <div class="right">
                                    “Global Top 50 DJs to Watch”
                                </div>
                            </div>

                            <div class="achievement-row">
                                <div class="left">
                                    🔥 <strong>Featured</strong>
                                </div>
                                <div class="right">
                                    “Global Top 50 DJs to Watch”
                                </div>
                            </div>

                            <div class="achievement-row">
                                <div class="left">
                                    🔥 <strong>Featured</strong>
                                </div>
                                <div class="right">
                                    “Global Top 50 DJs to Watch”
                                </div>
                            </div>

                            {{-- FOOTER --}}
                            <div class="achievement-footer">
                                <span>Showing 1 to 5 of 5 entries</span>

                                <div class="pagination-btns">
                                    <button class="page-btn">← Previous</button>
                                    <button class="page-btn">Next →</button>
                                </div>
                            </div>

                        </div>

                    </div>



                    {{-- HISTORY --}}
                    <div class="tab-content-profile " id="tab-history">

                        <div class="history-box">

                            {{-- TABLE HEADER --}}
                            <div class="history-header">
                                <div>Competition</div>
                                <div>Year</div>
                                <div>Result</div>
                                <div>Score</div>
                            </div>

                            {{-- ROW --}}
                            <div class="history-row">
                                <div class="col-title">Global DJ Battle</div>
                                <div>2025</div>
                                <div><span class="badge gold">Top 10</span></div>
                                <div>94.3</div>
                            </div>

                            <div class="history-row">
                                <div class="col-title">Electro Bass Cup</div>
                                <div>2025</div>
                                <div><span class="badge win">Winner</span></div>
                                <div>94.3</div>
                            </div>

                            <div class="history-row">
                                <div class="col-title">Global DJ Battle</div>
                                <div>2024</div>
                                <div><span class="badge silver">Finalist</span></div>
                                <div>94.3</div>
                            </div>

                            <div class="history-row">
                                <div class="col-title">Global DJ Battle</div>
                                <div>2023</div>
                                <div><span class="badge gold">Top 20</span></div>
                                <div>94.3</div>
                            </div>

                            <div class="history-row">
                                <div class="col-title">Global DJ Battle</div>
                                <div>2022</div>
                                <div><span class="badge silver">Finalist</span></div>
                                <div>94.3</div>
                            </div>

                            {{-- FOOTER --}}
                            <div class="history-footer">
                                <span>Showing 1 to 5 of 5 entries</span>

                                <div class="pagination-btns">
                                    <button class="page-btn">← Previous</button>
                                    <button class="page-btn">Next →</button>
                                </div>
                            </div>

                        </div>

                    </div>


                </div>

            </div>
        </div>
    </section>

    {{-- =============================
COMMENTS SECTION (NEW)
============================= --}}
    <section class="profile-comments-shell">
        <div class="container">

            <h2 class="comments-title text-center mb-4">
                Comments
            </h2>

            {{-- WRITE COMMENT --}}
            <div class="comment-input-glass mb-4">
                <div class="comment-input-left">
                    <i class="bi bi-camera"></i>
                    <input type="text" placeholder="Write your reply..." />
                </div>

                <div class="comment-input-right">
                    <i class="bi bi-filetype-gif"></i>
                    <i class="bi bi-image"></i>
                </div>
            </div>

            {{-- COMMENT ITEM --}}
            <div class="comment-glass-card">
                <div class="comment-header">
                    <img src="{{ asset('assets/images/profile1.jpg') }}" alt="">
                    <div>
                        <strong>jake.travels_</strong>
                        <span>5h ago</span>
                    </div>
                </div>

                <p class="comment-text">
                    seriously, that mid-afternoon crash is brutal. matcha = the hero we need 🙌
                </p>
                <hr class="comment-divider-profile">
                <div class="comment-footer">
                    <span class="reply-btn">Reply</span>

                    <div class="likes-box">
                        <span>4 Likes</span>
                        <span class="emoji">👍</span>
                        <span class="emoji">😂</span>
                    </div>
                </div>
            </div>

            {{-- COMMENT ITEM --}}
            <div class="comment-glass-card">
                <div class="comment-header">
                    <img src="{{ asset('assets/images/profile1.jpg') }}" alt="">
                    <div>
                        <strong>jake.travels_</strong>
                        <span>5h ago</span>
                    </div>
                </div>

                <p class="comment-text">
                    seriously, that mid-afternoon crash is brutal. matcha = the hero we need 🙌
                </p>
                <hr class="comment-divider-profile">
                <div class="comment-footer">
                    <span class="reply-btn">Reply</span>

                    <div class="likes-box">
                        <span>4 Likes</span>
                        <span class="emoji">👍</span>
                        <span class="emoji">😂</span>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tabButtons = document.querySelectorAll(".tab-btn");
            const tabContents = document.querySelectorAll(".tab-content-profile ");

            tabButtons.forEach(btn => {
                btn.addEventListener("click", () => {
                    // remove active from all buttons
                    tabButtons.forEach(b => b.classList.remove("active"));
                    // hide all contents
                    tabContents.forEach(c => c.classList.remove("active"));

                    // add active to clicked button
                    btn.classList.add("active");

                    // show matching tab content
                    const tabName = btn.getAttribute("data-tab");
                    const activeTab = document.getElementById("tab-" + tabName);

                    if (activeTab) {
                        activeTab.classList.add("active");
                    }
                });
            });
        });
    </script>
@endsection
