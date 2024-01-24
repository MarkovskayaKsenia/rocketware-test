<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productsCount = (int)$this->command->ask('How many products to generate?', 100);
        Product::factory($productsCount)->create();
    }
}
