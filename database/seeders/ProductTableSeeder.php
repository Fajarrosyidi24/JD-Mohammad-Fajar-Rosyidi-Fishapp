<?php

namespace Database\Seeders;

use App\Enums\Status;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Dipokhalder\EnvEditor\EnvEditor;

class ProductTableSeeder extends Seeder
{
    public array $seafoodProducts = [
        'Tuna' => [
            ['name' => 'Tuna Segar Besar', 'price' => 120000, 'stock' => 50],
            ['name' => 'Tuna Fillet', 'price' => 85000, 'stock' => 70],
        ],
        'Tongkol' => [
            ['name' => 'Tongkol Segar', 'price' => 35000, 'stock' => 100],
        ],
        'Kembung' => [
            ['name' => 'Ikan Kembung Segar', 'price' => 28000, 'stock' => 150],
        ],
        'Kakap Merah' => [
            ['name' => 'Kakap Merah Segar', 'price' => 95000, 'stock' => 40],
        ],
        'Lele' => [
            ['name' => 'Lele Hidup', 'price' => 20000, 'stock' => 200],
        ],
        'Nila' => [
            ['name' => 'Nila Segar', 'price' => 25000, 'stock' => 180],
        ],
        'Gurame' => [
            ['name' => 'Gurame Besar', 'price' => 70000, 'stock' => 60],
        ],
        'Udang Vaname' => [
            ['name' => 'Udang Vaname Segar', 'price' => 85000, 'stock' => 120],
        ],
        'Udang Windu' => [
            ['name' => 'Udang Windu Jumbo', 'price' => 150000, 'stock' => 80],
        ],
        'Udang Galah' => [
            ['name' => 'Udang Galah Sungai', 'price' => 180000, 'stock' => 30],
        ],
        'Cumi' => [
            ['name' => 'Cumi Segar', 'price' => 95000, 'stock' => 90],
        ],
        'Sotong' => [
            ['name' => 'Sotong Segar', 'price' => 88000, 'stock' => 70],
        ],
    ];

    public function run(): void
    {
        $envService = new EnvEditor();

        if ($envService->getValue('DEMO') && $envService->getValue('DISPLAY') == 'seafood') {
            foreach ($this->seafoodProducts as $categoryName => $products) {
                $category = ProductCategory::where('name', $categoryName)->first();

                if ($category) {
                    foreach ($products as $product) {
                        $newProduct = Product::create([
                            'product_category_id' => $category->id,
                            'name'                => $product['name'],
                            'slug'                => Str::slug($product['name']) . '-' . rand(100, 999),
                            'description'         => 'Produk segar berkualitas tinggi kategori ' . $categoryName,
                            'price'               => $product['price'],
                            'stock'               => $product['stock'],
                            'status'              => Status::ACTIVE,
                        ]);

                        $imagePath = public_path('/images/seeder/product/' . env('DISPLAY') . '/' . strtolower(str_replace(' ', '_', $product['name'])) . '.jpeg');

                        if (file_exists($imagePath)) {
                            $newProduct
                                ->addMedia($imagePath)
                                ->preservingOriginal()
                                ->toMediaCollection('product');
                        }
                    }
                }
            }
        }
    }
}
