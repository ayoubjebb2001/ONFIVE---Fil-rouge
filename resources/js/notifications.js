// Handle real-time notifications using Laravel Echo
document.addEventListener('DOMContentLoaded', function () {
    const userId = document.querySelector('meta[name="user-id"]')?.content;

    if (userId) {
        // Fetch existing unread notifications on page load
        fetchUnreadNotifications();

        // Set up real-time notifications if Echo is available
        if (window.Echo) {
            // Listen for notifications
            window.Echo.private(`App.Models.User.${userId}`)
                .notification((notification) => {
                    // Increase the unread count
                    increaseUnreadCount();

                    // Add the new notification to the top of the list
                    // addNotificationToList(notification);

                    // Show a toast notification
                    showToast(notification.message);
                });
        }
    }

    // Setup event listeners for notification actions
    setupNotificationActions();
});

// Fetch unread notifications from the server
function fetchUnreadNotifications() {
    fetch('/notifications/unread')
        .then(response => response.json())
        .then(data => {
            const notifications = data.notifications || [];
            if (notifications.length > 0) {
                // Update unread count badge
                const unreadCountElement = document.getElementById('unread-count');
                if (unreadCountElement) {
                    unreadCountElement.textContent = notifications.length;
                    unreadCountElement.classList.remove('d-none');
                }

                // Add each notification to the list
                notifications.forEach(notification => {
                    addNotificationToList({
                        id: notification.id,
                        team_invitation_id: notification.data.team_invitation_id,
                        team_id: notification.data.team_id,
                        team_name: notification.data.team_name,
                        team_logo: notification.data.team_logo,
                        type: notification.data.type,
                        message: notification.data.message,
                        created_at: new Date(notification.created_at).toLocaleString()
                    });
                });

                // Show the "Mark all as read" link if it exists
                const markAllReadLink = document.querySelector('.mark-all-read');
                if (markAllReadLink) {
                    markAllReadLink.classList.remove('d-none');
                }
            }
        })
        .catch(error => console.error('Error fetching notifications:', error));
}

// Increase the unread count badge
function increaseUnreadCount() {
    const unreadCountElement = document.getElementById('unread-count');
    if (unreadCountElement) {
        let count = parseInt(unreadCountElement.textContent || '0');
        count++;

        unreadCountElement.textContent = count;
        unreadCountElement.classList.remove('d-none');

        // Show the "Mark all as read" link if it exists
        const markAllReadLink = document.querySelector('.mark-all-read');
        if (markAllReadLink) {
            markAllReadLink.classList.remove('d-none');
        }
    }
}

// Add new notification to the dropdown list
function addNotificationToList(notification) {
    const notificationList = document.getElementById('notification-list');
    if (!notificationList) return;

    // Check if the "No notifications" message exists and remove it
    const noNotificationsItem = notificationList.querySelector('.dropdown-item:only-child');
    if (noNotificationsItem && noNotificationsItem.textContent.trim() === 'No notifications') {
        noNotificationsItem.remove();
    }

    // Create new notification HTML
    const notificationItem = document.createElement('li');
    notificationItem.className = 'dropdown-item notification-item unread';
    notificationItem.dataset.id = notification.id;
    notificationItem.dataset.teamInvitationId = notification.team_invitation_id;

    let imageHtml = '';
    if (notification.team_logo) {
        imageHtml = `<img src="${window.location.origin}/teams_imgs/${notification.team_logo}" alt="Team Logo" 
            class="rounded-circle me-2" width="40" height="40">`;
    } else {
        imageHtml = `<div class="rounded-circle bg-primary me-2 d-flex align-items-center justify-content-center" 
            style="width: 40px; height: 40px;">
            <i class="fas fa-users text-white"></i>
        </div>`;
    }

    notificationItem.innerHTML = `
        <div class="d-flex align-items-center">
            ${imageHtml}
            <div>
                <div class="notification-message">${notification.message}</div>
                <small class="text-muted">${notification.created_at || 'Just now'}</small>
            </div>
        </div>`;

    // For team invitations, add accept/decline buttons
    if (notification.type === 'team_to_player') {
        const actionsDiv = document.createElement('div');
        actionsDiv.className = 'mt-2 d-flex justify-content-end';

        actionsDiv.innerHTML = `
            <button class="btn btn-sm btn-success me-2 accept-invitation" 
                data-invitation-id="${notification.team_invitation_id}">Accept</button>
            <button class="btn btn-sm btn-danger decline-invitation" 
                data-invitation-id="${notification.team_invitation_id}">Decline</button>
        `;

        notificationItem.appendChild(actionsDiv);
    }

    // Add the notification to the top of the list
    if (notificationList.firstChild) {
        notificationList.insertBefore(notificationItem, notificationList.firstChild);
    } else {
        notificationList.appendChild(notificationItem);
    }

    // Add "View all notifications" link if it doesn't exist
    if (!document.querySelector('.view-all-notifications')) {
        const viewAllItem = document.createElement('li');
        viewAllItem.className = 'dropdown-item text-center';
        viewAllItem.innerHTML = '<a href="#" class="text-primary view-all-notifications">View all notifications</a>';

        const dropdownMenu = notificationList.closest('.dropdown-menu');
        if (dropdownMenu) {
            dropdownMenu.appendChild(viewAllItem);
        }
    }
}

