<?php
namespace App\Repositories;

use App\Models\CmsUsers;
use Illuminate\Support\Facades\Request;

class CmsUsersRepository extends CmsUsers
{
    // TODO : Make you own query methods
    public static function listData($type = false)
    {
        $g = Request::all();
        $sortby = (isset($g['sortby'])) ? $g['sortby'] : 'cms_users.id';
        $sorting = (isset($g['sorting'])) ? $g['sorting'] : 'desc';
        $search = (isset($g['search'])) ? $g['search'] : '';
        $limit = (isset($g['limit'])) ? $g['limit'] : 10;
        return CmsUsers::table()
            ->join("cms_privileges",'cms_privileges.id','cms_users.id_cms_privileges')
            ->orderBy($sortby, $sorting)
            ->select('cms_users.*','cms_privileges.name as position')
            ->where(function ($q) use ($search,$type) {
                if ($search) {
                    $q->where('cms_users.name', 'like', '%' . $search . '%')
                        ->orwhere('cms_privileges.name', 'like', '%' . $search . '%');
                }
                if ($type) {
                    $q->where('cms_privileges.name',$type);
                }
            })
            ->paginate($limit);
    }
    public static function getByPrivileges($field) {
        return CmsUsers::table()
            ->select('cms_users.*')
            ->join("cms_privileges",'cms_privileges.id','cms_users.id_cms_privileges')
            ->where('cms_privileges.name',$field)
            ->get();
    }

}
