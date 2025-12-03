@extends('admin.layout')

@section('title', 'Page d\'Accueil')
@section('page-title', 'Modifier la Page d\'Accueil')

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Succès !</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Erreur !</strong> Veuillez corriger les erreurs suivantes :
        <ul class="mb-0 mt-2">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<form method="POST" action="{{ route('admin.home-page.update') }}" enctype="multipart/form-data" id="homePageForm" novalidate>
    @csrf
    @csrf

    <!-- Section Images statiques de la page d'accueil -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="bi bi-images"></i> Images statiques de la page d'accueil</h5>
            <small class="text-white-50">Toutes les images affichées sur la page d'accueil publique peuvent être modifiées ici</small>
        </div>
        <div class="card-body">
            <!-- Section Hero -->
            <div class="mb-4">
                <h6 class="border-bottom pb-2 mb-3"><i class="bi bi-star me-2"></i> Section Hero (Bannière principale)</h6>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <x-admin.static-image-item imageName="banavt1.png" label="Avatar utilisateur 1" />
                    </div>
                    <div class="col-md-3 mb-3">
                        <x-admin.static-image-item imageName="banavt2.png" label="Avatar utilisateur 2" />
                    </div>
                    <div class="col-md-3 mb-3">
                        <x-admin.static-image-item imageName="banavt3.png" label="Avatar utilisateur 3" />
                    </div>
                    <div class="col-md-3 mb-3">
                        <x-admin.static-image-item imageName="play.svg" label="Icône Play" />
                    </div>
                    <div class="col-md-3 mb-3">
                        <x-admin.static-image-item imageName="smallStar.png" label="Petite étoile" />
                    </div>
                    <div class="col-md-3 mb-3">
                        <x-admin.static-image-item imageName="bigstar.png" label="Grande étoile" />
                    </div>
                    <div class="col-md-3 mb-3">
                        <x-admin.static-image-item imageName="iphonescren.png" label="Cadre iPhone" />
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <label class="form-label fw-bold">Screenshots du slider</label>
                    </div>
                    <div class="col-md-2 mb-3">
                        <x-admin.static-image-item imageName="bannerScreen1.png" label="Screenshot 1" />
                    </div>
                    <div class="col-md-2 mb-3">
                        <x-admin.static-image-item imageName="bannerScreen2.png" label="Screenshot 2" />
                    </div>
                    <div class="col-md-2 mb-3">
                        <x-admin.static-image-item imageName="bannerScreen3.png" label="Screenshot 3" />
                    </div>
                    <div class="col-md-2 mb-3">
                        <x-admin.static-image-item imageName="bannerScreen4.png" label="Screenshot 4" />
                    </div>
                    <div class="col-md-2 mb-3">
                        <x-admin.static-image-item imageName="bannerScreen5.png" label="Screenshot 5" />
                    </div>
                </div>
            </div>

            <hr>

            <!-- Section À propos -->
            <div class="mb-4">
                <h6 class="border-bottom pb-2 mb-3"><i class="bi bi-info-circle me-2"></i> Section À propos</h6>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <x-admin.static-image-item imageName="appscreen.png" label="Image principale" />
                    </div>
                    <div class="col-md-4 mb-3">
                        <x-admin.static-image-item imageName="applicationvideothumb.png" label="Thumbnail vidéo" />
                    </div>
                </div>
            </div>

            <hr>

            <!-- Icônes des fonctionnalités -->
            <div class="mb-4">
                <h6 class="border-bottom pb-2 mb-3"><i class="bi bi-lightning me-2"></i> Icônes des fonctionnalités</h6>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <x-admin.static-image-item imageName="recharge.png" label="Icône Recharge" />
                    </div>
                    <div class="col-md-3 mb-3">
                        <x-admin.static-image-item imageName="echange.png" label="Icône Échange" />
                    </div>
                    <div class="col-md-3 mb-3">
                        <x-admin.static-image-item imageName="qr.png" label="Icône QR Code" />
                    </div>
                </div>
            </div>

            <hr>

            <!-- Icônes des propositions de valeur -->
            <div class="mb-4">
                <h6 class="border-bottom pb-2 mb-3"><i class="bi bi-star me-2"></i> Icônes des propositions de valeur</h6>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <x-admin.static-image-item imageName="ergonome.png" label="Icône Ergonomie" />
                    </div>
                    <div class="col-md-4 mb-3">
                        <x-admin.static-image-item imageName="security.png" label="Icône Sécurité" />
                    </div>
                    <div class="col-md-4 mb-3">
                        <x-admin.static-image-item imageName="support.png" label="Icône Support" />
                    </div>
                </div>
            </div>

            <hr>

            <!-- Icônes des étapes -->
            <div class="mb-4">
                <h6 class="border-bottom pb-2 mb-3"><i class="bi bi-list-ol me-2"></i> Icônes des étapes (Comment ça fonctionne)</h6>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <x-admin.static-image-item imageName="howstep1.png" label="Icône Étape 1" />
                    </div>
                    <div class="col-md-4 mb-3">
                        <x-admin.static-image-item imageName="howstep2.png" label="Icône Étape 2" />
                    </div>
                    <div class="col-md-4 mb-3">
                        <x-admin.static-image-item imageName="howstep3.png" label="Icône Étape 3" />
                    </div>
                </div>
            </div>

            <hr>

            <!-- Screenshots de l'interface -->
            <div class="mb-4">
                <h6 class="border-bottom pb-2 mb-3"><i class="bi bi-phone me-2"></i> Screenshots de l'interface (intrscrn1.png à intrscrn9.png)</h6>
                <div class="row">
                    @for($i = 1; $i <= 9; $i++)
                    <div class="col-md-2 mb-3">
                        <x-admin.static-image-item imageName="intrscrn{{ $i }}.png" label="Screenshot {{ $i }}" />
                    </div>
                    @endfor
                </div>
            </div>

            <hr>

            <!-- Autres images -->
            <div class="mb-4">
                <h6 class="border-bottom pb-2 mb-3"><i class="bi bi-image me-2"></i> Autres images</h6>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <x-admin.static-image-item imageName="usericon.png" label="Icône utilisateur" />
                    </div>
                    <div class="col-md-3 mb-3">
                        <x-admin.static-image-item imageName="blue_dotes.png" label="Points décoratifs" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation par accordéons - Dans l'ordre exact d'apparition sur la page -->
    <div class="accordion mb-4" id="homePageAccordion">

        <!-- 1. SECTION HERO (Bannière principale) -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingHero">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseHero" aria-expanded="true" aria-controls="collapseHero">
                    <i class="bi bi-star me-2"></i> <strong>1. Section Hero</strong> <span class="text-muted ms-2">(Bannière principale)</span>
                </button>
            </h2>
            <div id="collapseHero" class="accordion-collapse collapse show" aria-labelledby="headingHero" data-bs-parent="#homePageAccordion">
                <div class="accordion-body">
                    <input type="hidden" name="hero[id]" value="{{ $heroSection->id ?? '' }}">

                    <div class="mb-3">
                        <label class="form-label">
                            Texte animé (typed strings)
                            <i class="bi bi-info-circle text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Ces textes s'affichent en animation en haut de la bannière. Séparez chaque texte par un pipe (|)."></i>
                        </label>
                        <textarea name="hero[typed_strings]" class="form-control" rows="3" placeholder="Transformez votre quotidien|Gérez vos finances|Simplifiez vos transactions">{{ old('hero.typed_strings', is_array($heroSection->typed_strings ?? null) ? implode('|', $heroSection->typed_strings) : ($heroSection->typed_strings ?? 'Transformez votre quotidien|Gérez vos finances|Simplifiez vos transactions')) }}</textarea>
                        <small class="text-muted">
                            <i class="bi bi-lightbulb"></i> <strong>Astuce :</strong> Séparez chaque texte par un pipe (|). Exemple : "Texte 1|Texte 2|Texte 3"
                        </small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Titre principal <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="hero[main_title]" class="form-control" value="{{ old('hero.main_title', $heroSection->main_title ?? 'Votre solution mobile pour payer, envoyer, échanger') }}" required>
                        <small class="text-muted">Titre principal affiché sous le texte animé dans la bannière.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Description <span class="text-danger">*</span>
                        </label>
                        <textarea name="hero[description]" class="form-control" rows="3" required>{{ old('hero.description', $heroSection->description ?? 'Ahla Finance Digitale est une fintech tchadienne qui révolutionne l\'accès aux services financiers à travers une application intuitive et sécurisée.') }}</textarea>
                        <small class="text-muted">Description affichée sous le titre principal dans la bannière.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            URL de la vidéo
                            <i class="bi bi-info-circle text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="URL YouTube ou autre service vidéo. Utilisée pour le bouton play dans la section Hero."></i>
                        </label>
                        <input type="url" name="hero[video_url]" class="form-control" value="{{ old('hero.video_url', $heroSection->video_url ?? '') }}" placeholder="https://www.youtube.com/embed/...">
                    </div>

                    <hr class="my-4">

                    <h6 class="mb-3"><i class="bi bi-chat-text me-2"></i> Section Solution adoptée</h6>
                    <input type="hidden" name="used_app_text[id]" value="{{ $usedAppText->id ?? '' }}">

                    <div class="mb-3">
                        <label class="form-label">Titre</label>
                        <input type="text" name="used_app_text[title]" class="form-control" value="{{ old('used_app_text.title', $usedAppText->title ?? 'Une solution déjà adoptée au Tchad') }}">
                        <small class="text-muted">Titre affiché sous les avatars dans la section Hero.</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="used_app_text[content]" class="form-control" rows="2">{{ old('used_app_text.content', $usedAppText->content ?? 'Rejoignez le mouvement vers une finance plus simple et accessible') }}</textarea>
                        <small class="text-muted">Description affichée sous le titre dans la section Hero.</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. SECTION À PROPOS (avec Statistiques intégrées) -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingAbout">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAbout" aria-expanded="false" aria-controls="collapseAbout">
                    <i class="bi bi-info-circle me-2"></i> <strong>2. Section À propos</strong>
                </button>
            </h2>
            <div id="collapseAbout" class="accordion-collapse collapse" aria-labelledby="headingAbout" data-bs-parent="#homePageAccordion">
                <div class="accordion-body">
                    <input type="hidden" name="about[id]" value="{{ $aboutSection->id ?? '' }}">

                    <div class="mb-3">
                        <label class="form-label">Badge</label>
                        <input type="text" name="about[badge_text]" class="form-control" value="{{ old('about.badge_text', $aboutSection->badge_text ?? 'À propos de nous') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Titre principal
                            <i class="bi bi-info-circle text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Vous pouvez utiliser des balises HTML comme &lt;span&gt; pour mettre du texte en évidence."></i>
                        </label>
                        <input type="text" name="about[title]" class="form-control" value="{{ old('about.title', $aboutSection->title ?? 'Une interface fluide qui transforme les visiteurs en utilisateurs engagés') }}">
                        <small class="text-muted">
                            <i class="bi bi-code"></i> <strong>HTML autorisé :</strong> Utilisez &lt;span&gt; pour mettre du texte en évidence. Exemple : "Texte &lt;span&gt;en évidence&lt;/span&gt;"
                        </small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="about[content]" class="form-control" rows="4">{{ old('about.content', $aboutSection->content ?? $aboutSection->description ?? 'Ahla Finance Digitale révolutionne les services financiers au Tchad en offrant une plateforme numérique simple et intuitive, permettant à chaque utilisateur d\'accéder aux services de transfert d\'argent, paiement mobile, change de devises, et bien plus.') }}</textarea>
                        <small class="text-muted">Description affichée dans la section À propos.</small>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Texte du bouton</label>
                            <input type="text" name="about[button_text]" class="form-control" value="{{ old('about.button_text', $aboutSection->button_text ?? '') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Lien du bouton</label>
                            <input type="text" name="about[button_link]" class="form-control" value="{{ old('about.button_link', $aboutSection->button_link ?? '#') }}" placeholder="# ou https://...">
                        </div>
                    </div>

                    <hr class="my-4">

                    <h6 class="mb-3"><i class="bi bi-graph-up me-2"></i> Statistiques (affichées dans cette section)</h6>
                    <input type="hidden" name="statistics[id]" value="{{ $statistic->id ?? '' }}">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nombre d'utilisateurs</label>
                            <div class="input-group">
                                <input type="number" name="statistics[users_count]" class="form-control" value="{{ old('statistics.users_count', $statistic->users_count ?? 25) }}" min="0">
                                <input type="text" name="statistics[users_suffix]" class="form-control" style="max-width: 80px;" value="{{ old('statistics.users_suffix', $statistic->users_suffix ?? 'M+') }}" placeholder="M+">
                            </div>
                            <small class="text-muted">Exemple : 25 avec suffixe "M+" = 25M+</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nombre d'avis</label>
                            <div class="input-group">
                                <input type="number" name="statistics[reviews_count]" class="form-control" value="{{ old('statistics.reviews_count', $statistic->reviews_count ?? 1500) }}" min="0">
                                <input type="text" name="statistics[reviews_suffix]" class="form-control" style="max-width: 80px;" value="{{ old('statistics.reviews_suffix', $statistic->reviews_suffix ?? '+') }}" placeholder="+">
                            </div>
                            <small class="text-muted">Exemple : 1500 avec suffixe "+" = 1500+</small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nombre de pays</label>
                            <div class="input-group">
                                <input type="number" name="statistics[countries_count]" class="form-control" value="{{ old('statistics.countries_count', $statistic->countries_count ?? 1) }}" min="0">
                                <input type="text" name="statistics[countries_suffix]" class="form-control" style="max-width: 80px;" value="{{ old('statistics.countries_suffix', $statistic->countries_suffix ?? '+') }}" placeholder="+">
                            </div>
                            <small class="text-muted">Exemple : 1 avec suffixe "+" = 1+</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nombre d'abonnés</label>
                            <div class="input-group">
                                <input type="number" name="statistics[subscribers_count]" class="form-control" value="{{ old('statistics.subscribers_count', $statistic->subscribers_count ?? 8) }}" min="0">
                                <input type="text" name="statistics[subscribers_suffix]" class="form-control" style="max-width: 80px;" value="{{ old('statistics.subscribers_suffix', $statistic->subscribers_suffix ?? 'M+') }}" placeholder="M+">
                            </div>
                            <small class="text-muted">Exemple : 8 avec suffixe "M+" = 8M+</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. SECTION NOUS VOUS OFFRONS -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingValueProps">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseValueProps" aria-expanded="false" aria-controls="collapseValueProps">
                    <i class="bi bi-star me-2"></i> <strong>3. Section Nous vous offrons</strong> <span class="badge bg-primary ms-2" id="valuePropsCount">{{ $valuePropositions->count() }}</span>
                </button>
            </h2>
            <div id="collapseValueProps" class="accordion-collapse collapse" aria-labelledby="headingValueProps" data-bs-parent="#homePageAccordion">
                <div class="accordion-body">
                    <div class="alert alert-info mb-3">
                        <i class="bi bi-info-circle"></i> <strong>Note :</strong> Le titre "Nous vous offrons" est fixe sur la page. Vous pouvez gérer jusqu'à 6 propositions de valeur ci-dessous.
                    </div>


                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <p class="text-muted mb-0">Gérez les propositions de valeur (jusqu'à 6 éléments)</p>
                        <button type="button" class="btn btn-sm btn-primary" id="addValuePropBtn" {{ $valuePropositions->count() >= 6 ? 'disabled' : '' }}>
                            <i class="bi bi-plus-circle"></i> Ajouter un élément
                        </button>
                    </div>

                    <div id="valuePropositionsContainer">
                        @php
                            $valuePropositionsArray = $valuePropositions->values()->all();
                        @endphp
                        @if(count($valuePropositionsArray) > 0)
                            @foreach($valuePropositionsArray as $index => $value)
                                <div class="value-prop-item border rounded p-3 mb-3" data-index="{{ $index }}">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h6 class="mb-0">Élément {{ $index + 1 }}</h6>
                                        <button type="button" class="btn btn-sm btn-danger remove-value-prop-btn" data-index="{{ $index }}">
                                            <i class="bi bi-trash"></i> Supprimer
                                        </button>
                                    </div>
                                    <input type="hidden" name="value_propositions[{{ $index }}][id]" value="{{ $value->id ?? '' }}">
                                    <input type="hidden" name="value_propositions[{{ $index }}][_delete]" value="0" class="delete-flag">

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Titre</label>
                                            <input type="text" name="value_propositions[{{ $index }}][title]" class="form-control" value="{{ old("value_propositions.$index.title", $value->title ?? '') }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Icône</label>
                                            @if($value && $value->icon)
                                                @php
                                                    $iconPath = asset('storage/' . $value->icon);
                                                    $fullIconPath = storage_path('app/public/' . $value->icon);
                                                    $iconDimensions = 'Dimensions inconnues';
                                                    if (file_exists($fullIconPath)) {
                                                        $iconInfo = @getimagesize($fullIconPath);
                                                        if ($iconInfo) {
                                                            $iconDimensions = $iconInfo[0] . ' x ' . $iconInfo[1] . ' px';
                                                        }
                                                    }
                                                @endphp
                                                <div class="mb-2">
                                                    <div class="position-relative d-inline-block" style="max-width: 100%; overflow: hidden;">
                                                        <img src="{{ $iconPath }}" alt="Icon" class="img-preview" style="max-width: 100%; max-height: 150px; width: auto; height: auto; border-radius: 8px; border: 2px solid #e0e0e0; object-fit: contain;">
                                                        <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1 remove-image-btn" data-target="value_prop_icon_{{ $index }}">
                                                            <i class="bi bi-x"></i>
                                                        </button>
                                                    </div>
                                                    <input type="hidden" name="value_propositions[{{ $index }}][remove_icon]" id="value_prop_remove_icon_{{ $index }}" value="0">
                                                </div>
                                            @endif
                                            <input type="file" name="value_propositions[{{ $index }}][icon]" id="value_prop_icon_{{ $index }}" class="form-control" accept="image/*" onchange="previewImage(this, 'value_prop_icon_preview_{{ $index }}')">
                                            <div id="value_prop_icon_preview_{{ $index }}" class="mt-2"></div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea name="value_propositions[{{ $index }}][description]" class="form-control" rows="3">{{ old("value_propositions.$index.description", $value->description ?? '') }}</textarea>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle"></i> Aucune proposition de valeur n'est configurée. Cliquez sur "Ajouter un élément" pour en créer.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- 4. SECTION COMMENT ÇA FONCTIONNE -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingHowItWorks">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseHowItWorks" aria-expanded="false" aria-controls="collapseHowItWorks">
                    <i class="bi bi-list-check me-2"></i> <strong>4. Section Comment ça fonctionne</strong>
                </button>
            </h2>
            <div id="collapseHowItWorks" class="accordion-collapse collapse" aria-labelledby="headingHowItWorks" data-bs-parent="#homePageAccordion">
                <div class="accordion-body">
                    <h6 class="mb-3">En-tête de la section</h6>
                    <input type="hidden" name="how_it_works_header[id]" value="{{ $howItWorksHeader->id ?? '' }}">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Badge</label>
                            <input type="text" name="how_it_works_header[badge_text]" class="form-control" value="{{ old('how_it_works_header.badge_text', $howItWorksHeader->badge_text ?? 'Rapide et facile') }}">
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Titre</label>
                            <input type="text" name="how_it_works_header[title]" class="form-control" value="{{ old('how_it_works_header.title', $howItWorksHeader->title ?? 'Comment ça fonctionne en 3 étapes') }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Texte du bouton</label>
                            <input type="text" name="how_it_works_header[button_text]" class="form-control" value="{{ old('how_it_works_header.button_text', $howItWorksHeader->button_text ?? '') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Lien du bouton</label>
                            <input type="text" name="how_it_works_header[button_link]" class="form-control" value="{{ old('how_it_works_header.button_link', $howItWorksHeader->button_link ?? '#') }}" placeholder="# ou https://...">
                        </div>
                    </div>

                    <hr class="my-4">

                    <h6 class="mb-3">Les 3 étapes</h6>
                    <div id="howItWorksStepsContainer">
                        @php
                            $howItWorkStepsArray = $howItWorkSteps->values()->all();
                        @endphp
                        @for($i = 0; $i < 3; $i++)
                            @php
                                $step = $howItWorkStepsArray[$i] ?? null;
                            @endphp
                            <div class="border rounded p-3 mb-3 step-item" data-index="{{ $i }}">
                                <h6 class="mb-3">Étape {{ $i + 1 }}</h6>
                                <input type="hidden" name="how_it_work_steps[{{ $i }}][id]" value="{{ $step->id ?? '' }}">
                                <input type="hidden" name="how_it_work_steps[{{ $i }}][step_number]" value="{{ $i + 1 }}">

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Titre</label>
                                        <input type="text" name="how_it_work_steps[{{ $i }}][title]" class="form-control" value="{{ old("how_it_work_steps.$i.title", $step->title ?? '') }}">
                                    </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Tag texte</label>
                                            <input type="text" name="how_it_work_steps[{{ $i }}][tag_text]" class="form-control" value="{{ old("how_it_work_steps.$i.tag_text", $step->tag_text ?? '') }}">
                                        </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="how_it_work_steps[{{ $i }}][description]" class="form-control" rows="3">{{ old("how_it_work_steps.$i.description", $step->description ?? '') }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Icône</label>
                                    @if($step && $step->icon)
                                        @php
                                            $stepIconPath = asset('storage/' . $step->icon);
                                            $fullStepIconPath = storage_path('app/public/' . $step->icon);
                                            $stepIconDimensions = 'Dimensions inconnues';
                                            if (file_exists($fullStepIconPath)) {
                                                $stepIconInfo = @getimagesize($fullStepIconPath);
                                                if ($stepIconInfo) {
                                                    $stepIconDimensions = $stepIconInfo[0] . ' x ' . $stepIconInfo[1] . ' px';
                                                }
                                            }
                                        @endphp
                                        <div class="mb-2">
                                            <div class="position-relative d-inline-block" style="max-width: 100%; overflow: hidden;">
                                                <img src="{{ $stepIconPath }}" alt="Icon" class="img-preview" style="max-width: 100%; max-height: 150px; width: auto; height: auto; border-radius: 8px; border: 2px solid #e0e0e0; object-fit: contain;">
                                                <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1 remove-image-btn" data-target="step_icon_{{ $i }}">
                                                    <i class="bi bi-x"></i>
                                                </button>
                                            </div>
                                            <input type="hidden" name="how_it_work_steps[{{ $i }}][remove_icon]" id="step_remove_icon_{{ $i }}" value="0">
                                        </div>
                                    @endif
                                    <input type="file" name="how_it_work_steps[{{ $i }}][icon]" id="step_icon_{{ $i }}" class="form-control" accept="image/*" onchange="previewImage(this, 'step_icon_preview_{{ $i }}')">
                                    <div id="step_icon_preview_{{ $i }}" class="mt-2"></div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>

        <!-- 5. SECTION ÉCRANS DE L'APPLICATION -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingScreenshots">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseScreenshots" aria-expanded="false" aria-controls="collapseScreenshots">
                    <i class="bi bi-images me-2"></i> <strong>5. Section Écrans de l'application</strong> <span class="badge bg-primary ms-2" id="screenshotsCount">{{ $appScreenshots->count() }}</span>
                </button>
            </h2>
            <div id="collapseScreenshots" class="accordion-collapse collapse" aria-labelledby="headingScreenshots" data-bs-parent="#homePageAccordion">
                <div class="accordion-body">
                    <h6 class="mb-3">En-tête de la section</h6>
                    <input type="hidden" name="interface_section[id]" value="{{ $interfaceSection->id ?? '' }}">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Badge</label>
                            <input type="text" name="interface_section[badge_text]" class="form-control" value="{{ old('interface_section.badge_text', $interfaceSection->badge_text ?? 'Ecrans de l\'application') }}">
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Titre</label>
                            <input type="text" name="interface_section[title]" class="form-control" value="{{ old('interface_section.title', $interfaceSection->title ?? 'Découvrez les interface de Ahla Finance') }}">
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0">Screenshots (jusqu'à 9)</h6>
                        <button type="button" class="btn btn-sm btn-primary" id="addScreenshotBtn" {{ $appScreenshots->count() >= 9 ? 'disabled' : '' }}>
                            <i class="bi bi-plus-circle"></i> Ajouter un screenshot
                        </button>
                    </div>

                    <div id="screenshotsContainer">
                        @php
                            $appScreenshotsArray = $appScreenshots->values()->all();
                        @endphp
                        @if(count($appScreenshotsArray) > 0)
                            @foreach($appScreenshotsArray as $index => $screenshot)
                                <div class="border rounded p-3 mb-3 screenshot-item" data-index="{{ $index }}">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h6 class="mb-0">Screenshot {{ $index + 1 }}</h6>
                                        <button type="button" class="btn btn-sm btn-danger remove-screenshot-btn" data-index="{{ $index }}">
                                            <i class="bi bi-trash"></i> Supprimer
                                        </button>
                                    </div>
                                    <input type="hidden" name="app_screenshots[{{ $index }}][id]" value="{{ $screenshot->id ?? '' }}">
                                    <input type="hidden" name="app_screenshots[{{ $index }}][_delete]" value="0" class="delete-flag">

                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Image</label>
                                            @if($screenshot && $screenshot->image)
                                                @php
                                                    $screenshotPath = asset('storage/' . $screenshot->image);
                                                    $fullScreenshotPath = storage_path('app/public/' . $screenshot->image);
                                                    $screenshotDimensions = 'Dimensions inconnues';
                                                    if (file_exists($fullScreenshotPath)) {
                                                        $screenshotInfo = @getimagesize($fullScreenshotPath);
                                                        if ($screenshotInfo) {
                                                            $screenshotDimensions = $screenshotInfo[0] . ' x ' . $screenshotInfo[1] . ' px';
                                                        }
                                                    }
                                                @endphp
                                                <div class="mb-2">
                                                    <div class="position-relative d-inline-block" style="max-width: 100%; overflow: hidden;">
                                                        <img src="{{ $screenshotPath }}" alt="Screenshot" class="img-preview" style="max-width: 100%; max-height: 300px; width: auto; height: auto; border-radius: 8px; border: 2px solid #e0e0e0; object-fit: contain;">
                                                        <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1 remove-image-btn" data-target="screenshot_image_{{ $index }}">
                                                            <i class="bi bi-x"></i>
                                                        </button>
                                                    </div>
                                                    <input type="hidden" name="app_screenshots[{{ $index }}][remove_image]" id="screenshot_remove_image_{{ $index }}" value="0">
                                                </div>
                                            @endif
                                            <input type="file" name="app_screenshots[{{ $index }}][image]" id="screenshot_image_{{ $index }}" class="form-control" accept="image/*" onchange="previewImage(this, 'screenshot_image_preview_{{ $index }}')">
                                            <div id="screenshot_image_preview_{{ $index }}" class="mt-2"></div>
                                        </div>
                                        <div class="col-md-8 mb-3">
                                            <label class="form-label">Titre</label>
                                            <input type="text" name="app_screenshots[{{ $index }}][title]" class="form-control" value="{{ old("app_screenshots.$index.title", $screenshot->title ?? '') }}">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle"></i> Aucun screenshot n'est configuré. Cliquez sur "Ajouter un screenshot" pour en créer.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer avec boutons toujours visibles -->
    <div class="page-edit-footer">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Retour
        </a>
        <div class="btn-group">
            <button type="button" onclick="window.location.reload(true)" class="btn btn-outline-secondary">
                <i class="bi bi-x-circle"></i> Annuler
            </button>
            <button type="submit" id="submitHomePageForm" class="btn btn-primary">
                <i class="bi bi-check-circle"></i> Enregistrer les modifications
            </button>
        </div>
    </div>
</form>

@push('scripts')
<script>
// Fonction de prévisualisation - ouvre simplement la page publique
function previewPage(pageType) {
    // Pour l'instant, ouvrir la page publique (les modifications non sauvegardées ne seront pas visibles)
    // TODO: Implémenter une prévisualisation avec les données non sauvegardées
    window.open('{{ route("home") }}', '_blank');
}

// Gestion du formulaire principal
// Gestion du formulaire principal
document.addEventListener('DOMContentLoaded', function() {
    var homePageForm = document.getElementById('homePageForm');
    var submitBtn = document.getElementById('submitHomePageForm');

    if (homePageForm && submitBtn) {
        // Event listener sur le bouton submit
        submitBtn.addEventListener('click', function(e) {
            e.preventDefault(); // Empêcher la soumission par défaut

            // Synchroniser TinyMCE si disponible
            if (typeof tinymce !== 'undefined') {
                try {
                    tinymce.triggerSave();
                } catch (error) {
                    console.error('Erreur TinyMCE:', error);
                }
            }

            // Soumettre le formulaire directement
            homePageForm.submit();
        });

        // Synchroniser TinyMCE sur submit du formulaire
        homePageForm.addEventListener('submit', function(e) {
            if (typeof tinymce !== 'undefined') {
                try {
                    tinymce.triggerSave();
                } catch (error) {
                    console.error('Erreur TinyMCE:', error);
                }
            }
            // Ne pas empêcher la soumission - laisser le formulaire se soumettre normalement
        });
    }
});

// Initialiser les tooltips Bootstrap
document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});

