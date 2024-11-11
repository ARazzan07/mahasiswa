import Echo from 'laravel-echo';
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'f1f777c818da7111404e',
    cluster: 'ap1',
    forceTLS: true
});
