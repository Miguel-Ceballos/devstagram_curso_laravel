@extends('layouts.app')

@section('title')
    Creat a post
@endsection

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('content')
    <div class="md:flex md:items-center">
        <div class="md:w-1/2 px-10">
            <form action="{{ route('image.store') }}"
                  method="post"
                  id="dropzone"
                  enctype="multipart/form-data"
                  class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center">
@csrf
            </form>
        </div>
        <div class="md:w-1/2 bg-white p-10 rounded-lg shadow-lg mt-10 md:mt-0">
            <form action="{{ route('post.store') }}"
                  method="post">
                @csrf
                <div class="mb-5">
                    <label for="title"
                           class="mb-2 block uppercase text-gray-500 font-bold">Title:</label>
                    <input type="text"
                           name="title"
                           id="title"
                           placeholder="Post title"
                           value="{{ old('title') }}"
                           class="border p-3 w-full rounded-sm @error('title') border-red-500 @enderror"
                    >
                    @error('title')
                    <p class="text-xs text-red-500 mt-2">*{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="body"
                           class="mb-2 block uppercase text-gray-500 font-bold">Description:</label>
                    <textarea
                        name="body"
                        id="body"
                        placeholder="Post body"
                        class="border p-3 w-full rounded-sm @error('body') border-red-500 @enderror"
                    >{{ old('body') }}</textarea>
                    @error('body')
                    <p class="text-xs text-red-500 mt-2">*{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <input type="hidden" id="image" name="image" value="{{ old('image') }}">
                    @error('image')
                    <p class="text-xs text-red-500 mt-2">*{{ $message }}</p>
                    @enderror
                </div>

                <input type="submit"
                       value="Create post"
                       class="bg-indigo-500 hover:bg-indigo-600 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                >
            </form>
        </div>
    </div>
@endsection
