@extends('layouts.app')
@section('title', 'Create Player')

@section('content')
<!-- Create Player Form -->
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
                    <h1 class="text-center mb-4">Be a Player</h1>
                    
                    <form method="POST" action={{ route('players.store') }} >
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="username">Username <span class="text-danger">*</span></label>
                                    <input id="username" type="text" class="form-control-plaintext text-info" name="username" value="{{ $user['username'] }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="first_name">First name <span class="text-danger">*</span></label>
                                    <input id="first_name" type="text" class="form-control-plaintext text-info" name="first_name" value="{{ $user['first_name'] }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="last_name">Last name <span class="text-danger">*</span></label>
                                    <input id="last_name" type="text" class="form-control-plaintext text-info" name="last_name" value="{{ $user['last_name'] }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="position">
                                        <i class="fas fa-running me-1"></i> Position <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select" name="position" id="position">
                                        <option value="goalkeeper">Goalkeeper</option>
                                        <option value="defender"> Defender</option>
                                        <option value="midfielder">Midfielder</option>
                                        <option value="striker"> Striker</option>
                                    </select>
                                    @error('position')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="foot">
                                        <i class="fas fa-shoe-prints me-1"></i> Preferred Foot <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select" name="foot" id="foot">
                                        <option value="both">Both</option>
                                        <option value="right"> Right</option>
                                        <option value="left"> Left</option>
                                    </select>
                                </div>
                                @error('foot')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>                
                        <div class="row mb-3">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-warning px-5">
                                    Start the Journey
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection