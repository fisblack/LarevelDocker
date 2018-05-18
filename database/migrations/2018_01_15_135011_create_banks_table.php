<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    private $sources;

    public function up()
    {
  
        $this->down();

        Schema::create('dim_banks', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('bank_id')->unsigned();
            $table->string('name', 255);
            $table->enum('account_type', [
                    'เงินฝากออมทรัพย์',
                    'เงินฝากกระแสรายวัน',
                    'เงินฝากประจำ','ตั๋วแลกเงิน',
                    'เงินฝากปลอดภาษี'])
                    ->default('เงินฝากออมทรัพย์');
            $table->bigInteger('account_no')->unique();
            $table->string('branch', 255);
            $table->timestamps();
            $table->softDeletes();
        });

        
        Schema::create('fact_bank_accounts', function (Blueprint $table) {

            $table->increments('id');
            $table->string('name', 255)->unique();
            $table->string('logo');
            $table->timestamps();
            $table->softDeletes();
        });

        $this->insertData();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('dim_banks');
        Schema::dropIfExists('fact_bank_accounts');
    }

    private function insertData()
    {

        $path = database_path('sources/banks.json');
        $this->sources = json_decode(file_get_contents($path), false);
        $this->sources = collect($this->sources)->unique();

        $list = array();

        foreach ($this->sources as $source) {
            $data = array(
                'name' => $source->name,
                'logo' => $source->logo
            );

 
            \DB::table('fact_bank_accounts')->insert($data);
        }
    }
}
