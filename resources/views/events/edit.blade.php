<x-layout>
    <x-card class="p-10 max-w-lg mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">Edit the Event</h2>
            <p class="mb-4">Edit: {{$event->title}}</p>
        </header>

        <form method="POST" action="{{ route('event.update', $event) }}" enctype="multipart/form-data">
            @csrf {{-- protection--}}
            @method('PUT')

            <div class="mb-6">
                <label for="title" class="inline-block text-lg mb-2">Event Title *</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="title" placeholder="Example: Senior Laravel Developer" value="{{$event->title}}"/>
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="category_id" class="inline-block text-lg mb-2">Category *</label>
                <select class="border border-gray-200 rounded p-2 w-full" name="category_id">
                    @foreach($categories as $category)
                        @if($category->parent_id == 0)
                            <option value="{{$category->id}}" {{($category->id == $event->category_id ? "selected":"") }} class="font-semibold">{{$category->name}}</option>
                        @else
                            @php
                                $text = '';
                                for($i = $category->position; $i > 0; $i--) {
                                    $text .= "&nbsp;";
                                }
                                $text .= $category->name;
                            @endphp
                            <option value="{{$category->id}}" {{($category->id == $event->category_id ? "selected":"") }}>{!!$text!!}</option>
                        @endif
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="location_id" class="inline-block text-lg mb-2">Location *</label>
                <select class="border border-gray-200 rounded p-2 w-full" name="location_id">
                    @foreach($locations as $location)
                        <option value="{{$location->id}}" {{($location->id == $event->location_id ? "selected":"") }}>{{$location->street}} {{$location->number}}, {{$location->city}} {{$location->zip}}, {{$location->country}}</option>
                    @endforeach
                </select>
                @error('location_id')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="start" class="inline-block text-lg mb-2">Start Date *</label>
                <input type="datetime-local" class="border border-gray-200 rounded p-2 w-full" name="start" value="{{$event->start}}"/>
                @error('start')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="end" class="inline-block text-lg mb-2">End Date *</label>
                <input type="datetime-local" class="border border-gray-200 rounded p-2 w-full" name="end" value="{{$event->end}}"/>
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
                <label for="fee" class="inline-block text-lg">Entry Fee</label>
                <p class="text-sm mb-2 ">(Do not use <b>:</b> or <b>,</b>)</p>
                <div id="fee">
                    <p class="inline-block text-sm font-semibold">Category</p>
                    <p class="inline-block text-sm  font-semibold">Value</p><br>
                    <input type="text" class="border border-gray-200 rounded p-2" style="width:49.4%;" name="fee_category_0" value="{{old('fee_category_0')}}"/>
                    <input type="text" class="border border-gray-200 rounded p-2" style="width:49.4%;" name="fee_value_0" value="{{old('fee_value_0')}}"/>
                </div>
                <div class="text-center">
                    <button onclick="new_fee()" type="button" class="border border-black rounded rounded px-0.5 m-1 hover:bg-gray-200">Add Fee Category</button>
                </div>
                @error('fee')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="tags" class="inline-block text-lg mb-2">Tags (Comma Separated)</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="tags" placeholder="Example: Laravel, Backend, Postgres, etc" value="{{$event->tags}}"/>
                @error('tags')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="logo" class="inline-block text-lg mb-2">Event Logo</label>
                <input type="file" class="border border-gray-200 rounded p-2 w-full" name="logo"/>
                
                <img class="w-48 mr-6 mb-6" src="{{$event->logo ? asset('storage/' . $event->logo) : asset('/images/no-image.png')}}" alt=""/>
                
                @error('logo')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="description" class="inline-block text-lg mb-2">Event Description</label>
                <textarea class="border border-gray-200 rounded p-2 w-full" name="description" rows="10" placeholder="Include tasks, requirements, salary, etc">{{$event->description}}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <button class="bg-sky-900 text-white rounded py-2 px-4 hover:bg-black">Update Event</button>

                <a href="{{ Route('event.show', $event) }}" class="text-black ml-4"> Back </a>
            </div>
        </form>
    </x-card>
</x-layout>

<script type="text/javascript">
    i = 1;
    function new_fee() {
        console.log('ahoj')
        document.getElementById('fee').innerHTML += "\n<input type='text' class='border border-gray-200 rounded p-2' style='width:49.4%;' name='fee_category_" + i +"'/>";
        document.getElementById('fee').innerHTML += "\n<input type='text' class='border border-gray-200 rounded p-2' style='width:49.4%;' name='fee_value_" + i +"'/>";
        i++;
    }
</script>