@props(['event'])

<x-card>
    <div class="flex">
        <img class="w-48 mr-6 md:block" src="{{$event->logo ? asset('storage/' . $event->logo) : asset('/images/no-image.png')}}" alt=""/>
        <div>
            <h3 class="text-2xl">
                <a href="/events/{{$event->id}}">{{$event->title}}</a>
            </h3>
            <div class="text-xl font-bold mb-4"><a href="/?category_id={{$event->category_id}}">{{$event->category->name}}</a></div>
            <x-event-tags  :tagsCsv="$event->tags" />
            <div class="text-lg mt-4">
                <i class="fa-solid fa-location-dot"></i> <a href="/?location_id={{$event->location_id}}">{{$event->location->street}} {{$event->location->number}}, {{$event->location->city}}, {{$event->location->country}}</a>
                <p class="text-base">{{$event->start}} {{html_entity_decode('&#x2013;', ENT_COMPAT, 'UTF-8')}} {{$event->end}}</p>
            </div>
            
        </div>
    </div>
</x-card>