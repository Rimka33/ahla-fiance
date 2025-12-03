@extends('admin.layout')

@section('title', 'Créer lien')
@section('page-title', 'Nouveau lien de téléchargement')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Créer un nouveau lien de téléchargement</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.download-links.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="platform" class="form-label">Plateforme <span class="text-danger">*</span></label>
                <select class="form-select @error('platform') is-invalid @enderror" id="platform" name="platform" required>
                    <option value="">Choisir une plateforme</option>
                    <option value="android" {{ old('platform') == 'android' ? 'selected' : '' }}>Android</option>
                    <option value="ios" {{ old('platform') == 'ios' ? 'selected' : '' }}>iOS</option>
                    <option value="mac" {{ old('platform') == 'mac' ? 'selected' : '' }}>macOS</option>
                    <option value="windows" {{ old('platform') == 'windows' ? 'selected' : '' }}>Windows</option>
                </select>
                @error('platform')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="url" class="form-label">URL <span class="text-danger">*</span></label>
                <input type="url" class="form-control @error('url') is-invalid @enderror" id="url" name="url" value="{{ old('url') }}" placeholder="https://..." required>
                @error('url')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="icon" class="form-label">Icône</label>
                <input type="file" class="form-control @error('icon') is-invalid @enderror" id="icon" name="icon" accept="image/*">
                @error('icon')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Activer ce lien</label>
                </div>
            </div>

            <!-- Footer avec boutons toujours visibles -->
            <div class="page-edit-footer">
                <a href="{{ route('admin.download-links.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Retour
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Créer le lien
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

