<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CartItem>
 */
class CartItemFactory extends Factory
{
    protected $model = CartItem::class;

    public function definition(): array
    {
        // Random start and end time logic
        $startTime = $this->faker->time('H:i:s');
        $endTime = date('H:i:s', strtotime($startTime . ' +1 hour'));

        return [
            'cart_id' => Cart::factory(), // Will create a cart if none is passed
            'service_id' => $this->faker->numberBetween(1, 1000), // Assuming service IDs are integers
            'scheduled_date' => $this->faker->date(),
            'start_time' => $startTime,
            'end_time' => $endTime,
            'price' => $this->faker->randomFloat(2, 50, 500), // Price between 50.00 and 500.00
            'status' => $this->faker->boolean(90), // 90% chance active
        ];
    }
}
