<x-layout>
    <x-card class="p-10">
        <header>
            <h1 class="text-3xl text-center font-bold my-6 uppercase">Confirm Categories | {{count($categories)}}</h1>
        </header>

        <table class="w-full table-auto rounded-sm">
            <tbody>
                <tr class="text-bold">
                    <td class="px-1 py-2 border-b border-gray-300 text-lg">Name</td>
                    <td class="px-1 py-2 border-b border-gray-300 text-lg">Parent Category</td>
                    <td class="px-1 py-2 border-b border-gray-300 text-lg"></td>
                    <td class="px-1 py-2 border-b border-gray-300 text-lg"></td>
                </tr>
                @unless($categories->isEmpty())
                    @foreach($categories as $category)
                    @php
                        if($category->parent) {
                            $parent = $category->parent->name;
                        } else {
                            $parent = '-';
                        }
                    @endphp
                        <tr class="border-gray-300">
                            <td class="px-1 py-1 border-t border-b border-gray-300">{{$category->name}}</td>
                            <td class="px-1 py-1 border-t border-b border-gray-300">{{$parent}}</td>

                            <td class="px-1 py-1 border-t border-b border-gray-300">
                                <form method="POST" action="{{ route('category.confirm', $category) }}">
                                    @csrf
                                    <button class="text-green-600">
                                        <i class="fa-solid fa-check"></i> Confirm</a>
                                    </button>
                                </form>
                            </td>
                            <td class="px-1 py-1 border-t border-b border-gray-300">
                                <form method="POST" action="{{ route('category.unconfirm', [$category]) }}">
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
                            <p class="text-center">No new categories found.</p>
                        </td>
                    </tr>
                @endunless
            </tbody>
        </table>
    </x-card>
</x-layout>