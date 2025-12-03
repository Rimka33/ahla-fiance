<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest()->paginate(15);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'photo' => 'nullable|image|max:2048',
            'testimonial_text' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'date' => 'nullable|date',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('testimonials/photos', 'public');
        }

        Testimonial::create($validated);

        \Illuminate\Support\Facades\Cache::forget('testimonials_active');

        return redirect()->route('admin.testimonials.index')->with('success', 'Témoignage créé avec succès.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'photo' => 'nullable|image|max:2048',
            'testimonial_text' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'date' => 'nullable|date',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('photo')) {
            if ($testimonial->photo) {
                Storage::disk('public')->delete($testimonial->photo);
            }
            $validated['photo'] = $request->file('photo')->store('testimonials/photos', 'public');
        } else {
            unset($validated['photo']);
        }

        $testimonial->update($validated);

        \Illuminate\Support\Facades\Cache::forget('testimonials_active');

        return redirect()->route('admin.testimonials.index')->with('success', 'Témoignage mis à jour avec succès.');
    }

    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->photo) {
            Storage::disk('public')->delete($testimonial->photo);
        }

        $testimonial->delete();

        \Illuminate\Support\Facades\Cache::forget('testimonials_active');

        return redirect()->route('admin.testimonials.index')->with('success', 'Témoignage supprimé avec succès.');
    }
}
