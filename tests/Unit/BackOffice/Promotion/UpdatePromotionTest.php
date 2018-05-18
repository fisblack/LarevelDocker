<?php

namespace Tests\Unit\BackOffice\Promotion;

use Tests\TestCase;
use Faker\Generator as Faker;

class UpdatePromotionTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUpdateComplete()
    {
        $data = factory(\SenseBook\Models\Promotion::class, 1)
            ->make()
            ->first()
            ->makeHidden(['date_from', 'date_to'])
            ->toArray();

        factory(\SenseBook\Models\Promotion::class, 1)->create();

        \SenseBook\Models\Promotion::whereRaw('1=1')->update($data);

        $item = \SenseBook\Models\Promotion::first();

        $this->assertEquals(number_format($data['birthday_discount'], 3, '.', ''), $item->birthday_discount);
        $this->assertEquals($data['birthday_discount_unit'], $item->birthday_discount_unit);
    }
}
