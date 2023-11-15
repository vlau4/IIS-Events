<x-layout>
@include('partials._hero')
@include('partials._search')

    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
    @unless(count($events) == 0)
        @foreach($events as $event)
            @if($event->confirmed == 1)
                <x-event-card :event="$event"/>
            @endif
        @endforeach
    @else
        <p>No events found.</p>
    @endunless
    </div>

    <div class="mt-6 p-4">
        {{$events->links()}}
    </div>
</x-layout>