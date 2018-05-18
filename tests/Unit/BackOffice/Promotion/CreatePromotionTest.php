<?php

namespace Tests\Unit\BackOffice\Promotion;

use Tests\TestCase;
use Faker\Factory as Faker;
use DurianSoftware\User;

class CreatePromotionTest extends TestCase
{
    protected $faker;

    /**
     * Constructor - creates faker
     */
    public function __construct()
    {
        parent::__construct();
        $this->faker = Faker::create();
    }

    /**
     * @test Initialise
     */
    public function testCanMigrate()
    {
        // refresh database
        $result = \Artisan::call('migrate:reset', ['--force' => true]);

        $result = \Artisan::call('migrate');

        $this->assertDatabaseHas('migrations', [
            'migration' =>'2018_02_13_084127_create_promotions_table'
        ]);

        $this->assertDatabaseHas('migrations', [
            'migration' =>'2018_02_13_085309_create_promotion_volume_purchase_table'
        ]);
    }

    /**
     * @test Creating a Example with complete data
     */
    public function testCreateComplete()
    {
        $data = factory(\SenseBook\Models\Promotion::class, 1)->make()->first()->toArray();

        $item = \SenseBook\Models\Promotion::create($data);

        $this->assertEquals($data['birthday_discount'], $item->birthday_discount);
        $this->assertEquals($data['birthday_discount_unit'], $item->birthday_discount_unit);
        $this->assertEquals($data['birthday_month_discount'], $item->birthday_month_discount);
        $this->assertEquals($data['birthday_month_discount_unit'], $item->birthday_month_discount_unit);
        $this->assertEquals($data['second_tuesday_discount'], $item->second_tuesday_discount);
        $this->assertEquals($data['second_tuesday_discount_unit'], $item->second_tuesday_discount_unit);
        $this->assertEquals($data['free_shipping_amount_condition'], $item->free_shipping_amount_condition);
        $this->assertEquals($data['free_shipping_weight_condition'], $item->free_shipping_weight_condition);
        $this->assertEquals($data['double_point_start_date'], $item->double_point_start_date);
        $this->assertEquals($data['double_point_end_date'], $item->double_point_end_date);
    }
}
