<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

    {{-- SEO Meta Tags --}}
    <meta name="description" content="Réservez vos activités facilement avec KENDEA. Safari dans le désert, attractions aquatiques, visites culturelles et plus encore. Service de qualité.">
    <meta name="keywords" content="activités, réservation, safari désert, Burj Khalifa, attractions, voyage, KENDEA">
    <meta name="author" content="KENDEA">
    <meta name="robots" content="index, follow">

    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:title" content="KENDEA - Réservation d'Activités">
    <meta property="og:description" content="Découvrez et réservez les meilleures activités avec KENDEA. Service de qualité garanti.">
    <meta property="og:image" content="{{ asset('images/og-image.jpg') }}">

    {{-- Twitter --}}
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url('/') }}">
    <meta property="twitter:title" content="KENDEA - Réservation d'Activités">
    <meta property="twitter:description" content="Découvrez et réservez les meilleures activités avec KENDEA.">
    <meta property="twitter:image" content="{{ asset('images/twitter-image.jpg') }}">

    {{-- Canonical URL --}}
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield("title", "KENDEA - Réservation d'Activités")</title>

    {{-- Preconnect for performance --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net">

    {{-- Bootstrap 5 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- DataTables Bootstrap 5 CSS --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.min.css">

    {{-- AOS Animation CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">

    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @stack('styles')
</head>
<body>
    {{-- Header/Navigation --}}
    <header id="header-main" class="sticky-top">
        @include('partials.header')
    </header>

    {{-- Main Content --}}
    <main id="app-main">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer id="footer-main">
        @include('partials.footer')
    </footer>

    {{-- Loading Spinner --}}
    <div id="loading-spinner" class="d-none">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Chargement...</span>
        </div>
    </div>

    {{-- jQuery --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha384-1H217gwSVyLSIfaLxHbE7dRb3v4mYCKbpQvzx0cegeju1MVsGrX5xXxAvs/HgeFs" crossorigin="anonymous"></script>

    {{-- Bootstrap 5 JS Bundle --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    {{-- DataTables JS --}}
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.bootstrap5.min.js"></script>

    {{-- AOS Animation JS --}}
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

    {{-- Floating Action Buttons --}}
    <div class="floating-buttons">
        <button id="scroll-to-top" class="floating-btn" title="{{ __('Retour en haut') }}" style="display: none;">
            <i class="bi bi-arrow-up"></i>
        </button>
        <a href="https://wa.me/971XXXXXXXXX" target="_blank" class="floating-btn whatsapp-btn" title="{{ __('Discuter sur WhatsApp') }}">
            <i class="bi bi-whatsapp"></i>
        </a>
    </div>

    <style>
        .floating-buttons {
            position: fixed;
            bottom: 30px;
            right: 30px;
            display: flex;
            flex-direction: column;
            gap: 15px;
            z-index: 1000;
        }

        .floating-btn {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: none;
            background-color: #FF6A00;
            color: white;
            font-size: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(255, 106, 0, 0.4);
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .floating-btn:hover {
            background-color: #ff8534;
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(255, 106, 0, 0.5);
            color: white;
        }

        .floating-btn:active {
            transform: translateY(-1px);
        }

        .whatsapp-btn {
            background-color: #25D366;
            box-shadow: 0 4px 12px rgba(37, 211, 102, 0.4);
        }

        .whatsapp-btn:hover {
            background-color: #20BA5A;
            box-shadow: 0 6px 16px rgba(37, 211, 102, 0.5);
        }

        @media (max-width: 768px) {
            .floating-buttons {
                bottom: 20px;
                right: 20px;
            }
            
            .floating-btn {
                width: 50px;
                height: 50px;
                font-size: 20px;
            }
        }
    </style>

    {{-- Custom JS --}}
    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        // Scroll to Top functionality
        $(document).ready(function() {
            const scrollBtn = $('#scroll-to-top');
            
            // Show/Hide button on scroll
            $(window).scroll(function() {
                if ($(this).scrollTop() > 300) {
                    scrollBtn.fadeIn();
                } else {
                    scrollBtn.fadeOut();
                }
            });
            
            // Scroll to top on click
            scrollBtn.click(function() {
                $('html, body').animate({ scrollTop: 0 }, 600);
                return false;
            });
        });
    </script>

    @stack('scripts')

    {{-- Structured Data (Schema.org) --}}
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "TravelAgency",
      "name": "KENDEA",
      "description": "Réservation d'activités à Dubaï",
      "url": "{{ url('/') }}",
      "address": {
        "@@type": "PostalAddress",
        "addressCountry": "AE",
        "addressRegion": "Dubai"
      },
      "priceRange": "50-600 AED"
    }
    </script>
</body>
</html>
