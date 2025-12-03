<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = News::query();

        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('excerpt', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        if ($request->has('status') && $request->status !== '') {
            if ($request->status === 'published') {
                $query->where('is_published', true)
                      ->where(function($q) {
                          $q->whereNull('published_at')
                            ->orWhere('published_at', '<=', now());
                      });
            } elseif ($request->status === 'scheduled') {
                $query->where('is_published', true)
                      ->where('published_at', '>', now());
            } elseif ($request->status === 'draft') {
                $query->where('is_published', false);
            }
        }

        $news = $query->with('category')->latest()->paginate(15)->withQueryString();
        $categories = NewsCategory::active()->ordered()->get();

        return view('admin.news.index', compact('news', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = NewsCategory::active()->ordered()->get();
        return view('admin.news.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:news,slug',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|max:2048',
            'author' => 'nullable|string|max:255',
            'published_at' => 'nullable|date',
            'is_published' => 'boolean',
            'is_featured' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|text',
            'category_id' => 'nullable|exists:news_categories,id',
        ]);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('news/featured', 'public');
        }

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Convertir published_at si c'est un datetime-local
        if ($request->has('published_at') && $request->published_at) {
            $validated['published_at'] = \Carbon\Carbon::parse($request->published_at);
        }

        News::create($validated);

        \Illuminate\Support\Facades\Cache::forget('news_published');

        return redirect()->route('admin.news.index')->with('success', 'Actualité créée avec succès.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        $categories = NewsCategory::active()->ordered()->get();
        return view('admin.news.edit', compact('news', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:news,slug,' . $news->id,
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|max:2048',
            'author' => 'nullable|string|max:255',
            'published_at' => 'nullable|date',
            'is_published' => 'boolean',
            'is_featured' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|text',
            'category_id' => 'nullable|exists:news_categories,id',
        ]);

        if ($request->hasFile('featured_image')) {
            if ($news->featured_image) {
                Storage::disk('public')->delete($news->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('news/featured', 'public');
        } else {
            unset($validated['featured_image']);
        }

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Convertir published_at si c'est un datetime-local
        if ($request->has('published_at') && $request->published_at) {
            $validated['published_at'] = \Carbon\Carbon::parse($request->published_at);
        } elseif ($request->has('published_at') && empty($request->published_at)) {
            $validated['published_at'] = null;
        }

        $news->update($validated);

        \Illuminate\Support\Facades\Cache::forget('news_published');
        \Illuminate\Support\Facades\Cache::forget("news_{$news->slug}");

        return redirect()->route('admin.news.index')->with('success', 'Actualité mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        if ($news->featured_image) {
            Storage::disk('public')->delete($news->featured_image);
        }

        $news->delete();

        \Illuminate\Support\Facades\Cache::forget('news_published');

        return redirect()->route('admin.news.index')->with('success', 'Actualité supprimée avec succès.');
    }
}
