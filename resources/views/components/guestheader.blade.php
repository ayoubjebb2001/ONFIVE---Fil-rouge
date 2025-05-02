<header>
    <nav class="bg-primary navbar navbar-expand-lg navbar-light">
        <div class="container d-flex justify-content-between align-items-center">
            <!-- Section 1: Logo and mobile toggler -->
            <div class="d-flex align-items-center">
                <!-- Toggler only visible on mobile -->
                <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="offcanvas" 
                    data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon text-white"></span>
                </button>

                <!-- Brand logo -->
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('assets/images/ONFIVE.png') }}" width="100" class="img-fluid" alt="logo">
                </a>
            </div>
            
            <!-- Section 2: Navigation links (centered) -->
            <div class="collapse navbar-collapse flex-grow-0" id="navbarTogglerDemo03">
                <ul class="navbar-nav">
                    <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                        <a class="nav-link text-white" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item {{ Request::is('competitions*') ? 'active' : '' }}">
                        <a class="nav-link text-white" href="#">Competitions</a>
                    </li>
                    <li class="nav-item {{ Request::is('matches*') ? 'active' : '' }}">
                        <a class="nav-link text-white" href="#">Matches</a>
                    </li>
                    <li class="nav-item {{ Request::is('rankings*') ? 'active' : '' }}">
                        <a class="nav-link text-white" href="#">Rankings</a>
                    </li>
                    <li class="nav-item {{ Request::is('help*') ? 'active' : '' }}">
                        <a class="nav-link text-white" href="#">Help</a>
                    </li>
                </ul>
            </div>

            <!-- Section 3: User profile section (right) -->
            <div class="d-flex align-items-center">
                    <div class="d-flex gap-2">
                        <a href="{{ route('register') }}"
                            class="btn btn-outline-light btn-sm px-4 d-flex align-items-center">
                            <i class="d-sm-inline d-md-none d-lg-inline fas fa-user-plus me-2"></i>
                            <span class="d-none d-md-inline">Sign Up</span>
                        </a>

                        <a href="{{ route('login') }}" class="btn btn-warning btn-sm px-3 d-flex align-items-center">
                            <i class="fas fa-sign-in-alt me-2 d-sm-inline d-md-none d-lg-inline"></i>
                            <span class="d-none d-md-inline">Login</span>
                        </a>
                    </div>
            </div>
        </div>
    </nav>
    
    <!-- Off-canvas sidebar menu for mobile -->
    <div class="offcanvas offcanvas-start bg-primary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title text-white" id="sidebarMenuLabel">Menu</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="navbar-nav">
                <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                    <a class="nav-link text-white" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item {{ Request::is('competitions*') ? 'active' : '' }}">
                    <a class="nav-link text-white" href="#">Competitions</a>
                </li>
                <li class="nav-item {{ Request::is('matches*') ? 'active' : '' }}">
                    <a class="nav-link text-white" href="#">Matches</a>
                </li>
                <li class="nav-item {{ Request::is('rankings*') ? 'active' : '' }}">
                    <a class="nav-link text-white" href="#">Rankings</a>
                </li>
                <li class="nav-item {{ Request::is('help*') ? 'active' : '' }}">
                    <a class="nav-link text-white" href="#">Help</a>
                </li>
            </ul>
        </div>
    </div>
</header>