// Prévisualisation des images
function previewImage(input, previewId) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var previewDiv = document.getElementById(previewId);
            if (previewDiv) {
                previewDiv.innerHTML = '<div class="position-relative d-inline-block" style="max-width: 100%; overflow: hidden;"><img src="' + e.target.result + '" class="img-preview-new" style="max-width: 100%; max-height: 300px; width: auto; height: auto; border-radius: 8px; border: 2px solid #e0e0e0; margin-top: 10px; object-fit: contain;"></div>';
            }
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Suppression d'images
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.remove-image-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var target = this.getAttribute('data-target');
            var input = document.getElementById(target);
            var container = this.closest('.position-relative');

            // Trouver le champ hidden pour la suppression
            var removeInputId = '';
            if (target.includes('value_prop_icon_')) {
                var index = target.match(/\d+/)[0];
                removeInputId = 'value_prop_remove_icon_' + index;
            } else if (target.includes('step_icon_')) {
                var index = target.match(/\d+/)[0];
                removeInputId = 'step_remove_icon_' + index;
            } else if (target.includes('screenshot_image_')) {
                var index = target.match(/\d+/)[0];
                removeInputId = 'screenshot_remove_image_' + index;
            }

            var removeInput = document.getElementById(removeInputId);

            // Réinitialiser l'input file
            if (input) {
                input.value = '';
                var newInput = input.cloneNode(true);
                input.parentNode.replaceChild(newInput, input);
                newInput.addEventListener('change', function() {
                    previewImage(this, target + '_preview');
                });
            }

            // Supprimer la prévisualisation existante
            if (container) {
                container.remove();
            }

            // Marquer pour suppression côté serveur
            if (removeInput) {
                removeInput.value = '1';
            }
        });
    });
});

