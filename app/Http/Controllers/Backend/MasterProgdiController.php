<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Audit;
use App\Models\MasterFakultas;
use App\Models\MasterProgdi;
use App\Repositories\MasterFakultasRepository;
use App\Repositories\MasterProgdiRepository;
use crocodicstudio\cbmodel\Core\ModelSetter;
use Illuminate\Support\Facades\DB;

class MasterProgdiController extends Controller
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
        $data['menu'] = $this->col;
        $data['button'] = $this->button_setting;
        $data['list'] = MasterProgdiRepository::listData();

        return view(adminView('master.progdi.index'),$data);
    }
    public function getAdd()
    {
        $data['page_title'] = "Tambah Progdi";
        $data['data'] = new MasterProgdi();
        $data['fakultas'] = MasterFakultas::findAllDesc();
        return view(adminView('master.progdi.form'),$data);
    }
    public function getEdit($id)
    {
        $data['page_title'] = "Edit Progdi";
        $data['data'] = MasterProgdi::findById($id);
        $data['fakultas'] = MasterFakultas::findAllDesc();
        return view(adminView('master.progdi.form'),$data);
    }
    public function postSaveData()
    {
        if (g('id')) {
            $new = MasterProgdi::findById(g('id'));
        }else{
            $new = new MasterProgdi();
        }
        $new->fakultas_id = g('fakultas');
        $new->name = g('name');
        $new->jenjang = g('jenjang');
        $new->save();
        return redirect(g('return_url'))->with(["message"=>"Success insert data","type"=>"success"]);
    }
    public function getDelete($id){
        $find = MasterProgdi::findById($id);
        $find->delete();

        return redirect(g('return_url'))->with(["message"=>"Success delete data","type"=>"danger"]);
    }
}
