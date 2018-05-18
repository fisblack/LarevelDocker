<?php

namespace Tests\Unit\BackOffice\setting\shipping;

use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class RouteShippingTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRouteComplete()
    {
        Auth::loginUsingId(1);
        $response = $this->call('GET', '/backOffice/setting/shipping');
        $this->assertEquals(200, $response->status());
        Auth::logout();
    }
}
