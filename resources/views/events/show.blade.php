<x-layout>
    <a href="/" class="inline-block text-black ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i> Back</a>
    <div class="mx-4">
        <x-card class="p-10">
            <div class="flex flex-col items-center justify-center text-center">

                <img class="w-48 mr-6 mb-6" src="{{$event->logo ? asset('storage/' . $event->logo) : asset('/images/no-image.png')}}" alt=""/>

                <h3 class="text-2xl mb-2">{{$event->title}}</h3>
                <div class="text-xl font-bold mb-4">{{$event->category->name}}</div>
                <x-event-tags  :tagsCsv="$event->tags"/>
                <div class="text-lg my-4">
                    <i class="fa-solid fa-location-dot"></i> {{$event->location->street}} {{$event->location->number}}, {{$event->location->city}}, {{$event->location->country}}
                </div>
                <div class="border border-gray-200 w-full mb-6"></div>
                <div>
                    <h3 class="text-3xl font-bold mb-4"> Event Description </h3>
                    <div class="text-lg">
                        {{$event->description}}
                        <p> <b>Capacity:</b> {{$event->capacity}}</p>
                        @if($event->entry_fee)
                            <p> <b>Entry Fee:</b> {{$event->entry_fee}}</p>
                        @endif
                        <form method="POST" action="{{ route('event.add', $event) }}" enctype="multipart/form-data">
                            @csrf {{-- protection--}}
                            <button class="bg-sky-900 text-white mt-4 rounded-xl py-2 px-10 hover:bg-black">
                                Add To My Events
                            </button>
                        </form>
                    </div>
                </div>
                <p>From {{$event->start}} to {{$event->end}}</p>
            </div>
            <p>Created by: {{$event->user->name}}</p>
        </x-card>
        @if(auth())
            @if(auth()->user()->id == $event->user_id)
                <x-card class="mt-4 p-2 flex space-x-6 text-sky-700">
                    <a href="{{ Route('event.edit', $event) }}">
                        <i class="fa-solid fa-pencil"></i> Edit
                    </a>
                    <form method="POST" action="{{ route('event.destroy', $event) }}">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-500">
                            <i class="fa-solid fa-trash"></i> Delete
                        </button>
                    </form>
                </x-card>
            @endif
        @endif
        <x-comment-card :event="$event" :comments="$comments"></x-comment-card>
    </div>
</x-layout>