@php
    // Si on est dans la vue show.blade.php, les faqs ne sont pas passées
    // Sinon elles sont passées depuis SiteController@faq
    if (!isset($faqs)) {
        $faqs = \App\Models\FaqQuestion::published()->ordered()->get()->groupBy('category');
    }
@endphp

<div class="faq_blocks" data-aos="fade-up" data-aos-duration="1500">
    @if($faqs->count() > 0)
        @foreach($faqs as $category => $categoryFaqs)
            @if($category)
                <h3 class="faq-category-title mt-4 mb-3" style="font-size: 1.75rem; font-weight: 700; color: #2c3e50; margin-top: 2rem !important; margin-bottom: 1.5rem !important; padding-bottom: 0.75rem; border-bottom: 3px solid #2E64BA;">{{ $category }}</h3>
            @endif
            <div class="accordion" id="accordion{{ $category ? Str::slug($category) : 'main' }}">
        <div class="row">
                    @foreach($categoryFaqs as $index => $faq)
                        <div class="col-md-6 mb-3">
                            <div class="card" style="border: none; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); overflow: hidden; margin-bottom: 1rem;">
                                <div class="card-header" id="heading{{ $faq->id }}" style="background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%); padding: 0; border: none;">
                        <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left {{ $index === 0 ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ $faq->id }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $faq->id }}"
                                            style="width: 100%; padding: 1.25rem 1.5rem; text-align: left; text-decoration: none; color: #2c3e50; font-weight: 600; font-size: 1.05rem; border: none; background: none; display: flex; justify-content: space-between; align-items: center; transition: all 0.3s ease;">
                                            <span style="flex: 1; padding-right: 1rem;">{{ $faq->question }}</span>
                                            <span class="icons" style="flex-shrink: 0; display: flex; align-items: center; gap: 0.25rem;">
                                                <i class="icofont-plus" style="display: {{ $index === 0 ? 'none' : 'block' }}; font-size: 1.2rem; color: #2E64BA; transition: transform 0.3s ease;"></i>
                                                <i class="icofont-minus" style="display: {{ $index === 0 ? 'block' : 'none' }}; font-size: 1.2rem; color: #2E64BA;"></i>
                                            </span>
                            </button>
                        </h2>
                    </div>
                                <div id="collapse{{ $faq->id }}" class="collapse {{ $index === 0 ? 'show' : '' }}" aria-labelledby="heading{{ $faq->id }}" data-bs-parent="#accordion{{ $category ? Str::slug($category) : 'main' }}">
                                    <div class="card-body" style="padding: 1.5rem; background: white; color: #495057; line-height: 1.7; font-size: 0.95rem;">
                                        {!! nl2br(e($faq->answer)) !!}
                        </div>
                    </div>
                </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <style>
                .accordion .btn-link:hover {
                    background: rgba(46, 100, 186, 0.05) !important;
                }
                .accordion .btn-link:not(.collapsed) {
                    background: rgba(46, 100, 186, 0.08) !important;
                    color: #2E64BA !important;
                }
                .accordion .card {
                    transition: box-shadow 0.3s ease;
                }
                .accordion .card:hover {
                    box-shadow: 0 4px 12px rgba(0,0,0,0.12) !important;
                }
                .accordion .collapse.show ~ .card-header .btn-link .icons .icofont-plus,
                .accordion .btn-link:not(.collapsed) .icons .icofont-plus {
                    display: none !important;
                }
                .accordion .collapse.show ~ .card-header .btn-link .icons .icofont-minus,
                .accordion .btn-link:not(.collapsed) .icons .icofont-minus {
                    display: block !important;
                }
            </style>
        @endforeach
    @else
        <div class="text-center py-5" style="padding: 4rem 2rem;">
            <i class="icofont-question-circle" style="font-size: 4rem; color: #dee2e6; margin-bottom: 1rem;"></i>
            <h3 style="color: #6c757d; margin-bottom: 0.5rem;">Aucune question FAQ disponible</h3>
            <p style="color: #adb5bd;">Pour le moment, aucune question n'a été publiée.</p>
        </div>
    @endif
</div>

