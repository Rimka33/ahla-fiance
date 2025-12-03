@extends('admin.layout')

@section('title', 'Modifier lien')
@section('page-title', 'Modifier le lien de téléchargement')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Modifier le lien de téléchargement</h5>
    </div>
    <div class="card-body">
    @csrf

            <div class="mb-3">
                <label for="platform" class="form-label">Plateforme <span class="text-danger">*</span></label>
                <select class="form-select @error('platform') is-invalid @enderror" id="platform" name="platform" required>
                    <option value="android" {{ old('platform', $downloadLink->platform) == 'android' ? 'selected' : '' }}>Android</option>
                    <option value="ios" {{ old('platform', $downloadLink->platform) == 'ios' ? 'selected' : '' }}>iOS</option>
                    <option value="mac" {{ old('platform', $downloadLink->platform) == 'mac' ? 'selected' : '' }}>macOS</option>
                    <option value="windows" {{ old('platform', $downloadLink->platform) == 'windows' ? 'selected' : '' }}>Windows</option>
                </select>
                @error('platform')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="url" class="form-label">URL <span class="text-danger">*</span></label>
                <input type="url" class="form-control @error('url') is-invalid @enderror" id="url" name="url" value="{{ old('url', $downloadLink->url) }}" placeholder="https://..." required>
                @error('url')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="icon" class="form-label">Icône</label>
                @if($downloadLink->icon)
                    <div class="preview-image-container mb-2">
                        <img src="{{ asset('storage/' . $downloadLink->icon) }}" alt="Icon">
                    </div>
                @endif
                <input type="file" class="form-control @error('icon') is-invalid @enderror" id="icon" name="icon" accept="image/*">
                @error('icon')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Icône de la plateforme. Si une nouvelle icône est sélectionnée, elle remplacera l'icône actuelle.</small>
            </div>

            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $downloadLink->is_active) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Active</label>
                </div>
            </div>

            <!-- Footer avec boutons toujours visibles -->
            <div class="page-edit-footer">
                <a href="{{ route('admin.download-links.index') }}" class="btn btn-secondary">
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

