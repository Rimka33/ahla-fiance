@extends('admin.layout')

@section('title', 'Profil')
@section('page-title', 'Modifier mon profil')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="bi bi-person-circle"></i> Informations du profil</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.profile.update') }}">
            @csrf

            <div class="section-info mb-4">
                <i class="bi bi-info-circle-fill"></i>
                <p>Modifiez vos informations personnelles. Pour changer votre mot de passe, remplissez les champs correspondants.</p>
            </div>

            <h6 class="mb-3">Informations personnelles</h6>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Nom <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Adresse e-mail <span class="text-danger">*</span></label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <hr>
            <h6 class="mb-3">Changer le mot de passe</h6>
            <div class="section-info mb-3">
                <i class="bi bi-lock-fill"></i>
                <p>Laissez les champs ci-dessous vides si vous ne souhaitez pas modifier votre mot de passe.</p>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="current_password" class="form-label">Mot de passe actuel</label>
                    <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" autocomplete="current-password">
                    @error('current_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Requis uniquement si vous souhaitez changer votre mot de passe.</small>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="password" class="form-label">Nouveau mot de passe</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" autocomplete="new-password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Laissez vide pour ne pas changer.</small>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="password_confirmation" class="form-label">Confirmer le nouveau mot de passe</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" autocomplete="new-password">
                    <small class="text-muted">Confirmez votre nouveau mot de passe.</small>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-3 mt-4">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Annuler
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

