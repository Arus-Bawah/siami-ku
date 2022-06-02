<?php

namespace App\Http\Controllers\Module;

use App\Helpers\Apps;
use App\Http\Controllers\Controller;
use App\Models\Audit;
use App\Models\CmsMenus;
use App\Models\CmsPrivileges;
use App\Models\CmsPrivilegesRoles;
use App\Models\MasterFakultas;
use App\Repositories\AuditRepository;
use App\Repositories\CmsPrivilegesRepository;
use App\Repositories\CmsUsersRepository;
use App\Repositories\UsersRepository;
use crocodicstudio\cbmodel\Core\ModelSetter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PrivilegesController extends Controller
{
    protected $button_setting;
    protected $col;
    protected $custom_button;

    public function __construct()
    {
        // button
        $button['button_add'] = true;
        $this->button_setting = $button;
    }

    public function getIndex()
    {
        $data['button'] = $this->button_setting;
        $data['list'] = CmsPrivilegesRepository::listData();
        return view(adminView('privileges.index'),$data);
    }
    public function getAdd()
    {
        return $this->viewForm();

    }
    public function getEdit($id)
    {
        return $this->viewForm($id);
    }
    private static function findAccess($listpriv,$menu,$key){
        foreach ($listpriv as $priv){
            if ($priv->id_cms_menus==$menu){
                return $priv->{$key};
            }
        }
        return 0;
    }
    public function viewForm($id = false) {
        $listmenurole =  CmsMenus::table()->orderBy('sorting')->get();;
        $listallpriv = CmsPrivilegesRoles::table()->where('id_cms_privileges',$id)->get();
        foreach ($listmenurole as $row){
            if ($id=='') {
                $row->can_view = 0;
                $row->can_add = 0;
                $row->can_edit = 0;
                $row->can_delete = 0;
            }else{
                $row->can_view = self::findAccess($listallpriv,$row->id,'can_view');
                $row->can_add = self::findAccess($listallpriv,$row->id,'can_add');
                $row->can_edit = self::findAccess($listallpriv,$row->id,'can_edit');
                $row->can_delete = self::findAccess($listallpriv,$row->id,'can_delete');
            }
        }
        $edit = null;
        if ($id!=''){
            $edit = CmsPrivileges::findById($id);
            if ($edit->id == null){
                return redirect(g('return_url'))->with(["message"=>"Success insert data","type"=>"success"]);
            }
        }

        $data['edit'] = $edit;
        $data['list_menu'] = $listmenurole;
        $data['page_title'] = "LPM";
        $data['data'] = CmsPrivileges::findById($id);
        return view(adminView('privileges.form'),$data);
    }
    public function postSaveData()
    {
        DB::transaction(function () {
            $id = g('id');
            $name = g('name');
            $is_superadmin = g('is_superadmin');
            $privileges = g('privileges');

            $s = CmsPrivileges::findById($id);
            $s->name = $name;
            $s->is_superadmin =$is_superadmin;
            $s->save();
            CmsPrivilegesRoles::table()->where('id_cms_privileges',$s->id)->delete();
            foreach ($privileges as $idmenu => $p){
                $view = (isset($p['view']))?1:0;
                $add = (isset($p['add']))?1:0;
                $edit = (isset($p['edit']))?1:0;
                $delete = (isset($p['delete']))?1:0;

                $cp = new CmsPrivilegesRoles();
                $cp->id_cms_privileges = $s->id;
                $cp->id_cms_menus = $idmenu;
                $cp->can_view = $view;
                $cp->can_add = $add;
                $cp->can_edit = $edit;
                $cp->can_delete = $delete;
                $cp->save();
            }
        });
        return redirect(g('return_url'))->with(["message"=>"Success insert data","type"=>"success"]);
    }
    public function getDelete($id){
        $find = CmsPrivileges::findById($id);
        $find->delete();

        return redirect(g('return_url'))->with(["message"=>"Success delete data","type"=>"danger"]);
    }
}
