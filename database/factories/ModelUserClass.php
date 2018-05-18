<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(SenseBook\Models\UserClass::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name_th' =>$faker->name,
        'name_en'=>$faker->name,
        'color' => $faker->hexcolor,
        'discount_type' =>$faker->randomElement(['Bath','%']),
        'discount' =>rand(10, 100),
        'minimum_purchase' => rand(100, 1000)
    ];
});
