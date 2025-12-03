@extends('admin.layout')

@section('title', 'Témoignages')
@section('page-title', 'Gestion des Témoignages')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-chat-quote me-2"></i>Liste des témoignages</h5>
        <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Ajouter un témoignage
        </a>
    </div>
    <div class="card-body">
        @if($testimonials->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Client</th>
                            <th>Témoignage</th>
                            <th>Note</th>
                            <th>Date</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($testimonials as $testimonial)
                            <tr>
                                <td>
                                    @if($testimonial->photo)
                                        <img src="{{ asset('storage/' . $testimonial->photo) }}" alt="{{ $testimonial->client_name }}" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;" class="me-2">
                                    @endif
                                    <strong>{{ $testimonial->client_name }}</strong>
                                </td>
                                <td>{{ Str::limit($testimonial->testimonial_text, 60) }}</td>
                                <td>
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $testimonial->rating)
                                            <i class="bi bi-star-fill text-warning"></i>
                                        @else
                                            <i class="bi bi-star text-muted"></i>
                                        @endif
                                    @endfor
                                    <small class="ms-1">({{ $testimonial->rating }}/5)</small>
                                </td>
                                <td>{{ $testimonial->date ? $testimonial->date->format('d/m/Y') : 'N/A' }}</td>
                                <td>
                                    @if($testimonial->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="btn btn-sm btn-outline-primary" title="Modifier">
                                            <i class="bi bi-pencil"></i>
                                            <span class="d-none d-md-inline ms-1">Modifier</span>
                                        </a>
                                        <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ce témoignage ?');">
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
                {{ $testimonials->links() }}
            </div>
        @else
            <div class="empty-state">
                <i class="bi bi-chat-quote"></i>
                <p class="text-muted mt-3">Aucun témoignage pour le moment.</p>
                <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary mt-3">
                    <i class="bi bi-plus-circle"></i> Créer votre premier témoignage
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

