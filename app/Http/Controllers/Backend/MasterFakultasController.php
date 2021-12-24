<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Audit;
use App\Models\MasterFakultas;
use App\Repositories\MasterFakultasRepository;
use crocodicstudio\cbmodel\Core\ModelSetter;
use Illuminate\Support\Facades\DB;

class MasterFakultasController extends Controller
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
        $data['list'] = MasterFakultasRepository::listData();

        return view(adminView('master.fakultas.index'),$data);
    }
    public function getAdd()
    {
        $data['page_title'] = "Tambah Fakultas";
        $data['data'] = new MasterFakultas();
        return view(adminView('master.fakultas.form'),$data);
    }
    public function getEdit($id)
    {
        $data['page_title'] = "Edit Fakultas";
        $data['data'] = MasterFakultas::findById($id);
        return view(adminView('master.fakultas.form'),$data);
    }
    public function postSaveData()
    {
        if (g('id')) {
            $new = MasterFakultas::findById(g('id'));
        }else{
            $new = new MasterFakultas();
        }
        $new->name = g('name');
        $new->save();
        return redirect(g('return_url'))->with(["message"=>"Success insert data","type"=>"success"]);
    }
    public function getDelete($id){
        $find = MasterFakultas::findById($id);
        $find->delete();

        return redirect(g('return_url'))->with(["message"=>"Success delete data","type"=>"danger"]);
    }
}
