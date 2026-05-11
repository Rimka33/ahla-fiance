@php
    use App\Models\Media;
    use Illuminate\Support\Str;

    $filePath = 'images/' . $imageName;
    $media = Media::where('file_path', $filePath)->where('file_type', 'image')->first();

    if (!$media) {
        $physicalPath = public_path($filePath);
        $fileExists   = file_exists($physicalPath);
        $uniqueId     = Str::random(10);
    } else {
        $uniqueId   = $media->id;
        $fileExists = file_exists(public_path($media->file_path));
    }

    $formId      = 'static_image_form_' . $uniqueId;
    $uploadingId = 'uploading_' . $uniqueId;
@endphp

<div class="sii-card" data-form-id="{{ $formId }}">

    {{-- Aperçu --}}
    <div class="sii-preview">
        @if(($media && $fileExists) || (!$media && $fileExists))
            <img src="{{ asset($filePath) }}" alt="{{ $label ?? basename($imageName) }}">
        @else
            <i class="bi bi-image"></i>
        @endif
    </div>

    {{-- Label --}}
    <p class="sii-label">{{ $label ?? basename($imageName) }}</p>

    {{-- Input --}}
    <input type="file"
           name="image"
           class="form-control form-control-sm"
           accept="image/*"
           form="{{ $formId }}"
           onchange="submitStaticImage('{{ $formId }}', '{{ $uploadingId }}')">

    {{-- États --}}
    <div id="{{ $uploadingId }}" class="sii-state" style="display:none;">
        <div class="spinner-border spinner-border-sm text-primary" role="status"></div>
        <small>Upload…</small>
    </div>
    <div class="sii-state sii-success" style="display:none;">
        <i class="bi bi-check-circle-fill text-success"></i>
        <small class="text-success">Mis à jour</small>
    </div>

    @if(!$media || !$fileExists)
        <small class="sii-hint">Sélectionnez une image pour l'uploader</small>
    @endif
</div>

@push('modals')
<form id="{{ $formId }}"
      action="{{ $media ? route('admin.static-images.update', $media) : route('admin.static-images.store') }}"
      method="POST"
      enctype="multipart/form-data"
      style="display:none;">
    @csrf
    <input type="hidden" name="image_name" value="{{ $imageName }}">
    <input type="hidden" name="file_path"  value="{{ $filePath }}">
</form>
@endpush

@once
@push('scripts')
<script>
function submitStaticImage(formId, uploadingId) {
    var form      = document.getElementById(formId);
    var spinner   = document.getElementById(uploadingId);
    if (!form) return;

    if (spinner) spinner.style.display = 'flex';

    var fileInput = document.querySelector('input[type="file"][form="' + formId + '"]');
    var formData  = new FormData(form);
    if (fileInput && fileInput.files[0]) formData.set('image', fileInput.files[0]);

    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
    })
    .then(r => r.json())
    .then(data => {
        if (spinner) spinner.style.display = 'none';
        var container = document.querySelector('[data-form-id="' + formId + '"]');
        if (data.success) {
            if (data.image && data.image.url) {
                var img = container.querySelector('.sii-preview img');
                if (!img) {
                    img = document.createElement('img');
                    container.querySelector('.sii-preview').innerHTML = '';
                    container.querySelector('.sii-preview').appendChild(img);
                }
                img.src = data.image.url + '?v=' + Date.now();
            }
            var ok = container.querySelector('.sii-success');
            if (ok) { ok.style.display = 'flex'; setTimeout(() => ok.style.display = 'none', 3000); }
            if (fileInput) fileInput.value = '';
        } else {
            alert('Erreur : ' + (data.message || 'Une erreur est survenue'));
        }
    })
    .catch(() => {
        if (spinner) spinner.style.display = 'none';
        alert('Erreur technique lors de l\'upload');
    });
}
</script>
@endpush
@endonce

<style>
.sii-card {
    background: var(--ahla-white);
    border: 1px solid var(--ahla-gray-200);
    border-radius: var(--border-radius);
    padding: 0.875rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
    text-align: center;
    height: 100%;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
}
.sii-card:hover {
    border-color: var(--ahla-blue-light);
    box-shadow: var(--shadow-sm);
}
.sii-preview {
    width: 72px;
    height: 72px;
    border-radius: 10px;
    background: var(--ahla-gray-100);
    border: 1px solid var(--ahla-gray-200);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    flex-shrink: 0;
}
.sii-preview img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
}
.sii-preview i {
    font-size: 1.75rem;
    color: var(--ahla-gray-400);
}
.sii-label {
    font-size: 0.78rem;
    font-weight: 600;
    color: var(--ahla-gray-700);
    margin: 0;
    line-height: 1.3;
}
.sii-card .form-control-sm {
    font-size: 0.72rem;
    width: 100%;
}
.sii-hint {
    font-size: 0.68rem;
    color: var(--ahla-gray-400);
}
.sii-state {
    display: flex;
    align-items: center;
    gap: 0.35rem;
    font-size: 0.75rem;
    justify-content: center;
}
</style>
