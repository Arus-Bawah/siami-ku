<?php

namespace App\Imports;

use App\MasterJenjangModel;
use App\MasterUnitJenjangModel;
use App\MasterUnitModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class MasterUnitImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        // buat list id agar data tidak ke update
        $list_id = MasterUnitModel::all()->pluck('id')->toArray();

        // insert unit
        foreach ($collection as $i => $row) {
            // validasi header & validasi kalau data sudah ada
            if ($i === 0 || in_array($row[0], $list_id)) continue;

            // kolom 0 = id
            // kolom 1 = value
            // kolom 2 = parent
            MasterUnitModel::create([
                'id' => $row[0],
                'master_unit_tipe_id' => $row[1],
                'master_unit_parent_id' => (isset($row[3]) ? $row[3] : null),
                'unit' => $row[2],
            ]);
        }

        // buat tmp jenjang untuk indexing
        $list_jenjang = [];
        $jenjang = MasterJenjangModel::all();
        foreach ($jenjang as $row) {
            $list_jenjang[$row->jenjang] = $row->id;
        }

        // buat tmp jenjang untuk validasi
        $list_unit_jenjang = [];
        $unit_jenjang = MasterUnitJenjangModel::all();
        foreach ($unit_jenjang as $row) {
            $list_unit_jenjang[] = $row->master_jenjang_id . '|' . $row->master_unit_id;
        }

        // insert jenjang
        foreach ($collection as $i => $row) {
            if ($row[1] === 2 && isset($row[4])) {
                foreach (explode(",", $row[4]) as $j => $jenjang) {
                    $jenjang_id = (isset($list_jenjang[$jenjang]) ? $list_jenjang[$jenjang] : 0);
                    $check = $jenjang_id . '|' . $row[0];

                    // validasi exist data
                    if (!in_array($check, $list_unit_jenjang) && $jenjang_id > 0) {
                        MasterUnitJenjangModel::create([
                            'master_jenjang_id' => $jenjang_id,
                            'master_unit_id' => $row[0]
                        ]);
                    }
                }
            }
        }
    }
}
