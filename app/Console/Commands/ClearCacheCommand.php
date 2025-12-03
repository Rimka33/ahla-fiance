<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearCacheCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:clear-all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Vide tous les caches de l\'application (Laravel, Eloquent, Config, Routes, Views)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Vidage du cache en cours...');
        
        // Vider tous les caches spécifiques
        \Illuminate\Support\Facades\Cache::forget('home_about_section');
        \Illuminate\Support\Facades\Cache::forget('home_used_app_text');
        \Illuminate\Support\Facades\Cache::forget('home_how_it_works_header');
        \Illuminate\Support\Facades\Cache::forget('home_interface_section');
        \Illuminate\Support\Facades\Cache::forget('how_it_work_steps_active');
        \Illuminate\Support\Facades\Cache::forget('value_propositions_active');
        \Illuminate\Support\Facades\Cache::forget('app_screenshots_active');
        \Illuminate\Support\Facades\Cache::forget('hero_section_active');
        \Illuminate\Support\Facades\Cache::forget('statistics');
        \Illuminate\Support\Facades\Cache::forget('features_active');
        \Illuminate\Support\Facades\Cache::forget('testimonials_active');
        \Illuminate\Support\Facades\Cache::forget('download_links_active');
        \Illuminate\Support\Facades\Cache::forget('site_settings');
        \Illuminate\Support\Facades\Cache::forget('news_published');
        \Illuminate\Support\Facades\Cache::forget('faq_published');
        
        // Vider tous les caches de pages
        \Illuminate\Support\Facades\Cache::forget('page_contact');
        \Illuminate\Support\Facades\Cache::forget('page_faq');
        \Illuminate\Support\Facades\Cache::forget('page_actualites');
        \Illuminate\Support\Facades\Cache::forget('page_a-propos');
        
        // Vider complètement le cache
        \Illuminate\Support\Facades\Cache::flush();
        
        // Vider le cache des modèles Eloquent
        \Illuminate\Database\Eloquent\Model::clearBootedModels();
        
        // Vider le cache de configuration et de routes
        \Artisan::call('config:clear');
        \Artisan::call('route:clear');
        \Artisan::call('view:clear');
        
        $this->info('Cache vidé avec succès !');
        
        return 0;
    }
}
