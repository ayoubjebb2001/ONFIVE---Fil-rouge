@extends('layouts.app')

@section('content')

@session('logout_success')
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> You have been logged out successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endsession

@session('login_success')
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> You have been logged in successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endsession
@session('info')
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <strong>Info!</strong> {{ session('info') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endsession
<div class="container p-4">
    <div class="row my-2">
        <div class="col-xl-9 col-lg-8 col-md-12 my-2 enroll-card p-2 text-center shadow">
            <!-- Large screens (lg and up) - 3 columns layout -->
            <div class="row d-none d-lg-flex align-items-center justify-content-center">
                <div class="col-xl-2 col-lg-3 d-flex align-items-center justify-content-center">
                    <div class="d-flex align-items-center">
                        <img loading="eager" src="{{ asset('assets/images/ONFIVE.png') }}" class="img-fluid mb-2"
                            width="100px" alt="logo">
                        <span class="badge bg-primary ms-2">STAFF</span>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-6 d-flex align-items-center justify-content-center">
                    <p class="text-center m-2">Host matches, save their data and much more ...</p>
                </div>
                <div class="col-xl-2 col-lg-3 d-flex align-items-center justify-content-center">
                    <a href="" class="action-btn">Enroll</a>
                </div>
            </div>
            
            <!-- Medium screens (md) - 2 columns layout with grid -->
            <div class="d-none d-md-grid d-lg-none" style="display: grid; grid-template-columns: auto 1fr; gap: 10px;">
                <div class="d-flex flex-column align-items-center justify-content-center" style="grid-row: span 2;">
                    <img loading="eager" src="{{ asset('assets/images/ONFIVE.png') }}" class="img-fluid mb-2"
                        width="100px" alt="logo">
                    <span class="badge bg-primary">STAFF</span>
                </div>
                <div class="d-flex align-items-center justify-content-center">
                    <p class="text-center m-2">Host matches, save their data and much more ...</p>
                </div>
                <div class="d-flex align-items-center justify-content-center">
                    <a href="" class="action-btn">Enroll</a>
                </div>
            </div>
            
            <!-- Small screens and below (sm and xs) - 3 rows layout -->
            <div class="row d-md-none align-items-center justify-content-center">
                <div class="col-12 d-flex flex-column align-items-center justify-content-center">
                    <div class="d-flex flex-column align-items-center">
                        <img loading="eager" src="{{ asset('assets/images/ONFIVE.png') }}" class="img-fluid mb-2"
                            width="100px" alt="logo">
                        <span class="badge bg-primary">STAFF</span>
                    </div>
                </div>
                <div class="col-12 d-flex align-items-center justify-content-center mt-2">
                    <p class="text-center m-2">Host matches, save their data and much more ...</p>
                </div>
                <div class="col-12 d-flex align-items-center justify-content-center mt-2">
                    <a href="" class="action-btn">Enroll</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-4 col-md-12 my-2 d-flex align-items-center justify-content-center shadow">
            @guest
                <a href={{ route('login') }}
                    class="btn play-btn text-center btn-lg d-flex align-items-center justify-content-center w-100">
                    <h1>PLAY</h1>
                </a>
            @endguest
            @php
                $todo = false;
            @endphp

            @auth
                @if($user->role == "user")
                    <a href={{ route('players.create') }}
                        class="btn play-btn text-center d-flex align-items-center justify-content-center">
                        <h1>Be a Player</h1>
                    </a>
                @endif
            @endauth
        </div>
    </div>

    <div class="row my-2">
        <div class="col-xl-9 my-2 px-4">
            <div class="row">
                <div class="col-xl-12 my-2 p-4 bg-primary text-white shadow border-radius">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-xl-2 my-2">
                            <img loading="eager" src="{{ asset('assets/images/Tournament.png') }}" width="100"
                                height="100px" class="img-fluid" alt="">
                        </div>
                        <div class="col-xl-3 my-2">
                            <h4 class="mb-2 h4">Cih Tournament</h4>
                            <div class="">
                                <span class="badge" style="background-color: #FF8000;">Registration In Progress</span>
                            </div>
                        </div>
                        <div class="col-xl my-2">
                            <h6 class="h6">Start:</h6>
                            <p style="font-size: 12px;">Today at 20.00</p>
                        </div>
                        <div class="col-xl my-2">
                            <h6 class="h6">Category:</h6>
                            <p style="font-size: 12px;">U17</p>
                        </div>
                        <div class="col-xl my-2">
                            <h6 class="h6">Participants:</h6>
                            <p style="font-size: 12px;">14/16</p>
                        </div>
                        <div class="col-xl my-2">
                            <h6 class="h6">Region:</h6>
                            <p style="font-size: 12px;">Errachidia</p>
                        </div>
                        <div class="col-xl my-2">
                            <h6 class="h6">Prize:</h6>
                            <p style="font-size: 12px;">2000MAD</p>
                        </div>
                    </div>

                </div>
                <div class="col-xl-12 my-2 p-4 bg-primary text-white shadow border-radius">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-xl-2 my-2">
                            <img loading="lazy" src="{{ asset('assets/images/Tournament.png') }}" width="100"
                                height="100px" class="img-fluid" alt="">
                        </div>
                        <div class="col-xl-3 my-2">
                            <h4 class="mb-2 h4">Cih Tournament</h4>
                            <div class="">
                                <span class="badge" style="background-color: #FF8000;">Registration In Progress</span>
                            </div>
                        </div>
                        <div class="col-xl my-2">
                            <h6 class="h6">Start:</h6>
                            <p style="font-size: 12px;">Today at 20.00</p>
                        </div>
                        <div class="col-xl my-2">
                            <h6 class="h6">Category:</h6>
                            <p style="font-size: 12px;">U17</p>
                        </div>
                        <div class="col-xl my-2">
                            <h6 class="h6">Participants:</h6>
                            <p style="font-size: 12px;">14/16</p>
                        </div>
                        <div class="col-xl my-2">
                            <h6 class="h6">Region:</h6>
                            <p style="font-size: 12px;">Errachidia</p>
                        </div>
                        <div class="col-xl my-2">
                            <h6 class="h6">Prize:</h6>
                            <p style="font-size: 12px;">2000MAD</p>
                        </div>
                    </div>

                </div>
                <div class="col-xl-12 my-2 p-4 bg-primary text-white shadow border-radius">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-xl-2 my-2">
                            <img src="{{ asset('assets/images/Tournament.png') }}" width="100" height="100px"
                                class="img-fluid" alt="">
                        </div>
                        <div class="col-xl-3 my-2">
                            <h4 class="mb-2 h4">Cih Tournament</h4>
                            <div class="">
                                <span class="badge" style="background-color: #FF8000;">Registration In Progress</span>
                            </div>
                        </div>
                        <div class="col-xl my-2">
                            <h6 class="h6">Start:</h6>
                            <p style="font-size: 12px;">Today at 20.00</p>
                        </div>
                        <div class="col-xl my-2">
                            <h6 class="h6">Category:</h6>
                            <p style="font-size: 12px;">U17</p>
                        </div>
                        <div class="col-xl my-2">
                            <h6 class="h6">Participants:</h6>
                            <p style="font-size: 12px;">14/16</p>
                        </div>
                        <div class="col-xl my-2">
                            <h6 class="h6">Region:</h6>
                            <p style="font-size: 12px;">Errachidia</p>
                        </div>
                        <div class="col-xl my-2">
                            <h6 class="h6">Prize:</h6>
                            <p style="font-size: 12px;">2000MAD</p>
                        </div>
                    </div>

                </div>
                <div class="col-xl-12 my-2 p-4 bg-primary text-white shadow border-radius">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-xl-2 my-2">
                            <img loading="lazy" src="{{ asset('assets/images/Tournament.png') }}" height="100px"
                                width="100" class="img-fluid" alt="">
                        </div>
                        <div class="col-xl-3 my-2">
                            <h4 class="mb-2 h4">Cih Tournament</h4>
                            <div class="">
                                <span class="badge" style="background-color: #FF8000;">Registration In Progress</span>
                            </div>
                        </div>
                        <div class="col-xl my-2">
                            <h6 class="h6">Start:</h6>
                            <p style="font-size: 12px;">Today at 20.00</p>
                        </div>
                        <div class="col-xl my-2">
                            <h6 class="h6">Category:</h6>
                            <p style="font-size: 12px;">U17</p>
                        </div>
                        <div class="col-xl my-2">
                            <h6 class="h6">Participants:</h6>
                            <p style="font-size: 12px;">14/16</p>
                        </div>
                        <div class="col-xl my-2">
                            <h6 class="h6">Region:</h6>
                            <p style="font-size: 12px;">Errachidia</p>
                        </div>
                        <div class="col-xl my-2">
                            <h6 class="h6">Prize:</h6>
                            <p style="font-size: 12px;">2000MAD</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-xl-3 my-2 px-4">
            <div class="row my-2">
                <div class="col-xl-12 text-white ">
                    <h4 class="h4">Matches of the week</h4>
                    <div class="row">
                        <div class="col-xl-12 bg-primary py-3 my-2 border-radius shadow ">
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="text-center">
                                    <img loading="lazy" src="{{ asset('assets/images/Real-Madrid-logo.png') }}"
                                        class="img-fluid" width="60" alt="">
                                    <h6>team 1</h6>
                                </div>
                                <H4 class="mx-4">vs </H4>
                                <div class="text-center">
                                    <img loading="lazy" src="{{ asset('assets/images/Real-Madrid-logo.png') }}"
                                        class="img-fluid" width="60" alt="">
                                    <h6>team 2</h6>
                                </div>
                            </div>
                            <div class="text-center" style="font-size: 10px;">
                                <p class="my-0"><b>Saturday 8 Juin</b></p>
                                <p class="my-0">Complexe Elwaha</p>
                                <p class="my-0">20:00</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 bg-primary py-3 my-2 border-radius shadow ">
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="text-center">
                                    <img loading="lazy" src="{{ asset('assets/images/Real-Madrid-logo.png') }}"
                                        class="img-fluid" width="60" alt="">
                                    <h6>team 1</h6>
                                </div>
                                <H4 class="mx-4">vs </H4>
                                <div class="text-center">
                                    <img loading="lazy" src="{{ asset('assets/images/Real-Madrid-logo.png') }}"
                                        class="img-fluid" width="60" alt="">
                                    <h6>team 2</h6>
                                </div>
                            </div>
                            <div class="text-center" style="font-size: 10px;">
                                <p class="my-0"><b>Saturday 8 Juin</b></p>
                                <p class="my-0">Complexe Elwaha</p>
                                <p class="my-0">20:00</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="my-2">
                <img loading="lazy" src="{{ asset('assets/images/inwi-hakimi.png') }}" height="800px" height="600px"
                    class="img-fluid border-radius" alt="">
            </div>
        </div>
    </div>

    @guest
        <div class="row my-2">
            <div class="col-xl-12 my-2 bg-primary border-radius shadow text-white">
                <div class="row my-2 p-5 d-flex align-items-center justify-content-center text-center">
                    <div class="col-xl d-flex align-items-center justify-content-center">
                        <h5 class="text-center">Join our community now and become one of the best.</h5>
                    </div>
                    <div class="col-xl-2 d-flex align-items-center justify-content-center">
                        <a href="{{ route('register') }}" class="btn btn-warning border-radius">Sign up</a>
                    </div>
                </div>
            </div>
        </div>
    @endguest
    @if ($todo)
    @auth
        @if ($user->isTeamCaptain())
            <div class="row my-2">
                <div class="col-xl-12 my-2 bg-primary border-radius shadow text-white">
                    <div class="row my-2 p-5 d-flex align-items-center justify-content-center text-center">
                        <div class="col-xl d-flex align-items-center justify-content-center">
                            <h5 class="text-center">What Are You Waiting ? Register your Team in our Tournaments</h5>
                        </div>
                        <div class="col-xl-2 d-flex align-items-center justify-content-center">
                            <a href="{{ route(name: 'Tournaments') }}" class="btn btn-warning border-radius">LET'S DO IT</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @endif
        <div class="row my-2">
            <div class="col-xl-12 my-2 bg-primary border-radius shadow text-white">
                <div class="row my-2 p-5 d-flex align-items-center justify-content-center text-center">
                    <div class="col-xl d-flex align-items-center justify-content-center">
                        <h5 class="text-center">Join our community now and become one of the best.</h5>
                    </div>
                    <div class="col-xl-2 d-flex align-items-center justify-content-center">
                        <a href="{{ route('register') }}" class="btn btn-warning border-radius">Sign up</a>
                    </div>
                </div>
            </div>
        </div>
    @endauth

    <div class="row my-4">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img loading="lazy" src="https://placehold.co/800x400?text=IMAGE1" class="d-block w-100"
                        alt="Image 1">
                </div>
                <div class="carousel-item">
                    <img loading="lazy" src="https://placehold.co/800x400?text=IMAGE2" class="d-block w-100"
                        alt="Image 2">
                </div>
                <div class="carousel-item">
                    <img loading="lazy" src="https://placehold.co/800x400?text=IMAGE3" class="d-block w-100"
                        alt="Image 3">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

    </div>

    <div class="row my-2">
        <div class="col-xl m-2  p-4 text-white bg-primary shadow border-radius">
            <div class="row">
                <div class="col-xl">
                    <img loading="lazy" src="{{ asset('assets/images/league2 (1).png') }}" class="img-fluid" alt="">
                </div>
                <div class="col-xl p-5">
                    <h1>League 1</h1>
                    <h4>FRMBB</h4>
                </div>
            </div>
            <div class="">
                <table class="table text-white table-borderless">
                    <thead>
                        <tr>
                            <th>Start:</th>
                            <th>Category</th>
                            <th>Participants</th>
                            <th>Region</th>
                            <th>Prize</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Today at 20.00</td>
                            <td>U17</td>
                            <td>14/16</td>
                            <td>Errachidia</td>
                            <td>2000MAD</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="table-responsive">
                <table class="table table-hover text-white">
                    <thead>
                        <tr>
                            <th></th>
                            <th>G</th>
                            <th>W</th>
                            <th>D</th>
                            <th>L</th>
                            <th>P</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><img loading="lazy" src="{{ asset('assets/images/FCB-logo.png') }}" width="50"
                                    class="img-fluid" alt=""></td>
                            <td>10</td>
                            <td>9</td>
                            <td>1</td>
                            <td>0</td>
                            <td>28</td>
                        </tr>
                        <tr>
                            <td><img loading="lazy" src="{{ asset('assets/images/FCB-logo.png') }}" width="50"
                                    class="img-fluid" alt=""></td>
                            <td>10</td>
                            <td>9</td>
                            <td>1</td>
                            <td>0</td>
                            <td>28</td>
                        </tr>
                        <tr>
                            <td><img loading="lazy" src="{{ asset('assets/images/FCB-logo.png') }}" width="50"
                                    class="img-fluid" alt=""></td>
                            <td>10</td>
                            <td>9</td>
                            <td>1</td>
                            <td>0</td>
                            <td>28</td>
                        </tr>
                        <tr>
                            <td><img loading="lazy" src="{{ asset('assets/images/FCB-logo.png') }}" width="50"
                                    class="img-fluid" alt=""></td>
                            <td>10</td>
                            <td>9</td>
                            <td>1</td>
                            <td>0</td>
                            <td>28</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-xl m-2  p-4 text-white bg-primary shadow border-radius">
            <div class="row">
                <div class="col-xl">
                    <img loading="lazy" src="{{ asset('assets/images/league2 (1).png') }}" class="img-fluid" alt="">
                </div>
                <div class="col-xl p-5">
                    <h1>League 1</h1>
                    <h4>FRMBB</h4>
                </div>
            </div>
            <div class="">
                <table class="table text-white table-borderless">
                    <thead>
                        <tr>
                            <th>Start:</th>
                            <th>Category</th>
                            <th>Participants</th>
                            <th>Region</th>
                            <th>Prize</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Today at 20.00</td>
                            <td>U17</td>
                            <td>14/16</td>
                            <td>Errachidia</td>
                            <td>2000MAD</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="table-responsive">
                <table class="table table-hover text-white">
                    <thead>
                        <tr>
                            <th></th>
                            <th>G</th>
                            <th>W</th>
                            <th>D</th>
                            <th>L</th>
                            <th>P</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><img loading="lazy" src="{{ asset('assets/images/FCB-logo.png') }}" width="50"
                                    class="img-fluid" alt=""></td>
                            <td>10</td>
                            <td>9</td>
                            <td>1</td>
                            <td>0</td>
                            <td>28</td>
                        </tr>
                        <tr>
                            <td><img loading="lazy" src="{{ asset('assets/images/FCB-logo.png') }}" width="50"
                                    class="img-fluid" alt=""></td>
                            <td>10</td>
                            <td>9</td>
                            <td>1</td>
                            <td>0</td>
                            <td>28</td>
                        </tr>
                        <tr>
                            <td><img loading="lazy" src="{{ asset('assets/images/FCB-logo.png') }}" width="50"
                                    class="img-fluid" alt=""></td>
                            <td>10</td>
                            <td>9</td>
                            <td>1</td>
                            <td>0</td>
                            <td>28</td>
                        </tr>
                        <tr>
                            <td><img loading="lazy" src="{{ asset('assets/images/FCB-logo.png') }}" width="50"
                                    class="img-fluid" alt=""></td>
                            <td>10</td>
                            <td>9</td>
                            <td>1</td>
                            <td>0</td>
                            <td>28</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row my-4">
        <section class="customer-logos slider">
            <div class="slide"><img loading="lazy" src="{{ asset('assets/images/puma_logo.png') }}" alt="Puma"
                    class="img-fluid brand-logo"></div>
            <div class="slide"><img loading="lazy" src="{{ asset('assets/images/brands/adidas-logo.png') }}"
                    alt="Adidas" class="img-fluid brand-logo"></div>
            <div class="slide"><img loading="lazy" src="{{ asset('assets/images/Nike_Logo.webp') }}" alt="Nike"
                    class="img-fluid brand-logo"></div>
            <div class="slide"><img loading="lazy" src="{{ asset('assets/images/brands/under-armour-logo.png') }}"
                    alt="Under Armour" class="img-fluid brand-logo"></div>
            <div class="slide"><img loading="lazy" src="{{ asset('assets/images/brands/new-balance-logo.png') }}"
                    alt="New Balance" class="img-fluid brand-logo"></div>
            <div class="slide"><img loading="lazy" src="{{ asset('assets/images/brands/reebok-logo.png') }}"
                    alt="Reebok" class="img-fluid brand-logo"></div>
            <div class="slide"><img loading="lazy" src="{{ asset('assets/images/brands/fila-logo.png') }}" alt="Fila"
                    class="img-fluid brand-logo"></div>
            <div class="slide"><img loading="lazy" src="{{ asset('assets/images/brands/asics-logo.png') }}" alt="Asics"
                    class="img-fluid brand-logo"></div>
            <div class="slide"><img loading="lazy" src="{{ asset('assets/images/brands/converse-logo.png') }}"
                    alt="Converse" class="img-fluid brand-logo"></div>
            <div class="slide"><img loading="lazy" src="{{ asset('assets/images/brands/vans-logo.png') }}" alt="Vans"
                    class="img-fluid brand-logo"></div>
        </section>

    </div>
    @endsection