<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CartService;
use Inertia\Inertia;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function cartCount()
    {
        $cartCount = $this->cartService->countUserCart();
        return response()->json(['count' => $cartCount]);
    }

    public function index()
    {
        $cartItems = $this->cartService->index();
        return Inertia::render('Customer/Cart/index', [
            'cartItems' => $cartItems
        ]);
    }

    public function destroy($role, $id)
    {
        $cartItem = $this->cartService->index()->find($id);
        if (!$cartItem) {
            return redirect()->back()->with('error', 'Item tidak ditemukan di keranjang.');
        }
        $cartItem->delete();
        return redirect()->back()->with('success', 'Item berhasil dihapus dari keranjang.');
    }

    public function store(Request $request, $role)
    {
        $cartItems = $request->cartItems ?? [];
        $totalItems = $request->totalItems ?? 0;
        $totalPrice = $request->totalPrice ?? 0;

        return redirect()->route('checkout.index', [
            'role' => $role,
            'checkoutData' => [
                'cartItems' => $cartItems,
                'totalItems' => $totalItems,
                'totalPrice' => $totalPrice,
            ]
        ]);
    }
}
