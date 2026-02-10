// Modified by Claude
import './bootstrap';
import Cart from './cart.js';
import ActivitiesManager from './activities.js';

// Initialize application when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    // Initialize cart
    const cart = new Cart();
    
    // Initialize activities manager (only on activities page)
    if (document.getElementById('activities-grid')) {
        const activitiesManager = new ActivitiesManager(cart);
    }
    
    // Order form submission
    const orderForm = document.getElementById('order-form');
    if (orderForm) {
        orderForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const formData = new FormData(orderForm);
            const data = {
                nom: formData.get('nom'),
                email: formData.get('email'),
                telephone: formData.get('telephone'),
                date: formData.get('date'),
                message: formData.get('message'),
                activities: cart.items.map(item => item.id)
            };
            
            try {
                const response = await fetch('/api/commandes', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(data)
                });
                
                if (!response.ok) throw new Error('Order submission failed');
                
                const result = await response.json();
                
                // Clear cart
                cart.clearCart();
                
                // Close modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('orderFormModal'));
                if (modal) modal.hide();
                
                // Redirect to WhatsApp or show success message
                if (result.whatsapp_url) {
                    window.open(result.whatsapp_url, '_blank');
                }
                
                // Show success message
                alert(document.documentElement.lang === 'fr' 
                    ? 'Commande envoyée avec succès!' 
                    : 'Order sent successfully!');
                
            } catch (error) {
                console.error('Error submitting order:', error);
                alert(document.documentElement.lang === 'fr' 
                    ? 'Erreur lors de l\'envoi de la commande' 
                    : 'Error sending order');
            }
        });
    }
});
