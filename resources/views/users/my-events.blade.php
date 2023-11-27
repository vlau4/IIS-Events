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
        <table class="w-full table-auto rounded-sm">
            <tbody>
                <tr class="border-gray-300">
                    <td class="px-1 py-1 border-b border-gray-300">Title</td>
                    <td class="px-1 py-1 border-b border-gray-300">Category</td>
                    <td class="px-1 py-1 border-b border-gray-300">Adress</td>
                    <td class="px-1 py-1 border-b border-gray-300">Start</td>
                    <td class="px-1 py-1 border-b border-gray-300">End</td>
                    <td class="px-1 py-1 border-t border-b border-gray-300"></td>
                </tr>
            @unless($events->isEmpty())
                @foreach($events as $event)
                    <tr class="border-gray-300">
                        <td class="px-1 py-1 border-t border-b border-gray-300">
                            <a href="{{ Route('event.show', $event) }}">{{$event->title}}</a>
                        </td>
                        <td class="px-1 py-1 border-t border-b border-gray-300">
                            {{$event->category->name}}
                        </td>
                        <td class="px-1 py-1 border-t border-b border-gray-300">
                            {{$event->location->street}} {{$event->location->number}}, {{$event->location->city}}
                        </td>
                        <td class="px-1 py-1 border-t border-b border-gray-300">
                            {{$event->start}}
                        </td>
                        <td class="px-1 py-1 border-t border-b border-gray-300">
                            {{$event->end}}
                        </td>
                        </td>
                        <td class="px-1 py-1 border-t border-b border-gray-300">
                            <form method="POST" action="{{ route('attending.remove', $event) }}">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600">
                                    <i class="fa-solid fa-trash-can"></i> Remove
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr class="border-gray-300">
                    <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                        <p class="text-center">You do not attend any events. <a href="{{ Route('home') }}" class="text-sky-700 underline">FIND</a> any.</p>
                    </td>
                </tr>
            @endunless
</x-layout>