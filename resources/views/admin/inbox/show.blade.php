@extends('admin.layout')

@section('title', 'Voir message')
@section('page-title', 'Détail du message')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Message de {{ $message->name }}</h5>
                <div>
                    @if($message->status === 'new')
                        <form action="{{ route('admin.inbox.mark-read', $message) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-info">Marquer comme lu</button>
                        </form>
                    @endif
                    <form action="{{ route('admin.inbox.archive', $message) }}" method="POST" class="d-inline" onsubmit="return confirm('Archiver ce message ?');">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-secondary">Archiver</button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>De :</strong> {{ $message->name }}<br>
                    <strong>Email :</strong> {{ $message->email }}<br>
                    @if($message->phone)
                        <strong>Téléphone :</strong> {{ $message->phone }}<br>
                    @endif
                    <strong>Date :</strong> {{ $message->created_at->format('d/m/Y H:i') }}<br>
                    <strong>Statut :</strong>
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
                        <span class="badge bg-primary">Publié en FAQ</span>
                    @endif
                </div>

                @if($message->subject)
                    <div class="mb-3">
                        <strong>Sujet :</strong> {{ $message->subject }}
                    </div>
                @endif

                @if($message->question)
                    <div class="mb-3">
                        <strong>Question :</strong>
                        <div class="alert alert-light border">{{ $message->question }}</div>
                    </div>
                @endif

                @if($message->message)
                    <div class="mb-3">
                        <strong>Message :</strong>
                        <div class="alert alert-light border">{{ $message->message }}</div>
                    </div>
                @endif

                @if($message->admin_response)
                    <div class="mb-3">
                        <strong>Réponse admin :</strong>
                        <div class="alert alert-success border">{{ $message->admin_response }}</div>
                        <small class="text-muted">Répondu le {{ $message->replied_at->format('d/m/Y H:i') }} par {{ $message->repliedBy->name ?? 'Admin' }}</small>
                    </div>
                @endif
            </div>
        </div>

        <!-- Formulaire de réponse -->
        @if($message->status !== 'replied' || !$message->admin_response)
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="mb-0">Répondre au message</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.inbox.reply', $message) }}">
                        @csrf
                        <div class="mb-3">
                            <label for="response" class="form-label">Réponse <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('response') is-invalid @enderror" id="response" name="response" rows="6" required>{{ old('response', $message->admin_response) }}</textarea>
                            @error('response')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" id="send_email" name="send_email" value="1">
                            <label class="form-check-label" for="send_email">Envoyer la réponse par email</label>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-send"></i> Enregistrer la réponse
                        </button>
                    </form>
                </div>
            </div>
        @endif

        <!-- Publier en FAQ -->
        @if(!$message->published_in_faq && ($message->question || $message->message))
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="mb-0">Publier dans la FAQ</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.inbox.publish-faq', $message) }}">
                        @csrf
                        <div class="mb-3">
                            <label for="faq_question" class="form-label">Question <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="faq_question" name="question" value="{{ old('question', $message->question ?? $message->message) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="faq_answer" class="form-label">Réponse <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="faq_answer" name="answer" rows="6" required>{{ old('answer', $message->admin_response) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="faq_category" class="form-label">Catégorie</label>
                            <input type="text" class="form-control" id="faq_category" name="category" value="{{ old('category') }}">
                        </div>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle"></i> Publier dans la FAQ
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Actions rapides</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.inbox.index') }}" class="btn btn-outline-primary">
                        <i class="bi bi-arrow-left"></i> Retour à l'inbox
                    </a>
                    @if(!$message->published_in_faq)
                        <a href="{{ route('admin.faq.index') }}" class="btn btn-outline-info">
                            <i class="bi bi-question-circle"></i> Voir la FAQ
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

