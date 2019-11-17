<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Darren',
            'email' => 'amadeusdarrenleander@gmail.com',
            'password' => Hash::make('password'),
            'phone' => '085263718273',
            'gender' => 'male',
            'address' => 'Taman Ratu Indah',
            'profile_picture' => '/storage/images/users/Darren.png',
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'John',
            'email' => 'john.doe@gmail.com',
            'password' => Hash::make('password'),
            'phone' => '082738271238',
            'gender' => 'male',
            'address' => 'Alam Sutera',
            'profile_picture' => '/storage/images/users/John.png',
            'role' => 'member'
        ]);
    }
}
