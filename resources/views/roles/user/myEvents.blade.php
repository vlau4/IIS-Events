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
    <nav class="flex items-center mb-4">
        <a href="/"><img class="w-24" src="{{asset('images/logo.png')}}" alt="" class="logo"/></a>
        <button id="createButton" data-dropdown-toggle="create" data-dropdown-trigger="hover" class="ml-20 text-white bg-sky-900 hover:bg-sky-700 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-sky-900 dark:hover:bg-sky-700" type="button">Create <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
        </svg>
        </button>
        
        <!-- Dropdown menu -->
        <div id="create" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="createButton">
                <li class="hover:text-sky-700 px-2">
                    <a href="{{ Route('event.create') }}" class="hover:text-sky-700"><i class="fa-solid fa-plus"></i> New Event</a>
                </li>
                <li class="hover:text-sky-700 px-2">
                    <a href="{{ Route('category.create') }}" class="hover:text-sky-700"><i class="fa-solid fa-plus"></i> New Category</a>
                </li>
                <li class="hover:text-sky-700 px-2">
                    <a href="{{ Route('location.create') }}" class="hover:text-sky-700"><i class="fa-solid fa-plus"></i> New Location</a>
                </li>
            </ul>
        </div>
        @auth
            @if(auth()->user()->role == 'manager' || auth()->user()->role == 'admin')
            <button id="confirmationButton" data-dropdown-toggle="confirmation" data-dropdown-trigger="hover" class="ml-20 text-white bg-sky-900 hover:bg-sky-700 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-sky-900 dark:hover:bg-sky-700" type="button">Confirmation <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
            </svg>
            </button>
                    
                    <!-- Dropdown menu -->
                    <div id="confirmation" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="confirmationButton">
                            <li class="hover:text-sky-700 px-2">
                                <a href="{{ Route('event.confirm.show') }}" class="hover:text-sky-700"><i class="fa-solid fa-check"></i> Confirm Events</a>
                            </li>
                            <li class="hover:text-sky-700 px-2">
                                <a href="{{ Route('category.confirm.show') }}" class="hover:text-sky-700"><i class="fa-solid fa-check"></i> Confirm Categories</a>
                            </li>
                            <li class="hover:text-sky-700 px-2">
                                <a href="{{ Route('location.confirm.show') }}" class="hover:text-sky-700"><i class="fa-solid fa-check"></i> Confirm Locations</a>
                            </li>
                        </ul>
                    </div>
            @endif

            @if(auth()->user()->role == 'admin')
                <ul>
                    <li class="ml-20 text-white bg-sky-900 hover:bg-sky-700 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-sky-900 dark:hover:bg-sky-700">
                        <a href="{{ Route('users') }}" class=""><i class="fa-solid fa-gear"></i> Manage Users</a>
                    </li>
                </ul>
            @endif

            <button id="userButton" data-dropdown-toggle="user" data-dropdown-trigger="hover" class="ml-20 text-white bg-sky-900 hover:bg-sky-700 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-sky-900 dark:hover:bg-sky-700" type="button">{{auth()->user()->name}} <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
            </svg>
            </button>
            
            <!-- Dropdown menu -->
            <div id="user" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="userButton">
                    <li class="hover:text-sky-700 px-2">
                        <a href="{{ Route('events.mine') }}" class="hover:text-sky-700"><i class="fa-solid fa-calendar-days"></i> My Events</a>
                    </li>
                    <li class="hover:text-sky-700 px-2">
                        <a href="{{ Route('events.manage') }}" class="hover:text-sky-700"><i class="fa-solid fa-gear"></i> Manage Events</a>
                    </li>
                    <li class="hover:text-sky-700 px-2">
                        <form method="POST" action="/logout" class="inline">
                            @csrf
                            <button type="submit">
                                <i class="fa-solid fa-door-open"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
            
        @else
        <ul>
            <li class="ml-20 text-white bg-sky-900 hover:bg-sky-700 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-sky-900 dark:hover:bg-sky-700">
                <a href="/register" class=""><i class="fa-solid fa-user-plus"></i> Register</a>
            </li>
            <li class="ml-20 text-white bg-sky-900 hover:bg-sky-700 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-sky-900 dark:hover:bg-sky-700">
                <a href="/login" class=""><i class="fa-solid fa-arrow-right-to-bracket"></i> Login</a>
            </li>
        </ul>
        @endauth
    </nav>
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