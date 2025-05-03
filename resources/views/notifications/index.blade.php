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
                            <button class="btn btn-sm btn-outline-primary mark-all-read">Mark all as read</button>
                        @endif
                    </div>
                    <div class="card-body">
                        @if(count($notifications = auth()->user()->notifications) > 0)
                            <div class="list-group">
                                @foreach($notifications as $notification)
                                    <div class="list-group-item notification-item {{ $notification->read_at ? 'bg-dark text-white' : 'bg-dark text-white fw-bold' }} border-secondary mb-2"
                                        data-id="{{ $notification->id }}" @if(isset($notification->data['team_invitation_id']))
                                        data-team-invitation-id="{{ $notification->data['team_invitation_id'] }}" @endif>
                                        <div class="d-flex align-items-center">
                                            @if(isset($notification->data['team_logo']))
                                                <img src="{{ asset('teams_imgs/' . $notification->data['team_logo']) }}" alt="Team Logo"
                                                    class="rounded-circle me-3" width="50" height="50">
                                            @else
                                                <div class="rounded-circle bg-primary me-3 d-flex align-items-center justify-content-center"
                                                    style="width: 50px; height: 50px;">
                                                    <i class="fas fa-users text-white"></i>
                                                </div>
                                            @endif
                                            <div class="flex-grow-1">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h6 class="mb-0">
                                                        {{ isset($notification->data['team_name']) ? $notification->data['team_name'] : 'System Notification' }}
                                                    </h6>
                                                    <small
                                                        class="text-muted">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</small>
                                                </div>
                                                <p class="mb-0 mt-1">{{ $notification->data['message'] }}</p>

                                                @if(isset($notification->data['type']) && $notification->data['type'] == 'team_to_player' && !$notification->read_at)
                                                    <div class="mt-3 d-flex justify-content-end">
                                                        <button class="btn btn-sm btn-success me-2 accept-invitation"
                                                            data-invitation-id="{{ $notification->data['team_invitation_id'] }}">Accept</button>
                                                        <button class="btn btn-sm btn-danger decline-invitation"
                                                            data-invitation-id="{{ $notification->data['team_invitation_id'] }}">Decline</button>
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

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Setup notification actions from notifications.js will handle this page too
        });
    </script>
@endsection