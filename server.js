const express = require('express');
const http = require('http');
const socketIo = require('socket.io');

const app = express();
const server = http.createServer(app);
const io = socketIo(server, { cors: { origin: "*" } });

let adminSocketId = null;
let guests = [];  // Array to store guest socket IDs

io.on('connection', (socket) => {
    console.log('User connected:', socket.id);

    // Register the admin when they connect
    socket.on('registerAdmin', () => {
        adminSocketId = socket.id;
        console.log("Admin registered with socket ID:", adminSocketId);
        
        // Send the current guest list to the admin
        socket.emit('updateGuestList', guests);
    });

    // Handle a new guest connection by storing their socket ID
    socket.on('registerGuest', () => {
        guests.push(socket.id); // Store guest socket ID
        console.log("New guest connected:", socket.id);

        // Notify the admin of the new guest
        if (adminSocketId) {
            io.to(adminSocketId).emit('updateGuestList', guests);
        }
    });

    // Handle messages from guests to the admin
    socket.on('sendChatToServer', (message) => {
        console.log("Message from guest:", message);

        // Forward the message to the admin if they are connected
        if (adminSocketId) {
            io.to(adminSocketId).emit('sendChatToClient', { message, from: socket.id });
        } else {
            console.log("Admin is not connected to receive the message.");
        }
    });

    // Handle admin messages to all connected guests
    socket.on('sendChatToAllGuests', (message) => {
        if (guests.length > 0) {
            guests.forEach(guestSocketId => {
                io.to(guestSocketId).emit('sendChatToClient', { message, from: 'admin' });
            });
        }
    });

    // Handle disconnection
    socket.on('disconnect', () => {
        if (socket.id === adminSocketId) {
            adminSocketId = null;
            console.log("Admin disconnected.");
        } else {
            guests = guests.filter(id => id !== socket.id);
            console.log("Guest disconnected:", socket.id);
            
            // Notify the admin that a guest has disconnected
            if (adminSocketId) {
                io.to(adminSocketId).emit('updateGuestList', guests);
            }
        }
    });
});

server.listen(3000, () => {
    console.log('Server is running on port 3000');
});
