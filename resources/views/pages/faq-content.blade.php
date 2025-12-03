@php
    if (!isset($faqs)) {
        $faqs = \App\Models\FaqQuestion::published()->ordered()->get()->groupBy('category');
    }
@endphp

<div class="faq_blocks" data-aos="fade-up" data-aos-duration="1500">
    @if($faqs->count() > 0)
        @foreach($faqs as $category => $categoryFaqs)
            @if($category)
                <h3 class="faq-category-title mt-4 mb-3" style="font-size: 1.75rem; font-weight: 700; color: #2c3e50; margin-top: 2rem !important; margin-bottom: 1.5rem !important; padding-bottom: 0.75rem; border-bottom: 3px solid #2E64BA;">{{ $category }}</h3>
            @endif

            {{-- ID unique pour le parent --}}
            @php $accordionId = 'accordion-' . ($category ? Str::slug($category) : 'main'); @endphp

            <div class="accordion" id="{{ $accordionId }}">
                <div class="row">
                    @foreach($categoryFaqs as $index => $faq)
                        <div class="col-md-6 mb-3">
                            <div class="card" style="border: none; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); overflow: hidden; margin-bottom: 1rem;">
                                <div class="card-header" id="heading{{ $faq->id }}" style="background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%); padding: 0; border: none;">
                                    <h2 class="mb-0">
                                        {{--
                                            IMPORTANT : J'ai ajouté les attributs pour BS4 (data-toggle) ET BS5 (data-bs-toggle)
                                            pour garantir que ça marche peu importe votre version.
                                        --}}
                                        <button class="btn btn-link btn-block text-left faq-btn {{ $index === 0 ? '' : 'collapsed' }}" type="button"
                                                data-toggle="collapse" data-target="#collapse{{ $faq->id }}"
                                                data-bs-toggle="collapse" data-bs-target="#collapse{{ $faq->id }}"
                                                aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $faq->id }}"
                                                style="width: 100%; padding: 1.25rem 1.5rem; text-align: left; text-decoration: none; color: #2c3e50; font-weight: 600; font-size: 1.05rem; border: none; background: none; display: flex; justify-content: space-between; align-items: center; transition: all 0.3s ease;">

                                            <span style="flex: 1; padding-right: 1rem;">{{ $faq->question }}</span>

                                            {{-- Gestion des icônes simplifiée via CSS --}}
                                            <span class="icons" style="flex-shrink: 0; display: flex; align-items: center; gap: 0.25rem;">
                                                <i class="icofont-plus icon-closed" style="font-size: 1.2rem; color: #2E64BA;"></i>
                                                <i class="icofont-minus icon-open" style="font-size: 1.2rem; color: #2E64BA;"></i>
                                            </span>
                                        </button>
                                    </h2>
                                </div>

                                <div id="collapse{{ $faq->id }}"
                                     class="collapse {{ $index === 0 ? 'show' : '' }}"
                                     aria-labelledby="heading{{ $faq->id }}"
                                     data-parent="#{{ $accordionId }}"
                                     data-bs-parent="#{{ $accordionId }}">
                                    <div class="card-body" style="padding: 1.5rem; background: white; color: #495057; line-height: 1.7; font-size: 0.95rem;">
                                        {!! nl2br(e($faq->answer)) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        {{-- CSS pour gérer l'affichage des icônes automatiquement --}}
        <style>
            /* Quand le bouton est "collapsed" (fermé), on affiche le Plus et on cache le Moins */
            .faq-btn.collapsed .icon-closed { display: block !important; }
            .faq-btn.collapsed .icon-open { display: none !important; }

            /* Quand le bouton est ouvert (pas de classe collapsed), on cache le Plus et on affiche le Moins */
            .faq-btn:not(.collapsed) .icon-closed { display: none !important; }
            .faq-btn:not(.collapsed) .icon-open { display: block !important; }

            /* Styles généraux */
            .accordion .btn-link:hover { background: rgba(46, 100, 186, 0.05) !important; }
            .accordion .btn-link:not(.collapsed) { background: rgba(46, 100, 186, 0.08) !important; color: #2E64BA !important; }
            .accordion .card { transition: box-shadow 0.3s ease; }
            .accordion .card:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.12) !important; }
        </style>
    @else
        <div class="text-center py-5" style="padding: 4rem 2rem;">
            <i class="icofont-question-circle" style="font-size: 4rem; color: #dee2e6; margin-bottom: 1rem;"></i>
            <h3 style="color: #6c757d; margin-bottom: 0.5rem;">Aucune question FAQ disponible</h3>
            <p style="color: #adb5bd;">Pour le moment, aucune question n'a été publiée.</p>
        </div>
    @endif
</div>

{{-- Le reste de votre code (Ask Question section, etc.) ... --}}

@push('scripts')
{{-- Plus besoin du script JS complexe pour les icônes, le CSS s'en charge ! --}}
<script>
    // Si vous utilisez Bootstrap 5, assurez-vous que ceci est initialisé si le fichier JS bootstrap n'est pas chargé globalement
    // Sinon, vous pouvez supprimer ce bloc script entièrement.
</script>
@endpush
