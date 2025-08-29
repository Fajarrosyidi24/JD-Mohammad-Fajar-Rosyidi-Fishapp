<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $superAdmin = User::firstOrCreate(
            ['email' => 'fishapp73@gmail.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password123')
            ]
        );
        $superAdmin->syncRoles(['Super Admin']);
        $superAdmin->detail()->firstOrCreate([
            'phone' => '081234567890',
            'address' => 'Jl. Contoh No.1',
            'birth_date' => '1990-01-01',
            'gender' => 'male',
            'photo_profile' => null,
            'photo_ktp' => null,
        ]);
        $admin = User::firstOrCreate(
            ['email' => 'fajarrosyidi80@gmail.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password123')
            ]
        );
        $admin->syncRoles(['Admin']);
        $admin->detail()->firstOrCreate([
            'phone' => '081298765432',
            'address' => 'Jl. Admin No.2',
            'birth_date' => '1995-05-05',
            'gender' => 'male',
            'photo_profile' => null,
            'photo_ktp' => null,
        ]);
        $guide = User::firstOrCreate(
            ['email' => 'glenmorepac@gmail.com'],
            [
                'name' => 'Guide User',
                'password' => Hash::make('password123')
            ]
        );
        $guide->syncRoles(['Nelayan']);
        $guide->detail()->firstOrCreate([
            'phone' => '081212345678',
            'address' => 'Jl. Guide No.3',
            'birth_date' => '1998-08-08',
            'gender' => 'female',
            'photo_profile' => null,
            'photo_ktp' => null,
        ]);
    }
}
