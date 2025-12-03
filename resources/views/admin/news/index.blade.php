@extends('admin.layout')

@section('title', 'Actualités')
@section('page-title', 'Gestion des Actualités')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Liste des actualités</h5>
        <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Ajouter une actualité
        </a>
    </div>
    <div class="card-body">
        <!-- Filtres -->
        <form method="GET" action="{{ route('admin.news.index') }}" class="mb-4">
            <div class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Rechercher..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="category" class="form-select">
                        <option value="">Toutes les catégories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">Tous les statuts</option>
                        <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Publiés</option>
                        <option value="scheduled" {{ request('status') == 'scheduled' ? 'selected' : '' }}>Programmés</option>
                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Brouillons</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search"></i> Filtrer
                    </button>
                </div>
            </div>
        </form>

        @if($news->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Auteur</th>
                            <th>Statut</th>
                            <th>Date de publication</th>
                            <th>Vues</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($news as $item)
                            <tr>
                                <td>
                                    {{ Str::limit($item->title, 50) }}
                                    @if($item->category)
                                        <br><small class="text-muted">
                                            <span class="badge" style="background-color: {{ $item->category->color ?? '#6c757d' }}">
                                                {{ $item->category->name }}
                                            </span>
                                        </small>
                                    @endif
                                </td>
                                <td>{{ $item->author ?? 'N/A' }}</td>
                                <td>
                                    @if($item->is_published)
                                        @if($item->published_at && $item->published_at > now())
                                            <span class="badge bg-info">
                                                <i class="bi bi-clock"></i> Programmée
                                            </span>
                                        @else
                                            <span class="badge bg-success">Publié</span>
                                        @endif
                                    @else
                                        <span class="badge bg-secondary">Brouillon</span>
                                    @endif
                                    @if($item->is_featured)
                                        <span class="badge bg-warning">En vedette</span>
                                    @endif
                                </td>
                                <td>
                                    @if($item->published_at)
                                        {{ $item->published_at->format('d/m/Y H:i') }}
                                        @if($item->published_at > now())
                                            <br><small class="text-muted">Publication programmée</small>
                                        @endif
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ $item->views_count ?? 0 }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.news.edit', $item) }}" class="btn btn-sm btn-outline-primary" title="Modifier">
                                            <i class="bi bi-pencil"></i>
                                            <span class="d-none d-md-inline ms-1">Modifier</span>
                                        </a>
                                        <form action="{{ route('admin.news.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette actualité ?');">
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
                {{ $news->links() }}
            </div>
        @else
            <div class="empty-state">
                <i class="bi bi-newspaper"></i>
                <p class="text-muted mt-3">Aucune actualité pour le moment.</p>
                <a href="{{ route('admin.news.create') }}" class="btn btn-primary mt-3">
                    <i class="bi bi-plus-circle"></i> Créer votre première actualité
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

