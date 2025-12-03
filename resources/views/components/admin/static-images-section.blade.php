@php
    use App\Models\Media;
    
    // Liste des images statiques utilisées sur cette page
    $staticImages = [];
    
    if (isset($images)) {
        // Si les images sont passées directement
        $staticImages = $images;
    } else {
        // Sinon, récupérer les images par défaut pour la page d'accueil
        $defaultImages = [
            'banavt1.png', 'banavt2.png', 'banavt3.png', 'play.svg',
            'smallStar.png', 'bigstar.png', 'bannerScreen1.png', 'bannerScreen2.png',
            'bannerScreen3.png', 'bannerScreen4.png', 'bannerScreen5.png', 'iphonescren.png',
            'blue_dotes.png', 'feature1a.png', 'feature1b.png', 'feature2a.png',
            'feature2b.png', 'feature3a.png', 'feature3b.png', 'recharge.png',
            'echange.png', 'qr.png', 'appscreen.png', 'applicationvideothumb.png',
            'ergonome.png', 'security.png', 'support.png', 'howstep1.png',
            'howstep2.png', 'howstep3.png', 'intrscrn1.png', 'intrscrn2.png',
            'intrscrn3.png', 'intrscrn4.png', 'intrscrn5.png', 'intrscrn6.png',
            'intrscrn7.png', 'intrscrn8.png', 'intrscrn9.png'
        ];
        
        foreach ($defaultImages as $imageName) {
            $media = Media::where('file_path', 'images/' . $imageName)
                ->where('file_type', 'image')
                ->first();
            if ($media) {
                $staticImages[] = $media;
            }
        }
    }
@endphp

@if(count($staticImages) > 0)
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="bi bi-images me-2"></i>Images Statiques Utilisées sur cette Page
        </h5>
    </div>
    <div class="card-body">
        <div class="alert alert-info mb-3">
            <i class="bi bi-info-circle me-2"></i>
            <strong>Astuce :</strong> Cliquez sur "Modifier" pour changer une image. Les modifications seront appliquées immédiatement sur le site.
        </div>
        
        <div class="row g-3">
            @foreach($staticImages as $image)
                <div class="col-md-3 col-sm-4 col-6">
                    <div class="card h-100 border">
                        <div class="position-relative" style="max-width: 100%; overflow: hidden; height: 150px; background: #f8f9fa;">
                            <img src="{{ asset($image->file_path) }}" 
                                 alt="{{ $image->alt_text ?? $image->title }}" 
                                 class="w-100 h-100" 
                                 style="object-fit: contain; padding: 8px;"
                                 id="static-image-preview-{{ $image->id }}">
                        </div>
                        <div class="card-body p-2">
                            <h6 class="card-title mb-1 small" title="{{ $image->title }}">
                                {{ Str::limit($image->title, 20) }}
                            </h6>
                            <p class="card-text small text-muted mb-0" title="{{ basename($image->file_path) }}">
                                <i class="bi bi-file-image"></i> {{ basename($image->file_path) }}
                            </p>
                        </div>
                        <div class="card-footer p-2 bg-transparent border-top">
                            <button type="button" 
                                    class="btn btn-sm btn-primary w-100" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editImageModal{{ $image->id }}">
                                <i class="bi bi-pencil me-1"></i> Modifier
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Modal pour modifier l'image -->
                <div class="modal fade" id="editImageModal{{ $image->id }}" tabindex="-1" aria-labelledby="editImageModalLabel{{ $image->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <form method="POST" action="{{ route('admin.static-images.update', $image) }}" enctype="multipart/form-data" id="editImageForm{{ $image->id }}">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editImageModalLabel{{ $image->id }}">
                                        <i class="bi bi-pencil me-2"></i>Modifier l'image : {{ $image->title }}
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Titre <span class="text-danger">*</span></label>
                                            <input type="text" name="title" class="form-control" value="{{ $image->title }}" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Texte alternatif (Alt)</label>
                                            <input type="text" name="alt_text" class="form-control" value="{{ $image->alt_text }}">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea name="description" class="form-control" rows="2">{{ $image->description }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Remplacer l'image</label>
                                        <input type="file" name="image" class="form-control" accept="image/*" onchange="previewImageModal(this, 'imagePreview{{ $image->id }}')">
                                        <small class="text-muted">Formats acceptés : JPG, PNG, GIF, WEBP, SVG. Taille max : 5MB.</small>
                                        <div id="imagePreview{{ $image->id }}" class="mt-2"></div>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-muted small mb-2"><strong>Image actuelle :</strong></p>
                                        <div class="position-relative d-inline-block" style="max-width: 100%; overflow: hidden;">
                                            <img src="{{ asset($image->file_path) }}" alt="{{ $image->alt_text ?? $image->title }}" 
                                                 class="img-fluid" style="max-width: 100%; max-height: 200px; object-fit: contain; border-radius: 8px; border: 2px solid #e0e0e0;">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-check-circle me-1"></i> Enregistrer
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@push('scripts')
<script>
function previewImageModal(input, previewId) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var previewDiv = document.getElementById(previewId);
            if (previewDiv) {
                previewDiv.innerHTML = '<div class="position-relative d-inline-block w-100" style="max-width: 100%; overflow: hidden;"><img src="' + e.target.result + '" class="img-fluid" style="max-width: 100%; max-height: 200px; width: auto; height: auto; border-radius: 8px; border: 2px solid #e0e0e0; margin-top: 10px; object-fit: contain;"></div>';
            }
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Rafraîchir la page après modification réussie
document.addEventListener('DOMContentLoaded', function() {
    @foreach($staticImages as $image)
        document.getElementById('editImageForm{{ $image->id }}').addEventListener('submit', function(e) {
            var form = this;
            e.preventDefault();
            
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
                    // Fermer le modal
                    var modal = bootstrap.Modal.getInstance(document.getElementById('editImageModal{{ $image->id }}'));
                    if (modal) {
                        modal.hide();
                    }
                    
                    // Afficher un message de succès
                    alert('Image mise à jour avec succès !');
                    
                    // Rafraîchir la page
                    window.location.reload();
                } else {
                    alert('Erreur lors de la modification : ' + (data.message || 'Une erreur est survenue'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Erreur lors de la modification : ' + error.message);
                // En cas d'erreur, soumettre le formulaire normalement
                form.submit();
            });
        });
    @endforeach
});
</script>
@endpush
@endif

