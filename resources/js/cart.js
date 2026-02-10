// Modified by Claude
// Cart Management Module

class Cart {
    constructor() {
        this.items = this.loadFromStorage();
        this.init();
    }

    init() {
        this.updateUI();
        this.attachEventListeners();
    }

    loadFromStorage() {
        try {
            const saved = localStorage.getItem('kendea_cart');
            return saved ? JSON.parse(saved) : [];
        } catch (e) {
            console.error('Error loading cart:', e);
            return [];
        }
    }

    saveToStorage() {
        try {
            localStorage.setItem('kendea_cart', JSON.stringify(this.items));
        } catch (e) {
            console.error('Error saving cart:', e);
        }
    }

    addItem(activity) {
        const exists = this.items.find(item => item.id === activity.id);
        if (!exists) {
            this.items.push(activity);
            this.saveToStorage();
            this.updateUI();
            return true;
        }
        return false;
    }

    removeItem(activityId) {
        this.items = this.items.filter(item => item.id !== activityId);
        this.saveToStorage();
        this.updateUI();
    }

    clearCart() {
        this.items = [];
        this.saveToStorage();
        this.updateUI();
    }

    getTotal() {
        return this.items.reduce((sum, item) => sum + parseFloat(item.prix || 0), 0);
    }

    getCount() {
        return this.items.length;
    }

    updateUI() {
        // Update cart counter
        const counter = document.getElementById('panier-count');
        if (counter) {
            counter.textContent = this.getCount();
        }

        // Update checkboxes
        document.querySelectorAll('.activite-checkbox').forEach(checkbox => {
            const activityId = parseInt(checkbox.value);
            checkbox.checked = this.items.some(item => item.id === activityId);
        });

        // Update total section
        const totalSection = document.getElementById('total-section');
        if (totalSection) {
            if (this.items.length > 0) {
                totalSection.style.display = 'block';
                document.getElementById('selected-count').textContent = this.getCount();
                document.getElementById('total-price').textContent = this.getTotal().toFixed(2);
            } else {
                totalSection.style.display = 'none';
            }
        }
    }

    attachEventListeners() {
        // Checkbox toggle
        document.addEventListener('change', (e) => {
            if (e.target.classList.contains('activite-checkbox')) {
                const activityId = parseInt(e.target.value);
                
                if (e.target.checked) {
                    this.fetchAndAddActivity(activityId);
                } else {
                    this.removeItem(activityId);
                }
            }
        });
    }

    async fetchAndAddActivity(activityId) {
        try {
            const response = await fetch(`/api/activities/${activityId}`);
            if (!response.ok) throw new Error('Failed to fetch activity');
            
            const activity = await response.json();
            this.addItem(activity);
        } catch (error) {
            console.error('Error fetching activity:', error);
            // Uncheck the checkbox if fetch fails
            const checkbox = document.querySelector(`input[value="${activityId}"]`);
            if (checkbox) checkbox.checked = false;
        }
    }
}

// Export for use in other modules
export default Cart;
