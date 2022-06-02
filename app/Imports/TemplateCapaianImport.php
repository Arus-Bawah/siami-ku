<?php

namespace App\Imports;

use App\TemplateCapaianModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class TemplateCapaianImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        // get existing list id
        $list_id = TemplateCapaianModel::all()->pluck('id')->toArray();

        foreach ($collection as $i => $row) {
            if ($i === 0 || in_array($row[0], $list_id) || $row[0] == "") continue;
            if ($row[0] == "" || $row[1] == "" || $row[2] == "" || $row[3] == "" || $row[4] == "") continue;
            dd($row);
            // kolom 0 = id
            // kolom 1 = template id
            // kolom 2 = kriteria
            // kolom 3 = standar
            // kolom 4 = nominal standar
            TemplateCapaianModel::create([
                'id' => $row[0],
                'template_dokumen_id' => $row[1],
                'kriteria' => $row[2],
                'standar' => $row[3],
                'nominal_standar' => $row[3],
            ]);
        }
    }
}
