// Modified by Claude - Session-based Cart
// Simple cart management using Laravel session via API

class SessionCart {
    constructor() {
        // Don't load count on init - trust the SSR value in the HTML
        // Only update when user adds/removes items
        console.log('[SessionCart] Initialized - using SSR count from HTML');
    }
    
    async add(activityId) {
        try {
            const response = await fetch('/api/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                credentials: 'same-origin',
                body: JSON.stringify({ activity_id: activityId })
            });
            
            const data = await response.json();
            if (data.success) {
                this.updateUI(data.count);
                
                // Show success alert
                this.showAlert('Activité ajoutée au panier avec succès !', 'success');
                
                return true;
            }
            return false;
        } catch (error) {
            console.error('Error adding to cart:', error);
            this.showAlert('Erreur lors de l\'ajout au panier', 'error');
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
                credentials: 'same-origin',
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
        console.log('[SessionCart] Updating UI with count:', count);
        
        document.querySelectorAll('#panier-count, #panier-count-inline').forEach(el => {
            // Find the text node (first child if it's text)
            if (el.firstChild && el.firstChild.nodeType === Node.TEXT_NODE) {
                el.firstChild.textContent = count;
            } else {
                // Create text node if doesn't exist
                const textNode = document.createTextNode(count);
                el.insertBefore(textNode, el.firstChild);
            }
            
            // Show/hide badge
            if (count > 0) {
                el.classList.remove('d-none');
            } else {
                el.classList.add('d-none');
            }
        });
    }
    
    showAlert(message, type = 'success') {
        // Get translation based on current locale
        const locale = window.appLocale || 'fr';
        const translations = {
            fr: {
                success: 'Activité ajoutée au panier avec succès !',
                error: 'Erreur lors de l\'ajout au panier'
            },
            en: {
                success: 'Activity successfully added to cart!',
                error: 'Error adding to cart'
            }
        };
        
        // Use provided message or get translation
        const finalMessage = message || (type === 'success' ? translations[locale].success : translations[locale].error);
        
        // Create Bootstrap alert
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show position-fixed`;
        alertDiv.style.cssText = 'top: 80px; right: 20px; z-index: 9999; min-width: 300px;';
        alertDiv.innerHTML = `
            <i class="bi bi-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
            ${finalMessage}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        document.body.appendChild(alertDiv);
        
        // Auto-dismiss after 3 seconds
        setTimeout(() => {
            alertDiv.classList.remove('show');
            setTimeout(() => alertDiv.remove(), 150);
        }, 3000);
    }
}

// Initialize global cart when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    window.sessionCart = new SessionCart();
});

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
