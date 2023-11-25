<x-layout>
    <x-card class="p-10">
        <header>
            <button onclick="events_content()" class="block text-white bg-sky-800 hover:bg-sky-900 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="button">
                Events
            </button>
            {{-- <button onclick="categories_content()" class="block text-white bg-sky-800 hover:bg-sky-900 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="button">
                Categories
            </button>
            <button onclick="locations_content()" class="block text-white bg-sky-800 hover:bg-sky-900 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="button">
                Locations
            </button> --}}
        </header>

        <script type="text/javascript">
            function events_content()
            {
                $('#content_div').load('/confirm/events/');
            }

            // function categories_content()
            // {
            //     $('#content_div').load('/confirm/categories/');
            // }

            // function locations_content()
            // {
            //     $('#content_div').load('/confirm/locations/');
            // }
        </script>

        <div class="row" id="content_div">
            asd
        </div>
            
    </x-card>
</x-layout>