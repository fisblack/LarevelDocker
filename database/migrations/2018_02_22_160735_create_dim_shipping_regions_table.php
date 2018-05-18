<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateDimShippingRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dim_shipping_regions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('region_name', 255);
        });

        $data = [
            0 => ['region_name' => 'เหนือ'],
            1 => ['region_name' => 'ตะวันออกเฉียงเหนือ'],
            2 => ['region_name' => 'ตะวันตก'],
            3 => ['region_name' => 'กลาง'],
            4 => ['region_name' => 'ตะวันออก'],
            5 => ['region_name' => 'ใต้'],
        ];

        DB::table('dim_shipping_regions')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dim_shipping_regions');
    }
}
