<?php

use Illuminate\Database\Seeder;

class ProductsTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\PetType::class, 10)->create();
        factory(App\FoodType::class, 10)->create();
    }
}
