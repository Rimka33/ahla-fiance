<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DownloadLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadLinkController extends Controller
{
    public function index()
    {
        $downloadLinks = DownloadLink::latest()->paginate(15);
        return view('admin.download-links.index', compact('downloadLinks'));
    }

    public function create()
    {
        return view('admin.download-links.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'platform' => 'required|string|in:android,ios,mac,windows',
            'url' => 'required|url|max:255',
            'icon' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('icon')) {
            $validated['icon'] = $request->file('icon')->store('downloads/icons', 'public');
        }

        DownloadLink::create($validated);

        \Illuminate\Support\Facades\Cache::forget('download_links_active');

        return redirect()->route('admin.download-links.index')->with('success', 'Lien de téléchargement créé avec succès.');
    }

    public function edit(DownloadLink $downloadLink)
    {
        return view('admin.download-links.edit', compact('downloadLink'));
    }

    public function update(Request $request, DownloadLink $downloadLink)
    {
        $validated = $request->validate([
            'platform' => 'required|string|in:android,ios,mac,windows',
            'url' => 'required|url|max:255',
            'icon' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('icon')) {
            if ($downloadLink->icon) {
                Storage::disk('public')->delete($downloadLink->icon);
            }
            $validated['icon'] = $request->file('icon')->store('downloads/icons', 'public');
        } else {
            unset($validated['icon']);
        }

        $downloadLink->update($validated);

        \Illuminate\Support\Facades\Cache::forget('download_links_active');

        return redirect()->route('admin.download-links.index')->with('success', 'Lien de téléchargement mis à jour avec succès.');
    }

    public function destroy(DownloadLink $downloadLink)
    {
        if ($downloadLink->icon) {
            Storage::disk('public')->delete($downloadLink->icon);
        }

        $downloadLink->delete();

        \Illuminate\Support\Facades\Cache::forget('download_links_active');

        return redirect()->route('admin.download-links.index')->with('success', 'Lien de téléchargement supprimé avec succès.');
    }
}
