@extends('admin.layout')

@section('title', 'Créer section Hero')
@section('page-title', 'Nouvelle section Hero')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Créer une nouvelle section Hero</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.hero-sections.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="main_title" class="form-label">Titre principal <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('main_title') is-invalid @enderror" id="main_title" name="main_title" value="{{ old('main_title') }}" required>
                @error('main_title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="subtitle" class="form-label">Sous-titre</label>
                <input type="text" class="form-control @error('subtitle') is-invalid @enderror" id="subtitle" name="subtitle" value="{{ old('subtitle') }}">
                @error('subtitle')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="typed_strings" class="form-label">Mots animés (séparés par des virgules)</label>
                <input type="text" class="form-control @error('typed_strings') is-invalid @enderror" id="typed_strings" name="typed_strings" value="{{ old('typed_strings') }}" placeholder="Ex: Sécurisé, Rapide, Simple">
                @error('typed_strings')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Séparez chaque mot par une virgule</small>
            </div>

            <div class="mb-3">
                <label for="background_image" class="form-label">Image de fond</label>
                <input type="file" class="form-control @error('background_image') is-invalid @enderror" id="background_image" name="background_image" accept="image/*">
                @error('background_image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="cta_button_text" class="form-label">Texte du bouton CTA</label>
                    <input type="text" class="form-control @error('cta_button_text') is-invalid @enderror" id="cta_button_text" name="cta_button_text" value="{{ old('cta_button_text') }}">
                    @error('cta_button_text')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="cta_button_link" class="form-label">Lien du bouton CTA</label>
                    <input type="url" class="form-control @error('cta_button_link') is-invalid @enderror" id="cta_button_link" name="cta_button_link" value="{{ old('cta_button_link') }}">
                    @error('cta_button_link')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="video_url" class="form-label">URL Vidéo</label>
                <input type="url" class="form-control @error('video_url') is-invalid @enderror" id="video_url" name="video_url" value="{{ old('video_url') }}">
                @error('video_url')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="order" class="form-label">Ordre d'affichage</label>
                    <input type="number" class="form-control @error('order') is-invalid @enderror" id="order" name="order" value="{{ old('order', 0) }}" min="0">
                    @error('order')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Options</label>
                    <div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Activer cette section</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer avec boutons toujours visibles -->
            <div class="page-edit-footer">
                <a href="{{ route('admin.hero-sections.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Retour
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Créer la section
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

