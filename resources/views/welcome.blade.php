<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="{{asset('css/groupHome.css')}}">

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="antialiased">
       @livewire('chat-page',['user_id'=>$user_id])

       @livewireScripts
    </body>

    <script>
        var conn = new WebSocket('ws://localhost:8080');
        conn.onopen = function(e) {
            console.log("Connection established!");
        };
        conn.onmessage = function(e) {
            console.log(e.data);
            Livewire.emit('chat-message',e.data);
        };

        function sendMessage(){
            Livewire.emit('send-message',conn);
            // conn.send(message);
        }

        Livewire.on('sendMessage',(param1) => {
            conn.send(param1);
        // Handle the event
        console.log('Event received:', param1);
    });
    </script>
</html>
