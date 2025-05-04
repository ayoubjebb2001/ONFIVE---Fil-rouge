// Handle real-time notifications using Laravel Echo
document.addEventListener('DOMContentLoaded', function () {
    const userId = document.querySelector('meta[name="user-id"]')?.content;

    if (userId && window.Echo) {
        // Set up real-time notifications
        window.Echo.private(`App.Models.User.${userId}`)
            .notification((notification) => {

                // Show a toast notification
                showToast(notification.message, notification.type || 'success');
            });
    }
});


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