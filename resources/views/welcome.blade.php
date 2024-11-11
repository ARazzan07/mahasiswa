@extends('layout.menu')
@section('konten')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat System</title>
    <style>
        .chat-container {
            max-width: 500px;
            margin: 20px auto;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 10px;
        }
        #messages {
            list-style-type: none;
            padding: 0;
            max-height: 300px;
            overflow-y: auto;
            margin-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }
        #form {
            display: flex;
            align-items: center;
        }
        #chatInput {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 10px 15px;
            margin-left: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
    </style>
    <script src="https://cdn.socket.io/4.8.0/socket.io.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>

<div class="chat-container">
    @if (Auth::check() && Auth::user()->level == 'admin')
    <h2>Admin Chat</h2>

<h3>Connected Guests:</h3>
<ul id="guestList"></ul> <!-- Display the list of connected guests -->

<h3>Chat</h3>
<ul id="messages"></ul>
<form id="form" action="">
    <input id="chatInput" autocomplete="off" placeholder="Type your message..." />
    <button type="submit">Send</button>
</form>

<script>
    $(function() {
        let socket = io('http://127.0.0.1:3000');
        let selectedGuestSocketId = null; // Track the selected guest socket ID

        // Register as admin on the server
        socket.emit('registerAdmin');

        // Update guest list when guests connect or disconnect
        socket.on('updateGuestList', function(guestSocketIds) {
            $('#guestList').empty(); // Clear the existing list

            guestSocketIds.forEach(function(guestSocketId) {
                let guestItem = $('<li>')
                    .text("Guest " + guestSocketId)
                    .css('cursor', 'pointer')
                    .click(function() {
                        selectedGuestSocketId = guestSocketId;
                        alert("Selected Guest: " + selectedGuestSocketId);
                    });
                $('#guestList').append(guestItem);
            });
        });

        // Display messages from guests
        socket.on('sendChatToClient', function(data) {
            let message = data.message;
            let sender = data.from; // This is where the "from" field comes from
            $('#messages').append($('<li>').text(sender + ": " + message));
        });

        // Send message to all connected guests
        $('#form').submit(function(e) {
            e.preventDefault();
            let message = $('#chatInput').val();
            if (message) {
                socket.emit('sendChatToAllGuests', message);
                $('#messages').append($('<li>').text("To all guests: " + message));
                $('#chatInput').val('');
            }
        });
    });
</script>

    @else
    <p>Silakan login untuk melanjutkan.</p>
            <a href="{{ route('login') }}" class="btn btn-primary" title="Login"><i class="far fa-plus-square"></i> &nbsp;Login</a>
            <br>
            <h2>Guest Chat</h2>
    <ul id="messages"></ul>
    <form id="form" action="">
        <input id="chatInput" autocomplete="off" placeholder="Type your message here..." />
        <button type="submit">Send</button>
    </form>

    <script>
        $(function() {
            let socket = io('http://127.0.0.1:3000');
            
            // Register as a guest on the server
            socket.emit('registerGuest');

            // Send message to the server
            $('#form').submit(function(e) {
                e.preventDefault();
                let message = $('#chatInput').val();
                if (message) {
                    socket.emit('sendChatToServer', message);
                    $('#messages').append($('<li>').text("You: " + message));
                    $('#chatInput').val(''); // Clear input after sending
                }
            });

            // Display messages from the admin
            socket.on('sendChatToClient', function(data) {
                let message = data.message;
                let sender = data.from; // This will be 'admin'
                $('#messages').append($('<li>').text(sender + ": " + message));
            });
        });
    </script>
    @endif
</div>

</body>
</html>
@endsection
