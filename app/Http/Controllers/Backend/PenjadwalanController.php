<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Apps;
use App\Http\Controllers\Controller;
use App\Models\AnggotaAuditor;
use App\Models\Audit;
use App\Models\CmsPrivileges;
use App\Models\CmsUsers;
use App\Models\MasterFakultas;
use App\Models\MasterTemplate;
use App\Repositories\AuditRepository;
use App\Repositories\CmsUsersRepository;
use App\Repositories\MasterTemplateCategoryRepository;
use App\Repositories\MasterTemplateRepository;
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
        $data['list'] = AuditRepository::listData();
        return view(adminView('penjadwalan.index'),$data);
    }
    public function getAdd()
    {
        $data['page_title'] = "Tambah Penjadwalan";
        $data['data'] = new Audit();
        $data['edit'] = null;
        $data['fakultas'] = MasterFakultas::findAllDesc();
        $data['template'] = MasterTemplateRepository::listOption();
        $data['auditor'] = CmsUsersRepository::getByPrivileges('Auditor');
        $data['auditee'] = CmsUsersRepository::getByPrivileges('Auditee');
        $data['anggota'] = [];
        $data['kriteria'] = [];
        return view(adminView('penjadwalan.form'),$data);
    }
    public function getEdit($id)
    {
        $data['page_title'] = "Edit Penjadwalan";
        $data['edit'] = 1;
        $data['data'] = Audit::findById($id);
        $data['template'] = MasterTemplateRepository::listOption();
        $data['fakultas'] = MasterFakultas::findAllDesc();
        $data['auditor'] = CmsUsersRepository::getByPrivileges('Auditor');
        $data['auditee'] = CmsUsersRepository::getByPrivileges('Auditee');
        $data['anggota'] = AnggotaAuditor::findAllBy('audit_id',$id);
        $data['kriteria'] = json_decode($data['data']->criteria);
        return view(adminView('penjadwalan.form'),$data);
    }
    public function getDetail($id)
    {
        $data['page_title'] = "Detail Penjadwalan";
        $data['data'] = AuditRepository::Detail($id);
        $data['kriteria'] = json_decode($data['data']->criteria);
        $data['anggota'] = AnggotaAuditor::findAllBy('audit_id',$id);
        $id = $data['data']->template_code;
        $data['kelengkapan'] = MasterTemplateCategoryRepository::listData($id,'kriteria');
        if (g('type') == 'capaian'){
            $data['kelengkapan'] = MasterTemplateCategoryRepository::listData($id,'capaian');
        }
        return view(adminView('penjadwalan.detail'),$data);
    }
    public function postSaveData()
    {
        $master = MasterTemplate::findById(g('template_code'));
        $anggota = g('anggota');
        $kriteria = g('kriteria');
        $kriteria = array_filter($kriteria);
        DB::transaction(function () use ($anggota,$kriteria,$master) {
            if (g('edit')) {
                $find = Audit::findById(g('id'));
            }
            $find = new Audit();
            $find->name = $master->name;
            $find->status = 'Waiting';
            $find->template_code = g('template_code');
            $find->fakultas_id = g('fakultas_id');
            $find->unit = g('unit');
            $find->siklus_number = g('siklus_number');
            $find->siklus_year = g('siklus_year');
            $find->purpose = g('purpose');
            $find->audit_area = g('audit_area');
            $find->audit_date = g('audit_date');
            $find->audit_by = g('audit_by');
            $find->audit_leader = g('audit_leader');
            $find->location = g('location');
            $find->criteria = json_encode($kriteria);
            $find->status_publish = "Unpublish";
            $find->save();

            $asave = [];
            foreach ($anggota as $row) {
                if ($row) {
                    $asave[] = array(
                        'audit_id' => $find->id,
                        'name' => $row,
                        'created_at' => date('Y-m-d H:i:s')
                    );
                }
            }
            if ($asave) {
                if (g('id')) {
                    AnggotaAuditor::table()->where('audit_id',$find->id)->delete();
                }
                AnggotaAuditor::table()->insert($asave);
            }
        });

        return redirect(g('return_url'))->with(["message"=>"Success insert data","type"=>"success"]);
    }
    public function getDelete($id){
        $find['delete_at'] = date('Y-m-d H:i:s');
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
