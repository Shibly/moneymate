<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Translation;
use Illuminate\Http\Request;

class TranslationController extends Controller
{
    public function index()
    {
        $translations = Translation::all();
        return view('translations.index', compact('translations'));
    }

    public function create()
    {
        $languages = Language::all();
        return view('translations.create', compact('languages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|exists:languages,code',
            'key' => 'required|string',
            'value' => 'required|string',
        ]);

        Translation::create($request->all());

        return redirect()->route('translations.index');
    }

    public function edit($code)
    {
        $languages = Language::all();
        $translations = Translation::where('code', $code)->get();
        if ($translations->isEmpty()) {
            $keys = Translation::select('key')->distinct()->get();
            foreach ($keys as $key) {
                $translations[] = (object)[
                    'id' => 'placeholder_' . $key->key,
                    'key' => $key->key,
                    'value' => '',
                    'code' => $code,
                ];
            }
        }

        return view('admin.translations.edit', compact('translations', 'languages', 'code'));
    }


    public function update(Request $request, $code)
    {
        $translations = Translation::where('code', $code)->get();

        // Loop through each translation and update it
        foreach ($translations as $translation) {
            $key = $translation->key;
            $value = $request->input($key); // Get the value from the form

            // Update the translation value
            $translation->update(['value' => $value]);
        }

        return redirect()->route('translations.index');
    }

    public function destroy($id)
    {
        $translation = Translation::findOrFail($id);
        $translation->delete();

        return redirect()->route('translations.index');
    }
}

