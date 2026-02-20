{{-- Modified by Claude --}}
@extends('layouts.app')

@section('title', 'KENDEA - ' . (App::getLocale() == 'en' ? ($category->nom_en ?? $category->nom) : $category->nom))

@section('content')

{{-- Category Header --}}
<section class="category-header py-5 bg-light">
    <div class="container text-center">
        <h1 class="display-4 fw-bold mb-3" data-aos="fade-up">
            {{ App::getLocale() == 'en' ? ($category->nom_en ?? $category->nom) : $category->nom }}
        </h1>
        <p class="lead text-muted" data-aos="fade-up" data-aos-delay="100">
            {{ __('Découvrez toutes nos activités dans cette catégorie') }}
        </p>
    </div>
</section>

{{-- Activities Section --}}
<section id="activites" class="py-5">
    <div class="container">
        {{-- Filters --}}
        <div class="sort-filter mb-4" data-aos="fade-up" data-aos-delay="100">
            <div class="row g-3 align-items-end">
                <div class="col-12 col-md-6 col-lg-4">
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
                <div class="col-12 col-md-6 col-lg-4">
                    <label for="sort-select" class="form-label">{{ __('Trier par:') }}</label>
                    <select id="sort-select" class="form-select">
                        <option value="nom_asc">{{ __('Nom (A-Z)') }}</option>
                        <option value="nom_desc">{{ __('Nom (Z-A)') }}</option>
                        <option value="prix_asc">{{ __('Prix (Croissant)') }}</option>
                        <option value="prix_desc">{{ __('Prix (Décroissant)') }}</option>
                        <option value="notes_desc">{{ __('Notes (Meilleures)') }}</option>
                    </select>
                </div>
                <div class="col-12 col-md-12 col-lg-4 text-end">
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

        {{-- View All Activities Button --}}
        <div class="text-center mt-5" data-aos="fade-up">
            <a href="{{ route('activities.index') }}" class="btn btn-primary btn-lg">
                {{ __('Voir Toutes les Activités') }} <i class="bi bi-arrow-right"></i>
            </a>
        </div>

    </div>
</section>

{{-- Activity Details Modal --}}
<div class="modal fade" id="activityDetailsModal" tabindex="-1" aria-labelledby="activityDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="activityDetailsModalLabel">{{ __('Détails de l\'Activité') }}</h5>
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
<script>
    // Pass locale and category to JavaScript BEFORE loading activities.js
    window.appLocale = '{{ app()->getLocale() }}';
    window.presetCategoryId = {{ $category->id }};
</script>
<script>
    // Simple Cart class for activities manager
    class Cart {
        constructor() {
            this.items = JSON.parse(localStorage.getItem('cart')) || [];
        }
        
        updateUI() {
            const count = this.items.length;
            document.querySelectorAll('#panier-count, #panier-count-inline').forEach(el => {
                el.textContent = count;
                if (count > 0) {
                    el.classList.remove('d-none');
                } else {
                    el.classList.add('d-none');
                }
            });
        }
        
        addItem(activity) {
            if (!this.items.find(item => item.id === activity.id)) {
                this.items.push(activity);
                localStorage.setItem('cart', JSON.stringify(this.items));
                this.updateUI();
                return true;
            }
            return false;
        }
        
        removeItem(id) {
            this.items = this.items.filter(item => item.id !== id);
            localStorage.setItem('cart', JSON.stringify(this.items));
            this.updateUI();
        }
    }
    
    // Initialize global cart
    window.cartManager = new Cart();
</script>
<script src="{{ asset('js/activities.js') }}"></script>
<script>
    // Initialize with category filter
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof ActivitiesManager !== 'undefined') {
            new ActivitiesManager(window.cartManager, { categoryId: window.presetCategoryId });
        }
    });
</script>
@endpush
