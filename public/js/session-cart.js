// Modified by Claude - Session-based Cart
// Simple cart management using Laravel session via API

class SessionCart {
    constructor() {
        this.loadCount();
    }
    
    async loadCount() {
        try {
            const response = await fetch('/api/cart/count');
            const data = await response.json();
            this.updateUI(data.count);
        } catch (error) {
            console.error('Error loading cart count:', error);
        }
    }
    
    async add(activityId) {
        try {
            const response = await fetch('/api/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ activity_id: activityId })
            });
            
            const data = await response.json();
            if (data.success) {
                this.updateUI(data.count);
                return true;
            }
            return false;
        } catch (error) {
            console.error('Error adding to cart:', error);
            return false;
        }
    }
    
    async remove(activityId) {
        try {
            const response = await fetch('/api/cart/remove', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ activity_id: activityId })
            });
            
            const data = await response.json();
            if (data.success) {
                this.updateUI(data.count);
                return true;
            }
            return false;
        } catch (error) {
            console.error('Error removing from cart:', error);
            return false;
        }
    }
    
    updateUI(count) {
        document.querySelectorAll('#panier-count, #panier-count-inline').forEach(el => {
            el.textContent = count;
            if (count > 0) {
                el.classList.remove('d-none');
            } else {
                el.classList.add('d-none');
            }
        });
    }
}

// Initialize global cart
window.sessionCart = new SessionCart();

// Add to cart button handler
document.addEventListener('click', async function(e) {
    if (e.target.closest('.btn-add-to-cart')) {
        const btn = e.target.closest('.btn-add-to-cart');
        const activityId = btn.dataset.activityId;
        
        // Disable button during request
        btn.disabled = true;
        const originalHtml = btn.innerHTML;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span>';
        
        const success = await window.sessionCart.add(activityId);
        
        if (success) {
            btn.innerHTML = '<i class="bi bi-check-circle"></i> Ajouté !';
            setTimeout(() => {
                btn.innerHTML = '<i class="bi bi-check-circle"></i> Déjà dans le Panier';
                btn.classList.add('btn-secondary');
                btn.style.backgroundColor = '#6c757d';
            }, 1000);
        } else {
            btn.innerHTML = originalHtml;
            btn.disabled = false;
        }
    }
});
