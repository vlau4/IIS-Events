@props(['event'])

<x-card>
    <div class="flex">
        <img class="w-48 mr-6 md:block" src="{{$event->logo ? asset('storage/' . $event->logo) : asset('/images/no-image.png')}}" alt=""/>
        <div>
            <h3 class="text-2xl">
                <a href="/events/{{$event->id}}">{{$event->title}}</a>
            </h3>
            <div class="text-xl font-bold mb-4">{{$event->category->name}}</div>
            <x-event-tags  :tagsCsv="$event->tags" />
            <div class="text-lg mt-4">
                <i class="fa-solid fa-location-dot"></i> {{$event->location->street}} {{$event->location->number}}, {{$event->location->city}}, {{$event->location->country}}
                <p class="text-base">{{$event->start}}</p>
            </div>
            
        </div>
    </div>
</x-card>