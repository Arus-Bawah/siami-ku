<?php


namespace App\Helpers;

use App\Models\CmsMenus;
use App\Models\CmsPrivilegesRoles;

class Apps
{
    public static function findMySubMenu($listSub, $id_parent)
    {
        $listmenu = [];
        foreach ($listSub as $row) {
            if ($row->parent_id == $id_parent) {
                $listmenu[] = $row;
            }
        }
        return $listmenu;
    }

    public static function modulePrivilege($id) {
        if ($id != 1) {
            $listPriv = CmsPrivilegesRoles::table()
                ->join('cms_menus', 'cms_menus.id', 'cms_privileges_roles.id_cms_menus')
                ->where('cms_privileges_roles.id_cms_privileges', $id)
                ->where('cms_menus.parent_id', 0)
                ->where('cms_privileges_roles.can_view', 1)
                ->select('cms_menus.*', 'cms_privileges_roles.can_view', 'cms_privileges_roles.can_edit', 'cms_privileges_roles.can_add', 'cms_privileges_roles.can_delete')
                ->orderBy('cms_menus.sorting')
                ->get();

            $listallsub = CmsPrivilegesRoles::table()
                ->join('cms_menus', 'cms_menus.id', 'cms_privileges_roles.id_cms_menus')
                ->where('cms_privileges_roles.id_cms_privileges', $id)
                ->where('cms_menus.parent_id', '!=', 0)
                ->where('cms_privileges_roles.can_view', 1)
                ->select('cms_menus.*', 'cms_privileges_roles.can_view', 'cms_privileges_roles.can_edit', 'cms_privileges_roles.can_add', 'cms_privileges_roles.can_delete')
                ->orderBy('cms_menus.sorting')
                ->get();
            foreach ($listPriv as $priv) {
                $priv->sub_menu = Apps::findMySubMenu($listallsub, $priv->id);
            }
        } else {
            $listPriv = CmsMenus::table()->orderby('sorting')->where('parent_id', 0)->get();
            $listallsub = CmsMenus::table()->orderby('sorting')->where('parent_id', '!=', 0)->get();
            foreach ($listallsub as $s) {
                $s->can_view = 1;
                $s->can_edit = 1;
                $s->can_add = 1;
                $s->can_delete = 1;
            }
            foreach ($listPriv as $priv) {
                $priv->sub_menu = Apps::findMySubMenu($listallsub, $priv->id);
                $priv->can_view = 1;
                $priv->can_edit = 1;
                $priv->can_add = 1;
                $priv->can_delete = 1;
            }
        }
        return $listPriv;
    }
    public static function allModulPriviles($id) {
        if ($id != 1) {
            $listPriv = CmsPrivilegesRoles::table()
                ->join('cms_menus', 'cms_menus.id', 'cms_privileges_roles.id_cms_menus')
                ->where('cms_privileges_roles.id_cms_privileges', $id)
//                ->where('cms_menus.parent_id', 0)
                ->where('cms_privileges_roles.can_view', 1)
                ->select('cms_menus.*', 'cms_privileges_roles.can_view', 'cms_privileges_roles.can_edit', 'cms_privileges_roles.can_add', 'cms_privileges_roles.can_delete')
                ->orderBy('cms_menus.sorting')
                ->get();


        } else {
            $listPriv = CmsMenus::table()->orderby('sorting')->get();
            foreach ($listPriv as $s) {
                $s->can_view = 1;
                $s->can_edit = 1;
                $s->can_add = 1;
                $s->can_delete = 1;
            }

        }
        return $listPriv;
    }
    public static function uploadFile($name,$fileName = false)
    {
        if (empty($path)) {
            $date = date('Y-m');
            $path = 'uploads/'.$date;
        }else{
            $date = date('Y-m');
            $path = 'uploads/'.$path;
        }

        if (hasFile($name)){
            $file = getFile($name);
            $filename = $file->getClientOriginalName();
            $ext = strtolower($file->getClientOriginalExtension());

            if($filename && $ext) {
//                Storage::makeDirectory($path);

                $destinationPath = public_path($path);
                $extension        = $ext;
                $names            = rand(11111,99999).'.'.$extension;
                if ($fileName){
                    $names = $filename;
                }
                app('request')->file($name)->move($destinationPath, $names);
            }

            return $path.'/'.$names;
        }

    }
}
