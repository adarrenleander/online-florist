<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(FlowerTypeSeeder::class);
        $this->call(FlowerSeeder::class);
        $this->call(CourierSeeder::class);
        $this->call(HeaderTransactionSeeder::class);
        $this->call(DetailTransactionSeeder::class);
    }
}
