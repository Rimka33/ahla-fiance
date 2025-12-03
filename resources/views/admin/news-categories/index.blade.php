@extends('admin.layout')

@section('title', 'Catégories d\'Actualités')
@section('page-title', 'Gestion des Catégories')

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Succès !</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Erreur !</strong> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-tags me-2"></i>Liste des catégories</h5>
        <a href="{{ route('admin.news-categories.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Ajouter une catégorie
        </a>
    </div>
    <div class="card-body">
        @if($categories->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Slug</th>
                            <th>Couleur</th>
                            <th>Ordre</th>
                            <th>Actif</th>
                            <th>Actualités</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="sortable-list">
                        @foreach($categories as $category)
                            <tr data-id="{{ $category->id }}">
                                <td>{{ $category->name }}</td>
                                <td><code>{{ $category->slug }}</code></td>
                                <td>
                                    @if($category->color)
                                        <span class="badge" style="background-color: {{ $category->color }};">{{ $category->color }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>{{ $category->order }}</td>
                                <td>
                                    @if($category->is_active)
                                        <span class="badge bg-success">Actif</span>
                                    @else
                                        <span class="badge bg-secondary">Inactif</span>
                                    @endif
                                </td>
                                <td>{{ $category->news()->count() }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.news-categories.edit', $category) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.news-categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer cette catégorie ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-state">
                <i class="bi bi-tags"></i>
                <p class="text-muted mt-3">Aucune catégorie pour le moment.</p>
                <a href="{{ route('admin.news-categories.create') }}" class="btn btn-primary mt-3">
                    <i class="bi bi-plus-circle"></i> Créer votre première catégorie
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
