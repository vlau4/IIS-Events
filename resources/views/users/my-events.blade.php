<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" /> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" /> --}}
    <link rel="stylesheet" href="/css/myEvents.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.1.1/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>MeetUp | Where a boredom does not exist.</title>
</head>
<body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.1.1/flowbite.min.js"></script>
    <main>
        <div class="container">
            <h1 class="text-3xl text-center font-bold my-6 uppercase">My Events</h1>
            <div id='calendar'></div>
        </div>
        <script>
        $(document).ready(function () {
            var calendar = $('#calendar').fullCalendar({
                header:{
                    right:'prev,next',
                    center: '',
                    left: 'title'
                },
                events: '/events/mine'
            });
        });
        </script>
    </main>
    <x-flash-message></x-flash-message>
</body>
</html>