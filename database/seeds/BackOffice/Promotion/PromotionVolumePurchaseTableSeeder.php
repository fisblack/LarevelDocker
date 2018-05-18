<?php

namespace SenseBook\Seeder\BackOffice\Promotion;

use Illuminate\Database\Seeder;

class PromotionVolumePurchaseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('promotion_volume_purchase')->truncate();
        factory(\SenseBook\Models\PromotionVolumePurchase::class, 5)->create();
    }
}
