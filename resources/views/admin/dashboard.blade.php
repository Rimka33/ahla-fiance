@extends('admin.layout')

@section('title', 'Dashboard')
@section('page-title', 'Tableau de Bord')

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Succès !</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<!-- Message de bienvenue -->
<div class="welcome-card mb-4" data-aos="fade-up" data-aos-duration="600">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
        <div>
            <h4 class="mb-1">Bienvenue dans votre tableau de bord</h4>
            <p class="text-muted mb-0">Gérez votre site web Ahla Finance depuis cette interface centralisée.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('home') }}" target="_blank" class="btn btn-outline-primary">
                <i class="bi bi-eye"></i> Voir le site
            </a>
        </div>
    </div>
</div>

    <!-- Statistiques principales -->
<div class="stats-grid mb-4">
    <!-- Actualités -->
    <div class="stat-card stat-card-primary" data-aos="fade-up" data-aos-duration="800" data-aos-delay="0">
        <div class="stat-header">
            <p class="stat-label">Actualités</p>
            <i class="bi bi-newspaper icon-flat"></i>
        </div>
        <div class="stat-value">{{ $stats['news_count'] }}</div>
        <div class="stat-sublabel">
            <span class="badge bg-success">{{ $stats['news_published'] }} publiées</span>
            @if($stats['news_draft'] > 0)
                <span class="badge bg-secondary ms-1">{{ $stats['news_draft'] }} brouillons</span>
            @endif
        </div>
        @if($stats['news_last_30_days'] > 0)
            <div class="stat-trend">
                <i class="bi bi-arrow-up text-success"></i>
                <small class="text-muted">{{ $stats['news_last_30_days'] }} ce mois</small>
            </div>
        @endif
        <a href="{{ route('admin.news.index') }}" class="stat-link">
            <i class="bi bi-arrow-right"></i> Gérer
        </a>
    </div>

    <!-- Messages / Inbox -->
    <div class="stat-card stat-card-warning" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
        <div class="stat-header">
            <p class="stat-label">Messages</p>
            <i class="bi bi-inbox icon-flat"></i>
        </div>
        <div class="stat-value">
            @if($stats['inbox_new'] > 0)
                <span class="text-warning">{{ $stats['inbox_new'] }}</span>
            @else
                {{ $stats['inbox_total'] }}
            @endif
    </div>
        <div class="stat-sublabel">
            @if($stats['inbox_new'] > 0)
                <span class="badge bg-warning text-dark">{{ $stats['inbox_new'] }} nouveaux</span>
            @else
                <span class="badge bg-secondary">Tous traités</span>
            @endif
        </div>
        @if($stats['messages_last_30_days'] > 0)
            <div class="stat-trend">
                <i class="bi bi-arrow-up text-warning"></i>
                <small class="text-muted">{{ $stats['messages_last_30_days'] }} ce mois</small>
            </div>
        @endif
        <a href="{{ route('admin.inbox.index') }}" class="stat-link">
            <i class="bi bi-arrow-right"></i> Voir l'inbox
        </a>
    </div>

    <!-- Newsletter -->
    <div class="stat-card stat-card-success" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
        <div class="stat-header">
            <p class="stat-label">Newsletter</p>
            <i class="bi bi-envelope-check icon-flat"></i>
        </div>
        <div class="stat-value">{{ $stats['newsletter_total'] }}</div>
        <div class="stat-sublabel">
            <span class="badge bg-success">{{ $stats['newsletter_active'] }} actifs</span>
        </div>
        @if($stats['subscribers_last_30_days'] > 0)
            <div class="stat-trend">
                <i class="bi bi-arrow-up text-success"></i>
                <small class="text-muted">{{ $stats['subscribers_last_30_days'] }} ce mois</small>
            </div>
        @endif
        <a href="{{ route('admin.newsletter.index') }}" class="stat-link">
            <i class="bi bi-arrow-right"></i> Gérer
        </a>
    </div>

    <!-- Pages -->
    <div class="stat-card stat-card-info" data-aos="fade-up" data-aos-duration="800" data-aos-delay="300">
        <div class="stat-header">
            <p class="stat-label">Pages</p>
            <i class="bi bi-file-text icon-flat"></i>
        </div>
        <div class="stat-value">{{ $stats['pages_count'] }}</div>
        <div class="stat-sublabel">
            <span class="badge bg-info">{{ $stats['pages_published'] }} publiées</span>
        </div>
        <a href="{{ route('admin.home-page.edit') }}" class="stat-link">
            <i class="bi bi-arrow-right"></i> Modifier
        </a>
    </div>

    <!-- FAQ -->
    <div class="stat-card stat-card-purple" data-aos="fade-up" data-aos-duration="800" data-aos-delay="400">
        <div class="stat-header">
            <p class="stat-label">FAQ</p>
            <i class="bi bi-question-circle icon-flat"></i>
        </div>
        <div class="stat-value">{{ $stats['faq_count'] }}</div>
        <div class="stat-sublabel">
            <span class="badge bg-primary">{{ $stats['faq_published'] }} publiées</span>
        </div>
        <a href="{{ route('admin.faq.index') }}" class="stat-link">
            <i class="bi bi-arrow-right"></i> Gérer
        </a>
    </div>

