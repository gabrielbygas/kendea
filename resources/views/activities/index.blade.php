@extends('layouts.app')

@section('title', 'KENDEA - Réservez vos Activités')

@section('content')
{{-- Modified by Claude --}}

{{-- Hero Section --}}
<section id="accueil" class="hero-section" data-aos="fade-in">
    <div class="hero-overlay"></div>
    <div class="container hero-content">
        <h1 class="display-3 fw-bold text-white mb-4" data-aos="fade-up">Découvrez Dubaï</h1>
        <p class="lead text-white mb-4" data-aos="fade-up" data-aos-delay="100">
            Les meilleures activités et expériences pour votre séjour à Dubaï
        </p>
        <a href="#activites" class="btn btn-primary btn-lg" data-aos="fade-up" data-aos-delay="200">
            Voir les Activités <i class="bi bi-arrow-down"></i>
        </a>
    </div>
</section>

{{-- Dubai Presentation Section --}}
<section id="a-propos" class="py-5 bg-light-custom">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4" data-aos="fade-right">
                <h2 class="section-title mb-4">Bienvenue à Dubaï</h2>
                <p class="text-muted">
                    Dubaï, la perle du Moyen-Orient, est une destination qui allie modernité et tradition.
                    De ses gratte-ciels impressionnants à ses vastes déserts dorés, Dubaï offre une expérience unique
                    pour chaque visiteur.
                </p>
                <p class="text-muted">
                    Que vous recherchiez l'aventure dans le désert, la détente sur les plages paradisiaques,
                    ou l'exploration culturelle des souks traditionnels, Dubaï a tout pour vous séduire.
                </p>
                <ul class="list-unstyled mt-4">
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-primary"></i> Plus de 300 jours de soleil par an</li>
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-primary"></i> Attractions mondiales de renommée</li>
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-primary"></i> Expériences luxueuses et abordables</li>
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-primary"></i> Accueil chaleureux et multiculturel</li>
                </ul>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="p-4 bg-white rounded shadow">
                    <h4 class="mb-3">Pourquoi Réserver avec Nous ?</h4>
                    <p>Notre plateforme simplifie votre réservation d'activités à Dubaï. En quelques clics,
                    sélectionnez vos activités préférées et confirmez via WhatsApp.</p>
                    <div class="mt-4">
                        <div class="d-flex align-items-start mb-3">
                            <div class="step-icon bg-primary text-white rounded-circle me-3">1</div>
                            <div>
                                <h6>Choisissez vos Activités</h6>
                                <small class="text-muted">Parcourez notre catalogue</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-start mb-3">
                            <div class="step-icon bg-primary text-white rounded-circle me-3">2</div>
                            <div>
                                <h6>Remplissez vos Informations</h6>
                                <small class="text-muted">Entrez vos coordonnées</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-start">
                            <div class="step-icon bg-primary text-white rounded-circle me-3">3</div>
                            <div>
                                <h6>Confirmez via WhatsApp</h6>
                                <small class="text-muted">Recevez une confirmation instantanée</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Activities Section --}}
<section id="activites" class="py-5">
    <div class="container">
        <h2 class="section-title text-center mb-5" data-aos="fade-up">Nos Activités</h2>

        {{-- Category Filter --}}
        <div class="category-filter mb-4" data-aos="fade-up" data-aos-delay="100">
            <div class="d-flex flex-wrap justify-content-center gap-2">
                <button class="btn btn-outline-primary category-btn active" data-category="">Toutes</button>
                @foreach($categories as $category)
                    <button class="btn btn-outline-primary category-btn" data-category="{{ $category->id }}">
                        {{ $category->nom }}
                    </button>
                @endforeach
            </div>
        </div>

        {{-- Sorting and Cart --}}
        <div class="sort-filter mb-4 d-flex flex-column flex-md-row justify-content-between align-items-center gap-3" data-aos="fade-up" data-aos-delay="200">
            <div>
                <label for="sort-select" class="me-2">Trier par:</label>
                <select id="sort-select" class="form-select d-inline-block w-auto">
                    <option value="nom_asc">Nom (A-Z)</option>
                    <option value="nom_desc">Nom (Z-A)</option>
                    <option value="prix_asc">Prix (Croissant)</option>
                    <option value="prix_desc">Prix (Décroissant)</option>
                    <option value="notes_desc">Notes (Meilleures)</option>
                </select>
            </div>
            <div>
                <button class="btn btn-success" id="voir-panier-btn">
                    <i class="bi bi-cart-check"></i> Voir le Panier (<span id="panier-count-inline">0</span>)
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
                    <span class="visually-hidden">Chargement...</span>
                </div>
            </div>
            <div id="no-activities" class="text-center py-5 d-none">
                <i class="bi bi-inbox" style="font-size: 3rem; color: var(--color-gray-400);"></i>
                <p class="text-muted mt-3">Aucune activité trouvée</p>
            </div>
        </div>

        {{-- Total Price Display --}}
        <div class="total-price-section mt-5 p-4 bg-white rounded shadow" id="total-section" style="display:none;" data-aos="fade-up">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4>Total de votre Sélection</h4>
                    <p class="text-muted mb-0"><span id="selected-count">0</span> activité(s) sélectionnée(s)</p>
                </div>
                <div class="col-md-4 text-end">
                    <h3 class="text-primary mb-0"><span id="total-price">0.00</span> AED</h3>
                    <button class="btn btn-primary mt-3" id="commander-btn">
                        <i class="bi bi-bag-check"></i> Commander
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
                <h5 class="modal-title" id="orderModalLabel">
                    <i class="bi bi-clipboard-check"></i> Finaliser votre Commande
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="order-form">
                    <div class="mb-3">
                        <label for="prenom" class="form-label">Prénom <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="prenom" name="prenom" required>
                        <div class="invalid-feedback">Veuillez entrer votre prénom.</div>
                    </div>
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nom" name="nom" required>
                        <div class="invalid-feedback">Veuillez entrer votre nom.</div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" required>
                        <div class="invalid-feedback">Veuillez entrer un email valide.</div>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Téléphone WhatsApp <span class="text-danger">*</span></label>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="+243..." required>
                        <div class="invalid-feedback">Veuillez entrer votre numéro de téléphone.</div>
                    </div>
                    <div class="mb-3">
                        <label for="datetime" class="form-label">Date et Heure souhaitée <span class="text-danger">*</span></label>
                        <input type="datetime-local" class="form-control" id="datetime" name="datetime" required>
                        <div class="invalid-feedback">Veuillez sélectionner une date.</div>
                    </div>
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle"></i> Votre commande sera confirmée via WhatsApp.
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" id="confirm-order-btn">
                    <i class="bi bi-whatsapp"></i> Confirmer via WhatsApp
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
