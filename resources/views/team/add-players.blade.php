@extends('layouts.app')
@section('title', 'Add Players to Team')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="bg-primary text-white rounded">
                <div class="card-body p-5">
                    <h2 class="text-center mb-4">Players</h2>

                    <!-- Team Info -->
                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-3">
                            @if($team->logo)
                                <img src="{{ asset('teams_imgs/' . $team->logo) }}" alt="{{ $team['name']}}"
                                    class="rounded me-3" style="width: 60px; height: 60px; object-fit: cover;">
                            @endif
                            <div>
                                <h4 class="m-0">{{ $team['name']}}</h4>
                                <p class="m-0 text-warning">{{ $team->city }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Search Bar - Centered -->
                    <div class="row justify-content-center mb-4">
                        <div class="col-md-6">
                            <form action="{{ route('teams.add-players-form', $team->id) }}" method="GET">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-dark border-secondary text-white"
                                        name="search" id="playerSearch" placeholder="Search players..."
                                        value="{{ $search ?? '' }}">
                                    <button type="submit" class="btn btn-outline-secondary">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Forward Section -->
                    @if($forwards->isNotEmpty())
                        <div class="position-section mb-4">
                            <h5 class="position-header">Forward</h5>
                            <div class="position-row">
                                @foreach($forwards as $player)
                                    <div class="player-card">
                                        <div class="player-image-container">
                                            <img src="{{ asset("profiles/" . $player['avatar'])  }}" class="player-image"
                                                alt="{{ $player['name']}}">
                                        </div>
                                        <div class="player-name">{{ $player['name']}}</div>
                                        <div class="player-info">
                                            <div class="player-position text-danger">F</div>
                                        </div>
                                        <div class="player-info">
                                            <div class="player-age">{{ $player['age'] ?? '' }} yrs</div>
                                            <div class="player-foot ">
                                                <i
                                                    class="fas fa-shoe-prints foot-icon {{ in_array($player['foot'], ['left', 'both']) ? 'foot-active' : '' }}"></i>
                                                <i
                                                    class="fas fa-shoe-prints foot-icon {{ in_array($player['foot'], ['right', 'both']) ? 'foot-active' : '' }}"></i>
                                            </div>
                                        </div>
                                        <div class="card-overlay">
                                            <a href="{{ route('teams.invite', ['team' => $team['id'], 'player' => $player['id']]) }}"
                                                class="invite-btn">
                                                <i class="fas fa-plus"></i>
                                            </a>
                                            <span class="invite-text">Invite</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="pagination-container mt-2 text-center">
                                {{ $forwards->appends(request()->except('forwards_page'))->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    @endif

                    <!-- Midfielder Section -->
                    @if($midfielders->isNotEmpty())
                        <div class="position-section mb-4">
                            <h5 class="position-header text-success">Midfielder</h5>
                            <div class="position-row">
                                @foreach($midfielders as $player)
                                    <div class="player-card">
                                        <div class="player-image-container">
                                            <img src="{{ asset("profiles/" . $player['avatar'])  }}" class="player-image"
                                                alt="{{ $player['name']}}">
                                        </div>
                                        <div class="player-name">{{ $player['name']}}</div>
                                        <div class="player-info">
                                            <div class="player-position text-success">M</div>
                                        </div>
                                        <div class="player-info">
                                            <div class="player-age">{{ $player['age'] ?? '' }} yrs</div>
                                            <div class="player-foot">
                                                <i
                                                    class="fas fa-shoe-prints foot-icon {{ in_array($player['foot'], ['left', 'both']) ? 'foot-active' : '' }}"></i>
                                                <i
                                                    class="fas fa-shoe-prints foot-icon {{ in_array($player['foot'], ['right', 'both']) ? 'foot-active' : '' }}"></i>
                                            </div>
                                        </div>
                                        <div class="card-overlay">
                                            <a href="{{ route('teams.invite', ['team' => $team['id'], 'player' => $player['id']]) }}"
                                                class="invite-btn">
                                                <i class="fas fa-plus"></i>
                                            </a>
                                            <span class="invite-text">Invite</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="pagination-container mt-2 text-center">
                                {{ $midfielders->appends(request()->except('midfielders_page'))->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    @endif

                    <!-- Defender Section -->
                    @if($defenders->isNotEmpty())
                        <div class="position-section mb-4">
                            <h5 class="position-header text-light">Defender</h5>
                            <div class="position-row">
                                @foreach($defenders as $player)
                                    <div class="player-card">
                                        <div class="player-image-container">
                                            <img src="{{ asset("profiles/" . $player['avatar'])  }}" class="player-image"
                                                alt="{{ $player['name']}}">
                                        </div>
                                        <div class="player-name">{{ $player['name']}}</div>
                                        <div class="player-info">
                                            <div class="player-position text-info">D</div>
                                        </div>
                                        <div class="player-info">
                                            <div class="player-age">{{ $player['age'] ?? '' }} yrs</div>
                                            <div class="player-foot">
                                                <i
                                                    class="fas fa-shoe-prints foot-icon {{ in_array($player['foot'], ['left', 'both']) ? 'foot-active' : '' }}"></i>
                                                <i
                                                    class="fas fa-shoe-prints foot-icon {{ in_array($player['foot'], ['right', 'both']) ? 'foot-active' : '' }}"></i>
                                            </div>
                                        </div>
                                        <div class="card-overlay">
                                            <a href="{{ route('teams.invite', ['team' => $team['id'], 'player' => $player['id']]) }}"
                                                class="invite-btn">
                                                <i class="fas fa-plus"></i>
                                            </a>
                                            <span class="invite-text">Invite</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="pagination-container mt-2 text-center">
                                {{ $defenders->appends(request()->except('defenders_page'))->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    @endif

                    <!-- Goalkeeper Section -->
                    @if($goalkeepers->isNotEmpty())
                        <div class="position-section mb-4">
                            <h5 class="position-header text-warning">Goalkeeper</h5>
                            <div class="position-row">
                                @foreach($goalkeepers as $player)
                                    <div class="player-card">
                                        <div class="player-image-container">
                                            <img src="{{ asset("profiles/" . $player['avatar'])  }}" class="player-image"
                                                alt="{{ $player['name']}}">
                                        </div>
                                        <div class="player-name">{{ $player['name']}}</div>
                                        <div class="player-info">
                                            <div class="player-position text-warning">G</div>
                                        </div>
                                        <div class="player-info">
                                            <div class="player-age">{{ $player['age'] ?? '' }} yrs</div>
                                            <div class="player-foot">
                                                <i
                                                    class="fas fa-shoe-prints foot-icon {{ in_array($player['foot'], ['left', 'both']) ? 'foot-active' : '' }}"></i>
                                                <i
                                                    class="fas fa-shoe-prints foot-icon {{ in_array($player['foot'], ['right', 'both']) ? 'foot-active' : '' }}"></i>
                                            </div>
                                        </div>
                                        <div class="card-overlay">
                                            <a href="{{ route('teams.invite', ['team' => $team['id'], 'player' => $player['id']]) }}"
                                                class="invite-btn">
                                                <i class="fas fa-plus"></i>
                                            </a>
                                            <span class="invite-text">Invite</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="pagination-container mt-2 text-center">
                                {{ $goalkeepers->appends(request()->except('goalkeepers_page'))->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    @endif

                    @if($forwards->isEmpty() && $midfielders->isEmpty() && $defenders->isEmpty() && $goalkeepers->isEmpty())
                        <div class="alert alert-info">
                            No players found matching your criteria.
                        </div>
                    @endif

                    <!-- Invited Players Section -->
                    <div id="selectedPlayers" class="mb-4 mt-5">
                        <h5 class="mb-3">Invited Players:</h5>
                        <div class="list-group bg-transparent">
                            @if(count($invitedPlayers) > 0)
                                @foreach($invitedPlayers as $player)
                                    <div
                                        class="list-group-item player-item d-flex justify-content-between align-items-center text-white">
                                        <span>{{ $player['name']}}</span>
                                        <a href="{{ route('teams.cancel-invite', ['invitation' => $player->invitation_id]) }}"
                                            class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-muted">No players invited yet</p>
                            @endif
                        </div>
                    </div>

                    <div class="text-end mt-4">
                        <a href="{{ route('teams.show', $team['id']) }}" class="btn btn-success px-4">Done</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Keep all your existing styles */

    /* Add pagination styling */
    .pagination-container {
        margin-top: 1rem;
    }

    .pagination {
        display: inline-flex;
        background-color: rgba(0, 0, 0, 0.3);
        border-radius: 20px;
        padding: 0.25rem;
    }

    .page-link {
        color: white;
        background-color: transparent;
        border: none;
        padding: 0.25rem 0.75rem;
        border-radius: 15px;
        margin: 0 0.1rem;
    }

    .page-link:hover {
        background-color: rgba(255, 255, 255, 0.1);
        color: white;
    }

    .page-item.active .page-link {
        background-color: #3498db;
        border-color: #3498db;
        color: white;
    }

    .page-item.disabled .page-link {
        color: #6c757d;
        background-color: transparent;
    }

    .player-item {
        background-color: rgba(0, 0, 0, 0.2);
        border: none;
        margin-bottom: 5px;
    }

    .position-header {
        color: #dc3545;
        font-weight: bold;
        margin: 1.5rem 0 1rem;
    }

    .position-row {
        display: flex;
        overflow-x: auto;
        padding-bottom: 1rem;
        margin-bottom: 1rem;
    }

    .player-card {
        width: 150px;
        background-color: rgba(0, 0, 0, 0.2);
        border-radius: 8px;
        margin-right: 15px;
        position: relative;
        overflow: hidden;
        transition: transform 0.2s ease;
    }

    .player-card:hover {
        transform: translateY(-5px);
    }

    .player-image-container {
        padding: 1rem;
        display: flex;
        justify-content: center;
        position: relative;
    }

    .player-image {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #2c3e50;
    }

    .player-number {
        position: absolute;
        right: 0;
        bottom: 0;
        background-color: #3498db;
        color: white;
        width: 25px;
        height: 25px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 0.8rem;
    }

    .player-name {
        text-align: center;
        font-weight: bold;
        padding: 0.5rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .player-info {
        display: flex;
        justify-content: space-between;
        padding: 0.5rem;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        font-size: 0.8rem;
        color: #aaa;
    }

    .player-position {
        text-transform: uppercase;
        font-weight: bold;
        font-size: 0.7rem;
        color: #4cd137;
    }

    .player-flag img {
        width: 20px;
        height: 15px;
        object-fit: cover;
    }

    .player-foot {
        display: flex;
    }

    .foot-icon {
        margin-left: 2px;
        opacity: 0.5;
    }

    .foot-active {
        opacity: 1;
    }

    /* Card overlay */
    .card-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .player-card:hover .card-overlay {
        opacity: 1;
    }

    .invite-btn {
        background-color: #2ecc71;
        color: white;
        border: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 0.5rem;
        transition: transform 0.2s ease;
        text-decoration: none;
    }

    .invite-btn:hover {
        transform: scale(1.1);
        color: white;
    }

    .invite-text {
        color: white;
        font-weight: bold;
    }

    /* For webkit browsers to hide scrollbar but keep functionality */
    .position-row::-webkit-scrollbar {
        height: 5px;
    }

    .position-row::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.1);
    }

    .position-row::-webkit-scrollbar-thumb {
        background: #3498db;
        border-radius: 5px;
    }
    @media (max-width: 991px) {
        /* Tablet view */
        .position-row {
            flex-wrap: wrap;
            overflow-x: hidden;
        }
        
        .player-card {
            width: 48%;
            margin-right: 2%;
            margin-bottom: 15px;
        }
    }
    
    @media (max-width: 767px) {
    /* Mobile view - switch to list view */
    .position-row {
        flex-direction: column;
        overflow-x: visible;
    }
    
    .player-card {
        width: 100%;
        margin-right: 0;
        margin-bottom: 8px;
        height: auto;
        display: flex;
        align-items: center;
        background-color: #171717;
        padding: 8px 12px;
        border-radius: 4px;
    }
    
    .player-card:hover {
        transform: none;
        background-color: #202020;
    }
    
    .player-image-container {
        padding: 0;
        margin-right: 12px;
        width: 40px;
        height: 40px;
        flex-shrink: 0;
    }
    
    .player-image {
        width: 40px;
        height: 40px;
        border-width: 1px;
    }
    
    /* Hide default player info layout on mobile */
    .player-card > .player-info {
        display: none;
    }
    
    /* Create a mobile-specific content area */
    .player-card > .player-name {
        text-align: left;
        padding: 0;
        margin: 0;
        white-space: normal;
        width: auto;
        flex-grow: 1;
    }
    
    /* Player details on one line */
    .player-card::after {
        content: attr(data-age) " " attr(data-nationality);
        font-size: 0.8rem;
        color: #aaa;
        margin-left: auto;
        white-space: nowrap;
    }
    
    /* Card overlay fixed */
    .card-overlay {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        width: auto;
        height: auto;
        background-color: transparent;
        flex-direction: row;
        opacity: 0; /* Keep it hidden by default */
    }
    
    /* Show overlay on hover/touch */
    .player-card:hover .card-overlay,
    .player-card:focus .card-overlay,
    .player-card:active .card-overlay {
        opacity: 1;
    }
    
    .invite-btn {
        margin-bottom: 0;
    }
    
    .invite-text {
        display: none;
    }
    
    /* Adjust position headers for mobile */
    .position-header {
        margin: 1rem 0 0.5rem;
        font-size: 1rem;
    }
    
    /* Fix pagination for mobile */
    .pagination-container {
        overflow-x: auto;
        padding-bottom: 15px;
    }
    
    .pagination {
        white-space: nowrap;
    }
}

@media (max-width: 767px) {
    .pagination-container {
        overflow-x: auto;
        padding-bottom: 15px;
    }
    
    .pagination {
        white-space: nowrap;
    }
}

</style>