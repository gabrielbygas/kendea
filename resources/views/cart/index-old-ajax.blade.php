{{-- Modified by Claude --}}
@extends('layouts.app')

@section('title', __('Mon Panier'))

@push('styles')
<link rel="stylesheet" href="{{ asset('css/cart.css') }}">
@endpush

@push('scripts')
<script>
    const translations = {
        numberOfPersons: "{{ __('Nombre de personnes') }}",
        confirmRemove: "{{ __('Êtes-vous sûr de vouloir retirer cette activité du panier ?') }}",
        errorLoadingCart: "{{ __('Erreur lors du chargement du panier') }}",
        orderSuccess: "{{ __('Commande enregistrée ! Redirection vers WhatsApp...') }}",
        orderError: "{{ __('Erreur lors de la création de la commande') }}"
    };
</script>
<script src="{{ asset('js/cart.js') }}"></script>
@endpush

@section('content')
<div class="container py-5">
    <h1 class="mb-4" data-aos="fade-up">
        <i class="bi bi-cart-check"></i> {{ __('Mon Panier') }}
    </h1>

    <div id="cart-container">
        {{-- Cart items will be loaded here via JavaScript --}}
        <div id="cart-loading" class="text-center py-5">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">{{ __('Chargement...') }}</span>
            </div>
        </div>

        <div id="cart-empty" class="text-center py-5" style="display: none;">
            <i class="bi bi-cart-x" style="font-size: 4rem; color: var(--color-gray-400);"></i>
            <h3 class="mt-4">{{ __('Votre panier est vide') }}</h3>
            <p class="text-muted">{{ __('Ajoutez des activités pour commencer votre aventure') }}</p>
            <a href="{{ route('activities.index') }}" class="btn btn-primary mt-3">
                <i class="bi bi-grid"></i> {{ __('Découvrir les activités') }}
            </a>
        </div>

        <div id="cart-content" style="display: none;">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title mb-4">{{ __('Activités sélectionnées') }}</h5>
                            <div class="table-responsive">
                                <table class="table table-hover" id="cart-table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Activité') }}</th>
                                            <th class="text-center">{{ __('Nombre de personnes') }}</th>
                                            <th class="text-end">{{ __('Prix') }}</th>
                                            <th class="text-center"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="cart-items">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card shadow-sm sticky-top" style="top: 100px;">
                        <div class="card-body">
                            <h5 class="card-title mb-4">{{ __('Récapitulatif') }}</h5>
                            
                            <div class="d-flex justify-content-between mb-3">
                                <span>{{ __('Total activités') }}:</span>
                                <strong id="cart-total-items">0</strong>
                            </div>

                            <hr>

                            <div class="d-flex justify-content-between mb-4">
                                <h5>{{ __('Total') }}:</h5>
                                <h5 class="text-primary"><span id="cart-total-price">0.00</span> AED</h5>
                            </div>

                            <button class="btn btn-primary w-100 mb-2" id="checkout-btn">
                                <i class="bi bi-check-circle"></i> {{ __('Passer la commande') }}
                            </button>

                            <a href="{{ route('activities.index') }}" class="btn btn-outline-secondary w-100">
                                <i class="bi bi-arrow-left"></i> {{ __('Continuer mes achats') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Order Form Modal --}}
