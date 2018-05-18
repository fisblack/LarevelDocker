<?php
namespace Tests\Unit\BackOffice\setting\Product;

use Tests\TestCase;
use Faker\Generator as Faker;
use SenseBook\Models\Product;

class ProductDestroyTest extends TestCase
{
    public function testDelete()
    {
        $data = factory(Product::class, 1)->make()->first()->toArray();
        Product::create($data);
        
        $product = Product::withTrashed()->first();
        $result = $product->forceDelete(); // ForceDelete
        $this->assertTrue($result);
    }
}
