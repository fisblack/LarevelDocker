<?php

namespace Tests\Unit\BackOffice\setting\shipping;

use Tests\TestCase;
use Faker\Generator as Faker;

class UpdateShippingTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUpdateComplete()
    {
        $data = factory(\SenseBook\Models\ShippingFee::class, 1)
            ->make()
            ->toArray();

        factory(\SenseBook\Models\ShippingFee::class, 1)->create();

        \SenseBook\Models\ShippingFee::whereRaw('1=1')->update($data[0]);

        $item = \SenseBook\Models\ShippingFee::first();

        $this->assertEquals($data[0]['amount'], $item->amount);
    }
}
