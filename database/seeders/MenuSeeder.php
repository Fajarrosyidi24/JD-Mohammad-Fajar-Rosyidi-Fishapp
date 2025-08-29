<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $menus = [
            [
                'name' => 'Dashboard',
                'slug' => 'dashboard',
                'icon' => 'fas fa-home',
                'permission_name' => 'Dashboard',
                'order' => 1,
                'children' => []
            ],
            [
                'name' => 'Pengaturan',
                'icon' => 'fas fa-cog',
                'order' => 2,
                'children' => [
                    ['name' => 'Pengaturan Situs', 'permission_name' => 'Pengaturan Situs', 'slug' => 'pengaturan_situs'],
                    ['name' => 'Pengaturan Hero', 'permission_name' => 'Pengaturan Hero', 'slug' => 'pengaturan_hero'],
                ]
            ],
        ];

        foreach ($menus as $menu) {
            $parentId = DB::table('menus')->insertGetId([
                'name' => $menu['name'],
                'slug' => $menu['slug'] ?? null,
                'icon' => $menu['icon'],
                'permission_name' => $menu['permission_name'] ?? null,
                'parent_id' => null,
                'order' => $menu['order'] ?? 0,
            ]);

            if (!empty($menu['children'])) {
                foreach ($menu['children'] as $child) {
                    DB::table('menus')->insert([
                        'name' => $child['name'],
                        'slug' => $child['slug'] ?? null,
                        'icon' => null,
                        'permission_name' => $child['permission_name'],
                        'parent_id' => $parentId,
                        'order' => 0,
                    ]);
                }
            }
        }
    }
}
