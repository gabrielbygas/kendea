// Modified by Claude
// Cart Page JavaScript

$(document).ready(function() {
    loadCart();
    setupCartEventListeners();
});

/**
 * Load cart items from localStorage
 */
function loadCart() {
    const cart = JSON.parse(localStorage.getItem('cart') || '[]');
    
    $('#cart-loading').hide();
    
    if (cart.length === 0) {
        $('#cart-empty').show();
        $('#cart-content').hide();
        return;
    }
    
    $('#cart-empty').hide();
    $('#cart-content').show();
    
    // Load activity details
    loadCartActivities(cart);
}

/**
 * Load activity details from API
 */
function loadCartActivities(cart) {
    const activityIds = cart.map(item => item.id);
    
    $.ajax({
        url: '/api/activities',
        method: 'GET',
        data: {
            ids: activityIds.join(',')
        },
        success: function(response) {
            if (response.activities) {
                renderCartItems(response.activities, cart);
                updateCartSummary(cart);
            }
        },
        error: function() {
            showToast(translations.errorLoadingCart || 'Erreur lors du chargement du panier', 'error');
        }
    });
}

/**
 * Render cart items
 */
function renderCartItems(activities, cart) {
    const container = $('#cart-items');
    container.empty();
    
    activities.forEach(activity => {
        const cartItem = cart.find(item => item.id === activity.id);
        const quantity = cartItem ? cartItem.quantity : 1;
        const subtotal = parseFloat(activity.prix) * quantity;
        
        const firstImage = activity.images && activity.images.length > 0
            ? activity.images[0]
            : 'images/default.jpg';
        
        const itemHtml = `
            <div class="cart-item mb-3 p-3 border rounded" data-id="${activity.id}">
                <div class="row align-items-center">
                    <div class="col-md-2">
                        <img src="/${firstImage}" alt="${activity.nom}" class="img-fluid rounded">
                    </div>
                    <div class="col-md-4">
                        <h6 class="mb-1">${activity.nom}</h6>
                        <small class="text-muted"><i class="bi bi-geo-alt"></i> ${activity.location || ''}</small>
                    </div>
                    <div class="col-md-2 text-center">
                        <strong>${parseFloat(activity.prix).toFixed(2)} AED</strong>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small">${translations.numberOfPersons || 'Nombre de personnes'}</label>
                        <div class="input-group input-group-sm">
                            <button class="btn btn-outline-secondary quantity-decrease" type="button">
                                <i class="bi bi-dash"></i>
                            </button>
                            <input type="number" class="form-control text-center quantity-input" value="${quantity}" min="1" max="20">
                            <button class="btn btn-outline-secondary quantity-increase" type="button">
                                <i class="bi bi-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-1 text-center">
                        <strong class="item-subtotal">${subtotal.toFixed(2)} AED</strong>
                    </div>
                    <div class="col-md-1 text-center">
                        <button class="btn btn-sm btn-danger remove-item">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        `;
        
        container.append(itemHtml);
    });
}

/**
 * Update cart summary
 */
function updateCartSummary(cart) {
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    let totalPrice = 0;
    
    $('.cart-item').each(function() {
        const subtotal = parseFloat($(this).find('.item-subtotal').text());
        totalPrice += subtotal;
    });
    
    $('#cart-total-items').text(totalItems);
    $('#cart-total-price').text(totalPrice.toFixed(2));
}

/**
 * Setup event listeners
 */
function setupCartEventListeners() {
    // Quantity increase
    $(document).on('click', '.quantity-increase', function() {
        const input = $(this).closest('.input-group').find('.quantity-input');
        const currentValue = parseInt(input.val());
        const maxValue = parseInt(input.attr('max'));
        
        if (currentValue < maxValue) {
            input.val(currentValue + 1);
            updateCartItem($(this).closest('.cart-item'));
        }
    });
    
    // Quantity decrease
    $(document).on('click', '.quantity-decrease', function() {
        const input = $(this).closest('.input-group').find('.quantity-input');
        const currentValue = parseInt(input.val());
        const minValue = parseInt(input.attr('min'));
        
        if (currentValue > minValue) {
            input.val(currentValue - 1);
            updateCartItem($(this).closest('.cart-item'));
        }
    });
    
    // Quantity input change
    $(document).on('change', '.quantity-input', function() {
        const value = parseInt($(this).val());
        const minValue = parseInt($(this).attr('min'));
        const maxValue = parseInt($(this).attr('max'));
        
        if (value < minValue) {
            $(this).val(minValue);
        } else if (value > maxValue) {
            $(this).val(maxValue);
        }
        
        updateCartItem($(this).closest('.cart-item'));
    });
    
    // Remove item
    $(document).on('click', '.remove-item', function() {
        const cartItem = $(this).closest('.cart-item');
        const activityId = parseInt(cartItem.data('id'));
        
        if (confirm(translations.confirmRemove || 'Êtes-vous sûr de vouloir retirer cette activité du panier ?')) {
            removeFromCart(activityId);
            cartItem.fadeOut(300, function() {
                $(this).remove();
                checkCartEmpty();
                updateCartSummary(JSON.parse(localStorage.getItem('cart') || '[]'));
                updateHeaderCartCount();
            });
        }
    });
    
    // Checkout button
    $('#checkout-btn').on('click', function() {
        $('#orderModal').modal('show');
    });
    
    // Order form submit
    $('#orderForm').on('submit', function(e) {
        e.preventDefault();
        submitOrder();
    });
}

