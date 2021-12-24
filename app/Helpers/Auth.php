<?php


namespace App\Helpers;
use App\Models\CmsUsers;

class Auth
{
    public static function initSession(CmsUsers $users) {
        $priv = $users->id_cms_privileges;
        $module = Apps::modulePrivilege($priv);
        $allmodule = Apps::allModulPriviles($priv);

        $module = json_decode($module);
        $allmodule = json_decode($allmodule);

        session()->put('users_id', $users->id);
        session()->put('users_name', $users->name);
        session()->put('users_email', $users->email);
        session()->put('users_foto', asset($users->foto));
        session()->put('users_cms_privileges', $priv);
        session()->put('users_privileges', $users->cmsPrivileges()->name);
        session()->put('users_module',$module);
        session()->put('users_privileges_roles',$allmodule);
    }
    public static function usersModule()
    {
        return session()->get('users_module');
    }
    public static function usersPrivilegesId()
    {
        return session()->get('users_cms_privileges');
    }
    public static function getSession($session) {
        return session()->get($session);
    }
}
