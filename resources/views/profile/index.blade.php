@extends('layouts.app')

@section('title')
    Edit Profile: {{ auth()->user()->username }}
@endsection

@section('content')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form class="mt-10 md:mt-0" method="POST" action="{{ route('profile.store') }}"
                  enctype="multipart/form-data">
                @csrf
                <div class="mb-5">
                    <label for="username"
                           class="mb-2 block uppercase text-gray-500 font-bold">Username:</label>
                    <input type="text"
                           name="username"
                           id="username"
                           value="{{ auth()->user()->username }}"
                           class="border p-3 w-full rounded-sm @error('username') border-red-500 @enderror"
                    >
                    @error('username')
                    <p class="text-xs text-red-500 mt-2">*{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="image"
                           class="mb-2 block uppercase text-gray-500 font-bold">Image:</label>
                    <input type="file"
                           name="image"
                           id="image"
                           class="border p-3 w-full rounded-sm"
                           accept=".jpg, .jpeg, .png"
                    >
                </div>

                <input type="submit"
                       value="Save changes"
                       class="bg-indigo-500 hover:bg-indigo-600 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                >
            </form>
        </div>
    </div>
@endsection
