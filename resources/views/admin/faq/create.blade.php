@extends('admin.layout')

@section('title', 'Créer une FAQ')
@section('page-title', 'Nouvelle Question FAQ')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Créer une nouvelle question FAQ</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.faq.store') }}">
            @csrf

            <div class="mb-3">
                <label for="question" class="form-label">Question <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('question') is-invalid @enderror" id="question" name="question" value="{{ old('question') }}" required>
                @error('question')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="answer" class="form-label">Réponse <span class="text-danger">*</span></label>
                <textarea class="form-control wysiwyg-editor @error('answer') is-invalid @enderror" id="answer" name="answer" rows="8" required>{{ old('answer') }}</textarea>
                @error('answer')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="category" class="form-label">Catégorie</label>
                    <input type="text" class="form-control @error('category') is-invalid @enderror" id="category" name="category" value="{{ old('category') }}" list="categories">
                    <datalist id="categories">
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}">
                        @endforeach
                    </datalist>
                    @error('category')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="order" class="form-label">Ordre d'affichage</label>
                    <input type="number" class="form-control @error('order') is-invalid @enderror" id="order" name="order" value="{{ old('order', 0) }}" min="0">
                    @error('order')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="is_published" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_published">Publier immédiatement</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_featured">Mettre en vedette</label>
                </div>
            </div>

            <!-- Footer avec boutons toujours visibles -->
            <div class="page-edit-footer">
                <a href="{{ route('admin.faq.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Retour
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Créer la question FAQ
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

