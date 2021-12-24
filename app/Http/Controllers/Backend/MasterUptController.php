<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Audit;
use App\Models\MasterBiro;
use App\Models\MasterLembaga;
use App\Models\MasterUpt;
use App\Repositories\MasterBiroRepository;
use App\Repositories\MasterLembagaRepository;
use App\Repositories\MasterUptRepository;
use crocodicstudio\cbmodel\Core\ModelSetter;
use Illuminate\Support\Facades\DB;

class MasterUptController extends Controller
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
        $data['list'] = MasterUptRepository::listData();

        return view(adminView('master.upt.index'),$data);
    }
    public function getAdd()
    {
        $data['page_title'] = "Tambah UPT";
        $data['data'] = new MasterUpt();
        return view(adminView('master.upt.form'),$data);
    }
    public function getEdit($id)
    {
        $data['page_title'] = "Edit UPT";
        $data['data'] = MasterUpt::findById($id);
        return view(adminView('master.upt.form'),$data);
    }
    public function postSaveData()
    {
        if (g('id')) {
            $new = MasterUpt::findById(g('id'));
        }else{
            $new = new MasterUpt();
        }
        $new->name = g('name');
        $new->save();
        return redirect(g('return_url'))->with(["message"=>"Success insert data","type"=>"success"]);
    }
    public function getDelete($id){
        $find = MasterUpt::findById($id);
        $find->delete();

        return redirect(g('return_url'))->with(["message"=>"Success delete data","type"=>"danger"]);
    }
}
