<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CartRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Resources\CartResource;
use App\Services\CheckoutService;

/**
 * @group Cart management
 *
 * APIs for managing cart
 */
class CartController extends Controller
{
    private $cartRepository;

    public function __construct(CartRepositoryInterface $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    /**
     * Display a listing of the cart.
     */
    public function index()
    {
        return CartResource::collection($this->cartRepository->all());
    }

    /**
     * Store a newly created cart.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $cart = $this->cartRepository->create($validated);
        return new CartResource($cart);
    }

    /**
     * Display the specified cart.
     */
    public function show($id)
    {
        $cart = $this->cartRepository->find($id);

        if (!$cart) {
            return response()->json(['message' => 'Cart not found'], 404);
        }

        return new CartResource($cart);
    }

    /**
     * Update the specified cart.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'user_id' => 'sometimes|exists:users,id',
        ]);

        $this->cartRepository->update($id, $validated);
        return response()->json(['message' => 'Cart updated successfully']);
    }

    /**
     * Remove the specified cart.
     */
    public function destroy($id)
    {
        $this->cartRepository->delete($id);
        return response()->json(['message' => 'Cart deleted successfully']);
    }

    /**
     * Checkout the cart.
     */
    public function checkout($id, CheckoutService $checkoutService)
    {
        $cart = $this->cartRepository->find($id);

        if (!$cart) {
            return response()->json(['message' => 'Cart not found'], 404);
        }

        $checkoutService->checkoutCart($cart);

        return response()->json(['message' => 'Checkout initiated']);
    }
}
