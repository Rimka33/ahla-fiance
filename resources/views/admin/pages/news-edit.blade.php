@extends('admin.layout')

@section('title', 'Page Actualités')
@section('page-title', 'Modifier la Page Actualités')

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

<form method="POST" action="{{ route('admin.news.page.update') }}" novalidate>
    @csrf
    @csrf


    <!-- Section En-tête de la page -->
    <div class="card mb-3 page-section">
        <div class="card-header">
            <h5 class="mb-0"><i class="bi bi-newspaper"></i> En-tête de la page</h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Badge <span class="text-danger">*</span></label>
                <input type="text" name="badge_text" class="form-control" value="{{ old('badge_text', $page->badge_text ?? 'Actualités') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Titre principal <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $page->title ?? 'Nos dernières actualités') }}" required>
                <small class="text-muted">Vous pouvez utiliser &lt;span&gt; pour mettre du texte en évidence.</small>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="subtitle" class="form-control" rows="3">{{ old('subtitle', $page->subtitle ?? 'Restez informé des dernières nouveautés, annonces et événements liés à Ahla Finance.') }}</textarea>
            </div>
        </div>
    </div>

    <!-- Section Liste des Actualités -->
    <div class="card mb-3 page-section">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-newspaper"></i> Articles d'actualités</h5>
            <a href="{{ route('admin.news.create') }}" class="btn btn-sm btn-primary">
                <i class="bi bi-plus-circle"></i> Ajouter un article
            </a>
        </div>
        <div class="card-body">
            <div class="section-info">
                <i class="bi bi-info-circle-fill"></i>
                Les articles ci-dessous sont affichés dans l'ordre chronologique (plus récents en premier) sur la page Actualités publique.
            </div>

            @if($news->count() > 0)
                <div class="row">
                    @foreach($news as $article)
                        <div class="col-md-6 mb-4">
                            <div class="content-preview h-100">
                                @if($article->image)
                                    <img src="{{ asset('storage/' . $article->image) }}" class="card-img-top" alt="{{ $article->title }}" style="height: 200px; object-fit: cover;">
                                @endif
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div>
                                            @if($article->category)
                                                <span class="badge bg-info">{{ $article->category->name }}</span>
                                            @endif
                                            @if($article->is_published)
                                                <span class="badge bg-success">Publié</span>
                                            @else
                                                <span class="badge bg-secondary">Brouillon</span>
                                            @endif
                                        </div>
                                        @if($article->published_at)
                                            <small class="text-muted">{{ $article->published_at->format('d/m/Y') }}</small>
                                        @endif
                                    </div>
                                    <h5 class="card-title" style="font-size: 1.15rem; font-weight: 700; color: #2c3e50;">
                                        {{ Str::limit($article->title, 60) }}
                                    </h5>
                                    <p class="card-text" style="color: #6c757d; font-size: 0.9rem;">
                                        {{ Str::limit(strip_tags($article->excerpt ?? $article->content), 120) }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="{{ route('admin.news.edit', $article) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i> Modifier
                                        </a>
                                        <a href="{{ route('news.show', $article->slug) }}" class="btn btn-sm btn-outline-info" target="_blank">
                                            <i class="bi bi-eye"></i> Voir
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-3">
                    {{ $news->links() }}
                </div>
            @else
                <div class="empty-state">
                    <i class="bi bi-newspaper"></i>
                    <p class="text-muted mt-3">Aucun article pour le moment.</p>
                    <a href="{{ route('admin.news.create') }}" class="btn btn-primary mt-3">
                        <i class="bi bi-plus-circle"></i> Créer votre premier article
                    </a>
                </div>
            @endif
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
            <button type="submit" id="submitNewsPageForm" class="btn btn-primary">
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
    var mainForm = document.querySelector('form[action="{{ route('admin.news.page.update') }}"]');
    var submitBtn = document.getElementById('submitNewsPageForm');
    
    if (mainForm && submitBtn) {
            // Event listener sur le bouton submit
            submitBtn.addEventListener('click', function(e) {
                // Synchroniser TinyMCE si disponible AVANT la soumission
                if (typeof tinymce !== 'undefined') {
                    try {
                        tinymce.triggerSave();
                    } catch (error) {
                        console.error('Erreur TinyMCE:', error);
                    }
                }
                
                // Forcer la soumission après un court délai
                // Avec novalidate, on soumet directement sans vérifier la validité HTML
                setTimeout(function() {
                    mainForm.submit();
                }, 100);
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

