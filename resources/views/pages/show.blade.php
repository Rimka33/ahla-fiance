@extends('layouts.app')

@section('title', $page->meta_title ?? $page->title)

@section('content')
<!-- Page-wrapper-Start -->
<div class="page_wrapper">
    @if($page->slug === 'contact')
        <!-- Contact Us Section Start -->
        <section class="contact_section">
            <div class="container">
                <div class="section_title" data-aos="fade-up" data-aos-duration="1500">
                    <span class="title_badge">{{ $page->badge_text ?? 'Contactez Nous' }}</span>
                    <h2>{!! $page->title ?? 'Une question ? <span>Discutons-en</span>' !!}</h2>
                    @if($page->subtitle)
                    <p>{!! $page->subtitle !!}</p>
                    @else
                    <p>Vous avez besoin d'aide, d'informations ou souhaitez en savoir plus sur nos services ? <br>
                        Notre équipe est là pour vous accompagner. N'hésitez pas à nous contacter, nous vous répondrons dans les plus brefs délais.</p>
                    @endif
                </div>
                @include('pages.contact-content')
            </div>
        </section>
        <!-- Contact Us Section End -->
    @elseif($page->slug === 'faq')
        <!-- FAQ Tab Section Start -->
        <section class="row_am faq_section">
            <div class="container">
                <div class="section_title" data-aos="fade-up" data-aos-duration="1500">
                    <span class="title_badge">{{ $page->badge_text ?? 'Question & Réponse' }}</span>
                    <h2>{!! $page->title ?? '<span>FAQs</span> - Foire aux questions' !!}</h2>
                    @if($page->subtitle)
                    <p>{!! $page->subtitle !!}</p>
                    @endif
                </div>
                @php
                    $faqs = \App\Models\FaqQuestion::published()->ordered()->get()->groupBy('category');
                @endphp
                @include('pages.faq-content', ['faqs' => $faqs])
            </div>
        </section>
        <!-- FAQ Tab Section End -->
    @elseif($page->slug === 'a-propos')
        @include('pages.about-content')
    @else
        <section class="contact_section">
            <div class="container">
                <div class="section_title" data-aos="fade-up" data-aos-duration="1500">
                    <span class="title_badge mb-1">{{ $page->title }}</span>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div data-aos="fade-up" data-aos-duration="1500">
                            {!! $page->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
</div>
<!-- Page-wrapper-End -->
@endsection