// Gestion des propositions de valeur
let valuePropIndex = {{ $valuePropositions->count() }};
document.getElementById('addValuePropBtn')?.addEventListener('click', function() {
    if (valuePropIndex >= 6) {
        alert('Vous ne pouvez pas ajouter plus de 6 éléments.');
        return;
    }

    var container = document.getElementById('valuePropositionsContainer');
    var newItem = document.createElement('div');
    newItem.className = 'value-prop-item border rounded p-3 mb-3';
    newItem.setAttribute('data-index', valuePropIndex);
    newItem.innerHTML = `
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="mb-0">Élément ${valuePropIndex + 1}</h6>
            <button type="button" class="btn btn-sm btn-danger remove-value-prop-btn" data-index="${valuePropIndex}">
                <i class="bi bi-trash"></i> Supprimer
            </button>
        </div>
        <input type="hidden" name="value_propositions[${valuePropIndex}][id]" value="">
        <input type="hidden" name="value_propositions[${valuePropIndex}][_delete]" value="0" class="delete-flag">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Titre</label>
                <input type="text" name="value_propositions[${valuePropIndex}][title]" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Icône</label>
                <input type="file" name="value_propositions[${valuePropIndex}][icon]" class="form-control" accept="image/*">
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="value_propositions[${valuePropIndex}][description]" class="form-control" rows="3"></textarea>
        </div>
    `;
    container.appendChild(newItem);
    valuePropIndex++;
    updateValuePropsCount();
    attachRemoveListeners();
});

