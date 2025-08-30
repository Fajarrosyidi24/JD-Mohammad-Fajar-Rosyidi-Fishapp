<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use App\Models\HeroSection;
use App\Models\ProductCategory;

class LandingPageController extends Controller
{
    public function home()
    {
        $categories = ProductCategory::all();
        $products = Product::all();
        $hero = HeroSection::first();
        return Inertia::render('Welcome', [
            'hero' => $hero,
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    public function product()
{
    $categories = ProductCategory::all();
    $query = Product::query();
    $categorySlug = request('category');

    if ($categorySlug) {
        $category = ProductCategory::where('slug', $categorySlug)->first();
        if ($category) {
            $query->where('product_category_id', $category->id);
        }
    }

    $products = $query->get();

    return Inertia::render('Product', [
        'products' => $products,
        'categories' => $categories,
        'selectedCategory' => $categorySlug,
    ]);
}

}
