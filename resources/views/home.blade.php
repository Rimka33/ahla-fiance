@extends('layouts.app')

@section('title', $settings->site_name ?? 'Ahla Finance')

@push('styles')
<style>
    #typed {
        min-height: 60px;
    }
</style>
@endpush

@section('content')
@php
    $androidLink = $downloadLinks->where('platform', 'android')->first();
    $iosLink = $downloadLinks->where('platform', 'ios')->first();
@endphp
    <!-- Banner-Section-Start -->
    <section class="banner_section">
        <!-- container start -->
        <div class="container">
            <!-- row start -->
            <div class="row">
                <div class="col-lg-6 col-md-12" data-aos="fade-up" data-aos-duration="1500">
                    <!-- banner text -->
                    <div class="banner_text">
                        <!-- typed text -->
                        <div class="type-wrap">
                            <span id="typed" style="white-space:pre;" class="typed"></span>
                        </div>
                        <!-- h1 -->
                        <h1>{{ $heroSection->main_title ?? 'Votre solution mobile pour payer, envoyer, échanger' }}</h1>
                        <!-- p -->
                        <p>{{ $heroSection->description ?? 'Ahla Finance Digitale est une fintech tchadienne qui révolutionne l\'accès aux services financiers à travers une application intuitive et sécurisée.' }}</p>
                    </div>

                    <!-- users -->
                    <div class="used_app">
                        <ul>
                            <li><img src="{{ static_image('banavt1.png') }}" alt="image"></li>
                            <li><img src="{{ static_image('banavt2.png') }}" alt="image"></li>
                            <li><img src="{{ static_image('banavt3.png') }}" alt="image"></li>
                            <li>
                                @if($heroSection && $heroSection->video_url)
                                <a href="#" class="popup-youtube play-button" data-url="{{ $heroSection->video_url }}" data-toggle="modal" data-target="#myModal">
                                    <img src="{{ static_image('play.svg') }}" alt="img">
                                </a>
                                @else
                                <a href="#" class="popup-youtube play-button" data-url="https://www.youtube.com/embed/tgbNymZ7vqY?autoplay=1&mute=1" data-toggle="modal" data-target="#myModal">
                                    <img src="{{ static_image('play.svg') }}" alt="img">
                                </a>
                                @endif
                            </li>
                        </ul>
                        <h3>{{ $usedAppText->title ?? 'Une solution déjà adoptée au Tchad' }}</h3>
                        <p>{{ $usedAppText->content ?? 'Rejoignez le mouvement vers une finance plus simple et accessible' }}</p>
                    </div>

                    <!-- app buttons -->
                    <ul class="app_btn">
                        @if($androidLink)
                        <li>
                            <a href="{{ $androidLink->url }}">
                                <img class="blue_img" src="{{ asset($androidLink->icon ?? 'images/googleplay.png') }}" alt="image">
                            </a>
                        </li>
                        @endif
                        @if($iosLink)
                        <li>
                            <a href="{{ $iosLink->url }}">
                                <img class="blue_img" src="{{ asset($iosLink->icon ?? 'images/appstorebtn.png') }}" alt="image">
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>

                <!-- banner slides start -->
                <div class="col-lg-6 col-md-12">
                    <div class="banner_slider">
                        <div class="left_icon">
                            <img src="{{ static_image('smallStar.png') }}" alt="image">
                        </div>
                        <div class="right_icon">
                            <img src="{{ static_image('bigstar.png') }}" alt="image">
                        </div>
                        <div id="frmae_slider" class="owl-carousel owl-theme">
                            <div class="item">
                                <div class="slider_img">
                                    <img src="{{ static_image('bannerScreen1.png') }}" alt="image">
                                </div>
                            </div>
                            <div class="item">
                                <div class="slider_img">
                                    <img src="{{ static_image('bannerScreen2.png') }}" alt="image">
                                </div>
                            </div>
                            <div class="item">
                                <div class="slider_img">
                                    <img src="{{ static_image('bannerScreen3.png') }}" alt="image">
                                </div>
                            </div>
                            <div class="item">
                                <div class="slider_img">
                                    <img src="{{ static_image('bannerScreen4.png') }}" alt="image">
                                </div>
                            </div>
                            <div class="item">
                                <div class="slider_img">
                                    <img src="{{ static_image('bannerScreen5.png') }}" alt="image">
                                </div>
                            </div>
                        </div>
                        <div class="slider_frame">
                            <img src="{{ static_image('iphonescren.png') }}" alt="image">
                        </div>
                    </div>
                </div>
                <!-- banner slides end -->
            </div>
            <!-- row end -->
        </div>
        <!-- container end -->
    </section>
    <!-- Banner-Section-end -->

    <!-- Task-App-Section-Start -->
    <section class="row_am task_app_section">
        @if($features && $features->count() > 0)
            @foreach($features as $index => $feature)
            <!-- Task Block start -->
            <div class="task_block">
                <div class="dotes_blue"><img src="{{ static_image('blue_dotes.png') }}" alt="image"></div>
                <!-- row start -->
                <div class="row">
                    <div class="col-md-6">
                        <!-- task images -->
                        <div class="task_img" data-aos="fade-in" data-aos-duration="1500">
                            <div class="frame_img">
                                <img src="{{ asset($feature->image_frame ?? 'images/feature' . ($index + 1) . 'a.png') }}" alt="image">
                            </div>
                            <div class="screen_img">
                                <img class="moving_animation" src="{{ asset($feature->image_screen ?? 'images/feature' . ($index + 1) . 'b.png') }}" alt="image">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- task text -->
                        <div class="task_text">
                            <div class="section_title white_text" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="100">
                                <span class="title_badge">Nos solutions digitales</span>
                                @if($feature->icon)
                                <span class="icon">
                                    <img src="{{ asset($feature->icon) }}" alt="image">
                                </span>
                                @endif
                                <h2>{{ $feature->title }}</h2>
                                <p>{{ $feature->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- row end -->
            </div>
            <!-- Task Block end -->
            @endforeach
        @else
            <!-- Default Task Block 1 -->
            <div class="task_block">
                <div class="dotes_blue"><img src="{{ static_image('blue_dotes.png') }}" alt="image"></div>
                <!-- row start -->
                <div class="row">
                    <div class="col-md-6">
                        <!-- task images -->
                        <div class="task_img" data-aos="fade-in" data-aos-duration="1500">
                            <div class="frame_img">
                                <img src="{{ asset('images/feature1a.png') }}" alt="image">
                            </div>
                            <div class="screen_img">
                                <img class="moving_animation" src="{{ asset('images/feature1b.png') }}" alt="image">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- task text -->
                        <div class="task_text">
                            <div class="section_title white_text" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="100">
                                <span class="title_badge">Nos solutions digitales</span>
                                <span class="icon">
                                    <img src="{{ static_image('recharge.png') }}" alt="image">
                                </span>
                                <h2>Transférez et payez en toute simplicité</h2>
                                <p>Effectuez vos transferts d'argent et paiements mobiles en quelques secondes, où que vous soyez. Grâce à une interface intuitive, Ahla rend les transactions rapides, sûres et accessibles à tous.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- row end -->
            </div>
            <!-- Task Block end -->

            <!-- Default Task Block 2 -->
            <div class="task_block">
                <div class="dotes_blue"><img src="{{ static_image('blue_dotes.png') }}" alt="image"></div>
                <!-- row start -->
                <div class="row">
                    <div class="col-md-6">
                        <!-- task images -->
                        <div class="task_img" data-aos="fade-in" data-aos-duration="1500">
                            <div class="frame_img">
                                <img src="{{ asset('images/feature2a.png') }}" alt="image">
                            </div>
                            <div class="screen_img">
                                <img class="moving_animation" src="{{ asset('images/feature2b.png') }}" alt="image">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- task text -->
                        <div class="task_text">
                            <div class="section_title white_text" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="100">
                                <span class="title_badge">Nos solutions digitales</span>
                                <span class="icon">
                                    <img src="{{ static_image('echange.png') }}" alt="image">
                                </span>
                                <h2>Convertissez vos devises en toute confiance</h2>
                                <p>Avec notre outil intégré de change, échangez vos devises au meilleur taux du marché local. Plus besoin de se déplacer, tout se fait directement depuis l'application, en toute transparence.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- row end -->
            </div>
            <!-- Task Block end -->

            <!-- Default Task Block 3 -->
            <div class="task_block">
                <div class="dotes_blue"><img src="{{ static_image('blue_dotes.png') }}" alt="image"></div>
                <!-- row start -->
                <div class="row">
                    <div class="col-md-6">
                        <!-- task images -->
                        <div class="task_img" data-aos="fade-in" data-aos-duration="1500">
                            <div class="frame_img">
                                <img src="{{ asset('images/feature3a.png') }}" alt="image">
                            </div>
                            <div class="screen_img">
                                <img class="moving_animation" src="{{ asset('images/feature3b.png') }}" alt="image">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- task text -->
                        <div class="task_text">
                            <div class="section_title white_text" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="100">
                                <span class="title_badge">Nos solutions digitales</span>
                                <span class="icon">
                                    <img src="{{ static_image('qr.png') }}" alt="image">
                                </span>
                                <h2>Paiements rapides par QR Code</h2>
                                <p>Réglez vos achats en un scan grâce au QR code sécurisé. Une solution moderne pour les commerces et les clients, sans besoin de contact ni d'espèces. Rapide, pratique et sans stress.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- row end -->
            </div>
            <!-- Task Block end -->
        @endif
    </section>
    <!-- Task-App-Section-end -->

    <!-- Page Wraper -->
    <div class="page_wrapper">

        <!-- About Us Start-->
        <section class="about_section row_am">
            <div class="container">
                <div class="section_title" data-aos="fade-up" data-aos-duration="1500">
                    <span class="title_badge mb-1">{{ $aboutSection->badge_text ?? 'À propos de nous' }}</span>
                    <h2>{!! $aboutSection->title ?? 'Une interface fluide qui transforme <span>les visiteurs</span> en <span>utilisateurs engagés</span>' !!}</h2>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <ul class="app_statstic" id="counter" data-aos="fade-in" data-aos-duration="1500">
                            <li data-aos="fade-up" data-aos-duration="1500">
                                <div class="text">
                                    <p><span class="counter-value" data-count="{{ $statistics->users_count ?? 25 }}">0</span><span>{{ $statistics->users_suffix ?? 'M+' }}</span></p>
                                    <p>Utilisateurs</p>
                                </div>
                            </li>
                            <li data-aos="fade-up" data-aos-duration="1500">
                                <div class="text">
                                    <p><span class="counter-value" data-count="{{ $statistics->reviews_count ?? 1500 }}">0</span><span>{{ $statistics->reviews_suffix ?? '+' }}</span></p>
                                    <p>Avis</p>
                                </div>
                            </li>
                            <li data-aos="fade-up" data-aos-duration="1500">
                                <div class="text">
                                    <p><span class="counter-value" data-count="{{ $statistics->countries_count ?? 1 }}">0</span><span>{{ $statistics->countries_suffix ?? '+' }}</span></p>
                                    <p>Pays</p>
                                </div>
                            </li>
                            <li data-aos="fade-up" data-aos-duration="1500">
                                <div class="text">
                                    <p><span class="counter-value" data-count="{{ $statistics->subscribers_count ?? 8 }}">0</span><span>{{ $statistics->subscribers_suffix ?? 'M+' }}</span></p>
                                    <p>Abonnés</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="abtImg text-center" data-aos="fade-up" data-aos-duration="1500">
                            @if($aboutSection && !empty($aboutSection->image))
                                @php
                                    // Si l'image commence déjà par "storage/", utiliser directement
                                    if (str_starts_with($aboutSection->image, 'storage/')) {
                                        $imagePath = asset($aboutSection->image);
                                    }
                                    // Si l'image commence par "home-sections/", ajouter "storage/" devant
                                    elseif (str_starts_with($aboutSection->image, 'home-sections/')) {
                                        $imagePath = asset('storage/' . $aboutSection->image);
                                    }
                                    // Sinon, utiliser directement (pour images/ dans public)
                                    else {
                                        $imagePath = asset($aboutSection->image);
                                    }
                                @endphp
                                <img src="{{ $imagePath }}" alt="image">
                            @else
                                <img src="{{ static_image('appscreen.png') }}" alt="image">
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <p data-aos="fade-up" data-aos-duration="1500">{{ $aboutSection->content ?? $aboutSection->description ?? 'Ahla Finance Digitale révolutionne les services financiers au Tchad en offrant une plateforme numérique simple et intuitive, permettant à chaque utilisateur d\'accéder aux services de transfert d\'argent, paiement mobile, change de devises, et bien plus.' }}</p>
                        @if($aboutSection && !empty($aboutSection->video_thumbnail))
                            @php
                                // Si la thumbnail commence déjà par "storage/", utiliser directement
                                if (str_starts_with($aboutSection->video_thumbnail, 'storage/')) {
                                    $thumbnailPath = asset($aboutSection->video_thumbnail);
                                }
                                // Si la thumbnail commence par "home-sections/", ajouter "storage/" devant
                                elseif (str_starts_with($aboutSection->video_thumbnail, 'home-sections/')) {
                                    $thumbnailPath = asset('storage/' . $aboutSection->video_thumbnail);
                                }
                                // Sinon, utiliser directement (pour images/ dans public)
                                else {
                                    $thumbnailPath = asset($aboutSection->video_thumbnail);
                                }
                            @endphp
                            <div class="video_block" data-aos="fade-up" data-aos-duration="1500">
                                <img class="thumbnil" src="{{ $thumbnailPath }}" alt="image">
                            </div>
                        @else
                            <div class="video_block" data-aos="fade-up" data-aos-duration="1500">
                                <img class="thumbnil" src="{{ static_image('applicationvideothumb.png') }}" alt="image">
                            </div>
                        @endif
                        @if($aboutSection && $aboutSection->button_text)
                        <div class="btn_block" data-aos="fade-up" data-aos-duration="1500">
                            <a href="{{ $aboutSection->button_link ?? '#' }}" class="btn puprple_btn ml-0">{{ $aboutSection->button_text }}</a>
                            <div class="btn_bottom"></div>
                        </div>
                        @else
                        <div class="btn_block" data-aos="fade-up" data-aos-duration="1500">
                            <a href="#" class="btn puprple_btn ml-0">ESSAYER GRATUITEMENT</a>
                            <div class="btn_bottom"></div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <!-- About Us End -->
        <section class="our_value_section home_page row_am">
            <div class="our_value_innner">
                <div class="container">
                    <div class="section_title" data-aos="fade-up" data-aos-duration="1500">
                        <h2><span>Nous vous </span>offrons</h2>
                    </div>
                    <!-- Value Slider Start -->
                    @if($valuePropositions && $valuePropositions->count() > 0)
                    <div class="value_slider" data-aos="fade-in" data-aos-duration="1500">
                        <div class="owl-carousel owl-theme" id="value_slider">
                            @foreach($valuePropositions as $value)
                            <div class="item">
                                <div class="value_block">
                                    <div class="icon">
                                        @if($value->icon)
                                        <img src="{{ asset('storage/' . $value->icon) }}" alt="{{ $value->title }}">
                                        @else
                                        <img src="{{ static_image('ergonome.png') }}" alt="{{ $value->title }}">
                                        @endif
                                    </div>
                                    <div class="text">
                                        <h3>{{ $value->title }}</h3>
                                        <p>{{ $value->description }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @else
                    <!-- Fallback avec contenu statique par défaut -->
                    <div class="value_slider" data-aos="fade-in" data-aos-duration="1500">
                        <div class="owl-carousel owl-theme" id="value_slider">
                            <div class="item">
                                <div class="value_block">
                                    <div class="icon">
                                        <img src="{{ asset('images/ergonome.png') }}" alt="image">
                                    </div>
                                    <div class="text">
                                        <h3>Ergonomie pensée pour tous</h3>
                                        <p>L'application Ahla est intuitive et facile à utiliser, accessible à tous dès la première utilisation.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="value_block">
                                    <div class="icon">
                                        <img src="{{ static_image('security.png') }}" alt="image">
                                    </div>
                                    <div class="text">
                                        <h3>Sécurité certifiée</h3>
                                        <p>Nous respectons les normes internationales pour garantir la protection de vos données.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="value_block">
                                    <div class="icon">
                                        <img src="{{ static_image('support.png') }}" alt="image">
                                    </div>
                                    <div class="text">
                                        <h3>Support à votre écoute</h3>
                                        <p>Notre service client est disponible 7 jours sur 7, prêt à vous assister à tout moment.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <!-- Value Slider End -->
                </div>
            </div>
        </section>

        <!-- How It Work Section Start -->
        <section class="how_it_section white_text">
            <div class="how_it_inner" data-aos="fade-in" data-aos-duration="1500">
                <div class="dotes_blue"><img src="{{ static_image('blue_dotes.png') }}" alt="image"></div>
                <div class="container">
                    <div class="section_title" data-aos="fade-up" data-aos-duration="1500">
                        <span class="title_badge">{{ $howItWorksHeader->badge_text ?? 'Rapide et facile' }}</span>
                        <h2>{{ $howItWorksHeader->title ?? 'Comment ça fonctionne en 3 étapes' }}</h2>
                    </div>
                    <div class="row">
                        @if($howItWorkSteps && $howItWorkSteps->count() > 0)
                            @foreach($howItWorkSteps as $step)
                            <div class="col-md-4">
                                <div class="steps_block {{ $loop->last ? '' : 'step_border' }}" data-aos="fade-up" data-aos-duration="1500">
                                    <div class="steps">
                                        <div class="icon">
                                            @if($step->icon)
                                            <img src="{{ asset('storage/' . $step->icon) }}" alt="{{ $step->title }}">
                                            @else
                                            <img src="{{ static_image('howstep' . $step->step_number . '.png') }}" alt="{{ $step->title }}">
                                            @endif
                                        </div>
                                        <div class="text">
                                            <h3>{{ $step->title }}</h3>
                                            @if($step->tag_text)
                                            <span class="tag_text">{{ $step->tag_text }}</span>
                                            @endif
                                            @if($step->step_number == 1)
                                            <ul class="social">
                                                @if($androidLink)
                                                <li><a href="{{ $androidLink->url }}"><i class="icofont-brand-android-robot"></i></a></li>
                                                @endif
                                                @if($iosLink)
                                                <li><a href="{{ $iosLink->url }}"><i class="icofont-brand-apple"></i></a></li>
                                                @endif
                                            </ul>
                                            @endif
                                            <p>{!! nl2br(e($step->description)) !!}</p>
                                        </div>
                                    </div>
                                    <span class="step">{{ str_pad($step->step_number, 2, '0', STR_PAD_LEFT) }}</span>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <!-- Fallback avec étapes par défaut -->
                            <div class="col-md-4">
                                <div class="steps_block step_border" data-aos="fade-up" data-aos-duration="1500">
                                    <div class="steps">
                                        <div class="icon">
                                            <img src="{{ static_image('howstep1.png') }}" alt="image">
                                        </div>
                                        <div class="text">
                                            <h3>Téléchargez l'app</h3>
                                            <ul class="social">
                                                @if($androidLink)
                                                <li><a href="{{ $androidLink->url }}"><i class="icofont-brand-android-robot"></i></a></li>
                                                @endif
                                                @if($iosLink)
                                                <li><a href="{{ $iosLink->url }}"><i class="icofont-brand-apple"></i></a></li>
                                                @endif
                                            </ul>
                                            <p>Téléchargez l'application. Elle est disponible pour <br> Android, Mac et Windows.</p>
                                        </div>
                                    </div>
                                    <span class="step">01</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="steps_block step_border" data-aos="fade-up" data-aos-duration="1500">
                                    <div class="steps">
                                        <div class="icon">
                                            <img src="{{ static_image('howstep2.png') }}" alt="image">
                                        </div>
                                        <div class="text">
                                            <h3>Créez votre compte</h3>
                                            <span class="tag_text">La création de compte est gratuite</span>
                                            <p>Inscrivez-vous gratuitement <br> pour la période d'essai.</p>
                                        </div>
                                    </div>
                                    <span class="step">02</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="steps_block" data-aos="fade-up" data-aos-duration="1500">
                                    <div class="steps">
                                        <div class="icon">
                                            <img src="{{ static_image('howstep3.png') }}" alt="image">
                                        </div>
                                        <div class="text">
                                            <h3>Profitez de l'application</h3>
                                            <span class="tag_text">Consultez la FAQ pour toute question</span>
                                            <p>Profitez de notre application et partagez <br> votre expérience incroyable.</p>
                                        </div>
                                    </div>
                                    <span class="step">03</span>
                                </div>
                            </div>
                        @endif
                    </div>
                    @if($howItWorksHeader && $howItWorksHeader->button_text)
                    <div class="text-center">
                        <div class="btn_block">
                            <a href="{{ $howItWorksHeader->button_link ?? '#' }}" class="btn puprple_btn ml-0">{{ $howItWorksHeader->button_text }}</a>
                            <div class="btn_bottom"></div>
                        </div>
                    </div>
                    @else
                    <div class="text-center">
                        <div class="btn_block">
                            <a href="#" class="btn puprple_btn ml-0">Commencez maintenant</a>
                            <div class="btn_bottom"></div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </section>
        <!-- How It Work Section End -->
    </div>
    <!-- Wraper End -->

    <!-- Positive Reviews Section Start -->
    @if($testimonials && $testimonials->count() > 0)
    <section class="row_am testimonial_section">
        <div class="container">
            <div class="section_title" data-aos="fade-up" data-aos-duration="1500">
                <span class="title_badge">Témoignages</span>
                <h2>Ce que <span>disent nos utilisateurs</span></h2>
            </div>
            <div class="testimonial_slider" data-aos="fade-up" data-aos-duration="1500">
                <div id="testimonial_slider" class="owl-carousel owl-theme">
                    @foreach($testimonials as $testimonial)
                    <div class="item">
                        <div class="testimonial_block">
                            <div class="testimonial_img">
                                @if($testimonial->photo)
                                <img src="{{ asset($testimonial->photo) }}" alt="{{ $testimonial->client_name }}">
                                @else
                                <img src="{{ static_image('usericon.png') }}" alt="{{ $testimonial->client_name }}">
                                @endif
                            </div>
                            <div class="testimonial_content">
                                <div class="stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $testimonial->rating)
                                            <i class="icofont-star"></i>
                                        @else
                                            <i class="icofont-star empty"></i>
                                        @endif
                                    @endfor
                                </div>
                                <p>{!! $testimonial->testimonial_text !!}</p>
                                <h4>{{ $testimonial->client_name }}</h4>
                                @if($testimonial->date)
                                <span>{{ $testimonial->date->format('d/m/Y') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Positive Reviews Section End -->
    @endif

    <!-- Page Wraper -->
    <div class="page_wrapper">
        <!-- Beautifull-interface-Section start -->
        <section class="row_am interface_section">
            <!-- container start -->
            <div class="container-fluid">
                <div class="section_title" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="300">
                    <span class="title_badge">{{ $interfaceSection->badge_text ?? 'Ecrans de l\'application' }}</span>
                    <h2>{!! $interfaceSection->title ?? 'Découvrez <span>les interface</span> de Ahla Finance' !!}</h2>
                </div>

                <!-- screen slider start -->
                <div class="screen_slider" data-aos="fade-up" data-aos-duration="1500">
                    <div id="screen_slider" class="owl-carousel owl-theme">
                        @if($appScreenshots && $appScreenshots->count() > 0)
                            @foreach($appScreenshots as $screenshot)
                            <div class="item">
                                <div class="screen_frame_img">
                                    <img src="{{ asset('storage/' . $screenshot->image) }}" alt="{{ $screenshot->title ?? 'Screenshot' }}">
                                </div>
                            </div>
                            @endforeach
                        @else
                            <!-- Fallback avec images par défaut -->
                            @for($i = 1; $i <= 9; $i++)
                            <div class="item">
                                <div class="screen_frame_img">
                                    <img src="{{ static_image('intrscrn' . $i . '.png') }}" alt="image">
                                </div>
                            </div>
                            @endfor
                        @endif
                    </div>
                </div>
                <!-- screen slider end -->
            </div>
            <!-- container end -->
        </section>
        <!-- Beautifull-interface-Section end -->
    </div>
    <!-- Page-wrapper-End -->
@endsection

@push('scripts')
<script>
    $("#typed").typed({
        strings: {!! json_encode($heroSection->typed_strings ?? ["Simplifiez vos transactions.", "Gérez vos finances.", "Transformez votre quotidien."]) !!},
        typeSpeed: 100,
        startDelay: 0,
        backSpeed: 60,
        backDelay: 2000,
        loop: true,
        cursorChar: "|",
        contentType: 'html'
    });

    // Fixed Discount Dish JS
    $(document).ready(function() {
        let cardBlock = document.querySelectorAll('.task_block');
        let topStyle = 120;

        cardBlock.forEach((card) => {
            card.style.top = `${topStyle}px`;
            topStyle += 30;
        })
    });

    // Scroll Down Window
    $(document).ready(function() {
        $('#scrollButton').click(function() {
            $('html, body').animate({
                scrollTop: $(window).scrollTop() + 600
            }, 800);
        });
    });
</script>
@endpush



