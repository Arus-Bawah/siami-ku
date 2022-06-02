<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterUnitModel extends Model
{
    use HasFactory;

    protected $table = 'master_unit';

    public function masterUnitJenjang()
    {
        return $this->hasMany(MasterUnitJenjangModel::class, 'master_unit_id');
    }

    public function masterUnitTipe()
    {
        return $this->belongsTo(MasterUnitTipeModel::class, 'master_unit_tipe_id');
    }
}
