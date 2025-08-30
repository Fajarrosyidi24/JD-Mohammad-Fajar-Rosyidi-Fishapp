<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\User;
use App\Models\About;
use App\Models\HeroSection;
use App\Models\SiteSetting;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;

class RegistrationService
{
    public function updateUser(string $id, array $data): ?User
    {
        $user = User::find($id);
        if (!$user) {
            return null;
        }

        $user->name = $data['name'] ?? $user->name;
        $user->email = $data['email'];
        $user->email_verified_at = Carbon::now();
        $user->remember_token = null;

        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();

        // Siapkan data detail
        $detailData = [
            'phone' => $data['phone'] ?? $user->detail->phone ?? null,
            'address' => $data['address'] ?? $user->detail->address ?? null,
            'birth_date' => $data['birth_date'] ?? $user->detail->birth_date ?? null,
            'gender' => $data['gender'] ?? $user->detail->gender ?? null,
        ];

        $userFolder = "users/{$user->id}";

        // Handle photo_profile
        if (!empty($data['photo_profile'])) {
            $file = $data['photo_profile'];

            if ($user->detail && $user->detail->photo_profile) {
                Storage::disk('public')->delete($user->detail->photo_profile);
            }

            $detailData['photo_profile'] = $file->store($userFolder, 'public');
        }

        // Handle photo_ktp
        if (!empty($data['photo_ktp'])) {
            $file = $data['photo_ktp'];

            if ($user->detail && $user->detail->photo_ktp) {
                Storage::disk('public')->delete($user->detail->photo_ktp);
            }

            $detailData['photo_ktp'] = $file->store($userFolder, 'public');
        }

        // Update atau create detail
        $user->detail()->updateOrCreate(
            ['user_id' => $user->id],
            $detailData
        );
        return $user;
    }

    public function createUser(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->assignRole('Customer');

        $userFolder = "users/{$user->id}";

        $detailData = [
            'phone'      => $data['phone'] ?? null,
            'address'    => $data['address'] ?? null,
            'birth_date' => $data['birth_date'] ?? null,
            'gender'     => $data['gender'] ?? null,
        ];

        if (!empty($data['photo_profile'])) {
            $detailData['photo_profile'] = $data['photo_profile']->store($userFolder, 'public');
        }
        if (!empty($data['photo_ktp'])) {
            $detailData['photo_ktp'] = $data['photo_ktp']->store($userFolder, 'public');
        }
        $user->detail()->create($detailData);
        return $user;
    }
}
