<?php
namespace Tests\Unit\BackOffice\setting\point;

use Tests\TestCase;
use Faker\Generator as Faker;

// use Illuminate\Foundation\Testing\RefreshDatabase;

class DeletePointTest extends TestCase
{
    // use RefreshDatabase;

    public function testDeleteComplete()
    {
        factory(\SenseBook\Models\Point::class, 1)->create();
        $point = \SenseBook\Models\Point::first();
        $result = $point->delete();
        $this->assertTrue($result);
    }
}
