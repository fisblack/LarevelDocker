<?php

namespace Tests\Unit\BackOffice\setting\shipping;

use Tests\TestCase;
use Faker\Factory as Faker;
use DurianSoftware\User;

class CreateShippingTest extends TestCase
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
    // public function testCanMigrate()
    // {
    //     // refresh database
    //     $result = \Artisan::call('migrate:reset', ['--force' => true]);
    //
    //     $result = \Artisan::call('migrate');
    //
    //     $this->assertDatabaseHas('migrations', [
    //         'migration' =>'2018_02_22_160735_create_dim_shipping_regions_table'
    //     ]);
    //
    //     $this->assertDatabaseHas('migrations', [
    //         'migration' =>'2018_02_22_161024_create_dim_shipping_type_table'
    //     ]);
    //
    //     $this->assertDatabaseHas('migrations', [
    //         'migration' =>'2018_02_22_191956_create_fact_shipping_fee_table'
    //     ]);
    // }

    /**
     * @test Creating a Example with complete data
     */
    public function testCreateComplete()
    {
        $data = factory(\SenseBook\Models\ShippingFee::class, 1)->make()->first()->toArray();

        $item = \SenseBook\Models\ShippingFee::create($data);

        $this->assertEquals($data['type_id'], $item->type_id);
        $this->assertEquals($data['region_id'], $item->region_id);
        $this->assertEquals($data['minimum_weight'], $item->minimum_weight);
        $this->assertEquals($data['maximum_weight'], $item->maximum_weight);
        $this->assertEquals($data['amount'], $item->amount);
        $this->assertEquals($data['point_redemption'], $item->point_redemption);
    }
}
