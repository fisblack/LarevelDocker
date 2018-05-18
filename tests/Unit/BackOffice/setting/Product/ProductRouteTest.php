<?php
namespace Tests\Unit\BackOffice\setting\Product;

use Tests\TestCase;
use Faker\Generator as Faker;
use SenseBook\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductRouteTest extends TestCase
{
    public function testRouteIndex()
    {
        Auth::loginUsingId(1);
        $response = $this->call('GET', 'backOffice/setting/product');
        $this->assertEquals(200, $response->status());
        Auth::logout();
    }

    public function testRouteCreate()
    {
        Auth::loginUsingId(1);
        $response = $this->call('GET', '/backOffice/setting/product/create');
        $this->assertEquals(200, $response->status());
        Auth::logout();
    }

    public function testRouteShow()
    {
        Auth::loginUsingId(1);
        $product = Product::first();
        $response = $this->call('GET', '/backOffice/setting/product/' . $product->id);
        $this->assertEquals(200, $response->status());
        Auth::logout();
    }

    public function testRouteEdit()
    {
        Auth::loginUsingId(1);
        $product = Product::first();
        $response = $this->call('GET', '/backOffice/setting/product/'. $product->id .'edit');
        $this->assertEquals(200, $response->status());
        Auth::logout();
    }
}
