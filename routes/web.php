<?php

use App\Http\Controllers\SiteController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\HeroSectionController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\StatisticController;
use App\Http\Controllers\Admin\DownloadLinkController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\InboxController;
use App\Http\Controllers\Admin\HomePageController;
use App\Http\Controllers\Admin\AboutPageController;
use App\Http\Controllers\Admin\ContactPageController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\NewsletterController;
use App\Http\Controllers\Admin\NewsCategoryController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Middleware\AdminAuth;
use Illuminate\Support\Facades\Route;

// Routes publiques
Route::get('/', [SiteController::class, 'home'])->name('home');
Route::get('/sitemap.xml', [SiteController::class, 'sitemap'])->name('sitemap');
Route::get('/robots.txt', [SiteController::class, 'robots'])->name('robots');
Route::get('/actualites', [SiteController::class, 'news'])->name('news.index');
Route::get('/actualites/{slug}', [SiteController::class, 'newsShow'])->name('news.show');
Route::get('/faq', [SiteController::class, 'faq'])->name('faq');

// Formulaires côté client
Route::post('/contact', [SiteController::class, 'contactSubmit'])->name('contact.submit');
Route::post('/newsletter/subscribe', [SiteController::class, 'newsletterSubscribe'])->name('newsletter.subscribe');

// Route dynamique pour les pages (doit être en dernier)
Route::get('/{page:slug}', [SiteController::class, 'page'])->name('page');

// Routes admin (authentification)
Route::prefix('admin')->name('admin.')->group(function () {
    // Routes publiques admin (login)
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Routes protégées admin
    Route::middleware([AdminAuth::class])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Profil utilisateur
        Route::prefix('profile')->name('profile.')->group(function () {
            Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
            Route::post('/update', [ProfileController::class, 'update'])->name('update');
        });

        // Actualités
        Route::post('news/{news}', [NewsController::class, 'update'])->name('news.update');
        Route::resource('news', NewsController::class)->except(['update']);

        // Catégories d'actualités
        Route::resource('news-categories', NewsCategoryController::class)->except(['show']);


        // Sections Hero
        Route::post('hero-sections/{hero_section}', [HeroSectionController::class, 'update'])->name('hero-sections.update');
        Route::resource('hero-sections', HeroSectionController::class)->except(['update']);

        // Témoignages
        Route::post('testimonials/{testimonial}', [TestimonialController::class, 'update'])->name('testimonials.update');
        Route::resource('testimonials', TestimonialController::class)->except(['update']);

        // Liens de téléchargement
        Route::post('download-links/{download_link}', [DownloadLinkController::class, 'update'])->name('download-links.update');
        Route::resource('download-links', DownloadLinkController::class)->except(['update']);

        // FAQ
        Route::post('faq/{faq}', [FaqController::class, 'update'])->name('faq.update');
        Route::resource('faq', FaqController::class)->except(['update']);

        // Inbox (Questions des clients)
        Route::prefix('inbox')->name('inbox.')->group(function () {
            Route::get('/', [InboxController::class, 'index'])->name('index');
            Route::get('/{message}', [InboxController::class, 'show'])->name('show');
            Route::post('/{message}/reply', [InboxController::class, 'reply'])->name('reply');
            Route::post('/{message}/publish-faq', [InboxController::class, 'publishFaq'])->name('publish-faq');
            Route::post('/{message}/archive', [InboxController::class, 'archive'])->name('archive');
            Route::post('/{message}/mark-read', [InboxController::class, 'markRead'])->name('mark-read');
        });

        // Pages spéciales
        Route::prefix('home-page')->name('home-page.')->group(function () {
            Route::get('/edit', [HomePageController::class, 'edit'])->name('edit');
            Route::post('/update', [HomePageController::class, 'update'])->name('update');
        });

        Route::prefix('about-page')->name('about-page.')->group(function () {
            Route::get('/edit', [AboutPageController::class, 'edit'])->name('edit');
            Route::post('/update', [AboutPageController::class, 'update'])->name('update');
        });

        Route::prefix('contact-page')->name('contact-page.')->group(function () {
            Route::get('/edit', [ContactPageController::class, 'edit'])->name('edit');
            Route::post('/update', [ContactPageController::class, 'update'])->name('update');
        });

        // Page FAQ depuis le menu Pages
        Route::prefix('faq-page')->name('faq.page.')->group(function () {
            Route::get('/edit', [\App\Http\Controllers\Admin\FaqPageController::class, 'edit'])->name('edit');
            Route::post('/update', [\App\Http\Controllers\Admin\FaqPageController::class, 'update'])->name('update');
        });

        // Page Actualités depuis le menu Pages
        Route::prefix('news-page')->name('news.page.')->group(function () {
            Route::get('/edit', [\App\Http\Controllers\Admin\NewsPageController::class, 'edit'])->name('edit');
            Route::post('/update', [\App\Http\Controllers\Admin\NewsPageController::class, 'update'])->name('update');
        });

            // Médias
            Route::prefix('media')->name('media.')->group(function () {
                Route::get('/', [MediaController::class, 'index'])->name('index');
                Route::get('/images', [MediaController::class, 'getImages'])->name('images');
                Route::post('/upload', [MediaController::class, 'upload'])->name('upload');
                Route::delete('/{media}', [MediaController::class, 'destroy'])->name('destroy');
            });

            // Images statiques (store, update et destroy)
            Route::prefix('static-images')->name('static-images.')->group(function () {
                Route::post('/', [\App\Http\Controllers\Admin\StaticImageController::class, 'store'])->name('store');
                Route::post('/{staticImage}', [\App\Http\Controllers\Admin\StaticImageController::class, 'update'])->name('update');
                Route::delete('/{staticImage}', [\App\Http\Controllers\Admin\StaticImageController::class, 'destroy'])->name('destroy');
            });

            // Newsletter
            Route::prefix('newsletter')->name('newsletter.')->group(function () {
                Route::get('/', [NewsletterController::class, 'index'])->name('index');
                Route::post('/{newsletter}/toggle-status', [NewsletterController::class, 'toggleStatus'])->name('toggle-status');
                Route::delete('/{newsletter}', [NewsletterController::class, 'destroy'])->name('destroy');
                Route::get('/export', [NewsletterController::class, 'export'])->name('export');
            });

            // Paramètres et statistiques
            Route::get('/settings', [SiteSettingController::class, 'edit'])->name('settings.edit');
            Route::post('/settings', [SiteSettingController::class, 'update'])->name('settings.update');
            Route::get('/statistics', [StatisticController::class, 'edit'])->name('statistics.edit');
            Route::post('/statistics', [StatisticController::class, 'update'])->name('statistics.update');
    });
});
