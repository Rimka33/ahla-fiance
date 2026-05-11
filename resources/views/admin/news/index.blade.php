@extends('admin.layout')

@section('title', 'Actualités')
@section('page-title', 'Gestion des Actualités')

@section('content')
<div class="page-section">

    {{-- ===== EN-TÊTE DE PAGE ===== --}}
    <div class="page-header">
        <div>
            <h4 class="page-header-title">Liste des actualités</h4>
            <p class="page-header-sub">{{ $news->total() ?? $news->count() }} actualité{{ ($news->total() ?? $news->count()) > 1 ? 's' : '' }} au total</p>
        </div>
        <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Ajouter une actualité
        </a>
    </div>

    {{-- ===== BARRE DE FILTRES ===== --}}
    <form method="GET" action="{{ route('admin.news.index') }}" class="filter-bar">
        <div class="filter-search">
            <input type="text" name="search" class="form-control" placeholder="Rechercher un titre, un auteur…" value="{{ request('search') }}">
        </div>
        <div class="filter-select">
            <select name="category" class="form-select">
                <option value="">Toutes les catégories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="filter-select">
            <select name="status" class="form-select">
                <option value="">Tous les statuts</option>
                <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Publiés</option>
                <option value="scheduled" {{ request('status') == 'scheduled' ? 'selected' : '' }}>Programmés</option>
                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Brouillons</option>
            </select>
        </div>
        <div class="filter-submit">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-funnel"></i> Filtrer
            </button>
        </div>
    </form>

    {{-- ===== TABLEAU DE DONNÉES ===== --}}
    @if($news->count() > 0)
        <div class="data-table-wrapper">
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th style="width: 38%;">Titre</th>
                            <th style="width: 14%;">Auteur</th>
                            <th style="width: 14%;">Statut</th>
                            <th style="width: 16%;">Publication</th>
                            <th style="width: 8%;">Vues</th>
                            <th style="width: 10%;" class="col-actions">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($news as $item)
                            <tr>
                                <td>
                                    <div class="row-title">{{ Str::limit($item->title, 50) }}</div>
                                    @if($item->category)
                                        <div class="row-sub">
                                            <span class="status-pill" style="background: {{ $item->category->color ?? '#E5E7EB' }}1A; color: {{ $item->category->color ?? '#6B7280' }};">
                                                {{ $item->category->name }}
                                            </span>
                                        </div>
                                    @endif
                                </td>
                                <td>{{ $item->author ?? '—' }}</td>
                                <td>
                                    @if($item->is_published)
                                        @if($item->published_at && $item->published_at > now())
                                            <span class="status-pill status-scheduled"><i class="bi bi-clock"></i> Programmée</span>
                                        @else
                                            <span class="status-pill status-published">Publié</span>
                                        @endif
                                    @else
                                        <span class="status-pill status-draft">Brouillon</span>
                                    @endif
                                    @if($item->is_featured)
                                        <span class="status-pill status-warning" style="margin-left: 0.25rem;"><i class="bi bi-star-fill"></i> Vedette</span>
                                    @endif
                                </td>
                                <td>
                                    @if($item->published_at)
                                        <div>{{ $item->published_at->format('d/m/Y H:i') }}</div>
                                        @if($item->published_at > now())
                                            <div class="row-sub">Publication programmée</div>
                                        @endif
                                    @else
                                        —
                                    @endif
                                </td>
                                <td>{{ $item->views_count ?? 0 }}</td>
                                <td class="col-actions">
                                    <div class="actions-group">
                                        <a href="{{ route('admin.news.edit', $item) }}" class="btn btn-sm btn-icon" title="Modifier">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.news.destroy', $item) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette actualité ?');" style="margin:0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-icon btn-icon-danger" title="Supprimer">
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
        </div>

        {{ $news->links() }}
    @else
        <div class="empty-state">
            <i class="bi bi-newspaper empty-icon"></i>
            <p class="empty-title">Aucune actualité pour le moment</p>
            <p class="empty-text">Créez votre première actualité pour la voir apparaître ici.</p>
            <a href="{{ route('admin.news.create') }}" class="btn btn-primary empty-cta">
                <i class="bi bi-plus-circle"></i> Créer votre première actualité
            </a>
        </div>
    @endif

</div>
@endsection