<div class="modal fade" id="orderModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">{{ __('Finaliser votre Commande') }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="orderForm">
                    @csrf
                    <div class="mb-3">
                        <label for="nom" class="form-label">{{ __('Nom complet') }} *</label>
                        <input type="text" class="form-control" id="nom" name="nom" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email') }} *</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="telephone" class="form-label">{{ __('Téléphone') }} *</label>
                        <input type="tel" class="form-control" id="telephone" name="telephone" required>
                    </div>
                    <div class="mb-3">
                        <label for="adresse" class="form-label">{{ __('Adresse') }}</label>
                        <textarea class="form-control" id="adresse" name="adresse" rows="2"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="datetime" class="form-label">{{ __('Date et heure souhaitées') }}</label>
                        <input type="datetime-local" class="form-control" id="datetime" name="datetime">
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">{{ __('Message ou demandes spéciales') }}</label>
                        <textarea class="form-control" id="message" name="message" rows="3"></textarea>
                    </div>

                    <div class="alert alert-info">
                        <strong>{{ __('Total') }}:</strong> <span id="modal-total-price">0.00</span> AED
                        <br>
                        <small>{{ __('Vous recevrez une confirmation par WhatsApp') }}</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Annuler') }}</button>
                <button type="button" class="btn btn-primary" id="submitOrder">
                    <i class="bi bi-whatsapp"></i> {{ __('Confirmer via WhatsApp') }}
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    loadCart();

    // Load cart from localStorage
    function loadCart() {
        const cart = JSON.parse(localStorage.getItem('kendea_cart') || '[]');
        
        if (cart.length === 0) {
            showEmptyCart();
            return;
        }

        // Fetch activities details
        const activityIds = cart.map(item => item.id);
        
        fetch('/api/activities/bulk', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ ids: activityIds })
        })
        .then(response => response.json())
        .then(activities => {
            displayCart(activities, cart);
        })
        .catch(error => {
            console.error('Error loading cart:', error);
            showEmptyCart();
        });
    }

    function showEmptyCart() {
        document.getElementById('cart-loading').style.display = 'none';
        document.getElementById('cart-empty').style.display = 'block';
        document.getElementById('cart-content').style.display = 'none';
    }

    function displayCart(activities, cart) {
        document.getElementById('cart-loading').style.display = 'none';
        document.getElementById('cart-content').style.display = 'block';
        document.getElementById('cart-empty').style.display = 'none';

        const cartItemsContainer = document.getElementById('cart-items');
        let totalPrice = 0;

        cartItemsContainer.innerHTML = '';

        activities.forEach(activity => {
            const cartItem = cart.find(item => item.id === activity.id);
            const quantity = cartItem?.quantity || 1;
            const itemTotal = parseFloat(activity.prix) * quantity;
            totalPrice += itemTotal;

            const itemHtml = `
                <tr class="cart-item" data-id="${activity.id}">
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="${activity.first_image}" alt="${activity.nom}" class="rounded me-3" style="width: 60px; height: 60px; object-fit: cover;">
                            <div>
                                <strong>${activity.nom}</strong>
                                <br>
                                <small class="text-muted">
                                    <i class="bi bi-geo-alt"></i> ${activity.location || activity.location_en || 'Dubai'}
                                </small>
                            </div>
                        </div>
                    </td>
                    <td class="text-center align-middle">
                        <div class="d-inline-flex align-items-center">
                            <button class="btn btn-sm btn-outline-secondary qty-decrease" type="button">-</button>
                            <input type="number" class="form-control form-control-sm text-center mx-2 quantity-input" value="${quantity}" min="1" max="10" readonly style="width: 60px;">
                            <button class="btn btn-sm btn-outline-secondary qty-increase" type="button">+</button>
                        </div>
                    </td>
                    <td class="text-end align-middle">
                        <strong class="item-total">${itemTotal.toFixed(2)} AED</strong>
                        <br>
                        <small class="text-muted">${activity.prix} AED/pers</small>
                    </td>
                    <td class="text-center align-middle">
                        <button class="btn btn-sm btn-outline-danger remove-item" data-id="${activity.id}" title="{{ __('Supprimer') }}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
            `;
            cartItemsContainer.innerHTML += itemHtml;
        });

        updateCartSummary(activities.length, totalPrice);
        attachCartEventListeners();
    }

    function updateCartSummary(itemCount, totalPrice) {
        document.getElementById('cart-total-items').textContent = itemCount;
        document.getElementById('cart-total-price').textContent = totalPrice.toFixed(2);
        document.getElementById('modal-total-price').textContent = totalPrice.toFixed(2);
    }

    function attachCartEventListeners() {
        // Remove item
        document.querySelectorAll('.remove-item').forEach(btn => {
            btn.addEventListener('click', function() {
                const activityId = parseInt(this.dataset.id);
                removeFromCart(activityId);
            });
        });

        // Quantity controls
        document.querySelectorAll('.qty-increase').forEach(btn => {
            btn.addEventListener('click', function() {
                const container = this.closest('.cart-item');
                const activityId = parseInt(container.dataset.id);
                updateQuantity(activityId, 1);
            });
        });

        document.querySelectorAll('.qty-decrease').forEach(btn => {
            btn.addEventListener('click', function() {
                const container = this.closest('.cart-item');
                const activityId = parseInt(container.dataset.id);
                updateQuantity(activityId, -1);
            });
        });
    }

    function removeFromCart(activityId) {
        let cart = JSON.parse(localStorage.getItem('kendea_cart') || '[]');
        cart = cart.filter(item => item.id !== activityId);
        localStorage.setItem('kendea_cart', JSON.stringify(cart));
        
        // Update header cart count by reloading from localStorage
        if (typeof loadCartFromStorage === 'function') {
            loadCartFromStorage();
        }
        
        loadCart();
    }

    function updateQuantity(activityId, change) {
        let cart = JSON.parse(localStorage.getItem('kendea_cart') || '[]');
        const item = cart.find(i => i.id === activityId);
        
        if (item) {
            item.quantity = Math.max(1, Math.min(10, (item.quantity || 1) + change));
            localStorage.setItem('kendea_cart', JSON.stringify(cart));
            loadCart();
        }
    }

    // Checkout button
    document.getElementById('checkout-btn').addEventListener('click', function() {
        const cart = JSON.parse(localStorage.getItem('kendea_cart') || '[]');
        if (cart.length === 0) {
            alert('{{ __("Votre panier est vide") }}');
            return;
        }
        
        const orderModal = new bootstrap.Modal(document.getElementById('orderModal'));
        orderModal.show();
    });

    // Submit order
    document.getElementById('submitOrder').addEventListener('click', function() {
        const form = document.getElementById('orderForm');
        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        const cart = JSON.parse(localStorage.getItem('kendea_cart') || '[]');
        const formData = new FormData(form);
        
        const orderData = {
            nom: formData.get('nom'),
            email: formData.get('email'),
            telephone: formData.get('telephone'),
            adresse: formData.get('adresse'),
            datetime: formData.get('datetime'),
            message: formData.get('message'),
            activities: cart.map(item => ({
                id: item.id,
                quantity: item.quantity || 1
            }))
        };

        fetch('/api/commandes', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(orderData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                localStorage.removeItem('kendea_cart');
                window.location.href = data.whatsapp_url;
            } else {
                alert('{{ __("Erreur lors de la commande") }}');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('{{ __("Erreur lors de la commande") }}');
        });
    });
});
</script>
@endpush
@endsection
