@extends('layouts.app')

@section('content')
    <div class="w-full mx-auto lg:flex lg:w-1/2 mt-52">
        <div class="flex flex-col justify-center items-center w-full">
            <h2 class="text-4xl leading-10 tracking-tight font-bold text-gray-900 text-center">Add item to bet you want to join</h2>
            <div class="bg-white shadow-[#e3e3e3] shadow-md mt-5 p-6 w-full max-w-md">
                <form action="/dashboard/listings/{{ $listingId }}/bets/{{ $betId  }}/items/join" method="POST">
                    @csrf

                    <label for="item_id" class="block 4 mt-4 text-sm font-medium text-gray-700">Item</label>
                    <select name="item_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach($items as $item)
                            <option value="{{ $item->id }}">{{ $item->name }} | {{ $item->value / 100 }} EUR</option>
                        @endforeach
                    </select>


                    @if($errors->any())
                        {!! implode('', $errors->all('<p class="mt-4 text-red-500">:message</p>')) !!}
                    @endIf

                    <button type="submit" class="mt-4 py-2 px-4 w-full border border-transparent shadow-sm text-sm font-medium text-white bg-indigo-500 hover:bg-indigo-400 focus:outline-none">
                        Join
                    </button>
                </form>
            </div>
            <a href="/dashboard/listings/{{ $listingId }}">
                <button type="button" class="mt-5 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium text-sm px-5 py-2.5 mr-2 mb-2">Cancel</button>
            </a>
        </div>
    </div>

@endsection
