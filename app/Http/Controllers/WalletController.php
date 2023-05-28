<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    public function show(Wallet $wallet): View
    {
        $user = Auth::user();

        // Retrieve the user's wallet
        $wallet = $user->wallet;
        return view('WalletShow', compact('wallet'));
    }
}