</div>

<!-- Colonne principale - Pleine largeur -->
<div class="row g-4">
    <div class="col-12">
    <!-- Actualités récentes -->
        <div class="card mb-4" data-aos="fade-up" data-aos-duration="800" data-aos-delay="600">
            <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                <h5 class="mb-0">
                    <i class="bi bi-newspaper"></i>
                    Actualités récentes
                </h5>
                <a href="{{ route('admin.news.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-circle me-2"></i>
                    Nouvelle actualité
                </a>
            </div>
            <div class="card-body">
                @if($recentNews->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover table-mobile-responsive w-100">
                            <thead class="d-none d-md-table-header-group">
                                <tr>
                                    <th style="width: 60%;">Titre</th>
                                    <th>Statut</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentNews as $news)
                                    <tr>
                                        <td data-label="Titre">
                                            <div class="fw-semibold text-gray-900 mb-0">
                                                {{ Str::limit($news->title, 50) }}
                                            </div>
                                        </td>
                                        <td data-label="Statut" class="d-none d-md-table-cell">
                                            @if($news->is_published)
                                                <span class="badge bg-success">Publié</span>
                                            @else
                                                <span class="badge bg-secondary">Brouillon</span>
                                            @endif
                                        </td>
                                        <td data-label="Date" class="d-none d-md-table-cell">
                                            <small class="text-muted">{{ $news->created_at->format('d/m/Y') }}</small>
                                        </td>
                                        <td data-label="Actions">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="d-md-none">
                                                    @if($news->is_published)
                                                        <span class="badge bg-success">Publié</span>
                                                    @else
                                                        <span class="badge bg-secondary">Brouillon</span>
                                                    @endif
                                                    <small class="text-muted d-block">{{ $news->created_at->format('d/m/Y') }}</small>
                                                </span>
                                                <a href="{{ route('admin.news.edit', $news) }}" class="btn btn-sm btn-outline-primary ms-3">
                                                    <i class="bi bi-pencil me-1"></i>
                                                    Modifier
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center mt-4 pt-2">
                        <a href="{{ route('admin.news.index') }}" class="btn btn-outline-primary btn-sm">
                            Voir toutes les actualités
                            <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-newspaper icon-flat fs-1 mb-3 text-muted"></i>
                        <p class="text-gray-600 mb-3">Aucune actualité pour le moment.</p>
                        <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i>
                            Créer votre première actualité
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Messages récents -->
        <div class="card mt-4" data-aos="fade-up" data-aos-duration="800" data-aos-delay="700">
            <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                <h5 class="mb-0">
                    <i class="bi bi-chat-dots"></i>
                    Messages récents
                    @if($stats['inbox_new'] > 0)
                        <span class="badge bg-warning text-dark ms-2">{{ $stats['inbox_new'] }} nouveaux</span>
                    @endif
                </h5>
                <a href="{{ route('admin.inbox.index') }}" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-inbox me-2"></i>
                    Voir l'inbox
                </a>
            </div>
            <div class="card-body">
                @if($recentMessages->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($recentMessages as $message)
                            <div class="list-group-item px-0 py-3 border-bottom">
                                <div>
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <strong class="text-gray-900">{{ $message->name ?? 'Anonyme' }}</strong>
                                        @if($message->status === 'new')
                                            <span class="badge bg-warning text-dark" style="font-size: 0.5em;">Nouveau</span>
                                        @elseif($message->status === 'read')
                                            <span class="badge bg-info" style="font-size: 0.5em;">Lu</span>
                                        @else
                                            <span class="badge bg-success" style="font-size: 0.5em;">Traité</span>
                                        @endif
                                        <a href="{{ route('admin.inbox.show', $message) }}" class="btn btn-sm btn-outline-primary" style="margin-left: 80%;">
                                            <i class="bi bi-eye me-1"></i>
                                            Voir
                                        </a>
                                    </div>
                                    <p class="text-muted mb-2 small">{{ Str::limit($message->message ?? $message->subject ?? 'Sans sujet', 100) }}</p>
                                    <small class="text-muted">
                                        <i class="bi bi-envelope me-1"></i> {{ $message->email }}
                                        <span class="ms-2">
                                            <i class="bi bi-clock me-1"></i> {{ $message->created_at->diffForHumans() }}
                                        </span>
                                    </small>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="text-center mt-4 pt-3" style="margin-top: 2%;">
                        <a href="{{ route('admin.inbox.index') }}" class="btn btn-outline-primary btn-sm">
                            Voir tous les messages
                            <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-inbox icon-flat fs-1 mb-3 text-muted"></i>
                        <p class="text-gray-600 mb-0">Aucun message pour le moment.</p>
                    </div>
                @endif
            </div>
            </div>
        </div>
    </div>

<!-- Sidebar - En dessous -->
<div class="row g-4 mt-4">
    <div class="col-12 col-lg-4">
        <!-- Derniers abonnés -->
        <div class="card mb-4" data-aos="fade-up" data-aos-duration="800" data-aos-delay="900">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="bi bi-envelope-check"></i>
                    Derniers abonnés
                </h5>
                @if($stats['subscribers_last_30_days'] > 0)
                    <span class="badge bg-success">{{ $stats['subscribers_last_30_days'] }} ce mois</span>
                @endif
            </div>
            <div class="card-body p-0">
                @if($recentSubscribers->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($recentSubscribers as $subscriber)
                            <div class="list-group-item p-3">
                                <div class="d-flex align-items-center gap-2 mb-1">
                                    <strong class="text-gray-900">{{ $subscriber->email }}</strong>
                                    @if($subscriber->is_active)
                                        <span class="badge bg-success" style="font-size: 0.5em;">Actif</span>
                                    @else
                                        <span class="badge bg-secondary" style="font-size: 0.5em;">Inactif</span>
                                    @endif
                                </div>
                                @if($subscriber->name)
                                    <small class="text-muted d-block mb-1">{{ $subscriber->name }}</small>
                                @endif
                                <small class="text-muted">{{ $subscriber->created_at->diffForHumans() }}</small>
                            </div>
                        @endforeach
                    </div>
                    <div class="p-3 pt-4 pb-4 text-center border-top" style="margin-top: 2%;">
                        <a href="{{ route('admin.newsletter.index') }}" class="btn btn-outline-primary btn-sm w-100">
                            <span>Voir tous les abonnés</span>
                            <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="bi bi-envelope-x icon-flat fs-1 mb-3 text-muted"></i>
                        <p class="text-gray-600 mb-0">Aucun abonné pour le moment.</p>
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>

<style>
    /* Carte de bienvenue */
    .welcome-card {
        background: linear-gradient(135deg, var(--ahla-blue-bright) 0%, var(--ahla-blue-dark) 100%);
        color: white;
        padding: 1.5rem;
        border-radius: var(--border-radius);
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
    }

    .welcome-card h4 {
        color: white;
        margin: 0;
    }

    .welcome-card p {
        color: rgba(255, 255, 255, 0.9);
    }

    .welcome-card .btn-outline-primary {
        border-color: white;
        color: white;
    }

    .welcome-card .btn-outline-primary:hover {
        background: white;
        color: var(--ahla-blue-bright);
    }

    /* Amélioration des cartes de statistiques */
    .stat-card {
        position: relative;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        cursor: pointer;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    }

    .stat-link {
        position: absolute;
        bottom: 1rem;
        right: 1rem;
        color: var(--ahla-gray-600);
        text-decoration: none;
        font-size: 0.875rem;
        opacity: 0;
        transition: opacity 0.2s ease;
    }

    .stat-card:hover .stat-link {
        opacity: 1;
    }

    .stat-trend {
        display: flex;
        align-items: center;
        gap: 0.25rem;
        margin-top: 0.5rem;
        font-size: 0.75rem;
    }

    /* Variantes de couleurs pour les cartes */
    .stat-card-primary .stat-header .icon-flat {
        color: var(--ahla-blue-bright);
    }

    .stat-card-warning .stat-header .icon-flat {
        color: #ffc107;
    }

    .stat-card-success .stat-header .icon-flat {
        color: #28a745;
    }

    .stat-card-info .stat-header .icon-flat {
        color: #17a2b8;
    }

    .stat-card-purple .stat-header .icon-flat {
        color: #6f42c1;
    }

    .stat-card-secondary .stat-header .icon-flat {
        color: var(--ahla-gray-600);
    }

    /* Amélioration des listes */
    .list-group-item {
        transition: background-color 0.2s ease;
    }

    .list-group-item:hover {
        background-color: var(--ahla-gray-50);
    }

    /* Responsive pour le dashboard */
    @media (max-width: 991.98px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .stat-card {
            padding: 1rem;
        }

        .stat-value {
            font-size: 2rem;
        }

        .stat-header .icon-flat {
            font-size: 1.5rem;
        }
    }

    @media (max-width: 575.98px) {
        .stats-grid {
            grid-template-columns: 1fr;
            gap: 0.875rem;
        }

        .stat-card {
            padding: 0.875rem;
        }

        .stat-value {
            font-size: 1.75rem;
        }

        .stat-label {
            font-size: 0.75rem;
        }

        .stat-sublabel {
            font-size: 0.75rem;
        }

        .welcome-card {
            padding: 1rem;
        }

        .welcome-card h4 {
            font-size: 1.1rem;
        }
    }

    /* Table responsive pour mobile */
    @media (max-width: 767.98px) {
        .table-mobile-responsive {
            border: 0;
        }

        .table-mobile-responsive thead {
            display: none;
        }

        .table-mobile-responsive tbody tr {
            display: block;
            margin-bottom: 1rem;
            border: 1px solid var(--ahla-gray-200);
            border-radius: var(--border-radius);
            padding: 0.75rem;
            background: var(--ahla-white);
        }

        .table-mobile-responsive tbody td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0;
            border: none;
            text-align: right;
        }

        .table-mobile-responsive tbody td::before {
            content: attr(data-label);
            font-weight: 600;
            color: var(--ahla-gray-700);
            text-align: left;
            flex: 1;
        }

        .table-mobile-responsive tbody td:first-child {
            padding-top: 0.75rem;
        }

        .table-mobile-responsive tbody td:last-child {
            padding-bottom: 0.75rem;
            border-top: 1px solid var(--ahla-gray-200);
            margin-top: 0.5rem;
            padding-top: 0.75rem;
        }

        .table-mobile-responsive tbody td:last-child::before {
            display: none;
        }
    }

    /* Amélioration des cartes sur mobile */
    @media (max-width: 767.98px) {
        .card-header {
            flex-direction: column;
            align-items: flex-start !important;
            gap: 0.75rem;
        }

        .card-header h5 {
            font-size: 0.95rem;
        }

        .list-group-item {
            flex-direction: column;
            align-items: flex-start !important;
        }

        .btn-action {
            width: 100%;
            justify-content: flex-start;
            text-align: left;
            margin: 0;
        }

        .btn-action .flex-grow-1 {
            flex: 1;
        }

        /* Amélioration de l'espacement des boutons sur mobile */
        .btn {
            margin: 0;
            min-height: 38px;
        }

        .btn + .btn {
            margin-left: 0.5rem;
        }

        .d-grid .btn {
            margin: 0;
        }

        .text-center .btn {
            margin: 0.25rem;
        }

        .table .btn {
            margin: 0;
        }

        .list-group-item .btn {
            margin: 0;
        }
    }

    /* Amélioration pour tablettes */
    @media (min-width: 576px) and (max-width: 991.98px) {
        .stats-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }
</style>
@endsection
