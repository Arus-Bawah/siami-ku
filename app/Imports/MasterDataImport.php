<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;

class MasterDataImport implements WithMultipleSheets, SkipsUnknownSheets
{
    use WithConditionalSheets;

    public function conditionalSheets(): array
    {
        return  [
            'Jenjang' => new MasterJenjangImport,
            'Unit' => new MasterUnitTipeImport,
            'Fakultas' => new MasterUnitImport,
            'Prodi' => new MasterUnitImport,
            'Biro' => new MasterUnitImport,
            'Lab' => new MasterUnitImport,
            'Lembaga' => new MasterUnitImport,
            'UPT' => new MasterUnitImport,
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        info("Sheet {$sheetName} was skipped");
    }
}
