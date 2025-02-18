<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOptionRequest;
use App\Models\Option;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activeMenu = "application-settings";
        return view('admin.application-settings.settings', compact('activeMenu'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function update(Request $request)
    {
        $inputs = $request->except('_token');
        foreach ($inputs as $key => $value) {
            $option = Option::firstOrCreate(['key' => $key]);
            $option->value = $value;
            $option->save();
        }
        notyf()->success('Application Settings has been updated');
        return redirect()->route('settings.index');
    }


    public function store(StoreOptionRequest $request)
    {
        //
    }


}
