@php
    use App\Models\Media;
    use Illuminate\Support\Str;

    // Récupérer l'image depuis la base de données ou créer une référence
    $filePath = 'images/' . $imageName;
    $media = Media::where('file_path', $filePath)
        ->where('file_type', 'image')
        ->first();

    // Si l'image n'existe pas dans la base, créer une référence temporaire pour l'affichage
    if (!$media) {
        // Vérifier si le fichier existe physiquement
        $physicalPath = public_path($filePath);
        $fileExists = file_exists($physicalPath);

        // Créer des IDs uniques
        $uniqueId = Str::random(10);
        $formId = 'static_image_form_' . $uniqueId;
        $uploadingId = 'uploading_' . $uniqueId;
    } else {
        $uniqueId = $media->id;
        $formId = 'static_image_form_' . $uniqueId;
        $uploadingId = 'uploading_' . $uniqueId;
        $fileExists = file_exists(public_path($media->file_path));
    }
@endphp

<div class="static-image-item mb-3 mt-4 p-3 border rounded" data-form-id="{{ $formId }}" style="background: #f8f9fa;">
    <div class="d-flex align-items-center gap-3">
        <!-- Image Preview -->
        <div class="flex-shrink-0 static-image-preview" style="width: 80px; height: 80px; overflow: hidden; border-radius: 8px; background: white; display: flex; align-items: center; justify-content: center; border: 2px solid #e0e0e0;">
            @if($media && $fileExists)
                <img src="{{ asset($media->file_path) }}"
                     alt="{{ $media->alt_text ?? $media->title }}"
                     class="img-fluid"
                     style="max-width: 100%; max-height: 100%; object-fit: contain;">
            @elseif($fileExists)
                <img src="{{ asset($filePath) }}"
                     alt="{{ $label ?? basename($filePath) }}"
                     class="img-fluid"
                     style="max-width: 100%; max-height: 100%; object-fit: contain;">
            @else
                <div class="text-center text-muted" style="font-size: 0.8rem;">
                    <i class="bi bi-image" style="font-size: 2rem;"></i>
                    <div>Aucune image</div>
                </div>
            @endif
        </div>

        <!-- Content & Controls -->
        <div class="flex-grow-1">
            <h6 class="mb-2">{{ $label ?? basename($imageName) }}</h6>

            <div class="d-flex align-items-center gap-2">
                <!-- File Input (Linked to external form) -->
                <div class="input-group input-group-sm" style="max-width: 300px;">
                    <input type="file"
                           name="image"
                           class="form-control"
                           accept="image/*"
                           form="{{ $formId }}"
                           onchange="submitStaticImage('{{ $formId }}', '{{ $uploadingId }}')">
                </div>

                <!-- Loading Spinner -->
                <div id="{{ $uploadingId }}" style="display: none;" class="text-primary">
                    <div class="spinner-border spinner-border-sm" role="status">
                        <span class="visually-hidden">Chargement...</span>
                    </div>
                </div>

                <!-- Success Message -->
                <div class="static-image-success" style="display: none; color: #10b981;">
                    <i class="bi bi-check-circle"></i> <small>Mis à jour</small>
                </div>
            </div>

            @if(!$media || !$fileExists)
                <small class="text-muted d-block mt-1">Sélectionnez une image pour l'uploader</small>
            @endif
        </div>
    </div>
</div>

@push('modals')
<!-- Formulaire invisible placé hors du formulaire principal -->
<form id="{{ $formId }}"
      action="{{ $media ? route('admin.static-images.update', $media) : route('admin.static-images.store') }}"
      method="POST"
      enctype="multipart/form-data"
      style="display: none;">
    @csrf
    <input type="hidden" name="image_name" value="{{ $imageName }}">
    <input type="hidden" name="file_path" value="{{ $filePath }}">
</form>
@endpush

@once
@push('scripts')
<script>
function submitStaticImage(formId, uploadingId) {
    var form = document.getElementById(formId);
    var uploadingSpinner = document.getElementById(uploadingId);

    if (!form) return;

    // Afficher le spinner
    if (uploadingSpinner) uploadingSpinner.style.display = 'block';

    var formData = new FormData(form);

    // Récupérer l'input file associé via l'attribut form
    var fileInput = document.querySelector('input[type="file"][form="' + formId + '"]');
    if (fileInput && fileInput.files[0]) {
        formData.set('image', fileInput.files[0]);
    }

    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(data => {
        try {
            // Masquer le spinner dans tous les cas
            if (uploadingSpinner) uploadingSpinner.style.display = 'none';

            if (data.success) {
                // Mettre à jour l'aperçu de l'image sans recharger
                var container = document.querySelector('[data-form-id="' + formId + '"]');
                if (container && data.image && data.image.url) {
                    var imgElement = container.querySelector('.static-image-preview img');
                    if (!imgElement) {
                        // Créer l'élément img s'il n'existe pas
                        var previewDiv = container.querySelector('.static-image-preview');
                        imgElement = document.createElement('img');
                        imgElement.className = 'img-fluid';
                        imgElement.style.cssText = 'max-width: 100%; max-height: 100%; object-fit: contain;';
                        previewDiv.innerHTML = '';
                        previewDiv.appendChild(imgElement);
                    }
                    // Mettre à jour l'URL avec cache-busting
                    imgElement.src = data.image.url;

                    // Afficher le message de succès
                    var successMsg = container.querySelector('.static-image-success');
                    if (successMsg) {
                        successMsg.style.display = 'block';
                        setTimeout(() => {
                            successMsg.style.display = 'none';
                        }, 3000);
                    }

                    // Réinitialiser l'input file
                    if (fileInput) fileInput.value = '';
                } else {
                    // Fallback : recharger la page si pas d'image retournée
                    window.location.reload();
                }
            } else {
                alert('Erreur : ' + (data.message || 'Une erreur est survenue'));
            }
        } catch (error) {
            console.error('Error processing response:', error);
            alert('Erreur technique lors de la mise à jour');
            if (uploadingSpinner) uploadingSpinner.style.display = 'none';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Erreur technique lors de l\'upload');
        if (uploadingSpinner) uploadingSpinner.style.display = 'none';
    });
}
</script>
@endpush
@endonce

