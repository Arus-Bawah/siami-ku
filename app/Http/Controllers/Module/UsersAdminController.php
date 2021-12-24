<?php

namespace App\Http\Controllers\Module;

use App\Helpers\Apps;
use App\Http\Controllers\Controller;
use App\Models\Audit;
use App\Models\CmsPrivileges;
use App\Models\CmsUsers;
use App\Models\MasterFakultas;
use App\Repositories\AuditRepository;
use App\Repositories\CmsUsersRepository;
use App\Repositories\UsersRepository;
use crocodicstudio\cbmodel\Core\ModelSetter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersAdminController extends Controller
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
        $data['list'] = CmsUsersRepository::listData("LPM");
        return view(adminView('user_manager.lpm.index'),$data);
    }
    public function getAdd()
    {
        $data['page_title'] = "Tambah LPM";
        $data['data'] = new CmsUsers();
        return view(adminView('user_manager.lpm.form'),$data);
    }
    public function getEdit($id)
    {
        $data['page_title'] = "Edit LPM";
        $data['data'] = CmsUsers::findById($id);
        return view(adminView('user_manager.lpm.form'),$data);
    }
    public function postSaveData()
    {
        $find = CmsPrivileges::findBy("name","LPM");

        DB::transaction(function () use ($find) {
            $id = g('id');
            if ($id) {
                $new = CmsUsers::findById($id);
            }else{
                $new = new CmsUsers();
            }
            $new->name = g('name');
            $new->username = g('username');
            $new->email = g('email');
            if ($id) {
                if (g('password')){

                }
                if (hasFile('photo')){
                    $new->foto = Apps::uploadFile("photo");
                }
                if (hasFile('signature')) {
                    $new->signature = Apps::uploadFile("signature");
                }
            }else{
                $new->password = Hash::make(g('password'));
                $new->foto = Apps::uploadFile("photo");
                $new->signature = Apps::uploadFile("signature");
            }
            $new->id_cms_privileges = $find->id;
            $new->status = "Active";
            $new->unit = null;
            $new->save();
        });

        return redirect(g('return_url'))->with(["message"=>"Success insert data","type"=>"success"]);
    }
    public function getDelete($id){
        $find = CmsUsers::findById($id);
        $find->delete();

        return redirect(g('return_url'))->with(["message"=>"Success delete data","type"=>"danger"]);
    }
}
