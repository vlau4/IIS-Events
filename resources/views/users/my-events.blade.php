<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> 
    {{-- <link rel="stylesheet" href="/css/myEvents.css" /> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
</head> 
<x-layout>
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
</x-layout>