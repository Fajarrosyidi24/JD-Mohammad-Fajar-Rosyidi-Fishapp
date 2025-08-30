<?php

namespace App\Http\Controllers\Customer;

use Inertia\Inertia;
use App\Models\Product;
use App\Models\HeroSection;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::all();
        $products = Product::all();
        $hero = HeroSection::first();
        return Inertia::render('Customer/Home', [
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
    return Inertia::render('Customer/Product', [
        'products' => $products,
        'categories' => $categories,
        'selectedCategory' => $categorySlug,
    ]);
    }
}
