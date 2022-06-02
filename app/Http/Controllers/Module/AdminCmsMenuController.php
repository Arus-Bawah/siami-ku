<?php


namespace App\Http\Controllers\Module;


use App\Http\Controllers\Controller;
use App\Models\CmsMenus;
use App\Repositories\CmsMenusRepository;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class AdminCmsMenuController extends Controller
{
    public function getIndex(){
        $data['edit'] = null;
        $data['page_title'] = 'Menu Management';
        $data['menu'] = CmsMenusRepository::getListDataMenuSorting();
        return view(adminView('superadmin.cms_menus.index'),$data);
    }

    public function postSaveMenu(){
        $listMenu = g('menus');
        $listMenu = json_decode($listMenu);
        $sm = 1;
        foreach ($listMenu[0] as $menu){
            CmsMenus::table()->where('id',$menu->id)->update(['sorting'=>$sm]);
            $ss = 1;
            foreach ($menu->children[0] as $child){
                CmsMenus::table()->where('id',$child->id)->update(['sorting'=>$ss,'parent_id'=>$menu->id]);
                $ss++;
            }
            $sm++;
        }
        return response()->json(['message'=>'Menu successfully updated']);
    }

    public function postAdd(){

        $validator = Validator::make(request()->all(), [
            'name' => 'required|min:1,max:150',
            'path' => 'required',
            'icon' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $id = g('id');
        $sorting = CmsMenus::table()->count()+1;
        $name = g('name');
        $path = g('path');
        $icon = g('icon');

        if ($id){
            $menu = CmsMenus::findById($id);
            if ($menu->id==null){
                return redirect()->back()->with(['error_message'=>"Menu with the id don't exists"]);
            }
        }else{
            $menu = CmsMenusRepository::findByPath($path);
            if ($menu->id!=null) {
                return redirect()->back()->with(['error_message'=>'Menu with the path already exists']);
            }
        }

        $sorting = ($sorting)?$sorting:1;
        $menu->icon = $icon;
        $menu->name = $name;
        $menu->path = $path;
        if (!$id) {
            $menu->parent_id = 0;
        }
        $menu->sorting = $sorting;
        $menu->save();
        return redirect(adminUrl('menu-manajemen'))->with(['success_message'=>'Menu added successfully']);
    }
}
