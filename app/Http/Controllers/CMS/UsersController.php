<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Models\Users;
use App\UsersModel;
use Illuminate\Support\Facades\Hash;

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
        dd([
            // 'foto' => $request->email,
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // $act = Users::save([
        //     'email' => $request->email
        // ]);
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
