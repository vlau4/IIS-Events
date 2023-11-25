<x-layout>
    <x-card class="p-10">
        <header>
            <h1 class="text-3xl text-center font-bold my-6 uppercase">Manage Events</h1>
        </header>

        <table class="w-full table-auto rounded-sm">
            <tbody>
                @unless($events->isEmpty())
                    @foreach($events as $event)
                        <tr class="border-gray-300">
                            <td class="px-1 py-1 border-t border-b border-gray-300">
                                <a href="{{ Route('event.show', $event) }}">{{$event->title}}</a>
                            </td>
                            <td class="px-1 py-1 border-t border-b border-gray-300">
                                <a href="{{ Route('event.edit', $event) }}" class="text-sky-700 px-6 py-2 rounded-xl" >
                                    <i class="fa-solid fa-pen-to-square"></i> Edit</a>
                            </td>
                            <td class="px-1 py-1 border-t border-b border-gray-300">
                                <a href="{{ Route('event.payments', $event) }}" class="text-sky-700 px-6 py-2 rounded-xl" >
                                    <i class="fa-solid fa-pen-to-square"></i> Payments</a>
                            </td>
                            <td class="px-1 py-1 border-t border-b border-gray-300">
                                <form method="POST" action="{{ route('event.destroy', $event) }}">
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
                            <p class="text-center">You did not post any events. Try to <a href="{{ Route('event.create') }}" class="text-sky-700 underline">POST</a> any.</p>
                        </td>
                    </tr>
                @endunless
            </tbody>
        </table>
    </x-card>
</x-layout>