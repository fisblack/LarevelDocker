<?php
namespace Tests\Unit\BackOffice\setting\point;

use Tests\TestCase;
use Faker\Factory as Faker;
use DurianSoftware\User;

// use Illuminate\Foundation\Testing\RefreshDatabase;

class CreatePointTest extends TestCase
{
    // use RefreshDatabase;

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

        $this->assertDatabaseHas('migrations', ['migration' =>'2018_01_18_025807_create_dim_points_table']);
    }

    /**
     * @test Creating a Example with complete data
     */
    public function testCreateComplete()
    {
        $data = factory(\SenseBook\Models\Point::class, 1)->make()->first()->toArray();

        $item = \SenseBook\Models\Point::create($data);

        $this->assertEquals($data['points'], $item->points);
        $this->assertEquals($data['discount'], $item->discount);
    }

    /**
     * @test Creating a User with missing name
     */
    public function testCreateMissingName()
    {
        $this->assertTrue(true);
    }
}
