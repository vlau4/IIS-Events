<x-layout>
    <x-card class="p-10 max-w-lg mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">Create a Category</h2>
            <p class="mb-4">for new events</p>
        </header>

        <form method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data">
            @csrf {{-- protection--}}
            <div class="mb-6">
                <label for="name" class="inline-block text-lg mb-2">Name *</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="name" value="{{old('name')}}" required/>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="parent" class="inline-block text-lg mb-2">Parent Category</label>
                <select class="border border-gray-200 rounded p-2 w-full" name="parent" value="{{old('parent')}}">
                    <option value="0"></option>
                    @foreach($categories as $category)
                        @if($category->parent == 0)
                            <option value="{{$category->id}}" class="font-semibold">{{$category->name}}</option>
                        @else
                            @php
                                $text = '';
                                for($i = $category->position; $i > 0; $i--) {
                                    $text .= "&nbsp;";
                                }
                                $text .= $category->name;
                            @endphp
                            <option value="{{$category->id}}">{!!$text!!}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="mb-6">
                <button class="bg-sky-900 text-white rounded py-2 px-4 hover:bg-black">Create Category</button>

                <a href="/" class="text-black ml-4"> Back </a>
            </div>
        </form>
    </x-card>
</x-layout>