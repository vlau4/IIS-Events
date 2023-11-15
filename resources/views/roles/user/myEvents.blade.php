{{-- <x-layout>
    <x-card class="p-10">
        <header>
            <h1 class="text-3xl text-center font-bold my-6 uppercase">Manage Users</h1>
        </header>

        <table class="w-full table-auto rounded-sm">
            <tbody>
                @unless($users->isEmpty())
                    @foreach($users as $user)
                        <tr class="border-gray-300">
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                {{$user->name}}
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <a href="/users/{{$user->id}}/edit" class="text-blue-400 px-6 py-2 rounded-xl" >
                                    <i class="fa-solid fa-pen-to-square"></i> Edit</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr class="border-gray-300">
                        <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                            <p class="text-center">No users found</p>
                            <a href="/events/create" class="absolute right-10 border border-gray-300 py-2 px-5">Post Job</a>
                        </td>
                    </tr>
                @endunless
            </tbody>
        </table>
    </x-card>
</x-layout> --}}

<x-layout>
        <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
        @if(count($events) == 0)
            <p>You have no events.</p>
        @endif
        @unless(count($events) == 0)
            @foreach($events as $event)
                @if($event->confirmed == 1)
                    @foreach($attendings as $attending)
                        @if($event->id == $attending->event_id && $attending->attending == 1)
                            <x-event-card :event="$event"/>
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