<?php
namespace SenseBook\Seeder\BackOffice\Setting\Shipping;

use Illuminate\Database\Seeder;
use SenseBook\Models\ShippingType;

class DimShippingTypesTableSeeder extends Seeder
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
                'name' => 'registered'
            ],
            1 => [
                'name' => 'ems'
            ],
            2 => [
                'name' => 'kerry'
            ]
        ];

        foreach ($data as $key => $name) {
            $type = new ShippingType;
            $type->fill($name);
            $type->save();
        }
    }
}
