<?php
namespace Tests\Unit\BackOffice\setting\Product;

use Tests\TestCase;
use Faker\Generator as Faker;
use SenseBook\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductRestoreTest extends TestCase
{
    public function testRestoreItem()
    {
        $data = factory(Product::class, 1)->make()->first()->toArray();
        Product::create($data);
        
        $product = Product::withTrashed()->first();
        
        $product->delete();
        $result = $product->restore();
        
        $this->assertTrue($result);
    }
}
