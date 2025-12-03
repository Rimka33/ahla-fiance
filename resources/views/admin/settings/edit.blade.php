@extends('admin.layout')

@section('title', 'Paramètres')
@section('page-title', 'Paramètres du site')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Paramètres généraux</h5>
    </div>
    <div class="card-body">
    @csrf

            <h6 class="mb-3">Informations générales</h6>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="site_name" class="form-label">Nom du site <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('site_name') is-invalid @enderror" id="site_name" name="site_name" value="{{ old('site_name', $settings->site_name) }}" required>
                    @error('site_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="slogan" class="form-label">Slogan</label>
                    <input type="text" class="form-control @error('slogan') is-invalid @enderror" id="slogan" name="slogan" value="{{ old('slogan', $settings->slogan) }}">
                    @error('slogan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $settings->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <hr>
            <h6 class="mb-3">Logo et Favicon</h6>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="logo" class="form-label">Logo</label>
                    @if($settings->logo)
                        <div class="preview-image-container mb-2">
                            <img src="{{ asset('storage/' . $settings->logo) }}" alt="Logo">
                        </div>
                    @endif
                    <input type="file" class="form-control @error('logo') is-invalid @enderror" id="logo" name="logo" accept="image/*">
                    @error('logo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Logo du site. Si un nouveau logo est sélectionné, il remplacera le logo actuel.</small>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="favicon" class="form-label">Favicon</label>
                    @if($settings->favicon)
                        <div class="preview-image-container mb-2">
                            <img src="{{ asset('storage/' . $settings->favicon) }}" alt="Favicon">
                        </div>
                    @endif
                    <input type="file" class="form-control @error('favicon') is-invalid @enderror" id="favicon" name="favicon" accept="image/*">
                    @error('favicon')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Favicon du site (icône dans l'onglet du navigateur). Si un nouveau favicon est sélectionné, il remplacera le favicon actuel.</small>
                </div>
            </div>

            <hr>
            <h6 class="mb-3">Contact</h6>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $settings->email) }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="phone" class="form-label">Téléphone</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $settings->phone) }}">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Adresse</label>
                <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="2">{{ old('address', $settings->address) }}</textarea>
                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <hr>
            <h6 class="mb-3">Réseaux sociaux</h6>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="facebook_url" class="form-label">Facebook</label>
                    <input type="url" class="form-control @error('facebook_url') is-invalid @enderror" id="facebook_url" name="facebook_url" value="{{ old('facebook_url', $settings->facebook_url) }}">
                    @error('facebook_url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="twitter_url" class="form-label">Twitter</label>
                    <input type="url" class="form-control @error('twitter_url') is-invalid @enderror" id="twitter_url" name="twitter_url" value="{{ old('twitter_url', $settings->twitter_url) }}">
                    @error('twitter_url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="instagram_url" class="form-label">Instagram</label>
                    <input type="url" class="form-control @error('instagram_url') is-invalid @enderror" id="instagram_url" name="instagram_url" value="{{ old('instagram_url', $settings->instagram_url) }}">
                    @error('instagram_url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="linkedin_url" class="form-label">LinkedIn</label>
                    <input type="url" class="form-control @error('linkedin_url') is-invalid @enderror" id="linkedin_url" name="linkedin_url" value="{{ old('linkedin_url', $settings->linkedin_url) }}">
                    @error('linkedin_url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <hr>
            <h6 class="mb-3">SEO et Analytics</h6>
            <div class="mb-3">
                <label for="meta_description" class="form-label">Description SEO</label>
                <textarea class="form-control @error('meta_description') is-invalid @enderror" id="meta_description" name="meta_description" rows="2">{{ old('meta_description', $settings->meta_description) }}</textarea>
                @error('meta_description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="google_analytics_id" class="form-label">Google Analytics ID</label>
                    <input type="text" class="form-control @error('google_analytics_id') is-invalid @enderror" id="google_analytics_id" name="google_analytics_id" value="{{ old('google_analytics_id', $settings->google_analytics_id) }}">
                    @error('google_analytics_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="meta_pixel_id" class="form-label">Meta Pixel ID</label>
                    <input type="text" class="form-control @error('meta_pixel_id') is-invalid @enderror" id="meta_pixel_id" name="meta_pixel_id" value="{{ old('meta_pixel_id', $settings->meta_pixel_id) }}">
                    @error('meta_pixel_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Enregistrer les paramètres
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

