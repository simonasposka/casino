@extends('layouts.app')

@section('content')

    <div class="bg-gray-50 py-16 px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-4xl leading-10 tracking-tight font-bold text-gray-900">My bets</h2>
        </div>
    </div>

    <div class="mt-5 relative overflow-x-auto pr-12">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">Id</th>
                <th scope="col" class="px-6 py-3">Category</th>
                <th scope="col" class="px-6 py-3">Selected outcome </th>
                <th scope="col" class="px-6 py-3">Status</th>
                <th scope="col" class="px-6 py-3">Date</th>
                <th scope="col" class="px-6 py-3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($bets as $bet)
            {{-- {{dd($bet)}} --}}
                <tr class="bg-white border-b">
                    <td class="px-6 py-4">
                        <a href="/dashboard/bets/{{ $bet->id }}/edit">
                            {{ $bet->id }}
                        </a>
                    </td>
                    <td>
                        <a href="/dashboard/bets/{{ $bet->id }}/edit">
                                {{ $bet->listing->category->name }}
                        </a>
                    </td>
                    <td class="px-6 py-4">
                        <a href="/dashboard/bets/{{ $bet->id }}/edit">
                            {{ $bet->value }}
                        </a>
                    </td>
                    <td class="px-6 py-4">
                        <a href="/dashboard/bets/{{ $bet->id }}/edit">
                            {{ $bet->listing->status }}
                        </a>
                    </td>
                    <td class="px-6 py-4">
                        <a href="/dashboard/bets/{{ $bet->id }}/edit">
                            {{ $bet->listing->event->date_of_event }}
                        </a>
                    </td>
                    <td class="px-6 py-4">
                        <a href="/dashboard/bets/{{ $bet->id }}/delete">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
