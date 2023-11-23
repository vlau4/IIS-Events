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
                                <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="block text-white bg-rose-800 hover:bg-rose-900 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="button">
                                    <i class="fa-solid fa-trash"></i> Delete
                                </button>
                        
                                <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                            <div class="p-4 md:p-5 text-center">
                                                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                </svg>
                                                <h3 class="mb-2 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete {{$user->name}}'s account?</h3>
                                                <p class="mb-5 font-normal text-gray-500 dark:text-gray-400">This action cannot be undone!</p>
                                                
                                                <div class="flex flex-col-2 items-center justify-center text-center">
                                                    <form method="POST" action="{{ route('user.destroy', $user) }}" enctype="multipart/form-data">
                                                        @csrf 
                                                        <button data-modal-hide="popup-modal" class="text-white bg-rose-800 hover:bg-rose-900 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                                                            Delete
                                                        </button>
                                                    </form>
                                                
                                                    <button data-modal-hide="popup-modal" class="text-gray-500 bg-white hover:bg-gray-100 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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