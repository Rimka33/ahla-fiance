@extends('admin.layout')

@section('title', 'Statistiques')
@section('page-title', 'Statistiques de la page d\'accueil')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Modifier les statistiques</h5>
    </div>
    <div class="card-body">
    @csrf

            <p class="text-muted">Ces statistiques sont affichées sur la page d'accueil dans la section "À propos de nous".</p>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="users_count" class="form-label">Nombre d'utilisateurs <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('users_count') is-invalid @enderror" id="users_count" name="users_count" value="{{ old('users_count', $statistic->users_count) }}" min="0" required>
                    @error('users_count')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="users_suffix" class="form-label">Suffixe utilisateurs (ex: K, M)</label>
                    <input type="text" class="form-control @error('users_suffix') is-invalid @enderror" id="users_suffix" name="users_suffix" value="{{ old('users_suffix', $statistic->users_suffix) }}" maxlength="10">
                    @error('users_suffix')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="reviews_count" class="form-label">Nombre d'avis <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('reviews_count') is-invalid @enderror" id="reviews_count" name="reviews_count" value="{{ old('reviews_count', $statistic->reviews_count) }}" min="0" required>
                    @error('reviews_count')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="reviews_suffix" class="form-label">Suffixe avis</label>
                    <input type="text" class="form-control @error('reviews_suffix') is-invalid @enderror" id="reviews_suffix" name="reviews_suffix" value="{{ old('reviews_suffix', $statistic->reviews_suffix) }}" maxlength="10">
                    @error('reviews_suffix')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="countries_count" class="form-label">Nombre de pays <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('countries_count') is-invalid @enderror" id="countries_count" name="countries_count" value="{{ old('countries_count', $statistic->countries_count) }}" min="0" required>
                    @error('countries_count')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="countries_suffix" class="form-label">Suffixe pays</label>
                    <input type="text" class="form-control @error('countries_suffix') is-invalid @enderror" id="countries_suffix" name="countries_suffix" value="{{ old('countries_suffix', $statistic->countries_suffix) }}" maxlength="10">
                    @error('countries_suffix')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="subscribers_count" class="form-label">Nombre d'abonnés <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('subscribers_count') is-invalid @enderror" id="subscribers_count" name="subscribers_count" value="{{ old('subscribers_count', $statistic->subscribers_count) }}" min="0" required>
                    @error('subscribers_count')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="subscribers_suffix" class="form-label">Suffixe abonnés</label>
                    <input type="text" class="form-control @error('subscribers_suffix') is-invalid @enderror" id="subscribers_suffix" name="subscribers_suffix" value="{{ old('subscribers_suffix', $statistic->subscribers_suffix) }}" maxlength="10">
                    @error('subscribers_suffix')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Enregistrer les statistiques
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

