<x-layout>
    <x-card class="p-10">
        <header>
            <h1 class="text-3xl text-center font-bold my-6 uppercase">Manage Locations</h1>
        </header>

        <table class="w-full table-auto rounded-sm">
            <tbody>
                @unless($locations->isEmpty())
                    @foreach($locations as $location)
                        <tr class="border-gray-300">
                            <td class="px-1 py-1 border-t border-b border-gray-300">
                                {{$location->street}} {{$location->number}}, {{$location->city}} {{$location->zip}}, {{$location->country}}
                            </td>
                            <td class="px-1 py-1 border-t border-b border-gray-300">
                                <a href="{{ Route('location.edit', $location) }}" class="text-sky-700 px-6 py-2 rounded-xl" >
                                    <i class="fa-solid fa-pen-to-square"></i> Edit</a>
                            </td>
                            <td class="px-1 py-1 border-t border-b border-gray-300">
                                <form method="POST" action="{{ Route('location.delete', $location) }}">
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
                            <p class="text-center">There are not any locations.</p>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                @endunless
            </tbody>
        </table>
    </x-card>
</x-layout>