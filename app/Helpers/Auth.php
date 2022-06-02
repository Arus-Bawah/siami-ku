<?php

namespace App\Helpers;

use App\UserRolesModel;
use App\UsersModel;

class Auth
{
    public static function initSession(UsersModel $users)
    {
        session()->put('users_id', $users->id);
        session()->put('users_name', $users->name);
        session()->put('users_email', $users->email);
        session()->put('users_role', $users->role);
        session()->put('users_foto', asset($users->foto));
        session()->put('users_jabatan', $users->jabatan);
        session()->put('users_tanda_tangan', asset($users->foto));
        session()->put('users_unit_id', UserRolesModel::pluckUnitIdByUsersId($users->id));
    }

    public static function getSession()
    {
        return (object)[
            'id' => session()->get('users_id'),
            'name' => session()->get('users_name'),
            'email' => session()->get('users_email'),
            'role' => session()->get('users_role'),
            'foto' => session()->get('users_foto'),
            'jabatan' => session()->get('users_jabatan'),
            'tanda_tangan' => session()->get('users_tanda_tangan'),
            'unit_id' => session()->get('users_unit_id'),
        ];
    }

    public static function getUnitId()
    {
        return UserRolesModel::pluckUnitIdByUsersId(session()->get('users_id'));
    }
}
