// Modified by Claude
// Dubai Activities SPA - Main JavaScript

// Global variables
let selectedActivities = [];
let totalPrice = 0;
let activitiesDataTable = null;
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

    // Initialize DataTables
    initializeDataTable();

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
 * Initialize DataTables for activities
 */
function initializeDataTable() {
    activitiesDataTable = $('#activities-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '/api/activities',
            type: 'GET',
            data: function(d) {
                d.category_id = $('.category-btn.active').data('category');
            }
        },
        columns: [
            { data: 'checkbox', name: 'checkbox', orderable: false, searchable: false, width: '5%' },
            { data: 'image', name: 'image', orderable: false, searchable: false, width: '15%' },
            { data: 'details', name: 'nom', width: '65%' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false, width: '15%' }
        ],
        pageLength: 12,
        lengthChange: false,
        searching: false,
        ordering: true,
        order: [[2, 'asc']], // Sort by name by default
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/fr-FR.json',
            processing: '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Chargement...</span></div>',
            zeroRecords: 'Aucune activité trouvée',
            emptyTable: 'Aucune activité disponible',
            info: 'Affichage de _START_ à _END_ sur _TOTAL_ activités',
            infoEmpty: 'Aucune activité disponible',
            infoFiltered: '(filtré de _MAX_ activités au total)',
            paginate: {
                first: 'Premier',
                last: 'Dernier',
                next: 'Suivant',
                previous: 'Précédent'
            }
        },
        dom: '<"row"<"col-sm-12"tr>><"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
        drawCallback: function() {
            // Reattach event listeners after table redraw
            attachActivityListeners();
            // Update selected activities visual feedback
            updateSelectedActivitiesUI();
        },
        createdRow: function(row, data, dataIndex) {
            $(row).addClass('activity-row');
        }
    });
}

/**
 * Setup event listeners
 */
function setupEventListeners() {
    // Category filter
    $('.category-btn').on('click', function() {
        $('.category-btn').removeClass('active');
        $(this).addClass('active');
        activitiesDataTable.ajax.reload();
    });

    // Sorting
    $('#sort-select').on('change', function() {
        const sortValue = $(this).val();
        applySorting(sortValue);
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
    // Checkbox change
    $('.activite-checkbox').off('change').on('change', function() {
        const activityId = parseInt($(this).val());
        const activityPrice = parseFloat($(this).closest('.activite-card').data('prix'));
        const activityCard = $(this).closest('.activite-card');

        if ($(this).is(':checked')) {
            // Add to selection
            selectedActivities.push({
                id: activityId,
                prix: activityPrice
            });
            activityCard.addClass('selected');
        } else {
            // Remove from selection
            selectedActivities = selectedActivities.filter(a => a.id !== activityId);
            activityCard.removeClass('selected');
        }

        updateTotalPrice();
        updateCartCount();
    });

    // View details button
    $('.voir-details').off('click').on('click', function() {
        const activityId = $(this).data('id');
        loadActivityDetails(activityId);
    });
}

/**
 * Update selected activities UI after table redraw
 */
function updateSelectedActivitiesUI() {
    selectedActivities.forEach(activity => {
        const checkbox = $('#activite-' + activity.id);
        if (checkbox.length) {
            checkbox.prop('checked', true);
            checkbox.closest('.activite-card').addClass('selected');
        }
    });
}

/**
 * Apply sorting to DataTable
 */
function applySorting(sortValue) {
    let column, direction;

    switch(sortValue) {
        case 'nom_asc':
            column = 2; direction = 'asc';
            break;
        case 'nom_desc':
            column = 2; direction = 'desc';
            break;
        case 'prix_asc':
        case 'prix_desc':
        case 'notes_desc':
            // For prix and notes, we'll need server-side ordering
            // DataTables will handle this through AJAX
            activitiesDataTable.order([2, direction]).draw();
            return;
        default:
            column = 2; direction = 'asc';
    }

    activitiesDataTable.order([column, direction]).draw();
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

    let imagesHtml = '<div id="activityCarousel" class="carousel slide" data-bs-ride="carousel">';
    imagesHtml += '<div class="carousel-inner">';

    activity.images.forEach((image, index) => {
        const activeClass = index === 0 ? 'active' : '';
        imagesHtml += `
            <div class="carousel-item ${activeClass}">
                <img src="/${image}" class="d-block w-100 rounded" alt="${activity.nom}" loading="lazy" style="max-height: 400px; object-fit: cover;">
            </div>
        `;
    });

    imagesHtml += '</div>';
    if (activity.images.length > 1) {
        imagesHtml += `
            <button class="carousel-control-prev" type="button" data-bs-target="#activityCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Précédent</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#activityCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Suivant</span>
            </button>
        `;
    }
    imagesHtml += '</div>';

    const detailsHtml = `
        ${imagesHtml}
        <div class="activity-details-content mt-4">
            <h3>${activity.nom}</h3>
            <div class="mb-3">
                <span class="badge bg-primary">${activity.category.nom}</span>
                <span class="ms-2"><i class="bi bi-geo-alt"></i> ${activity.location}</span>
            </div>
            <div class="mb-3">
                ${starsHtml} <span class="ms-2">(${activity.notes} / 5.0)</span>
            </div>
            <p class="lead">${activity.description}</p>
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
    $('.activite-checkbox').prop('checked', false);
    $('.activite-card').removeClass('selected');
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