// Gestion des screenshots
let screenshotIndex = {{ $appScreenshots->count() }};
document.getElementById('addScreenshotBtn')?.addEventListener('click', function() {
    if (screenshotIndex >= 9) {
        alert('Vous ne pouvez pas ajouter plus de 9 screenshots.');
        return;
    }

    var container = document.getElementById('screenshotsContainer');
    var newItem = document.createElement('div');
    newItem.className = 'border rounded p-3 mb-3 screenshot-item';
    newItem.setAttribute('data-index', screenshotIndex);
    newItem.innerHTML = `
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="mb-0">Screenshot ${screenshotIndex + 1}</h6>
            <button type="button" class="btn btn-sm btn-danger remove-screenshot-btn" data-index="${screenshotIndex}">
                <i class="bi bi-trash"></i> Supprimer
            </button>
        </div>
        <input type="hidden" name="app_screenshots[${screenshotIndex}][id]" value="">
        <input type="hidden" name="app_screenshots[${screenshotIndex}][_delete]" value="0" class="delete-flag">
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Image</label>
                <input type="file" name="app_screenshots[${screenshotIndex}][image]" class="form-control" accept="image/*">
            </div>
            <div class="col-md-8 mb-3">
                <label class="form-label">Titre</label>
                <input type="text" name="app_screenshots[${screenshotIndex}][title]" class="form-control">
            </div>
        </div>
    `;
    container.appendChild(newItem);
    screenshotIndex++;
    updateScreenshotsCount();
    attachRemoveListeners();
});

