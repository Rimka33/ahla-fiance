<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiteSettingController extends Controller
{
    public function edit()
    {
        $settings = SiteSetting::firstOrCreate([]);
        return view('admin.settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = SiteSetting::firstOrCreate([]);

        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'slogan' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|max:2048',
            'favicon' => 'nullable|image|max:512',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'facebook_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'pinterest_url' => 'nullable|url|max:255',
            'meta_description' => 'nullable|string|max:255',
            'google_analytics_id' => 'nullable|string|max:255',
            'meta_pixel_id' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('logo')) {
            if ($settings->logo) {
                Storage::disk('public')->delete($settings->logo);
            }
            $validated['logo'] = $request->file('logo')->store('settings/logo', 'public');
        } else {
            unset($validated['logo']);
        }

        if ($request->hasFile('favicon')) {
            if ($settings->favicon) {
                Storage::disk('public')->delete($settings->favicon);
            }
            $validated['favicon'] = $request->file('favicon')->store('settings/favicon', 'public');
        } else {
            unset($validated['favicon']);
        }

        $settings->update($validated);

        \Illuminate\Support\Facades\Cache::forget('site_settings');

        return redirect()->route('admin.settings.edit')->with('success', 'Paramètres mis à jour avec succès.');
    }
}
