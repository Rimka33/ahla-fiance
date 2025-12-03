<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FaqQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $query = FaqQuestion::query();

        // Filtre par statut
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Filtre par catégorie
        if ($request->has('category') && $request->category !== '') {
            $query->where('category', $request->category);
        }

        // Filtre publié/non publié
        if ($request->has('published') && $request->published !== '') {
            $query->where('is_published', $request->published === '1');
        }

        // Recherche
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('question', 'like', "%{$search}%")
                  ->orWhere('answer', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        $faqs = $query->ordered()->paginate(15);
        $categories = FaqQuestion::whereNotNull('category')->distinct()->pluck('category');

        return view('admin.faq.index', compact('faqs', 'categories'));
    }

    public function create()
    {
        $categories = FaqQuestion::whereNotNull('category')->distinct()->pluck('category');
        return view('admin.faq.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'category' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
            'is_published' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        $faq = FaqQuestion::create($validated);

        // Invalider le cache si la FAQ est publiée
        if ($faq->is_published) {
            Cache::forget('faq_published');
        }

        return redirect()->route('admin.faq.index')->with('success', 'Question FAQ créée avec succès.');
    }

    public function edit(FaqQuestion $faq)
    {
        $categories = FaqQuestion::whereNotNull('category')->distinct()->pluck('category');
        return view('admin.faq.edit', compact('faq', 'categories'));
    }

    public function update(Request $request, FaqQuestion $faq)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'category' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
            'is_published' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        $wasPublished = $faq->is_published;
        $faq->update($validated);

        // Invalider le cache si la FAQ était publiée ou est maintenant publiée
        if ($wasPublished || $faq->is_published) {
            Cache::forget('faq_published');
        }

        return redirect()->route('admin.faq.index')->with('success', 'Question FAQ mise à jour avec succès.');
    }

    public function destroy(FaqQuestion $faq)
    {
        $wasPublished = $faq->is_published;
        $faq->delete();

        // Invalider le cache si la FAQ était publiée
        if ($wasPublished) {
            Cache::forget('faq_published');
        }

        return redirect()->route('admin.faq.index')->with('success', 'Question FAQ supprimée avec succès.');
    }
}
