@extends('admin.layout')

@section('title', 'Modifier une catégorie')
@section('page-title', 'Modifier la catégorie')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Modifier la catégorie</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.news-categories.update', $newsCategory) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nom <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $newsCategory->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="slug" class="form-label">Slug (URL)</label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $newsCategory->slug) }}">
                @error('slug')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $newsCategory->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="color" class="form-label">Couleur (hex)</label>
                    <input type="color" class="form-control form-control-color @error('color') is-invalid @enderror" id="color" name="color" value="{{ old('color', $newsCategory->color ?? '#6c757d') }}">
                    @error('color')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="order" class="form-label">Ordre</label>
                    <input type="number" class="form-control @error('order') is-invalid @enderror" id="order" name="order" value="{{ old('order', $newsCategory->order) }}" min="0">
                    @error('order')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $newsCategory->is_active) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Catégorie active</label>
                </div>
            </div>

            @if($newsCategory->news()->count() > 0)
                <div class="alert alert-info">
                    <i class="bi bi-info-circle"></i> Cette catégorie est utilisée dans {{ $newsCategory->news()->count() }} actualité(s).
                </div>
            @endif

            <!-- Footer avec boutons toujours visibles -->
            <div class="page-edit-footer">
                <a href="{{ route('admin.news-categories.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Retour
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
