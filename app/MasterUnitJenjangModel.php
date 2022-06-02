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
}
