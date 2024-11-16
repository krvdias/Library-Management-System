import './bootstrap';

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true
});

// Listen to the notifications channel
window.Echo.channel('notifications')
    .listen('NewNotification', (event) => {
        // Handle incoming notification event
        displayNotification(event.notification);
    });

function displayNotification(notification) {
    const notificationIcon = document.getElementById('notification-icon');
    const notificationCount = document.getElementById('notification-count');
    
    // Update icon and display message
    notificationIcon.classList.add('has-notifications'); // CSS to highlight icon
    notificationCount.innerText = parseInt(notificationCount.innerText) + 1; // Increment count

    // Optionally, show notification in a dropdown or modal
    const notificationsList = document.getElementById('notifications-list');
    const notificationItem = document.createElement('div');
    notificationItem.classList.add('notification-item');
    notificationItem.innerText = notification.message;
    notificationsList.prepend(notificationItem);
}
