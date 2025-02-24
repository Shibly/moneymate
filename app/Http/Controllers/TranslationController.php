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


    public function ajaxUpdate(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'code' => 'required|string',
            'key' => 'required|string',
            'value' => 'required|string'
        ]);

        $code = $request->input('code');
        $key = $request->input('key');
        $value = $request->input('value');

        // Find an existing translation by code and key
        $translation = Translation::where('code', $code)
            ->where('key', $key)
            ->first();

        // If not found, create a new one
        if (!$translation) {
            $translation = new Translation();
            $translation->code = strtolower($code);
            $translation->key = $key;
        }

        // Update or set the value
        $translation->value = $value;
        $translation->save();

        // Return a JSON response
        return response()->json([
            'status' => 'success',
            'message' => 'Translation saved successfully.'
        ]);
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
        $activeMenu = 'edit-translation';
        $languages = Language::all();
        $translations = Translation::where('code', $code)->get();
        $englishTranslations = Translation::where('code', 'en')->get();
        $allKeys = Translation::select('key')->distinct()->pluck('key')->toArray();
        $existingTranslations = $translations->keyBy('key');
        $englishTranslations = $englishTranslations->keyBy('key');
        foreach ($allKeys as $key) {

            if (!$existingTranslations->has($key)) {
                $translations->push((object)[
                    'key' => $key,
                    'value' => isset($englishTranslations[$key]) ? $englishTranslations[$key]->value : '',
                    'code' => $code,
                ]);
            }
        }
        $translations = $translations->sortBy('key');
        return view('admin.translations.edit', compact('translations', 'languages', 'code', 'activeMenu', 'englishTranslations'));
    }


}

