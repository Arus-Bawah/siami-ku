<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Apps;
use App\Http\Controllers\Controller;
use App\Models\AnggotaAuditor;
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

class PenjadwalanController extends Controller
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
        $data['list'] = AuditRepository::listDataActive();
        return view(adminView('penjadwalan.index'),$data);
    }
    public function getAdd()
    {
        $data['page_title'] = "Tambah Penjadwalan";
        $data['data'] = new Audit();
        $data['edit'] = null;
        $data['audit'] = AuditRepository::listOption();
        $data['auditor'] = CmsUsersRepository::getByPrivileges('Auditor');
        $data['auditee'] = CmsUsersRepository::getByPrivileges('Auditee');
        $data['anggota'] =[];
        return view(adminView('penjadwalan.form'),$data);
    }
    public function getEdit($id)
    {
        $data['page_title'] = "Edit Penjadwalan";
        $data['edit'] = 1;
        $data['data'] = Audit::findById($id);
        $data['fakultas'] = MasterFakultas::findAllDesc();
        $data['auditor'] = CmsUsersRepository::getByPrivileges('Auditor');
        $data['auditee'] = CmsUsersRepository::getByPrivileges('Auditee');
        $data['anggota'] = AnggotaAuditor::findAllBy('audit_id',$id);
        return view(adminView('penjadwalan.form'),$data);
    }
    public function postSaveData()
    {
        DB::transaction(function () {
            if (g('edit')) {
                $find = Audit::findById(g('id'));
                $find->unit = null;
                $find->code = null;
                $find->status_publish = null;
                $find->save();
            }
            $find = Audit::findById(g('audit_id'));
            $find->unit = g('unit');
            $find->code = g('code');
            $find->status_publish = null;
            $find->save();
        });

        return redirect(g('return_url'))->with(["message"=>"Success insert data","type"=>"success"]);
    }
    public function getDelete($id){
        $find['status_publish'] = null;
        $find['code'] = null;
        $find['unit'] = null;
        Audit::table()->where('id',$id)->update($find);
        return redirect(g('return_url'))->with(["message"=>"Success delete data","type"=>"danger"]);
    }
    public function getPublish($id){
        $find['status_publish'] = "Published";
        Audit::table()->where('id',$id)->update($find);
        return redirect(g('return_url'))->with(["message"=>"Success update data","type"=>"success"]);
    }
    public function getUnPublish($id){
        $find['status_publish'] = null;
        Audit::table()->where('id',$id)->update($find);
        return redirect(g('return_url'))->with(["message"=>"Success update data","type"=>"warning"]);
    }
}
