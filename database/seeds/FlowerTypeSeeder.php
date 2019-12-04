<?php

use App\FlowerType;
use Illuminate\Database\Seeder;

class FlowerTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // created 6 initial data for FlowerTypes

        FlowerType::create([
            'type_name' => 'Rose'
        ]);

        FlowerType::create([
            'type_name' => 'Lily'
        ]);

        FlowerType::create([
            'type_name' => 'Sunflower'
        ]);

        FlowerType::create([
            'type_name' => 'Gerbera'
        ]);

        FlowerType::create([
            'type_name' => 'Daisy'
        ]);

        FlowerType::create([
            'type_name' => 'Tulip'
        ]);
    }
}
