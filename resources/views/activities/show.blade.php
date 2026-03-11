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
                                    <h3 class="h2 text-primary fw-bold mb-0" id="activity-price-display">{{ number_format($activity->prix, 2) }} AED</h3>
                                    <p class="text-muted mb-0">{{ app()->getLocale() === 'en' ? 'per person' : 'par personne' }}</p>
                                </div>

                                <!-- Number of Guests -->
                                <div class="mb-4">
                                    <label for="guest-quantity" class="form-label fw-semibold">
                                        {{ app()->getLocale() === 'en' ? 'Number of Guests' : 'Nombre d\'Invités' }} <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <button class="btn btn-outline-secondary" type="button" id="decrease-guest">
                                            <i class="bi bi-dash"></i>
                                        </button>
                                        <input type="number" class="form-control text-center" id="guest-quantity" value="1" min="1" max="50" required>
                                        <button class="btn btn-outline-secondary" type="button" id="increase-guest">
                                            <i class="bi bi-plus"></i>
                                        </button>
                                    </div>
                                    <small class="text-muted">{{ app()->getLocale() === 'en' ? 'Minimum: 1, Maximum: 50' : 'Minimum : 1, Maximum : 50' }}</small>
                                </div>

                                <!-- Total Price Display -->
                                <div class="text-center mb-3 p-3 bg-light rounded">
                                    <p class="mb-1 text-muted small">{{ app()->getLocale() === 'en' ? 'Total Price' : 'Prix Total' }}</p>
                                    <h4 class="mb-0 text-primary fw-bold" id="total-price-display">{{ number_format($activity->prix, 2) }} AED</h4>
                                </div>

                                <div class="d-grid gap-3">
                                    <button class="btn btn-primary btn-lg btn-add-to-cart" data-activity-id="{{ $activity->id }}" data-activity-price="{{ $activity->prix }}">
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
// Modified by Claude - Activity detail page with guest quantity management
document.addEventListener('DOMContentLoaded', function() {
    const activityPrice = parseFloat('{{ $activity->prix }}');
    const guestQuantityInput = document.getElementById('guest-quantity');
    const decreaseBtn = document.getElementById('decrease-guest');
    const increaseBtn = document.getElementById('increase-guest');
    const totalPriceDisplay = document.getElementById('total-price-display');
    const addToCartBtn = document.querySelector('.btn-add-to-cart');
    
    // Update total price display
    function updateTotalPrice() {
        const quantity = parseInt(guestQuantityInput.value) || 1;
        const totalPrice = activityPrice * quantity;
        totalPriceDisplay.textContent = totalPrice.toFixed(2) + ' AED';
    }
    
    // Decrease quantity
    decreaseBtn.addEventListener('click', function() {
        let quantity = parseInt(guestQuantityInput.value) || 1;
        if (quantity > 1) {
            guestQuantityInput.value = quantity - 1;
            updateTotalPrice();
        }
    });
    
    // Increase quantity
    increaseBtn.addEventListener('click', function() {
        let quantity = parseInt(guestQuantityInput.value) || 1;
        const max = parseInt(guestQuantityInput.max) || 50;
        if (quantity < max) {
            guestQuantityInput.value = quantity + 1;
            updateTotalPrice();
        }
    });
    
    // Manual input change
    guestQuantityInput.addEventListener('input', function() {
        let quantity = parseInt(this.value) || 1;
        const min = parseInt(this.min) || 1;
        const max = parseInt(this.max) || 50;
        
        if (quantity < min) this.value = min;
        if (quantity > max) this.value = max;
        
        updateTotalPrice();
    });
    
    // Modified add to cart to include quantity
    addToCartBtn.addEventListener('click', async function(e) {
        e.preventDefault();
        e.stopPropagation(); // Prevent session-cart.js global handler from firing
        
        const activityId = parseInt(this.dataset.activityId);
        const quantity = parseInt(guestQuantityInput.value) || 1;
        
        // Disable button during request
        this.disabled = true;
        const originalHtml = this.innerHTML;
        this.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>' + (window.appLocale === 'en' ? 'Adding...' : 'Ajout...');
        
        try {
            const response = await fetch('/api/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                credentials: 'same-origin',
                body: JSON.stringify({ 
                    activity_id: activityId,
                    quantity: quantity
                })
            });
            
            const data = await response.json();
            
            if (data.success) {
                // Update cart count in header
                document.querySelectorAll('#panier-count, #panier-count-inline').forEach(el => {
                    if (el.firstChild && el.firstChild.nodeType === Node.TEXT_NODE) {
                        el.firstChild.textContent = data.count;
                    }
                    if (data.count > 0) {
                        el.classList.remove('d-none');
                    }
                });
                
                // Show success message
                this.innerHTML = '<i class="bi bi-check-circle me-2"></i>' + (window.appLocale === 'en' ? 'Added to Cart!' : 'Ajouté au Panier !');
                this.classList.remove('btn-primary');
                this.classList.add('btn-success');
                
                // Show alert
                const alertDiv = document.createElement('div');
                alertDiv.className = 'alert alert-success alert-dismissible fade show position-fixed';
                alertDiv.style.cssText = 'top: 80px; right: 20px; z-index: 9999; min-width: 300px;';
                alertDiv.innerHTML = `
                    <i class="bi bi-check-circle"></i>
                    ${window.appLocale === 'en' ? 'Activity successfully added to cart!' : 'Activité ajoutée au panier avec succès !'}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                `;
                document.body.appendChild(alertDiv);
                
                setTimeout(() => {
                    alertDiv.classList.remove('show');
                    setTimeout(() => alertDiv.remove(), 150);
                }, 3000);
                
                // Reset button after 2 seconds
                setTimeout(() => {
                    this.innerHTML = '<i class="bi bi-check-circle me-2"></i>' + (window.appLocale === 'en' ? 'Already in Cart' : 'Déjà dans le Panier');
                    this.classList.add('btn-secondary');
                    this.style.backgroundColor = '#6c757d';
                }, 2000);
            } else {
                throw new Error(data.message || 'Failed to add to cart');
            }
        } catch (error) {
            console.error('Error adding to cart:', error);
            this.innerHTML = originalHtml;
            this.disabled = false;
            
            // Show error alert
            const alertDiv = document.createElement('div');
            alertDiv.className = 'alert alert-danger alert-dismissible fade show position-fixed';
            alertDiv.style.cssText = 'top: 80px; right: 20px; z-index: 9999; min-width: 300px;';
            alertDiv.innerHTML = `
                <i class="bi bi-exclamation-circle"></i>
                ${window.appLocale === 'en' ? 'Error adding to cart' : 'Erreur lors de l\'ajout au panier'}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            document.body.appendChild(alertDiv);
            
            setTimeout(() => {
                alertDiv.classList.remove('show');
                setTimeout(() => alertDiv.remove(), 150);
            }, 3000);
        }
    });
    
    // Set initial locale for translations
    window.appLocale = '{{ app()->getLocale() }}';
});
</script>
@endsection