// Fonction pour attacher les listeners de suppression
function attachRemoveListeners() {
    document.querySelectorAll('.remove-value-prop-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var index = this.getAttribute('data-index');
            var item = document.querySelector(`.value-prop-item[data-index="${index}"]`);
            if (item) {
                var deleteFlag = item.querySelector('.delete-flag');
                if (deleteFlag) {
                    deleteFlag.value = '1';
                }
                item.style.display = 'none';
                updateValuePropsCount();
            }
        });
    });

    document.querySelectorAll('.remove-screenshot-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var index = this.getAttribute('data-index');
            var item = document.querySelector(`.screenshot-item[data-index="${index}"]`);
            if (item) {
                var deleteFlag = item.querySelector('.delete-flag');
                if (deleteFlag) {
                    deleteFlag.value = '1';
                }
                item.style.display = 'none';
                updateScreenshotsCount();
            }
        });
    });
}

// Mettre à jour les compteurs
function updateValuePropsCount() {
    var visible = document.querySelectorAll('.value-prop-item:not([style*="display: none"])').length;
    var countBadge = document.getElementById('valuePropsCount');
    if (countBadge) {
        countBadge.textContent = visible;
    }
    var addBtn = document.getElementById('addValuePropBtn');
    if (addBtn) {
        addBtn.disabled = valuePropIndex >= 6;
    }
}

