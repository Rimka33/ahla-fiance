@extends('admin.layout')

@section('title', 'Créer une catégorie')
@section('page-title', 'Nouvelle catégorie')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Créer une nouvelle catégorie</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.news-categories.store') }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nom <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="slug" class="form-label">Slug (URL)</label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug') }}">
                @error('slug')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Laissé vide pour générer automatiquement</small>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="color" class="form-label">Couleur (hex)</label>
                    <input type="color" class="form-control form-control-color @error('color') is-invalid @enderror" id="color" name="color" value="{{ old('color', '#6c757d') }}">
                    @error('color')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Pour les badges d'affichage</small>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="order" class="form-label">Ordre</label>
                    <input type="number" class="form-control @error('order') is-invalid @enderror" id="order" name="order" value="{{ old('order', 0) }}" min="0">
                    @error('order')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Catégorie active</label>
                </div>
            </div>

            <!-- Footer avec boutons toujours visibles -->
            <div class="page-edit-footer">
                <a href="{{ route('admin.news-categories.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Retour
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Créer la catégorie
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
