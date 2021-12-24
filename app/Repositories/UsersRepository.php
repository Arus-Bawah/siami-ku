<?php
namespace App\Repositories;

use App\Models\Users;
use Illuminate\Support\Facades\Request;

class UsersRepository extends Users
{
    // TODO : Make you own query methods
    public static function listData()
    {
        $g = Request::all();
        $sortby = (isset($g['sortby'])) ? $g['sortby'] : 'id';
        $sorting = (isset($g['sorting'])) ? $g['sorting'] : 'desc';
        $search = (isset($g['search'])) ? $g['search'] : '';
        $limit = (isset($g['limit'])) ? $g['limit'] : 10;

        return Users::table()
            ->orderBy($sortby, $sorting)
            ->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            })
            ->paginate($limit);
    }

}
