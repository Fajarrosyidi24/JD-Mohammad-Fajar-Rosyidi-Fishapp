<?php

namespace Database\Seeders;

use App\Enums\Status;
use Illuminate\Support\Str;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;
use Dipokhalder\EnvEditor\EnvEditor;

class ProductCategoryTableSeeder extends Seeder
{
    public array $seafoodCategories = [
        [
            'name'     => 'Ikan',
            'children' => [
                [
                    'name'     => 'Ikan Air Laut',
                    'children' => [
                        ['name' => 'Tuna'],
                        ['name' => 'Tongkol'],
                        ['name' => 'Kembung'],
                        ['name' => 'Kakap Merah'],
                    ]
                ],
                [
                    'name'     => 'Ikan Air Tawar',
                    'children' => [
                        ['name' => 'Lele'],
                        ['name' => 'Nila'],
                        ['name' => 'Gurame'],
                    ]
                ],
            ],
        ],
        [
            'name'     => 'Udang',
            'children' => [
                ['name' => 'Udang Vaname'],
                ['name' => 'Udang Windu'],
                ['name' => 'Udang Galah'],
            ]
        ],
        [
            'name'     => 'Cumi & Sotong',
            'children' => [
                ['name' => 'Cumi'],
                ['name' => 'Sotong'],
            ]
        ]
    ];

    public function run(): void
    {
        $envService = new EnvEditor();
        if ($envService->getValue('DEMO') && $envService->getValue('DISPLAY') == 'seafood') {
            foreach ($this->seafoodCategories as $category) {
                $productCategory = ProductCategory::create([
                    'parent_id'   => NULL,
                    'name'        => $category['name'],
                    'slug'        => Str::slug($category['name'] . rand(1, 100)),
                    'description' => null,
                    'status'      => Status::ACTIVE,
                ]);

                if (file_exists(public_path('/images/seeder/product-category/' . env('DISPLAY') . '/' . strtolower(str_replace(' ', '_', $category['name'])) . '.jpeg'))) {
                    $productCategory->addMedia(public_path('/images/seeder/product-category/' . env('DISPLAY') . '/' . strtolower(str_replace(' ', '_', $category['name'])) . '.jpeg'))->preservingOriginal()->toMediaCollection('product-category');
                }

                if (isset($category['children']) && count($category['children']) > 0) {
                    $this->nested($category['children'], $productCategory->id);
                }
            }
        }
    }

    public function nested($arrays, $id = null): void
    {
        foreach ($arrays as $array) {
            $productCategory = ProductCategory::create([
                'parent_id'   => $id,
                'name'        => $array['name'],
                'slug'        => Str::slug($array['name'] . rand(101, 500)).rand(100, 200),
                'description' => null,
                'status'      => Status::ACTIVE,
            ]);

            if (file_exists(public_path('/images/seeder/product-category/' . env('DISPLAY') . '/' . strtolower(str_replace(' ', '_', $array['name'])) . '.jpeg'))) {
                $productCategory->addMedia(public_path('/images/seeder/product-category/' . env('DISPLAY') . '/' . strtolower(str_replace(' ', '_', $array['name'])) . '.jpeg'))->preservingOriginal()->toMediaCollection('product-category');
            }

            if (isset($array['children']) && count($array['children']) > 0) {
                $this->nested($array['children'], $productCategory->id);
            }
        }
    }
}
