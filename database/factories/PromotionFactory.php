<?php
use Faker\Provider\Base;
use Faker\Provider\DateTime;

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

$factory->define(\SenseBook\Models\Promotion::class, function (Faker\Generator $faker) {
    return [
        'birthday_discount'                 => $faker->randomFloat($nbMaxDecimals = null, $min = 1, $max = 100),
        'birthday_discount_unit'            => $faker->randomElement($array = array ('thb','percent')),
        'birthday_month_discount'           => $faker->randomFloat($nbMaxDecimals = null, $min = 1, $max = 100),
        'birthday_month_discount_unit'      => $faker->randomElement($array = array ('thb','percent')),
        'second_tuesday_discount'           => $faker->randomFloat($nbMaxDecimals = null, $min = 1, $max = 100),
        'second_tuesday_discount_unit'      => $faker->randomElement($array = array ('thb','percent')),
        'free_shipping_amount_condition'    => $faker->randomDigitNotNull(),
        'free_shipping_weight_condition'    => $faker->randomDigitNotNull(),
        'double_point_start_date'           => $faker->date($format = 'Y-m-d', $max = 'now'),
        'double_point_end_date'             => $faker->date($format = 'Y-m-d', $max = 'now'),
    ];
});

$factory->define(\SenseBook\Models\PromotionVolumePurchase::class, function (Faker\Generator $faker) {
    return [
        'volume_purchase'           => $faker->numberBetween($min = 1, $max = 10),
        'volume_purchase_benefits'  => $faker->numberBetween($min = 2, $max = 10),
    ];
});
