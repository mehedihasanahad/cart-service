<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Repositories\Interfaces\CartRepositoryInterface;

/**
 * Class CartRepository
 *
 * Repository class for handling Cart data operations.
 */
class CartRepository implements CartRepositoryInterface
{
    /**
     * Retrieve all carts with their items.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all($page = 5)
    {
        return Cart::with('items')->paginate($page);
    }

    /**
     * Find a cart by its ID, including its items.
     *
     * @param  int  $id
     * @return \App\Models\Cart|null
     */
    public function find(int $id): ?Cart
    {
        return Cart::with('items')->find($id);
    }

    /**
     * Create a new cart.
     *
     * @param  array  $data
     * @return \App\Models\Cart
     */
    public function create(array $data): Cart
    {
        return Cart::create($data);
    }

    /**
     * Update an existing cart by ID.
     *
     * @param  int    $id
     * @param  array  $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        $cart = Cart::findOrFail($id);
        return $cart->update($data);
    }

    /**
     * Delete a cart by ID.
     *
     * @param  int  $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $cart = Cart::findOrFail($id);
        return $cart->delete();
    }

    /**
     * Checkout the cart by ID.
     *
     * @param  int  $id
     * @return bool
     */
    public function findByUserId($userId): ?Cart
    {
        return Cart::where('user_id', $userId)->first();
    }
}
