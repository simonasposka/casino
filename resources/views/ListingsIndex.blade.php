@extends('layouts.app')

@section('content')

    <div class="bg-gray-50 py-16 px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-4xl leading-10 tracking-tight font-bold text-gray-900">Listings</h2>
            <a href="/dashboard/listings/create">
                <button type="submit" class="mt-4 py-2 px-4 border border-transparent shadow-sm text-sm font-medium text-white bg-indigo-500 hover:bg-indigo-400 focus:outline-none">Create New</button>
            </a>
        </div>
    </div>

    <div class="mt-5 relative overflow-x-auto pr-12">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">Id</th>
                <th scope="col" class="px-6 py-3">Outcome</th>
                <th scope="col" class="px-6 py-3">Outcome 1</th>
                <th scope="col" class="px-6 py-3">Outcome 2</th>
                <th scope="col" class="px-6 py-3">Status</th>
                <th scope="col" class="px-6 py-3">Date</th>
            </tr>
            </thead>
            <tbody>
            @foreach($listings as $listing)
                <tr class="bg-white border-b">
                    <td class="px-6 py-4">
                        <a href="/dashboard/listings/{{ $listing->id }}">
                            {{ $listing->id }}
                        </a>
                    </td>
                    <td class="px-6 py-4">
                        <a href="/dashboard/listings/{{ $listing->id }}">
                            @if(is_null($listing->outcome))
                                -
                            @else
                                {{ $listing->outcome }}
                            @endif
                        </a>
                    </td>
                    <td class="px-6 py-4">
                        <a href="/dashboard/listings/{{ $listing->id }}">
                            {{ $listing->outcome_label_one }}
                        </a>
                    </td>
                    <td class="px-6 py-4">
                        <a href="/dashboard/listings/{{ $listing->id }}">
                            {{ $listing->outcome_label_two }}
                        </a>
                    </td>
                    <td class="px-6 py-4">
                        <a href="/dashboard/listings/{{ $listing->id }}">
                            {{ $listing->status }}
                        </a>
                    </td>
                    <td class="px-6 py-4">
                        <a href="/dashboard/listings/{{ $listing->id }}">
                            {{ $listing->event->date_of_event }}
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


@endsection
