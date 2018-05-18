<?php
namespace Tests\Unit\BackOffice\setting\point;

use Tests\TestCase;
use Faker\Generator as Faker;

// use Illuminate\Foundation\Testing\RefreshDatabase;

class SearchPointTest extends TestCase
{
    // use RefreshDatabase;

    public function testSearchByPoint()
    {
        $data = [
            'points' => 100,
            'discount' => 10,
        ];

        $point = \SenseBook\Models\Point::create($data);

        $point = \SenseBook\Models\Point::where('points', 'LIKE', 100)->get();

        $this->assertNotCount(0, $point);
    }

    public function testSearchByDiscount()
    {
        $data = [
            'points' => 200,
            'discount' => 20,
        ];

        $point = \SenseBook\Models\Point::create($data);

        $point = \SenseBook\Models\Point::where('discount', 'LIKE', 20)->get();

        $this->assertNotCount(0, $point);
    }
}
