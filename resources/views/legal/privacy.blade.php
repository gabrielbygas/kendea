{{-- Modified by Claude --}}
@extends('layouts.app')

@section('title', __('Politique de Confidentialité') . ' - KENDEA')

@section('content')
<div class="page-header py-5" style="background: linear-gradient(135deg, #FF6A00 0%, #E55F00 100%);">
    <div class="container text-center text-white">
        <h1 class="display-4 fw-bold" style="color: white !important;">
            {{ app()->getLocale() === 'en' ? 'Privacy Policy' : 'Politique de Confidentialité' }}
        </h1>
        <p class="lead">{{ app()->getLocale() === 'en' ? 'Last updated: March 2026' : 'Dernière mise à jour : Mars 2026' }}</p>
    </div>
</div>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-10 mx-auto">
            @if(app()->getLocale() === 'en')
                {{-- English Version --}}
                <section class="mb-5">
                    <h2 class="h3 mb-3">1. Introduction</h2>
                    <p class="text-muted">KENDEA Travel ("we", "our", or "us") is committed to protecting your privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you use our website and services for booking Dubai and UAE activities.</p>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">2. Information We Collect</h2>
                    <h3 class="h5 mb-3">2.1 Personal Information</h3>
                    <p class="text-muted">When you make a booking or contact us, we may collect:</p>
                    <ul class="text-muted">
                        <li>Full name (first and last name)</li>
                        <li>Email address</li>
                        <li>Phone number</li>
                        <li>Preferred booking date and time</li>
                        <li>Special requests or messages</li>
                    </ul>

                    <h3 class="h5 mb-3 mt-4">2.2 Technical Information</h3>
                    <p class="text-muted">We automatically collect certain information when you visit our website:</p>
                    <ul class="text-muted">
                        <li>IP address</li>
                        <li>Browser type and version</li>
                        <li>Device information</li>
                        <li>Pages visited and time spent</li>
                        <li>Language preferences</li>
                    </ul>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">3. How We Use Your Information</h2>
                    <p class="text-muted">We use the collected information to:</p>
                    <ul class="text-muted">
                        <li>Process your booking requests and reservations</li>
                        <li>Send booking confirmations via email</li>
                        <li>Communicate with you about your reservations</li>
                        <li>Provide customer support through WhatsApp and email</li>
                        <li>Improve our services and website functionality</li>
                        <li>Comply with legal obligations</li>
                        <li>Prevent fraud and enhance security</li>
                    </ul>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">4. Information Sharing and Disclosure</h2>
                    <p class="text-muted">We do not sell or rent your personal information. We may share your information with:</p>
                    <ul class="text-muted">
                        <li><strong>Activity Providers:</strong> To confirm and process your bookings</li>
                        <li><strong>Payment Processors:</strong> To complete transactions securely</li>
                        <li><strong>Legal Authorities:</strong> When required by law or to protect our rights</li>
                        <li><strong>Service Providers:</strong> Third parties who assist us in operating our business (under strict confidentiality agreements)</li>
                    </ul>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">5. Data Storage and Security</h2>
                    <p class="text-muted">We implement appropriate technical and organizational measures to protect your personal information:</p>
                    <ul class="text-muted">
                        <li>Secure session-based cart system</li>
                        <li>CSRF protection on all forms</li>
                        <li>Encrypted data transmission (SSL/HTTPS)</li>
                        <li>Regular security updates and monitoring</li>
                        <li>Restricted access to personal data</li>
                    </ul>
                    <p class="text-muted mt-3">Your data is stored on secure servers and retained only as long as necessary for the purposes outlined in this policy.</p>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">6. Cookies and Tracking</h2>
                    <p class="text-muted">We use session cookies to:</p>
                    <ul class="text-muted">
                        <li>Maintain your shopping cart</li>
                        <li>Remember your language preference</li>
                        <li>Improve website performance</li>
                        <li>Analyze website usage patterns</li>
                    </ul>
                    <p class="text-muted mt-3">You can control cookies through your browser settings. Note that disabling cookies may affect website functionality.</p>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">7. Your Rights</h2>
                    <p class="text-muted">You have the right to:</p>
                    <ul class="text-muted">
                        <li><strong>Access:</strong> Request a copy of your personal data</li>
                        <li><strong>Correction:</strong> Request correction of inaccurate data</li>
                        <li><strong>Deletion:</strong> Request deletion of your data (subject to legal requirements)</li>
                        <li><strong>Object:</strong> Object to certain data processing activities</li>
                        <li><strong>Withdraw Consent:</strong> Withdraw consent for data processing at any time</li>
                    </ul>
                    <p class="text-muted mt-3">To exercise these rights, contact us at: <a href="mailto:admin@kendeatravel.com">admin@kendeatravel.com</a></p>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">8. Third-Party Links</h2>
                    <p class="text-muted">Our website may contain links to third-party websites (e.g., WhatsApp, social media). We are not responsible for the privacy practices of these external sites. Please review their privacy policies before providing any personal information.</p>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">9. Children's Privacy</h2>
                    <p class="text-muted">Our services are not directed to children under 16 years of age. We do not knowingly collect personal information from children. If we become aware of such collection, we will take steps to delete it immediately.</p>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">10. Changes to This Policy</h2>
                    <p class="text-muted">We may update this Privacy Policy periodically. Changes will be posted on this page with an updated revision date. Continued use of our services after changes constitutes acceptance of the updated policy.</p>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">11. Contact Us</h2>
                    <p class="text-muted">If you have questions or concerns about this Privacy Policy, please contact us:</p>
                    <ul class="list-unstyled text-muted">
                        <li><i class="bi bi-envelope me-2"></i><strong>Email:</strong> <a href="mailto:admin@kendeatravel.com">admin@kendeatravel.com</a></li>
                        <li><i class="bi bi-whatsapp me-2"></i><strong>WhatsApp:</strong> <a href="https://wa.me/971582032582" target="_blank">+971 582032582</a></li>
                        <li><i class="bi bi-envelope me-2"></i><strong>Contact Form:</strong> <a href="{{ route('contact') }}">Contact Page</a></li>
                    </ul>
                </section>

            @else
                {{-- French Version --}}
                <section class="mb-5">
                    <h2 class="h3 mb-3">1. Introduction</h2>
                    <p class="text-muted">KENDEA Travel (« nous », « notre » ou « nos ») s'engage à protéger votre vie privée. Cette Politique de Confidentialité explique comment nous collectons, utilisons, divulguons et protégeons vos informations lorsque vous utilisez notre site web et nos services de réservation d'activités à Dubaï et aux Émirats Arabes Unis.</p>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">2. Informations Que Nous Collectons</h2>
                    <h3 class="h5 mb-3">2.1 Informations Personnelles</h3>
                    <p class="text-muted">Lorsque vous effectuez une réservation ou nous contactez, nous pouvons collecter :</p>
                    <ul class="text-muted">
                        <li>Nom complet (prénom et nom)</li>
                        <li>Adresse e-mail</li>
                        <li>Numéro de téléphone</li>
                        <li>Date et heure de réservation préférées</li>
                        <li>Demandes spéciales ou messages</li>
                    </ul>

                    <h3 class="h5 mb-3 mt-4">2.2 Informations Techniques</h3>
                    <p class="text-muted">Nous collectons automatiquement certaines informations lors de votre visite sur notre site :</p>
                    <ul class="text-muted">
                        <li>Adresse IP</li>
                        <li>Type et version du navigateur</li>
                        <li>Informations sur l'appareil</li>
                        <li>Pages visitées et temps passé</li>
                        <li>Préférences linguistiques</li>
                    </ul>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">3. Comment Nous Utilisons Vos Informations</h2>
                    <p class="text-muted">Nous utilisons les informations collectées pour :</p>
                    <ul class="text-muted">
                        <li>Traiter vos demandes de réservation</li>
                        <li>Envoyer des confirmations de réservation par e-mail</li>
                        <li>Communiquer avec vous concernant vos réservations</li>
                        <li>Fournir un support client via WhatsApp et e-mail</li>
                        <li>Améliorer nos services et fonctionnalités du site</li>
                        <li>Respecter nos obligations légales</li>
                        <li>Prévenir la fraude et renforcer la sécurité</li>
                    </ul>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">4. Partage et Divulgation des Informations</h2>
                    <p class="text-muted">Nous ne vendons ni ne louons vos informations personnelles. Nous pouvons partager vos informations avec :</p>
                    <ul class="text-muted">
                        <li><strong>Fournisseurs d'Activités :</strong> Pour confirmer et traiter vos réservations</li>
                        <li><strong>Processeurs de Paiement :</strong> Pour effectuer les transactions en toute sécurité</li>
                        <li><strong>Autorités Légales :</strong> Lorsque requis par la loi ou pour protéger nos droits</li>
                        <li><strong>Prestataires de Services :</strong> Tiers qui nous aident à gérer notre entreprise (sous accords de confidentialité stricts)</li>
                    </ul>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">5. Stockage et Sécurité des Données</h2>
                    <p class="text-muted">Nous mettons en œuvre des mesures techniques et organisationnelles appropriées pour protéger vos informations personnelles :</p>
                    <ul class="text-muted">
                        <li>Système de panier basé sur des sessions sécurisées</li>
                        <li>Protection CSRF sur tous les formulaires</li>
                        <li>Transmission de données cryptée (SSL/HTTPS)</li>
                        <li>Mises à jour de sécurité et surveillance régulières</li>
                        <li>Accès restreint aux données personnelles</li>
                    </ul>
                    <p class="text-muted mt-3">Vos données sont stockées sur des serveurs sécurisés et conservées uniquement le temps nécessaire aux fins décrites dans cette politique.</p>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">6. Cookies et Suivi</h2>
                    <p class="text-muted">Nous utilisons des cookies de session pour :</p>
                    <ul class="text-muted">
                        <li>Maintenir votre panier d'achat</li>
                        <li>Mémoriser votre préférence linguistique</li>
                        <li>Améliorer les performances du site</li>
                        <li>Analyser les modèles d'utilisation du site</li>
                    </ul>
                    <p class="text-muted mt-3">Vous pouvez contrôler les cookies via les paramètres de votre navigateur. Notez que la désactivation des cookies peut affecter la fonctionnalité du site.</p>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">7. Vos Droits</h2>
                    <p class="text-muted">Vous avez le droit de :</p>
                    <ul class="text-muted">
                        <li><strong>Accès :</strong> Demander une copie de vos données personnelles</li>
                        <li><strong>Correction :</strong> Demander la correction de données inexactes</li>
                        <li><strong>Suppression :</strong> Demander la suppression de vos données (sous réserve des exigences légales)</li>
                        <li><strong>Opposition :</strong> S'opposer à certaines activités de traitement des données</li>
                        <li><strong>Retrait du Consentement :</strong> Retirer votre consentement pour le traitement des données à tout moment</li>
                    </ul>
                    <p class="text-muted mt-3">Pour exercer ces droits, contactez-nous à : <a href="mailto:admin@kendeatravel.com">admin@kendeatravel.com</a></p>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">8. Liens Tiers</h2>
                    <p class="text-muted">Notre site peut contenir des liens vers des sites web tiers (par ex. WhatsApp, réseaux sociaux). Nous ne sommes pas responsables des pratiques de confidentialité de ces sites externes. Veuillez consulter leurs politiques de confidentialité avant de fournir des informations personnelles.</p>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">9. Confidentialité des Enfants</h2>
                    <p class="text-muted">Nos services ne sont pas destinés aux enfants de moins de 16 ans. Nous ne collectons pas sciemment d'informations personnelles auprès d'enfants. Si nous en prenons connaissance, nous prendrons immédiatement des mesures pour les supprimer.</p>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">10. Modifications de Cette Politique</h2>
                    <p class="text-muted">Nous pouvons mettre à jour cette Politique de Confidentialité périodiquement. Les modifications seront publiées sur cette page avec une date de révision mise à jour. L'utilisation continue de nos services après les modifications constitue l'acceptation de la politique mise à jour.</p>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">11. Nous Contacter</h2>
                    <p class="text-muted">Si vous avez des questions ou des préoccupations concernant cette Politique de Confidentialité, veuillez nous contacter :</p>
                    <ul class="list-unstyled text-muted">
                        <li><i class="bi bi-envelope me-2"></i><strong>E-mail :</strong> <a href="mailto:admin@kendeatravel.com">admin@kendeatravel.com</a></li>
                        <li><i class="bi bi-whatsapp me-2"></i><strong>WhatsApp :</strong> <a href="https://wa.me/971582032582" target="_blank">+971 582032582</a></li>
                        <li><i class="bi bi-envelope me-2"></i><strong>Formulaire de Contact :</strong> <a href="{{ route('contact') }}">Page de Contact</a></li>
                    </ul>
                </section>
            @endif
        </div>
    </div>
</div>
@endsection
