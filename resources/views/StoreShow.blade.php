@extends('layouts.app')

@section('content')
    <div class="w-full mx-auto mt-5">
        <a href="/dashboard/store">
            <button type="button" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium text-sm px-5 py-2.5 mr-2 mb-2">Back</button>
        </a>
    </div>

    <div class="w-full mx-auto lg:flex lg:w-1/2">
        <div class="flex flex-col justify-center items-center w-full">
            <div class="bg-white shadow-[#e3e3e3] shadow-md mt-5 p-6 w-full max-w-md">
                <h2 class="text-4xl leading-10 tracking-tight font-bold text-gray-900 text-center">{{ $storeItem->name }}</h2>
                <p class="text-center mt-2">Price: {{ $storeItem->price / 100 }} EUR</p>
                <p class="mt-5">{{ $storeItem->description }}</p>
            </div>
        </div>
    </div>

    <div class="text-center mt-5">
        <a href="/dashboard/store/{{ $storeItem->id }}/buy">
            <button type="button" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium text-sm px-5 py-2.5 mr-2 mb-2">Buy</button>
        </a>
    </div>
@endsection
