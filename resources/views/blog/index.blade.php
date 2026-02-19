@extends('layouts.app')

@section('title', __('Blog') . ' - KENDEA')

@section('content')
<div class="page-header py-5" style="background: linear-gradient(135deg, #FF6A00 0%, #E55F00 100%);">
    <div class="container text-center text-white">
        <h1 class="display-4 fw-bold" style="color: white !important;">{{ __('Blog') }}</h1>
        <p class="lead">{{ __('Découvrez nos articles et conseils de voyage') }}</p>
    </div>
</div>

<div class="container py-5">
    <div class="row">
        <div class="col-12 text-center">
            <i class="bi bi-newspaper" style="font-size: 5rem; color: var(--color-gray-400);"></i>
            <h3 class="mt-4">{{ __('Coming Soon') }}</h3>
            <p class="text-muted">{{ __('Nos articles de blog seront bientôt disponibles') }}</p>
            <a href="{{ route('home') }}" class="btn btn-primary mt-3">{{ __('Retour à l\'accueil') }}</a>
        </div>
    </div>
</div>
@endsection
