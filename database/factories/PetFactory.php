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

$factory->define(App\Pet::class, function (Faker $faker) {
    return [
        'pet_type_id'   => PetType::inRandomOrder()->first()->id,
        'response_name' => $faker->name,
        'birthday' 		=> $faker->date,
        'color'			=> $faker->safeColorName,
        'birth_country'	=> $faker->country,
        'breed'			=> $faker->word,
        'price'			=> $faker->numberBetween(1000,20000),
        'weight'		=> $faker->numberBetween(1,60),
        'notes'			=> $faker->paragraph,
        'altered'		=> $faker->boolean,
        'sex'			=> $faker->randomElement(['male', 'female']),
    ];
});
