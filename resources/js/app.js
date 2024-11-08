import './bootstrap';
Echo.channel('nama-channel')
    .listen('.nama-event', (e) => {
        console.log(e.message);
    });