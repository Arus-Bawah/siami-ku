<?php

namespace App\Http\Controllers\CMS;

use App\Helpers\LPM;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
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

    public function edit($id)
    {
        return view('cms.page.users.edit', []);
    }

    public function update($id)
    {
    }

    public function delete()
    {
    }
}
