<?php

namespace Tests\Unit\BackOffice\Promotion;

use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class RoutePromotionTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRouteComplete()
    {
        Auth::loginUsingId(1);
        $response = $this->call('GET', '/backOffice/promotion');
        $this->assertEquals(200, $response->status());
        Auth::logout();
    }
}
