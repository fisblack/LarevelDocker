<?php
namespace Tests\Unit\BackOffice\setting\Product;

use Tests\TestCase;
use Faker\Generator as Faker;
use SenseBook\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductUpdateTest extends TestCase
{
    public function testUpdateProductItem()
    {
        $data = factory(Product::class, 1)->make()->first()->toArray();
        
        $product = Product::first();
        $product->update($data);
        
        $this->assertEquals($data['isbn'], $product->isbn);
        $this->assertEquals($data['name'], $product->name);
        $this->assertEquals($data['name_en'], $product->name_en);
        $this->assertEquals($data['description'], $product->description);
    }
}
