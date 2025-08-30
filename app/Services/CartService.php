<?php

namespace App\Services;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartService
{
    /**
     * Create new cart item
     *
     * @param int $productId
     * @param int $quantity
     * @param int $subtotal
     * @return Cart
     */
    public function create(int $productId, int $quantity, int $subtotal): Cart
    {
        return Cart::create([
            'user_id'    => Auth::id(),
            'product_id' => $productId,
            'quantity'   => $quantity,
            'price'      => $subtotal / $quantity,
            'subtotal'   => $subtotal,
        ]);
    }

    public function countUserCart(): int
    {
        return Cart::where('user_id', Auth::id())->count();
    }
}
