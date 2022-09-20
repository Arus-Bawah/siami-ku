<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterUnitModel extends Model
{
    use HasFactory;

    protected $table = 'master_unit';

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function tipe()
    {
        return $this->belongsTo(MasterUnitTipeModel::class, 'master_unit_tipe_id');
    }

    public function jenjang()
    {
        return $this->hasMany(MasterUnitJenjangModel::class, 'master_unit_id');
    }

    public function fakultas()
    {
        return $this->hasOne(MasterUnitModel::class, 'id', 'master_unit_parent_id');
    }

    public static function getFakultas()
    {
        return self::query()->select('id', 'unit as value')
            ->where('master_unit_tipe_id', '=', 1) // fakultas
            ->orderBy('unit', 'ASC')
            ->get();
    }
}
