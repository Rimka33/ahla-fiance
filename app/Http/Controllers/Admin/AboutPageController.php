<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class AboutPageController extends Controller
{
    public function edit()
    {
        $page = Page::where('slug', 'a-propos')->first();

        if (!$page) {
            $page = Page::create([
                'title' => 'À propos',
                'slug' => 'a-propos',
                'content' => '<h2>À propos de nous</h2><p>Contenu à modifier...</p>',
                'is_published' => true,
            ]);
        }

        return view('admin.about-page.edit', compact('page'));
    }

    public function update(Request $request)
    {
        $page = Page::where('slug', 'a-propos')->firstOrFail();

        $validated = $request->validate([
            'badge_text' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string',
            'presentation_who' => 'nullable|string',
            'presentation_mission' => 'nullable|string',
            'presentation_vision' => 'nullable|string',
            'why_content' => 'nullable|string',
            'engagements_content' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
        ]);

        // Mettre à jour les données et garantir la publication en une seule opération
        $fieldsToUpdate = collect($validated)->except(['image'])->toArray();
        $page->update(array_merge($fieldsToUpdate, ['is_published' => true]));

        // Nettoyer le cache de manière ciblée
        Cache::forget("page_{$page->slug}");

        return redirect()->route('admin.about-page.edit')->with('success', 'Page À propos mise à jour avec succès.');
    }
}
