<?php
namespace Tests\Unit\BackOffice\setting\Product;

use Tests\TestCase;
use Faker\Generator as Faker;
use SenseBook\Models\Product;

class ProductReadTest extends TestCase
{

    public function testViewProductItem()
    {
        $product = Product::withTrashed()->first();
        
        $data = Product::withTrashed()->find($product->id);

        $this->assertEquals($product->isbn, $data->isbn);
        $this->assertEquals($product->name, $data->name);
        $this->assertEquals($product->name_en, $data->name_en);
    }
}
