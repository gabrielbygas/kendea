{{-- Modified by Antigravity --}}
@extends('layouts.app')

@section('title', __('KENDEA - Discover Amazing Activities in UAE'))

@section('content')

    {{-- Hero Slider Section --}}
    @include('partials.hero-slider')

    {{-- Custom Styles for Explore Button --}}
    <style>
        .btn-explore-activities {
            background-color: white;
            color: #FF6A00;
            font-weight: 600;
            border: 2px solid #FF6A00;
            transition: all 0.3s ease;
        }
        
        .btn-explore-activities:hover {
            background-color: #F5F5F5;
            color: #FF6A00;
            border-color: #FF6A00;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 106, 0, 0.3);
        }
        
        .btn-explore-activities:active {
            transform: translateY(0);
            background-color: #EEEEEE;
        }
    </style>

    {{-- About Section --}}
    <section id="about" class="about-section py-5 mt-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right">
                    <h2 class="section-title mb-4">{{ __('Bienvenue chez KENDEA') }}</h2>
                    <p class="text-muted">
                        {{ __('KENDEA est votre destination pour des expériences inoubliables. De ses paysages impressionnants à ses activités variées, nous offrons une expérience unique pour chaque visiteur.') }}
                    </p>
                    <p class="text-muted">
                        {{ __('Que vous recherchiez l\'aventure, la détente, ou l\'exploration culturelle, KENDEA a tout pour vous séduire.') }}
                    </p>
                    <ul class="list-unstyled mt-4">
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-primary"></i>
                            {{ __('Plus de 300 jours de soleil par an') }}</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-primary"></i>
                            {{ __('Attractions mondiales de renommée') }}</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-primary"></i>
                            {{ __('Expériences luxueuses et abordables') }}</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-primary"></i>
                            {{ __('Accueil chaleureux et multiculturel') }}</li>
                    </ul>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="p-4 bg-white rounded shadow-lg">
                        <h4 class="mb-3">{{ __('Pourquoi Réserver avec Nous ?') }}</h4>
                        <p class="text-muted">
                            {{ __('Notre plateforme simplifie votre réservation d\'activités. En quelques clics, sélectionnez vos activités préférées et confirmez via WhatsApp.') }}
                        </p>
                        <div class="mt-4">
                            <div class="d-flex align-items-start mb-3">
                                <div
                                    class="about-step-icon bg-primary text-white rounded-circle me-3 d-flex align-items-center justify-content-center">
                                    1</div>
                                <div>
                                    <h6 class="mb-1">{{ __('Choisissez vos Activités') }}</h6>
                                    <small class="text-muted">{{ __('Parcourez notre catalogue') }}</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-start mb-3">
                                <div
                                    class="about-step-icon bg-primary text-white rounded-circle me-3 d-flex align-items-center justify-content-center">
                                    2</div>
                                <div>
                                    <h6 class="mb-1">{{ __('Remplissez vos Informations') }}</h6>
                                    <small class="text-muted">{{ __('Entrez vos coordonnées') }}</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-start">
                                <div
                                    class="about-step-icon bg-primary text-white rounded-circle me-3 d-flex align-items-center justify-content-center">
                                    3</div>
                                <div>
                                    <h6 class="mb-1">{{ __('Confirmez via WhatsApp') }}</h6>
                                    <small class="text-muted">{{ __('Recevez une confirmation instantanée') }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Category Tabs Section --}}
    <section id="categories" class="category-tabs-section">
        <div class="container">
            <div class="category-tabs">
                <a href="{{ route('activities.index') }}" class="category-tab">
                    <i class="bi bi-grid-3x3-gap"></i> {{ __('All Activities') }}
                </a>
                @foreach ($categories as $category)
                    <a href="{{ route('category.show', $category->id) }}" class="category-tab">
                        @if ($category->nom == 'Desert Safari')
                            <i class="bi bi-sunset"></i>
                        @elseif($category->nom == 'Water Sports')
                            <i class="bi bi-water"></i>
                        @elseif($category->nom == 'City Tours')
                            <i class="bi bi-buildings"></i>
                        @elseif($category->nom == 'Adventure')
                            <i class="bi bi-lightning"></i>
                        @elseif($category->nom == 'Cultural')
                            <i class="bi bi-bank"></i>
                        @else
                            <i class="bi bi-star"></i>
                        @endif
                        {{ App::getLocale() == 'en' ? ($category->nom_en ?? $category->nom) : $category->nom }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Top Activities Section --}}
    <section id="activites" class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title text-center mb-5" data-aos="fade-up">{{ __('Activités les Mieux Notées') }}</h2>

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4" data-aos="fade-up"
                data-aos-delay="200">
                @foreach ($featuredActivities as $activity)
                    <div class="col">
                        <div class="card h-100 activity-card shadow-sm d-flex flex-column">
                            <a href="{{ route('activity.show', $activity->slug) }}">
                                <img src="{{ asset($activity->first_image) }}" class="card-img-top activity-img"
                                    alt="{{ $activity->nom }}">
                            </a>
                            <div class="card-body d-flex flex-column">
                                <span class="badge bg-secondary mb-2">
                                    {{ App::getLocale() == 'en' ? $activity->category->nom_en ?? $activity->category->nom : $activity->category->nom }}
                                </span>
                                <h5 class="card-title"><a href="{{ route('activity.show', $activity->slug) }}" class="text-decoration-none text-dark">{{ $activity->nom }}</a></h5>
                                <p class="card-text text-muted small">
                                    <i class="bi bi-geo-alt"></i> {{ $activity->city }}
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
                                        {{ number_format($activity->prix, 2) }} AED</p>
                                    <a href="{{ route('activity.show', $activity->slug) }}" class="btn btn-sm text-white"
                                        style="background-color: #FF6A00;">
                                        {{ __('Book Now') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-5" data-aos="fade-up">
                <a href="{{ route('activities.index') }}" class="btn btn-primary btn-lg">
                    {{ __('Voir Toutes les Activités') }} <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>

    {{-- Where To Go Next Section --}}
    <section id="destinations" class="destinations-section py-5"
        style="background-color: #F5E6D3; padding-top: 5rem;padding-bottom: 5rem;">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">{{ __('Where To Go Next') }}</h2>
                <p class="section-subtitle">{{ __('Explore activities across the seven emirates of the UAE') }}</p>
            </div>

            <div class="destinations-grid">
                <div class="destination-item" data-aos="zoom-in" data-aos-delay="0">
                    <div class="destination-circle">
                        <img src="{{ asset('images/destinations/dubai.jpg') }}" alt="Dubai">
                        <div class="destination-overlay">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                    </div>
                    <h4 class="destination-name">Dubai</h4>
                </div>

                <div class="destination-item" data-aos="zoom-in" data-aos-delay="100">
                    <div class="destination-circle">
                        <img src="{{ asset('images/destinations/abu-dhabi.jpg') }}" alt="Abu Dhabi">
                        <div class="destination-overlay">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                    </div>
                    <h4 class="destination-name">Abu Dhabi</h4>
                </div>

                <div class="destination-item" data-aos="zoom-in" data-aos-delay="200">
                    <div class="destination-circle">
                        <img src="{{ asset('images/destinations/sharjah.jpg') }}" alt="Sharjah">
                        <div class="destination-overlay">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                    </div>
                    <h4 class="destination-name">Sharjah</h4>
                </div>

                <div class="destination-item" data-aos="zoom-in" data-aos-delay="300">
                    <div class="destination-circle">
                        <img src="{{ asset('images/destinations/ajman.jpg') }}" alt="Ajman">
                        <div class="destination-overlay">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                    </div>
                    <h4 class="destination-name">Ajman</h4>
                </div>

                <div class="destination-item" data-aos="zoom-in" data-aos-delay="400">
                    <div class="destination-circle">
                        <img src="{{ asset('images/destinations/ras-al-khaimah.jpg') }}" alt="Ras Al Khaimah">
                        <div class="destination-overlay">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                    </div>
                    <h4 class="destination-name">Ras Al Khaimah</h4>
                </div>

                <div class="destination-item" data-aos="zoom-in" data-aos-delay="500">
                    <div class="destination-circle">
                        <img src="{{ asset('images/destinations/fujairah.jpg') }}" alt="Fujairah">
                        <div class="destination-overlay">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                    </div>
                    <h4 class="destination-name">Fujairah</h4>
                </div>

                <div class="destination-item" data-aos="zoom-in" data-aos-delay="600">
                    <div class="destination-circle">
                        <img src="{{ asset('images/destinations/umm-al-quwain.jpg') }}" alt="Umm Al Quwain">
                        <div class="destination-overlay">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                    </div>
                    <h4 class="destination-name">Umm Al Quwain</h4>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section id="cta" class="cta-section">
        <div class="container text-center">
            <h2 class="cta-title" data-aos="fade-up" style="color:white;">{{ __('Ready for Your Next Adventure?') }}
            </h2>
            <p class="cta-subtitle" data-aos="fade-up" data-aos-delay="100">
                {{ __('Join thousands of explorers discovering the best of UAE with KENDEA') }}
            </p>
            <a href="{{ route('activities.index') }}" class="btn btn-explore-activities btn-lg mt-3" data-aos="fade-up"
                data-aos-delay="200">
                {{ __('Explore All Activities') }}
            </a>
        </div>
    </section>
@endsection
