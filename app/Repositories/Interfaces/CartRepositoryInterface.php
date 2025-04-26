<?php

namespace App\Repositories\Interfaces;

use App\Models\Cart;

/**
 * Interface CartRepositoryInterface
 *
 * Defines the contract for cart repository operations.
 */
interface CartRepositoryInterface
{
    /**
     * Retrieve all carts.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();

    /**
     * Find a specific cart by its ID.
     *
     * @param  int  $id
     * @return \App\Models\Cart|null
     */
    public function find(int $id): ?Cart;

    /**
     * Create a new cart.
     *
     * @param  array  $data
     * @return \App\Models\Cart
     */
    public function create(array $data): Cart;

    /**
     * Update an existing cart by its ID.
     *
     * @param  int    $id
     * @param  array  $data
     * @return bool
     */
    public function update(int $id, array $data): bool;

    /**
     * Delete a cart by its ID.
     *
     * @param  int  $id
     * @return bool
     */
    public function delete(int $id): bool;
}
