<div>
    <!-- Page-wrapper-Start -->
    <section class="contact_section">
        <div class="container">
            <div class="section_title" data-aos="fade-up" data-aos-duration="1500">
                <span class="title_badge mb-1">{{ $page->badge_text ?? 'À propos' }}</span>
                <h2>{!! $page->title ?? 'Découvrez <span>Ahla Finance</span>' !!}</h2>
                @if($page->subtitle)
                <p>{{ $page->subtitle }}</p>
                @else
                <p>Qui sommes-nous, quelle est notre mission, et quels sont nos engagements envers vous ?</p>
                @endif
            </div>
        </div>
    </section>
    <section class="ahlaa_about_section">
        <div class="">
            <div class="row">
                <!-- Contenu gauche : onglets + contenus -->
                <div class="col-lg-9">
                    <div class="ahlaa_tabbar">
                        <ul class="nav nav-tabs ahlaa_tab_menu" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#presentation" role="tab">
                                    <i class="fas fa-info-circle mr-2"></i>Présentation
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#pourquoi" role="tab">
                                    <i class="fas fa-check-circle mr-2"></i>Pourquoi Ahla
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#engagements" role="tab">
                                    <i class="fas fa-handshake mr-2"></i>Nos engagements
                                </a>
                            </li>
                        </ul>

                        <!-- Tab content -->
                        <div class="tab-content ahlaa_tab_content">
                            <!-- Présentation -->
                            <div class="tab-pane fade show active" id="presentation" role="tabpanel">
                                @if($page->presentation_who)
                                    <h3>Qui sommes-nous ?</h3>
                                    <div>{!! $page->presentation_who !!}</div>
                                @else
                                    <h3>Qui sommes-nous ?</h3>
                                    <p>
                                        Ahla est une équipe jeune, dynamique et passionnée, née de la volonté de répondre aux enjeux financiers au Tchad.
                                        Nous concevons des outils numériques accessibles et fiables pour accompagner chacun au quotidien.
                                    </p>
                                @endif

                                @if($page->presentation_mission)
                                    <h3>Notre mission</h3>
                                    <div>{!! $page->presentation_mission !!}</div>
                                @else
                                    <h3>Notre mission</h3>
                                    <p>
                                        Offrir à nos utilisateurs une expérience fluide, sécurisée et inclusive pour la gestion de leurs transactions et de leur budget, tout en
                                        tenant compte des réalités locales.
                                    </p>
                                @endif

                                @if($page->presentation_vision)
                                    <h3>Notre vision</h3>
                                    <div>{!! $page->presentation_vision !!}</div>
                                @else
                                    <h3>Notre vision</h3>
                                    <p>
                                        Être une référence en matière de solutions financières numériques sur le continent africain, en misant sur l'innovation, l'accessibilité
                                        et la confiance.
                                    </p>
                                @endif
                            </div>

                            <!-- Pourquoi choisir Ahlaa -->
                            <div class="tab-pane fade" id="pourquoi" role="tabpanel">
                                @if($page->why_content)
                                    <h3>Pourquoi choisir Ahla ?</h3>
                                    <div>{!! $page->why_content !!}</div>
                                @else
                                    <h3>Pourquoi choisir Ahla ?</h3>
                                    <p>
                                        Choisir Ahla, c'est opter pour une solution financière conçue pour vous, avec vous. Contrairement aux plateformes généralistes, nous avons
                                        fait le choix de construire une expérience utilisateur pensée spécifiquement pour les besoins et réalités des utilisateurs africains.
                                    </p>
                                    <p>
                                        Nous plaçons l'humain au cœur de notre démarche. Derrière chaque fonctionnalité se cache une réflexion profonde sur la simplicité d'usage,
                                        la sécurité des données et la rapidité des transactions. En intégrant des fonctionnalités accessibles à tous et en assurant un support
                                        de proximité, nous visons à créer un lien de confiance durable avec notre communauté.
                                    </p>
                                    <p>
                                        Ahla, c'est aussi un engagement technologique permanent. Nous améliorons continuellement notre plateforme pour vous offrir un service
                                        toujours plus fluide, plus intuitif et plus efficace.
                                    </p>
                                @endif
                            </div>

                            <!-- Nos engagements -->
                            <div class="tab-pane fade" id="engagements" role="tabpanel">
                                @if($page->engagements_content)
                                    <h3>Nos engagements</h3>
                                    <div>{!! $page->engagements_content !!}</div>
                                @else
                                    <h3>Nos engagements</h3>
                                    <p>
                                        Chez Ahla, nous croyons que la confiance se construit dans la durée. C'est pourquoi nous nous engageons à toujours faire preuve de
                                        transparence, aussi bien dans nos services que dans nos communications. Vous savez toujours où vont vos données, comment sont calculés
                                        les frais, et à quoi vous attendre.
                                    </p>
                                    <p>
                                        Nous nous engageons également à rendre notre solution accessible au plus grand nombre. Cela signifie une interface simple, des frais
                                        maîtrisés et un accompagnement personnalisé. L'objectif : faire en sorte que chacun, quel que soit son niveau de familiarité avec la
                                        technologie, puisse tirer pleinement parti de notre plateforme.
                                    </p>
                                    <p>
                                        Enfin, nous nous engageons à toujours écouter notre communauté. Vos retours guident nos décisions. Chaque mise à jour, chaque
                                        amélioration provient de vos expériences, de vos besoins et de vos suggestions.
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Colonne droite : image avec élément décoratif -->
                <div class="col-lg-3">
                    <div class="">
                        <img src="{{ static_image('apropos.png') }}" alt="image">
                    </div>
                </div>
            </div>
        </div>
    </section>

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
                            <img src="{{ static_image('our_app.png') }}" alt="Image de l'application mobile Ahlaa">
                        </div>
                    </div>
                </div>
            </div>
            <!-- row end -->
        </div>
        <!-- Task Block end -->
    </section>
</div>

