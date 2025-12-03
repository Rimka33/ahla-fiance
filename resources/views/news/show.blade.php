@extends('layouts.app')

@section('title', ($article->meta_title ?? $article->title) . ' - ' . ($settings?->site_name ?? 'Ahla Finance'))

@section('content')
<!-- Page-wrapper-Start -->
<div class="page_wrapper">
    <!-- News Detail Section Start -->
    <section class="contact_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <article class="news_article" data-aos="fade-up" data-aos-duration="1500" style="background: white; border-radius: 16px; padding: 2.5rem; box-shadow: 0 4px 16px rgba(0,0,0,0.1);">
                        @if($article->featured_image)
                        <div class="article_featured_image mb-4" style="border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                            <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}" class="img-fluid" style="width: 100%; height: auto; display: block;">
                        </div>
                        @endif

                        <div class="article_header mb-4">
                            <div class="article_meta mb-3" style="display: flex; gap: 1.5rem; align-items: center; flex-wrap: wrap; font-size: 0.9rem; color: #6c757d;">
                                @if($article->published_at)
                                <span style="display: flex; align-items: center; gap: 0.5rem;">
                                    <i class="icofont-calendar" style="font-size: 1.1rem;"></i>
                                    <strong>{{ $article->published_at->format('d F Y') }}</strong>
                                </span>
                                @endif
                                @if($article->author)
                                <span style="display: flex; align-items: center; gap: 0.5rem;">
                                    <i class="icofont-user" style="font-size: 1.1rem;"></i>
                                    {{ $article->author }}
                                </span>
                                @endif
                                @if($article->views_count > 0)
                                <span style="display: flex; align-items: center; gap: 0.5rem;">
                                    <i class="icofont-eye" style="font-size: 1.1rem;"></i>
                                    {{ $article->views_count }} vues
                                </span>
                                @endif
                                @if($article->category)
                                <span style="background: #e3f2fd; color: #2E64BA; padding: 0.375rem 1rem; border-radius: 20px; font-weight: 600; font-size: 0.85rem;">
                                    {{ $article->category->name }}
                                </span>
                                @endif
                            </div>
                            <h1 class="article_title" style="font-size: 2.25rem; font-weight: 700; color: #2c3e50; line-height: 1.3; margin: 0;">{{ $article->title }}</h1>
                        </div>

                        <div class="article_content" style="font-size: 1.1rem; line-height: 1.8; color: #495057;">
                            {!! $article->content !!}
                        </div>

                        <div class="article_footer mt-5 pt-4 border-top" style="border-top: 2px solid #e9ecef; padding-top: 2rem;">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="{{ route('news.index') }}" class="btn puprple_btn" style="display: inline-flex; align-items: center; gap: 0.5rem;">
                                        <i class="icofont-arrow-left"></i>
                                        Retour aux actualités
                                    </a>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>

                <div class="col-lg-4">
                    @if($relatedNews && $relatedNews->count() > 0)
                    <aside class="related_news" data-aos="fade-up" data-aos-duration="1500" style="background: white; border-radius: 16px; padding: 2rem; box-shadow: 0 4px 16px rgba(0,0,0,0.1); position: sticky; top: 100px;">
                        <h3 style="font-size: 1.5rem; font-weight: 700; color: #2c3e50; margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 2px solid #e9ecef;">
                            Actualités similaires
                        </h3>
                        @foreach($relatedNews as $related)
                        <div class="related_news_item mb-3" style="display: flex; gap: 1rem; padding-bottom: 1rem; border-bottom: 1px solid #e9ecef; transition: transform 0.3s ease;">
                            @if($related->featured_image)
                            <div class="related_news_image" style="flex-shrink: 0; width: 100px; height: 80px; border-radius: 8px; overflow: hidden;">
                                <a href="{{ route('news.show', $related->slug) }}">
                                    <img src="{{ asset('storage/' . $related->featured_image) }}" alt="{{ $related->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                                </a>
                            </div>
                            @endif
                            <div class="related_news_content" style="flex: 1; min-width: 0;">
                                <h4 style="margin: 0 0 0.5rem 0; font-size: 1rem; font-weight: 600; line-height: 1.4;">
                                    <a href="{{ route('news.show', $related->slug) }}" style="color: #2c3e50; text-decoration: none; transition: color 0.3s ease;">
                                        {{ $related->title }}
                                    </a>
                                </h4>
                                @if($related->published_at)
                                <span class="related_news_date" style="font-size: 0.85rem; color: #6c757d;">
                                    {{ $related->published_at->format('d M Y') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        <style>
                            .related_news_item:hover {
                                transform: translateX(5px);
                            }
                            .related_news_item h4 a:hover {
                                color: #2E64BA;
                            }
                        </style>
                        @endforeach
                    </aside>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- News Detail Section End -->
</div>
<!-- Page-wrapper-End -->
@endsection
