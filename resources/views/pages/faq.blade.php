@extends('layouts.app')

@section('title', 'FAQ - ' . ($page->meta_title ?? 'Questions Fréquentes'))

@section('content')
<!-- Page-wrapper-Start -->
<div class="page_wrapper">
    <!-- FAQ Tab Section Start -->
    <section class="row_am faq_section">
        <div class="container">
            <div class="section_title" data-aos="fade-up" data-aos-duration="1500">
                <span class="title_badge">{{ $page->badge_text ?? 'Question & Réponse' }}</span>
                <h2>{!! $page->title ?? '<span>FAQs</span> - Foire aux questions' !!}</h2>
                @if($page && $page->subtitle)
                <p>{!! $page->subtitle !!}</p>
                @endif
                @if($page && $page->content)
                <p>{!! $page->content !!}</p>
                @endif
            </div>
            @include('pages.faq-content', ['faqs' => $faqs])
        </div>
    </section>
    <!-- FAQ Tab Section End -->
</div>
<!-- Page-wrapper-End -->
@endsection

