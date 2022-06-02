<?php

namespace Database\Seeders;

use App\Imports\MasterTemplatesImport;
use App\MasterJenjangModel;
use App\MasterUnitTipeModel;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class TemplatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // get data from excel
        $file = new MasterTemplatesImport();
        $file->onlySheets(['template', 'kriteria', 'lingkup', 'tujuan', 'dokumen', 'instrumen_dokumen', 'capaian']);

        // insert data
        Excel::import($file, base_path('database/file/audit-template.xlsx'));
    }
}
