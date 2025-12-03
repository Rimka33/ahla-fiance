<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use App\Models\Statistic;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use App\Models\HeroSection;
use App\Models\DownloadLink;
use App\Models\Page;
use App\Models\News;
use App\Models\FaqQuestion;
use App\Models\ContactMessage;
use App\Models\NewsletterSubscriber;
use App\Models\HomePageSection;
use App\Models\HowItWorkStep;
use App\Models\ValueProposition;
use App\Models\AppScreenshot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class SiteController extends Controller
{
    public function home()
    {
        $settings = Cache::remember('site_settings', 3600, function () {
            return SiteSetting::first();
        });

        $statistics = Cache::remember('statistics', 3600, function () {
            return Statistic::first();
        });

        $features = Cache::remember('features_active', 3600, function () {
            return Feature::active()->ordered()->get();
        });

        $testimonials = Cache::remember('testimonials_active', 3600, function () {
            return Testimonial::active()->get();
        });

        $heroSection = Cache::remember('hero_section_active', 3600, function () {
            return HeroSection::active()->ordered()->first();
        });

        $downloadLinks = Cache::remember('download_links_active', 3600, function () {
            return DownloadLink::active()->get();
        });

        // Sections de page d'accueil - Utiliser un cache avec timestamp pour invalidation automatique
        $aboutSection = Cache::remember('home_about_section', 60, function () {
            return HomePageSection::getByKey('about');
        });

        $usedAppText = Cache::remember('home_used_app_text', 60, function () {
            return HomePageSection::getByKey('used_app_text');
        });

        $howItWorksHeader = Cache::remember('home_how_it_works_header', 60, function () {
            return HomePageSection::getByKey('how_it_works_header');
        });

        $howItWorkSteps = Cache::remember('how_it_work_steps_active', 3600, function () {
            return HowItWorkStep::active()->ordered()->get();
        });

        $valuePropositions = Cache::remember('value_propositions_active', 3600, function () {
            return ValueProposition::active()->ordered()->get();
        });

        $appScreenshots = Cache::remember('app_screenshots_active', 3600, function () {
            return AppScreenshot::active()->ordered()->get();
        });

        $interfaceSection = Cache::remember('home_interface_section', 60, function () {
            return HomePageSection::getByKey('interface_section');
        });

        return view('home', compact(
            'settings', 'statistics', 'features', 'testimonials', 'heroSection', 'downloadLinks',
            'aboutSection', 'usedAppText', 'howItWorksHeader', 'howItWorkSteps',
            'valuePropositions', 'appScreenshots', 'interfaceSection'
        ));
    }

    public function page($slug)
    {
        $page = Cache::remember("page_{$slug}", 3600, function () use ($slug) {
            return Page::where('slug', $slug)->where('is_published', true)->first();
        });

        if (!$page) {
            abort(404);
        }

        $settings = Cache::remember('site_settings', 3600, function () {
            return SiteSetting::first();
        });

        return view('pages.show', compact('page', 'settings'));
    }

    public function sitemap()
    {
        $pages = Page::where('is_published', true)->get();
        $settings = SiteSetting::first();

        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        // Page d'accueil
        $sitemap .= '  <url>' . "\n";
        $sitemap .= '    <loc>' . url('/') . '</loc>' . "\n";
        $sitemap .= '    <lastmod>' . now()->format('Y-m-d') . '</lastmod>' . "\n";
        $sitemap .= '    <changefreq>daily</changefreq>' . "\n";
        $sitemap .= '    <priority>1.0</priority>' . "\n";
        $sitemap .= '  </url>' . "\n";

        // Pages dynamiques
        foreach ($pages as $page) {
            $sitemap .= '  <url>' . "\n";
            $sitemap .= '    <loc>' . url('/' . $page->slug) . '</loc>' . "\n";
            $sitemap .= '    <lastmod>' . $page->updated_at->format('Y-m-d') . '</lastmod>' . "\n";
            $sitemap .= '    <changefreq>weekly</changefreq>' . "\n";
            $sitemap .= '    <priority>0.8</priority>' . "\n";
            $sitemap .= '  </url>' . "\n";
        }

        $sitemap .= '</urlset>';

        return response($sitemap, 200)
            ->header('Content-Type', 'application/xml');
    }

    public function robots()
    {
        $settings = SiteSetting::first();
        $robots = "User-agent: *\n";
        $robots .= "Allow: /\n\n";

        if ($settings && $settings->site_name) {
            $robots .= "Sitemap: " . url('/sitemap.xml') . "\n";
        }

        return response($robots, 200)
            ->header('Content-Type', 'text/plain');
    }

    public function news()
    {
        $settings = Cache::remember('site_settings', 3600, function () {
            return SiteSetting::first();
        });

        $news = Cache::remember('news_published', 3600, function () {
            return News::published()->latest()->paginate(12);
        });

        $page = Cache::remember("page_actualites", 3600, function () {
            return Page::where('slug', 'actualites')->where('is_published', true)->first();
        });

        return view('news.index', compact('news', 'settings', 'page'));
    }

    public function newsShow($slug)
    {
        $settings = Cache::remember('site_settings', 3600, function () {
            return SiteSetting::first();
        });

        $article = Cache::remember("news_{$slug}", 3600, function () use ($slug) {
            $news = News::where('slug', $slug)->where('is_published', true)->first();
            if ($news) {
                $news->incrementViews();
            }
            return $news;
        });

        if (!$article) {
            abort(404);
        }

        $relatedNews = Cache::remember("news_related_{$slug}", 3600, function () use ($article) {
            return News::published()
                ->where('id', '!=', $article->id)
                ->latest()
                ->limit(3)
                ->get();
        });

        return view('news.show', compact('article', 'settings', 'relatedNews'));
    }

    public function contact(Request $request)
    {
        $settings = Cache::remember('site_settings', 3600, function () {
            return SiteSetting::first();
        });

        $page = Cache::remember("page_contact", 3600, function () {
            return Page::where('slug', 'contact')->where('is_published', true)->first();
        });

        if (!$page) {
            abort(404);
        }

        return view('pages.show', compact('page', 'settings'));
    }

    public function contactSubmit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
            'question' => 'nullable|string', // Si c'est une question pour la FAQ
            'newsletter' => 'nullable',
        ]);

        $messageData = $validated;
        unset($messageData['newsletter']);

        $message = ContactMessage::create($messageData);

        // Si l'utilisateur a coché la newsletter
        if ($request->has('newsletter') && ($request->newsletter == '1' || $request->newsletter === true || $request->newsletter === 'true')) {
            try {
                // Vérifier si l'abonné existe déjà
                $existingSubscriber = NewsletterSubscriber::where('email', $validated['email'])->first();

                if ($existingSubscriber) {
                    // Si l'abonné existe mais est désactivé, le réactiver
                    if (!$existingSubscriber->is_active) {
                        $existingSubscriber->update([
                            'is_active' => true,
                            'name' => $validated['name'],
                            'subscribed_at' => now(),
                            'unsubscribed_at' => null,
                        ]);
                    } else {
                        // Si l'abonné est déjà actif, mettre à jour le nom si nécessaire
                        if ($existingSubscriber->name != $validated['name']) {
                            $existingSubscriber->update(['name' => $validated['name']]);
                        }
                    }
                } else {
                    // Créer un nouvel abonné
                    NewsletterSubscriber::create([
                        'email' => $validated['email'],
                        'name' => $validated['name'],
                        'is_active' => true,
                        'subscribed_at' => now(),
                    ]);
                }
            } catch (\Exception $e) {
                // En cas d'erreur, on continue quand même (email déjà dans la newsletter)
                Log::warning('Erreur lors de l\'ajout à la newsletter: ' . $e->getMessage());
            }
        }

        // Optionnel: Envoyer un email de notification
        // Mail::to(config('mail.admin_email'))->send(new ContactNotification($message));

        return redirect()->back()->with('success', 'Votre message a été envoyé avec succès. Nous vous répondrons dans les plus brefs délais.');
    }

    public function faq()
    {
        $settings = Cache::remember('site_settings', 3600, function () {
            return SiteSetting::first();
        });

        $faqs = Cache::remember('faq_published', 3600, function () {
            return FaqQuestion::published()->ordered()->get()->groupBy('category');
        });

        $page = Cache::remember("page_faq", 3600, function () {
            return Page::where('slug', 'faq')->where('is_published', true)->first();
        });

        return view('pages.faq', compact('faqs', 'settings', 'page'));
    }

    public function newsletterSubscribe(Request $request)
    {
        try {
            $validated = $request->validate([
                'email' => 'required|email|max:255',
                'name' => 'nullable|string|max:255',
            ]);

            // Vérifier si l'email existe déjà
            $existingSubscriber = NewsletterSubscriber::where('email', $validated['email'])->first();

            if ($existingSubscriber) {
                // Si l'abonné existe mais est désactivé, le réactiver
                if (!$existingSubscriber->is_active) {
                    $existingSubscriber->update([
                        'is_active' => true,
                        'subscribed_at' => now(),
                        'unsubscribed_at' => null,
                    ]);

                    return response()->json([
                        'success' => true,
                        'message' => 'Merci ! Votre inscription à la newsletter a été réactivée.'
                    ]);
                }

                // Sinon, l'email est déjà actif
                return response()->json([
                    'success' => false,
                    'message' => 'Vous êtes déjà inscrit à notre newsletter.'
                ]);
            }

            // Créer un nouvel abonné
            $subscriber = NewsletterSubscriber::create([
                'email' => $validated['email'],
                'name' => $validated['name'] ?? null,
                'is_active' => true,
                'subscribed_at' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Merci ! Vous êtes maintenant inscrit à notre newsletter.'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->errors();
            $message = isset($errors['email']) ? $errors['email'][0] : 'Email invalide.';

            return response()->json([
                'success' => false,
                'message' => $message
            ], 422);

        } catch (\Illuminate\Database\QueryException $e) {
            // Erreur de base de données (contrainte unique email)
            // Vérifier si c'est une erreur de contrainte unique
            if ($e->getCode() == 23000 || strpos($e->getMessage(), 'Duplicate entry') !== false || strpos($e->getMessage(), 'UNIQUE constraint') !== false) {
                // Vérifier si l'email existe vraiment et s'il est actif
                $existingSubscriber = NewsletterSubscriber::where('email', $request->email)->first();

                if ($existingSubscriber) {
                    if (!$existingSubscriber->is_active) {
                        // Réactiver l'abonné
                        $existingSubscriber->update([
                            'is_active' => true,
                            'subscribed_at' => now(),
                            'unsubscribed_at' => null,
                        ]);

                        return response()->json([
                            'success' => true,
                            'message' => 'Merci ! Votre inscription à la newsletter a été réactivée.'
                        ]);
                    } else {
                        return response()->json([
                            'success' => false,
                            'message' => 'Vous êtes déjà inscrit à notre newsletter.'
                        ], 400);
                    }
                }
            }

            \Log::error('Newsletter subscription error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'inscription. Veuillez réessayer plus tard.'
            ], 500);

        } catch (\Exception $e) {
            // Log de l'erreur pour le débogage
            \Log::error('Newsletter subscription error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'inscription. Veuillez réessayer plus tard.'
            ], 500);
        }
    }
}
