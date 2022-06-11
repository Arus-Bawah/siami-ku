<?php

namespace App\Http\Controllers\CMS;

use App\Helpers\LPM;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\MasterUnitModel;
use App\MasterUnitTipeModel;
use App\UserRolesModel;
use Illuminate\Support\Facades\Hash;

# model
use App\UsersModel;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function index()
    {
        // get query
        $query = request()->query();
        $page = (int) request()->get('page') == '' ? 1 : request()->get('page');
        $limit = (int) request()->get('limit') == '' ? 20 : request()->get('limit');
        $search = request()->get('search') == '' ? '' : request()->get('search');
        $filter = is_array(request()->get('filter')) ? request()->get('filter') : [];

        // get data
        $data = UsersModel::getIndex($limit, $search, $filter);

        # set pagination
        $start = ($page * $limit) - $limit;
        $start = ($page > 1 ? $start + 1 : 1);
        $end = $start + $limit - 1;
        $end = ($end < $data->total() ? $end : $data->total());

        return view('cms.page.users.index', [
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
        ]);
    }

    public function add()
    {
        return view('cms.page.users.add', [
            'access' => MasterUnitTipeModel::with(
                'masterUnit',
                'masterUnit.masterUnitJenjang',
                'masterUnit.masterUnitJenjang.masterJenjang'
            )->get()
        ]);
    }

    public function save(UserStoreRequest $request)
    {
        # get data
        $unit = MasterUnitModel::with('masterUnitTipe') # use for check tipe id
            ->get()
            ->keyBy('id');

        try {
            DB::beginTransaction();

            # create new record data
            # default role is user because LPM is an admin role
            $users_id = UsersModel::query()->insertGetId([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'User',
                'foto' => LPM::UploadImage('foto', 'profile'),
                'jabatan' => $request->jabatan,
                'tanda_tangan' => ($request->signature_type === 'upload' ? LPM::UploadImage('signature', 'signature') : LPM::UploadBase64('signature_draw', 'signature')),
            ]);

            # create role access record
            $save_unit = [];
            foreach ($request->unit as $unit_id) {
                if (isset($unit[$unit_id])) {
                    $save_unit[] = [
                        'users_id' => $users_id,
                        'master_unit_tipe_id' => $unit[$unit_id]->masterUnitTipe->id,
                        'master_unit_id' => $unit_id,
                    ];
                }
            }
            UserRolesModel::query()->insert($save_unit);

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'User berhasil dibuat'
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan, silakan coba beberapa saat lagi',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit($user_id)
    {
        # get data
        $user = UsersModel::find($user_id);

        # validate data
        if (!$user) {
            return redirect()->to(url('master/users'))->withErrors('Data tidak ditemukan');
        }

        return view('cms.page.users.edit', [
            'user_id' => $user_id,
            'data' => $user,
            'role' => UserRolesModel::pluckUnitIdByUsersId($user->id),
            'access' => MasterUnitTipeModel::with(
                'masterUnit',
                'masterUnit.masterUnitJenjang',
                'masterUnit.masterUnitJenjang.masterJenjang'
            )->get()
        ]);
    }

    public function update(UserUpdateRequest $request, $user_id)
    {
        # get data
        $user = UsersModel::find($user_id);
        $unit = MasterUnitModel::with('masterUnitTipe') # use for check unit tipe id
            ->get()->keyBy('id');
        $role = UserRolesModel::pluckUnitIdByUsersId($user->id); # get existing access role variable

        # validate data
        if (!$user) {
            return response()->json([
                'status' => 0,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        # validate email
        $check_email = UsersModel::query()
            ->where('id', '!=', $user->id)
            ->where('email', '=', $request->email)
            ->count();
        if ($check_email > 0) {
            return response()->json([
                'status' => 0,
                'message' => 'User dengan email yang anda masukan sudah digunakan'
            ], 400);
        }

        # check if updated photo
        $foto = LPM::UploadImage('foto', 'profile');

        # check if updated signature
        # default type is existing [existing, upload, draw]
        # if existing not updated
        $tanda_tangan = $user->tanda_tangan;
        if ($request->signature_type === 'upload') {
            $tanda_tangan = LPM::UploadImage('signature', 'signature');
        } else if ($request->signature_type === 'draw') {
            $tanda_tangan = LPM::UploadBase64('signature_draw', 'signature');
        }

        # create parameter
        $save = [
            'name' => $request->nama,
            'email' => $request->email,
            'jabatan' => $request->jabatan,
            'foto' => ($foto === null ? $user->foto : $foto), # check if updated photo
            'tanda_tangan' => $tanda_tangan,
            'password' => (!$request->password ? $user->password : Hash::make($request->password))
        ];


        try {
            DB::beginTransaction();

            # update record data
            UsersModel::query()
                ->where('id', '=', $user->id)
                ->update($save);

            # create role access record
            $save_unit = [];
            foreach ($request->unit as $unit_id) {
                if (!in_array($unit_id, $role)) {
                    $save_unit[] = [
                        'users_id' => $user->id,
                        'master_unit_tipe_id' => $unit[$unit_id]->masterUnitTipe->id,
                        'master_unit_id' => $unit_id,
                    ];
                }
            }
            UserRolesModel::query()->insert($save_unit);

            # delete role access record
            UserRolesModel::query()
                ->where('users_id', '=', $user->id)
                ->whereNotIn('master_unit_id', $request->unit)
                ->delete();

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'User berhasil update'
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan, silakan coba beberapa saat lagi',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function delete($user_id)
    {
        # get data
        $user = UsersModel::find($user_id);

        # validate data
        if (!$user) {
            return response()->json([
                'status' => 0,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        # delete record
        if ($user->delete()) {
            # set response success
            return response()->json([
                'status' => true,
                'message' => 'User berhasil di hapus'
            ], 200);
        }

        return response()->json([
            'status' => false,
            'message' => 'Terjadi kesalahan, silakan coba beberapa saat lagi'
        ], 500);
    }
}
