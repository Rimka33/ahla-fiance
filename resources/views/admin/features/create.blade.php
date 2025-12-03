@extends('admin.layout')

@section('title', 'Créer fonctionnalité')
@section('page-title', 'Nouvelle fonctionnalité')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Créer une nouvelle fonctionnalité</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.features.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Titre <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="icon" class="form-label">Icône</label>
                    <input type="file" class="form-control @error('icon') is-invalid @enderror" id="icon" name="icon" accept="image/*">
                    @error('icon')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="image_frame" class="form-label">Image Frame</label>
                    <input type="file" class="form-control @error('image_frame') is-invalid @enderror" id="image_frame" name="image_frame" accept="image/*">
                    @error('image_frame')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="image_screen" class="form-label">Image Screen</label>
                    <input type="file" class="form-control @error('image_screen') is-invalid @enderror" id="image_screen" name="image_screen" accept="image/*">
                    @error('image_screen')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
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
                            <label class="form-check-label" for="is_active">Activer cette fonctionnalité</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer avec boutons toujours visibles -->
            <div class="page-edit-footer">
                <a href="{{ route('admin.features.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Retour
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Créer la fonctionnalité
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

