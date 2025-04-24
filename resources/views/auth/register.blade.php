@extends('layouts.app')
@section('title', 'Register')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        @session('error')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endsession
        <div class="col-md-8">
            <div class="bg-primary card text-white">
                <div class="card-body p-5">
                    <h1 class="text-center mb-4">Sign Up</h1>
                    
                    <form method="POST" action="{{ route('register.post') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="username">Username <span class="text-danger">*</span></label>
                                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username">
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="first_name">First name <span class="text-danger">*</span></label>
                                    <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name">
                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="last_name">Last name <span class="text-danger">*</span></label>
                                    <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name">
                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="email">Email <span class="text-danger">*</span></label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="password">Password <span class="text-danger">*</span></label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    <small class="form-text text-warning">Password must be at least 8 characters long , alphanumeric , and special
                                        characters:  !@#$%^&*()_\-+:;=,.?   </small>
                                    </small>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="password_confirmation">Password Confiramtion <span class="text-danger">*</span></label>
                                    <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">
                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="birth_date">Birth date <span class="text-danger">*</span></label>
                                    <input id="birth_date" type="date" class="form-control @error('birth_date') is-invalid @enderror" name="birth_date" value="{{ old('birth_date') }}" required>
                                    @error('birth_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <label for="profile_picture">Profile Picture</label>
                            <input id="profile_picture" accept="image/jpg,image/jpeg,image/png,image/webp,image/tiff" type="file" class="form-control @error('profile_picture') is-invalid @enderror" name="profile_picture">
                
                            <small class="form-text text-warning">Max file size: 2MB</small>
                            <small class="form-text text-warning">Allowed formats: jpg, jpeg, png, webp, tiff</small>
                            @error('profile_picture')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-warning px-5">
                                    Submit
                                </button>
                            </div>
                        </div>
                        
                        <div class="text-center mt-3">
                            <p class="small mb-0">
                                By accepting tapping Submit your are accepting our 
                                <a href="{{ route('home') }}">terms and conditions</a>. Learn more about 
                                our <a href="{{ route('home') }}">User agreement</a> and <a href="{{ route('home') }}">Privacy Policy</a>.
                            </p>
                            <p class="mt-3">
                                I have an account? <a href="{{ route('login') }}">Connection</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection