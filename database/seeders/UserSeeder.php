<?php

namespace Database\Seeders;
use App\Models\User;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * @throws Exception
     */
    public function run(): void
    {
        $this->createUser();
        $this->createAdmin();
    }

    private function createUser(): void
    {
        $user = new User();
        $user->name = 'user';
        $user->email = 'simposk@gmail.com';
        $user->password = Hash::make('password');
        $user->is_admin = false;
        $user->save();
    }

    private function createAdmin(): void
    {
        $user = new User();
        $user->name = 'admin';
        $user->email = 'admin@gmail.com';
        $user->password = Hash::make('password');
        $user->is_admin = true;
        $user->save();
    }
}
