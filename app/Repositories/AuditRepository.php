<?php
namespace App\Repositories;

use App\Models\Audit;
use Illuminate\Support\Facades\Request;

class AuditRepository extends Audit
{
    // TODO : Make you own query methods
    public static function listData()
    {
        $g = Request::all();
        $sortby = (isset($g['sortby'])) ? $g['sortby'] : 'audit.id';
        $sorting = (isset($g['sorting'])) ? $g['sorting'] : 'desc';
        $search = (isset($g['search'])) ? $g['search'] : '';
        $limit = (isset($g['limit'])) ? $g['limit'] : 10;

        return Audit::table()
            ->join('cms_users as ad_1','ad_1.id','=','audit.audit_by')
            ->join('cms_users as ad_2','ad_2.id','=','audit.audit_leader')
            ->select('audit.*','ad_1.name as audit_by','ad_2.name as audit_leader')
            ->whereNull('audit.deleted_at')
            ->orderBy($sortby, $sorting)
            ->where(function ($q) use ($search) {
                $q->where('audit.name', 'like', '%' . $search . '%');
            })
            ->paginate($limit);
    }
    public static function listOption() {
        return Audit::table()
            ->whereNull('audit.deleted_at')
            ->whereNull('unit')
            ->get();
    }
    public static function listDataActive()
    {
        $g = Request::all();
        $sortby = (isset($g['sortby'])) ? $g['sortby'] : 'audit.id';
        $sorting = (isset($g['sorting'])) ? $g['sorting'] : 'desc';
        $search = (isset($g['search'])) ? $g['search'] : '';
        $limit = (isset($g['limit'])) ? $g['limit'] : 10;

        return Audit::table()
            ->join('cms_users as ad_1','ad_1.id','=','audit.audit_by')
            ->join('cms_users as ad_2','ad_2.id','=','audit.audit_leader')
            ->select('audit.*','ad_1.name as audit_by','ad_2.name as audit_leader')
            ->whereNull('audit.deleted_at')
            ->whereNotNull('audit.unit')
            ->orderBy($sortby, $sorting)
            ->where(function ($q) use ($search) {
                $q->where('audit.name', 'like', '%' . $search . '%');
            })
            ->paginate($limit);
    }

}
