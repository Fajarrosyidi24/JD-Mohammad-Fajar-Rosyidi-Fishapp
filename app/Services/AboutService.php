<?php

namespace App\Services;

use App\Models\About;
use App\Models\HeroSection;
use App\Models\SiteSetting;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;

class AboutService
{
    public function updateAbout(string $id, array $data): ?About
    {
        $about = About::find($id);
        if (!$about) {
            return null;
        }

        if (array_key_exists('image', $data) && $data['image'] !== null) {
            if ($about->image && Storage::disk('public')->exists($about->image)) {
                Storage::disk('public')->delete($about->image);
            }
            Storage::disk('public')->makeDirectory('About');
            $extension = $data['image']->getClientOriginalExtension();
            $fileName = 'About/' . Str::uuid() . '.' . $extension;
            Storage::disk('public')->put($fileName, file_get_contents($data['image']->getRealPath()));
            $data['image'] = $fileName;
        } else {
            unset($data['image']);
        }

        $about->update($data);
        return $about;
    }
}
