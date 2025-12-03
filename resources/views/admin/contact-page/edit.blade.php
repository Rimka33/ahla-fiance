@extends('admin.layout')

@section('title', 'Page Contact')
@section('page-title', 'Modifier la Page Contact')

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

<form method="POST" action="{{ route('admin.contact-page.update') }}" enctype="multipart/form-data" novalidate>
    @csrf
    @csrf

    <!-- Section Images statiques -->
    <div class="card mb-3">
        <div class="card-header">
            <h5 class="mb-0"><i class="bi bi-images"></i> Images statiques de la page</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <x-admin.static-image-item imageName="mail_icon.png" label="Icône Email" />
                </div>
                <div class="col-md-3">
                    <x-admin.static-image-item imageName="phone_icon.png" label="Icône Téléphone" />
                </div>
                <div class="col-md-3">
                    <x-admin.static-image-item imageName="location_icon.png" label="Icône Localisation" />
                </div>
                <div class="col-md-3">
                    <x-admin.static-image-item imageName="blue_dotes.png" label="Points décoratifs" />
                </div>
            </div>
        </div>
    </div>

    <!-- Section En-tête de la page -->
    <div class="card mb-3 page-section">
        <div class="card-header">
            <h5 class="mb-0"><i class="bi bi-envelope"></i> En-tête de la page</h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Badge <span class="text-danger">*</span></label>
                <input type="text" name="badge_text" class="form-control" value="{{ old('badge_text', $page->badge_text ?? 'Contact') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Titre principal <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $page->title ?? 'Contactez-nous') }}" required>
                <small class="text-muted">Vous pouvez utiliser &lt;span&gt; pour mettre du texte en évidence.</small>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="subtitle" class="form-control" rows="2">{{ old('subtitle', $page->subtitle ?? 'N\'hésitez pas à nous contacter pour toute question ou demande d\'information.') }}</textarea>
            </div>
        </div>
    </div>

    <!-- Section Informations de contact -->
    <div class="card mb-3 page-section">
        <div class="card-header">
            <h5 class="mb-0"><i class="bi bi-info-circle"></i> Informations de contact</h5>
        </div>
        <div class="card-body">
            <div class="section-info">
                <i class="bi bi-info-circle-fill"></i>
                Ces informations sont affichées en haut de la page avec les icônes.
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $settings->email ?? 'contact@ahla-finance.com') }}">
                    <small class="text-muted">Affiche l'icône email</small>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Téléphone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $settings->phone ?? '+235 61 75 07 07') }}">
                    <small class="text-muted">Affiche l'icône téléphone</small>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Adresse / Localisation</label>
                    <input type="text" name="address" class="form-control" value="{{ old('address', $settings->address ?? '') }}">
                    <small class="text-muted">Affiche l'icône localisation</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Formulaire de contact -->
    <div class="card mb-3 page-section">
        <div class="card-header">
            <h5 class="mb-0"><i class="bi bi-chat-dots"></i> Formulaire de contact</h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Badge du formulaire</label>
                <input type="text" name="form_badge" class="form-control" value="{{ old('form_badge', $page->form_badge ?? 'Écrivez-nous') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Titre du formulaire</label>
                <input type="text" name="form_title" class="form-control" value="{{ old('form_title', $page->form_title ?? 'Laissez-nous un message') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Description du formulaire</label>
                <textarea name="form_description" class="form-control" rows="2">{{ old('form_description', $page->form_description ?? 'Remplissez le formulaire ci-dessous, notre équipe vous répondra dans les plus brefs délais.') }}</textarea>
            </div>
        </div>
    </div>

    <!-- Section Carte Google Maps -->
    <div class="card mb-3 page-section">
        <div class="card-header">
            <h5 class="mb-0"><i class="bi bi-geo-alt"></i> Carte Google Maps</h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">URL Google Maps (Embed)</label>
                <textarea name="google_maps_url" class="form-control" rows="4" placeholder="https://www.google.com/maps/embed?pb=...">{{ old('google_maps_url', $settings->google_maps_url ?? '') }}</textarea>
                <small class="text-muted">
                    <strong>Important :</strong> Pour obtenir l'URL d'embed correcte :
                    <ol style="margin: 5px 0; padding-left: 20px; font-size: 0.9rem;">
                        <li>Allez sur <a href="https://www.google.com/maps" target="_blank">Google Maps</a></li>
                        <li>Trouvez votre adresse ou entreprise</li>
                        <li>Cliquez sur le bouton <strong>"Partager"</strong></li>
                        <li>Sélectionnez l'onglet <strong>"Intégrer une carte"</strong></li>
                        <li>Cliquez sur <strong>"Copier le HTML"</strong></li>
                        <li>Copiez uniquement l'URL de l'attribut <code>src</code> de l'iframe (commence par <code>https://www.google.com/maps/embed?pb=</code>)</li>
                    </ol>
                    <p class="text-danger mt-2" style="font-size: 0.9rem;">
                        <strong>Note :</strong> Assurez-vous que l'URL commence bien par <code>https://www.google.com/maps/embed</code> et non par <code>https://www.google.com/maps/place</code> ou <code>https://maps.google.com</code>
                    </p>
                </small>
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

            <button type="submit" id="submitContactPageForm" class="btn btn-primary">
                <i class="bi bi-check-circle"></i> Enregistrer les modifications
            </button>
        </div>
    </div>
</form>

@push('scripts')
<script>
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
    var mainForm = document.querySelector('form[action="{{ route('admin.contact-page.update') }}"]');
    var submitBtn = document.getElementById('submitContactPageForm');
    
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

        // Synchroniser TinyMCE sur submit du formulaire
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

@endsection

