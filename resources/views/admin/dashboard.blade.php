@extends('admin.layout')

@section('title', 'Dashboard')
@section('page-title', 'Tableau de Bord')

@section('content')
<div class="page-section">

    {{-- ===== BANNIÈRE DE BIENVENUE ===== --}}
    <div class="welcome-banner" data-aos="fade-down" data-aos-duration="500">
        <div class="welcome-content">
            <div class="welcome-left">
                <div class="welcome-icon-ring">
                    <i class="bi bi-grid-3x3-gap-fill"></i>
                </div>
                <div>
                    <p class="welcome-date">{{ now()->locale('fr')->isoFormat('dddd D MMMM YYYY') }}</p>
                    <h3 class="welcome-title">Tableau de bord</h3>
                    <p class="welcome-sub">Ahla Finance · Espace d'administration</p>
                </div>
            </div>
            <div class="welcome-actions">
                @if($stats['inbox_new'] > 0)
                    <a href="{{ route('admin.inbox.index') }}" class="welcome-alert-pill">
                        <i class="bi bi-bell-fill"></i>
                        {{ $stats['inbox_new'] }} nouveau{{ $stats['inbox_new'] > 1 ? 'x' : '' }} message{{ $stats['inbox_new'] > 1 ? 's' : '' }}
                    </a>
                @endif
                <a href="{{ route('home') }}" target="_blank" class="welcome-btn">
                    <i class="bi bi-box-arrow-up-right"></i>
                    Voir le site
                </a>
            </div>
        </div>
    </div>

    {{-- ===== GRILLE KPI ===== --}}
    <div class="kpi-grid">
        <a href="{{ route('admin.news.index') }}" class="kpi-card kpi-blue" data-aos="fade-up" data-aos-delay="0">
            <div class="kpi-icon-wrap"><i class="bi bi-newspaper"></i></div>
            <div class="kpi-body">
                <span class="kpi-label">Actualités</span>
                <span class="kpi-value">{{ $stats['news_count'] }}</span>
                <div class="kpi-meta">
                    <span class="kpi-badge kpi-badge-success">{{ $stats['news_published'] }} publiées</span>
                    @if($stats['news_draft'] > 0)
                        <span class="kpi-badge kpi-badge-muted">{{ $stats['news_draft'] }} brouillons</span>
                    @endif
                </div>
            </div>
            @if($stats['news_last_30_days'] > 0)
                <div class="kpi-trend"><i class="bi bi-arrow-up-short"></i> {{ $stats['news_last_30_days'] }} ce mois</div>
            @endif
        </a>

        <a href="{{ route('admin.inbox.index') }}" class="kpi-card kpi-orange" data-aos="fade-up" data-aos-delay="60">
            <div class="kpi-icon-wrap"><i class="bi bi-inbox-fill"></i></div>
            <div class="kpi-body">
                <span class="kpi-label">Messages</span>
                <span class="kpi-value">{{ $stats['inbox_total'] }}</span>
                <div class="kpi-meta">
                    @if($stats['inbox_new'] > 0)
                        <span class="kpi-badge kpi-badge-warning">{{ $stats['inbox_new'] }} nouveaux</span>
                    @else
                        <span class="kpi-badge kpi-badge-success">Tous traités</span>
                    @endif
                </div>
            </div>
            @if($stats['messages_last_30_days'] > 0)
                <div class="kpi-trend"><i class="bi bi-arrow-up-short"></i> {{ $stats['messages_last_30_days'] }} ce mois</div>
            @endif
        </a>

        <a href="{{ route('admin.newsletter.index') }}" class="kpi-card kpi-green" data-aos="fade-up" data-aos-delay="120">
            <div class="kpi-icon-wrap"><i class="bi bi-envelope-check-fill"></i></div>
            <div class="kpi-body">
                <span class="kpi-label">Newsletter</span>
                <span class="kpi-value">{{ $stats['newsletter_total'] }}</span>
                <div class="kpi-meta">
                    <span class="kpi-badge kpi-badge-success">{{ $stats['newsletter_active'] }} actifs</span>
                </div>
            </div>
            @if($stats['subscribers_last_30_days'] > 0)
                <div class="kpi-trend"><i class="bi bi-arrow-up-short"></i> {{ $stats['subscribers_last_30_days'] }} ce mois</div>
            @endif
        </a>

        <a href="{{ route('admin.home-page.edit') }}" class="kpi-card kpi-teal" data-aos="fade-up" data-aos-delay="180">
            <div class="kpi-icon-wrap"><i class="bi bi-file-earmark-richtext-fill"></i></div>
            <div class="kpi-body">
                <span class="kpi-label">Pages</span>
                <span class="kpi-value">{{ $stats['pages_count'] }}</span>
                <div class="kpi-meta">
                    <span class="kpi-badge kpi-badge-info">{{ $stats['pages_published'] }} publiées</span>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.faq.index') }}" class="kpi-card kpi-purple" data-aos="fade-up" data-aos-delay="240">
            <div class="kpi-icon-wrap"><i class="bi bi-patch-question-fill"></i></div>
            <div class="kpi-body">
                <span class="kpi-label">FAQ</span>
                <span class="kpi-value">{{ $stats['faq_count'] }}</span>
                <div class="kpi-meta">
                    <span class="kpi-badge kpi-badge-info">{{ $stats['faq_published'] }} publiées</span>
                </div>
            </div>
        </a>
    </div>

    {{-- ===== ACTIONS RAPIDES ===== --}}
    <div class="quick-actions" data-aos="fade-up" data-aos-delay="80">
        <span class="quick-actions-label">Actions rapides</span>
        <div class="quick-actions-grid">
            <a href="{{ route('admin.news.create') }}" class="btn btn-outline-primary">
                <i class="bi bi-plus-circle"></i> Nouvelle actualité
            </a>
            <a href="{{ route('admin.inbox.index') }}" class="btn btn-outline-primary">
                <i class="bi bi-chat-dots"></i> Voir l'inbox
                @if($stats['inbox_new'] > 0)
                    <span class="btn-badge">{{ $stats['inbox_new'] }}</span>
                @endif
            </a>
            <a href="{{ route('admin.newsletter.index') }}" class="btn btn-outline-primary">
                <i class="bi bi-people"></i> Abonnés newsletter
            </a>
            <a href="{{ route('admin.home-page.edit') }}" class="btn btn-outline-primary">
                <i class="bi bi-pencil-square"></i> Éditer le site
            </a>
        </div>
    </div>

    {{-- ===== CONTENU PRINCIPAL : 2 colonnes ===== --}}
    <div class="dash-grid">

        {{-- Colonne gauche : Actualités récentes --}}
        <div class="panel" data-aos="fade-up" data-aos-delay="160">
            <div class="panel-header">
                <h5 class="panel-title">
                    <i class="bi bi-newspaper"></i>
                    Actualités récentes
                </h5>
                <a href="{{ route('admin.news.create') }}" class="panel-action">
                    <i class="bi bi-plus-lg"></i> Ajouter
                </a>
            </div>
            <div class="panel-body p-0">
                @if($recentNews->count() > 0)
                    @foreach($recentNews as $news)
                        <div class="list-row">
                            <div class="list-body">
                                <div class="list-title">{{ Str::limit($news->title, 70) }}</div>
                                <div class="list-meta">
                                    <span class="list-meta-item"><i class="bi bi-calendar3"></i> {{ $news->created_at->format('d/m/Y') }}</span>
                                </div>
                            </div>
                            <div class="list-actions">
                                @if($news->is_published)
                                    <span class="status-pill status-published">Publié</span>
                                @else
                                    <span class="status-pill status-draft">Brouillon</span>
                                @endif
                                <a href="{{ route('admin.news.edit', $news) }}" class="btn btn-sm btn-icon" title="Modifier">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-state">
                        <i class="bi bi-newspaper empty-icon"></i>
                        <p class="empty-text">Aucune actualité pour le moment.</p>
                        <a href="{{ route('admin.news.create') }}" class="btn btn-primary empty-cta">
                            <i class="bi bi-plus-circle"></i> Créer une actualité
                        </a>
                    </div>
                @endif
            </div>
            @if($recentNews->count() > 0)
                <div class="panel-footer">
                    <a href="{{ route('admin.news.index') }}" class="panel-footer-link">
                        Voir toutes les actualités <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            @endif
        </div>

        {{-- Colonne droite : Messages + Abonnés --}}
        <div class="dash-col-side">

            <div class="panel" data-aos="fade-up" data-aos-delay="200">
                <div class="panel-header">
                    <h5 class="panel-title">
                        <i class="bi bi-chat-dots"></i> Messages
                        @if($stats['inbox_new'] > 0)
                            <span class="panel-badge">{{ $stats['inbox_new'] }}</span>
                        @endif
                    </h5>
                    <a href="{{ route('admin.inbox.index') }}" class="panel-action">Tout voir</a>
                </div>
                <div class="panel-body p-0">
                    @if($recentMessages->count() > 0)
                        @foreach($recentMessages as $message)
                            <a href="{{ route('admin.inbox.show', $message) }}" class="list-row {{ $message->status === 'new' ? 'is-unread' : '' }}" style="text-decoration:none; color:inherit;">
                                <div class="list-avatar">{{ strtoupper(substr($message->name ?? 'A', 0, 1)) }}</div>
                                <div class="list-body">
                                    <div class="list-title">
                                        {{ $message->name ?? 'Anonyme' }}
                                        @if($message->status === 'new')<span class="list-dot"></span>@endif
                                    </div>
                                    <div class="list-preview">{{ Str::limit($message->message ?? $message->subject ?? 'Sans sujet', 60) }}</div>
                                    <div class="list-meta">
                                        <span class="list-meta-item">{{ $message->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                                <i class="bi bi-chevron-right" style="color: var(--ahla-gray-300);"></i>
                            </a>
                        @endforeach
                    @else
                        <div class="empty-state">
                            <i class="bi bi-inbox empty-icon"></i>
                            <p class="empty-text">Aucun message.</p>
                        </div>
                    @endif
                </div>
                @if($recentMessages->count() > 0)
                    <div class="panel-footer">
                        <a href="{{ route('admin.inbox.index') }}" class="panel-footer-link">
                            Voir tous les messages <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                @endif
            </div>

            <div class="panel" data-aos="fade-up" data-aos-delay="240">
                <div class="panel-header">
                    <h5 class="panel-title">
                        <i class="bi bi-envelope-check"></i> Abonnés récents
                        @if($stats['subscribers_last_30_days'] > 0)
                            <span class="panel-badge panel-badge-green">+{{ $stats['subscribers_last_30_days'] }}</span>
                        @endif
                    </h5>
                    <a href="{{ route('admin.newsletter.index') }}" class="panel-action">Tout voir</a>
                </div>
                <div class="panel-body p-0">
                    @if($recentSubscribers->count() > 0)
                        @foreach($recentSubscribers as $subscriber)
                            <div class="list-row">
                                <div class="list-avatar is-success"><i class="bi bi-person-fill"></i></div>
                                <div class="list-body">
                                    <div class="list-title">{{ $subscriber->email }}</div>
                                    <div class="list-meta">
                                        @if($subscriber->name)<span class="list-meta-item">{{ $subscriber->name }}</span>@endif
                                        <span class="list-meta-item">{{ $subscriber->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                                @if($subscriber->is_active)
                                    <span class="status-pill status-published">Actif</span>
                                @else
                                    <span class="status-pill status-draft">Inactif</span>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <div class="empty-state">
                            <i class="bi bi-envelope-x empty-icon"></i>
                            <p class="empty-text">Aucun abonné.</p>
                        </div>
                    @endif
                </div>
                @if($recentSubscribers->count() > 0)
                    <div class="panel-footer">
                        <a href="{{ route('admin.newsletter.index') }}" class="panel-footer-link">
                            Voir tous les abonnés <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                @endif
            </div>

        </div>
    </div>

</div>
@endsection
