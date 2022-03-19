<?php
namespace App\Repositories;

use App\Models\AuditKelengkapanAnswer;
use App\Models\MasterTemplateCategory;
use App\Models\MasterTemplateQuestion;
use Illuminate\Support\Facades\DB;

class MasterTemplateCategoryRepository extends MasterTemplateCategory
{
    // TODO : Make you own query methods
    public static function Answer($question,$idData) {
        $id = [];
        foreach($question as $key) {
            $id[] = $key->id;
        }
        $idUser = session()->get('users_id');
        $userType = session()->get('users_privileges');
        $site = asset('');
        $answer = AuditKelengkapanAnswer::table()
            ->join('audit_kelengkapan','audit_kelengkapan.id','=','audit_kelengkapan_answer.audit_kelengkapan')
            ->select('audit_kelengkapan_answer.*',DB::raw("concat('$site',audit_kelengkapan_answer.file) as file"))
            ->where('answer_by',$userType)
            ->where('audit_id',$idData)
            ->where('users_id',$idUser)
            ->get();

        $result = collect($answer);
        $result = $result->groupBy('question_id');
        return $result->toArray();
    }
    public static function listQuestion($qId,$withAnswer = false,$idData = false) {
        $id = [];
        foreach ($qId as $key) {
            $id[] = $key->id;
        }
        $question = MasterTemplateQuestion::table()
            ->wherein('master_template_category',$id)
            ->get();

        if ($withAnswer) {
            $answer = self::Answer($question,$idData);
            foreach ($question as $key => $value) {
                if (array_key_exists($value->id, $answer)) {
                    $value->answer_keterangan = $answer[$value->id][0]->keterangan;
                    $value->answer_file = $answer[$value->id][0]->file;
                    $value->answer_action = $answer[$value->id][0]->action;
                }else{
                    $value->answer_keterangan = null;
                    $value->answer_file = null;
                    $value->answer_action = null;
                }
            }
        }

        $result = collect($question);
        $result = $result->groupBy('master_template_category');
        return $result->toArray();
    }

    public static function listData($id,$type,$withAnswer = false,$idData = false,$categoryId = false) {
        $query = MasterTemplateCategory::table()
            ->where('master_template',$id)
            ->where('category',$type)
            ->where(function ($q) use ($categoryId) {
                if ($categoryId) {
                    $q->where('id',$categoryId);
                }
            })
            ->get();
        $question = self::listQuestion($query,$withAnswer,$idData);
        foreach ($query as $key => $value) {
            if (array_key_exists($value->id, $question)) {
                $value->question = $question[$value->id];
            }else{
                $value->question = [];
            }
        }

        return $query;
    }

}
