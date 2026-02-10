{{-- Modified by Claude --}}
<style>
    .footer-container .footer-link {
        color: #f8f9fa !important;
        text-decoration: none;
        transition: color 0.3s ease;
    }
    .footer-container .footer-link:hover {
        color: #FF6A00 !important;
    }
    .footer-container .social-link {
        color: #f8f9fa !important;
        transition: color 0.3s ease;
    }
    .footer-container .social-link:hover {
        color: #FF6A00 !important;
    }
</style>
<div class="footer-container bg-dark text-light py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ asset('images/kendea-logo.png') }}" alt="KENDEA Logo" width="60" height="60" class="me-2">
                    <h5 class="mb-0" style="color: #FF6A00;">KENDEA</h5>
                </div>
                <p>{{ __('Votre partenaire de confiance pour découvrir des expériences inoubliables. Service de qualité garanti.') }}</p>
            </div>
            <div class="col-md-4 mb-4">
                <h5>{{ __('Liens Rapides') }}</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('home') }}" class="footer-link">{{ __('Accueil') }}</a></li>
                    <li><a href="{{ route('home') }}#about" class="footer-link">{{ __('À Propos') }}</a></li>
                    <li><a href="{{ route('activities.index') }}" class="footer-link">{{ __('Activités') }}</a></li>
                    <li><a href="{{ route('contact') }}" class="footer-link">{{ __('Contact') }}</a></li>
                </ul>
            </div>
            <div class="col-md-4 mb-4">
                <h5>{{ __('Contact') }}</h5>
                <p><i class="bi bi-whatsapp"></i> {{ __('WhatsApp') }}: +971 XX XXX XXXX</p>
                <p><i class="bi bi-envelope"></i> {{ __('Email') }}: info@kendea.ae</p>
                <div class="social-icons mt-3">
                    <a href="#" class="social-link me-3"><i class="bi bi-facebook fs-4"></i></a>
                    <a href="#" class="social-link me-3"><i class="bi bi-instagram fs-4"></i></a>
                    <a href="#" class="social-link"><i class="bi bi-whatsapp fs-4"></i></a>
                </div>
            </div>
        </div>
        <hr class="bg-light">
        <div class="text-center">
            <p class="mb-0">&copy; 2026 KENDEA. {{ __('Tous droits réservés.') }}</p>
        </div>
    </div>
</div>
