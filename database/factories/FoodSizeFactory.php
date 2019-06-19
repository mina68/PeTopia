<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Food;
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\FoodSize::class, function (Faker $faker) {
    return [
    	'food_id'   => Food::inRandomOrder()->first()->id,
        'size'		=> $faker->numberBetween(10,1000),
        'price'   	=> $faker->numberBetween(50,1000),
    ];
});
