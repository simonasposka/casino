@extends('layouts.app')

@section('content')
    <div class="w-full mx-auto lg:flex lg:w-1/2 mt-52">
        <div class="flex flex-col justify-center items-center w-full">
            <h2 class="text-4xl leading-10 tracking-tight font-bold text-gray-900 text-center">Edit Bet</h2>
            <div class="bg-white shadow-[#e3e3e3] shadow-md mt-5 p-6 w-full max-w-md">
                <form action="/dashboard/bets/{{ $bet->id }}" method="POST">
                    @csrf
                    <input name="_method" type="hidden" value="PUT">
                    <label for="name" class="block text-sm font-medium text-gray-700">Select outcome</label>
                    <label>
                        <input type="radio" name="outcome" value="{{ $bet->listing->outcome_label_one }}" required>
                        {{ $bet->listing->outcome_label_one }}
                    </label>

                    <label>
                        <input type="radio" name="outcome" value="{{ $bet->listing->outcome_label_two }}" required>
                        {{ $bet->listing->outcome_label_two }}
                    </label>

                    @if($errors->any())
                        {!! implode('', $errors->all('<p class="mt-4 text-red-500">:message</p>')) !!}
                    @endIf

                    <button type="submit" class="mt-4 py-2 px-4 w-full border border-transparent shadow-sm text-sm font-medium text-white bg-indigo-500 hover:bg-indigo-400 focus:outline-none">
                        Update
                    </button>
                </form>
            </div>
            <a href="/dashboard/bets">
                <button type="button" class="mt-5 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium text-sm px-5 py-2.5 mr-2 mb-2">Cancel</button>
            </a>
        </div>
    </div>

@endsection
