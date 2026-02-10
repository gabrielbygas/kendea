// Modified by Claude
// Activities Management Module

class ActivitiesManager {
    constructor(cart) {
        this.cart = cart;
        this.currentCategory = '';
        this.currentEmirate = '';
        this.currentSort = 'nom_asc';
        this.init();
    }

    init() {
        this.attachEventListeners();
        this.loadActivities();
    }

    attachEventListeners() {
        // Category select
        const categorySelect = document.getElementById('category-select');
        if (categorySelect) {
            categorySelect.addEventListener('change', (e) => {
                this.currentCategory = e.target.value;
                this.loadActivities();
            });
        }

        // Emirate select
        const emirateSelect = document.getElementById('emirate-select');
        if (emirateSelect) {
            emirateSelect.addEventListener('change', (e) => {
                this.currentEmirate = e.target.value;
                this.loadActivities();
            });
        }

        // Sort select
        const sortSelect = document.getElementById('sort-select');
        if (sortSelect) {
            sortSelect.addEventListener('change', (e) => {
                this.currentSort = e.target.value;
                this.loadActivities();
            });
        }

        // View details buttons
        document.addEventListener('click', (e) => {
            if (e.target.closest('.voir-details')) {
                const btn = e.target.closest('.voir-details');
                const activityId = btn.dataset.id;
                this.showActivityDetails(activityId);
            }
        });

        // Order button
        const orderBtn = document.getElementById('commander-btn');
        if (orderBtn) {
            orderBtn.addEventListener('click', () => this.showOrderForm());
        }
    }

    async loadActivities() {
        const grid = document.getElementById('activities-grid');
        const loading = document.getElementById('loading-activities');
        const noActivities = document.getElementById('no-activities');

        if (!grid) return;

        // Show loading
        if (loading) loading.style.display = 'block';
        grid.innerHTML = '';
        if (noActivities) noActivities.classList.add('d-none');

        try {
            const params = new URLSearchParams();
            if (this.currentCategory) params.append('category', this.currentCategory);
            if (this.currentEmirate) params.append('emirate', this.currentEmirate);
            params.append('sort', this.currentSort);

            const response = await fetch(`/api/activities?${params.toString()}`);
            if (!response.ok) throw new Error('Failed to fetch activities');

            const activities = await response.json();

            if (loading) loading.style.display = 'none';

            if (activities.length === 0) {
                if (noActivities) noActivities.classList.remove('d-none');
                return;
            }

            activities.forEach(activity => {
                grid.appendChild(this.createActivityCard(activity));
            });

            // Update cart UI after loading
            this.cart.updateUI();

        } catch (error) {
            console.error('Error loading activities:', error);
            if (loading) loading.style.display = 'none';
            if (noActivities) noActivities.classList.remove('d-none');
        }
    }

    createActivityCard(activity) {
        const col = document.createElement('div');
        col.className = 'col';

        const isInCart = this.cart.items.some(item => item.id === activity.id);
        
        col.innerHTML = `
            <div class="activity-card" data-id="${activity.id}" data-prix="${activity.prix}">
                <div class="activity-card-image">
                    <img src="${activity.first_image}" alt="${activity.nom}" loading="lazy">
                    <div class="activity-card-checkbox">
                        <input type="checkbox" class="activite-checkbox form-check-input" 
                               id="activite-${activity.id}" value="${activity.id}" ${isInCart ? 'checked' : ''}>
                    </div>
                </div>
                <div class="activity-card-body">
                    <h5 class="activity-card-title">${activity.nom}</h5>
                    <div class="activity-card-location">
                        <i class="bi bi-geo-alt"></i> ${activity.localisation}
                    </div>
                    <div class="activity-card-rating">
                        ${this.renderStars(activity.notes)}
                    </div>
                    <div class="activity-card-footer">
                        <div class="activity-card-price">
                            <strong>${parseFloat(activity.prix).toFixed(2)} AED</strong>
                        </div>
                        <button class="btn btn-sm btn-outline-primary voir-details" data-id="${activity.id}">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>
            </div>
        `;

        return col;
    }

    renderStars(rating) {
        const fullStars = Math.floor(rating);
        const hasHalfStar = rating % 1 >= 0.5;
        let stars = '';

        for (let i = 0; i < fullStars; i++) {
            stars += '<i class="bi bi-star-fill text-warning"></i>';
        }
        if (hasHalfStar) {
            stars += '<i class="bi bi-star-half text-warning"></i>';
        }
        const emptyStars = 5 - fullStars - (hasHalfStar ? 1 : 0);
        for (let i = 0; i < emptyStars; i++) {
            stars += '<i class="bi bi-star text-warning"></i>';
        }

        return stars;
    }

    async showActivityDetails(activityId) {
        try {
            const response = await fetch(`/api/activities/${activityId}`);
            if (!response.ok) throw new Error('Failed to fetch activity');
            
            const activity = await response.json();
            
            // Create and show modal with activity details
            const modal = new bootstrap.Modal(document.getElementById('activityDetailModal'));
            this.populateDetailModal(activity);
            modal.show();
        } catch (error) {
            console.error('Error fetching activity details:', error);
        }
    }

    populateDetailModal(activity) {
        const modal = document.getElementById('activityDetailModal');
        if (!modal) return;

        modal.querySelector('.modal-title').textContent = activity.nom;
        modal.querySelector('#detail-description').textContent = activity.description;
        modal.querySelector('#detail-location').innerHTML = `<i class="bi bi-geo-alt"></i> ${activity.localisation}`;
        modal.querySelector('#detail-rating').innerHTML = this.renderStars(activity.notes);
        modal.querySelector('#detail-price').innerHTML = `<strong>${parseFloat(activity.prix).toFixed(2)} AED</strong>`;
        
        // Images carousel
        const carouselInner = modal.querySelector('.carousel-inner');
        if (carouselInner && activity.images) {
            carouselInner.innerHTML = activity.images.map((img, index) => `
                <div class="carousel-item ${index === 0 ? 'active' : ''}">
                    <img src="${img}" class="d-block w-100" alt="${activity.nom}">
                </div>
            `).join('');
        }
    }

    showOrderForm() {
        if (this.cart.getCount() === 0) {
            alert(document.documentElement.lang === 'fr' 
                ? 'Veuillez sélectionner au moins une activité' 
                : 'Please select at least one activity');
            return;
        }

        const modal = new bootstrap.Modal(document.getElementById('orderFormModal'));
        this.populateOrderForm();
        modal.show();
    }

    populateOrderForm() {
        const orderItems = document.getElementById('order-items');
        const orderTotal = document.getElementById('order-total');

        if (orderItems) {
            orderItems.innerHTML = this.cart.items.map(item => `
                <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                    <div>
                        <strong>${item.nom}</strong>
                        <br>
                        <small class="text-muted">${item.localisation}</small>
                    </div>
                    <div class="text-end">
                        <strong style="color: var(--color-primary)">${parseFloat(item.prix).toFixed(2)} AED</strong>
                    </div>
                </div>
            `).join('');
        }

        if (orderTotal) {
            orderTotal.textContent = this.cart.getTotal().toFixed(2);
        }
    }
}

export default ActivitiesManager;
