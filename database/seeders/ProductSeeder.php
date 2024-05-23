<?php

namespace Database\Seeders;

use Devinci\Bladekit\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::factory()->count(50)->create();
    }
}
