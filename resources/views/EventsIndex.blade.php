@extends('layouts.app')

@section('content')

    <div class="bg-gray-50 py-16 px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-4xl leading-10 tracking-tight font-bold text-gray-900">Events</h2>
        </div>
    </div>

    <div class="mt-5 relative overflow-x-auto pr-12">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">Id</th>
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3">Location</th>
                    <th scope="col" class="px-6 py-3">Date</th>
                    <th scope="col" class="px-6 py-3">Team</th>
                    <th scope="col" class="px-6 py-3">Second Team</th>
{{--                    <th scope="col" class="px-6 py-3">Action</th>--}}
                </tr>
            </thead>
            <tbody>
            @foreach($events as $event)
                <tr class="bg-white border-b">
                    <td class="px-6 py-4">{{ $event->uuid }}</td>
                    <td class="px-6 py-4">{{ $event->name }}</td>
                    <td class="px-6 py-4">{{ $event->location }}</td>
                    <td class="px-6 py-4">{{ $event->date_of_event }}</td>
                    <td class="px-6 py-4">{{ json_decode($event->config, true)['teams']['0']['name'] }} | {{ json_decode($event->config, true)['teams']['0']['odds'] }}%</td>
                    <td class="px-6 py-4">{{ json_decode($event->config, true)['teams']['1']['name'] }} | {{ json_decode($event->config, true)['teams']['1']['odds'] }}%</td>
{{--                    <td class="px-6 py-4">--}}
{{--                        <a href="/listings/create">--}}
{{--                            <button type="button" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium text-sm px-5 py-2.5 mr-2 mb-2">Create listing</button>--}}
{{--                        </a>--}}
{{--                    </td>--}}
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


@endsection
