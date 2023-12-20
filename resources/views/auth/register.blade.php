@extends('layouts.app')

@section('title')
    Create account
@endsection

@section('content')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12">
            <img src="{{ asset('img/Design/register.jpg') }}"
                 alt="">
        </div>
        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-lg">
            <form action="{{ route('register') }}"
                  method="post">
                @csrf
                <div class="mb-5">
                    <label for="name"
                           class="mb-2 block uppercase text-gray-500 font-bold">Name:</label>
                    <input type="text"
                           name="name"
                           id="name"
                           value="{{ old('name') }}"
                           class="border p-3 w-full rounded-sm @error('name') border-red-500 @enderror"
                    >
                    @error('name')
                    <p class="text-xs text-red-500 mt-2">*{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="username"
                           class="mb-2 block uppercase text-gray-500 font-bold">Username:</label>
                    <input type="text"
                           name="username"
                           id="username"
                           value="{{ old('username') }}"
                           class="border p-3 w-full rounded-sm @error('username') border-red-500 @enderror"
                    >
                    @error('username')
                    <p class="text-xs text-red-500 mt-2">*{{ $message }}</p>
                    @enderror
                </div>
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
                <div class="mb-5">
                    <label for="password_confirmation"
                           class="mb-2 block uppercase text-gray-500 font-bold">Repeat password:</label>
                    <input type="password"
                           name="password_confirmation"
                           id="password_confirmation"
                           class="border p-3 w-full"
                    >
                </div>
                <input type="submit"
                       value="Register"
                       class="bg-indigo-500 hover:bg-indigo-600 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                >
            </form>
        </div>
    </div>
@endsection
