<?php

namespace App\Imports;

use App\TemplateDokumenInstrumenModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class TemplateDokumenInstrumenImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        // get existing list id
        $list_id = TemplateDokumenInstrumenModel::all()->pluck('id')->toArray();

        foreach ($collection as $i => $row) {
            if ($i === 0 || in_array($row[0], $list_id)) continue;
            // kolom 0 = id
            // kolom 1 = dokumen id
            // kolom 2 = kriteria
            // kolom 3 = nama dokumen
            TemplateDokumenInstrumenModel::create([
                'id' => $row[0],
                'template_dokumen_id' => $row[1],
                'kriteria' => $row[2],
                'nama_dokumen' => $row[3],
            ]);
        }
    }
}
