<?php
namespace Tests\Unit\BackOffice\setting\Product;

use Tests\TestCase;
use Faker\Generator as Faker;
use SenseBook\Models\Product;

class ProductCreateTest extends TestCase
{

    public function testCreateProduct()
    {
        $data = factory(Product::class, 1)->make()->first()->toArray();
        $product = Product::create($data);
        $this->assertEquals($data['isbn'], $product->isbn);
        $this->assertEquals($data['name'], $product->name);
        $this->assertEquals($data['name_en'], $product->name_en);
        $this->assertEquals($data['description'], $product->description);
    }
}
