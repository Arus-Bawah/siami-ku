<?php

namespace Database\Seeders;

use App\Imports\MasterDataImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class MasterJenjangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // get data from excel
        $file = new MasterDataImport();
        $file->onlySheets(['Jenjang']);

        // insert data
        Excel::import($file, base_path('database/file/master-data.xlsx'));
    }
}
