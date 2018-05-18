<?php

namespace SenseBook\Console\Commands;

use Baraear\ThaiAddress\Models\PostalCode;
use Exception;
use Illuminate\Console\Command;

class DumpAddresses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dump:addresses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dump address data from database into JSON file.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $postalCodes = PostalCode::all();
            $addresses = array();
            foreach ($postalCodes as $postalCode) {
                $transferData = [
                    'sub_district' => $postalCode->sub_district->name,
                    'sub_district_id' => $postalCode->sub_district->id,
                    'district' => $postalCode->district->name,
                    'district_id' => $postalCode->district->id,
                    'province' => $postalCode->province->name,
                    'province_id' => $postalCode->province->id,
                    'postal_code' => $postalCode->code,
                    'postal_code_id' => $postalCode->id,
                ];
                array_push($addresses, $transferData);
            }
            $path = resource_path('assets/js/website/addresses.json');
            if (file_exists($path)) {
                unlink($path);
            }
            $handle = fopen($path, 'w+');
            fwrite($handle, json_encode($addresses));
            fclose($handle);
            $this->info("Export addresses to \"{$path}\" successfully !");
        } catch (Exception $e) {
            $this->error($e);
        }
    }
}
