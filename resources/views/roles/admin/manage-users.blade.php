<x-layout>
    <x-card class="p-10">
        <header>
            <h1 class="text-3xl text-center font-bold my-6 uppercase">Manage Users</h1>
        </header>

        <table class="w-full table-auto rounded-sm">
            <tbody>
                @unless($users->isEmpty())
                    @foreach($users as $user)
                        <tr class="border-gray-300">
                            <td class="px-4 py-4 border-t border-b border-gray-300 text-lg">
                                {{$user->name}}
                            </td>
                            <td class="py-4 border-t border-b border-gray-300 text-lg left-100">
                                <form method="POST" action="{{ route('user', $user) }}" enctype="multipart/form-data">
                                    @csrf {{-- protection--}}
                                    @method('PUT')
                                    <div class="flex">
                                        <div class="mb-6 mx-4">
                                            <select class="border border-gray-200 rounded p-2" name="role" value="{{$user->id}}">
                                                @if($user->role == 'user')
                                                    <option value="0">{{$user->role}}</option>
                                                    <option value="1">manager</option>
                                                    <option value="2">admin</option>
                                                @elseif($user->role == 'manager')
                                                    <option value="1">{{$user->role}}</option>
                                                    <option value="0">user</option>
                                                    <option value="2">admin</option>
                                                @else
                                                    <option value="2">{{$user->role}}</option>
                                                    <option value="0">user</option>
                                                    <option value="1">manager</option>
                                                @endif
                                            </select>
                                        </div>

                                        <div class="mx-4">
                                            <button class="bg-sky-900 text-white rounded py-2 px-4 hover:bg-black">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </td>
                            <td>
                                <form method="POST" action="{{ route('user.destroy', $user) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600"><i class="fa-solid fa-trash-can"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr class="border-gray-300">
                        <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                            <p class="text-center">No users found</p>
                        </td>
                    </tr>
                @endunless
            </tbody>
        </table>
    </x-card>
</x-layout>