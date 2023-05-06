@extends('layouts.app')

@section('content')
    <div class="w-full mx-auto lg:flex lg:w-1/2 mt-52">
        <div class="flex flex-col justify-center items-center w-full">
            <div class="bg-white shadow-[#e3e3e3] shadow-md mt-5 p-6 w-full max-w-md text-right">
                <h2 class="text-4xl leading-10 tracking-tight font-bold text-gray-900 text-center">Delete category: {{ $category->name }}?</h2>

                <div class="flex justify-end">
                    <a href="/dashboard/categories">
                        <button type="button" class="mt-5 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium text-sm px-5 py-2.5 mr-2 mb-2">Cancel</button>
                    </a>

                    <form action="/dashboard/categories/{{ $category->id }}" method="POST">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                        <button type="submit" class="mt-5 text-white bg-indigo-500 hover:bg-indigo-400 border-gray-300 focus:outline-none focus:ring-4 focus:ring-gray-200 font-medium text-sm px-5 py-2.5 mr-2 mb-2">Confirm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
