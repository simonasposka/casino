<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterController\StoreRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function register(): Factory|View|Application
    {
        return view('Register');
    }

    public function login(): Factory|View|Application
    {
        return view('Login');
    }

    public function store(StoreRequest $request): User
    {
        $dto = $request->getDTO();

        $user = new User();
        $user->name = $dto->getName();
        $user->email = $dto->getEmail();
        $user->password = Hash::make($dto->getPassword());
        $user->save();

        return $user;
    }
}
