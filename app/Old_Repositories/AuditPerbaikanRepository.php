<?php
namespace App\Repositories;

use App\Models\AuditPerbaikan;

class AuditPerbaikanRepository extends AuditPerbaikan
{
    // TODO : Make you own query methods
    public static function findAllByIdAndUser($id,$userId)
    {
        return AuditPerbaikan::table()
            ->where('audit_id',$id)
            ->where('cms_users_id',$userId)
            ->get();
    }

}
