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
        $title = "Application Settings";
        return view('admin.application-settings.settings', compact('activeMenu', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function update(Request $request)
    {
        $request->validate([
            'app_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png|max:512',
        ]);

        $inputs = $request->except('_token', 'app_logo', 'favicon');

        foreach ($inputs as $key => $value) {
            $option = Option::firstOrCreate(['key' => $key]);
            $option->value = $value;
            $option->save();
        }

        if ($request->hasFile('app_logo')) {
            $logoName = time() . '.' . $request->file('app_logo')->getClientOriginalExtension();
            $logoPath = $request->file('app_logo')->storeAs('', $logoName, 'local');
            Option::updateOrCreate(['key' => 'app_logo'], ['value' => $logoPath]);
        }

        if ($request->hasFile('favicon')) {
            $faviconName = time() . '.' . $request->file('favicon')->getClientOriginalExtension();
            $faviconPath = $request->file('favicon')->storeAs('', $faviconName, 'local');
            Option::updateOrCreate(['key' => 'favicon'], ['value' => $faviconPath]);
        }

        notyf()->success('Application Settings has been updated');
        return redirect()->route('settings.index');
    }


    public function store(StoreOptionRequest $request)
    {
        //
    }


}
