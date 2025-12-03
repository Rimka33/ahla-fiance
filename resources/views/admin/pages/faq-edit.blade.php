@extends('admin.layout')

@section('title', 'Page FAQ')
@section('page-title', 'Modifier la Page FAQ')

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

<form id="faqPageForm" method="POST" action="{{ route('admin.faq.page.update') }}" novalidate>
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
                    <x-admin.static-image-item imageName="blue_dotes.png" label="Points décoratifs" />
                </div>
                <div class="col-md-3">
                    <x-admin.static-image-item imageName="our_app.png" label="Image application" />
                </div>
                <div class="col-md-3">
                    <x-admin.static-image-item imageName="black_google_play.png" label="Bouton Google Play" />
                </div>
                <div class="col-md-3">
                    <x-admin.static-image-item imageName="black_appstore.png" label="Bouton App Store" />
                </div>
            </div>
        </div>
    </div>

    <!-- Section En-tête de la page -->
    <div class="card mb-3 page-section">
        <div class="card-header">
            <h5 class="mb-0"><i class="bi bi-file-earmark-text"></i> En-tête de la page</h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Badge <span class="text-danger">*</span></label>
                <input type="text" name="badge_text" class="form-control" value="{{ old('badge_text', $page->badge_text ?? 'Question & Réponse') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Titre principal <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $page->title ?? 'FAQs - Foire aux questions') }}" required>
                <small class="text-muted">Vous pouvez utiliser &lt;span&gt; pour mettre du texte en évidence.</small>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea id="faq-content-editor" name="content" class="form-control wysiwyg-editor" rows="5">{{ old('content', $page->content ?? '') }}</textarea>
            </div>
        </div>
    </div>

    <!-- Section Liste des FAQs -->
    <div class="card mb-3 page-section">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-question-circle"></i> Questions / Réponses</h5>
            <a href="{{ route('admin.faq.create') }}" class="btn btn-sm btn-primary">
                <i class="bi bi-plus-circle"></i> Ajouter une question
            </a>
        </div>
        <div class="card-body">
            <div class="section-info">
                <i class="bi bi-info-circle-fill"></i>
                Les questions ci-dessous sont affichées dans l'ordre sur la page FAQ publique.
            </div>

            @if($faqs->count() > 0)
                <div class="accordion" id="faqAccordion">
                    @foreach($faqs as $index => $faq)
                        <div class="content-preview mb-3">
                            <div class="card-header bg-white" style="border-bottom: 1px solid #eef2f6; padding: 1.5rem;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="flex-grow-1">
                                        <strong style="color: #2c3e50;">{{ $faq->question }}</strong>
                                        @if($faq->category)
                                            <span class="badge bg-info ms-2">{{ $faq->category }}</span>
                                        @endif
                                        @if($faq->is_featured)
                                            <span class="badge bg-warning ms-2">Vedette</span>
                                        @endif
                                        @if(!$faq->is_published)
                                            <span class="badge bg-secondary ms-2">Non publié</span>
                                        @endif
                                    </div>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.faq.edit', $faq) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i> Modifier
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger delete-faq-btn" data-faq-id="{{ $faq->id }}" data-faq-question="{{ $faq->question }}">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="mb-0" style="color: #495057; line-height: 1.7;">{{ Str::limit(strip_tags($faq->answer), 200) }}</p>
                                <div class="mt-3">
                                    <small class="text-muted">
                                        <i class="bi bi-list-ol"></i> Ordre: {{ $faq->order }} |
                                        <i class="bi bi-calendar"></i> Créé: {{ $faq->created_at->format('d/m/Y') }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-3">
                    {{ $faqs->links() }}
                </div>
            @else
                <div class="empty-state">
                    <i class="bi bi-question-circle"></i>
                    <p class="text-muted mt-3">Aucune question FAQ pour le moment.</p>
                    <a href="{{ route('admin.faq.create') }}" class="btn btn-primary mt-3">
                        <i class="bi bi-plus-circle"></i> Créer votre première question FAQ
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Section Formulaire "Poser une question" -->
    <div class="card mb-3 page-section">
        <div class="card-header">
            <h5 class="mb-0"><i class="bi bi-chat-dots"></i> Poser une question</h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Titre</label>
                <input type="text" name="ask_question_title" class="form-control" value="{{ old('ask_question_title', $page->ask_question_title ?? 'Vous avez une question ?') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Sous-titre</label>
                <input type="text" name="ask_question_subtitle" class="form-control" value="{{ old('ask_question_subtitle', $page->ask_question_subtitle ?? 'Posez votre question') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="ask_question_description" class="form-control" rows="2">{{ old('ask_question_description', $page->ask_question_description ?? 'Nous répondrons à votre question dans les plus brefs délais.') }}</textarea>
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
            <button type="submit" id="submitFaqPageForm" class="btn btn-primary">
                <i class="bi bi-check-circle"></i> Enregistrer les modifications
            </button>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
    // Gestion du formulaire principal
    document.addEventListener('DOMContentLoaded', function() {
        var form = document.getElementById('faqPageForm');
        var submitBtn = document.getElementById('submitFaqPageForm');
        
        if (form && submitBtn) {
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
                form.submit();
            });

            // Synchroniser TinyMCE sur submit du formulaire
            form.addEventListener('submit', function(e) {
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
</script>
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

// Gestion des formulaires de modification d'images statiques
// IMPORTANT: Ce code ne doit JAMAIS intercepter le formulaire principal
document.addEventListener('DOMContentLoaded', function() {
    // Sélectionner UNIQUEMENT les formulaires dans les modals d'images statiques
    var imageForms = document.querySelectorAll('.modal form[id^="editImageForm"]');
    
    imageForms.forEach(function(form) {
        // Vérifications strictes
        var formId = form.getAttribute('id') || '';
        var formAction = form.getAttribute('action') || '';
        
        // EXCLUSIONS STRICTES - Ignorer absolument le formulaire principal
        if (formId === 'faqPageForm') {
            console.log('Formulaire principal ignoré dans le gestionnaire d\'images');
            return;
        }
        
        // Ignorer les formulaires DELETE pour les FAQs
        if (formId.startsWith('deleteFaqForm_')) {
            return;
                            }
        
        // Ignorer tous les formulaires qui ne sont pas dans un modal
        if (!form.closest('.modal')) {
            return;
        }
        
        // Ignorer si ce n'est PAS un formulaire d'image statique dans un modal
        if (!formId.startsWith('editImageForm') || 
            !formAction.includes('static-images.update')) {
            return;
        }
        
        // Vérification finale : ne pas intercepter si l'action pointe vers faq-page/update
        if (formAction.includes('faq-page/update')) {
            console.error('ATTENTION: Tentative d\'interception du formulaire principal détectée et bloquée');
            return;
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

// Gestion de la suppression des FAQs via AJAX (pour éviter les conflits avec le formulaire principal)
document.addEventListener('DOMContentLoaded', function() {
    var deleteButtons = document.querySelectorAll('.delete-faq-btn');
    
    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            var faqId = this.getAttribute('data-faq-id');
            var faqQuestion = this.getAttribute('data-faq-question');
            
            if (!confirm('Supprimer cette FAQ : "' + faqQuestion + '" ?')) {
                return;
            }
            
            var formData = new FormData();
            formData.append('_method', 'DELETE');
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
            
            fetch('/admin/faq/' + faqId, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => {
                if (response.ok) {
                    window.location.reload();
                } else {
                    alert('Erreur lors de la suppression de la FAQ.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Erreur lors de la suppression de la FAQ.');
            });
        });
    });
    });
</script>
@endpush

