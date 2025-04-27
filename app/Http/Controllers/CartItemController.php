<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CartItemRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Resources\CartItemResource;

/**
 * @group CartItem management
 *
 * APIs for managing cart items.
 */
class CartItemController extends Controller
{
    private $cartItemRepository;

    /**
     * Create a new CartItemController instance.
     *
     * @param  \App\Repositories\Interfaces\CartItemRepositoryInterface  $cartItemRepository
     * @return void
     */
    public function __construct(CartItemRepositoryInterface $cartItemRepository)
    {
        $this->cartItemRepository = $cartItemRepository;
    }

    /**
     * Display a listing of the cart items.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return CartItemResource::collection($this->cartItemRepository->all());
    }

    /**
     * Store a newly created cart item.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Http\Resources\CartItemResource
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'cart_id' => 'required|exists:carts,id',
            'service_id' => 'required|integer',
            'scheduled_date' => 'required|date_format:Y-m-d',
            'start_time' => 'required|date_format:Y-m-d H:i:s',
            'end_time' => 'required|date_format:Y-m-d H:i:s|after:start_time',
            'price' => 'required|numeric|min:0',
        ]);

        // Create a new cart item
        $cartItem = $this->cartItemRepository->create($validated);
        return new CartItemResource($cartItem);
    }

    /**
     * Display the specified cart item.
     *
     * @param  int  $id
     * @return \App\Http\Resources\CartItemResource|\Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $cartItem = $this->cartItemRepository->find($id);

        if (!$cartItem) {
            return response()->json(['message' => 'Cart item not found'], 404);
        }

        return new CartItemResource($cartItem);
    }

    /**
     * Update the specified cart item.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        // Validate the request data
        $validated = $request->validate([
            'scheduled_date' => 'date_format:Y-m-d',
            'start_time' => 'date_format:Y-m-d H:i:s',
            'end_time' => 'date_format:Y-m-d H:i:s|after:start_time',
            'price' => 'numeric|min:0',
        ]);

        $this->cartItemRepository->update($id, $validated);
        return response()->json(['message' => 'Cart item updated successfully']);
    }

    /**
     * Remove the specified cart item.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        // Check if the cart item exists
        $cartItem = $this->cartItemRepository->find($id);

        // If not found, return a 404 response
        if (!$cartItem) {
            return response()->json(['message' => 'Cart item not found'], 404);
        }

        // Delete the cart item
        $this->cartItemRepository->delete($id);
        return response()->json(['message' => 'Cart item deleted successfully']);
    }
}
