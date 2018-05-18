<?php

namespace Tests\Unit\BackOffice\Example;

use Tests\TestCase;
use Faker\Factory as Faker;
use DurianSoftware\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleCreateTest extends TestCase
{
    use RefreshDatabase;

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
        $result = \Artisan::call('migrate', ['--path' => '/database/migrations/']);
        $this->assertTrue($result);
    }

    /**
     * @test Creating a Example with complete data
     */
    public function testCreateComplete()
    {
        $data = factory(User::class, 1)->make()->first()->toArray();

        $user = User::create($data);

        $this->assertEquals($data['name'], $category->name);
        $this->assertEquals($data['email'], $category->email);
    }

    /**
     * @test Creating a User with missing name
     */
    public function testCreateMissingName()
    {
        $this->assertTrue(true);
    }
}
