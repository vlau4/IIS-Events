<x-layout>
    <x-card class="p-10">
        <header>
            <h1 class="text-3xl text-center font-bold my-6 uppercase">Confirm Events | {{count($events)}}</h1>
        </header>

        <table class="w-full table-auto rounded-sm">
            <tbody>
                <tr class="text-bold">
                    <td class="px-1 py-2 border-b border-gray-300 text-lg"></td>
                    <td class="px-1 py-2 border-b border-gray-300 text-lg">Title</td>
                    <td class="px-1 py-2 border-b border-gray-300 text-lg">User</td>
                    <td class="px-1 py-2 border-b border-gray-300 text-lg">Category</td>
                    <td class="px-1 py-2 border-b border-gray-300 text-lg">Adress</td>
                    <td class="px-1 py-2 border-b border-gray-300 text-lg">Start</td>
                    <td class="px-1 py-2 border-b border-gray-300 text-lg">End</td>
                    <td class="px-1 py-2 border-b border-gray-300 text-lg"></td>
                    <td class="px-1 py-2 border-b border-gray-300 text-lg"></td>
                </tr>
                @unless($events->isEmpty())
                    @foreach($events as $event)
                        <tr class="border-gray-300">
                            <td class="px-1 py-1 border-t border-b border-gray-300">
                                <img class="w-40" src="{{$event->logo ? asset('storage/' . $event->logo) : asset('/images/no-image.png')}}" alt=""/>
                            </td>
                            <td class="px-1 py-8 border-t border-b border-gray-300">
                                <a href="{{ Route('event.show', $event) }}">{{$event->title}}</a>
                            </td>
                            <td class="px-1 py-1 border-t border-b border-gray-300">{{$event->user->name}}</td>
                            <td class="px-1 py-1 border-t border-b border-gray-300">{{$event->category->name}}</td>
                            <td class="px-1 py-1 border-t border-b border-gray-300">{{$event->location->street}} {{$event->location->number}}, {{$event->location->city}} {{$event->location->zip}}, {{$event->location->country}}</td>
                            <td class="px-1 py-1 border-t border-b border-gray-300">{{$event->start}}</td>
                            <td class="px-1 py-1 border-t border-b border-gray-300">{{$event->end}}</td>
                            <td class="px-1 py-1 border-t border-b border-gray-300">
                                <form method="POST" action="{{ route('event.confirm', $event) }}">
                                    @csrf
                                    <button class="text-green-600">
                                        <i class="fa-solid fa-check"></i> Confirm</a>
                                    </button>
                                </form>
                            </td>
                            <td class="px-1 py-1 border-t border-b border-gray-300">
                                <form method="POST" action="{{ route('event.unconfirm', [$event]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600">
                                        <i class="fa-solid fa-trash-can"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr> 
                    @endforeach
                @else
                    <tr class="border-gray-300">
                        <td class="px-1 pt-10">
                            <p class="text-center">No new events for confirmation.</p>
                        </td>
                    </tr>
                @endunless
            </tbody>
        </table>
    </x-card>
</x-layout>