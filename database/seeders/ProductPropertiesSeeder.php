<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductProperties;
use App\Models\Property;
use Illuminate\Database\Seeder;

class ProductPropertiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::all();
        $properties = Property::all();

        if ($products->count() === 0 || $properties->count() === 0) {
            $this->command->info('There are no products or properties to be bind');
            return;
        }

        $propertiesForProduct = (int)$this->command->ask('How many properties attach to each product?', 5);

        foreach ($products as $product) {

            $propertiesToAttend = $properties->random($propertiesForProduct);

            foreach ($propertiesToAttend as $property) {

                $propertiesValues = ['foo', 'bar', 'baz', 'one', 'two', 'three'];
                $randIndex = random_int(0, count($propertiesValues) - 1);
                ProductProperties::create([
                    'product_id' => $product->id,
                    'property_id' => $property->id,
                    'property_value' => $propertiesValues[$randIndex]
                ]);
            }
        }
    }

}

