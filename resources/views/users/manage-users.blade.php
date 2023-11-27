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
                            <td class="px-16 py-4 border-t border-b border-gray-300 text-lg">
                                {{$user->name}}
                            </td>
                            <td class="px-16 py-4 border-t border-b border-gray-300 text-lg">
                                <form method="POST" action="{{ route('user', $user) }}" enctype="multipart/form-data">
                                    @csrf {{-- protection--}}
                                    @method('PUT')
                                    <div class="flex">
                                        <div class="">
                                            <select class="border border-gray-200 rounded p-2" name="role">
                                                <option value="0" {{($user->role == 'user') ? "selected":"" }}>user</option>
                                                <option value="1" {{($user->role == 'manager') ? "selected":"" }}>manager</option>
                                                <option value="2" {{($user->role == 'admin') ? "selected":"" }}>admin</option>
                                            </select>
                                        </div>

                                        <div class="mx-4">
                                            <button class="bg-sky-900 text-white rounded py-2 px-4 hover:bg-black">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </td>
                            <td class="px-16 py-4 border-t border-b border-gray-300 text-lg">
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
                        <td></td>
                        <td class="px-1 pt-10">
                            <p class="text-center">There are not any users.</p>
                        </td>
                        <td></td>
                    </tr>
                @endunless
            </tbody>
        </table>
    </x-card>
</x-layout>