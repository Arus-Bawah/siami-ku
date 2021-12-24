<?php
namespace App\Repositories;

use App\Helpers\Apps;
use App\Models\CmsMenus;

class CmsMenusRepository extends CmsMenus
{
    // TODO : Make you own query methods
    public static function findByPath($path){
        if ($path=='javascript:;' || $path=='-'){
            return new CmsMenus();
        }else {
            $data = CmsMenus::table()->where('path', $path)
                ->first();
            return new static($data);
        }
    }

    public static function getListDataMenuSorting(){
        $parrent = CmsMenus::table()->where('parent_id',0)
            ->orderBy('sorting')
            ->get();
        $sub = CmsMenus::table()->where('parent_id','!=',0)
            ->orderBy('sorting')
            ->get();
        foreach ($parrent as $row){
            $row->sub_menu = Apps::findMySubMenu($sub,$row->id);
        }

        return $parrent;
    }
}
