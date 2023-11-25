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
        
        <table class="w-full table-auto rounded-sm">
            <tbody>
                @unless($comments->isEmpty())
                    @foreach($comments as $comment)
                        <tr class="border-gray-300">
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                {{$comment->user->name}}
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                {{$comment->content}}
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                @if($comment->user_id == auth()->user()->id)
                                    <form method="POST" action="{{ route('comment.delete', $comment) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600">
                                            <i class="fa-solid fa-x"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endunless
            </tbody>
        </table>
    </x-card>
</div>