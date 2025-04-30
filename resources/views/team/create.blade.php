@extends('layouts.app')
@section('title', 'Create Team')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="bg-primary text-white rounded">
                <div class="card-body p-5">
                    <h2 class="text-center mb-4">Team creation</h2>
                    
                    <!-- Team Creation Progress -->
                    <div class="d-flex mb-4">
                        <div class="flex-fill text-center py-2 border-bottom tab-active">Info</div>
                        <div class="flex-fill text-center py-2 border-bottom">Players</div>
                    </div>
                    
                    <form action="{{ route('teams.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="text-center mb-4">
                            <p>Upload the image of your team here.<br>require(300*300),Max 5mb</p>
                            <div class="mb-3">
                                <label for="logo" class="btn btn-warning">Select file</label>
                                <input type="file" name="logo" id="logo" class="d-none" accept="image/* @error('logo') is-invalid @enderror" required>
                                <div id="logoPreview" class="mt-2"></div>
                            </div>
                            @error('logo')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="name" class="mb-1">Name :</label>
                            <input type="text" class="form-control bg-transparent text-white" @error('name') is-invalid @enderror id="name" name="name" placeholder="Name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="city" class="mb-1">City :</label>
                            <input type="text" class="form-control bg-transparent text-white" @error('city') is-invalid @enderror id="city" name="city" placeholder="City" required value="{{ old('city') }}">
                            @error('city')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-dark px-4">NEXT</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .tab-active {
        border-bottom: 3px solid #ffc107 !important;
        font-weight: bold;
    }
    
    #logoPreview img {
        max-width: 150px;
        max-height: 150px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Logo preview
        document.getElementById('logo').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('logoPreview').innerHTML = `<img src="${e.target.result}" class="img-fluid rounded">`;
                }
                reader.readAsDataURL(file);
            }
        });
    });
</script>
@endsection