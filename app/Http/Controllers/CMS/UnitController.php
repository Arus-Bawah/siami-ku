<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\UnitRequest;
use App\MasterJenjangModel;
use App\MasterUnitJenjangModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

#model
use App\MasterUnitModel;
use App\MasterUnitTipeModel;

class UnitController extends Controller
{
    public function index()
    {
        # get query
        $query = request()->query();
        $page = request()->get('page') == '' ? 1 : (int) request()->get('page');
        $limit = request()->get('limit') == '' ? 20 : (int) request()->get('limit');
        $search = request()->get('search') == '' ? '' : request()->get('search');
        $filter = is_array(request()->get('filter')) ? request()->get('filter') : [];

        # get data
        $data = MasterUnitModel::with(['tipe', 'fakultas'])
            ->where(function ($q) use ($filter) {
                if (!empty($filter['tipe'])) {
                    $q->whereHas('tipe', function ($qry) use ($filter) {
                        $qry->where('id', '=', $filter['tipe']);
                    });
                }
                if (!empty($filter['fakultas'])) {
                    $q->whereHas('fakultas', function ($qry) use ($filter) {
                        $qry->where('id', '=', $filter['fakultas']);
                    });
                }
                if (!empty($filter['unit'])) {
                    $q->where('unit', 'LIKE', '%' . $filter['unit'] . '%');
                }
            })
            ->where(function ($q) use ($search) {
                if ($search) {
                    $q->where('unit', 'LIKE', '%' . $search . '%');
                    $q->orWhereHas('tipe', function ($qry) use ($search) {
                        $qry->where('tipe', 'LIKE', '%' . $search . '%');
                    });
                    $q->orWhereHas('fakultas', function ($qry) use ($search) {
                        $qry->where('unit', 'LIKE', '%' . $search . '%');
                    });
                }
            })
            ->orderBy('id', 'DESC')
            ->paginate($limit);
        $tipe = MasterUnitTipeModel::getTipe();
        $fakultas = MasterUnitModel::getFakultas();

        # set pagination
        $start = ($page * $limit) - $limit;
        $start = ($page > 1 ? $start + 1 : 1);
        $end = $start + $limit - 1;
        $end = ($end < $data->total() ? $end : $data->total());

        return view('cms.page.unit.index', [
            'data' => $data,
            'query' => $query,
            'limit' => $limit,
            'search' => $search,
            'filter' => $filter,
            'entries' => [
                'start' => $start,
                'end' => $end,
                'total' => $data->total(),
            ],
            'fakultas' => $fakultas,
            'tipe' => $tipe,
        ]);
    }

    public function add()
    {
        return view('cms.page.unit.add', [
            'tipe' => MasterUnitTipeModel::getTipe(),
            'fakultas' => MasterUnitModel::getFakultas(),
            'jenjang' => MasterJenjangModel::getJenjang()
        ]);
    }

    public function save(UnitRequest $request)
    {
        # validate if data has exists
        $check = MasterUnitModel::query()
            ->where('master_unit_tipe_id', '=', $request->tipe)
            ->where('master_unit_parent_id', '=', $request->fakultas)
            ->where('unit', 'like', '%' . $request->unit . '%')
            ->count();
        if ($check > 0) {
            return response()->json([
                'status' => 0,
                'message' => 'Unit sudah terdaftar'
            ], 400);
        }

        # using db transaction
        try {
            DB::beginTransaction();

            # create unit
            $unit_id = MasterUnitModel::query()->insertGetId([
                'master_unit_tipe_id' => $request->tipe,
                'master_unit_parent_id' => $request->fakultas,
                'unit' => $request->unit,
            ]);

            # create jenjang if unit tipe = 2 (Prodi)
            if ($request->tipe == '2' && !empty($request->jenjang) && is_array($request->jenjang)) {
                foreach ($request->jenjang as $jenjang_id) {
                    if ($jenjang_id == '') continue;
                    MasterUnitJenjangModel::query()->insert([
                        'master_jenjang_id' => $jenjang_id,
                        'master_unit_id' => $unit_id
                    ]);
                }
            }

            DB::commit();
            session()->flash('success', 'Unit successfully created');
            return response()->json([
                'status' => true,
                'message' => 'Unit berhasil dibuat'
            ]);
        } catch (\Exception $exception) {
            # rollback data
            DB::rollback();
            Log::error($exception);

            return response()->json([
                'status' => false,
                'message' => $exception->getMessage()
            ], 500);
        }
    }

