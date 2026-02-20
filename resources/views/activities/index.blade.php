{{-- Modified by Claude - SSR Version --}}
@extends('layouts.app')

@section('title', 'KENDEA - Réservez vos Activités')

@section('content')

{{-- Hero Slider Section --}}
@include('partials.hero-slider')

{{-- Activities Section --}}
<section id="activites" class="py-5">
    <div class="container">
        <h2 class="section-title text-center mb-5" data-aos="fade-up">{{ __('Nos Activités') }}</h2>

        {{-- Filters Form --}}
        <form method="GET" action="{{ route('activities.index') }}" id="filters-form">
            <div class="sort-filter mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="row g-3 align-items-end">
                    <div class="col-12 col-md-6 col-lg-3">
                        <label for="category-select" class="form-label">{{ __('Catégorie:') }}</label>
                        <select name="category" id="category-select" class="form-select" onchange="this.form.submit()">
                            <option value="">{{ __('Toutes') }}</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $filters['category'] == $category->id ? 'selected' : '' }}>
                                    {{ App::getLocale() == 'en' ? ($category->nom_en ?? $category->nom) : $category->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <label for="emirate-select" class="form-label">{{ __('Émirat:') }}</label>
                        <select name="emirate" id="emirate-select" class="form-select" onchange="this.form.submit()">
                            <option value="">{{ __('Tous') }}</option>
                            <option value="Abu Dhabi" {{ $filters['emirate'] == 'Abu Dhabi' ? 'selected' : '' }}>Abu Dhabi</option>
                            <option value="Ajman" {{ $filters['emirate'] == 'Ajman' ? 'selected' : '' }}>Ajman</option>
                            <option value="Dubai" {{ $filters['emirate'] == 'Dubai' ? 'selected' : '' }}>Dubai</option>
                            <option value="Fujairah" {{ $filters['emirate'] == 'Fujairah' ? 'selected' : '' }}>Fujairah</option>
                            <option value="Ras Al Khaimah" {{ $filters['emirate'] == 'Ras Al Khaimah' ? 'selected' : '' }}>Ras Al Khaimah</option>
                            <option value="Sharjah" {{ $filters['emirate'] == 'Sharjah' ? 'selected' : '' }}>Sharjah</option>
                            <option value="Umm Al Quwain" {{ $filters['emirate'] == 'Umm Al Quwain' ? 'selected' : '' }}>Umm Al Quwain</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <label for="sort-select" class="form-label">{{ __('Trier par:') }}</label>
                        <select name="sort" id="sort-select" class="form-select" onchange="this.form.submit()">
                            <option value="nom_asc" {{ $filters['sort'] == 'nom_asc' ? 'selected' : '' }}>{{ __('Nom (A-Z)') }}</option>
                            <option value="nom_desc" {{ $filters['sort'] == 'nom_desc' ? 'selected' : '' }}>{{ __('Nom (Z-A)') }}</option>
                            <option value="prix_asc" {{ $filters['sort'] == 'prix_asc' ? 'selected' : '' }}>{{ __('Prix (Croissant)') }}</option>
                            <option value="prix_desc" {{ $filters['sort'] == 'prix_desc' ? 'selected' : '' }}>{{ __('Prix (Décroissant)') }}</option>
                            <option value="notes_desc" {{ $filters['sort'] == 'notes_desc' ? 'selected' : '' }}>{{ __('Notes (Meilleures)') }}</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 text-end">
                        <a href="{{ route('cart.index') }}" class="btn btn-success w-100 w-lg-auto">
                            <i class="bi bi-cart-check"></i> {{ __('Voir le Panier') }} (<span id="panier-count-inline">0</span>)
                        </a>
                    </div>
                </div>
            </div>
        </form>

        {{-- Activities Grid --}}
        <div class="activities-grid-container" data-aos="fade-up" data-aos-delay="300">
            @if($activities->count() > 0)
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                    @foreach($activities as $activity)
                        <div class="col">
                            <div class="card h-100 activity-card shadow-sm d-flex flex-column" data-activity-id="{{ $activity->id }}">
                                <a href="{{ route('activity.show', $activity->slug) }}">
                                    <img src="{{ asset($activity->first_image) }}" class="card-img-top activity-img" 
                                         alt="{{ $activity->nom }}" 
                                         onerror="this.src='{{ asset('images/default.jpg') }}'">
                                </a>
                                <div class="card-body d-flex flex-column">
                                    <span class="badge bg-secondary mb-2">
                                        {{ App::getLocale() == 'en' ? ($activity->category->nom_en ?? $activity->category->nom) : $activity->category->nom }}
                                    </span>
                                    <h5 class="card-title">
                                        <a href="{{ route('activity.show', $activity->slug) }}" class="text-decoration-none text-dark">
                                            {{ $activity->nom }}
                                        </a>
                                    </h5>
                                    <p class="card-text text-muted small">
                                        <i class="bi bi-geo-alt"></i> {{ $activity->city ?? $activity->emirate }}
                                    </p>
                                    <div class="rating mb-3">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= floor($activity->notes))
                                                <i class="bi bi-star-fill text-warning"></i>
                                            @elseif($i - $activity->notes < 1 && $i - $activity->notes > 0)
                                                <i class="bi bi-star-half text-warning"></i>
                                            @else
                                                <i class="bi bi-star text-warning"></i>
                                            @endif
                                        @endfor
                                        <span class="ms-1">({{ number_format($activity->notes, 1) }})</span>
                                    </div>
                                    <div class="text-center mt-auto">
                                        <p class="card-text fw-bold fs-5 mb-2" style="color: #FF6A00;">
                                            {{ number_format($activity->prix, 2) }} AED
                                        </p>
                                        <button class="btn btn-sm text-white btn-add-to-cart" 
                                                style="background-color: #FF6A00;"
                                                data-activity-id="{{ $activity->id }}"
                                                data-activity-nom="{{ $activity->nom }}"
                                                data-activity-prix="{{ $activity->prix }}"
                                                data-activity-image="{{ asset($activity->first_image) }}">
                                            <i class="bi bi-cart-plus"></i> {{ __('Ajouter au Panier') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Results Counter --}}
                <div class="text-center mt-4">
                    <small class="text-muted">
                        {{ $activities->count() }} {{ __('résultat(s) sur') }} {{ \App\Models\Activity::count() }}
                    </small>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-inbox" style="font-size: 3rem; color: #6c757d;"></i>
                    <p class="text-muted mt-3">{{ __('Aucune activité trouvée') }}</p>
                </div>
            @endif
        </div>

    </div>
</section>

@endsection

{{-- No additional scripts needed - session-cart.js is loaded globally --}}
