<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\PetType;

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

$factory->define(App\Supply::class, function (Faker $faker) {
    return [
        'pet_type_id'   => PetType::inRandomOrder()->first()->id,
        'name'          => $faker->name,
        'price'			=> $faker->numberBetween(10,20000),
        'description'	=> $faker->paragraph,
    ];
});
