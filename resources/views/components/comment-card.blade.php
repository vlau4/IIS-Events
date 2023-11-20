@props(['event', 'comments'])

<div class="">
    <x-card class="px-10">
        <div class="m-2">
            <form action="{{ route('comment.store', $event) }}" method="post">
                @csrf {{-- protection --}}
                <div class="mt-4 text-lg">
                    <textarea name="content" rows="1" cols="100" class="text-base"></textarea>
                    <button class="mx-2 border border-gray-200 rounded">Post Comment</button>
                </div>
            </form>
        </div>
        @foreach ($comments as $comment)
        <div class="px-2 m-2 border border-gray-200 rounded flex">
            <h4 class="font-bold">{{$comment->user->name}}</h4>
            <p class="mx-6">{{$comment->content}}</p>
        </div>
        @endforeach
    </x-card>
</div>