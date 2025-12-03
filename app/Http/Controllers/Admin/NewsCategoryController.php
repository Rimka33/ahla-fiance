<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsCategoryController extends Controller
{
    public function index()
    {
        $categories = NewsCategory::ordered()->get();
        return view('admin.news-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.news-categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:news_categories,slug',
            'description' => 'nullable|string',
            'color' => 'nullable|string|max:7',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        NewsCategory::create($validated);

        return redirect()->route('admin.news-categories.index')->with('success', 'Catégorie créée avec succès.');
    }

    public function edit(NewsCategory $newsCategory)
    {
        return view('admin.news-categories.edit', compact('newsCategory'));
    }

    public function update(Request $request, NewsCategory $newsCategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:news_categories,slug,' . $newsCategory->id,
            'description' => 'nullable|string',
            'color' => 'nullable|string|max:7',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $newsCategory->update($validated);

        return redirect()->route('admin.news-categories.index')->with('success', 'Catégorie mise à jour avec succès.');
    }

    public function destroy(NewsCategory $newsCategory)
    {
        // Vérifier s'il y a des actualités dans cette catégorie
        if ($newsCategory->news()->count() > 0) {
            return redirect()->route('admin.news-categories.index')
                ->with('error', 'Impossible de supprimer cette catégorie car elle contient des actualités.');
        }

        $newsCategory->delete();

        return redirect()->route('admin.news-categories.index')->with('success', 'Catégorie supprimée avec succès.');
    }
}
