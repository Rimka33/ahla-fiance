@extends('admin.layout')

@section('title', 'Newsletter')
@section('page-title', 'Gestion de la Newsletter')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-envelope-check me-2"></i>Abonnés à la newsletter</h5>
        <div>
            <a href="{{ route('admin.newsletter.export') }}" class="btn btn-outline-success">
                <i class="bi bi-download"></i> Exporter CSV
            </a>
        </div>
    </div>
    <div class="card-body">
        <!-- Recherche et filtres -->
        <form method="GET" action="{{ route('admin.newsletter.index') }}" class="mb-4">
            <div class="row g-3">
                <div class="col-md-6">
                    <input type="text" name="search" class="form-control" placeholder="Rechercher par email ou nom..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">Tous les statuts</option>
                        <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Actifs</option>
                        <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Inactifs</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search"></i> Filtrer
                    </button>
                </div>
            </div>
        </form>

        @if($subscribers->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>Nom</th>
                            <th>Date d'inscription</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subscribers as $subscriber)
                            <tr>
                                <td><strong>{{ $subscriber->email }}</strong></td>
                                <td>{{ $subscriber->name ?? '-' }}</td>
                                <td>
                                    @if($subscriber->subscribed_at)
                                        {{ $subscriber->subscribed_at->format('d/m/Y H:i') }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if($subscriber->is_active)
                                        <span class="badge bg-success">Actif</span>
                                    @else
                                        <span class="badge bg-secondary">Inactif</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <form action="{{ route('admin.newsletter.toggle-status', $subscriber) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-{{ $subscriber->is_active ? 'warning' : 'success' }}" title="{{ $subscriber->is_active ? 'Désactiver' : 'Activer' }}">
                                                <i class="bi bi-toggle-{{ $subscriber->is_active ? 'on' : 'off' }}"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.newsletter.destroy', $subscriber) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer cet abonné ?');">
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
            <div class="mt-3">
                {{ $subscribers->links() }}
            </div>

            <div class="mt-3 p-3" style="background: var(--gray-soft); border-radius: 10px;">
                <strong>Total :</strong> {{ $subscribers->total() }} abonné(s)
                <span class="ms-3">
                    <strong>Actifs :</strong> {{ $subscribers->where('is_active', true)->count() }}
                </span>
            </div>
        @else
            <div class="empty-state">
                <i class="bi bi-envelope-x"></i>
                <p class="text-muted mt-3">Aucun abonné pour le moment.</p>
            </div>
        @endif
    </div>
</div>
@endsection

