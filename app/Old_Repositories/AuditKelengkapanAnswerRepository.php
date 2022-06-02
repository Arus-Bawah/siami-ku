<?php
namespace App\Repositories;

use App\Models\AuditKelengkapanAnswer;

class AuditKelengkapanAnswerRepository extends AuditKelengkapanAnswer
{
    // TODO : Make you own query methods
    public static function findAnswer($id,$qId) {
        return AuditKelengkapanAnswer::table()
            ->where('audit_kelengkapan',$id)
            ->where('question_id',$qId)
            ->first();
    }

}
