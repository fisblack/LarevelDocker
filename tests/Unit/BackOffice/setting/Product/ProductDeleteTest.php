<?php
namespace Tests\Unit\BackOffice\setting\Product;

use Tests\TestCase;
use Faker\Generator as Faker;
use SenseBook\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductDeleteTest extends TestCase
{
    public function testDeleteProductItem()
    {
        $product = Product::first();
        $result = $product->delete();
        $this->assertTrue($result);
    }
}
