<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterUnitTipeModel extends Model
{
    use HasFactory;

    protected $table = 'master_unit_tipe';

    public function masterUnit()
    {
        return $this->hasMany(MasterUnitModel::class, 'master_unit_tipe_id');
    }
}
