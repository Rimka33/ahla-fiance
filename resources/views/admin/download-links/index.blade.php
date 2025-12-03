@extends('admin.layout')

@section('title', 'Liens de téléchargement')
@section('page-title', 'Gestion des Liens de Téléchargement')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-download me-2"></i>Liste des liens</h5>
        <a href="{{ route('admin.download-links.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Ajouter un lien
        </a>
    </div>
    <div class="card-body">
        @if($downloadLinks->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Plateforme</th>
                            <th>URL</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($downloadLinks as $link)
                            <tr>
                                <td>
                                    <span class="badge bg-primary">{{ ucfirst($link->platform) }}</span>
                                </td>
                                <td>
                                    <a href="{{ $link->url }}" target="_blank" class="text-decoration-none">{{ Str::limit($link->url, 50) }}</a>
                                </td>
                                <td>
                                    @if($link->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.download-links.edit', $link) }}" class="btn btn-sm btn-outline-primary" title="Modifier">
                                            <i class="bi bi-pencil"></i>
                                            <span class="d-none d-md-inline ms-1">Modifier</span>
                                        </a>
                                        <form action="{{ route('admin.download-links.destroy', $link) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ce lien ?');">
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
                {{ $downloadLinks->links() }}
            </div>
        @else
            <div class="empty-state">
                <i class="bi bi-download"></i>
                <p class="text-muted mt-3">Aucun lien de téléchargement pour le moment.</p>
                <a href="{{ route('admin.download-links.create') }}" class="btn btn-primary mt-3">
                    <i class="bi bi-plus-circle"></i> Créer votre premier lien
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

