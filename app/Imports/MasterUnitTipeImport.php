<?php

namespace App\Imports;

use App\MasterUnitTipeModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class MasterUnitTipeImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        // buat list id agar data tidak ke update
        $list_id = MasterUnitTipeModel::all()->pluck('id')->toArray();
        foreach ($collection as $i => $row) {
            // validasi header & validasi kalau data sudah ada
            if ($i === 0 || in_array($row[0], $list_id)) continue;

            // kolom 0 = id
            // kolom 1 = value
            MasterUnitTipeModel::create([
                'id' => $row[0],
                'tipe' => $row[1],
            ]);
        }
    }
}
