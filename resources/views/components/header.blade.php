<header>
    <nav class="bg-primary navbar navbar-expand-lg navbar-light pr-3 pl-3">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('assets/images/ONFIVE.png') }}" width="100" class="img-fluid" alt="logo">
            </a>
    
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <div class="container d-flex justify-content-between">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
                    <ul class="navbar-nav navbar-links me-auto mb-2 mb-lg-0">
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

                <!-- Sign Up button -->
                @guest
                <div class="d-flex ms-auto">
                    <a href="{{ route('home') }}" class="btn btn-outline-light me-2">
                        <i class="fas fa-user-plus me-1"></i> Sign Up
                    </a>
                    <a href="{{ route('home') }}" class="btn btn-warning">
                        <i class="fas fa-sign-in-alt me-1"></i> Login
                    </a>
                </div>
                @endguest
                @auth
                <ul class="navbar-nav ms-auto">
                    <!-- Notification dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-bell"></i>
                            <span class="badge rounded-pill badge-notification bg-danger">1</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="#">Some news</a></li>
                            <li><a class="dropdown-item" href="#">Another news</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <!-- Avatar dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(31).webp" class="rounded-circle" height="22" alt="Portrait of a Woman" loading="lazy">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="#">My profile</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><a class="dropdown-item" href="#">Logout</a></li>
                        </ul>
                    </li>
                </ul> 
                @endauth
            </div>
        </div>
    </nav>
</header>