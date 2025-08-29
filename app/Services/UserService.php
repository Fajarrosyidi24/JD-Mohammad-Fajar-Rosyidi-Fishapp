<?php

namespace App\Services;

use App\Models\User;
use App\Mail\NewUserMail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserService
{
    /**
     * Buat user baru dan assign role
     *
     * @param array $data ['name' => ..., 'email' => ..., 'role' => ...]
     * @return User
     */
    public function createUser(array $data): User
    {
        $user = User::create([
            'name' => $data['name'] ?? 'User Default',
            'email' => $data['email'],
            'remember_token' => Str::random(60),
        ]);
        if (!empty($data['role'])) {
            $user->assignRole($data['role']);
        }

        $token = $user->remember_token;

        if (!empty($user->email)) {
            $url = url("/register/acount/new-password/{$token}");
            Mail::to($user->email)->send(new NewUserMail($url));
        }
        return $user;
    }
}
