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
        \Log::info('DEBUG: AboutPage Update HIT', [
            'method' => $request->method(),
            'content_type' => $request->header('Content-Type'),
            'all_data' => $request->all(),
            'files' => $request->allFiles()
        ]);
        
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
            'engagements_content' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
        ]);

        // Mettre à jour les données
        // On retire les champs qui ne sont pas dans la table pages (comme image qui est déjà gérée)
        $fieldsToUpdate = collect($validated)->except(['image'])->toArray();
        
        $page->update($fieldsToUpdate);
        
        // Garantir que la page est publiée
        $page->is_published = true;
        $page->save();
        
        // Rafraîchir le modèle depuis la base de données
        $page->refresh();

        // Nettoyer le cache
        Cache::forget("page_{$page->slug}");
        Cache::forget("page_a-propos");
        Cache::flush(); // Vider complètement le cache

        return redirect()->route('admin.about-page.edit')->with('success', 'Page À propos mise à jour avec succès.');
    }
}
