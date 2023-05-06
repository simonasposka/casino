@extends('layouts.app')

@section('content')
    <div class="bg-gray-50 py-16 px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-4xl leading-10 tracking-tight font-bold text-gray-900">Categories</h2>
            <a href="/dashboard/categories/create">
                <button type="submit" class="mt-4 py-2 px-4 border border-transparent shadow-sm text-sm font-medium text-white bg-indigo-500 hover:bg-indigo-400 focus:outline-none">Create New</button>
            </a>
        </div>

        <div class="mt-5 relative overflow-x-auto pr-12">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">Id</th>
                        <th scope="col" class="px-6 py-3">Name</th>
                        <th scope="col" class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr class="bg-white border-b">
                            <td class="px-6 py-4">
                                <a href="/dashboard/categories/{{ $category->id }}">
                                    {{ $category->id }}
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                <a href="/dashboard/categories/{{ $category->id }}">
                                    {{ $category->name }}
                                </a>
                            </td>

                            <td class="px-6 py-4">
                                <a href="/dashboard/categories/{{ $category->id }}/edit">Edit</a>
                                <a href="/dashboard/categories/{{ $category->id }}/delete">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
