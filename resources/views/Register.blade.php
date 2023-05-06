@extends('layouts.app')

@section('content')

<div class="w-full mx-auto lg:flex lg:w-1/2 mt-52">
    <div class="flex flex-col justify-center items-center h-full w-full">
        <h2 class="text-4xl leading-10 tracking-tight font-bold text-gray-900 text-center">Register</h2>
        <div class="bg-white shadow-[#e3e3e3] shadow-md mt-5 p-6 w-full max-w-md">
            <form action="/register" method="POST">
                @csrf

                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" class="mt-1 py-2 px-3 block w-full border border-gray-400 shadow-sm" value="{{ old('name') }}"  autofocus>

                <label for="email" class="block mt-4 text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" class="mt-1 py-2 px-3 block w-full border border-gray-400 shadow-sm" value="{{ old('email') }}">

                <label for="password" class="block mt-4 text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" class="mt-1 py-2 px-3 block w-full border border-gray-400 shadow-sm" value="{{ old('password') }}">

                <label for="password" class="block mt-4 text-sm font-medium text-gray-700">Password confirmation</label>
                <input type="password" name="password_confirmation" class="mt-1 py-2 px-3 block w-full border border-gray-400 shadow-sm" value="{{ old('password_confirmation') }}">


                @if($errors->any())
                    {!! implode('', $errors->all('<p class="mt-4 text-red-500">:message</p>')) !!}
                @endIf

                <button type="submit" class="mt-4 py-2 px-4 w-full border border-transparent shadow-sm text-sm font-medium text-white bg-indigo-500 hover:bg-indigo-400 focus:outline-none">
                    Register
                </button>

            </form>
        </div>
    </div>
</div>

@endsection