function updateScreenshotsCount() {
    var visible = document.querySelectorAll('.screenshot-item:not([style*="display: none"])').length;
    var countBadge = document.getElementById('screenshotsCount');
    if (countBadge) {
        countBadge.textContent = visible;
    }
    var addBtn = document.getElementById('addScreenshotBtn');
    if (addBtn) {
        addBtn.disabled = screenshotIndex >= 9;
    }
}

// Initialiser les listeners
attachRemoveListeners();

// Prévisualisation des images dans les modals
function previewImageModal(input, previewId) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var previewDiv = document.getElementById(previewId);

            // Afficher la nouvelle image
            if (previewDiv) {
                previewDiv.style.display = 'block';
                previewDiv.innerHTML = '<div class="position-relative d-inline-block w-100" style="max-width: 100%; overflow: hidden;"><img src="' + e.target.result + '" class="img-fluid" style="max-width: 100%; max-height: 200px; width: auto; height: auto; border-radius: 8px; border: 2px solid #e0e0e0; object-fit: contain;"></div>';
            }
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        // Masquer la prévisualisation si le fichier est annulé
        var previewDiv = document.getElementById(previewId);
        if (previewDiv) {
            previewDiv.style.display = 'none';
            previewDiv.innerHTML = '<p class="text-muted small mb-2"><strong>Nouvelle image :</strong></p>';
        }
    }
}

