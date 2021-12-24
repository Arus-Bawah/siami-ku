<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Audit;
use App\Models\MasterBiro;
use App\Models\MasterLembaga;
use App\Repositories\MasterBiroRepository;
use App\Repositories\MasterLembagaRepository;
use crocodicstudio\cbmodel\Core\ModelSetter;
use Illuminate\Support\Facades\DB;

class MasterBiroController extends Controller
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
        $data['list'] = MasterBiroRepository::listData();

        return view(adminView('master.biro.index'),$data);
    }
    public function getAdd()
    {
        $data['page_title'] = "Tambah Biro";
        $data['data'] = new MasterBiro();
        return view(adminView('master.biro.form'),$data);
    }
    public function getEdit($id)
    {
        $data['page_title'] = "Edit Biro";
        $data['data'] = MasterBiro::findById($id);
        return view(adminView('master.biro.form'),$data);
    }
    public function postSaveData()
    {
        if (g('id')) {
            $new = MasterBiro::findById(g('id'));
        }else{
            $new = new MasterBiro();
        }
        $new->name = g('name');
        $new->save();
        return redirect(g('return_url'))->with(["message"=>"Success insert data","type"=>"success"]);
    }
    public function getDelete($id){
        $find = MasterBiro::findById($id);
        $find->delete();

        return redirect(g('return_url'))->with(["message"=>"Success delete data","type"=>"danger"]);
    }
}
