<?php
namespace Tests\Unit\BackOffice\setting\point;

use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class RoutePointTest extends TestCase
{

    public function testRouteComplete()
    {
        Auth::loginUsingId(1);
        $response = $this->call('GET', '/backOffice/setting/point');
        $this->assertEquals(200, $response->status());
        Auth::logout();
    }
}
