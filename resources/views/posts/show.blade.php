@extends('layouts.app')

@section('title')
    {{ $post->title }}
@endsection

@section('content')

    @if(session('message'))
        <div class="fixed right-2 top-24">
            <p class="bg-green-600 p-2 rounded-lg text-white text-sm">{{ session('message') }}</p>
        </div>
    @endif

    <div class="container mx-auto md:flex">
        <div class="md:w-1/2 p-5">
            <img src="{{ asset('uploads/' . $post->image) }}" alt="Image post {{ $post->title }}">

            <div class="p-3 flex items-center gap-4">
                @auth()
                    <livewire:like-post :post="$post"/>
                @endauth


            </div>

            <div class="mt-2">
                <p class="font-bold">{{ $post->user->username }}</p>
                <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                <p class="mt-5">{{ $post->body }}</p>
            </div>

            @auth()
                @if($post->user_id === auth()->user()->id)
                    <form action="{{ route('post.destroy', $post) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Delete Post"
                               class="bg-red-500 hover:bg-red-600 p-2 rounded text-white uppercase mt-4 cursor-pointer">
                    </form>
                @endif
            @endauth

        </div>
        <div class="md:w-1/2 p-5">
            <div class="shadow bg-white p-5 mb-5 rounded-lg">
                <p class="text-xl font-bold text-center mb-4">Add new comment</p>

                @auth
                    <form action="{{ route('comment.store', [$user, $post]) }}" method="post">
                        @csrf
                        <div class="mb-5">
                            <label for="comment"
                                   class="mb-2 block uppercase text-gray-500 font-bold">Comment:</label>
                            <textarea
                                name="comment"
                                id="comment"
                                placeholder="Comment here"
                                class="border p-3 w-full rounded-sm @error('comment') border-red-500 @enderror"></textarea>
                            @error('comment')
                            <p class="text-xs text-red-500 mt-2">*{{ $message }}</p>
                            @enderror
                        </div>

                        <input type="submit"
                               value="Create Comment"
                               class="bg-indigo-500 hover:bg-indigo-600 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                        >
                    </form>
                @else
                    <p class="text-center text-gray-500">Create an account to add comments on this post.</p>
                @endauth

            </div>

            <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll rounded-lg">
                @if($post->comments->count())
                    @foreach($post->comments as $comment)
                        <div class="p-5 border-gray-200 border-b">
                            <a href="{{ route('dashboard', $comment->user->username) }}"
                               class="font-bold text-sm text-gray-700">{{ $comment->user->username }}</a>
                            <p class="my-1">{{ $comment->comment }}</p>
                            <p class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                        </div>
                    @endforeach
                @else
                    <p class="text-center text-gray-500 text-sm p-4">This post not have comments.</p>
                @endif

            </div>
        </div>
    </div>
@endsection
