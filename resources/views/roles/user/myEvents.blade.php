<x-layout>
        <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
        @if(count($events) == 0)
            <p>You have no events.</p>
        @endif
        @unless(count($events) == 0)
            @foreach($events as $event)
                @if($event->confirmed == 1)
                    @foreach($attendings as $attending)
                        @if($event->id == $attending->event_id)
                            <x-event-card :event="$event"/>
                            <form method="POST" action="{{route('event.remove', [$event])}}">
                                @csrf
                                <button class="text-red-500">
                                    <i class="fa-solid fa-x"></i>
                                </button>
                            </form>
                        @endif
                    @endforeach
                @endif
            @endforeach
        @else
            <p>You have no events.</p>
        @endunless
        </div>
    
        <div class="mt-6 p-4">
            {{$events->links()}}
        </div>
</x-layout>