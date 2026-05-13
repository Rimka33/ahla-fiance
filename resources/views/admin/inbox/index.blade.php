@extends('admin.layout')

@section('title', 'Inbox')
@section('page-title', 'Inbox - Questions des clients')

@section('content')
<div class="kpi-grid mb-4">
    <div class="kpi-card kpi-orange">
        <div class="kpi-icon"><i class="bi bi-envelope"></i></div>
        <div class="kpi-body">
            <div class="kpi-value">{{ $stats['new'] }}</div>
            <div class="kpi-label">Nouveaux</div>
        </div>
    </div>
    <div class="kpi-card kpi-blue">
        <div class="kpi-icon"><i class="bi bi-envelope-open"></i></div>
        <div class="kpi-body">
            <div class="kpi-value">{{ $stats['read'] }}</div>
            <div class="kpi-label">Lus</div>
        </div>
    </div>
    <div class="kpi-card kpi-green">
        <div class="kpi-icon"><i class="bi bi-check-circle"></i></div>
        <div class="kpi-body">
            <div class="kpi-value">{{ $stats['replied'] }}</div>
            <div class="kpi-label">Répondus</div>
        </div>
    </div>
    <div class="kpi-card kpi-teal">
        <div class="kpi-icon"><i class="bi bi-archive"></i></div>
        <div class="kpi-body">
            <div class="kpi-value">{{ $stats['archived'] }}</div>
            <div class="kpi-label">Archivés</div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="bi bi-inbox me-2"></i>Messages reçus</h5>
    </div>
    <div class="card-body">
        <!-- Filtres -->
        <form method="GET" action="{{ route('admin.inbox.index') }}" class="filter-bar mb-4">
            <div class="filter-search">
                <input type="text" name="search" class="form-control" placeholder="Rechercher par nom, email, sujet..." value="{{ request('search') }}">
            </div>
            <div class="filter-select">
                <select name="status" class="form-select">
                    <option value="">Tous les statuts</option>
                    <option value="new" {{ request('status') === 'new' ? 'selected' : '' }}>Nouveau</option>
                    <option value="read" {{ request('status') === 'read' ? 'selected' : '' }}>Lu</option>
                    <option value="replied" {{ request('status') === 'replied' ? 'selected' : '' }}>Répondu</option>
                    <option value="archived" {{ request('status') === 'archived' ? 'selected' : '' }}>Archivé</option>
                </select>
            </div>
            <div class="filter-submit">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-funnel"></i> Filtrer
                </button>
            </div>
        </form>

        @if($messages->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nom / Email</th>
                            <th>Sujet</th>
                            <th>Message</th>
                            <th>Statut</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($messages as $message)
                            <tr class="{{ $message->status === 'new' ? 'table-warning' : '' }}">
                                <td>
                                    <strong>{{ $message->name }}</strong><br>
                                    <small class="text-muted">{{ $message->email }}</small>
                                </td>
                                <td>{{ $message->subject ?? 'Sans sujet' }}</td>
                                <td>{{ Str::limit($message->message ?? $message->question, 50) }}</td>
                                <td>
                                    @if($message->status === 'new')
                                        <span class="badge bg-warning">Nouveau</span>
                                    @elseif($message->status === 'read')
                                        <span class="badge bg-info">Lu</span>
                                    @elseif($message->status === 'replied')
                                        <span class="badge bg-success">Répondu</span>
                                    @else
                                        <span class="badge bg-secondary">Archivé</span>
                                    @endif
                                    @if($message->published_in_faq)
                                        <span class="badge bg-primary">FAQ</span>
                                    @endif
                                </td>
                                <td>{{ $message->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('admin.inbox.show', $message) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i> Voir
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $messages->links() }}
            </div>
        @else
            <div class="empty-state">
                <i class="bi bi-inbox"></i>
                <p class="text-muted mt-3">Aucun message pour le moment.</p>
            </div>
        @endif
    </div>
</div>
@endsection

