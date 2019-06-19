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

$factory->define(App\Drug::class, function (Faker $faker) {
    return [
        'name'                => $faker->word,
        'pet_type_id'         => PetType::inRandomOrder()->first()->id,
        'manufacturer'        => $faker->company,
        'active_constituent'  => $faker->word,
        'price'			      => $faker->numberBetween(10,1000),
        'concentration_num'   => $faker->numberBetween(50,1000),
        'notes'			=> $faker->paragraph,
    ];
});
