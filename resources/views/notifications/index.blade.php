@extends('layouts.app')

@section('title', 'Notifications')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card bg-dark text-white">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">All Notifications</h5>
                        @if(auth()->user()->unreadNotifications->count() > 0)
                            <form action="{{ route('notifications.mark-all-read') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-primary">Mark all as read</button>
                            </form>
                        @endif
                    </div>
                    <div class="card-body">
                        @if(($notifications = auth()->user()->notifications)->count() > 0)
                            <div class="list-group">
                                @foreach($notifications as $notification)
                                    <div class="list-group-item notification-item {{ $notification->read_at ? 'bg-dark text-white' : 'bg-dark text-white fw-bold' }} border-secondary mb-2"
                                        data-id="{{ $notification->id }}" @if(isset($notification->data['team_invitation_id']))
                                        data-team-invitation-id="{{ $notification->data['team_invitation_id'] }}" @endif>
                                        <div class="d-flex align-items-center">
                                            @if(isset($notification->data['team_logo']))
                                                <img src="{{ asset('teams_imgs/' . $notification->data['team_logo']) }}" alt="Team Logo"
                                                    class="rounded-circle me-3" width="50" height="50">
                                            @elseif(isset($notification->data['user_profile_picture']))
                                                <img src="{{ asset('profiles/' . $notification->data['user_profile_picture']) }}"
                                                    alt="User Profile" class="rounded-circle me-3" width="50" height="50">
                                            @else
                                                <div class="rounded-circle bg-primary me-3 d-flex align-items-center justify-content-center"
                                                    style="width: 50px; height: 50px;">
                                                    <i class="fas fa-users text-white"></i>
                                                </div>
                                            @endif
                                            <div class="flex-grow-1">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h6 class="mb-0">
                                                        {{ isset($notification->data['team_name']) ? $notification->data['team_name'] : (isset($notification->data['user_name']) ? $notification->data['user_name'] : 'System Notification') }}
                                                    </h6>
                                                    <small
                                                        class="text-muted">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</small>
                                                </div>

                                                {{-- Display appropriate message based on notification type --}}
                                                <p class="mb-0 mt-1">
                                                    @if(isset($notification->data['type']))
                                                        @if($notification->data['type'] == 'team_to_player')
                                                            You've been invited to join {{ $notification->data['team_name'] }}
                                                        @elseif($notification->data['type'] == 'join_request')
                                                            {{ $notification->data['user_name'] }} has requested to join
                                                            {{ $notification->data['team_name'] }}
                                                        @else
                                                            {{ $notification->data['message'] }}
                                                        @endif
                                                    @else
                                                        {{ $notification->data['message'] }}
                                                    @endif
                                                </p>

                                                @if(!$notification->read_at)
                                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                                        <form action="{{ route('notifications.read', $notification->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-outline-secondary">Mark as
                                                                read</button>
                                                        </form>

                                                        @if(isset($notification->data['type']) && $notification->data['type'] == 'team_to_player')
                                                            <div>
                                                                <form
                                                                    action="{{ route('team-invitations.accept', $notification->data['team_invitation_id']) }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-sm btn-success">Accept</button>
                                                                </form>
                                                                <form
                                                                    action="{{ route('team-invitations.decline', $notification->data['team_invitation_id']) }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-sm btn-danger">Decline</button>
                                                                </form>
                                                            </div>
                                                        @elseif(isset($notification->data['type']) && $notification->data['type'] == 'join_request')
                                                            <div>
                                                                <form
                                                                    action="{{ route('join-requests.accept', $notification->data['id']) }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-sm btn-success">Accept</button>
                                                                </form>
                                                                <form
                                                                    action="{{ route('join-requests.decline', $notification->data['id']) }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-sm btn-danger">Decline</button>
                                                                </form>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-bell fa-4x mb-4 text-muted"></i>
                                <h5>No notifications yet</h5>
                                <p class="text-muted">We'll let you know when something new comes up.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection