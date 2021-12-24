<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use App\Models\CmsUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function getIndex()
    {
        return view('backend.login');
    }
    public function postLogin()
    {
        $validator = Validator::make(request()->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('auth/login')
                ->withErrors($validator)
                ->withInput();
        }
        $email = request()->get('email');
        $password = request()->get('password');

        $users = CmsUsers::findBy('email',request()->get('email'));
        if (!$users) {
            return redirect()->back()->with(['message'=>'Email Not Found','type'=>'error']);
        }
        if (Hash::check($password, $users->password)) {
            Auth::initSession($users);

            return redirect(adminUrl("dashboard"));
        }

        return redirect()->back()->with(['message'=>'Email Not Found','type'=>'error']);

    }
    public function getLogout()
    {
        session()->flush();

        return redirect('auth/login')->with(['message'=>'Success logout','type'=>'success']);
    }
}
