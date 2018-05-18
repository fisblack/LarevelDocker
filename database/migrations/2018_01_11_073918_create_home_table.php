<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();
        Schema::create('home', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->nullable();
            $table->enum('type', [
                'best_seller',
                'new_release',
                'coming_soon',
                'official_goods']);
        });

        // Initial value
        $this->defaultData();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('home');
    }

    public function defaultData()
    {
        $type = ['best_seller', 'new_release', 'coming_soon', 'official_goods'];

        foreach ($type as $key => $value) {
            for ($i = 0; $i < 8; $i++) {
                \DB::table('home')->insert(['type' => $value]);
            }
        }
    }
}
