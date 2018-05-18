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

$factory->define(\SenseBook\Models\ShippingFee::class, function (Faker\Generator $faker) {
    $sample_min_weight = [0, 100.01, 200.01, 300.01, 400.01, 500.01, 600.01, 700.01, 800.01, 900.01, 1000.01, 1100.01];
    $sample_max_weight = [100, 200, 300, 400, 500, 600, 700, 800, 900, 1000, 1100, 1200];
    $index = $faker->randomElement($array = array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9));

    return [
        'type_id'           => $faker->randomElement($array = array (1, 2, 3)),
        'region_id'         => $faker->randomElement($array = array (1, 2, 3, 4, 5, 6)),
        'minimum_weight'    => $sample_min_weight[$index],
        'maximum_weight'    => $sample_max_weight[$index],
        'amount'            => $faker->numberBetween($min = 100, $max = 1000),
        'point_redemption'  => $faker->numberBetween($min = 100, $max = 1000),
    ];
});
