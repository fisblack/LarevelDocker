<?php

namespace SenseBook\Seeder\BackOffice\Promotion;

use Illuminate\Database\Seeder;

class PromotionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('promotions')->truncate();
        factory(\SenseBook\Models\Promotion::class, 1)->create();
    }
}
