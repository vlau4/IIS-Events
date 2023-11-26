<x-layout>
    <x-card class="p-10">
        <header>
            <button id="events_button" onclick="events_content()" class="inline-flex block text-white bg-sky-800 hover:bg-sky-900 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="button">
                Events ({{count($events)}})
            </button>
            <button id="categories_button" onclick="categories_content()" class="inline-flex block text-white bg-sky-800 hover:bg-sky-900 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="button">
                Categories ({{count($categories)}})
            </button>
            <button id="locations_button" onclick="locations_content()" class="inline-flex block text-white bg-sky-800 hover:bg-sky-900 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="button">
                Locations ({{count($locations)}})
            </button>
        </header>

        <div class="row" id="content_div">
            @if(session()->has('mode'))
                @if(session('mode') == 0)
                    {{-- EVENTS --}}
                    <div id="events" style="display:block;">
                        @include('partials/_events')
                    </div>

                    {{-- CATEGORIES --}}
                    <div id="categories" style="display:none;">
                        @include('partials/_categories')
                    </div>

                    {{-- LOCATIONS --}}
                    <div id="locations" style="display:none;">
                        @include('partials/_locations')
                    </div>
                @elseif(session('mode') == 1)
                    {{-- EVENTS --}}
                    <div id="events" style="display:none;">
                        @include('partials/_events')
                    </div>

                    {{-- CATEGORIES --}}
                    <div id="categories" style="display:block;">
                        @include('partials/_categories')
                    </div>

                    {{-- LOCATIONS --}}
                    <div id="locations" style="display:none;">
                        @include('partials/_locations')
                    </div>
                @elseif(session('mode') == 2)
                    {{-- EVENTS --}}
                    <div id="events" style="display:none;">
                        @include('partials/_events')
                    </div>

                    {{-- CATEGORIES --}}
                    <div id="categories" style="display:none;">
                        @include('partials/_categories')
                    </div>

                    {{-- LOCATIONS --}}
                    <div id="locations" style="display:block;">
                        @include('partials/_locations')
                    </div>
                @endif
            @else
                {{-- EVENTS --}}
                <div id="events" style="display:block;">
                    @include('partials/_events')
                </div>

                {{-- CATEGORIES --}}
                <div id="categories" style="display:none;">
                    @include('partials/_categories')
                </div>

                {{-- LOCATIONS --}}
                <div id="locations" style="display:none;">
                    @include('partials/_locations')
                </div>
            @endif
        </div>

        <script type="text/javascript">
            function events_content() {
                document.getElementById('events').style.display = "block";
                document.getElementById('categories').style.display = "none";
                document.getElementById('locations').style.display = "none";
            }

            function categories_content() {
                document.getElementById('events').style.display = "none";
                document.getElementById('categories').style.display = "block";
                document.getElementById('locations').style.display = "none";
            }

            function locations_content() {
                document.getElementById('events').style.display = "none";
                document.getElementById('categories').style.display = "none";
                document.getElementById('locations').style.display = "block";
            }
        </script>
            
    </x-card>
</x-layout>