    public function edit($unit_id)
    {
        # get data
        $unit = MasterUnitModel::find($unit_id);

        # validate data
        if (!$unit) {
            return redirect()->to(url('master/unit'))->withErrors('Data tidak ditemukan');
        }

        return view('cms.page.unit.edit', [
            'unit_id' => $unit_id,
            'data' => $unit,
            'tipe' => MasterUnitTipeModel::getTipe(),
            'fakultas' => MasterUnitModel::getFakultas(),
            'jenjang' => MasterJenjangModel::getJenjang(),
            'unit_jenjang' => MasterUnitJenjangModel::pluckJenjangIdByUnit($unit->id),
        ]);
    }

    public function update(UnitRequest $request, $unit_id)
    {
        # get data
        $unit = MasterUnitModel::find($unit_id);

        # validate data
        if (!$unit) {
            return response()->json([
                'status' => 0,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        # validate unit name
        $check_same = MasterUnitModel::query()
            ->where('master_unit_tipe_id', '=', $request->tipe)
            ->where('master_unit_parent_id', '=', $request->fakultas)
            ->where('unit', 'like', '%' . $request->unit . '%')
            ->where('id', '!=', $unit_id)
            ->count();
        if ($check_same > 0) {
            return response()->json([
                'status' => 0,
                'message' => 'Unit dengan nama yang anda masukan sudah digunakan'
            ], 400);
        }

        # using db transaction
        try {
            DB::beginTransaction();

            # update record data
            MasterUnitModel::query()
                ->where('id', '=', $unit->id)
                ->update([
                    'master_unit_tipe_id' => $request->tipe,
                    'master_unit_parent_id' => $request->fakultas,
                    'unit' => $request->unit,
                ]);

            # create jenjang if unit tipe = 2 (Prodi) and not exists in record
            if ($request->tipe == '2' && isset($request->jenjang) && is_array($request->jenjang)) {
                foreach ($request->jenjang as $jenjang_id) {
                    # validate if record is not duplicate
                    $check_exists = MasterUnitJenjangModel::query()
                        ->where('master_jenjang_id', '=', $jenjang_id)
                        ->where('master_unit_id', '=', $unit->id)
                        ->count();
                    if ($check_exists === 0) {
                        MasterUnitJenjangModel::query()->insert([
                            'master_jenjang_id' => $jenjang_id,
                            'master_unit_id' => $unit_id
                        ]);
                    }
                }

                # delete jenjang if unit tipe = 2 (Prodi) and not exists list_jenjang
                MasterUnitJenjangModel::query()
                    ->whereNotIn('master_jenjang_id', $request->jenjang)
                    ->where('master_unit_id', '=', $unit->id)
                    ->delete();
            } else {
                # remove all jenjang
                MasterUnitJenjangModel::query()
                    ->where('master_unit_id', '=', $unit->id)
                    ->delete();
            }

            DB::commit();
            session()->flash('success', 'Unit successfully updated');
            return response()->json([
                'status' => true,
                'message' => 'Unit berhasil di update'
            ]);
        } catch (\Exception $exception) {
            # rollback data
            DB::rollback();
            Log::error($exception);

            return response()->json([
                'status' => false,
                'message' => $exception->getMessage()
            ], 500);
        }
    }

    public function delete($unit_id)
    {
        # get data
        $unit = MasterUnitModel::find($unit_id);

        # validate data
        if (!$unit) {
            return response()->json([
                'status' => 0,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        # delete record
        if ($unit->delete()) {
            # set response success
            session()->flash('success', 'Unit successfully deleted');
            return response()->json([
                'status' => true,
                'message' => 'Unit berhasil di hapus'
            ], 200);
        }

        return response()->json([
            'status' => false,
            'message' => 'Terjadi kesalahan, silakan coba beberapa saat lagi'
        ], 500);
    }
}
