<?php
namespace Tests\Unit\BackOffice\setting\Product;

use Tests\TestCase;
use Faker\Generator as Faker;
use SenseBook\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductSearchTest extends TestCase
{
    public $data = [
        'isbn' => '123456789',
        'name' => 'อดิวิศ',
        'name_en' => 'AdiwIT',
        'description' => 'Adiwit Co., Ltd.',
        'cover_image_id' => null,
        'cost' => 50,
        'suggested_member_price' => 55,
        'suggested_retail_price' => 30,
        'product_type_id' => 1,
        'page_count' => 130,
        'weight' => 3.5,
        'width' => 15,
        'depth' => 5,
        'height' => 17.9,
        'shipping_method_id' => 1,
        'reward_points' => 50,
        'point_redemption_for_free_gift' => 1,
        'is_point_redemption_only' => '0',
        'is_join_promotion' => '1',
        'is_free_shipping' => '1',
        'file_ref' => ''
    ];

    public function testSearchByName()
    {
        Product::create($this->data);
        $product = Product::where('name', 'LIKE', '%อดิว%')->withTrashed()->first();

        $this->assertEquals($this->data['name'], $product->name);
    }

    public function testSearchByDescription()
    {
        Product::create($this->data);
        $product = Product::where('description', 'LIKE', '%Adiwit%')->first();
        
        $this->assertEquals($this->data['description'], $product->description);
    }

    public function testSearchByProductCode()
    {
        Product::create($this->data);
        $product = Product::where('isbn', 'LIKE', '%23456%')->withTrashed()->first();
        $this->assertEquals($this->data['isbn'], $product->isbn);
    }

    public function testSearchByPageCount()
    {
        Product::create($this->data);
        $product = Product::where('page_count', '130')->withTrashed()->first();
        
        $this->assertEquals($this->data['page_count'], $product->page_count);
    }
}
