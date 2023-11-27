<x-layout>
    <x-card class="p-10">
        <header>
            <h1 class="text-3xl text-center font-bold my-6 uppercase">Manage Categories</h1>
        </header>

        {{-- TODO: Header --}}
        <table class="w-full table-auto rounded-sm">
            <tbody>
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
                            <td class="px-1 py-1 border-t border-b border-gray-300">
                                {{$category->name}}
                            </td>
                            <td class="px-1 py-1 border-t border-b border-gray-300">{{$parent}}</td>
                            <td class="px-1 py-1 border-t border-b border-gray-300">
                                <a href="{{ Route('category.edit', $category) }}" class="text-sky-700 px-6 py-2 rounded-xl" >
                                    <i class="fa-solid fa-pen-to-square"></i> Edit</a>
                            </td>
                            <td class="px-1 py-1 border-t border-b border-gray-300">
                                <form method="POST" action="{{ Route('category.delete', $category) }}">
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
                            <p class="text-center">There are not any categories.</p>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                @endunless
            </tbody>
        </table>
    </x-card>
</x-layout>