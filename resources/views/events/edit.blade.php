<x-layout>
    <x-card class="p-10 max-w-lg mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">Edit the Event</h2>
            <p class="mb-4">Edit: {{$event->title}}</p>
        </header>

        <form method="POST" action="/events/{{$event->id}}" enctype="multipart/form-data">
            @csrf {{-- protection--}}
            @method('PUT')

            <div class="mb-6">
                <label for="title" class="inline-block text-lg mb-2">Event Title</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="title" placeholder="Example: Senior Laravel Developer" value="{{$event->title}}"/>
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="category_id" class="inline-block text-lg mb-2">Category</label>
                <select class="border border-gray-200 rounded p-2 w-full" name="category_id" value="{{$event->category_id}}">
                    <option value="{{$event->category_id}}">{{$event->category->name}}</option>
                    @foreach($categories as $category)
                        @if($category->id != $event->category_id)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endif
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="location_id" class="inline-block text-lg mb-2">Location</label>
                <select class="border border-gray-200 rounded p-2 w-full" name="location_id" value="{{$event->location_id}}">
                    <option value="{{$event->location_id}}">{{$event->location->street}} {{$event->location->number}}, {{$event->location->city}}, {{$event->location->country}}</option>
                    @foreach($locations as $location)
                        @if($location->id != $event->location_id)
                            <option value="{{$location->id}}">{{$location->street}} {{$location->number}}, {{$location->city}}, {{$location->country}}</option>
                        @endif
                    @endforeach
                </select>
                @error('location_id')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="start" class="inline-block text-lg mb-2">Start Date</label>
                <input type="date" class="border border-gray-200 rounded p-2 w-full" name="start" value="{{$event->start}}"/>
                @error('start')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="end" class="inline-block text-lg mb-2">End Date</label>
                <input type="date" class="border border-gray-200 rounded p-2 w-full" name="end" value="{{$event->end}}"/>
                @error('end')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="capacity" class="inline-block text-lg mb-2">Capacity</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="capacity" value="{{$event->capacity}}"/>
                @error('capacity')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="entry_fee" class="inline-block text-lg mb-2">Entry Fee</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="entry_fee" value="{{$event->entry_fee}}"/>
                @error('entry_fee')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="tags" class="inline-block text-lg mb-2">
                    Tags (Comma Separated)
                </label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="tags" placeholder="Example: Laravel, Backend, Postgres, etc" value="{{$event->tags}}"/>
                @error('tags')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="logo" class="inline-block text-lg mb-2">
                    Event Logo
                </label>
                <input type="file" class="border border-gray-200 rounded p-2 w-full" name="logo"/>
                
                <img class="w-48 mr-6 mb-6" src="{{$event->logo ? asset('storage/' . $event->logo) : asset('/images/no-image.png')}}" alt=""/>
                
                @error('logo')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="description" class="inline-block text-lg mb-2">
                    Event Description
                </label>
                <textarea class="border border-gray-200 rounded p-2 w-full" name="description" rows="10" placeholder="Include tasks, requirements, salary, etc">{{$event->description}}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <button class="bg-sky-900 text-white rounded py-2 px-4 hover:bg-black">
                    Update Event
                </button>

                <a href="/events/{{$event->id}}" class="text-black ml-4"> Back </a>
            </div>
        </form>
    </x-card>
</x-layout>