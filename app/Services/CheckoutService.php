<?php

namespace App\Services;

use App\Models\Cart;
use Illuminate\Support\Facades\Http;

class CheckoutService
{
    /**
     * Checkout the given cart by calling external Order API for each item.
     *
     * @param Cart $cart
     * @return void
     */
    public function checkoutCart(Cart $cart)
    {
        foreach ($cart->items as $item) {
            Http::post('https://mocked-order-api.test/orders', [
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'user_id' => $cart->user_id,
            ]);
        }
    }
}
