@extends('admin.layout')

@section('title', 'Modifier témoignage')
@section('page-title', 'Modifier le témoignage')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Modifier le témoignage</h5>
    </div>
    <div class="card-body">
    @csrf

            <div class="mb-3">
                <label for="client_name" class="form-label">Nom du client <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('client_name') is-invalid @enderror" id="client_name" name="client_name" value="{{ old('client_name', $testimonial->client_name) }}" required>
                @error('client_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="testimonial_text" class="form-label">Témoignage <span class="text-danger">*</span></label>
                <textarea class="form-control @error('testimonial_text') is-invalid @enderror" id="testimonial_text" name="testimonial_text" rows="6" required>{{ old('testimonial_text', $testimonial->testimonial_text) }}</textarea>
                @error('testimonial_text')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="photo" class="form-label">Photo du client</label>
                @if($testimonial->photo)
                    <div class="preview-image-container mb-2">
                        <img src="{{ asset('storage/' . $testimonial->photo) }}" alt="{{ $testimonial->client_name }}" style="border-radius: 50%; object-fit: cover;">
                    </div>
                @endif
                <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo" accept="image/*">
                @error('photo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Si une nouvelle photo est sélectionnée, elle remplacera la photo actuelle.</small>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="rating" class="form-label">Note <span class="text-danger">*</span></label>
                    <select class="form-select @error('rating') is-invalid @enderror" id="rating" name="rating" required>
                        <option value="5" {{ old('rating', $testimonial->rating) == 5 ? 'selected' : '' }}>5 étoiles</option>
                        <option value="4" {{ old('rating', $testimonial->rating) == 4 ? 'selected' : '' }}>4 étoiles</option>
                        <option value="3" {{ old('rating', $testimonial->rating) == 3 ? 'selected' : '' }}>3 étoiles</option>
                        <option value="2" {{ old('rating', $testimonial->rating) == 2 ? 'selected' : '' }}>2 étoiles</option>
                        <option value="1" {{ old('rating', $testimonial->rating) == 1 ? 'selected' : '' }}>1 étoile</option>
                    </select>
                    @error('rating')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="date" class="form-label">Date du témoignage</label>
                    <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date', $testimonial->date ? $testimonial->date->format('Y-m-d') : '') }}">
                    @error('date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $testimonial->is_active) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Active</label>
                </div>
            </div>

            <!-- Footer avec boutons toujours visibles -->
            <div class="page-edit-footer">
                <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">
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

