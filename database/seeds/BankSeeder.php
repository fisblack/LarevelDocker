<?php

use SenseBook\Models\FactBankAccount;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class BankSeeder extends Seeder
{

    private $sources;

    public function __construct()
    {

        $path = database_path('sources/banks.json');

        $this->sources = json_decode(file_get_contents($path), false);

        //text builder supports only one seed file
        $this->sources = collect($this->sources)->unique();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->sources as $source) {
            $bank = new FactBankAccount();

            $bank->name = trim($source->name);
            $bank->logo = trim($source->logo);
           
            $bank->save();
        }
    }
}
