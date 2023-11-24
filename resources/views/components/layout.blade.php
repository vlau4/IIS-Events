<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="favicon.ico" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.1.1/flowbite.min.css" rel="stylesheet" />
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>MeetUp | Where a boredom does not exist.</title>
</head>
<body class="mb-48">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.1.1/flowbite.min.js"></script>
        {{-- <nav class="flex justify-between items-center mb-4"> --}}

        {{-- LOGO --}}
        <nav class="flex items-center mb-4">
        <a href="/"><img class="w-24" src="{{asset('images/logo.png')}}" alt="" class="logo"/></a>

        @auth
            @if(auth()->user()->role == 'manager' || auth()->user()->role == 'admin')
                {{-- CREATE --}}
            <button id="createButton" data-dropdown-toggle="create" data-dropdown-trigger="hover" class="ml-20 text-white bg-sky-900 hover:bg-sky-700 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-sky-900 dark:hover:bg-sky-700" type="button">Create <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                </svg>
                </button>
                
                <!-- Dropdown menu -->
                <div id="create" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="createButton">
                        <li class="px-2">
                            <a href="{{ Route('event.create') }}" class=""><i class="fa-solid fa-plus"></i> New Event</a>
                        </li>
                        <li class="px-2">
                            <a href="{{ Route('category.create') }}" class=""><i class="fa-solid fa-plus"></i> New Category</a>
                        </li>
                        <li class="px-2">
                            <a href="{{ Route('location.create') }}" class=""><i class="fa-solid fa-plus"></i> New Location</a>
                        </li>
                    </ul>
                </div>

                {{-- CONFIRM --}}
                <button id="confirmationButton" data-dropdown-toggle="confirmation" data-dropdown-trigger="hover" class="ml-20 text-white bg-sky-900 hover:bg-sky-700 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-sky-900 dark:hover:bg-sky-700" type="button">Confirmation <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                </svg>
                </button>
                        
                <!-- Dropdown menu -->
                <div id="confirmation" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="confirmationButton">
                        <li class="px-2">
                            <a href="{{ Route('event.confirm.show') }}" class=""><i class="fa-solid fa-check"></i> Confirm Events</a>
                        </li>
                        <li class="px-2">
                            <a href="{{ Route('category.confirm.show') }}" class=""><i class="fa-solid fa-check"></i> Confirm Categories</a>
                        </li>
                        <li class="px-2">
                            <a href="{{ Route('location.confirm.show') }}" class=""><i class="fa-solid fa-check"></i> Confirm Locations</a>
                        </li>
                    </ul>
                </div>

                {{-- MANAGE --}}
                <button id="manageButton" data-dropdown-toggle="manage" data-dropdown-trigger="hover" class="ml-20 text-white bg-sky-900 hover:bg-sky-700 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-sky-900 dark:hover:bg-sky-700" type="button">Manage Categories <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                </svg>
                </button>
                        
                <!-- Dropdown menu -->
                <div id="manage" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="manageButton">
                        <li class="px-2">
                            <a href="{{ Route('categories.manage') }}" class=""><i class="fa-solid fa-check"></i> Manage Categories</a>
                        </li>
                        <li class="px-2">
                            <a href="{{ Route('locations.manage') }}" class=""><i class="fa-solid fa-check"></i> Manage Locations</a>
                        </li>
                    </ul>
                </div>
            @else
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" >
                    <li class="ml-20 text-white bg-sky-900 hover:bg-sky-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-sky-900 dark:hover:bg-sky-700">
                        <a href="{{ Route('event.create') }}" class=""><i class="fa-solid fa-plus"></i> Create Event</a>
                    </li>
                    <li class="ml-20 text-white bg-sky-900 hover:bg-sky-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-sky-900 dark:hover:bg-sky-700">
                        <a href="{{ Route('category.create') }}" class=""><i class="fa-solid fa-plus"></i> Create Category</a>
                    </li>
                    <li class="ml-20 text-white bg-sky-900 hover:bg-sky-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-sky-900 dark:hover:bg-sky-700">
                        <a href="{{ Route('location.create') }}" class=""><i class="fa-solid fa-plus"></i> Create Location</a>
                    </li>
                </ul>
            @endif

            @if(auth()->user()->role == 'admin')

                {{-- MANAGE USERS --}}
                <ul>
                    <li class="ml-20 text-white bg-sky-900 hover:bg-sky-700 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-sky-900 dark:hover:bg-sky-700">
                        <a href="{{ Route('users') }}" class=""><i class="fa-solid fa-gear"></i> Manage Users</a>
                    </li>
                </ul>
            @endif

            @if(auth()->user()->role == 'manager' || auth()->user()->role == 'admin')
            {{-- USER --}}
            <button id="userButton" data-dropdown-toggle="user" data-dropdown-trigger="hover" class="ml-20 text-white bg-sky-900 hover:bg-sky-700 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-sky-900 dark:hover:bg-sky-700" type="button">{{auth()->user()->name}} <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
            </svg>
            </button>
            
                <!-- Dropdown menu -->
                <div id="user" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="userButton">
                        <li class="px-2">
                            <a href="{{ Route('events.mine') }}" class=""><i class="fa-solid fa-calendar-days"></i> My Events</a>
                        </li>
                        <li class="px-2">
                            <a href="{{ Route('events.manage') }}" class=""><i class="fa-solid fa-gear"></i> Manage Events</a>
                        </li>
                        <li class="px-2">
                            <a href="{{ Route('settings') }}" class=""><i class="fa-solid fa-gear"></i> Settings</a>
                        </li>
                        <li class="px-2">
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

            
        @else

        {{-- UNAUTH - LOGIN, REGISTER --}}
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
        {{$slot}}
    </main>

    <footer class="fixed bottom-0 left-0 w-full flex items-center justify-start font-bold bg-sky-900 text-white h-24 mt-24 opacity-90 md:justify-center">
        <p class="ml-2">Copyright &copy; 2023, All Rights reserved</p>

        <a href="{{ Route('event.create') }}" class="absolute top-1/3 right-10 bg-black text-white py-2 px-5">Post Event</a>
    </footer>
    <x-flash-message></x-flash-message>
    <x-flash-error></x-flash-error>
</body>
</html>