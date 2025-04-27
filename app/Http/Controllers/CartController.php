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
        // Validate the request data
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        // Check if the cart already exists for the user
        if ($this->cartRepository->findByUserId($validated['user_id'])) {
            return response()->json(['message' => 'Cart already exists for this user'], 422);
        }

        // Create a new cart
        $cart = $this->cartRepository->create($validated);
        return response()->json(['message' => 'Cart created for this user'], 200);
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
            'status' => 'nullable|boolean',
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
        // Find the cart by ID
        $cart = $this->cartRepository->find($id);

        // Check if the cart does not exist
        if (!$cart) {
            return response()->json(['message' => 'Cart not found'], 404);
        }

        // Checkout the cart using the CheckoutService
        $checkoutService->checkoutCart($cart);

        // clear the cart after checkout
        $this->cartRepository->update($id, ['status' => 0]);

        //TO::DO: Handle the response from the Order API and return appropriate response

        //TO::DO: Push the order to the queue for notification and other processing

        return response()->json(['message' => 'Checkout initiated']);
    }
}
