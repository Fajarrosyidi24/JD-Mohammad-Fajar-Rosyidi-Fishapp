<?php

namespace App\Http\Controllers\Customer;

use Inertia\Inertia;
use App\Models\Product;
use App\Models\HeroSection;
use Illuminate\Http\Request;
use App\Services\CartService;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }
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

    public function productDetail($role, $id)
    {
        $product = Product::with('category', 'user.detail')->where('id', $id)->first();
        return Inertia::render('Customer/ProductDetail', [
            'product' => $product,
            'role' => $role,
        ]);
    }

    public function cartStore($role, $id, $quantity, $subtotal)
    {
        $cart = $this->cartService->create($id, $quantity, $subtotal);
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }
}
