<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
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

        User::createUser(
            $validated['email'],
            $validated['name'],
            $validated['password']
        );

        return redirect()->route('register.index')->with('message', 'Registered successfully');
    }
}
