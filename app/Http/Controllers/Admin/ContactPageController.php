<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ContactPageController extends Controller
{
    public function edit()
    {
        $page = Page::where('slug', 'contact')->first();
        $settings = SiteSetting::first();

        if (!$page) {
            $page = Page::create([
                'title' => 'Contact',
                'slug' => 'contact',
                'content' => '<h2>Contactez-nous</h2><p>Formulaire de contact</p>',
                'is_published' => true,
            ]);
        }

        return view('admin.contact-page.edit', compact('page', 'settings'));
    }

    public function update(Request $request)
    {
        $page = Page::where('slug', 'contact')->firstOrFail();
        $settings = SiteSetting::firstOrCreate(
            [],
            [
                'site_name' => 'Ahla Finance',
                'email' => '',
                'phone' => '',
                'address' => '',
                'google_maps_url' => '',
            ]
        );

        $validated = $request->validate([
            'badge_text' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string',
            'form_badge' => 'nullable|string|max:255',
            'form_title' => 'nullable|string|max:255',
            'form_description' => 'nullable|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'google_maps_url' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if (!empty($value)) {
                        if (!filter_var($value, FILTER_VALIDATE_URL)) {
                            $fail('L\'URL Google Maps doit être une URL valide.');
                        } elseif (!str_starts_with($value, 'https://www.google.com/maps/embed')) {
                            $fail('L\'URL Google Maps doit être une URL d\'embed valide (commence par https://www.google.com/maps/embed).');
                        }
                    }
                },
            ],
        ]);

        // Mettre à jour la page
        $page->update(collect($validated)->only([
            'badge_text', 'title', 'subtitle', 'form_badge', 'form_title', 'form_description'
        ])->toArray());
        
        // Garantir que la page est publiée
        $page->is_published = true;
        $page->save();
        
        // Rafraîchir le modèle depuis la base de données
        $page->refresh();

        if ($settings) {
            $settings->update(collect($validated)->only([
                'email', 'phone', 'address', 'google_maps_url'
            ])->toArray());
        }

        // Nettoyer le cache
        Cache::forget("page_{$page->slug}");
        Cache::forget("page_contact");
        Cache::forget('site_settings');
        Cache::flush(); // Vider complètement le cache

        return redirect()->route('admin.contact-page.edit')->with('success', 'Page contact mise à jour avec succès.');
    }
}
