<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FeatureController extends Controller
{
    public function index()
    {
        $features = Feature::orderBy('order')->paginate(15);
        return view('admin.features.index', compact('features'));
    }

    public function create()
    {
        return view('admin.features.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|image|max:2048',
            'image_frame' => 'nullable|image|max:2048',
            'image_screen' => 'nullable|image|max:2048',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('icon')) {
            $validated['icon'] = $request->file('icon')->store('features/icons', 'public');
        }
        if ($request->hasFile('image_frame')) {
            $validated['image_frame'] = $request->file('image_frame')->store('features/frames', 'public');
        }
        if ($request->hasFile('image_screen')) {
            $validated['image_screen'] = $request->file('image_screen')->store('features/screens', 'public');
        }

        Feature::create($validated);

        \Illuminate\Support\Facades\Cache::forget('features_active');

        return redirect()->route('admin.features.index')->with('success', 'Fonctionnalité créée avec succès.');
    }

    public function edit(Feature $feature)
    {
        return view('admin.features.edit', compact('feature'));
    }

    public function update(Request $request, Feature $feature)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|image|max:2048',
            'image_frame' => 'nullable|image|max:2048',
            'image_screen' => 'nullable|image|max:2048',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('icon')) {
            if ($feature->icon) {
                Storage::disk('public')->delete($feature->icon);
            }
            $validated['icon'] = $request->file('icon')->store('features/icons', 'public');
        } else {
            unset($validated['icon']);
        }

        if ($request->hasFile('image_frame')) {
            if ($feature->image_frame) {
                Storage::disk('public')->delete($feature->image_frame);
            }
            $validated['image_frame'] = $request->file('image_frame')->store('features/frames', 'public');
        } else {
            unset($validated['image_frame']);
        }

        if ($request->hasFile('image_screen')) {
            if ($feature->image_screen) {
                Storage::disk('public')->delete($feature->image_screen);
            }
            $validated['image_screen'] = $request->file('image_screen')->store('features/screens', 'public');
        } else {
            unset($validated['image_screen']);
        }

        $feature->update($validated);

        \Illuminate\Support\Facades\Cache::forget('features_active');

        return redirect()->route('admin.features.index')->with('success', 'Fonctionnalité mise à jour avec succès.');
    }

    public function destroy(Feature $feature)
    {
        if ($feature->icon) {
            Storage::disk('public')->delete($feature->icon);
        }
        if ($feature->image_frame) {
            Storage::disk('public')->delete($feature->image_frame);
        }
        if ($feature->image_screen) {
            Storage::disk('public')->delete($feature->image_screen);
        }

        $feature->delete();

        \Illuminate\Support\Facades\Cache::forget('features_active');

        return redirect()->route('admin.features.index')->with('success', 'Fonctionnalité supprimée avec succès.');
    }
}
