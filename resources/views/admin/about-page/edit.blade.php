@extends('admin.layout')

@section('title', 'Page À propos')
@section('page-title', 'Modifier la Page À propos')

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

<form method="POST" action="{{ route('admin.about-page.update') }}" enctype="multipart/form-data" novalidate>
    @csrf
    @csrf

    <!-- Section Images statiques de la page À propos -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="bi bi-images"></i> Images statiques de la page À propos</h5>
            <small class="text-white-50">Toutes les images affichées sur la page À propos publique peuvent être modifiées ici</small>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <x-admin.static-image-item imageName="apropos.png" label="Image principale" />
                    <small class="text-muted d-block mt-2">Image affichée dans la colonne de droite de la section principale</small>
                </div>
                <div class="col-md-4 mb-3">
                    <x-admin.static-image-item imageName="our_app.png" label="Image application" />
                    <small class="text-muted d-block mt-2">Image affichée dans la section "Téléchargez l'application"</small>
                </div>
                <div class="col-md-4 mb-3">
                    <x-admin.static-image-item imageName="blue_dotes.png" label="Points décoratifs" />
                    <small class="text-muted d-block mt-2">Élément décoratif utilisé dans la section téléchargement</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Section En-tête de la page -->
    <div class="card mb-3 page-section">
        <div class="card-header">
            <h5 class="mb-0"><i class="bi bi-info-circle"></i> En-tête de la page</h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Badge <span class="text-danger">*</span></label>
                <input type="text" name="badge_text" class="form-control" value="{{ old('badge_text', $page->badge_text ?? 'À propos') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Titre principal <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $page->title ?? 'Découvrez Ahla Finance') }}" required>
                <small class="text-muted">Vous pouvez utiliser &lt;span&gt; pour mettre du texte en évidence.</small>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="subtitle" class="form-control" rows="2">{{ old('subtitle', $page->subtitle ?? 'Qui sommes-nous, quelle est notre mission, et quels sont nos engagements envers vous ?') }}</textarea>
            </div>
        </div>
    </div>

    <!-- Section Onglets de contenu -->
    <div class="card mb-3 page-section">
        <div class="card-header">
            <h5 class="mb-0"><i class="bi bi-file-earmark-text"></i> Contenu par onglets</h5>
        </div>
        <div class="card-body">
            <div class="section-info">
                <i class="bi bi-info-circle-fill"></i>
                Le contenu de la page À propos est organisé en trois onglets : Présentation, Pourquoi Ahla, et Nos engagements.
            </div>

            <!-- Onglet Présentation -->
            <div class="content-preview mb-4">
                <div class="content-preview-title">
                    <i class="bi bi-info-circle"></i>Onglet : Présentation
                </div>
                <div class="mb-3">
                    <label class="form-label">Section "Qui sommes-nous ?"</label>
                    <textarea name="presentation_who" class="form-control wysiwyg-editor" rows="4">{{ old('presentation_who', $page->presentation_who ?? 'Ahla est une équipe jeune, dynamique et passionnée, née de la volonté de répondre aux enjeux financiers au Tchad. Nous concevons des outils numériques accessibles et fiables pour accompagner chacun au quotidien.') }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Section "Notre mission"</label>
                    <textarea name="presentation_mission" class="form-control wysiwyg-editor" rows="4">{{ old('presentation_mission', $page->presentation_mission ?? 'Offrir à nos utilisateurs une expérience fluide, sécurisée et inclusive pour la gestion de leurs transactions et de leur budget, tout en tenant compte des réalités locales.') }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Section "Notre vision"</label>
                    <textarea name="presentation_vision" class="form-control wysiwyg-editor" rows="4">{{ old('presentation_vision', $page->presentation_vision ?? 'Être une référence en matière de solutions financières numériques sur le continent africain, en misant sur l\'innovation, l\'accessibilité et la confiance.') }}</textarea>
                </div>
            </div>

            <!-- Onglet Pourquoi Ahla -->
            <div class="content-preview mb-4">
                <div class="content-preview-title">
                    <i class="bi bi-check-circle"></i>Onglet : Pourquoi Ahla
                </div>
                <div class="mb-3">
                    <label class="form-label">Contenu</label>
                    <textarea name="why_content" class="form-control wysiwyg-editor" rows="8">{{ old('why_content', $page->why_content ?? 'Choisir Ahla, c\'est opter pour une solution financière conçue pour vous, avec vous. Contrairement aux plateformes généralistes, nous avons fait le choix de construire une expérience utilisateur pensée spécifiquement pour les besoins et réalités des utilisateurs africains.

Nous plaçons l\'humain au cœur de notre démarche. Derrière chaque fonctionnalité se cache une réflexion profonde sur la simplicité d\'usage, la sécurité des données et la rapidité des transactions. En intégrant des fonctionnalités accessibles à tous et en assurant un support de proximité, nous visons à créer un lien de confiance durable avec notre communauté.

Ahla, c\'est aussi un engagement technologique permanent. Nous améliorons continuellement notre plateforme pour vous offrir un service toujours plus fluide, plus intuitif et plus efficace.') }}</textarea>
                </div>
            </div>

            <!-- Onglet Nos engagements -->
            <div class="content-preview mb-4">
                <div class="content-preview-title">
                    <i class="bi bi-handshake"></i>Onglet : Nos engagements
                </div>
                <div class="mb-3">
                    <label class="form-label">Contenu</label>
                    <textarea name="engagements_content" class="form-control wysiwyg-editor" rows="8">{{ old('engagements_content', $page->engagements_content ?? 'Chez Ahla, nous croyons que la confiance se construit dans la durée. C\'est pourquoi nous nous engageons à toujours faire preuve de transparence, aussi bien dans nos services que dans nos communications. Vous savez toujours où vont vos données, comment sont calculés les frais, et à quoi vous attendre.

Nous nous engageons également à rendre notre solution accessible au plus grand nombre. Cela signifie une interface simple, des frais maîtrisés et un accompagnement personnalisé. L\'objectif : faire en sorte que chacun, quel que soit son niveau de familiarité avec la technologie, puisse tirer pleinement parti de notre plateforme.

Enfin, nous nous engageons à toujours écouter notre communauté. Vos retours guident nos décisions. Chaque mise à jour, chaque amélioration provient de vos expériences, de vos besoins et de vos suggestions.') }}</textarea>
                </div>
            </div>


        </div>
    </div>

    <!-- SEO -->
    <div class="card mb-3 page-section">
        <div class="card-header">
            <h5 class="mb-0"><i class="bi bi-search"></i> Paramètres SEO</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Titre SEO</label>
                    <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $page->meta_title) }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Description SEO</label>
                    <input type="text" name="meta_description" class="form-control" value="{{ old('meta_description', $page->meta_description) }}">
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

            <button type="submit" id="submitAboutPageForm" class="btn btn-primary">
                <i class="bi bi-check-circle"></i> Enregistrer les modifications
            </button>
        </div>
    </div>
</form>

@push('scripts')
<script>
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

// Gestion du formulaire principal
document.addEventListener('DOMContentLoaded', function() {
    var mainForm = document.querySelector('form[action="{{ route('admin.about-page.update') }}"]');
    var submitBtn = document.getElementById('submitAboutPageForm');

    if (mainForm && submitBtn) {
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
            mainForm.submit();
        });

        // Synchroniser TinyMCE sur submit du formulaire (au cas où)
        mainForm.addEventListener('submit', function(e) {
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
            !formAction.includes('static-images.update')) {
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
                    window.location.reload();
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
</style>
@endpush

@endsection