// Fonction pour soumettre automatiquement le formulaire d'image
function autoSubmitImageForm(formId, modalId) {
    var form = document.getElementById(formId);
    if (!form) return;

    // Afficher le statut d'enregistrement
    // Extraire l'ID du média depuis le formId (format: editImageForm{id})
    var mediaId = formId.replace('editImageForm', '');
    var uploadingStatus = document.getElementById('uploadingStatus' + mediaId);
    if (uploadingStatus) {
        uploadingStatus.style.display = 'block';
    }

    var formData = new FormData(form);

    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(data => {
                throw new Error(data.message || 'Une erreur est survenue');
            });
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            var modalElement = document.getElementById(modalId);
            if (modalElement) {
                // Utiliser Bootstrap 5 Modal API
                if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                    var modalInstance = bootstrap.Modal.getInstance(modalElement);
                    if (!modalInstance) {
                        modalInstance = new bootstrap.Modal(modalElement);
                    }
                    if (modalInstance) {
                        modalInstance.hide();
                    }
                } else {
                    // Fallback : fermer le modal avec data-bs-dismiss
                    var closeBtn = modalElement.querySelector('[data-bs-dismiss="modal"]');
                    if (closeBtn) {
                        closeBtn.click();
                    }
                }
            }
            // Recharger la page pour afficher la nouvelle image
            setTimeout(function() {
                window.location.reload(true);
            }, 500);
        } else {
            alert('Erreur lors de la modification : ' + (data.message || 'Une erreur est survenue'));
            if (uploadingStatus) {
                uploadingStatus.style.display = 'none';
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Erreur lors de la modification : ' + error.message);
        if (uploadingStatus) {
            uploadingStatus.style.display = 'none';
        }
    });
}

