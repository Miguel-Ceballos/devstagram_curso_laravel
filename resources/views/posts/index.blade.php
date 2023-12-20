@extends('layouts.app')

@section('title')

@endsection

@section('content')
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5">
                <img src="{{ $user->image ? asset('profiles/' . $user->image) : asset('img/usuario.svg') }}"
                     alt="user image" class="rounded-full">
            </div>
            <div
                    class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-5 md:py-5">
                <div class="flex gap-2 items-center mb-5">
                    <p class="text-gray-700 text-2xl">{{ $user->username }}</p>

                    @auth()
                        @if($user->id === auth()->user()->id)
                            <a href="{{ route('profile.index') }}"
                               class="text-gray-500 hover:text-gray-600 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                     data-slot="icon" class="w-4 h-4">
                                    <path
                                            d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z"/>
                                </svg>
                            </a>
                        @endif
                    @endauth
                </div>

                <p class="text-gray-800 text-sm mb-2 font-bold">
                    {{ $user->followers->count() }}
                    <span class="font-normal">@choice('Follower|Followers', $user->followers->count())</span>
                </p>
                <p class="text-gray-800 text-sm mb-2 font-bold">
                    {{ $user->followings->count() }}
                    <span class="font-normal">following</span>
                </p>
                <p class="text-gray-800 text-sm mb-2 font-bold">
                    {{ $user->posts->count() }}
                    <span class="font-normal">Posts</span>
                </p>

                @auth()
                    @if($user->id !== auth()->user()->id )

                        @if(!$user->following(auth()->user()))
                            <form action="{{ route('follower.store', $user) }}" method="post">
                                @csrf
                                <input type="submit" value="Follow"
                                       class="bg-blue-500 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer">
                            </form>
                        @else
                            <form action="{{ route('follower.destroy', $user)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Unfollow"
                                       class="bg-red-500 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer">
                            </form>
                        @endif

                    @endif
                @endauth

            </div>
        </div>
    </div>

    <section class="container mx-auto mt-10">
        <h2 class="text-4xl text-center font-black my-10">Posts</h2>

        <x-listar-post :posts="$posts"/>

    </section>

@endsection
