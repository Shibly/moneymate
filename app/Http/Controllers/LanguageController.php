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
        $title = get_translation('available_languages');
        return view('admin.languages.index', compact('languages', 'activeMenu', 'countries', 'title'));
    }


    public function store(Request $request)
    {
        // Validate the basic inputs. Note that we don't validate 'name' as unique here because
        // the input includes the code and needs parsing first.
        $request->validate([
            'name' => 'required|string',
            'is_default' => 'nullable|in:0,1',
            'status' => 'nullable|in:0,1',
        ]);

        $nameInput = $request->input('name');
        $parts = explode(' - ', $nameInput);

        if (count($parts) == 2) {
            $name = trim($parts[0]);
            $code = trim($parts[1]);
        } else {
            notyf()->error(get_translation('invalid_name_format_please_use_name_code_format'));
            return redirect()->back();
        }

        // Check if a language with the same name already exists.
        if (Language::where('name', $name)->exists()) {
            notyf()->error(get_translation('language_name_already_exists'));
            return redirect()->back();
        }

        $data = [
            'name' => $name,
            'code' => $code,
            'is_default' => '0',
            'status' => '1',
        ];

        Language::create($data);
        notyf()->success(get_translation('new_language_added_successfully'));
        return redirect()->route('languages.index');
    }


    public function destroy($id)
    {
        $language = Language::findOrFail($id);
        $language->delete();

        return redirect()->route('languages.index');
    }


    public function setDefaultLanguage($code)
    {
        Language::query()->update(['is_default' => '0']);
        $language = Language::where('code', $code)->firstOrFail();
        $language->update(['is_default' => '1']);
        notyf()->success(get_translation('default_language_updated_successfully'));
        return redirect()->back();
    }


}
