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

$factory->define(SenseBook\Models\Product::class, function (Faker $faker) {
    return [
        'isbn' => $faker->isbn13,
        'name' => $faker->name,
        'name_en' => $faker->name,
        'description' => $faker->text,
        'cover_image_id' => $faker->randomDigitNotNull,
        'cost' => $faker->randomFloat(2, 1, 300),
        'suggested_member_price' => $faker->randomFloat(2, 1, 300),
        'suggested_retail_price' => $faker->randomFloat(2, 1, 300),
        'product_type_id' => $faker->numberBetween(1, 6),
        'page_count' => $faker->numberBetween(50, 300),
        'weight' => $faker->randomFloat(2, 1, 20),
        'width' => $faker->randomFloat(2, 1, 20),
        'depth' => $faker->randomFloat(2, 1, 20),
        'height' => $faker->randomFloat(2, 1, 20),
        'shipping_method_id' => $faker->numberBetween(1, 100),
        'reward_points' => $faker->numberBetween(1, 100),
        'point_redemption_for_free_gift' => $faker->numberBetween(1, 100),
        'is_point_redemption_only' => $faker->randomElement(['1', '0']),
        'is_join_promotion' => $faker->randomElement(['1', '0']),
        'is_free_shipping' => $faker->randomElement(['1', '0']),
        'file_ref' => $faker->image()
    ];
});
