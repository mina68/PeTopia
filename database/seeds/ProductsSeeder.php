<?php

use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Pet::class, 60)->create();
        factory(App\Drug::class, 60)->create();
        factory(App\Supply::class, 60)->create();
        factory(App\Food::class, 60)->create();
        factory(App\FoodSize::class, 60)->create();
    }
}
