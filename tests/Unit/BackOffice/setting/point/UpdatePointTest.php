<?php
namespace Tests\Unit\BackOffice\setting\point;

use Tests\TestCase;
use Faker\Generator as Faker;

// use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdatePointTest extends TestCase
{
    // use RefreshDatabase;

    public function testCaseExample()
    {
        $data = factory(\SenseBook\Models\Point::class, 1)->make()->first()->toArray();
        factory(\SenseBook\Models\Point::class, 1)->create();

        $point = \SenseBook\Models\Point::first();
        \SenseBook\Models\Point::where('id', $point->id)->update($data);

        $item = \SenseBook\Models\Point::find($point->id);

        $this->assertEquals($data['points'], $item->points);
        $this->assertEquals($data['discount'], $item->discount);
    }
}
