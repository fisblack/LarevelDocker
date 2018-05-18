<?php
use Faker\Provider\Base;

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

$factory->define(\SenseBook\Models\Point::class, function (Faker\Generator $faker) {
    return [
        'points'    => $faker->numberBetween($min = 100, $max = 1000),
        'discount'  => $faker->numberBetween($min = 10, $max = 100),
    ];
});
