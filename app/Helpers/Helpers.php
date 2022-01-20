<?php
if (! function_exists('fullUrl')) {
    function fullUrl()
    {
        return request()->fullUrl();
    }
}

if (! function_exists('adminUrl')) {
    function adminUrl($url ='dashboard')
    {
        return url('admin/'.$url);
    }
}
if (! function_exists('g')) {
    function g($string)
    {
        return request()->get($string);
    }
}
if (! function_exists('adminView')) {
    function adminView($page)
    {
        return 'backend.page.'.$page;
    }
}
if(!function_exists('getFile')) {
    function getFile($name) {
        $request = app('request');
        return $request->file($name);
    }
}
if(!function_exists('hasFile')) {
    function hasFile($name) {
        $request = app('request');
        return $request->hasFile($name);
    }
}
if(!function_exists('mainpath')) {
    function mainpath($url='') {
        $current = trim(request()->url(), '/');
        $del = ['/add','/edit','/delete','/save'];
        foreach ($del as $d){
            $curs = explode($d,$current);
            $current = $curs[0];
        }
        return $current.'/'.$url;
    }
}
if(!function_exists('returnUrl')) {
    function returnUrl() {
        return "<input type='hidden' name='return_url' value='".g('return_url')."'>";
    }
}
