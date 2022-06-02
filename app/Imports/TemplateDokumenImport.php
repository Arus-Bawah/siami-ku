<?php

namespace App\Imports;

use App\TemplateDokumenModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class TemplateDokumenImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        // get existing list id
        $list_id = TemplateDokumenModel::all()->pluck('id')->toArray();

        foreach ($collection as $i => $row) {
            if ($i === 0 || in_array($row[0], $list_id)) continue;
            // kolom 0 = id
            // kolom 1 = templates id
            // kolom 2 = standar
            TemplateDokumenModel::create([
                'id' => $row[0],
                'templates_id' => $row[1],
                'standar' => $row[2],
            ]);
        }
    }
}
