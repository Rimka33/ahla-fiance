@extends('admin.layout')

@section('title', 'FAQ')
@section('page-title', 'Gestion de la FAQ')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-question-circle me-2"></i>Questions / Réponses</h5>
        <a href="{{ route('admin.faq.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Ajouter une question
        </a>
    </div>
    <div class="card-body">
        <!-- Filtres -->
        <form method="GET" action="{{ route('admin.faq.index') }}" class="mb-4">
            <div class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Rechercher..." value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-select">
                        <option value="">Tous les statuts</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>En attente</option>
                        <option value="answered" {{ request('status') === 'answered' ? 'selected' : '' }}>Répondu</option>
                        <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Publié</option>
                        <option value="archived" {{ request('status') === 'archived' ? 'selected' : '' }}>Archivé</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="category" class="form-select">
                        <option value="">Toutes les catégories</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="published" class="form-select">
                        <option value="">Publié/Normal</option>
                        <option value="1" {{ request('published') === '1' ? 'selected' : '' }}>Publié</option>
                        <option value="0" {{ request('published') === '0' ? 'selected' : '' }}>Non publié</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-outline-primary w-100">
                        <i class="bi bi-search"></i> Filtrer
                    </button>
                </div>
            </div>
        </form>

        @if($faqs->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Question</th>
                            <th>Catégorie</th>
                            <th>Statut</th>
                            <th>Ordre</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($faqs as $faq)
                            <tr>
                                <td>
                                    <strong>{{ Str::limit($faq->question, 60) }}</strong>
                                    @if($faq->is_featured)
                                        <span class="badge bg-warning ms-2">Vedette</span>
                                    @endif
                                </td>
                                <td>{{ $faq->category ?? 'Non catégorisé' }}</td>
                                <td>
                                    @if($faq->is_published)
                                        <span class="badge bg-success">Publié</span>
                                    @else
                                        <span class="badge bg-secondary">Non publié</span>
                                    @endif
                                </td>
                                <td>{{ $faq->order }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.faq.edit', $faq) }}" class="btn btn-sm btn-outline-primary" title="Modifier">
                                            <i class="bi bi-pencil"></i>
                                            <span class="d-none d-md-inline ms-1">Modifier</span>
                                        </a>
                                        <form action="{{ route('admin.faq.destroy', $faq) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr ?');">
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
                {{ $faqs->links() }}
            </div>
        @else
            <div class="empty-state">
                <i class="bi bi-question-circle"></i>
                <p class="text-muted mt-3">Aucune question FAQ pour le moment.</p>
                <a href="{{ route('admin.faq.create') }}" class="btn btn-primary mt-3">
                    <i class="bi bi-plus-circle"></i> Créer votre première question FAQ
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

