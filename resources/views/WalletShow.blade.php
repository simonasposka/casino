@extends('layouts.app')

@section('content')
    <div class="bg-gray-50 py-16 px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-4xl leading-10 tracking-tight font-bold text-gray-900">Wallet</h2>
            </a>
        </div>

        <div>
            <h2 class="text-4xl leading-10 tracking-tight font-bold text-gray-900">Balance: {{ $wallet->balance/100 }} </h2>
        </div>
        </div>
    </div>
@endsection
