<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Response;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:1', 'max:255'],
            'email' => ['required', 'string', 'min:1', 'max:255'],
            'password' => ['required', 'string', 'min:1', 'max:255'],
            'password_confirmation' => ['required', 'string', 'min:1', 'max:255'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        Wallet::create([
            'balance' => 0,
            'user_id' => $user->id,
        ]);

        return redirect()->route('register.index')->with('message', 'Registered successfully');
    }
}