<!-- Section "Poser une question" -->
<div class="ask_question_section mt-5" data-aos="fade-up" data-aos-duration="1500" style="margin-top: 4rem !important;">
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card shadow-sm" style="border: none; border-radius: 16px; box-shadow: 0 4px 16px rgba(0,0,0,0.1) !important; overflow: hidden;">
                    <div class="card-body p-4" style="padding: 2.5rem !important;">
                        <div class="section_title text-center mb-4">
                            <span class="title_badge">Vous avez une question ?</span>
                            <h3 style="font-size: 1.75rem; font-weight: 700; color: #2c3e50; margin: 1rem 0;">Posez votre question</h3>
                            <p style="color: #6c757d; font-size: 1rem;">Nous répondrons à votre question dans les plus brefs délais.</p>
                        </div>
                        <form action="{{ route('contact.submit') }}" method="POST" id="faq-question-form">
                            @csrf
                            <input type="hidden" name="question" value="1">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input type="text" name="name" class="form-control" placeholder="Votre nom *" required style="border-radius: 10px; padding: 0.75rem 1.25rem; border: 2px solid #e9ecef; transition: border-color 0.3s ease;">
                    </div>
                                <div class="col-md-6 mb-3">
                                    <input type="email" name="email" class="form-control" placeholder="Votre email *" required style="border-radius: 10px; padding: 0.75rem 1.25rem; border: 2px solid #e9ecef; transition: border-color 0.3s ease;">
                </div>
                                <div class="col-md-12 mb-3">
                                    <textarea name="message" class="form-control" rows="4" placeholder="Votre question *" required style="border-radius: 10px; padding: 0.75rem 1.25rem; border: 2px solid #e9ecef; transition: border-color 0.3s ease;"></textarea>
                    </div>
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn puprple_btn" style="padding: 0.875rem 2rem; font-weight: 600; border-radius: 8px;">
                                        Envoyer ma question
                            </button>
                        </div>
                    </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- App-Download-Section-Start -->
<section class="row_am download_app">
    <!-- Task Block start -->
    <div class="task_block" data-aos="fade-up" data-aos-duration="1500">
        <div class="dotes_blue"><img src="{{ static_image('blue_dotes.png') }}" alt="image"></div>
        <!-- row start -->
        <div class="row">
            <div class="col-md-6">
                <!-- task text -->
                <div class="task_text">
                    <div class="section_title white_text" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="100">
                        <span class="title_badge">Téléchargez</span>
                        <h2>Notre application est disponible pour Android & iOS</h2>
                        <p>
                            Ahla vous permet d'envoyer et de recevoir de l'argent, suivre vos dépenses et gérer vos finances au quotidien, en toute simplicité.
                        </p>
                    </div>
                    <!-- app buttons -->
                    <ul class="app_btn" data-aos="fade-up" data-aos-duration="1500">
                        @php
                            $androidLink = \App\Models\DownloadLink::active()->where('platform', 'android')->first();
                            $iosLink = \App\Models\DownloadLink::active()->where('platform', 'ios')->first();
                        @endphp
                        <li>
                            <a href="{{ $androidLink->url ?? '#' }}">
                                <img class="blue_img" src="{{ asset($androidLink->icon ?? 'images/black_google_play.png') }}" alt="Télécharger sur Google Play">
                            </a>
                        </li>
                        <li>
                            <a href="{{ $iosLink->url ?? '#' }}">
                                <img class="blue_img" src="{{ asset($iosLink->icon ?? 'images/black_appstore.png') }}" alt="Télécharger sur l'App Store">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <!-- task images -->
                <div class="task_img" data-aos="fade-in" data-aos-duration="1500">
                    <div class="frame_img">
                        <img src="{{ asset('images/our_app.png') }}" alt="Image de l'application mobile Ahlaa">
                    </div>
                </div>
            </div>
        </div>
        <!-- row end -->
    </div>
    <!-- Task Block end -->
</section>
<!-- App-Download-Section-end -->

<script>
    // Gestion de l'affichage des icônes +/- dans l'accordion
    // Compatible avec Bootstrap 5 et Bootstrap 4
    document.addEventListener('DOMContentLoaded', function() {
        // Essayer Bootstrap 5 d'abord
        const accordionButtons = document.querySelectorAll('[data-bs-toggle="collapse"], [data-toggle="collapse"]');

        accordionButtons.forEach(button => {
            const targetId = button.getAttribute('data-bs-target') || button.getAttribute('data-target');
            const collapse = document.querySelector(targetId);

            if (collapse) {
                // Bootstrap 5 events
                collapse.addEventListener('shown.bs.collapse', function() {
                    updateIcons(button, true);
                });

                collapse.addEventListener('hidden.bs.collapse', function() {
                    updateIcons(button, false);
                });

                // Bootstrap 4 events (fallback)
                $(collapse).on('shown.bs.collapse', function() {
                    updateIcons(button, true);
                });

                $(collapse).on('hidden.bs.collapse', function() {
                    updateIcons(button, false);
                });
            }
        });

        function updateIcons(button, isOpen) {
            const icons = button.querySelector('.icons');
            if (icons) {
                const plusIcon = icons.querySelector('.icofont-plus');
                const minusIcon = icons.querySelector('.icofont-minus');
                if (isOpen) {
                    if (plusIcon) plusIcon.style.display = 'none';
                    if (minusIcon) minusIcon.style.display = 'block';
                } else {
                    if (plusIcon) plusIcon.style.display = 'block';
                    if (minusIcon) minusIcon.style.display = 'none';
                }
            }
        }
    });
</script>
