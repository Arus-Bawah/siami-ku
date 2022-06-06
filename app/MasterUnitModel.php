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

    public static function getFakultas()
    {
        return self::query()
            ->select('id', 'unit as value')
            ->where('master_unit_tipe_id', '=', 1) // fakultas
            ->orderBy('unit', 'ASC')
            ->get();
    }

    public static function getIndex(int $limit = 20, string $search = '', array $filter = [])
    {
        return self::query()
            ->select('master_unit.id', 'master_unit_tipe.tipe', 'mu.unit as fakultas', 'master_unit.unit')
            ->join('master_unit_tipe', 'master_unit_tipe.id', '=', 'master_unit.master_unit_tipe_id')
            ->leftjoin('master_unit as mu', 'mu.id', '=', 'master_unit.master_unit_parent_id')
            ->where(function ($q) use ($filter) {
                if (isset($filter['type']) && $filter['type'] != '') {
                    $q->where('master_unit_tipe.id', '=', $filter['type']);
                }
                if (isset($filter['fakultas']) && $filter['fakultas'] != '') {
                    $q->where('mu.id', '=', $filter['fakultas']);
                }
                if (isset($filter['unit']) && $filter['unit'] != '') {
                    $q->where('master_unit.unit', 'LIKE', '%' . $filter['unit'] . '%');
                }
            })
            ->where(function ($q) use ($search) {
                $q->orWhere('master_unit_tipe.tipe', 'LIKE', '%' . $search . '%');
                $q->orWhere('mu.unit', 'LIKE', '%' . $search . '%');
                $q->orWhere('master_unit.unit', 'LIKE', '%' . $search . '%');
            })
            ->orderBy('id', 'DESC')
            ->paginate($limit);
    }
}
