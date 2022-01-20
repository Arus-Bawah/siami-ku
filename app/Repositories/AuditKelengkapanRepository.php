<?php
namespace App\Repositories;

use App\Models\AuditKelengkapan;

class AuditKelengkapanRepository extends AuditKelengkapan
{
    // TODO : Make you own query methods
    public static function findMyAnswer($user,$id,$type) {
        $data = AuditKelengkapan::table()
            ->where('audit_id',$id)
            ->where('answer_by',$type)
            ->where('users_id',$user)
            ->first();
        if(!$data) {
            $data = New AuditKelengkapan();
            $data->audit_id = $id;
            $data->users_id = $user;
            $data->answer_by = $type;
            $data->save();
        }
        return $data;
    }

}
