<?php

namespace App\Http\Controllers\CMS;

use App\Helpers\LPM;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;

# model
use App\UsersModel;

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

        return view('cms.page.users.index', [
            'data' => $data,
            'query' => $query,
            'limit' => $limit,
            'search' => $search,
            'filter' => $filter,
            'entries' => [
                'start' => $page + ($page * $limit) - $limit,
                'end' => $page + ($page * $limit),
                'total' => $data->total(),
            ],
        ]);
    }

    public function add()
    {
        return view('cms.page.users.add', []);
    }

    public function save(UserStoreRequest $request)
    {
        # create new record data
        # default role is user because LPM is an admin role
        $act = UsersModel::query()->insert([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'User',
            'foto' => LPM::UploadImage('foto', 'profile'),
            'jabatan' => $request->jabatan,
            'tanda_tangan' => ($request->signature_type === 'upload' ? LPM::UploadImage('signature', 'signature') : LPM::UploadBase64('signature_draw', 'signature')),
        ]);

        if ($act) {
            # set response success
            return response()->json([
                'status' => true,
                'message' => 'User berhasil dibuat'
            ], 200);
        }

        return response()->json([
            'status' => false,
            'message' => 'Terjadi kesalahan, silakan coba beberapa saat lagi'
        ], 500);
    }

    public function edit($user_id)
    {
        # get data
        $user = UsersModel::find($user_id);

        # validat edata
        if (!$user) {
            return redirect()->to(url('master/users'))->withErrors('Data tidak ditemukan');
        }

        return view('cms.page.users.edit', [
            'user_id' => $user_id,
            'data' => $user,
        ]);
    }

    public function update(UserUpdateRequest $request, $user_id)
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

        # create parameter
        $save = [
            'name' => $request->nama,
            'email' => $request->email,
            'jabatan' => $request->jabatan,
        ];

        # check if updated photo
        $foto = LPM::UploadImage('foto', 'profile');
        if ($foto) {
            $save['foto'] = $foto;
        }

        # check if updated signature
        # default type is existing [existing, upload, draw]
        # if existing not updated
        if ($request->signature_type === 'upload') {
            $save['tanda_tangan'] = LPM::UploadImage('signature', 'signature');
        } else if ($request->signature_type === 'draw') {
            $save['tanda_tangan'] = LPM::UploadBase64('signature_draw', 'signature');
        }

        # check if updated password
        if ($request->password) {
            $save['password'] = Hash::make($request->password);
        }

        # update record data
        $act = UsersModel::query()
            ->where('id', '=', $user->id)
            ->update($save);

        if ($act) {
            # set response success
            return response()->json([
                'status' => true,
                'message' => 'User berhasil di update'
            ], 200);
        }

        return response()->json([
            'status' => false,
            'message' => 'Terjadi kesalahan, silakan coba beberapa saat lagi'
        ], 500);
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
