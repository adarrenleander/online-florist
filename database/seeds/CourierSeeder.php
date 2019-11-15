<?php

use App\Courier;
use Illuminate\Database\Seeder;

class CourierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Courier::create([
            'courier_name' => 'JNE',
            'shipping_cost' => 9000
        ]);

        Courier::create([
            'courier_name' => 'TIKI',
            'shipping_cost' => 9000
        ]);

        Courier::create([
            'courier_name' => 'SiCepat',
            'shipping_cost' => 10000
        ]);

        Courier::create([
            'courier_name' => 'J&T',
            'shipping_cost' => 10000
        ]);

        Courier::create([
            'courier_name' => 'Wahana',
            'shipping_cost' => 5000
        ]);

        Courier::create([
            'courier_name' => 'Ninja Xpress',
            'shipping_cost' => 9000
        ]);

        Courier::create([
            'courier_name' => 'Anteraja',
            'shipping_cost' => 10000
        ]);
    }
}
