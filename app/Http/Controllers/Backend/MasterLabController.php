<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Audit;
use App\Models\MasterBiro;
use App\Models\MasterLab;
use App\Models\MasterLembaga;
use App\Models\MasterUpt;
use App\Repositories\MasterBiroRepository;
use App\Repositories\MasterLabRepository;
use App\Repositories\MasterLembagaRepository;
use App\Repositories\MasterUptRepository;
use crocodicstudio\cbmodel\Core\ModelSetter;
use Illuminate\Support\Facades\DB;

class MasterLabController extends Controller
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
        $data['list'] = MasterLabRepository::listData();

        return view(adminView('master.lab.index'),$data);
    }
    public function getAdd()
    {
        $data['page_title'] = "Tambah Lab";
        $data['data'] = new MasterLab();
        return view(adminView('master.lab.form'),$data);
    }
    public function getEdit($id)
    {
        $data['page_title'] = "Edit Lab";
        $data['data'] = MasterLab::findById($id);
        return view(adminView('master.lab.form'),$data);
    }
    public function postSaveData()
    {
        if (g('id')) {
            $new = MasterLab::findById(g('id'));
        }else{
            $new = new MasterLab();
        }
        $new->name = g('name');
        $new->save();
        return redirect(g('return_url'))->with(["message"=>"Success insert data","type"=>"success"]);
    }
    public function getDelete($id){
        $find = MasterLab::findById($id);
        $find->delete();

        return redirect(g('return_url'))->with(["message"=>"Success delete data","type"=>"danger"]);
    }
}
