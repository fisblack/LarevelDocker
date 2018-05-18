<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();
        Schema::create('dim_banners', function (Blueprint $table) {
            $table->increments('id');
            $table->text('image')->nullable();
            $table->string('url_image')->nullable();
            $table->enum('is_promotion', [0, 1])->default(0);
            $table->enum('is_show', [0, 1])->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        $this->defaultStructure();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dim_banners');
    }

    public function defaultStructure()
    {
        \DB::table('dim_banners')->insert([
            ['is_promotion' => '0', 'is_show' => '0'],
            ['is_promotion' => '0', 'is_show' => '0'],
            ['is_promotion' => '0', 'is_show' => '0'],
            ['is_promotion' => '0', 'is_show' => '0'],
            ['is_promotion' => '0', 'is_show' => '0'],
            ['is_promotion' => '0', 'is_show' => '0'],
            ['is_promotion' => '1', 'is_show' => '0']
        ]);
    }
}
