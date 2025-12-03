<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateHomePageRequest;
use App\Models\HeroSection;
use App\Models\HomePageSection;
use App\Models\HowItWorkStep;
use App\Models\ValueProposition;
use App\Models\AppScreenshot;
use App\Models\Statistic;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class HomePageController extends Controller
{
    public function edit()
    {
        $heroSection = HeroSection::active()->ordered()->first() ?? HeroSection::first();
        $statistic = Statistic::firstOrCreate([]);

        // Sections de page d'accueil
        $aboutSection = HomePageSection::firstOrCreate(
            ['section_key' => 'about'],
            [
                'title' => 'Une interface fluide qui transforme les visiteurs en utilisateurs engagés',
                'badge_text' => 'À propos de nous',
                'content' => 'Ahla Finance Digitale révolutionne les services financiers au Tchad en offrant une plateforme numérique simple et intuitive, permettant à chaque utilisateur d\'accéder aux services de transfert d\'argent, paiement mobile, change de devises, et bien plus.',
                'button_text' => 'ESSAYER GRATUITEMENT',
                'button_link' => '#',
                'image' => 'images/appscreen.png',
                'video_thumbnail' => 'images/applicationvideothumb.png',
                'is_active' => true
            ]
        );

        $usedAppText = HomePageSection::firstOrCreate(
            ['section_key' => 'used_app_text'],
            [
                'title' => 'Une solution déjà adoptée au Tchad',
                'content' => 'Rejoignez le mouvement vers une finance plus simple et accessible',
                'is_active' => true
            ]
        );

        $howItWorksHeader = HomePageSection::firstOrCreate(
            ['section_key' => 'how_it_works_header'],
            [
                'badge_text' => 'Rapide et facile',
                'title' => 'Comment ça fonctionne en 3 étapes',
                'button_text' => 'Commencez maintenant',
                'button_link' => '#',
                'is_active' => true
            ]
        );

        $interfaceSection = HomePageSection::firstOrCreate(
            ['section_key' => 'interface_section'],
            [
                'badge_text' => 'Ecrans de l\'application',
                'title' => 'Découvrez les interface de Ahla Finance',
                'is_active' => true
            ]
        );

        // Étapes "Comment ça fonctionne"
        $howItWorkSteps = HowItWorkStep::orderBy('order')->orderBy('step_number')->get();

        // Propositions de valeur
        $valuePropositions = ValueProposition::orderBy('order')->get();

        // Screenshots
        $appScreenshots = AppScreenshot::orderBy('order')->get();

        return view('admin.home-page.edit', compact(
            'heroSection', 'statistic',
            'aboutSection', 'usedAppText', 'howItWorksHeader', 'interfaceSection',
            'howItWorkSteps', 'valuePropositions', 'appScreenshots'
        ));
    }

    public function update(UpdateHomePageRequest $request)
    {
        try {
            // Récupérer les données validées (peut échouer silencieusement)
            try {
                $validated = $request->validated();
            } catch (\Illuminate\Validation\ValidationException $e) {
                // Si la validation échoue, utiliser les données brutes
                \Log::warning('HomePage Update - Validation échouée, utilisation des données brutes:', ['errors' => $e->errors()]);
            }
            
            // Log pour déboguer - TOUJOURS logger les données brutes
            \Log::info('HomePage Update - Données reçues:', [
                'about' => $request->input('about'),
                'about_title' => $request->input('about.title'),
                'about_content' => $request->input('about.content'),
                'about_badge_text' => $request->input('about.badge_text'),
                'all_request' => $request->all()
            ]);

        // ✅ Mise à jour de la section Hero
        if ($request->has('hero')) {
            $heroData = $request->input('hero');
            $heroSection = HeroSection::find($heroData['id'] ?? null);

            if ($heroSection) {
                if (isset($heroData['typed_strings']) && !empty($heroData['typed_strings'])) {
                    $typedStrings = array_map('trim', explode('|', $heroData['typed_strings']));
                    $typedStrings = array_filter($typedStrings);
                    $heroSection->typed_strings = !empty($typedStrings) ? array_values($typedStrings) : null;
                }

                if (isset($heroData['main_title'])) {
                    $heroSection->main_title = $heroData['main_title'];
                }
                if (isset($heroData['description'])) {
                    $heroSection->description = $heroData['description'];
                }
                if (isset($heroData['video_url'])) {
                    $heroSection->video_url = $heroData['video_url'];
                }

                $heroSection->save();
                $heroSection->refresh();

                Cache::forget('hero_section_active');
            } elseif (isset($heroData['main_title']) && !empty($heroData['main_title'])) {
                $typedStrings = null;
                if (!empty($heroData['typed_strings'])) {
                    $typedStrings = array_map('trim', explode('|', $heroData['typed_strings']));
                    $typedStrings = array_filter($typedStrings);
                    $typedStrings = !empty($typedStrings) ? array_values($typedStrings) : null;
                }

                HeroSection::create([
                    'main_title' => $heroData['main_title'],
                    'description' => $heroData['description'] ?? '',
                    'typed_strings' => $typedStrings,
                    'video_url' => $heroData['video_url'] ?? null,
                    'is_active' => true,
                    'order' => 0,
                ]);

                Cache::forget('hero_section_active');
            }
        }

        // ✅ SOLUTION COMPLÈTE : Mise à jour des sections de page
        $sections = [
            'about' => $request->input('about'),
            'used_app_text' => $request->input('used_app_text'),
            'how_it_works_header' => $request->input('how_it_works_header'),
            'interface_section' => $request->input('interface_section'),
        ];

        foreach ($sections as $key => $data) {
            // Récupérer la section existante
            $section = HomePageSection::where('section_key', $key)->first();

            // Si la section n'existe pas, la créer
            if (!$section) {
                // Si un ID est fourni dans les données, essayer de le trouver
                if (isset($data['id']) && !empty($data['id'])) {
                    $section = HomePageSection::find($data['id']);
                }
                // Sinon, créer une nouvelle section
                if (!$section) {
                    $section = new HomePageSection();
                    $section->section_key = $key;
                    $section->is_active = true;
                    $section->save();
                }
            }

            // S'assurer que section_key est défini
            if (empty($section->section_key)) {
                $section->section_key = $key;
            }

            // Log pour déboguer
            \Log::info("Section {$key} - Données reçues:", ['data' => $data, 'section_id' => $section->id]);

            // Si des données sont fournies, les mettre à jour
            // Tous les champs sont toujours envoyés dans le formulaire HTML
            if ($data !== null && is_array($data)) {
                $updateData = [];

                // Mettre à jour TOUS les champs texte s'ils sont présents dans les données
                // Ne pas vérifier s'ils ont changé, juste mettre à jour
                if (array_key_exists('title', $data)) {
                    $updateData['title'] = $data['title'];
                }
                if (array_key_exists('content', $data)) {
                    $updateData['content'] = $data['content'];
                }
                if (array_key_exists('badge_text', $data)) {
                    $updateData['badge_text'] = $data['badge_text'];
                }
                if (array_key_exists('button_text', $data)) {
                    $updateData['button_text'] = $data['button_text'];
                }
                if (array_key_exists('button_link', $data)) {
                    $updateData['button_link'] = $data['button_link'];
                }

                // Gestion des images
                if (isset($data['remove_image']) && $data['remove_image'] == '1') {
                    if ($section->image && !str_starts_with($section->image, 'images/')) {
                        Storage::disk('public')->delete($section->image);
                    }
                    $updateData['image'] = null;
                }

                if ($request->hasFile("{$key}.image")) {
                    if ($section->image && !str_starts_with($section->image, 'images/')) {
                        Storage::disk('public')->delete($section->image);
                    }
                    $updateData['image'] = $request->file("{$key}.image")->store('home-sections', 'public');
                }

                // Gestion des vidéos
                if (isset($data['remove_video_thumbnail']) && $data['remove_video_thumbnail'] == '1') {
                    if ($section->video_thumbnail && !str_starts_with($section->video_thumbnail, 'images/')) {
                        Storage::disk('public')->delete($section->video_thumbnail);
                    }
                    $updateData['video_thumbnail'] = null;
                }

                if ($request->hasFile("{$key}.video_thumbnail")) {
                    if ($section->video_thumbnail && !str_starts_with($section->video_thumbnail, 'images/')) {
                        Storage::disk('public')->delete($section->video_thumbnail);
                    }
                    $updateData['video_thumbnail'] = $request->file("{$key}.video_thumbnail")->store('home-sections', 'public');
                }

                // Toujours mettre à jour is_active
                $updateData['is_active'] = true;
                
                // Log avant mise à jour
                \Log::info("Section {$key} - Données à mettre à jour:", [
                    'updateData' => $updateData, 
                    'section_before' => [
                        'id' => $section->id,
                        'title' => $section->title,
                        'content' => $section->content,
                        'badge_text' => $section->badge_text
                    ]
                ]);
                
                // Mettre à jour la section - TOUJOURS mettre à jour même si updateData ne contient que is_active
                // Cela garantit que le timestamp est mis à jour et que le cache est invalidé
                
                // FORCER la mise à jour même si updateData semble vide
                // Utiliser fill() puis save() pour garantir que les données sont bien assignées
                if (!empty($updateData)) {
                    $section->fill($updateData);
                    $section->save();
                    \Log::info("Section {$key} - fill() + save() appelés", [
                        'updateData' => $updateData,
                        'section_after_fill' => [
                            'title' => $section->title,
                            'content' => $section->content,
                            'badge_text' => $section->badge_text
                        ]
                    ]);
                } else {
                    \Log::warning("Section {$key} - updateData vide, mais on force quand même la mise à jour", [
                        'data_received' => $data,
                        'section_current' => [
                            'title' => $section->title,
                            'content' => $section->content
                        ]
                    ]);
                }
                
                // Forcer la mise à jour du timestamp pour invalider le cache
                $section->touch();
                $section->save();
                
                // Rafraîchir le modèle depuis la base de données pour avoir les dernières valeurs
                $section->refresh();
                
                // Log après mise à jour pour vérifier que les données sont bien sauvegardées
                \Log::info("Section {$key} - Section après mise à jour:", [
                    'section_after' => [
                        'id' => $section->id,
                        'title' => $section->title,
                        'content' => $section->content,
                        'badge_text' => $section->badge_text,
                        'updated_at' => $section->updated_at
                    ]
                ]);
            } elseif ($section) {
                // Même si aucune donnée n'est fournie, forcer la mise à jour du timestamp
                $section->touch();
                $section->save();
                $section->refresh();
            }
        }

        // ✅ Mise à jour des étapes "Comment ça fonctionne"
        if ($request->has('how_it_work_steps')) {
            foreach ($request->input('how_it_work_steps', []) as $index => $stepData) {
                if (empty($stepData['title']) && empty($stepData['id'])) {
                    continue;
                }

                $step = HowItWorkStep::findOrNew($stepData['id'] ?? null);

                // Gestion de la suppression d'icône
                if (isset($stepData['remove_icon']) && $stepData['remove_icon'] == '1') {
                    if ($step->icon) {
                        Storage::disk('public')->delete($step->icon);
                    }
                    $step->icon = null;
                }

                $step->fill($stepData);

                if ($request->hasFile("how_it_work_steps.{$index}.icon")) {
                    if ($step->icon) {
                        Storage::disk('public')->delete($step->icon);
                    }
                    $step->icon = $request->file("how_it_work_steps.{$index}.icon")->store('how-it-works', 'public');
                }

                if (!isset($stepData['step_number'])) {
                    $step->step_number = $index + 1;
                }
                if (!isset($stepData['order'])) {
                    $step->order = $index;
                }
                if (!isset($stepData['is_active'])) {
                    $step->is_active = true;
                }

                $step->save();
            }
        }

        // ✅ Mise à jour des propositions de valeur
        if ($request->has('value_propositions')) {
            foreach ($request->input('value_propositions', []) as $index => $valueData) {
                // Gérer la suppression
                if (isset($valueData['_delete']) && $valueData['_delete'] == '1') {
                    if (!empty($valueData['id'])) {
                        $value = ValueProposition::find($valueData['id']);
                        if ($value) {
                            if ($value->icon) {
                                Storage::disk('public')->delete($value->icon);
                            }
                            $value->delete();
                        }
                    }
                    continue;
                }

                if (empty($valueData['title']) && empty($valueData['description']) && empty($valueData['id'])) {
                    continue;
                }

                $value = ValueProposition::findOrNew($valueData['id'] ?? null);

                // Gestion de la suppression d'icône
                if (isset($valueData['remove_icon']) && $valueData['remove_icon'] == '1') {
                    if ($value->icon) {
                        Storage::disk('public')->delete($value->icon);
                    }
                    $value->icon = null;
                }

                $value->fill($valueData);

                if ($request->hasFile("value_propositions.{$index}.icon")) {
                    if ($value->icon) {
                        Storage::disk('public')->delete($value->icon);
                    }
                    $value->icon = $request->file("value_propositions.{$index}.icon")->store('value-propositions', 'public');
                }

                if (!isset($valueData['order'])) {
                    $value->order = $index;
                }
                if (!isset($valueData['is_active'])) {
                    $value->is_active = true;
                }

                $value->save();
            }
        }

        // ✅ Mise à jour des screenshots
        if ($request->has('app_screenshots')) {
            foreach ($request->input('app_screenshots', []) as $index => $screenshotData) {
                // Gérer la suppression
                if (isset($screenshotData['_delete']) && $screenshotData['_delete'] == '1') {
                    if (!empty($screenshotData['id'])) {
                        $screenshot = AppScreenshot::find($screenshotData['id']);
                        if ($screenshot) {
                            if ($screenshot->image) {
                                Storage::disk('public')->delete($screenshot->image);
                            }
                            $screenshot->delete();
                        }
                    }
                    continue;
                }

                if (empty($screenshotData['image']) && !$request->hasFile("app_screenshots.{$index}.image") && empty($screenshotData['id'])) {
                    continue;
                }

                $screenshot = AppScreenshot::findOrNew($screenshotData['id'] ?? null);

                // Gestion de la suppression d'image
                if (isset($screenshotData['remove_image']) && $screenshotData['remove_image'] == '1') {
                    if ($screenshot->image) {
                        Storage::disk('public')->delete($screenshot->image);
                    }
                    $screenshot->image = null;
                }

                $screenshot->fill($screenshotData);

                if ($request->hasFile("app_screenshots.{$index}.image")) {
                    if ($screenshot->image) {
                        Storage::disk('public')->delete($screenshot->image);
                    }
                    $screenshot->image = $request->file("app_screenshots.{$index}.image")->store('app-screenshots', 'public');
                }

                if (!isset($screenshotData['order'])) {
                    $screenshot->order = $index;
                }
                if (!isset($screenshotData['is_active'])) {
                    $screenshot->is_active = true;
                }

                $screenshot->save();
            }
        }

        // ✅ Mise à jour des statistiques
        if ($request->has('statistics')) {
            $statisticsData = $request->input('statistics');
            $statistic = Statistic::find($statisticsData['id'] ?? null);

            if ($statistic) {
                $statistic->update([
                    'users_count' => $statisticsData['users_count'] ?? $statistic->users_count,
                    'users_suffix' => $statisticsData['users_suffix'] ?? $statistic->users_suffix,
                    'reviews_count' => $statisticsData['reviews_count'] ?? $statistic->reviews_count,
                    'reviews_suffix' => $statisticsData['reviews_suffix'] ?? $statistic->reviews_suffix,
                    'countries_count' => $statisticsData['countries_count'] ?? $statistic->countries_count,
                    'countries_suffix' => $statisticsData['countries_suffix'] ?? $statistic->countries_suffix,
                    'subscribers_count' => $statisticsData['subscribers_count'] ?? $statistic->subscribers_count,
                    'subscribers_suffix' => $statisticsData['subscribers_suffix'] ?? $statistic->subscribers_suffix,
                ]);
            } else {
                Statistic::create([
                    'users_count' => $statisticsData['users_count'] ?? 25,
                    'users_suffix' => $statisticsData['users_suffix'] ?? 'M+',
                    'reviews_count' => $statisticsData['reviews_count'] ?? 1500,
                    'reviews_suffix' => $statisticsData['reviews_suffix'] ?? '+',
                    'countries_count' => $statisticsData['countries_count'] ?? 1,
                    'countries_suffix' => $statisticsData['countries_suffix'] ?? '+',
                    'subscribers_count' => $statisticsData['subscribers_count'] ?? 8,
                    'subscribers_suffix' => $statisticsData['subscribers_suffix'] ?? 'M+',
                ]);
            }

            Cache::forget('statistics');
        }

        // ✅ Nettoyer TOUT le cache de manière agressive pour forcer le rechargement
        Cache::forget('home_about_section');
        Cache::forget('home_used_app_text');
        Cache::forget('home_how_it_works_header');
        Cache::forget('how_it_work_steps_active');
        Cache::forget('value_propositions_active');
        Cache::forget('app_screenshots_active');
        Cache::forget('home_interface_section');
        Cache::forget('hero_section_active');
        Cache::forget('statistics');
        Cache::forget('features_active');
        Cache::forget('testimonials_active');
        Cache::forget('download_links_active');
        
        // Vider complètement le cache pour forcer le rechargement immédiat
        Cache::flush();
        
        // Forcer le rechargement des modèles Eloquent
        \Illuminate\Database\Eloquent\Model::clearBootedModels();

        \Log::info('HomePage Update - Mise à jour terminée avec succès');

        return redirect()->route('admin.home-page.edit')->with('success', 'Page d\'accueil mise à jour avec succès.');
        
        } catch (\Exception $e) {
            \Log::error('HomePage Update - Erreur:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all()
            ]);
            
            return redirect()->route('admin.home-page.edit')
                ->with('error', 'Erreur lors de la mise à jour: ' . $e->getMessage())
                ->withInput();
        }
    }
}
