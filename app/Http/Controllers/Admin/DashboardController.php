<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Page;
use App\Models\Testimonial;
use App\Models\HeroSection;
use App\Models\SiteSetting;
use App\Models\ContactMessage;
use App\Models\FaqQuestion;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'news_count' => News::count(),
            'news_published' => News::where('is_published', true)->count(),
            'news_draft' => News::where('is_published', false)->count(),
            'pages_count' => Page::count(),
            'pages_published' => Page::where('is_published', true)->count(),
            'testimonials_count' => Testimonial::count(),
            'testimonials_active' => Testimonial::where('is_active', true)->count(),
            'hero_sections_count' => HeroSection::count(),
            'hero_sections_active' => HeroSection::where('is_active', true)->count(),
            'faq_count' => FaqQuestion::count(),
            'faq_published' => FaqQuestion::where('is_published', true)->count(),
            'inbox_total' => ContactMessage::count(),
            'inbox_unread' => ContactMessage::whereIn('status', ['new', 'read'])->count(),
            'inbox_new' => ContactMessage::where('status', 'new')->count(),
            'newsletter_total' => NewsletterSubscriber::count(),
            'newsletter_active' => NewsletterSubscriber::where('is_active', true)->count(),
            'download_links_count' => \App\Models\DownloadLink::count(),
            'download_links_active' => \App\Models\DownloadLink::where('is_active', true)->count(),
        ];

        // Statistiques des 30 derniers jours
        $stats['news_last_30_days'] = News::where('created_at', '>=', now()->subDays(30))->count();
        $stats['messages_last_30_days'] = ContactMessage::where('created_at', '>=', now()->subDays(30))->count();
        $stats['subscribers_last_30_days'] = NewsletterSubscriber::where('created_at', '>=', now()->subDays(30))->count();

        $recentNews = News::latest()->limit(5)->get();
        $recentMessages = ContactMessage::latest()->limit(5)->get();
        $recentSubscribers = NewsletterSubscriber::latest()->limit(5)->get();
        $settings = SiteSetting::first();

        return view('admin.dashboard', compact('stats', 'recentNews', 'recentMessages', 'recentSubscribers', 'settings'));
    }
}
