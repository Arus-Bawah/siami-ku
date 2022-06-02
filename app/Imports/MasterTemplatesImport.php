<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;

class MasterTemplatesImport implements WithMultipleSheets, SkipsUnknownSheets
{
    use WithConditionalSheets;

    public function conditionalSheets(): array
    {
        return  [
            'template' => new TemplatesImport,
            'kriteria' => new TemplateKriteriaImport,
            'lingkup' => new TemplateLingkupImport,
            'tujuan' => new TemplateTujuanImport,
            'dokumen' => new TemplateDokumenImport,
            'instrumen_dokumen' => new TemplateDokumenInstrumenImport,
            'capaian' => new TemplateCapaianImport,
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        info("Sheet {$sheetName} was skipped");
    }
}
