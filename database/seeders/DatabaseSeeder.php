<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cart;
use App\Models\CartItem;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // create 1 customer and 1 admin user
        $this->call([
            UserSeeder::class,
        ]);

        // Cart and CartItem factories
        Cart::factory()->count(10)->create();

        $cart = Cart::first();
        CartItem::factory()->count(5)->create([
            'cart_id' => $cart->id,
        ]);
    }
}
