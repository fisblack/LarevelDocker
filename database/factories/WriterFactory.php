<?php

use Faker\Generator as Faker;

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

$factory->define(SenseBook\Models\Writer::class, function (Faker $faker) {
    return [
        'fullname_th' => $faker->name,
        'fullname_en' => $faker->name,
        'image'=>'pic01',
        'description_th'=>$faker->text,
        'description_en'=>$faker->text
    ];
});
