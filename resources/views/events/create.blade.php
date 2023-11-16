<x-layout>
    <x-card class="p-10 max-w-lg mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">Create a Gig</h2>
            <p class="mb-4">Post a gig to find a developer</p>
        </header>

        <form method="POST" action="/events" enctype="multipart/form-data">
            @csrf {{-- protection--}}

            <div class="mb-6">
                <label for="title" class="inline-block text-lg mb-2">Event Title</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="title" value="{{old('title')}}"/>
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="category_id" class="inline-block text-lg mb-2">Category</label>
                <select class="border border-gray-200 rounded p-2 w-full" name="category_id" value="{{old('category_id')}}">
                    <option value=""></option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="location_id" class="inline-block text-lg mb-2">Location</label>
                <select class="border border-gray-200 rounded p-2 w-full" name="location_id" value="{{old('location_id')}}">
                    <option value=""></option>
                    @foreach($locations as $location)
                        <option value="{{$location->id}}">{{$location->street}} {{$location->number}}, {{$location->city}}, {{$location->country}}</option>
                    @endforeach
                </select>
                @error('location_id')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="start" class="inline-block text-lg mb-2">Start Date</label>
                <input type="date" class="border border-gray-200 rounded p-2 w-full" name="start" value="{{old('start')}}"/>
                @error('start')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="end" class="inline-block text-lg mb-2">End Date</label>
                <input type="date" class="border border-gray-200 rounded p-2 w-full" name="end" value="{{old('end')}}"/>
                @error('end')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="capacity" class="inline-block text-lg mb-2">Capacity</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="capacity" value="{{old('capacity')}}"/>
                @error('capacity')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="entry_fee" class="inline-block text-lg mb-2">Entry Fee</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="entry_fee" value="{{old('entry_fee')}}"/>
                @error('entry_fee')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="tags" class="inline-block text-lg mb-2">Tags (Comma Separated)</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="tags" placeholder="Example: festival, music, pop, etc" value="{{old('tags')}}"/>
                @error('tags')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="logo" class="inline-block text-lg mb-2">
                    Event Logo
                </label>
                <input type="file" class="border border-gray-200 rounded p-2 w-full" name="logo"/>
                @error('logo')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="description" class="inline-block text-lg mb-2">
                    Event Description
                </label>
                <textarea class="border border-gray-200 rounded p-2 w-full" name="description" rows="10" placeholder="Include price, description of event, etc">{{old('description')}}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">Create Event</button>

                <a href="/" class="text-black ml-4"> Back </a>
            </div>
        </form>
    </x-card>
</x-layout>