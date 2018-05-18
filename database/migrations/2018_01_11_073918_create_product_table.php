<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();
        Schema::create('dim_products', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('isbn')->nullable();
            $table->longText('name');
            $table->longText('name_en')->nullable();
            $table->longText('description')->nullable();
            $table->integer('cover_image_id')->nullable();
            $table->decimal('cost')->default(0);
            $table->decimal('suggested_member_price')->default(0);
            $table->decimal('suggested_retail_price')->default(0);
            $table->integer('product_type_id')->nullable();
            $table->integer('shipping_method_id')->nullable();
            $table->integer('page_count')->default(0);
            $table->decimal('weight')->default(0);
            $table->decimal('width')->default(0);
            $table->decimal('depth')->default(0);
            $table->decimal('height')->default(0);
            $table->integer('reward_points')->nullable();
            $table->integer('point_redemption_for_free_gift')->nullable();
            $table->enum('is_point_redemption_only', [0, 1])->default(0);
            $table->enum('is_join_promotion', [0, 1])->default(1);
            $table->enum('is_free_shipping', [0, 1])->default(1);
            $table->longText('file_ref')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        $this->unitImage();
        $this->productCategory();
        $this->productWriter();
        $this->productType();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dim_products');
    }

    public function unitImage()
    {
        Schema::dropIfExists('unit_images');
        Schema::create('unit_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id');
            $table->integer('order')->default(1);
            $table->longText('image')->nullable();
        });
    }

    public function productCategory()
    {
        Schema::dropIfExists('product_categories');
        Schema::create('product_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id');
            $table->integer('product_id');
        });
    }

    public function productWriter()
    {
        Schema::dropIfExists('product_writers');
        Schema::create('product_writers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('writer_id');
            $table->integer('product_id');
        });
    }
    public function productType()
    {
        Schema::dropIfExists('dim_product_type');
        Schema::create('dim_product_type', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('name');
            $table->string('key');
            $table->timestamps();
        });

        \DB::table('dim_product_type')->insert([
            ['name' => 'New Release', 'key' => 'new_release'],
            ['name' => 'Official Goods', 'key' => 'official_goods'],
            ['name' => 'Best Seller', 'key' => 'best_seller'],
            ['name' => 'Coming Soon', 'key' => 'coming_soon'],
            ['name' => 'Pre Order', 'key' => 'pre_order'],
            ['name' => 'Out Of Stock', 'key' => 'out_of_stock']
        ]);
    }
}
