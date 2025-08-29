<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SiteSetting::factory()->create();
        $site = SiteSetting::first();
        DotenvEditor::setKey('APP_NAME', $site->site_name);
        DotenvEditor::save();
    }
}
