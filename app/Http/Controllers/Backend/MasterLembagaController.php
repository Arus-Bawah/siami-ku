<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Audit;
use App\Models\MasterLembaga;
use App\Repositories\MasterLembagaRepository;
use crocodicstudio\cbmodel\Core\ModelSetter;
use Illuminate\Support\Facades\DB;

class MasterLembagaController extends Controller
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
        $data['list'] = MasterLembagaRepository::listData();

        return view(adminView('master.lembaga.index'),$data);
    }
    public function getAdd()
    {
        $data['page_title'] = "Tambah Lembaga";
        $data['data'] = new MasterLembaga();
        return view(adminView('master.lembaga.form'),$data);
    }
    public function getEdit($id)
    {
        $data['page_title'] = "Edit Lembaga";
        $data['data'] = MasterLembaga::findById($id);
        return view(adminView('master.lembaga.form'),$data);
    }
    public function postSaveData()
    {
        if (g('id')) {
            $new = MasterLembaga::findById(g('id'));
        }else{
            $new = new MasterLembaga();
        }
        $new->name = g('name');
        $new->save();
        return redirect(g('return_url'))->with(["message"=>"Success insert data","type"=>"success"]);
    }
    public function getDelete($id){
        $find = MasterLembaga::findById($id);
        $find->delete();

        return redirect(g('return_url'))->with(["message"=>"Success delete data","type"=>"danger"]);
    }
}
