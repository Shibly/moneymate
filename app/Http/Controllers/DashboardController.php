<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class DashboardController extends Controller
{
    public function dashboard(): View
    {
        $activeMenu = "dashboard";
        $title = 'Dashboard';
        return view('admin.dashboard', compact('activeMenu', 'title'));
    }
}
