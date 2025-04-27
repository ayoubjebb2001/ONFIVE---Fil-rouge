<header>
    <nav class="bg-primary navbar navbar-expand-lg navbar-light pr-3 pl-3">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('assets/images/ONFIVE.png') }}" width="100" class="img-fluid" alt="logo">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03"
                aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
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
                    <div
                        class="container-fluid d-flex gap-0 column-gap-3 flex-lg-row flex-column ms-auto justify-content-center align-items-center right-nav">
                        <a href="{{ route('register') }}"
                            class="btn btn-outline-light btn-sm px-4 me-2 d-flex align-items-center mb-auto">
                            <i class="fas fa-user-plus me-2"></i>
                            <span>Sign Up</span>
                        </a>

                        <a href="{{ route('login') }}"
                            class="btn btn-warning btn-sm px-3 d-flex align-items-center mt-auto">
                            <i class="fas fa-sign-in-alt me-2"></i><span>Login</span>
                        </a>
                    </div>
                @endguest
                @auth
                    <ul class="navbar-nav ms-auto">
                        <!-- Notification dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset('profiles/'.$user['profile_picture'] ) }}"
                                    class="rounded-circle" height="30" alt="Profile picture" loading="lazy">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="#">My profile</a></li>
                                <li><a class="dropdown-item" href="#">Settings</a></li>

                                <li>
                                    <hr class="dropdown-divider">
                                    <form action="{{ route('logout') }}" method="POST" class="dropdown-item">
                                        @csrf
                                        <button type="submit" class="btn btn-link text-decoration-none">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                @endauth
            </div>
        </div>
    </nav>
</header>