// Gestion des formulaires de modification d'images statiques
// IMPORTANT: Ce code ne doit JAMAIS intercepter le formulaire principal
document.addEventListener('DOMContentLoaded', function() {
    // Sélectionner UNIQUEMENT les formulaires dans les modals d'images statiques
    var imageForms = document.querySelectorAll('.modal form[id^="editImageForm"]');

    imageForms.forEach(function(form) {
        // Vérifications strictes
        var formId = form.getAttribute('id') || '';
        var formAction = form.getAttribute('action') || '';

        // Ignorer si ce n'est PAS un formulaire d'image statique dans un modal
        if (!formId.startsWith('editImageForm') ||
            !formAction.includes('static-images.update') ||
            formId === 'homePageForm') {
            return; // Ignorer ce formulaire
        }

        // Intercepter UNIQUEMENT les formulaires d'images statiques
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            var formData = new FormData(form);
            var formElement = this;

            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(data => {
                        throw new Error(data.message || 'Une erreur est survenue');
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    var modalId = formElement.getAttribute('id').replace('editImageForm', 'editImageModal');
                    var modalElement = document.getElementById(modalId);
                    if (modalElement) {
                        // Utiliser Bootstrap 5 Modal API
                        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                            var modalInstance = bootstrap.Modal.getInstance(modalElement);
                            if (!modalInstance) {
                                // Si l'instance n'existe pas, créer une nouvelle instance
                                modalInstance = new bootstrap.Modal(modalElement);
                            }
                            if (modalInstance) {
                                modalInstance.hide();
                            } else {
                                // Fallback : fermer le modal avec data-bs-dismiss
                                var closeBtn = modalElement.querySelector('[data-bs-dismiss="modal"]');
                                if (closeBtn) {
                                    closeBtn.click();
                                }
                            }
                        } else {
                            // Fallback : fermer le modal avec data-bs-dismiss
                            var closeBtn = modalElement.querySelector('[data-bs-dismiss="modal"]');
                            if (closeBtn) {
                                closeBtn.click();
                            }
                        }
                    }
                    alert('Image mise à jour avec succès !');
                    // Forcer le rechargement avec cache busting
                    window.location.reload(true);
                } else {
                    alert('Erreur lors de la modification : ' + (data.message || 'Une erreur est survenue'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Erreur lors de la modification : ' + error.message);
            });
        });
    });
});
</script>
@endpush

@push('styles')
<style>
    /* Correction du débordement des images prévisualisées */
    .image-preview-container {
        max-width: 100%;
        overflow: hidden;
    }

    .img-preview,
    .img-preview-new {
        max-width: 100% !important;
        max-height: 300px !important;
        width: auto !important;
        height: auto !important;
        object-fit: contain;
        display: block;
    }

    .position-relative.d-inline-block {
        max-width: 100%;
        overflow: hidden;
    }

    /* Pour les autres prévisualisations */
    [id$="_preview"] {
        max-width: 100%;
        overflow: hidden;
    }

    [id$="_preview"] img {
        max-width: 100% !important;
        max-height: 300px !important;
        width: auto !important;
        height: auto !important;
        object-fit: contain;
    }

    /* Correction spécifique pour les icônes */
    .value-prop-item .img-preview,
    .how-it-work-step .img-preview {
        max-height: 150px !important;
    }

    /* Correction pour les screenshots */
    .screenshot-item .img-preview {
        max-height: 300px !important;
    }

    /* Assurer que tous les conteneurs d'images ont overflow hidden */
    .position-relative.d-inline-block:not([style*="overflow"]) {
        max-width: 100%;
        overflow: hidden;
    }
</style>
@endpush

@endsection
