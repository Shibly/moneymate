<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $activeMenu = "dashboard";
        return view('admin.dashboard', compact('activeMenu'));
    }
}
