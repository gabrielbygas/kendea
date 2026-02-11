@extends('layouts.app')

@section('title', 'KENDEA - Réservez vos Activités')

@section('content')
{{-- Modified by Claude --}}

{{-- Hero Slider Section --}}
@include('partials.hero-slider')



{{-- Activities Section --}}
<section id="activites" class="py-5">
    <div class="container">
        <h2 class="section-title text-center mb-5" data-aos="fade-up">{{ __('Nos Activités') }}</h2>

        {{-- Filters and Cart --}}
        <div class="sort-filter mb-4" data-aos="fade-up" data-aos-delay="100">
            <div class="row g-3 align-items-end">
                <div class="col-12 col-md-6 col-lg-3">
                    <label for="category-select" class="form-label">{{ __('Catégorie:') }}</label>
                    <select id="category-select" class="form-select">
                        <option value="">{{ __('Toutes') }}</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ __($category->nom) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <label for="emirate-select" class="form-label">{{ __('Émirat:') }}</label>
                    <select id="emirate-select" class="form-select">
                        <option value="">{{ __('Tous') }}</option>
                        <option value="Abu Dhabi">Abu Dhabi</option>
                        <option value="Ajman">Ajman</option>
                        <option value="Dubai">Dubai</option>
                        <option value="Fujairah">Fujairah</option>
                        <option value="Ras Al Khaimah">Ras Al Khaimah</option>
                        <option value="Sharjah">Sharjah</option>
                        <option value="Umm Al Quwain">Umm Al Quwain</option>
                    </select>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <label for="sort-select" class="form-label">{{ __('Trier par:') }}</label>
                    <select id="sort-select" class="form-select">
                        <option value="nom_asc">{{ __('Nom (A-Z)') }}</option>
                        <option value="nom_desc">{{ __('Nom (Z-A)') }}</option>
                        <option value="prix_asc">{{ __('Prix (Croissant)') }}</option>
                        <option value="prix_desc">{{ __('Prix (Décroissant)') }}</option>
                        <option value="notes_desc">{{ __('Notes (Meilleures)') }}</option>
                    </select>
                </div>
                <div class="col-12 col-md-6 col-lg-3 text-end">
                    <a href="{{ route('cart.index') }}" class="btn btn-success w-100 w-lg-auto">
                        <i class="bi bi-cart-check"></i> {{ __('Voir le Panier') }} (<span id="panier-count-inline">0</span>)
                    </a>
                </div>
            </div>
        </div>

        {{-- Activities Grid (Cards) --}}
        <div class="activities-grid-container" data-aos="fade-up" data-aos-delay="300">
            <div id="activities-grid" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                {{-- Cards will be populated via AJAX --}}
            </div>
            <div id="loading-activities" class="text-center py-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">{{ __('Chargement...') }}</span>
                </div>
            </div>
            <div id="no-activities" class="text-center py-5 d-none">
                <i class="bi bi-inbox" style="font-size: 3rem; color: var(--color-gray-400);"></i>
                <p class="text-muted mt-3">{{ __('Aucune activité trouvée') }}</p>
            </div>
            
            {{-- Results Counter --}}
            <div id="results-counter" class="text-center mt-4">
                <small class="text-muted">
                    <span id="visible-count">0</span> {{ __('résultat(s) sur') }} <span id="total-count">0</span>
                </small>
            </div>
        </div>

    </div>
</section>

{{-- Activity Details Modal --}}
<div class="modal fade" id="activityDetailsModal" tabindex="-1" aria-labelledby="activityDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="activityDetailsModalLabel">Détails de l'Activité</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="activity-details-content">
                {{-- Content loaded via AJAX --}}
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('js/activities.js') }}"></script>
<script>
    // Initialize activities manager
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof ActivitiesManager !== 'undefined') {
            const cart = window.cartManager || new Cart();
            new ActivitiesManager(cart);
        }
    });
</script>
@endpush
