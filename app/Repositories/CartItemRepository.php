<?php

namespace App\Repositories;

use App\Models\CartItem;
use App\Repositories\Interfaces\CartItemRepositoryInterface;

/**
 * Class CartItemRepository
 *
 * Handles data operations related to cart items, including creating, updating, deleting, and retrieving cart items.
 */
class CartItemRepository implements CartItemRepositoryInterface
{
    /**
     * Retrieve all cart items.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return CartItem::all();
    }

    /**
     * Find a specific cart item by its ID.
     *
     * @param  int  $id
     * @return \App\Models\CartItem|null
     */
    public function find(int $id): ?CartItem
    {
        return CartItem::find($id);
    }

    /**
     * Create a new cart item.
     *
     * @param  array  $data
     * @return \App\Models\CartItem
     */
    public function create(array $data): CartItem
    {
        return CartItem::create($data);
    }

    /**
     * Update an existing cart item by its ID.
     *
     * @param  int    $id
     * @param  array  $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        $cartItem = CartItem::findOrFail($id);
        return $cartItem->update($data);
    }

    /**
     * Delete a cart item by its ID.
     *
     * @param  int  $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $cartItem = CartItem::findOrFail($id);
        return $cartItem->delete();
    }
}
