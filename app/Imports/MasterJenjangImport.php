<?php

namespace App\Imports;

use App\MasterJenjangModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class MasterJenjangImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        // buat list id agar data tidak ke update
        $list_id = MasterJenjangModel::all()->pluck('id')->toArray();
        foreach ($collection as $i => $row) {
            // validasi header & validasi kalau data sudah ada
            if ($i === 0 || in_array($row[0], $list_id)) continue;

            // kolom 0 = id
            // kolom 1 = value
            MasterJenjangModel::create([
                'id' => $row[0],
                'jenjang' => $row[1],
            ]);
        }
    }
}
