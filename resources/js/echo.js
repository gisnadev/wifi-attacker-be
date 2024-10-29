// import Echo from 'laravel-echo';

// window.Echo = new Echo({
//     broadcaster: 'socket.io',
//     host: window.location.hostname + ":" + window.laravel_echo_port
// });
// console.log("On Desktop Refredfdgdfgdfgsh");

import Echo from 'laravel-echo';

window.io = require('socket.io-client');

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001'
});