<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroSectionController extends Controller
{
    public function index()
    {
        $heroSections = HeroSection::orderBy('order')->paginate(15);
        return view('admin.hero-sections.index', compact('heroSections'));
    }

    public function create()
    {
        return view('admin.hero-sections.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'main_title' => 'required|string|max:255',
            'subtitle' => 'nullable|string',
            'description' => 'nullable|string',
            'typed_strings' => 'nullable|string',
            'background_image' => 'nullable|image|max:2048',
            'cta_button_text' => 'nullable|string|max:255',
            'cta_button_link' => 'nullable|url|max:255',
            'video_url' => 'nullable|url|max:255',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('background_image')) {
            $validated['background_image'] = $request->file('background_image')->store('hero/backgrounds', 'public');
        }

        // Convertir typed_strings en array si c'est une chaîne
        if (isset($validated['typed_strings']) && is_string($validated['typed_strings'])) {
            $validated['typed_strings'] = array_map('trim', explode(',', $validated['typed_strings']));
        }

        HeroSection::create($validated);

        \Illuminate\Support\Facades\Cache::forget('hero_section_active');

        return redirect()->route('admin.hero-sections.index')->with('success', 'Section Hero créée avec succès.');
    }

    public function edit(HeroSection $heroSection)
    {
        // Convertir array en string pour l'éditeur
        if (is_array($heroSection->typed_strings)) {
            $heroSection->typed_strings = implode(', ', $heroSection->typed_strings);
        }
        return view('admin.hero-sections.edit', compact('heroSection'));
    }

    public function update(Request $request, HeroSection $heroSection)
    {
        $validated = $request->validate([
            'main_title' => 'required|string|max:255',
            'subtitle' => 'nullable|string',
            'description' => 'nullable|string',
            'typed_strings' => 'nullable|string',
            'background_image' => 'nullable|image|max:2048',
            'cta_button_text' => 'nullable|string|max:255',
            'cta_button_link' => 'nullable|url|max:255',
            'video_url' => 'nullable|url|max:255',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('background_image')) {
            if ($heroSection->background_image) {
                Storage::disk('public')->delete($heroSection->background_image);
            }
            $validated['background_image'] = $request->file('background_image')->store('hero/backgrounds', 'public');
        } else {
            unset($validated['background_image']);
        }

        // Convertir typed_strings en array
        if (isset($validated['typed_strings']) && is_string($validated['typed_strings'])) {
            $validated['typed_strings'] = array_map('trim', explode(',', $validated['typed_strings']));
        }

        $heroSection->update($validated);

        \Illuminate\Support\Facades\Cache::forget('hero_section_active');

        return redirect()->route('admin.hero-sections.index')->with('success', 'Section Hero mise à jour avec succès.');
    }

    public function destroy(HeroSection $heroSection)
    {
        if ($heroSection->background_image) {
            Storage::disk('public')->delete($heroSection->background_image);
        }

        $heroSection->delete();

        \Illuminate\Support\Facades\Cache::forget('hero_section_active');

        return redirect()->route('admin.hero-sections.index')->with('success', 'Section Hero supprimée avec succès.');
    }
}
