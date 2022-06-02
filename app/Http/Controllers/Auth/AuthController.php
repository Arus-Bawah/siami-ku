<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Auth;
use App\UsersModel;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('cms.login');
    }

    public function doLogin(LoginRequest $request)
    {
        $users = UsersModel::findBy('email', $request->input('email'));
        if (Hash::check($request->input('password'), $users->password)) {
            Auth::initSession($users);
            return response()->json([
                'status' => true,
                'message' => 'Login Berhasil'
            ], 200);
        }

        return response()->json([
            'status' => false,
            'message' => 'Username / Password yang anda masukan salah'
        ], 200);
    }

    public function doLogout()
    {
        session()->flush();
        return response()->json([
            'status' => true,
            'message' => 'Logout berhasil'
        ], 200);
    }
}
