<?php
namespace App\Repositories;

use App\Models\MasterProgdi;
use Illuminate\Support\Facades\Request;

class MasterProgdiRepository extends MasterProgdi
{
    // TODO : Make you own query methods
    public static function listData()
    {
        $g = Request::all();
        $sortby = (isset($g['sortby'])) ? $g['sortby'] : 'id';
        $sorting = (isset($g['sorting'])) ? $g['sorting'] : 'desc';
        $search = (isset($g['search'])) ? $g['search'] : '';
        $limit = (isset($g['limit'])) ? $g['limit'] : 10;

        return MasterProgdi::table()
            ->select('master_progdi.*','master_fakultas.name as fakultas_name')
            ->join('master_fakultas','master_fakultas.id','=','master_progdi.fakultas_id')
            ->orderBy($sortby, $sorting)
            ->where(function ($q) use ($search) {
                $q->where('master_progdi.name', 'like', '%' . $search . '%');
            })
            ->paginate($limit);
    }

}
