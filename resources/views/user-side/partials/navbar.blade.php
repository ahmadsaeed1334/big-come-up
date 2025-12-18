  {{-- NAVBAR --}}
  <div class="nav-wrap">
      <div class="container">
          <nav class="navbar navbar-expand-lg nav-pill">
              <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}">
                  <span class="brand-logo">
                      {{-- Replace with your logo --}}
                      <img src="{{ asset('assets/images/logo.jpg') }}" alt="Logo">
                  </span>
              </a>

              <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                  <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="mainNav">
                  <ul class="navbar-nav mx-auto align-items-lg-center">
                      <li class="nav-item">
                          <a class="nav-link nav-link-custom" data-nav href="{{ url('/') }}">Home</a>
                      </li>

                      <li class="nav-item dropdown">
                          <a class="nav-link nav-link-custom dropdown-toggle" href="#" role="button"
                              data-bs-toggle="dropdown">
                              Artists
                          </a>
                          <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="#">Top Artists</a></li>
                              <li><a class="dropdown-item" href="#">New Artists</a></li>
                          </ul>
                      </li>

                      <li class="nav-item">
                          <a class="nav-link nav-link-custom" href="#">Competitions</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link nav-link-custom" href="#">Community</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link nav-link-custom" href="#">Shop</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link nav-link-custom" href="#">Sweepstakes</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link nav-link-custom" href="#">Explore</a>
                      </li>
                  </ul>

                  <div class="d-flex align-items-center gap-2 ms-lg-3">
                      <a class="icon-chip text-decoration-none" href="#" aria-label="Search">
                          <i class="bi bi-search"></i>
                      </a>

                      <a class="icon-chip text-decoration-none" href="#" aria-label="Cart">
                          <i class="bi bi-bag"></i>
                          <span class="chip-badge">2</span>
                      </a>

                      <a class="icon-chip text-decoration-none" href="#" aria-label="Profile">
                          <i class="bi bi-person"></i>
                      </a>

                      {{-- Login button (Laravel) --}}
                      @if (Route::has('login'))
                          @auth
                              <a class="btn btn-login ms-lg-2" href="{{ url('/dashboard') }}">
                                  Dashboard <span class="ms-1">→</span>
                              </a>
                          @else
                              <a class="btn btn-login ms-lg-2" href="{{ route('login') }}">
                                  <span class="btn-text">Login To My Account</span>
                                  <span class="nav-arrow">→</span>
                              </a>


                          @endauth
                      @endif
                  </div>
              </div>
          </nav>
      </div>
  </div>
