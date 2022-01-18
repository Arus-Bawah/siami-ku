<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Audit;
use App\Models\MasterBiro;
use App\Models\MasterLembaga;
use App\Models\MasterTemplate;
use App\Models\MasterTemplateCategory;
use App\Models\MasterTemplateQuestion;
use App\Models\MasterUpt;
use App\Repositories\MasterBiroRepository;
use App\Repositories\MasterLembagaRepository;
use App\Repositories\MasterTemplateCategoryRepository;
use App\Repositories\MasterTemplateRepository;
use App\Repositories\MasterUptRepository;
use crocodicstudio\cbmodel\Core\ModelSetter;
use Illuminate\Support\Facades\DB;

class MasterTemplateController extends Controller
{
    protected $button_setting;
    protected $col;

    public function __construct()
    {
        // button
        $button['button_add'] = true;
        $this->button_setting = $button;
    }

    public function getIndex()
    {
        $data['button'] = $this->button_setting;
        $data['list'] = MasterTemplateRepository::listData();

        return view(adminView('master.template.index'),$data);
    }
    public function getAdd()
    {
        $data['page_title'] = "Tambah Audit Template";
        $data['data'] = new MasterTemplate();
        $data['kriteria'] = [];
        return view(adminView('master.template.form'),$data);
    }
    public function getStep2($id) {
        $data['page_title'] = "Tambah Kelengkapan Template";
        $data['data'] = MasterTemplate::findById($id);
        return view(adminView('master.template.form-2'),$data);
    }
    public function getStep3($id) {
        $data['page_title'] = "Tambah Capaian standar";
        $data['data'] = MasterTemplate::findById($id);
        return view(adminView('master.template.form-3'),$data);
    }
    public function getEdit($id)
    {
        $data['page_title'] = "Edit Audit Template";
        $data['data'] = MasterTemplate::findById($id);
        $data['kriteria'] = json_decode($data['data']->criteria);
        return view(adminView('master.template.form'),$data);
    }
    public function postSaveData()
    {
        if (g('id')) {
            $new = MasterTemplate::findById(g('id'));
        }else{
            $new = new MasterTemplate();
        }
        $kriteria = g('kriteria');
        $kriteria = array_filter($kriteria);
        $new->name = g('name');
        $new->unit = g('unit');
        $new->purpose = g('purpose');
        $new->audit_area = g('audit_area');
        $new->criteria = json_encode($kriteria);
        $new->save();
        return redirect('admin/template/add/step-2/'.$new->id.'?return_url='.g('return_url'))->with(["message"=>"Success insert data","type"=>"success"]);
    }
    public function postSaveKriteria()
    {
        $new = new MasterTemplateCategory();
        $new->master_template = g('master_template');
        $new->main_category = g('kriteria');
        $new->category = (g('category') ? g('category'):'kriteria');
        $new->save();

        if ($new) {
            $data['status'] = 1;
            return response()->json($data);
        }
    }
    public function getUpdateKriteria()
    {
        $new = MasterTemplateCategory::findById(g('id'));
        $new->main_category = g('kriteria');
        $new->save();

        if ($new) {
            $data['status'] = 1;
            return response()->json($data);
        }
    }
    public function getListData() {
        $id = g('id');
        $data['status'] = 1;
        $data['list'] = MasterTemplateCategoryRepository::listData($id,(g('type') ? g('type'):'kriteria'));

        return response()->json($data);
    }
    public function getAddQuestion() {
        $new = new MasterTemplateQuestion();
        $new->master_template_category = g('id');
        $new->question = g('value');
        $new->keterangan = g('keterangan');
        $new->capaian = g('capaian');
        $new->save();

        if ($new) {
            $data['status'] = 1;
            return response()->json($data);
        }
    }
    public function getUpdateQuestion() {
        $new = MasterTemplateQuestion::findById(g('id'));
        $new->question = g('value');
        $new->keterangan = g('keterangan');
        $new->capaian = g('capaian');
        $new->save();

        if ($new) {
            $data['status'] = 1;
            return response()->json($data);
        }
    }
    public function postOrdering() {

    }
    public function getDetail($id) {
        $data['page_title'] = "Detail Audit Template";
        $data['data'] = MasterTemplate::findById($id);
        $data['kriteria'] = json_decode($data['data']->criteria);
        $data['kelengkapan'] = MasterTemplateCategoryRepository::listData($id,'kriteria');
        if (g('type') == 'capaian'){
            $data['kelengkapan'] = MasterTemplateCategoryRepository::listData($id,'capaian');
        }
        return view(adminView('master.template.detail'),$data);
    }
    public function getDelete($id){
        $find = MasterTemplate::findById($id);
        $find->delete();

        return redirect(g('return_url'))->with(["message"=>"Success delete data","type"=>"danger"]);
    }
}
