@extends('admin.layout')

@section('title', 'Sections Hero')
@section('page-title', 'Gestion des Sections Hero')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-star"></i> Liste des sections Hero</h5>
        <a href="{{ route('admin.hero-sections.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Ajouter une section
        </a>
    </div>
    <div class="card-body">
        @if($heroSections->count() > 0)
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 25%;">Titre principal</th>
                            <th style="width: 30%;">Description</th>
                            <th style="width: 15%;">Sous-titre</th>
                            <th style="width: 10%;">Statut</th>
                            <th style="width: 10%;">Ordre</th>
                            <th style="width: 10%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($heroSections as $hero)
                            <tr>
                                <td>
                                    <strong style="color: var(--ahla-gray-900); font-size: 0.95rem;">{{ Str::limit($hero->main_title, 60) }}</strong>
                                </td>
                                <td>
                                    <div style="color: var(--ahla-gray-700); font-size: 0.875rem; line-height: 1.5;">
                                        {{ Str::limit($hero->description, 100) }}
                                    </div>
                                    @if($hero->typed_strings)
                                        @php
                                            $typedStrings = is_array($hero->typed_strings) ? $hero->typed_strings : json_decode($hero->typed_strings, true);
                                        @endphp
                                        @if($typedStrings && count($typedStrings) > 0)
                                            <div class="mt-2">
                                                <small class="text-muted">
                                                    <i class="bi bi-arrow-repeat"></i> Phrases animées: {{ count($typedStrings) }}
                                                </small>
                                            </div>
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    <small style="color: var(--ahla-gray-600);">{{ Str::limit($hero->subtitle, 50) }}</small>
                                </td>
                                <td>
                                    @if($hero->is_active)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <strong style="color: var(--ahla-blue-bright);">{{ $hero->order }}</strong>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.hero-sections.edit', $hero) }}" class="btn btn-sm btn-outline-primary" title="Modifier">
                                            <i class="bi bi-pencil"></i>
                                            <span class="d-none d-md-inline ms-1">Modifier</span>
                                        </a>
                                        <form action="{{ route('admin.hero-sections.destroy', $hero) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer cette section ?');">
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
                {{ $heroSections->links() }}
            </div>
        @else
            <div class="empty-state">
                <i class="bi bi-image"></i>
                <p class="text-muted mt-3">Aucune section Hero pour le moment.</p>
                <a href="{{ route('admin.hero-sections.create') }}" class="btn btn-primary mt-3">
                    <i class="bi bi-plus-circle"></i> Créer votre première section Hero
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

