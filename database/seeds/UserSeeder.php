<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // created 2 initial data for Users

        // 1 admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'phone' => '085263718273',
            'gender' => 'male',
            'address' => 'Alam Sutera',
            'profile_picture' => '/storage/images/users/Admin.png',
            'role' => 'admin'
        ]);

        // 1 member
        User::create([
            'name' => 'John',
            'email' => 'john.doe@gmail.com',
            'password' => Hash::make('password'),
            'phone' => '082738271238',
            'gender' => 'male',
            'address' => 'Gading Serpong',
            'profile_picture' => '/storage/images/users/John.png',
            'role' => 'member'
        ]);
    }
}
