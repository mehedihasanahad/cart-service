<?php

namespace App\Repositories\Interfaces;

use App\Models\CartItem;

/**
 * Interface CartItemRepositoryInterface
 *
 * Defines the contract for cart item repository operations.
 */
interface CartItemRepositoryInterface
{
    /**
     * Retrieve all cart items.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();

    /**
     * Find a specific cart item by its ID.
     *
     * @param  int  $id
     * @return \App\Models\CartItem|null
     */
    public function find(int $id): ?CartItem;

    /**
     * Create a new cart item.
     *
     * @param  array  $data
     * @return \App\Models\CartItem
     */
    public function create(array $data): CartItem;

    /**
     * Update an existing cart item by its ID.
     *
     * @param  int    $id
     * @param  array  $data
     * @return bool
     */
    public function update(int $id, array $data): bool;

    /**
     * Delete a cart item by its ID.
     *
     * @param  int  $id
     * @return bool
     */
    public function delete(int $id): bool;
}
