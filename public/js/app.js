// Modified by Claude
// KENDEA SPA - Main JavaScript

// Global variables
let selectedActivities = [];
let totalPrice = 0;
let currentCategory = '';
let currentEmirate = '';
let currentSort = 'nom_asc';
const WHATSAPP_NUMBER = '+971582032582'; // TODO: Replace with actual WhatsApp number

// Document ready
$(document).ready(function() {
    // Initialize AOS animations
    AOS.init({
        duration: 800,
        easing: 'ease-in-out',
        once: true,
        offset: 100
    });

    // Load cart from localStorage
    loadCartFromStorage();

    // Load activities
    loadActivities();

    // Event listeners
    setupEventListeners();

    // Smooth scrolling for anchor links
    $('a[href^="#"]').on('click', function(e) {
        e.preventDefault();
        const target = $(this.getAttribute('href'));
        if (target.length) {
            $('html, body').stop().animate({
                scrollTop: target.offset().top - 80
            }, 800);
        }
    });

    // Setup CSRF token for AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

/**
 * Load activities via AJAX
 */
function loadActivities() {
    // Show loading, hide no results
    $('#loading-activities').show();
    $('#no-activities').addClass('d-none');
    $('#activities-grid').empty();

    $.ajax({
        url: '/api/activities',
        method: 'GET',
        data: {
            category_id: currentCategory,
            emirate: currentEmirate,
            sort: currentSort
        },
        success: function(response) {
            $('#loading-activities').hide();

            if (response.activities && response.activities.length > 0) {
                renderActivities(response.activities);
                updateResultsCounter(response.filtered || response.activities.length, response.total || response.activities.length);
            } else {
                $('#no-activities').removeClass('d-none');
                updateResultsCounter(0, response.total || 0);
            }
        },
        error: function() {
            $('#loading-activities').hide();
            showToast('Erreur lors du chargement des activités', 'error');
        }
    });
}

/**
 * Render activities as cards
 */
function renderActivities(activities) {
    const grid = $('#activities-grid');
    grid.empty();
    
    const isEnglish = window.appLocale === 'en';
    const addToCartText = isEnglish ? 'Add to Cart' : 'Ajouter au Panier';
    const addedText = isEnglish ? 'Added' : 'Ajouté';
    const viewDetailsText = isEnglish ? 'View' : 'Voir';

    activities.forEach(activity => {
        const firstImage = activity.images && activity.images.length > 0
            ? activity.images[0]
            : 'images/default.jpg';

        const isSelected = selectedActivities.some(a => a.id === activity.id);
        const selectedClass = isSelected ? 'selected' : '';
        const buttonText = isSelected ? addedText : addToCartText;
        const buttonIcon = isSelected ? 'bi-check-circle' : 'bi-cart-plus';

        const stars = generateStars(activity.notes);

        const card = `
            <div class="col">
                <div class="activity-card ${selectedClass}" data-id="${activity.id}" data-prix="${activity.prix}">
                    <div class="activity-card-image">
                        <img src="/${firstImage}" alt="${activity.nom}" loading="lazy">
                        <a href="/activity/${activity.slug}" class="btn btn-sm btn-outline-light voir-details-image">
                            <i class="bi bi-eye"></i> ${viewDetailsText}
                        </a>
                    </div>
                    <div class="activity-card-body">
                        <h5 class="activity-card-title">${activity.nom}</h5>
                        <div class="activity-card-location">
                            <i class="bi bi-geo-alt"></i> ${activity.location}
                        </div>
                        <div class="activity-card-rating">
                            ${stars}
                        </div>
                        <div class="activity-card-footer">
                            <div class="activity-card-price">
                                <strong>${parseFloat(activity.prix).toFixed(2)} AED</strong>
                            </div>
                            <button class="btn btn-sm btn-primary add-to-cart-btn" data-id="${activity.id}">
                                <i class="bi ${buttonIcon}"></i> ${buttonText}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;

        grid.append(card);
    });

    // Attach event listeners
    attachActivityListeners();
}

/**
 * Setup event listeners
 */
function setupEventListeners() {
    // Category filter
    $('#category-select').on('change', function() {
        currentCategory = $(this).val();
        loadActivities();
    });

    // Emirate filter
    $('#emirate-select').on('change', function() {
        currentEmirate = $(this).val();
        loadActivities();
    });

    // Sorting
    $('#sort-select').on('change', function() {
        currentSort = $(this).val();
        loadActivities();
    });

    // View cart button
    $('#voir-panier-btn, #panier-btn').on('click', function(e) {
        e.preventDefault();
        if (selectedActivities.length > 0) {
            scrollToElement('#total-section');
        } else {
            showToast('Votre panier est vide', 'warning');
        }
    });

    // Order button
    $('#commander-btn').on('click', function() {
        if (selectedActivities.length === 0) {
            showToast('Veuillez sélectionner au moins une activité', 'warning');
            return;
        }
        $('#orderModal').modal('show');
    });

    // Confirm order button
    $('#confirm-order-btn').on('click', function() {
        submitOrder();
    });

    // Form validation
    $('#order-form').on('submit', function(e) {
        e.preventDefault();
    });
}

/**
 * Attach listeners to activity cards
 */
function attachActivityListeners() {
    // Add to cart button
    $('.add-to-cart-btn').off('click').on('click', function(e) {
        e.stopPropagation();
        const activityId = parseInt($(this).data('id'));
        const activityCard = $(this).closest('.activity-card');
        const activityPrice = parseFloat(activityCard.data('prix'));

        const isSelected = selectedActivities.some(a => a.id === activityId);

        if (isSelected) {
            // Remove from selection
            selectedActivities = selectedActivities.filter(a => a.id !== activityId);
            activityCard.removeClass('selected');
            $(this).html('<i class="bi bi-cart-plus"></i> ' + (window.appLocale === 'en' ? 'Add to Cart' : 'Ajouter au Panier'));
        } else {
            // Add to selection
            selectedActivities.push({
                id: activityId,
                prix: activityPrice
            });
            activityCard.addClass('selected');
            $(this).html('<i class="bi bi-check-circle"></i> ' + (window.appLocale === 'en' ? 'Added' : 'Ajouté'));
        }

        updateTotalPrice();
        updateCartCount();
    });
}

/**
 * Load cart from localStorage
 */
function loadCartFromStorage() {
    const savedCart = localStorage.getItem('kendea_cart');
    if (savedCart) {
        try {
            selectedActivities = JSON.parse(savedCart);
            updateTotalPrice();
            updateCartCount();
        } catch (e) {
            console.error('Error loading cart from storage:', e);
            selectedActivities = [];
        }
    }
}

/**
 * Save cart to localStorage
 */
function saveCartToStorage() {
    localStorage.setItem('kendea_cart', JSON.stringify(selectedActivities));
}

/**
 * Update total price calculation
 */
function updateTotalPrice() {
    totalPrice = selectedActivities.reduce((sum, activity) => sum + activity.prix, 0);

    $('#total-price').text(totalPrice.toFixed(2));
    $('#selected-count').text(selectedActivities.length);

    if (selectedActivities.length > 0) {
        $('#total-section').slideDown();
    } else {
        $('#total-section').slideUp();
    }
    
    // Save to localStorage
    saveCartToStorage();
}

/**
 * Update cart count in header
 */
function updateCartCount() {
    const count = selectedActivities.length;
    $('#panier-count, #panier-count-inline').text(count);

    if (count > 0) {
        $('#panier-count').removeClass('d-none').show();
    } else {
        $('#panier-count').hide();
    }
}

/**
 * Load activity details via AJAX
 */
function loadActivityDetails(activityId) {
    showLoading();

    $.ajax({
        url: `/api/activities/${activityId}`,
        method: 'GET',
        success: function(activity) {
            displayActivityDetails(activity);
            hideLoading();
            $('#activityDetailsModal').modal('show');
        },
        error: function() {
            hideLoading();
            showToast('Erreur lors du chargement des détails', 'error');
        }
    });
}

/**
 * Display activity details in modal
 */
function displayActivityDetails(activity) {
    const starsHtml = generateStars(activity.notes);
    const isEnglish = window.appLocale === 'en';

    let imagesHtml = '<div id="activityCarousel" class="carousel slide" data-bs-ride="carousel">';
    imagesHtml += '<div class="carousel-inner">';

    activity.images.forEach((image, index) => {
        const activeClass = index === 0 ? 'active' : '';
        const altText = isEnglish ? activity.nom_en : activity.nom;
        imagesHtml += `
            <div class="carousel-item ${activeClass}">
                <img src="/${image}" class="d-block w-100 rounded" alt="${altText}" loading="lazy" style="max-height: 400px; object-fit: cover;">
            </div>
        `;
    });

    imagesHtml += '</div>';
    if (activity.images.length > 1) {
        const prevText = isEnglish ? 'Previous' : 'Précédent';
        const nextText = isEnglish ? 'Next' : 'Suivant';
        imagesHtml += `
            <button class="carousel-control-prev" type="button" data-bs-target="#activityCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">${prevText}</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#activityCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">${nextText}</span>
            </button>
        `;
    }
    imagesHtml += '</div>';

    const activityName = isEnglish ? activity.nom_en : activity.nom;
    const categoryName = isEnglish ? (activity.category.nom_en || activity.category.nom) : activity.category.nom;
    const location = isEnglish ? (activity.location_en || activity.location) : activity.location;
    const description = isEnglish ? activity.description_en : activity.description;

    const detailsHtml = `
        ${imagesHtml}
        <div class="activity-details-content mt-4">
            <h3>${activityName}</h3>
            <div class="mb-3">
                <span class="badge bg-primary">${categoryName}</span>
                <span class="ms-2"><i class="bi bi-geo-alt"></i> ${location}</span>
            </div>
            <div class="mb-3">
                ${starsHtml} <span class="ms-2">(${activity.notes} / 5.0)</span>
            </div>
            <p class="lead">${description}</p>
            <div class="price-tag mt-4 p-3 bg-light rounded">
                <h4 class="text-primary mb-0">${parseFloat(activity.prix).toFixed(2)} AED</h4>
            </div>
        </div>
    `;

    $('#activity-details-content').html(detailsHtml);
}

/**
 * Generate star rating HTML
 */
function generateStars(rating) {
    let stars = '';
    const fullStars = Math.floor(rating);
    const hasHalfStar = (rating - fullStars) >= 0.5;

    for (let i = 0; i < fullStars; i++) {
        stars += '<i class="bi bi-star-fill text-warning"></i>';
    }

    if (hasHalfStar) {
        stars += '<i class="bi bi-star-half text-warning"></i>';
    }

    const emptyStars = 5 - Math.ceil(rating);
    for (let i = 0; i < emptyStars; i++) {
        stars += '<i class="bi bi-star text-warning"></i>';
    }

    return stars;
}

/**
 * Submit order via AJAX
 */
function submitOrder() {
    // Validate form
    const form = document.getElementById('order-form');
    if (!form.checkValidity()) {
        form.classList.add('was-validated');
        return;
    }

    showLoading();

    const formData = {
        prenom: $('#prenom').val(),
        nom: $('#nom').val(),
        email: $('#email').val(),
        phone: $('#phone').val(),
        datetime: $('#datetime').val(),
        activities: selectedActivities.map(a => a.id),
        montant_total: totalPrice
    };

    $.ajax({
        url: '/api/commandes',
        method: 'POST',
        data: JSON.stringify(formData),
        contentType: 'application/json',
        success: function(response) {
            hideLoading();
            $('#orderModal').modal('hide');

            // Generate WhatsApp message
            const whatsappMessage = generateWhatsAppMessage(response);

            // Redirect to WhatsApp
            window.open(`https://wa.me/${WHATSAPP_NUMBER}?text=${encodeURIComponent(whatsappMessage)}`, '_blank');

            // Show success message
            showToast('Commande enregistrée ! Vous allez être redirigé vers WhatsApp.', 'success');

            // Reset form and selections
            setTimeout(() => {
                resetOrderForm();
            }, 1000);
        },
        error: function(xhr) {
            hideLoading();
            const errors = xhr.responseJSON?.errors;
            if (errors) {
                Object.keys(errors).forEach(key => {
                    showToast(errors[key][0], 'error');
                });
            } else {
                showToast('Erreur lors de la création de la commande', 'error');
            }
        }
    });
}

/**
 * Generate WhatsApp message
 */
function generateWhatsAppMessage(response) {
    let message = `Bonjour, je souhaite réserver les activités suivantes:\n\n`;

    response.activities.forEach((activity, index) => {
        message += `${index + 1}. ${activity.nom} - ${parseFloat(activity.prix).toFixed(2)} AED\n`;
    });

    message += `\n*Total: ${parseFloat(response.commande.montant_total).toFixed(2)} AED*\n\n`;
    message += `Informations du client:\n`;
    message += `Nom: ${response.client.prenom} ${response.client.nom}\n`;
    message += `Email: ${response.client.email}\n`;
    message += `Téléphone: ${response.client.phone}\n`;
    message += `Date souhaitée: ${response.commande.datetime}\n\n`;
    message += `Numéro de commande: #${response.commande.id}`;

    return message;
}

/**
 * Reset order form and selections
 */
function resetOrderForm() {
    $('#order-form')[0].reset();
    $('#order-form').removeClass('was-validated');
    selectedActivities = [];
    totalPrice = 0;
    updateTotalPrice();
    updateCartCount();
    $('.activity-card').removeClass('selected');
    $('.add-to-cart-btn').html('<i class="bi bi-cart-plus"></i> ' + (window.appLocale === 'en' ? 'Add to Cart' : 'Ajouter au Panier'));
}

/**
 * Show loading spinner
 */
function showLoading() {
    $('#loading-spinner').removeClass('d-none');
}

/**
 * Hide loading spinner
 */
function hideLoading() {
    $('#loading-spinner').addClass('d-none');
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

/**
 * Smooth scroll to element
 */
function scrollToElement(selector) {
    const target = $(selector);
    if (target.length) {
        $('html, body').animate({
            scrollTop: target.offset().top - 80
        }, 800);
    }
}

/**
 * Update results counter
 */
function updateResultsCounter(filtered, total) {
    document.getElementById('visible-count').textContent = filtered;
    document.getElementById('total-count').textContent = total;
}