/**
 * Update cart item quantity
 */
function updateCartItem(cartItem) {
    const activityId = parseInt(cartItem.data('id'));
    const quantity = parseInt(cartItem.find('.quantity-input').val());
    const price = parseFloat(cartItem.find('.col-md-2.text-center strong').first().text());
    const subtotal = price * quantity;
    
    // Update subtotal display
    cartItem.find('.item-subtotal').text(subtotal.toFixed(2) + ' AED');
    
    // Update localStorage
    const cart = JSON.parse(localStorage.getItem('cart') || '[]');
    const item = cart.find(i => i.id === activityId);
    if (item) {
        item.quantity = quantity;
        localStorage.setItem('cart', JSON.stringify(cart));
    }
    
    // Update summary
    updateCartSummary(cart);
    updateHeaderCartCount();
}

/**
 * Remove item from cart
 */
function removeFromCart(activityId) {
    let cart = JSON.parse(localStorage.getItem('cart') || '[]');
    cart = cart.filter(item => item.id !== activityId);
    localStorage.setItem('cart', JSON.stringify(cart));
}

/**
 * Check if cart is empty
 */
function checkCartEmpty() {
    const cart = JSON.parse(localStorage.getItem('cart') || '[]');
    
    if (cart.length === 0) {
        $('#cart-content').hide();
        $('#cart-empty').show();
    }
}

/**
 * Update header cart count
 */
function updateHeaderCartCount() {
    const cart = JSON.parse(localStorage.getItem('cart') || '[]');
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    
    const badge = $('#panier-count');
    if (totalItems > 0) {
        badge.text(totalItems).removeClass('d-none');
    } else {
        badge.addClass('d-none');
    }
}

/**
 * Submit order
 */
function submitOrder() {
    const cart = JSON.parse(localStorage.getItem('cart') || '[]');
    
    const formData = {
        nom: $('#nom').val(),
        email: $('#email').val(),
        telephone: $('#telephone').val(),
        adresse: $('#adresse').val(),
        datetime: $('#datetime').val(),
        activities: cart,
        montant_total: parseFloat($('#cart-total-price').text())
    };
    
    $.ajax({
        url: '/api/commandes',
        method: 'POST',
        data: JSON.stringify(formData),
        contentType: 'application/json',
        success: function(response) {
            $('#orderModal').modal('hide');
            
            // Generate WhatsApp message
            let message = `Bonjour KENDEA,\n\nJe souhaite réserver les activités suivantes:\n\n`;
            
            cart.forEach((item, index) => {
                const activity = response.activities.find(a => a.id === item.id);
                if (activity) {
                    message += `${index + 1}. ${activity.nom} x${item.quantity} - ${(parseFloat(activity.prix) * item.quantity).toFixed(2)} AED\n`;
                }
            });
            
            message += `\n*Total: ${formData.montant_total.toFixed(2)} AED*\n\n`;
            message += `Informations:\n`;
            message += `Nom: ${formData.nom}\n`;
            message += `Email: ${formData.email}\n`;
            message += `Téléphone: ${formData.telephone}\n`;
            if (formData.datetime) {
                message += `Date souhaitée: ${formData.datetime}\n`;
            }
            message += `\nNuméro de commande: #${response.commande.id}`;
            
            // Redirect to WhatsApp
            const whatsappNumber = '+971582032582'; // TODO: Make configurable
            window.open(`https://wa.me/${whatsappNumber}?text=${encodeURIComponent(message)}`, '_blank');
            
            // Clear cart
            localStorage.removeItem('cart');
            showToast(translations.orderSuccess || 'Commande enregistrée ! Redirection vers WhatsApp...', 'success');
            
            setTimeout(() => {
                window.location.href = '/activities';
            }, 2000);
        },
        error: function(xhr) {
            const errors = xhr.responseJSON?.errors;
            if (errors) {
                Object.keys(errors).forEach(key => {
                    showToast(errors[key][0], 'error');
                });
            } else {
                showToast(translations.orderError || 'Erreur lors de la création de la commande', 'error');
            }
        }
    });
}

/**
 * Show toast notification
 */
function showToast(message, type = 'info') {
    const bgColors = {
        'success': 'bg-success',
        'error': 'bg-danger',
        'warning': 'bg-warning',
        'info': 'bg-info'
    };
    const bgColor = bgColors[type] || 'bg-info';
    
    const toastHtml = `
        <div class="toast align-items-center text-white ${bgColor} border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">${message}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    `;
    
    let toastContainer = $('#toast-container');
    if (toastContainer.length === 0) {
        $('body').append('<div id="toast-container" class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;"></div>');
        toastContainer = $('#toast-container');
    }
    
    toastContainer.append(toastHtml);
    const toastElement = toastContainer.find('.toast').last()[0];
    const toast = new bootstrap.Toast(toastElement, { delay: 3000 });
    toast.show();
    
    $(toastElement).on('hidden.bs.toast', function() {
        $(this).remove();
    });
}

// Translations object (will be populated from Laravel)
const translations = window.translations || {};
