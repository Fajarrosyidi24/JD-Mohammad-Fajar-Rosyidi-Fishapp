<?php

namespace App\Services;

use App\Models\SiteSetting;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;

class SiteSettingService
{
    public function getSettings(): array
    {
        $setting = SiteSetting::first();
        if (!$setting) {
            return [];
        }
        return [
            'id' => $setting->id,
            'site_name'       => $setting->site_name,
            'site_description' => $setting->site_description,
            'logo_url'        => $setting->logo_url,
            'address'         => $setting->address,
            'phone'           => $setting->phone,
            'email'           => $setting->email,
            'instagram'       => $setting->instagram,
            'tiktok'          => $setting->tiktok,
            'youtube'         => $setting->youtube,
            'seo_title'       => $setting->seo_title,
            'seo_description' => $setting->seo_description,
            'seo_keywords'    => $setting->seo_keywords,
        ];
    }

    /**
     * Update site setting berdasarkan ID dan data yang divalidasi.
     *
     * @param string $id
     * @param array $data
     * @return SiteSetting|null
     */
    public function updateSiteSetting(string $id, array $data): ?SiteSetting
    {
        $siteSetting = SiteSetting::find($id);
        if (!$siteSetting) {
            return null;
        }

        // === Handle logo upload ===
        if (array_key_exists('logo', $data) && $data['logo'] !== null) {
            if ($siteSetting->logo && Storage::disk('public')->exists($siteSetting->logo)) {
                Storage::disk('public')->delete($siteSetting->logo);
            }
            Storage::disk('public')->makeDirectory('Site');
            $extension = $data['logo']->getClientOriginalExtension();
            $fileName = 'Site/' . Str::uuid() . '.' . $extension;
            Storage::disk('public')->put($fileName, file_get_contents($data['logo']->getRealPath()));
            $data['logo'] = $fileName;
        } else {
            unset($data['logo']);
        }

        $siteSetting->update($data);
        $currentAppName = env('APP_NAME');
        if ($currentAppName !== $siteSetting->site_name) {
            DotenvEditor::setKey('APP_NAME', $siteSetting->site_name);
            DotenvEditor::save();
            Artisan::call('config:clear');
            Artisan::call('config:cache');
        }
        config(['app.name' => $siteSetting->site_name]);
        return $siteSetting;
    }
}
