<?php
namespace App\Repositories;

use App\Models\AuditTemuan;
use Illuminate\Support\Facades\DB;

class AuditTemuanRepository extends AuditTemuan
{
    // TODO : Make you own query methods
    public static function findAllByIdAndUser($id,$userId)
    {
        $site = asset('');
        return AuditTemuan::table()
            ->where('audit_id',$id)
            ->where('cms_users_id',$userId)
            ->select('audit_temuan.*',DB::raw("concat('$site',audit_temuan.file) as file"))
            ->get();
    }

}
