<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function index()
    {

        $languages = Language::orderBy('id', 'asc')->get();
        $countriesJson = file_get_contents(resource_path('country_code/countries.json'));
        $countries = json_decode($countriesJson, true);
        $activeMenu = "languages";
        return view('admin.languages.index', compact('languages', 'activeMenu', 'countries'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'is_default' => 'nullable|in:0,1',
            'status' => 'nullable|in:0,1',
        ]);

        $name = $request->input('name');
        $parts = explode(' - ', $name);


        if (count($parts) == 2) {
            $name = trim($parts[0]);
            $code = trim($parts[1]);
        } else {
            notyf()->error('Invalid name format. Please use "Name - Code" format.');
            return redirect()->back();
        }

        $data = [
            'name' => $name,
            'code' => $code,
            'is_default' => '0',
            'status' => '1',
        ];


        Language::create($data);
        notyf()->success('New language created successfully.');
        return redirect()->route('languages.index');
    }


    public function edit($id)
    {
        $language = Language::findOrFail($id);
        return view('languages.edit', compact('language'));
    }

    public function update(Request $request, $id)
    {
        $language = Language::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'code' => 'required|string|unique:languages,code,' . $language->id,
            'is_default' => 'required|boolean',
            'status' => 'required|boolean',
        ]);

        $language->update($request->all());

        // Handle flag upload update logic

        return redirect()->route('languages.index');
    }

    public function destroy($id)
    {
        $language = Language::findOrFail($id);
        $language->delete();

        return redirect()->route('languages.index');
    }
}
