<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWriterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();
        Schema::create('dim_writers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fullname_th');
            $table->string('fullname_en');
            $table->longText('image')->nullable();
            $table->longText('description_th')->nullable();
            $table->longText('description_en')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dim_writers');
    }
}
