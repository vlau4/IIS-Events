<x-layout>
    <x-card class="p-10">
        <header>
            <h1 class="text-3xl text-center font-bold my-6 uppercase">Manage Payments</h1>
        </header>

        <h2 class="text-3xl my-6 uppercase border-b-2 border-gray-700">Unconfirmed payments</h2>
        <table class="w-full table-auto rounded-sm">
            <tbody>
                @unless($attendings->isEmpty())
                    @foreach($attendings as $attending)
                        @if($attending->paid == 0)
                            <tr class="border-gray-300">
                                <td class="px-4 py-4 border-t border-b border-gray-300 text-lg">
                                    {{$attending->user->name}}, {{$attending->user->email}}
                                </td>
                                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                    <form method="POST" action="{{ route('payments.confirm', $attending) }}">
                                        @csrf
                                        <button class="text-green-600">
                                            <i class="fa-solid fa-check"></i> Confirm</a>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                @else
                    <tr class="border-gray-300">
                        <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                            <p class="text-center">No users are attending the event.</p>
                        </td>
                    </tr>
                @endunless
            </tbody>
        </table>
        <h2 class="text-3xl my-6 uppercase border-b-2 border-gray-700">Confirmed payments</h2>
        <table class="w-full table-auto rounded-sm">
            <tbody>
                @unless($attendings->isEmpty())
                    @foreach($attendings as $attending)
                        @if($attending->paid == 1)
                            <tr class="border-gray-300">
                                <td class="px-4 py-4 border-t border-b border-gray-300 text-lg">
                                    {{$attending->user->name}}, {{$attending->user->email}}
                                </td>
                            </tr>
                        @endif
                    @endforeach
                @else
                    <tr class="border-gray-300">
                        <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                            <p class="text-center">No users are attending the event.</p>
                        </td>
                    </tr>
                @endunless
            </tbody>
        </table>
    </x-card>
</x-layout>