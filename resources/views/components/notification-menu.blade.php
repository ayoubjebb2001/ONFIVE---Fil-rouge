<?php
$unreadCount = auth()->user()->unreadNotifications->count();
$notifications = auth()->user()->notifications->take(5);
?>

<div class="nav-item dropdown me-2">
    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" role="button"
        data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-bell"></i>
        @if($unreadCount > 0)
            <span class="badge rounded-pill badge-notification bg-danger" id="unread-count">{{ $unreadCount }}</span>
        @else
            <span class="badge rounded-pill badge-notification bg-danger d-none" id="unread-count">0</span>
        @endif
    </a>
    <ul class="dropdown-menu dropdown-menu-end notification-dropdown" aria-labelledby="navbarDropdownMenuLink"
        style="width: 300px; max-height: 400px; overflow-y: auto;">
        <li class="dropdown-header d-flex justify-content-between align-items-center">
            <span>Notifications</span>
            @if($unreadCount > 0)
                <form action="{{ route('notifications.mark-all-read') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 text-primary"
                        style="font-size: 0.8rem; text-decoration: none;">Mark all as read</button>
                </form>
            @endif
        </li>
        <div id="notification-list">
            @forelse($notifications as $notification)
                <li class="dropdown-item notification-item {{ $notification->read_at ? '' : 'unread' }}">
                    <div class="d-flex align-items-center">
                        @if(isset($notification->data['team_logo']))
                            <img src="{{ asset('teams_imgs/' . $notification->data['team_logo']) }}" alt="Team Logo"
                                class="rounded-circle me-2" width="40" height="40">
                        @elseif(isset($notification->data['user_profile_picture']))
                            <img src="{{ asset('profiles/' . $notification->data['user_profile_picture']) }}" alt="User Profile"
                                class="rounded-circle me-2" width="40" height="40">
                        @else
                            <div class="rounded-circle bg-primary me-2 d-flex align-items-center justify-content-center"
                                style="width: 40px; height: 40px;">
                                <i class="fas fa-users text-white"></i>
                            </div>
                        @endif
                        <div>
                            <div class="notification-message">
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
                            </div>
                            <small
                                class="text-muted">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</small>
                        </div>
                    </div>

                    @if(!$notification->read_at)
                        <div class="mt-2 d-flex justify-content-between align-items-center">
                            <form action="{{ route('notifications.read', $notification->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-secondary">Mark as read</button>
                            </form>

                            @if(isset($notification->data['type']) && $notification->data['type'] == 'team_to_player')
                                <div>
                                    <form action="{{ route('team-invitations.accept', $notification->data['team_invitation_id']) }}"
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
                                    <form action="{{ route('join-requests.accept', $notification->data['id']) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">Accept</button>
                                    </form>
                                    <form action="{{ route('join-requests.decline', $notification->data['id']) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">Decline</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    @endif
                </li>
            @empty
                <li class="dropdown-item">No notifications</li>
            @endforelse
        </div>
        @if(count($notifications) > 0)
            <li class="dropdown-item text-center">
                <a href="{{ route('notifications.index') }}" class="text-primary">View all notifications</a>
            </li>
        @endif
    </ul>
</div>

<style>
    .notification-item.unread {
        background-color: rgba(13, 110, 253, 0.05);
        font-weight: bold;
    }

    .notification-item {
        cursor: pointer;
        padding: 8px 16px;
        border-bottom: 1px solid #eee;
    }

    .notification-message {
        white-space: normal;
        word-wrap: break-word;
    }
</style>