<?php

namespace App\Imports;

use App\TemplateLingkupModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class TemplateLingkupImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        // get existing list id
        $list_id = TemplateLingkupModel::all()->pluck('id')->toArray();

        foreach ($collection as $i => $row) {
            if ($i === 0 || in_array($row[0], $list_id)) continue;
            // kolom 0 = id
            // kolom 1 = templates id
            // kolom 2 = lingkup
            TemplateLingkupModel::create([
                'id' => $row[0],
                'templates_id' => $row[1],
                'lingkup' => $row[2],
            ]);
        }
    }
}
