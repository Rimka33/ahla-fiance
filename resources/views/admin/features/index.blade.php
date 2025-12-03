@extends('admin.layout')

@section('title', 'Fonctionnalités')
@section('page-title', 'Gestion des Fonctionnalités')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-star me-2"></i>Liste des fonctionnalités</h5>
        <a href="{{ route('admin.features.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Ajouter une fonctionnalité
        </a>
    </div>
    <div class="card-body">
        @if($features->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Description</th>
                            <th>Statut</th>
                            <th>Ordre</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($features as $feature)
                            <tr>
                                <td><strong>{{ $feature->title }}</strong></td>
                                <td>{{ Str::limit($feature->description, 60) }}</td>
                                <td>
                                    @if($feature->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td>{{ $feature->order }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.features.edit', $feature) }}" class="btn btn-sm btn-outline-primary" title="Modifier">
                                            <i class="bi bi-pencil"></i>
                                            <span class="d-none d-md-inline ms-1">Modifier</span>
                                        </a>
                                        <form action="{{ route('admin.features.destroy', $feature) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer cette fonctionnalité ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Supprimer">
                                                <i class="bi bi-trash"></i>
                                                <span class="d-none d-md-inline ms-1">Supprimer</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $features->links() }}
            </div>
        @else
            <div class="empty-state">
                <i class="bi bi-star"></i>
                <p class="text-muted mt-3">Aucune fonctionnalité pour le moment.</p>
                <a href="{{ route('admin.features.create') }}" class="btn btn-primary mt-3">
                    <i class="bi bi-plus-circle"></i> Créer votre première fonctionnalité
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

