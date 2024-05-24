<?php

namespace Modules\Initialize\Actions;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUser
{
    public function handle(string $name, string $email, string $password): User
    {
        return User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);
    }
}