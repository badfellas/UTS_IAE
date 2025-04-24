<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'Glock19',
            'price' => 21000000,
        ]);

        Product::create([
            'name' => 'Tech-9',
            'price' => 35000000,
        ]);

        Product::create([
            'name' => 'AK47',
            'price' => 85000000,
        ]);
    }
}
