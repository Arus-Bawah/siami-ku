<?php
namespace App\Repositories;

use App\Models\MasterTemplateCategory;
use App\Models\MasterTemplateQuestion;

class MasterTemplateCategoryRepository extends MasterTemplateCategory
{
    // TODO : Make you own query methods
    public static function listQuestion($qId) {
        $id = [];
        foreach ($qId as $key) {
            $id[] = $key->id;
        }
        $question = MasterTemplateQuestion::table()
            ->wherein('master_template_category',$id)
            ->get();

        $result = collect($question);
        $result = $result->groupBy('master_template_category');
        return $result->toArray();
    }

    public static function listData($id,$type) {
        $query = MasterTemplateCategory::table()
            ->where('master_template',$id)
            ->where('category',$type)
            ->get();
        $question = self::listQuestion($query);
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
