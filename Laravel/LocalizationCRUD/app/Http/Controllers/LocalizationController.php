<?php

namespace App\Http\Controllers;

use App\Models\Localization;
use Illuminate\Http\Request;

class LocalizationController extends Controller
{

    public function index()
    {
        $localizations = Localization::all();
        return view('localizations.index', compact('localizations'));
    }

    public function create()
    {
        return view('localizations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required|unique:localizations,key',
            'translations.keys' => 'required|array',
            'translations.values' => 'required|array',
            'translations.keys.*' => 'required|string',
            'translations.values.*' => 'required|string',
        ]);

        $translations = array_combine($request->translations['keys'], $request->translations['values']);

        Localization::create([
            'key' => $request->key,
            'translations' => $translations,
        ]);

        return redirect()->route('localizations.index')
            ->with('success', 'Localization created successfully.');
    }

    public function edit(Localization $localization)
    {
        return view('localizations.edit', compact('localization'));
    }

    public function update(Request $request, Localization $localization)
    {
        $request->validate([
            'key' => 'required|unique:localizations,key,' . $localization->id,
            'translations' => 'required|array',
        ]);

        $localization->update($request->all());

        return redirect()->route('localizations.index')
            ->with('success', 'Localization updated successfully.');
    }

    public function destroy(Localization $localization)
    {
        $localization->delete();

        return redirect()->route('localizations.index')
            ->with('success', 'Localization deleted successfully.');
    }
}
