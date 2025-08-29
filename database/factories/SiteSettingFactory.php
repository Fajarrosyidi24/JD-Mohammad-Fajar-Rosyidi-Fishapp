<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SiteSetting>
 */
class SiteSettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sourcePath = public_path('assets/img/logo/Fishapp new logo.png');
        Storage::disk('public')->makeDirectory('Site');
        $fileName = 'Site/' . Str::uuid() . '.' . pathinfo($sourcePath, PATHINFO_EXTENSION);
        Storage::disk('public')->put($fileName, file_get_contents($sourcePath));
        
        return [
            'site_name' => 'Fishapp',
            'site_description' => $this->faker->sentence(),
            'logo' => $fileName,
            'email' => $this->faker->companyEmail(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'instagram' => 'https://instagram.com/transito',
            'tiktok' => 'https://tiktok.com/@transito',
            'youtube' => 'https://youtube.com/@transito',
        ];
    }
}
