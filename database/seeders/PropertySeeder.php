<?php

namespace Database\Seeders;

use App\Models\Property;

use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $propertiesCount = (int)$this->command->ask('How many properties to generate?', 20);
        Property::factory($propertiesCount)->create();
    }
}
