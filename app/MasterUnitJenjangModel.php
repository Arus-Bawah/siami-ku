<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterUnitJenjangModel extends Model
{
    use HasFactory;

    protected $table = 'master_unit_jenjang';

    public function masterUnitTipe()
    {
        return $this->belongsTo(MasterUnitModel::class, 'master_unit_id');
    }

    public function masterJenjang()
    {
        return $this->belongsTo(MasterJenjangModel::class, 'master_jenjang_id');
    }

    public static function pluckJenjangIdByUnit($unit_id)
    {
        return self::query()
            ->where('master_unit_id', '=', $unit_id)
            ->pluck('master_jenjang_id')
            ->toArray();
    }
}
