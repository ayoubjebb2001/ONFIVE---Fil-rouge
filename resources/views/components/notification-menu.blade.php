<?php
$unreadCount = auth()->user()->unreadNotifications->count();
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
                <a href="#" class="text-primary mark-all-read" style="font-size: 0.8rem;">Mark all as read</a>
            @endif
        </li>
        <div id="notification-list">
            @forelse(auth()->user()->notifications as $notification)
                <li class="dropdown-item notification-item {{ $notification->read_at ? '' : 'unread' }}"
                    data-id="{{ $notification->id }}" @if(isset($notification->data['team_invitation_id']))
                    data-team-invitation-id="{{ $notification->data['team_invitation_id'] }}" @endif>
                    <div class="d-flex align-items-center">
                        @if(isset($notification->data['team_logo']))
                            <img src="{{ asset('teams_imgs/' . $notification->data['team_logo']) }}" alt="Team Logo"
                                class="rounded-circle me-2" width="40" height="40">
                        @else
                            <div class="rounded-circle bg-primary me-2 d-flex align-items-center justify-content-center"
                                style="width: 40px; height: 40px;">
                                <i class="fas fa-users text-white"></i>
                            </div>
                        @endif
                        <div>
                            <div class="notification-message">{{ $notification->data['message'] }}</div>
                            <small
                                class="text-muted">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</small>
                        </div>
                    </div>

                    @if(isset($notification->data['type']) && $notification->data['type'] == 'team_to_player' && !$notification->read_at)
                        <div class="mt-2 d-flex justify-content-end">
                            <button class="btn btn-sm btn-success me-2 accept-invitation"
                                data-invitation-id="{{ $notification->data['team_invitation_id'] }}">Accept</button>
                            <button class="btn btn-sm btn-danger decline-invitation"
                                data-invitation-id="{{ $notification->data['team_invitation_id'] }}">Decline</button>
                        </div>
                    @endif
                </li>
            @empty
                <li class="dropdown-item">No notifications</li>
            @endforelse
        </div>
        @if(count(auth()->user()->notifications) > 0)
            <li class="dropdown-item text-center">
                <a href="{{ route('notifications') }}" class="text-primary view-all-notifications">View all notifications</a>
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