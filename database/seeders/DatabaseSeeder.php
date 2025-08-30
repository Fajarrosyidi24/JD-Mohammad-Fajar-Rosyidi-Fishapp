<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\SiteSettingSeeder;
use Database\Seeders\HeroSectionSeeder;
use Database\Seeders\GallerySeeder;
use Database\Seeders\DestinationSeeder;
use Database\Seeders\PackageSeeder;
use Database\Seeders\ArticleSeeder;
use Database\Seeders\ContactSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SiteSettingSeeder::class,
            HeroSectionSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
            MenuSeeder::class,
            UserSeeder::class,
            ProductCategoryTableSeeder::class,
            ProductTableSeeder::class,
        ]);
    }
}
