{{-- Modified by Claude --}}
@extends('layouts.app')

@section('title', (app()->getLocale() === 'en' ? $activity->nom_en : $activity->nom) . ' - KENDEA')

@section('content')
<div class="activity-detail-page">
    <!-- Hero Section with Images -->
    <section class="activity-hero">
        <div class="container-fluid px-0">
            @if(count($activity->images) > 1)
            <!-- Image Carousel -->
            <div id="activityImageCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    @foreach($activity->images as $index => $image)
                    <button type="button" data-bs-target="#activityImageCarousel" data-bs-slide-to="{{ $index }}" 
                            class="{{ $index === 0 ? 'active' : '' }}" 
                            aria-current="{{ $index === 0 ? 'true' : 'false' }}" 
                            aria-label="Slide {{ $index + 1 }}"></button>
                    @endforeach
                </div>
                <div class="carousel-inner">
                    @foreach($activity->images as $index => $image)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <img src="{{ asset($image) }}" class="d-block w-100" alt="{{ app()->getLocale() === 'en' ? $activity->nom_en : $activity->nom }}" loading="{{ $index === 0 ? 'eager' : 'lazy' }}">
                    </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#activityImageCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">{{ __('Précédent') }}</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#activityImageCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">{{ __('Suivant') }}</span>
                </button>
            </div>
            @else
            <!-- Single Image -->
            <div class="single-image-hero">
                <img src="{{ asset($activity->first_image) }}" class="w-100" alt="{{ app()->getLocale() === 'en' ? $activity->nom_en : $activity->nom }}" loading="eager">
            </div>
            @endif
        </div>
    </section>

    <!-- Activity Details Section -->
    <section class="activity-details-section py-5">
        <div class="container">
            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb" class="mb-4">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Accueil') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('activities.index') }}">{{ __('Activités') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ app()->getLocale() === 'en' ? $activity->nom_en : $activity->nom }}</li>
                        </ol>
                    </nav>

                    <!-- Title & Category -->
                    <div class="mb-4">
                        <span class="badge bg-primary mb-2">{{ app()->getLocale() === 'en' ? ($activity->category->nom_en ?? $activity->category->nom) : $activity->category->nom }}</span>
                        <h1 class="display-5 fw-bold mb-3">{{ app()->getLocale() === 'en' ? $activity->nom_en : $activity->nom }}</h1>
                        
                        <!-- Meta Info -->
                        <div class="d-flex flex-wrap gap-3 text-muted mb-3">
                            <span><i class="bi bi-geo-alt-fill text-primary"></i> {{ $activity->location }}</span>
                            <span><i class="bi bi-star-fill text-warning"></i> {{ number_format($activity->notes, 1) }} / 5.0</span>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="activity-description mb-5">
                        <h3 class="h4 mb-3">{{ __('Description') }}</h3>
                        <p class="lead">{{ app()->getLocale() === 'en' ? $activity->description_en : $activity->description }}</p>
                    </div>

                    <!-- Additional Information -->
                    <div class="activity-info-grid mb-5">
                        <h3 class="h4 mb-4">{{ __('Informations') }}</h3>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="info-card">
                                    <i class="bi bi-geo-alt-fill text-primary fs-3"></i>
                                    <div>
                                        <h5>{{ __('Emplacement') }}</h5>
                                        <p>{{ $activity->location }}, {{ $activity->emirate }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-card">
                                    <i class="bi bi-tag-fill text-primary fs-3"></i>
                                    <div>
                                        <h5>{{ __('Catégorie') }}</h5>
                                        <p>{{ app()->getLocale() === 'en' ? ($activity->category->nom_en ?? $activity->category->nom) : $activity->category->nom }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-card">
                                    <i class="bi bi-star-fill text-warning fs-3"></i>
                                    <div>
                                        <h5>{{ __('Note') }}</h5>
                                        <p>{{ number_format($activity->notes, 1) }} / 5.0</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-card">
                                    <i class="bi bi-cash-coin text-success fs-3"></i>
                                    <div>
                                        <h5>{{ __('Prix') }}</h5>
                                        <p class="text-primary fw-bold fs-5">{{ number_format($activity->prix, 2) }} AED</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar - Booking Card -->
                <div class="col-lg-4">
                    <div class="booking-card sticky-top">
                        <div class="card shadow-lg border-0">
                            <div class="card-body p-4">
                                <div class="text-center mb-4">
                                    <h3 class="h2 text-primary fw-bold mb-0">{{ number_format($activity->prix, 2) }} AED</h3>
                                    <p class="text-muted mb-0">{{ __('par personne') }}</p>
                                </div>

                                <div class="d-grid gap-3">
                                    <button class="btn btn-primary btn-lg add-to-cart-detail" data-activity-id="{{ $activity->id }}" data-activity-prix="{{ $activity->prix }}">
                                        <i class="bi bi-cart-plus me-2"></i>{{ __('Ajouter au Panier') }}
                                    </button>
                                    
                                    <a href="{{ route('cart.index') }}" class="btn btn-outline-primary btn-lg">
                                        <i class="bi bi-cart-check me-2"></i>{{ __('Voir le Panier') }}
                                    </a>
                                </div>

                                <!-- Quick Info -->
                                <div class="quick-info mt-4 pt-4 border-top">
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="bi bi-shield-check text-success fs-5 me-3"></i>
                                        <span>{{ __('Réservation sécurisée') }}</span>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="bi bi-calendar-check text-success fs-5 me-3"></i>
                                        <span>{{ __('Confirmation immédiate') }}</span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-headset text-success fs-5 me-3"></i>
                                        <span>{{ __('Support client 24/7') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
/* Activity Detail Page Styles */
.activity-detail-page {
    background-color: var(--color-light-bg);
}

.activity-hero .carousel-inner,
.activity-hero .single-image-hero {
    max-height: 500px;
    overflow: hidden;
}

.activity-hero .carousel-item img,
.activity-hero .single-image-hero img {
    width: 100%;
    height: 500px;
    object-fit: cover;
}

.breadcrumb {
    background-color: transparent;
    padding: 0;
}

.breadcrumb-item a {
    color: var(--color-primary);
    text-decoration: none;
}

.breadcrumb-item a:hover {
    text-decoration: underline;
}

.activity-description p {
    font-size: 1.1rem;
    line-height: 1.8;
    color: var(--color-gray-700);
}

.info-card {
    display: flex;
    gap: 1rem;
    padding: 1.5rem;
    background-color: white;
    border-radius: var(--radius-md);
    box-shadow: var(--shadow-sm);
    transition: all var(--transition-fast);
}

.info-card:hover {
    box-shadow: var(--shadow-md);
    transform: translateY(-2px);
}

.info-card h5 {
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 0.25rem;
    color: var(--color-gray-800);
}

.info-card p {
    margin: 0;
    color: var(--color-gray-600);
}

.booking-card {
    top: 100px;
    z-index: 100;
}

.booking-card .card {
    border-radius: var(--radius-lg);
}

.booking-card .btn {
    font-weight: 600;
    transition: all var(--transition-fast);
}

.booking-card .btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
}

.quick-info {
    font-size: 0.95rem;
    color: var(--color-gray-700);
}

/* Responsive */
@media (max-width: 991px) {
    .booking-card {
        position: relative !important;
        top: 0 !important;
        margin-top: 3rem;
    }

    .activity-hero .carousel-item img,
    .activity-hero .single-image-hero img {
        height: 350px;
    }
}

@media (max-width: 576px) {
    .activity-hero .carousel-item img,
    .activity-hero .single-image-hero img {
        height: 250px;
    }

    .display-5 {
        font-size: 1.75rem;
    }

    .info-card {
        padding: 1rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add to cart functionality
    const addToCartBtn = document.querySelector('.add-to-cart-detail');
    
    if (addToCartBtn) {
        addToCartBtn.addEventListener('click', function() {
            const activityId = parseInt(this.dataset.activityId);
            const activityPrix = parseFloat(this.dataset.activityPrix);
            
            // Get cart from localStorage
            let cart = JSON.parse(localStorage.getItem('kendea_cart') || '[]');
            
            // Check if already in cart
            const existingItem = cart.find(item => item.id === activityId);
            
            if (existingItem) {
                // Already in cart - show message
                this.innerHTML = '<i class="bi bi-check-circle me-2"></i>' + (window.appLocale === 'en' ? 'Already in Cart' : 'Déjà dans le Panier');
                this.classList.remove('btn-primary');
                this.classList.add('btn-success');
            } else {
                // Add to cart
                cart.push({
                    id: activityId,
                    prix: activityPrix,
                    quantity: 1
                });
                
                localStorage.setItem('kendea_cart', JSON.stringify(cart));
                
                // Update button
                this.innerHTML = '<i class="bi bi-check-circle me-2"></i>' + (window.appLocale === 'en' ? 'Added to Cart' : 'Ajouté au Panier');
                this.classList.remove('btn-primary');
                this.classList.add('btn-success');
                
                // Update cart count if function exists
                if (typeof loadCartFromStorage === 'function') {
                    loadCartFromStorage();
                }
                
                // Show success notification
                setTimeout(() => {
                    const msg = window.appLocale === 'en' ? 'Activity added to cart!' : 'Activité ajoutée au panier !';
                    if (typeof showToast === 'function') {
                        showToast(msg, 'success');
                    } else {
                        alert(msg);
                    }
                }, 100);
            }
        });
        
        // Check if already in cart on page load
        const activityId = parseInt(addToCartBtn.dataset.activityId);
        const cart = JSON.parse(localStorage.getItem('kendea_cart') || '[]');
        const existingItem = cart.find(item => item.id === activityId);
        
        if (existingItem) {
            addToCartBtn.innerHTML = '<i class="bi bi-check-circle me-2"></i>' + (window.appLocale === 'en' ? 'Already in Cart' : 'Déjà dans le Panier');
            addToCartBtn.classList.remove('btn-primary');
            addToCartBtn.classList.add('btn-success');
        }
    }
});
</script>
@endsection
