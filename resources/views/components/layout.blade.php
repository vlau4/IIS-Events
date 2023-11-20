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
                    <a href="/events/create" class="hover:text-sky-700"><i class="fa-solid fa-plus"></i> New Event</a>
                </li>
                <li class="hover:text-sky-700 px-2">
                    <a href="/categories/create" class="hover:text-sky-700"><i class="fa-solid fa-plus"></i> New Category</a>
                </li>
                <li class="hover:text-sky-700 px-2">
                    <a href="/locations/create" class="hover:text-sky-700"><i class="fa-solid fa-plus"></i> New Location</a>
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
                                <a href="/events/confirm" class="hover:text-sky-700"><i class="fa-solid fa-check"></i> Confirm Events</a>
                            </li>
                            <li class="hover:text-sky-700 px-2">
                                <a href="/categories/confirm" class="hover:text-sky-700"><i class="fa-solid fa-check"></i> Confirm Categories</a>
                            </li>
                            <li class="hover:text-sky-700 px-2">
                                <a href="/locations/confirm" class="hover:text-sky-700"><i class="fa-solid fa-check"></i> Confirm Locations</a>
                            </li>
                        </ul>
                    </div>
            @endif

            @if(auth()->user()->role == 'admin')
                <ul>
                    <li class="ml-20 text-white bg-sky-900 hover:bg-sky-700 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-sky-900 dark:hover:bg-sky-700">
                        <a href="/users" class=""><i class="fa-solid fa-gear"></i> Manage Users</a>
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
                        <a href="/events/mine" class="hover:text-sky-700"><i class="fa-solid fa-calendar-days"></i> My Events</a>
                    </li>
                    <li class="hover:text-sky-700 px-2">
                        <a href="/events/manage" class="hover:text-sky-700"><i class="fa-solid fa-gear"></i> Manage Events</a>
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
        {{-- <a href="/">
            <img class="w-24" src="{{asset('images/logo.png')}}" alt="" class="logo"/>
        </a>
        <ul class="flex space-x-6 mr-6 text-lg">
            @auth
            <li>
                <span class="font-bold uppercase">
                    {{auth()->user()->name}}
                </span>
            </li>
            <li>
                <a href="/locations" class="hover:text-sky-700">Locations</a>
            </li>
            <li>
                <a href="/categories" class="hover:text-sky-700">Categories</a>
            </li>
            <li>
                <a href="/events/mine" class="hover:text-sky-700">My Events</a>
            </li>
            @if(auth()->user()->role == 'admin')
                <li>
                    <a href="/users" class="hover:text-sky-700"><i class="fa-solid fa-gear"></i> Manage Users</a>
                </li>
            @endif
            @if(auth()->user()->role == 'manager' || auth()->user()->role == 'admin')
                <li>
                    <a href="/events/confirm" class="hover:text-sky-700"><i class="fa-solid fa-gear"></i> Confirm Events</a>
                </li>
                <li>
                    <a href="/events/manage" class="hover:text-sky-700"><i class="fa-solid fa-gear"></i> Manage Events</a>
                </li>
            @endif
            <li class="hover:text-sky-700">
                <form method="POST" action="/logout" class="inline">
                    @csrf
                    <button type="submit">
                        <i class="fa-solid fa-door-open"></i> Logout
                    </button>
                </form>
            </li>
            @else
            <li>
                <a href="/register" class="hover:text-sky-700"><i class="fa-solid fa-user-plus"></i> Register</a>
            </li>
            <li>
                <a href="/login" class="hover:text-sky-700"><i class="fa-solid fa-arrow-right-to-bracket"></i> Login</a>
            </li>
            @endauth
        </ul> --}}
    </nav>
    <main>
        {{$slot}}
    </main>

    <footer class="fixed bottom-0 left-0 w-full flex items-center justify-start font-bold bg-sky-900 text-white h-24 mt-24 opacity-90 md:justify-center">
        <p class="ml-2">Copyright &copy; 2023, All Rights reserved</p>

        <a href="/events/create" class="absolute top-1/3 right-10 bg-black text-white py-2 px-5">Post Event</a>
    </footer>
    <x-flash-message></x-flash-message>
</body>
</html>