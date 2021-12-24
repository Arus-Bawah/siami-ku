<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function getIndex()
    {
        $data['page_title'] = 'Dashboard';
        return view(adminView('dashboard.index'),$data);
    }
}
