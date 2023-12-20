@extends('layouts.app')

@section('title')
    Log In on DevStagram!
@endsection

@section('content')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12">
            <img src="{{ asset('img/Design/login.jpg') }}"
                 alt="">
        </div>
        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-lg">
            <form action="{{ route('login') }}"
                  method="post">
                @csrf
                <div class="mb-5">
                    <label for="email"
                           class="mb-2 block uppercase text-gray-500 font-bold">Email:</label>
                    <input type="email"
                           name="email"
                           id="email"
                           value="{{ old('email') }}"
                           class="border p-3 w-full rounded-sm @error('email') border-red-500 @enderror"
                    >
                    @error('email')
                    <p class="text-xs text-red-500 mt-2">*{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password"
                           class="mb-2 block uppercase text-gray-500 font-bold">Password:</label>
                    <input type="password"
                           name="password"
                           id="password"
                           class="border p-3 w-full rounded-sm @error('email') border-red-500 @enderror"
                    >
                    @error('password')
                    <p class="text-xs text-red-500 mt-2">*{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5 flex gap-1">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember" class="text-xs text-gray-500">Remember me</label>
                </div>
                @if(session('message'))
                    <div class="mt-2">
                        <p class="text-xs text-red-500">*{{ session('message') }}</p>
                    </div>
                @endif
                <input type="submit"
                       value="Log In"
                       class="bg-indigo-500 hover:bg-indigo-600 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg mt-2"
                >
            </form>
        </div>
    </div>
@endsection
