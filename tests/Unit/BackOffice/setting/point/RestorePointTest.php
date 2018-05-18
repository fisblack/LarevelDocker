<?php
namespace Tests\Unit\BackOffice\setting\point;

use Tests\TestCase;
use Faker\Generator as Faker;

// use Illuminate\Foundation\Testing\RefreshDatabase;

class RestorePointTest extends TestCase
{
    // use RefreshDatabase;

    public function testRestoreComplete()
    {
        factory(\SenseBook\Models\Point::class, 1)->create();
        $point = \SenseBook\Models\Point::first();

        $point->delete(); // SoftDelete
        $result = $point->restore();

        $this->assertTrue($result);
    }
}
