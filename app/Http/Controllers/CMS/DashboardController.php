<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('cms.page.dashboard.dashboard');
    }
}
