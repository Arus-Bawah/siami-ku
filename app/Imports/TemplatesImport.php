<?php

namespace App\Imports;

use App\MasterJenjangModel;
use App\MasterUnitTipeModel;
use App\TemplatesModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class TemplatesImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        // generate format template from db
        $master = $this->getMaster();

        // get existing list id
        $templates_id = TemplatesModel::all()->pluck('id')->toArray();

        foreach ($collection as $i => $row) {
            if ($i === 0 || in_array($row[0], $templates_id)) continue;

            // kolom 0 = id
            // kolom 1 = tipe
            // kolom 2 = unit
            // kolom 3 = jenjang
            // kolom 4 = nama template
            $key = $row[1] . '|' . $row[2] . ($row[3] ? '|' . $row[3] : '');
            if (isset($master[$key])) {
                TemplatesModel::create([
                    'id' => $row[0],
                    'master_unit_tipe_id' => $master[$key]['tipe_id'],
                    'master_unit_id' => $master[$key]['unit_id'],
                    'master_unit_jenjang_id' => $master[$key]['jenjang_id'],
                    'name' => $row[4],
                ]);
            }
        }
    }

    private function getMaster()
    {
        // get data jenjang untuk indexing
        $list_jenjang = [];
        $jenjang = MasterJenjangModel::all();
        foreach ($jenjang as $row) {
            $list_jenjang[$row->id] = $row->jenjang;
        }

        // membuat master data untuk
        $master = [];
        $unit_tipe = MasterUnitTipeModel::all();
        foreach ($unit_tipe as $row) {

            $unit = $row->masterUnit;
            foreach ($unit as $xrow) {

                $jenjang = $xrow->masterUnitJenjang;

                if (count($jenjang) > 0) {
                    foreach ($jenjang as $yrow) {
                        if (!isset($list_jenjang[$yrow->master_jenjang_id])) continue;

                        $key = $row->tipe . '|' . $xrow->unit . '|' . $list_jenjang[$yrow->master_jenjang_id];
                        $master[$key] = [
                            'tipe_id' => $row->id,
                            'tipe' => $row->tipe,
                            'unit_id' => $xrow->id,
                            'unit' => $xrow->unit,
                            'jenjang_id' => $yrow->id,
                            'jenjang' => $list_jenjang[$yrow->master_jenjang_id]
                        ];
                    }
                } else {
                    $key =  $row->tipe . '|' . $xrow->unit;
                    $master[$key] = [
                        'tipe_id' => $row->id,
                        'tipe' => $row->tipe,
                        'unit_id' => $xrow->id,
                        'unit' => $xrow->unit,
                        'jenjang_id' => null,
                        'jenjang' => null
                    ];
                }
            }
        }

        return $master;
    }
}
