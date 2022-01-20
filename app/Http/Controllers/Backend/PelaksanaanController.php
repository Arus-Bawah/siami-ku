<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Apps;
use App\Http\Controllers\Controller;
use App\Models\AnggotaAuditor;
use App\Models\Audit;
use App\Models\AuditKelengkapanAnswer;
use App\Models\MasterFakultas;
use App\Repositories\AuditKelengkapanAnswerRepository;
use App\Repositories\AuditKelengkapanRepository;
use App\Repositories\AuditRepository;
use App\Repositories\CmsUsersRepository;
use App\Repositories\MasterTemplateCategoryRepository;
use crocodicstudio\cbmodel\Core\ModelSetter;
use Illuminate\Support\Facades\DB;

class PelaksanaanController extends Controller
{
    protected $button_setting;
    protected $col;
    protected $custom_button;

    public function __construct()
    {
        // button
        $button['button_add'] = false;
        $this->button_setting = $button;

    }

    public function getIndex()
    {
        $data['button'] = $this->button_setting;
        $data['list'] = AuditRepository::listData();
        return view(adminView('pelaksanaan.index'),$data);
    }
    public function getAdd()
    {
        $data['page_title'] = "Tambah Pelaksanaan";
        $data['data'] = new Audit();
        $data['fakultas'] = MasterFakultas::findAllDesc();
        $data['auditor'] = CmsUsersRepository::getByPrivileges('Auditor');
        $data['auditee'] = CmsUsersRepository::getByPrivileges('Auditee');
        $data['anggota'] =[];
        return view(adminView('pelaksanaan.form'),$data);
    }
    public function getEdit($id)
    {
        $data['page_title'] = "Edit Pelaksanaan";
        $data['data'] = Audit::findById($id);
        $data['fakultas'] = MasterFakultas::findAllDesc();
        $data['auditor'] = CmsUsersRepository::getByPrivileges('Auditor');
        $data['auditee'] = CmsUsersRepository::getByPrivileges('Auditee');
        $data['anggota'] = AnggotaAuditor::findAllBy('audit_id',$id);
        return view(adminView('pelaksanaan.form'),$data);
    }

    public function getAudit($id)
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
        return view(adminView('pelaksanaan.audit'),$data);
    }
    public function getDoAudit($id) {
        $data['page_title'] = "Pelaksanaan Detail - Pengecekan Kelengkapan Dokumen";
        if (g('type')) {
            $data['page_title'] = "Pelaksanaan Detail - Pengecekan Capaian Standar";
        }

        $data['data'] = AuditRepository::Detail($id);
        $idData = $id;
        $data['kriteria'] = json_decode($data['data']->criteria);
        $data['anggota'] = AnggotaAuditor::findAllBy('audit_id',$id);
        $id = $data['data']->template_code;
        $data['kelengkapan'] = MasterTemplateCategoryRepository::listData($id,'kriteria',1,$idData);
        if (g('type') == 'capaian'){
            $data['kelengkapan'] = MasterTemplateCategoryRepository::listData($id,'capaian',1,$idData);
        }
        $data['category_id'] = $data['kelengkapan'][0]->id;
        $data['template_id'] = $id;
        $idUser = session()->get('users_id');
        $idAudit = $idData;
        $userType = session()->get('users_privileges');
        $data['audit'] = AuditKelengkapanRepository::findMyAnswer($idUser,$idAudit,$userType);

        return view(adminView((g('type')?'pelaksanaan.do-audit-capaian':'pelaksanaan.do-audit')),$data);
    }
    public function getTemuan($id) {
        $data['page_title'] = "Pelaksanaan Detail - Pengecekan Temuan";

        $data['data'] = AuditRepository::Detail($id);
        return view(adminView('pelaksanaan.temuan'),$data);
    }
    public function getAuditData($id) {
        $templateId = g('template_id');
        $type = g('type');
        $categoryId = g('category_id');
        $query = MasterTemplateCategoryRepository::listData($templateId,$type,1,$id,$categoryId);
        $data['data'] = $query[0];
        $data['status'] = 1;

        return response()->json($data);
    }
    public function postSaveAnswer()
    {
        $check = AuditKelengkapanAnswerRepository::findAnswer(g('audit_id'),g('id'));
        if ($check) {
            $new = AuditKelengkapanAnswer::findById($check->id);
        }else{
            $new = new AuditKelengkapanAnswer();
        }
        $new->audit_kelengkapan = g('audit_id');
        $new->question_id = g('id');
        if (hasFile('file')) {
            $new->file = Apps::uploadFile("file");
        }
        $new->keterangan = g('keterangan');
        $new->action = (g('action') ? g('action') : "off");
        $new->save();

        if ($new) {
            $data['status'] = 1;
            return response()->json($data);
        }

    }
    public function postSaveData()
    {
        $anggota = g('anggota');
        DB::transaction(function () use ($anggota) {
            if (g('id')) {
                $save = Audit::findById(g('id'));
            }else{
                $save = new Audit();
            }
            $save->fakultas_id = g('fakultas');
            $save->name = g('name');
            $save->purpose = g('purpose');
            $save->audit_area = g('audit_area');
            $save->audit_by = g('audit_by');
            $save->audit_leader = g('audit_leader');
            $save->siklus_number = g('siklus_number');
            $save->siklus_year = g('siklus_year');
            $save->status = "On Progres";
            $save->audit_date = g('audit_date');
            $save->save();

            $asave = [];
            foreach ($anggota as $row) {
                if ($row) {
                    $asave[] = array(
                        'audit_id' =>$save->id,
                        'name' => $row,
                        'created_at' => date('Y-m-d H:i:s')
                    );
                }
            }
            if ($asave) {
                if (g('id')) {
                    AnggotaAuditor::table()->where('audit_id',$save->id)->delete();
                }
                AnggotaAuditor::table()->insert($asave);
            }

        });

        return redirect(g('return_url'))->with(["message"=>"Success insert data","type"=>"success"]);
    }
    public function getDelete($id){
        $find = Audit::findById($id);
        $find->deleted_at = date('Y-m-d H:i:s');
        $find->save();

        return redirect(g('return_url'))->with(["message"=>"Success delete data","type"=>"danger"]);
    }
}
