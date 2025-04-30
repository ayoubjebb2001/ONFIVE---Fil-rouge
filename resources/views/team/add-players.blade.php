@extends('layouts.app')
@section('title', 'Add Players to Team')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="bg-primary text-white rounded">
                <div class="card-body p-5">
                    <h2 class="text-center mb-4">Add Players</h2>
                    
                    <!-- Team Creation Progress -->
                    <div class="d-flex mb-4">
                        <div class="flex-fill text-center py-2 border-bottom">Info</div>
                        <div class="flex-fill text-center py-2 border-bottom tab-active">Players</div>
                    </div>
                    
                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-3">
                            @if($team->logo)
                                <img src="{{ asset('teams_imgs/' . $team->logo) }}" alt="{{ $team->name }}" class="rounded me-3" style="width: 60px; height: 60px; object-fit: cover;">
                            @endif
                            <div>
                                <h4 class="m-0">{{ $team->name }}</h4>
                                <p class="m-0 text-warning">{{ $team->city }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <form action="{{ route('teams.add-players', $team->id) }}" method="POST" id="addPlayersForm">
                        @csrf
                        
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="flex-grow-1 me-2">
                                    <input type="text" class="form-control bg-transparent text-white" id="playerSearch" placeholder="Search players...">
                                </div>
                                <button type="button" id="searchPlayersBtn" class="btn btn-outline-light">Search</button>
                            </div>
                        </div>
                        
                        <div id="playersResults" class="mb-4">
                            <!-- Search results will appear here -->
                        </div>
                        
                        <div id="selectedPlayers" class="mb-4">
                            <h5 class="mb-3">Selected Players:</h5>
                            <div id="selectedPlayersList" class="list-group bg-transparent">
                                <!-- Players will be added here -->
                                @if(isset($existingPlayers) && count($existingPlayers) > 0)
                                    @foreach($existingPlayers as $player)
                                        <div class="list-group-item player-item d-flex justify-content-between align-items-center text-white">
                                            <span>{{ $player->name }}</span>
                                            <input type="hidden" name="selected_players[]" value="{{ $player->id }}">
                                            <button type="button" class="btn btn-sm btn-outline-danger remove-player">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-success px-4">Done</button>
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
    
    .player-item {
        background-color: rgba(0, 0, 0, 0.2);
        border: none;
        margin-bottom: 5px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Player search
        document.getElementById('searchPlayersBtn').addEventListener('click', function() {
            const query = document.getElementById('playerSearch').value;
            if (query.trim() !== '') {
                fetchPlayers(query);
            }
        });
        
        // Also trigger search on Enter key
        document.getElementById('playerSearch').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                document.getElementById('searchPlayersBtn').click();
            }
        });
        
        function fetchPlayers(query) {
            // Replace with your actual API endpoint
            fetch(`/api/search-users?query=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    displaySearchResults(data);
                })
                .catch(error => console.error('Error searching for players:', error));
        }
        
        function displaySearchResults(players) {
            const resultsContainer = document.getElementById('playersResults');
            resultsContainer.innerHTML = '';
            
            if (players.length === 0) {
                resultsContainer.innerHTML = '<div class="alert alert-info">No players found</div>';
                return;
            }
            
            const listGroup = document.createElement('div');
            listGroup.className = 'list-group bg-transparent';
            
            players.forEach(player => {
                const item = document.createElement('div');
                item.className = 'list-group-item player-item d-flex justify-content-between align-items-center text-white';
                item.innerHTML = `
                    <div>
                        <img src="${player.avatar || '/images/default-avatar.png'}" class="rounded-circle" width="30" height="30">
                        <span class="ms-2">${player.name}</span>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-success add-player" data-id="${player.id}" data-name="${player.name}">
                        <i class="fas fa-plus"></i>
                    </button>
                `;
                listGroup.appendChild(item);
            });
            
            resultsContainer.appendChild(listGroup);
            
            // Add event listeners to add buttons
            document.querySelectorAll('.add-player').forEach(btn => {
                btn.addEventListener('click', function() {
                    const playerId = this.getAttribute('data-id');
                    const playerName = this.getAttribute('data-name');
                    addPlayerToSelection(playerId, playerName);
                });
            });
        }
        
        function addPlayerToSelection(id, name) {
            // Check if player already selected
            if (document.querySelector(`#selectedPlayersList input[value="${id}"]`)) {
                return; // Player already added
            }
            
            const playerItem = document.createElement('div');
            playerItem.className = 'list-group-item player-item d-flex justify-content-between align-items-center text-white';
            playerItem.innerHTML = `
                <span>${name}</span>
                <input type="hidden" name="selected_players[]" value="${id}">
                <button type="button" class="btn btn-sm btn-outline-danger remove-player">
                    <i class="fas fa-times"></i>
                </button>
            `;
            
            document.getElementById('selectedPlayersList').appendChild(playerItem);
            
            // Add remove event listener
            playerItem.querySelector('.remove-player').addEventListener('click', function() {
                playerItem.remove();
            });
        }
        
        // Add event listeners to existing remove buttons
        document.querySelectorAll('.remove-player').forEach(btn => {
            btn.addEventListener('click', function() {
                this.closest('.list-group-item').remove();
            });
        });
    });
</script>
@endsection