<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HeroSection>
 */
class HeroSectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sourcePath = public_path('assets/img/hero/pantai-muncar-banyuwangi.jpg');
        Storage::disk('public')->makeDirectory('Hero');
        $fileName = 'Hero/' . Str::uuid() . '.' . pathinfo($sourcePath, PATHINFO_EXTENSION);
        Storage::disk('public')->put($fileName, file_get_contents($sourcePath));
        return [
            'title' => $this->faker->sentence,
            'subtitle' => $this->faker->paragraph,
            'button_text' => 'Pesan Sekarang',
            'youtube_link' => 'https://youtu.be/3uyoqJ0uOdI',
            'image' => $fileName,
        ];
    }
}
