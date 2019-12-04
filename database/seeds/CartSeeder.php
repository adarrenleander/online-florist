<?php

use App\Cart;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // created 5 initial data for Carts

        Cart::create([
            'user_id' => 1,
            'flower_id' => 3,
            'quantity' => 2
        ]);

        Cart::create([
            'user_id' => 1,
            'flower_id' => 14,
            'quantity' => 3
        ]);

        Cart::create([
            'user_id' => 2,
            'flower_id' => 10,
            'quantity' => 1
        ]);

        Cart::create([
            'user_id' => 2,
            'flower_id' => 16,
            'quantity' => 1
        ]);

        Cart::create([
            'user_id' => 2,
            'flower_id' => 4,
            'quantity' => 2
        ]);
    }
}
