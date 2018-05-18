<?php
namespace Tests\Unit\BackOffice\setting\point;

use Tests\TestCase;
use Faker\Generator as Faker;

// use Illuminate\Foundation\Testing\RefreshDatabase;

class DestroyPointTest extends TestCase
{
    // use RefreshDatabase;

    public function testDestroyComplete()
    {
        factory(\SenseBook\Models\Point::class, 1)->create();
        $point = \SenseBook\Models\Point::first();

        $point->delete(); // SoftDelete

        // $result = $point->forceDelete(); // ForceDelete

        $result = \SenseBook\Models\Point::withTrashed()
            ->whereId($point->id)->forceDelete();

        $this->assertTrue($result==1);
    }
}
