{{-- Modified by Claude - SSR Version --}}
@extends('layouts.app')

@section('title', __('Mon Panier'))

@section('content')
<div class="container py-5">
    <h1 class="mb-4" data-aos="fade-up">
        <i class="bi bi-cart-check"></i> {{ __('Mon Panier') }}
    </h1>

    @if($cartActivities->count() > 0)
        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-4">
                            <i class="bi bi-list-check"></i> {{ __('Activités sélectionnées') }}
                        </h5>
                        
                        @foreach($cartActivities as $activity)
                            <div class="cart-item border-bottom pb-3 mb-3" data-activity-id="{{ $activity->id }}">
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        <img src="{{ asset($activity->first_image) }}" 
                                             class="img-fluid rounded" 
                                             alt="{{ $activity->nom }}"
                                             onerror="this.src='{{ asset('images/default.jpg') }}'">
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="mb-1">
                                            <a href="{{ route('activity.show', $activity->slug) }}" class="text-decoration-none text-dark">
                                                {{ $activity->nom }}
                                            </a>
                                        </h6>
                                        <small class="text-muted">
                                            <i class="bi bi-tag"></i> 
                                            {{ App::getLocale() == 'en' ? ($activity->category->nom_en ?? $activity->category->nom) : $activity->category->nom }}
                                        </small>
                                        <br>
                                        <small class="text-muted">
                                            <i class="bi bi-geo-alt"></i> {{ $activity->city ?? $activity->emirate }}
                                        </small>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <strong style="color: #FF6A00;">{{ number_format($activity->prix, 2) }} AED</strong>
                                    </div>
                                    <div class="col-md-2 text-end">
                                        <button type="button" class="btn btn-sm btn-outline-danger btn-remove-item" 
                                                data-activity-id="{{ $activity->id }}"
                                                data-activity-name="{{ $activity->nom }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm sticky-top" style="top: 100px;">
                    <div class="card-body">
                        <h5 class="card-title mb-4">
                            <i class="bi bi-receipt"></i> {{ __('Résumé de la Commande') }}
                        </h5>
                        
                        <div class="d-flex justify-content-between mb-2">
                            <span>{{ __('Total activités') }}:</span>
                            <strong>{{ $cartActivities->count() }}</strong>
                        </div>
                        
                        <div class="d-flex justify-content-between mb-3 pb-3 border-bottom">
                            <strong>{{ __('Total') }}:</strong>
                            <strong style="color: #FF6A00; font-size: 1.5rem;">
                                {{ number_format($cartActivities->sum('prix'), 2) }} AED
                            </strong>
                        </div>

                        <button type="button" class="btn btn-success w-100 mb-2" data-bs-toggle="modal" data-bs-target="#orderModal">
                            <i class="bi bi-check-circle"></i> {{ __('Passer la commande') }}
                        </button>
                        
                        <a href="{{ route('activities.index') }}" class="btn btn-outline-primary w-100">
                            <i class="bi bi-arrow-left"></i> {{ __('Continuer mes achats') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-5">
            <i class="bi bi-cart-x" style="font-size: 4rem; color: #6c757d;"></i>
            <h3 class="mt-4">{{ __('Votre panier est vide') }}</h3>
            <p class="text-muted">{{ __('Ajoutez des activités pour commencer votre aventure') }}</p>
            <a href="{{ route('activities.index') }}" class="btn btn-primary mt-3">
                <i class="bi bi-grid"></i> {{ __('Découvrir les activités') }}
            </a>
        </div>
    @endif
</div>

{{-- Order Modal --}}
<div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderModalLabel">
                    <i class="bi bi-clipboard-check"></i> {{ __('Finaliser votre Commande') }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Fermer') }}"></button>
            </div>
            <form id="order-form" action="{{ route('api.commandes.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="prenom" class="form-label">{{ __('Prénom') }} *</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" required>
                        </div>
                        <div class="col-md-6">
                            <label for="nom" class="form-label">{{ __('Nom') }} *</label>
                            <input type="text" class="form-control" id="nom" name="nom" required>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">{{ __('Email') }} *</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="col-md-6">
                            <label for="telephone" class="form-label">{{ __('Téléphone WhatsApp') }} *</label>
                            <input type="tel" class="form-control" id="telephone" name="telephone" required 
                                   placeholder="+971 XX XXX XXXX">
                        </div>
                        <div class="col-12">
                            <label for="datetime" class="form-label">{{ __('Date et Heure souhaitée') }}</label>
                            <input type="datetime-local" class="form-control" id="datetime" name="datetime">
                        </div>
                        <div class="col-12">
                            <label for="message" class="form-label">{{ __('Message ou demandes spéciales') }}</label>
                            <textarea class="form-control" id="message" name="message" rows="3"></textarea>
                        </div>
                        <input type="hidden" name="activities" id="activities-input" value="{{ $cartActivities->pluck('id')->toJson() }}">
                    </div>
                    <div class="alert alert-info mt-3">
                        <i class="bi bi-info-circle"></i> {{ __('Votre commande sera confirmée via WhatsApp.') }}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Annuler') }}</button>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-whatsapp"></i> {{ __('Confirmer via WhatsApp') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Confirm Remove Modal --}}
<div class="modal fade" id="confirmRemoveModal" tabindex="-1" aria-labelledby="confirmRemoveModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmRemoveModalLabel">
                    <i class="bi bi-exclamation-triangle text-warning"></i> {{ __('Confirmer la suppression') }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Fermer') }}"></button>
            </div>
            <div class="modal-body">
                <p>{{ __('Êtes-vous sûr de vouloir retirer cette activité du panier ?') }}</p>
                <p class="text-muted mb-0"><strong id="activity-name-to-remove"></strong></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Annuler') }}</button>
                <button type="button" class="btn btn-danger" id="confirm-remove-btn">
                    <i class="bi bi-trash"></i> {{ __('Retirer') }}
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let activityIdToRemove = null;
        const confirmRemoveModal = new bootstrap.Modal(document.getElementById('confirmRemoveModal'));
        
        // Handle remove button clicks
        document.querySelectorAll('.btn-remove-item').forEach(btn => {
            btn.addEventListener('click', function() {
                activityIdToRemove = this.dataset.activityId;
                document.getElementById('activity-name-to-remove').textContent = this.dataset.activityName;
                confirmRemoveModal.show();
            });
        });
        
        // Handle confirm remove
        document.getElementById('confirm-remove-btn').addEventListener('click', async function() {
            if (!activityIdToRemove) return;
            
            try {
                const response = await fetch('{{ route("api.cart.remove") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    credentials: 'same-origin',
                    body: JSON.stringify({ activity_id: activityIdToRemove })
                });
                
                const data = await response.json();
                if (data.success) {
                    // Reload page to show updated cart
                    window.location.reload();
                }
            } catch (error) {
                console.error('Error removing item:', error);
                alert('{{ __("Erreur lors de la suppression") }}');
            }
        });
        
        // Handle order form submission
        const orderForm = document.getElementById('order-form');
        if (orderForm) {
            orderForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(this);
                const data = Object.fromEntries(formData);
                data.activities = JSON.parse(data.activities);
                
                fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        // Clear cart from session
                        @foreach($cartActivities as $activity)
                            fetch('{{ route("api.cart.remove") }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({ activity_id: {{ $activity->id }} })
                            });
                        @endforeach
                        
                        // Redirect to WhatsApp
                        window.location.href = result.whatsapp_url;
                    } else {
                        alert('{{ __("Erreur lors de la création de la commande") }}');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('{{ __("Erreur lors de la création de la commande") }}');
                });
            });
        }
    });
</script>
@endpush
