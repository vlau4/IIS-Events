<x-layout>
    <x-card class="p-10">
        <header>
            <h1 class="text-3xl text-center font-bold my-6 uppercase">Confirm Events | {{count($events)}}</h1>
        </header>

        <table class="w-full table-auto rounded-sm">
            <tbody>
                @unless($events->isEmpty())
                    @foreach($events as $event)
                        <tr class="border-gray-300">
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <a href="{{ Route('event.show', $event) }}">{{$event->title}}</a>
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <form method="POST" action="{{ route('event.confirm', $event) }}">
                                    @csrf
                                    <button class="text-green-600">
                                        <i class="fa-solid fa-check"></i> Confirm</a>
                                    </button>
                                </form>
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
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
                        <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                            <p class="text-center">No new events found.</p>
                        </td>
                    </tr>
                @endunless
            </tbody>
        </table>
    </x-card>
</x-layout>