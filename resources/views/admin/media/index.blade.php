@extends('admin.layout')

@section('title', 'Gestionnaire de Médias')
@section('page-title', 'Gestionnaire de Médias')

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Succès !</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Erreur !</strong> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-images me-2"></i>Bibliothèque Médias</h5>
                <div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal">
                        <i class="bi bi-cloud-upload"></i> Uploader un fichier
                    </button>
                </div>
            </div>
            <div class="card-body">
                <!-- Recherche -->
                <form method="GET" action="{{ route('admin.media.index') }}" class="mb-4">
                    <div class="row g-3">
                        <div class="col-md-10">
                            <input type="text" name="search" class="form-control" placeholder="Rechercher un fichier..." value="{{ $search }}">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-search"></i> Rechercher
                            </button>
                        </div>
                    </div>
                </form>

                @if(count($files) > 0)
                    <div class="row g-3">
                        @foreach($files as $file)
                            <div class="col-md-2 col-sm-4 col-6">
                                <div class="card h-100">
                                    @if($file['isImage'])
                                        <img src="{{ asset('storage/' . $file['path']) }}" class="card-img-top" alt="{{ $file['name'] }}" style="height: 150px; object-fit: cover;">
                                    @else
                                        <div class="card-img-top d-flex align-items-center justify-content-center bg-light" style="height: 150px;">
                                            <i class="bi bi-file-earmark" style="font-size: 3rem;"></i>
                                        </div>
                                    @endif
                                    <div class="card-body p-2">
                                        <p class="card-text small mb-1" title="{{ $file['name'] }}">
                                            {{ Str::limit($file['name'], 20) }}
                                        </p>
                                        <small class="text-muted">
                                            @php
                                                $base = log($file['size'], 1024);
                                                $suffixes = array('B', 'KB', 'MB', 'GB', 'TB');
                                                echo round(pow(1024, $base - floor($base)), 2) . ' ' . $suffixes[floor($base)];
                                            @endphp
                                        </small>
                                    </div>
                                    <div class="card-footer p-2">
                                        <div class="btn-group w-100" role="group">
                                            <a href="{{ $file['url'] }}" target="_blank" class="btn btn-sm btn-outline-primary" title="Voir">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="copyToClipboard('{{ $file['url'] }}')" title="Copier l'URL">
                                                <i class="bi bi-clipboard"></i>
                                            </button>
                                            <form action="{{ route('admin.media.destroy', urlencode($file['path'])) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ce fichier ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Supprimer">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <i class="bi bi-folder-x"></i>
                        <p class="text-muted mt-3">Aucun fichier trouvé.</p>
                        <p class="text-muted small">Utilisez le bouton "Uploader un fichier" pour commencer.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal Upload -->
<div class="modal fade" id="uploadModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Uploader un fichier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="uploadForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="file" class="form-label">Fichier <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="file" name="file" required accept="image/*,video/*,.pdf,.doc,.docx">
                        <small class="text-muted">Taille max: 10MB</small>
                    </div>
                    <div class="mb-3">
                        <label for="folder" class="form-label">Dossier (optionnel)</label>
                        <input type="text" class="form-control" id="folder" name="folder" value="uploads" placeholder="uploads">
                    </div>
                    <div id="upload-progress" class="progress d-none mb-3">
                        <div class="progress-bar" role="progressbar" style="width: 0%"></div>
                    </div>
                    <div id="upload-message"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Uploader</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        alert('URL copiée dans le presse-papiers !');
    });
}

document.getElementById('uploadForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const form = this;
    const formData = new FormData(form);
    const progressBar = document.querySelector('#upload-progress .progress-bar');
    const progressDiv = document.getElementById('upload-progress');
    const messageDiv = document.getElementById('upload-message');

    progressDiv.classList.remove('d-none');
    messageDiv.innerHTML = '';

    fetch('{{ route("admin.media.upload") }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            messageDiv.innerHTML = '<div class="alert alert-success">' + data.message + '</div>';
            progressBar.style.width = '100%';
            setTimeout(() => {
                location.reload();
            }, 1500);
        } else {
            messageDiv.innerHTML = '<div class="alert alert-danger">' + data.message + '</div>';
        }
    })
    .catch(error => {
        messageDiv.innerHTML = '<div class="alert alert-danger">Erreur lors de l\'upload</div>';
    });
});
</script>
@endsection

@php
function formatBytes($size, $precision = 2) {
    $base = log($size, 1024);
    $suffixes = array('B', 'KB', 'MB', 'GB', 'TB');
    return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];
}
@endphp

