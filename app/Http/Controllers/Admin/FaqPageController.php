<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\FaqQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FaqPageController extends Controller
{
    public function edit()
    {
        $page = Page::where('slug', 'faq')->first();
        $faqs = FaqQuestion::published()->ordered()->paginate(20);

        if (!$page) {
            $page = Page::create([
                'title' => 'FAQs - Foire aux questions',
                'slug' => 'faq',
                'badge_text' => 'Question & Réponse',
                'content' => '',
                'is_published' => true,
            ]);
        }

        return view('admin.pages.faq-edit', compact('page', 'faqs'));
    }

    public function update(Request $request)
    {
        $page = Page::where('slug', 'faq')->firstOrFail();

        $validated = $request->validate([
            'badge_text' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'ask_question_title' => 'nullable|string|max:255',
            'ask_question_subtitle' => 'nullable|string|max:255',
            'ask_question_description' => 'nullable|string',
        ]);

        // Mettre à jour la page et garantir la publication en une seule opération
        $page->update(array_merge($validated, ['is_published' => true]));

        // Nettoyer le cache de manière ciblée
        Cache::forget("page_{$page->slug}");
        Cache::forget('faq_published');

        return redirect()->route('admin.faq.page.edit')->with('success', 'Page FAQ mise à jour avec succès.');
    }
}

