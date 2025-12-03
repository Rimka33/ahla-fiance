@extends('layouts.app')

@section('title', 'Actualités - ' . ($settings?->site_name ?? 'Ahla Finance'))

@section('content')
<!-- Page-wrapper-Start -->
<div class="page_wrapper">
    <!-- News Section Start -->
    <section class="contact_section">
        <div class="container">
            <div class="section_title" data-aos="fade-up" data-aos-duration="1500">
                <span class="title_badge">{{ $page->badge_text ?? 'Actualités' }}</span>
                <h2>{!! $page->title ?? 'Nos <span>dernières actualités</span>' !!}</h2>
                @if($page && $page->subtitle)
                <p>{{ $page->subtitle }}</p>
                @else
                <p>Restez informé des dernières nouveautés, annonces et événements liés à Ahla Finance.</p>
                @endif
            </div>
        </div>
    </section>

    <section class="row_am">
        <div class="container">
            <div class="row">
                @forelse($news as $article)
                <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-duration="1500">
                    <div class="news_card" style="background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 16px rgba(0,0,0,0.1); transition: transform 0.3s ease, box-shadow 0.3s ease; height: 100%; display: flex; flex-direction: column;">
                        @if($article->featured_image)
                        <div class="news_image" style="position: relative; width: 100%; padding-top: 60%; overflow: hidden; background: #f8f9fa;">
                            <a href="{{ route('news.show', $article->slug) }}" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
                                <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;">
                            </a>
                        </div>
                        @else
                        <div class="news_image" style="position: relative; width: 100%; padding-top: 60%; overflow: hidden; background: linear-gradient(135deg, #2E64BA 0%, #1e4a8a 100%); display: flex; align-items: center; justify-content: center;">
                            <a href="{{ route('news.show', $article->slug) }}" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
                                <i class="icofont-newspaper" style="font-size: 4rem; color: rgba(255,255,255,0.3);"></i>
                            </a>
                        </div>
                        @endif
                        <div class="news_content" style="padding: 1.75rem; flex: 1; display: flex; flex-direction: column;">
                            <div class="news_meta" style="display: flex; gap: 1rem; align-items: center; margin-bottom: 1rem; font-size: 0.875rem; color: #6c757d;">
                                @if($article->published_at)
                                <span class="news_date" style="display: flex; align-items: center; gap: 0.5rem;">
                                    <i class="icofont-calendar"></i>
                                    {{ $article->published_at->format('d M Y') }}
                                </span>
                                @endif
                                @if($article->category)
                                <span class="news_category" style="background: #e3f2fd; color: #2E64BA; padding: 0.25rem 0.75rem; border-radius: 20px; font-weight: 500; font-size: 0.8rem;">
                                    {{ $article->category->name }}
                                </span>
                                @endif
                            </div>
                            <h3 style="margin: 0 0 1rem 0; font-size: 1.35rem; font-weight: 700; line-height: 1.4; flex: 1;">
                                <a href="{{ route('news.show', $article->slug) }}" style="color: #2c3e50; text-decoration: none; transition: color 0.3s ease;">
                                    {{ $article->title }}
                                </a>
                            </h3>
                            @if($article->excerpt)
                            <p style="color: #6c757d; font-size: 0.95rem; line-height: 1.6; margin-bottom: 1.25rem; flex: 1;">{{ $article->excerpt }}</p>
                            @else
                            <p style="color: #6c757d; font-size: 0.95rem; line-height: 1.6; margin-bottom: 1.25rem; flex: 1;">{{ Str::limit(strip_tags($article->content), 150) }}</p>
                            @endif
                            <a href="{{ route('news.show', $article->slug) }}" class="news_read_more" style="display: inline-flex; align-items: center; gap: 0.5rem; color: #2E64BA; font-weight: 600; text-decoration: none; margin-top: auto; transition: gap 0.3s ease;">
                                Lire la suite
                                <i class="icofont-arrow-right" style="transition: transform 0.3s ease;"></i>
                            </a>
                        </div>
                    </div>
                    <style>
                        .news_card:hover {
                            transform: translateY(-8px);
                            box-shadow: 0 8px 24px rgba(0,0,0,0.15);
                        }
                        .news_card:hover .news_image img {
                            transform: scale(1.05);
                        }
                        .news_card:hover .news_read_more {
                            gap: 0.75rem;
                        }
                        .news_card:hover .news_read_more i {
                            transform: translateX(4px);
                        }
                        .news_card h3 a:hover {
                            color: #2E64BA;
                        }
                    </style>
                </div>
                @empty
                <div class="col-12">
                    <div class="text-center py-5" style="padding: 4rem 2rem;">
                        <i class="icofont-newspaper" style="font-size: 4rem; color: #dee2e6; margin-bottom: 1rem;"></i>
                        <h3 style="color: #6c757d; margin-bottom: 0.5rem;">Aucune actualité disponible</h3>
                        <p style="color: #adb5bd;">Pour le moment, aucune actualité n'a été publiée.</p>
                    </div>
                </div>
                @endforelse
            </div>

            @if($news->hasPages())
            <div class="row mt-5">
                <div class="col-12">
                    <div class="pagination-wrapper" style="display: flex; justify-content: center;">
                        {{ $news->links() }}
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>
    <!-- News Section End -->
</div>
<!-- Page-wrapper-End -->
@endsection