// Setup event listeners for notification actions
function setupNotificationActions() {
    // Get CSRF token from meta tag
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

    // Event delegation for dynamic elements
    document.addEventListener('click', function (event) {
        // Mark all as read
        if (event.target.classList.contains('mark-all-read')) {
            event.preventDefault();
            markAllAsRead(csrfToken);
        }

        // View all notifications
        if (event.target.classList.contains('view-all-notifications')) {
            event.preventDefault();
            window.location.href = '/notifications';
        }

        // Accept team invitation
        if (event.target.classList.contains('accept-invitation')) {
            event.preventDefault();
            const invitationId = event.target.dataset.invitationId;
            handleInvitation(invitationId, 'accept', csrfToken);
        }

        // Decline team invitation
        if (event.target.classList.contains('decline-invitation')) {
            event.preventDefault();
            const invitationId = event.target.dataset.invitationId;
            handleInvitation(invitationId, 'decline', csrfToken);
        }

        // Mark individual notification as read when clicked
        const notificationItem = event.target.closest('.notification-item');
        if (notificationItem && !event.target.closest('button')) {
            markNotificationAsRead(notificationItem.dataset.id, csrfToken);
        }
    });
}

// Mark all notifications as read
function markAllAsRead(csrfToken) {
    fetch('/notifications/mark-all-read', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        }
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update UI to reflect all notifications are read
                document.querySelectorAll('.notification-item.unread').forEach(item => {
                    item.classList.remove('unread');
                });

                // Update unread count
                const unreadCountElement = document.getElementById('unread-count');
                if (unreadCountElement) {
                    unreadCountElement.textContent = '0';
                    unreadCountElement.classList.add('d-none');
                }

                // Hide "Mark all as read" link
                const markAllReadLink = document.querySelector('.mark-all-read');
                if (markAllReadLink) {
                    markAllReadLink.classList.add('d-none');
                }
            }
        })
        .catch(error => console.error('Error marking notifications as read:', error));
}

// Mark individual notification as read
function markNotificationAsRead(notificationId, csrfToken) {
    const notificationItem = document.querySelector(`.notification-item[data-id="${notificationId}"]`);
    if (!notificationItem || !notificationItem.classList.contains('unread')) return;

    fetch(`/notifications/${notificationId}/read`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        }
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update UI to reflect the notification is read
                notificationItem.classList.remove('unread');

                // Update unread count
                const unreadCountElement = document.getElementById('unread-count');
                if (unreadCountElement) {
                    let count = parseInt(unreadCountElement.textContent || '0');
                    if (count > 0) {
                        count--;
                        unreadCountElement.textContent = count;

                        if (count === 0) {
                            unreadCountElement.classList.add('d-none');

                            // Hide "Mark all as read" link if no unread notifications
                            const markAllReadLink = document.querySelector('.mark-all-read');
                            if (markAllReadLink) {
                                markAllReadLink.classList.add('d-none');
                            }
                        }
                    }
                }
            }
        })
        .catch(error => console.error('Error marking notification as read:', error));
}

// Handle team invitation (accept/decline)
function handleInvitation(invitationId, action, csrfToken) {
    if (!invitationId) return;

    fetch(`/team-invitations/${invitationId}/${action}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        }
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Show success message
                showToast(data.message);

                // Find and update the notification item
                const notificationItem = document.querySelector(`.notification-item[data-team-invitation-id="${invitationId}"]`);
                if (notificationItem) {
                    // Remove the action buttons
                    const actionsDiv = notificationItem.querySelector('.d-flex.justify-content-end');
                    if (actionsDiv) {
                        actionsDiv.remove();
                    }

                    // Update the message
                    const messageElement = notificationItem.querySelector('.notification-message');
                    if (messageElement) {
                        messageElement.textContent = data.message;
                    }

                    // Mark as read
                    notificationItem.classList.remove('unread');
                }
            } else {
                // Show error message
                showToast(data.message || 'An error occurred', 'error');
            }
        })
        .catch(error => {
            console.error(`Error ${action}ing invitation:`, error);
            showToast('An error occurred. Please try again later.', 'error');
        });
}

// Show toast notification
function showToast(message, type = 'success') {
    const toastElement = document.getElementById('notification-toast');
    const toastBodyElement = document.getElementById('toast-body');

    if (toastElement && toastBodyElement) {
        // Set the message
        toastBodyElement.textContent = message;

        // Set the type (you can customize this based on your Bootstrap setup)
        toastElement.className = 'toast';
        if (type === 'error') {
            toastBodyElement.classList.add('bg-danger', 'text-white');
        } else {
            toastBodyElement.classList.remove('bg-danger', 'text-white');
        }

        // Show the toast
        const toast = new bootstrap.Toast(toastElement);
        toast.show();
    }
}