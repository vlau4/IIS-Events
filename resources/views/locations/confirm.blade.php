<x-layout>
    <x-card class="p-10">
        <header>
            <h1 class="text-3xl text-center font-bold my-6 uppercase">Confirm Locations | {{count($locations)}}</h1>
        </header>

        <table class="w-full table-auto rounded-sm">
            <tbody>
                <tr class="text-bold">
                    <td class="px-1 py-2 border-b border-gray-300 text-lg">Adress</td>
                    <td class="px-1 py-2 border-b border-gray-300 text-lg"></td>
                    <td class="px-1 py-2 border-b border-gray-300 text-lg"></td>
                </tr>
                @unless($locations->isEmpty())
                    @foreach($locations as $location)
                        <tr class="border-gray-300">
                            <td class="px-1 py-1 border-t border-b border-gray-300">{{$location->street}} {{$location->number}}, {{$location->city}} {{$location->zip}}, {{$location->country}}</td>
                            <td class="px-1 py-1 border-t border-b border-gray-300">
                                <form method="POST" action="{{ route('location.confirm', $location) }}">
                                    @csrf
                                    <button class="text-green-600">
                                        <i class="fa-solid fa-check"></i> Confirm</a>
                                    </button>
                                </form>
                            </td>
                            <td class="px-1 py-1 border-t border-b border-gray-300">
                                <form method="POST" action="{{ route('location.unconfirm', [$location]) }}">
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
                            <p class="text-center">No new locations found.</p>
                        </td>
                    </tr>
                @endunless
            </tbody>
        </table>
    </x-card>
</x-layout>