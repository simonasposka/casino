@extends('layouts.app')

@section('content')
    <div class="bg-gray-50 py-16 px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-4xl leading-10 tracking-tight font-bold text-gray-900">Items</h2>
            <a href="/dashboard/items/create">
                <button type="submit" class="mt-4 py-2 px-4 border border-transparent shadow-sm text-sm font-medium text-white bg-indigo-500 hover:bg-indigo-400 focus:outline-none">Create New</button>
            </a>
        </div>

        <div class="mt-5 relative overflow-x-auto pr-12">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">Id</th>
                        <th scope="col" class="px-6 py-3">Name</th>
                        <th scope="col" class="px-6 py-3">Description</th>
                        <th scope="col" class="px-6 py-3">Value</th>
                        <th scope="col" class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        <tr class="bg-white border-b">
                            <td class="px-6 py-4">
                                <a href="/dashboard/items/{{ $item->id }}">
                                    {{ $item->id }}
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                <a href="/dashboard/items/{{ $item->id }}">
                                    {{ $item->name }}
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                <a href="/dashboard/items/{{ $item->id }}">
                                    {{ $item->description }}
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                <a href="/dashboard/items/{{ $item->id }}">
                                    {{ $item->value / 100 }} EUR
                                </a>
                            </td>

                            <td class="px-6 py-4">
                                <a href="/dashboard/items/{{ $item->id }}/delete">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
