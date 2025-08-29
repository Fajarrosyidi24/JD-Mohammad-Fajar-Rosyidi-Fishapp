<?php

namespace App\Services;

use App\Models\HeroSection;
use App\Models\SiteSetting;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;

class HeroService
{
    /**
     * Update site setting berdasarkan ID dan data yang divalidasi.
     *
     * @param string $id
     * @param array $data
     * @return SiteSetting|null
     */
    public function updateHero(string $id, array $data): ?HeroSection
    {
        $hero = HeroSection::find($id);
        if (!$hero) {
            return null;
        }

        if (array_key_exists('image', $data) && $data['image'] !== null) {
            if ($hero->image && Storage::disk('public')->exists($hero->image)) {
                Storage::disk('public')->delete($hero->image);
            }
            Storage::disk('public')->makeDirectory('Hero');
            $extension = $data['image']->getClientOriginalExtension();
            $fileName = 'Hero/' . Str::uuid() . '.' . $extension;
            Storage::disk('public')->put($fileName, file_get_contents($data['image']->getRealPath()));
            $data['image'] = $fileName;
        } else {
            unset($data['image']);
        }

        $hero->update($data);
        return $hero;
    }
}
