<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ecommerce;

class ecommerceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ecommerce::create([
            'fname' => 'Admin',
            'lname' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'), 
            'country' => 'Your Country',
            'city' => 'Your City',
            'gender' => 'male', 
            'photo' => 'path_to_admin_photo.jpg', 
            'role'=>'admin',
            'is_active' => '1',

        ]);
    }
}
