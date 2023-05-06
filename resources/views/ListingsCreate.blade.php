@extends('layouts.app')

@section('content')
    <div class="w-full mx-auto lg:flex lg:w-1/2 mt-52">
        <div class="flex flex-col justify-center items-center w-full">
            <h2 class="text-4xl leading-10 tracking-tight font-bold text-gray-900 text-center">Create Listing</h2>
            <div class="bg-white shadow-[#e3e3e3] shadow-md mt-5 p-6 w-full max-w-md">
                <form action="/dashboard/listings" method="POST">
                    @csrf

                    <label for="name" class="block text-sm font-medium text-gray-700">First label</label>
                    <input type="text" name="first_label" class="mt-1 py-2 px-3 block w-full border border-gray-400 shadow-sm" value="{{ old('first_label') }}" autofocus>

                    <label for="name" class="block 4 mt-4 text-sm font-medium text-gray-700">Second label</label>
                    <input type="text" name="second_label" class="mt-1 py-2 px-3 block w-full border border-gray-400 shadow-sm" value="{{ old('second_label') }}">

                    <label for="name" class="block 4 mt-4 text-sm font-medium text-gray-700">Event</label>
                    <select name="event_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="null">Select event</option>
                        @foreach($events as $event)
                            <option value="{{ $event['id'] }}">
                                {{ json_decode($event->config, true)['teams']['0']['name'] }} | {{ json_decode($event->config, true)['teams']['0']['odds'] }}% vs
                                {{ json_decode($event->config, true)['teams']['1']['name'] }} | {{ json_decode($event->config, true)['teams']['1']['odds'] }}% ({{ $event->location }})
                            </option>
                        @endforeach
                    </select>


                    @if($errors->any())
                        {!! implode('', $errors->all('<p class="mt-4 text-red-500">:message</p>')) !!}
                    @endIf

                    <button type="submit" class="mt-4 py-2 px-4 w-full border border-transparent shadow-sm text-sm font-medium text-white bg-indigo-500 hover:bg-indigo-400 focus:outline-none">
                        Create
                    </button>

                </form>
            </div>
        </div>
    </div>

@endsection
