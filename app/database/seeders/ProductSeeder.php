<?php

namespace Database\Seeders;

use App\Models\Brands;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Config;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        foreach (range(1, 50) as $value) {
            Product::create([
                'name' => $faker->randomElement(Brands::pluck('name')),
                'price' => $faker->numberBetween($min = 1000, $max = 100000),
                'sale_price' => $faker->numberBetween($min = 500, $max = 50000),
                'color' => $faker->randomElement(['Gold', 'Red', 'Silver', 'Blue', 'Black']),
                'brand' => $faker->randomElement(Brands::pluck('name')),
                'product_code' => $faker->numerify('LV-####'),
                'function' => $faker->randomElement(Config::get('function_watch')),
                'stock' => $faker->randomDigit(),
                'description' => $faker->text($maxNbChars = 200),
                'image' => $faker->imageUrl('$width=640, $height = 480'),
                'is_active' => $faker->randomElement(['1', '0']),
            ]);
        }
    }
}
