@extends('layouts.app')

@section('title', 'KENDEA - Réservez vos Activités')

@section('content')
{{-- Modified by Claude --}}

{{-- Hero Section --}}
<section id="accueil" class="hero-section" data-aos="fade-in">
    <div class="hero-overlay"></div>
    <div class="container hero-content">
        <h1 class="display-3 fw-bold text-white mb-4" data-aos="fade-up">{{ __('Découvrez Dubaï') }}</h1>
        <p class="lead text-white mb-4" data-aos="fade-up" data-aos-delay="100">
            {{ __('Les meilleures activités et expériences pour votre séjour à Dubaï') }}
        </p>
        <a href="#activites" class="btn btn-primary btn-lg" data-aos="fade-up" data-aos-delay="200">
            {{ __('Voir les Activités') }} <i class="bi bi-arrow-down"></i>
        </a>
    </div>
</section>



{{-- Activities Section --}}
<section id="activites" class="py-5">
    <div class="container">
        <h2 class="section-title text-center mb-5" data-aos="fade-up">{{ __('Nos Activités') }}</h2>

        {{-- Filters and Cart --}}
        <div class="sort-filter mb-4 d-flex flex-column flex-md-row justify-content-between align-items-center gap-3" data-aos="fade-up" data-aos-delay="100">
            <div class="d-flex flex-wrap gap-3 align-items-center">
                <div>
                    <label for="category-select" class="me-2">{{ __('Catégorie:') }}</label>
                    <select id="category-select" class="form-select d-inline-block w-auto">
                        <option value="">{{ __('Toutes') }}</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ __($category->nom) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="emirate-select" class="me-2">{{ __('Émirat:') }}</label>
                    <select id="emirate-select" class="form-select d-inline-block w-auto">
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
                <div>
                    <label for="sort-select" class="me-2">{{ __('Trier par:') }}</label>
                    <select id="sort-select" class="form-select d-inline-block w-auto">
                        <option value="nom_asc">{{ __('Nom (A-Z)') }}</option>
                        <option value="nom_desc">{{ __('Nom (Z-A)') }}</option>
                        <option value="prix_asc">{{ __('Prix (Croissant)') }}</option>
                        <option value="prix_desc">{{ __('Prix (Décroissant)') }}</option>
                        <option value="notes_desc">{{ __('Notes (Meilleures)') }}</option>
                    </select>
                </div>
            </div>
            <div>
                <button class="btn btn-success" id="voir-panier-btn">
                    <i class="bi bi-cart-check"></i> {{ __('Voir le Panier') }} (<span id="panier-count-inline">0</span>)
                </button>
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

        {{-- Total Price Display --}}
        <div class="total-price-section mt-5 p-4 bg-white rounded shadow" id="total-section" style="display:none;" data-aos="fade-up">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4>{{ __('Total de votre Sélection') }}</h4>
                    <p class="text-muted mb-0"><span id="selected-count">0</span> {{ __('activité(s) sélectionnée(s)') }}</p>
                </div>
                <div class="col-md-4 text-end">
                    <h3 class="text-primary mb-0"><span id="total-price">0.00</span> AED</h3>
                    <button class="btn btn-primary mt-3" id="commander-btn">
                        <i class="bi bi-bag-check"></i> {{ __('Commander') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Order Form Modal --}}
<div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title text-white" id="orderModalLabel">
                    <i class="bi bi-clipboard-check"></i> {{ __('Finaliser votre Commande') }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="{{ __('Fermer') }}"></button>
            </div>
            <div class="modal-body">
                <form id="order-form">
                    <div class="mb-3">
                        <label for="prenom" class="form-label">{{ __('Prénom') }} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="prenom" name="prenom" required>
                        <div class="invalid-feedback">{{ __('Veuillez entrer votre prénom.') }}</div>
                    </div>
                    <div class="mb-3">
                        <label for="nom" class="form-label">{{ __('Nom') }} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nom" name="nom" required>
                        <div class="invalid-feedback">{{ __('Veuillez entrer votre nom.') }}</div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email') }} <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" required>
                        <div class="invalid-feedback">{{ __('Veuillez entrer un email valide.') }}</div>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">{{ __('Téléphone WhatsApp') }} <span class="text-danger">*</span></label>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="+971..." required>
                        <div class="invalid-feedback">{{ __('Veuillez entrer votre numéro de téléphone.') }}</div>
                    </div>
                    <div class="mb-3">
                        <label for="datetime" class="form-label">{{ __('Date et Heure souhaitée') }} <span class="text-danger">*</span></label>
                        <input type="datetime-local" class="form-control" id="datetime" name="datetime" required>
                        <div class="invalid-feedback">{{ __('Veuillez sélectionner une date.') }}</div>
                    </div>
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle"></i> {{ __('Votre commande sera confirmée via WhatsApp.') }}
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Annuler') }}</button>
                <button type="button" class="btn btn-primary" id="confirm-order-btn">
                    <i class="bi bi-whatsapp"></i> {{ __('Confirmer via WhatsApp') }}
                </button>
            </div>
        </div>
    </div>
</div>

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
