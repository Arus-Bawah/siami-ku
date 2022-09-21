<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplatesModel extends Model
{
    use HasFactory;

    protected $table = 'templates';

    protected $fillable = [
        'master_unit_tipe_id',
        'master_unit_id',
        'master_unit_jenjang_id',
        'name'
    ];

    public function tipe()
    {
        return $this->belongsTo(MasterUnitTipeModel::class, 'master_unit_tipe_id', 'id');
    }

    public function unit()
    {
        return $this->belongsTo(MasterUnitModel::class, 'master_unit_id', 'id');
    }

    public function jenjang()
    {
        return $this->belongsTo(MasterJenjangModel::class, 'master_unit_jenjang_id', 'id');
    }

    public function tujuan()
    {
        return $this->hasMany(TemplateTujuanModel::class, 'templates_id', 'id');
    }

    public static function findBy($field, $value)
    {
        return self::query()
            ->where($field, $value)
            ->first();
    }
}
