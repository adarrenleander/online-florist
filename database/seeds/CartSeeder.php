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
        Cart::create([
            'member_id' => 1,
            'flower_id' => 3,
            'quantity' => 2
        ]);

        Cart::create([
            'member_id' => 1,
            'flower_id' => 14,
            'quantity' => 3
        ]);
    }
}
