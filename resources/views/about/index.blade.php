@extends('layouts.app')

@section('title', __('About Us') . ' - KENDEA')

@section('content')
<div class="page-header py-5" style="background: linear-gradient(135deg, #FF6A00 0%, #E55F00 100%);">
    <div class="container text-center text-white">
        <h1 class="display-4 fw-bold" style="color: white !important;">{{ __('About Us') }}</h1>
        <p class="lead">{{ __('Votre partenaire de confiance pour découvrir des expériences inoubliables') }}</p>
    </div>
</div>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-6 mb-4">
            <h2>{{ __('Qui sommes-nous ?') }}</h2>
            <p class="text-muted">{{ __('KENDEA est votre destination pour des expériences inoubliables. De ses paysages impressionnants à ses activités variées, nous offrons une expérience unique pour chaque visiteur.') }}</p>
            <p class="text-muted">{{ __('Que vous recherchiez l\'aventure, la détente, ou l\'exploration culturelle, KENDEA a tout pour vous séduire.') }}</p>
        </div>
        <div class="col-lg-6">
            <h2>{{ __('Notre Mission') }}</h2>
            <ul class="list-unstyled mt-3">
                <li class="mb-3"><i class="bi bi-check-circle-fill text-primary me-2"></i> {{ __('Offrir des expériences de qualité') }}</li>
                <li class="mb-3"><i class="bi bi-check-circle-fill text-primary me-2"></i> {{ __('Service client exceptionnel') }}</li>
                <li class="mb-3"><i class="bi bi-check-circle-fill text-primary me-2"></i> {{ __('Prix transparents et compétitifs') }}</li>
                <li class="mb-3"><i class="bi bi-check-circle-fill text-primary me-2"></i> {{ __('Réservation simple et rapide') }}</li>
            </ul>
        </div>
    </div>
</div>
@endsection
