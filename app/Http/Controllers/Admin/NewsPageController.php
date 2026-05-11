<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class NewsPageController extends Controller
{
    public function edit()
    {
        $page = Page::where('slug', 'actualites')->first();
        $news = News::latest()->paginate(20);

        if (!$page) {
            $page = Page::create([
                'title' => 'Nos dernières actualités',
                'slug' => 'actualites',
                'badge_text' => 'Actualités',
                'subtitle' => 'Restez informé des dernières nouveautés, annonces et événements liés à Ahla Finance.',
                'content' => '',
                'is_published' => true,
            ]);
        }

        return view('admin.pages.news-edit', compact('page', 'news'));
    }

    public function update(Request $request)
    {
        $page = Page::where('slug', 'actualites')->firstOrFail();

        $validated = $request->validate([
            'badge_text' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string',
            'content' => 'nullable|string',
        ]);

        // Mettre à jour la page et garantir la publication en une seule opération
        $page->update(array_merge($validated, ['is_published' => true]));

        // Nettoyer le cache de manière ciblée
        Cache::forget("page_{$page->slug}");
        Cache::forget('news_published');

        return redirect()->route('admin.news.page.edit')->with('success', 'Page Actualités mise à jour avec succès.');
    }
}

