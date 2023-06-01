@extends('layouts.app')

@section('content')

    <div class="bg-gray-50 py-16 px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-4xl leading-10 tracking-tight font-bold text-gray-900">Listing</h2>
            <p class="mt-2">status: <em>{{ $listing['status'] }}</em></p>
            <p class="mt-2">Event date: <em>{{ substr($listing['event']['date_of_event'], 0, 10) }}</em></p>
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
                        <p>{{ $listing['outcome_label_one'] }}</p>
                        <form class="mb-0" action="/dashboard/listings/{{$listing['id']}}/bets" method="POST">
                            @csrf
                            <input type="hidden" name="outcome" value="{{ 0 }}">
                            <button type="submit" class="mt-2 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium text-sm px-5 py-2 mr-2 mb-2">Bet</button>
                        </form>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <p>{{ $listing['outcome_label_two'] }}</p>
                        <form class="mb-0" action="/dashboard/listings/{{$listing['id']}}/bets" method="POST">
                            @csrf
                            <input type="hidden" name="outcome" value="{{ 1 }}">
                            <button type="submit" class="mt-2 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium text-sm px-5 py-2 mr-2 mb-2">Bet</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <hr class="my-3">

    <div class="text-center">
        <h2 class="text-4xl leading-10 tracking-tight font-bold text-gray-900">Bets</h2>
    </div>

    <div class="mt-5 relative overflow-x-auto">
        @foreach($listing['bets'] as $bet)
            <table class="w-full lg:w-1/2 text-sm mx-auto text-left text-gray-500 mb-10">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">Outcome 1</th>
                        <th scope="col" class="px-6 py-3 text-right">Outcome 2</th>
                        <th scope="col" class="px-6 py-3 text-right">Created by</th>
                        <th scope="col" class="px-6 py-3 text-right">Bet value</th>
                        <th scope="col" class="px-6 py-3 text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b">
                        <td class="px-6 py-4">
                            @if($bet['value'] == 0)
                                <p>{{ $listing['outcome_label_one'] }}</p>
                            @else
                                <p>{{ $listing['outcome_label_two'] }}</p>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            @if($bet['value'] == 1)
                                <p>{{ $listing['outcome_label_one'] }}</p>
                            @else
                                <p>{{ $listing['outcome_label_two'] }}</p>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            {{ $bet['creator']['name'] }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            {{ $bet['total_value'] / 100 }} EUR
                        </td>
                        <td class="py-4 text-right">
                            @if(Auth::user()->id === $bet['creator_id'])
                                <a href="/dashboard/listings/{{ $listing['id'] }}/bets/{{ $bet['id'] }}/items/add">
                                    <button type="submit" class="mt-2 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium text-sm px-5 py-2 mr-2 mb-2">Add item</button>
                                </a>
                            @else
                            <a href="/dashboard/listings/{{ $listing['id'] }}/bets/{{ $bet['id'] }}/items/addJoin">
                                <button type="submit" class="mt-2 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium text-sm px-5 py-2 mr-2 mb-2">Join Bet</button>
                                </a>
                                @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        @endforeach
    </div>
@endsection
