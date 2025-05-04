@extends('layouts.app')
@section('title', $team->name)
@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="team-profile bg-primary text-white rounded">
                    <div class="card-body p-4">
                        <!-- Team Header -->
                        <div class="team-header mb-4">
                            <div class="d-flex align-items-center">
                                <div class="team-logo me-3">
                                    <img src="{{ asset('teams_imgs/' . $team->logo) }}" alt="{{ $team->name }}"
                                        class="rounded-circle" width="130" height="130">
                                </div>
                                <div>
                                    <h2 class="team-name text-warning">{{ $team->name }}</h2>
                                    <p class="region-text">{{ $team->city }}</p>
                                    @if(auth()->check() && auth()->user()->player && auth()->user()->player->team_id === null)
                                        <form action="{{ route('join-requests.store', $team) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-warning join-team-btn">Join Team</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Navigation Tabs -->
                        <ul class="nav nav-tabs mb-4">
                            <li class="nav-item">
                                <a class="nav-link active" href="#">Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Tournament</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Ligues</a>
                            </li>
                        </ul>

                        <div class="row">
                            <!-- Team Info Section -->
                            <div class="col-md-5">
                                <div class="team-info-box mb-4 p-3 bg-dark rounded">
                                    <h4 class="mb-3">Team Info</h4>
                                    <div class="info-item mb-2">
                                        <p class="mb-1"><strong>Creation Date:</strong>
                                            {{ $team->created_at->format('Y/m/d') }}</p>
                                    </div>
                                    <div class="info-item mb-2">
                                        <p class="mb-1"><strong>City:</strong> {{ $team->city }}</p>
                                    </div>
                                    <div class="info-item">
                                        <p class="mb-1"><strong>Manager:</strong> <span
                                                class="text-warning">{{ $team->captain->first_name }}
                                                {{ $team->captain->last_name }}</span></p>
                                    </div>
                                </div>

                                <!-- Last Matches Section -->
                                <div class="last-matches-box p-3 bg-dark rounded">
                                    <h4 class="mb-3">Last Matches</h4>
                                    <div class="match-result mb-2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="team-with-logo">
                                                <img src="{{ asset('teams_imgs/placeholder.jpg') }}" alt="Team Logo"
                                                    width="40" height="40" class="rounded-circle">
                                                <span>Celta vigo</span>
                                            </div>
                                            <div class="match-score">
                                                <span class="text-white">2 - 1</span>
                                            </div>
                                            <div class="team-with-logo">
                                                <img src="{{ asset('teams_imgs/placeholder.jpg') }}" alt="Team Logo"
                                                    width="40" height="40" class="rounded-circle">
                                                <span>Real Madrid</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button class="btn btn-sm btn-outline-light mt-2">Show more</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Squad Section -->
                            <div class="col-md-7">
                                <div class="squad-box p-3 bg-dark rounded">
                                    <h4 class="mb-3">Squad</h4>
                                    <table class="table table-dark">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Age</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($team->players as $index => $player)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <img src="{{ asset('profiles/' . $player->user->profile_picture) }}"
                                                                alt="{{ $player->user->first_name }}"
                                                                class="rounded-circle me-2" width="30" height="30">
                                                            {{ $player->user->first_name }} {{ $player->user->last_name }}
                                                        </div>
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($player->user->birth_date)->age }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .team-profile {
            border-radius: 10px;
        }

        .team-logo img {
            object-fit: cover;
        }

        .nav-tabs .nav-link {
            color: white;
        }

        .nav-tabs .nav-link.active {
            background-color: transparent;
            border-bottom: 2px solid #ffc107;
            color: #ffc107;
        }

        .team-info-box,
        .squad-box,
        .last-matches-box {
            background-color: rgba(0, 0, 0, 0.2);
        }

        .table {
            color: white;
        }

        .team-with-logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .match-score {
            font-weight: bold;
            font-size: 1.2rem;
        }
    </style>
@endsection