<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterUnitTipeModel extends Model
{
    use HasFactory;

    protected $table = 'master_unit_tipe';

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function unit()
    {
        return $this->hasMany(MasterUnitModel::class, 'master_unit_tipe_id');
    }

    public static function getTipe()
    {
        return self::query()
            ->select('id', 'tipe as value')
            ->orderBy('tipe', 'ASC')
            ->get();
    }
}
