<?php
namespace SenseBook\Seeder\BackOffice\Setting\Writer;

use Illuminate\Database\Seeder;

class WriterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \DB::table('dim_writers')->truncate();
        factory(\SenseBook\Models\Writer::class, 60)->create();
    }
}
