@extends('layouts.app')
@section('title', 'Teams')
@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <!-- Teams Section -->
                <div class="bg-primary text-white rounded">
                    <div class="card-body p-4">
                        <h2 class="text-center mb-4">Teams</h2>

                        <!-- Search Bar -->
                        <div class="row justify-content-center mb-4">
                            <div class="col-md-6">
                                <form action="{{ route('teams.index') }}" method="GET">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-dark border-secondary text-white"
                                            name="search" placeholder="Search teams..." value="{{ request('search') }}">
                                        <button type="submit" class="btn btn-outline-secondary">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Teams Grid -->
                        <div class="row">
                            @forelse($teams as $team)
                                <div class="col-md-4 mb-4">
                                    <div class="team-card p-3 bg-dark rounded">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="team-logo me-3">
                                                <img src="{{ asset('teams_imgs/' . $team->logo) }}" alt="{{ $team->name }}"
                                                    class="rounded-circle" width="60" height="60">
                                            </div>
                                            <div>
                                                <h5 class="team-name m-0">{{ $team->name }}</h5>
                                                <small class="text-muted">{{ $team->city }}</small>
                                            </div>
                                        </div>
                                        <div class="team-stats mb-3">
                                            <div class="d-flex justify-content-between">
                                                <div class="stat-item text-center">
                                                    <div class="stat-value">{{ $team->wins ?? 0 }}</div>
                                                    <div class="stat-label">Wins</div>
                                                </div>
                                                <div class="stat-item text-center">
                                                    <div class="stat-value">{{ $team->losses ?? 0 }}</div>
                                                    <div class="stat-label">Losses</div>
                                                </div>
                                                <div class="stat-item text-center">
                                                    <div class="stat-value">{{ $team->draws ?? 0 }}</div>
                                                    <div class="stat-label">Draws</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="team-actions text-center">
                                            <a href="{{ route('teams.show', $team) }}"
                                                class="btn btn-outline-light btn-sm me-2">View Profile</a>
                                            @if(auth()->check() && auth()->user()->player && auth()->user()->player->team_id === null)
                                                <form action="{{ route('join-requests.store', $team) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-warning btn-sm">Request to Join</button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 text-center">
                                    <p>No teams found.</p>
                                </div>
                            @endforelse
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $teams->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .team-card {
            transition: transform 0.2s;
        }

        .team-card:hover {
            transform: translateY(-5px);
        }

        .team-logo img {
            object-fit: cover;
        }

        .stat-value {
            font-size: 1.2rem;
            font-weight: bold;
        }

        .stat-label {
            font-size: 0.8rem;
            opacity: 0.7;
        }
    </style>
@endsection