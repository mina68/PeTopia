<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\PetType;
use App\FoodType;

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

$factory->define(App\Food::class, function (Faker $faker) {
    return [
        'name'          => $faker->name,
        'food_type_id'  => FoodType::inRandomOrder()->first()->id,
        'pet_type_id'   => PetType::inRandomOrder()->first()->id,
        'description'	=> $faker->paragraph,
    ];
});
