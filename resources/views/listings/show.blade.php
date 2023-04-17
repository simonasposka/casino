@extends('layouts.app')

@section('content')

    <div class="bg-gray-50 py-16 px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-4xl leading-10 tracking-tight font-bold text-gray-900">Listing</h2>
            <p class="mt-2">status: <em>{{ $listing->status }}</em></p>
            <p class="mt-2">{{ $listing->created_at }}</p>
        </div>
    </div>

    <div class="mt-5 relative overflow-x-auto">
        <table class="w-full lg:w-1/2 text-sm mx-auto text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">Outcome 1</th>
                <th scope="col" class="px-6 py-3 text-right">Outcome 2</th>
            </tr>
            </thead>
            <tbody>
                <tr class="bg-white border-b">
                    <td class="px-6 py-4">
                        <p>{{ $listing->outcome_label_one }}</p>
                        <button type="button" class="mt-2 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium text-sm px-5 py-2 mr-2 mb-2">Bet</button>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <p>{{ $listing->outcome_label_two }}</p>
                        <button type="button" class="mt-2 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium text-sm px-5 py-2 mr-2 mb-2">Bet</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <hr class="my-3">

    <div class="text-center">
        <h2 class="text-4xl leading-10 tracking-tight font-bold text-gray-900">Bets</h2>
    </div>

    {{--    --}}

@endsection
