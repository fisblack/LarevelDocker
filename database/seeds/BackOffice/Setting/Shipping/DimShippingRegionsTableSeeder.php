<?php
namespace SenseBook\Seeder\BackOffice\Setting\Shipping;

use Illuminate\Database\Seeder;
use SenseBook\Models\ShippingRegion;

class DimShippingRegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            0 => [
                'region_name' => 'ภาคเหนือ'
            ],
            1 => [
                'region_name' => 'ภาคตะวันออกเฉียงเหนือ'
            ],
            2 => [
                'region_name' => 'ภาคตะวันตก'
            ],
            3 => [
                'region_name' => 'ภาคกลาง'
            ],
            4 => [
                'region_name' => 'ภาคตะวันออก'
            ],
            5 => [
                'region_name' => 'ภาคใต้'
            ]
        ];

        foreach ($data as $key => $name) {
            $region = new ShippingRegion;
            $region->fill($name);
            $region->save();
        }
    }
}
