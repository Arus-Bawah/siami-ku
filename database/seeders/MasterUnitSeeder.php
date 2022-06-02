<?php

namespace Database\Seeders;

use App\Imports\MasterDataImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class MasterUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // get data from excel
        $unit = new MasterDataImport();
        $unit->onlySheets(['Fakultas', 'Prodi', 'Biro', 'Lab', 'Lembaga', 'UPT']);

        // insert data
        Excel::import($unit, base_path('database/file/master-data.xlsx'));
    }
}
