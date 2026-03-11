{{-- Modified by Claude --}}
@extends('layouts.app')

@section('title', __('Conditions Générales') . ' - KENDEA')

@section('content')
<div class="page-header py-5" style="background: linear-gradient(135deg, #FF6A00 0%, #E55F00 100%);">
    <div class="container text-center text-white">
        <h1 class="display-4 fw-bold" style="color: white !important;">
            {{ app()->getLocale() === 'en' ? 'Terms and Conditions' : 'Conditions Générales' }}
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
                    <h2 class="h3 mb-3">1. Agreement to Terms</h2>
                    <p class="text-muted">By accessing and using the KENDEA Travel website and services, you accept and agree to be bound by these Terms and Conditions. If you do not agree to these terms, please do not use our services.</p>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">2. Services Description</h2>
                    <p class="text-muted">KENDEA Travel provides an online platform for booking various activities and experiences in Dubai and the United Arab Emirates, including:</p>
                    <ul class="text-muted">
                        <li>Desert safaris and adventure activities</li>
                        <li>Water parks and aquatic experiences</li>
                        <li>City tours and cultural visits</li>
                        <li>Theme parks and entertainment venues</li>
                        <li>Adventure sports and outdoor activities</li>
                    </ul>
                    <p class="text-muted mt-3">We act as an intermediary between customers and activity providers. The actual services are provided by third-party vendors.</p>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">3. Booking and Reservations</h2>
                    <h3 class="h5 mb-3">3.1 Booking Process</h3>
                    <ul class="text-muted">
                        <li>All bookings must be made through our website or WhatsApp</li>
                        <li>You must provide accurate and complete information</li>
                        <li>Bookings are subject to availability</li>
                        <li>A confirmation email will be sent upon successful booking</li>
                        <li>WhatsApp confirmation provides additional booking details</li>
                    </ul>

                    <h3 class="h5 mb-3 mt-4">3.2 Booking Confirmation</h3>
                    <p class="text-muted">Your booking is confirmed only when you receive a confirmation email from us. The confirmation will include:</p>
                    <ul class="text-muted">
                        <li>Booking reference number</li>
                        <li>Activity details and date</li>
                        <li>Number of participants</li>
                        <li>Total price</li>
                        <li>Payment instructions (if applicable)</li>
                    </ul>

                    <h3 class="h5 mb-3 mt-4">3.3 Group Bookings</h3>
                    <p class="text-muted">Multiple activities can be booked simultaneously. Each activity in your cart can have a different number of participants. The total price will be calculated based on the number of participants per activity.</p>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">4. Pricing and Payment</h2>
                    <h3 class="h5 mb-3">4.1 Prices</h3>
                    <ul class="text-muted">
                        <li>All prices are displayed in UAE Dirhams (AED)</li>
                        <li>Prices are per person unless otherwise stated</li>
                        <li>Prices may vary based on season, demand, and availability</li>
                        <li>We reserve the right to modify prices without prior notice</li>
                        <li>Price at the time of booking confirmation is final</li>
                    </ul>

                    <h3 class="h5 mb-3 mt-4">4.2 Payment Methods</h3>
                    <p class="text-muted">Payment details and methods will be communicated via email or WhatsApp after booking confirmation. We accept various payment methods as communicated by our team.</p>

                    <h3 class="h5 mb-3 mt-4">4.3 Payment Terms</h3>
                    <ul class="text-muted">
                        <li>Payment must be made within the timeframe specified in your confirmation</li>
                        <li>Bookings may be cancelled if payment is not received by the deadline</li>
                        <li>Full payment is typically required before the activity date</li>
                    </ul>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">5. Cancellation and Modifications</h2>
                    <h3 class="h5 mb-3">5.1 By Customer</h3>
                    <ul class="text-muted">
                        <li>Cancellation requests must be made via email or WhatsApp</li>
                        <li>Cancellation policies vary by activity and provider</li>
                        <li>Cancellation fees may apply based on timing</li>
                        <li>Some activities may be non-refundable</li>
                        <li>Refunds (if applicable) will be processed within 14 business days</li>
                    </ul>

                    <h3 class="h5 mb-3 mt-4">5.2 By KENDEA or Provider</h3>
                    <p class="text-muted">We or the activity provider reserve the right to cancel bookings due to:</p>
                    <ul class="text-muted">
                        <li>Weather conditions or safety concerns</li>
                        <li>Insufficient participants</li>
                        <li>Operational issues or force majeure</li>
                        <li>Non-payment</li>
                    </ul>
                    <p class="text-muted mt-3">In case of cancellation by us, you will receive a full refund or the option to reschedule.</p>

                    <h3 class="h5 mb-3 mt-4">5.3 Modifications</h3>
                    <p class="text-muted">Requests to modify bookings (date, time, number of participants) must be made at least 48 hours in advance and are subject to availability. Modification fees may apply.</p>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">6. Customer Responsibilities</h2>
                    <p class="text-muted">As a customer, you agree to:</p>
                    <ul class="text-muted">
                        <li>Provide accurate contact and personal information</li>
                        <li>Arrive on time for scheduled activities</li>
                        <li>Follow safety instructions provided by activity operators</li>
                        <li>Meet any age, health, or physical requirements for activities</li>
                        <li>Respect local laws, customs, and regulations</li>
                        <li>Inform us of any special requirements or medical conditions</li>
                        <li>Behave responsibly and respectfully during activities</li>
                    </ul>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">7. Liability and Disclaimers</h2>
                    <h3 class="h5 mb-3">7.1 Limitation of Liability</h3>
                    <p class="text-muted">KENDEA Travel acts as an intermediary. We are not responsible for:</p>
                    <ul class="text-muted">
                        <li>The quality, safety, or legality of activities provided by third parties</li>
                        <li>Actions or omissions of activity providers</li>
                        <li>Personal injury, loss, or damage during activities</li>
                        <li>Changes made by activity providers</li>
                        <li>Weather-related disruptions</li>
                    </ul>

                    <h3 class="h5 mb-3 mt-4">7.2 Insurance</h3>
                    <p class="text-muted">We strongly recommend that customers obtain appropriate travel and activity insurance. KENDEA does not provide insurance coverage.</p>

                    <h3 class="h5 mb-3 mt-4">7.3 Force Majeure</h3>
                    <p class="text-muted">We are not liable for failure to perform obligations due to circumstances beyond our reasonable control, including natural disasters, pandemics, war, strikes, or government restrictions.</p>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">8. Age and Health Requirements</h2>
                    <ul class="text-muted">
                        <li>Minimum age requirements vary by activity</li>
                        <li>Children must be accompanied by an adult</li>
                        <li>Pregnant women should consult activity requirements</li>
                        <li>Participants with medical conditions must inform us in advance</li>
                        <li>Some activities have weight, height, or fitness restrictions</li>
                    </ul>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">9. Intellectual Property</h2>
                    <p class="text-muted">All content on the KENDEA website, including text, images, logos, and design, is protected by intellectual property rights. You may not reproduce, distribute, or use our content without written permission.</p>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">10. Privacy and Data Protection</h2>
                    <p class="text-muted">Your personal information is handled in accordance with our <a href="{{ route('privacy') }}">Privacy Policy</a>. By using our services, you consent to the collection and use of your information as described in the Privacy Policy.</p>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">11. Communication</h2>
                    <p class="text-muted">By providing your contact information, you agree to receive:</p>
                    <ul class="text-muted">
                        <li>Booking confirmations and updates</li>
                        <li>Important service-related communications</li>
                        <li>Customer support messages via WhatsApp or email</li>
                    </ul>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">12. Complaints and Disputes</h2>
                    <p class="text-muted">If you have any complaints or concerns:</p>
                    <ul class="text-muted">
                        <li>Contact us immediately via email or WhatsApp</li>
                        <li>Provide your booking reference and details</li>
                        <li>We will investigate and respond within 7 business days</li>
                    </ul>
                    <p class="text-muted mt-3">If a dispute cannot be resolved amicably, it will be subject to the jurisdiction of UAE courts.</p>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">13. Modifications to Terms</h2>
                    <p class="text-muted">We reserve the right to modify these Terms and Conditions at any time. Changes will be effective immediately upon posting. Your continued use of our services after changes constitutes acceptance of the modified terms.</p>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">14. Governing Law</h2>
                    <p class="text-muted">These Terms and Conditions are governed by and construed in accordance with the laws of the United Arab Emirates.</p>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">15. Contact Information</h2>
                    <p class="text-muted">For questions about these Terms and Conditions:</p>
                    <ul class="list-unstyled text-muted">
                        <li><i class="bi bi-envelope me-2"></i><strong>Email:</strong> <a href="mailto:admin@kendeatravel.com">admin@kendeatravel.com</a></li>
                        <li><i class="bi bi-whatsapp me-2"></i><strong>WhatsApp:</strong> <a href="https://wa.me/971582032582" target="_blank">+971 582032582</a></li>
                        <li><i class="bi bi-envelope me-2"></i><strong>Contact Form:</strong> <a href="{{ route('contact') }}">Contact Page</a></li>
                    </ul>
                </section>

            @else
                {{-- French Version --}}
                <section class="mb-5">
                    <h2 class="h3 mb-3">1. Acceptation des Conditions</h2>
                    <p class="text-muted">En accédant et en utilisant le site web et les services de KENDEA Travel, vous acceptez et vous engagez à respecter ces Conditions Générales. Si vous n'acceptez pas ces conditions, veuillez ne pas utiliser nos services.</p>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">2. Description des Services</h2>
                    <p class="text-muted">KENDEA Travel fournit une plateforme en ligne pour réserver diverses activités et expériences à Dubaï et aux Émirats Arabes Unis, notamment :</p>
                    <ul class="text-muted">
                        <li>Safaris dans le désert et activités d'aventure</li>
                        <li>Parcs aquatiques et expériences aquatiques</li>
                        <li>Visites de la ville et visites culturelles</li>
                        <li>Parcs à thème et lieux de divertissement</li>
                        <li>Sports d'aventure et activités de plein air</li>
                    </ul>
                    <p class="text-muted mt-3">Nous agissons en tant qu'intermédiaire entre les clients et les fournisseurs d'activités. Les services réels sont fournis par des fournisseurs tiers.</p>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">3. Réservation</h2>
                    <h3 class="h5 mb-3">3.1 Processus de Réservation</h3>
                    <ul class="text-muted">
                        <li>Toutes les réservations doivent être effectuées via notre site web ou WhatsApp</li>
                        <li>Vous devez fournir des informations exactes et complètes</li>
                        <li>Les réservations sont soumises à disponibilité</li>
                        <li>Un e-mail de confirmation sera envoyé après réservation réussie</li>
                        <li>La confirmation WhatsApp fournit des détails de réservation supplémentaires</li>
                    </ul>

                    <h3 class="h5 mb-3 mt-4">3.2 Confirmation de Réservation</h3>
                    <p class="text-muted">Votre réservation n'est confirmée que lorsque vous recevez un e-mail de confirmation de notre part. La confirmation comprendra :</p>
                    <ul class="text-muted">
                        <li>Numéro de référence de réservation</li>
                        <li>Détails de l'activité et date</li>
                        <li>Nombre de participants</li>
                        <li>Prix total</li>
                        <li>Instructions de paiement (le cas échéant)</li>
                    </ul>

                    <h3 class="h5 mb-3 mt-4">3.3 Réservations de Groupe</h3>
                    <p class="text-muted">Plusieurs activités peuvent être réservées simultanément. Chaque activité dans votre panier peut avoir un nombre différent de participants. Le prix total sera calculé en fonction du nombre de participants par activité.</p>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">4. Tarification et Paiement</h2>
                    <h3 class="h5 mb-3">4.1 Prix</h3>
                    <ul class="text-muted">
                        <li>Tous les prix sont affichés en Dirhams des Émirats Arabes Unis (AED)</li>
                        <li>Les prix sont par personne sauf indication contraire</li>
                        <li>Les prix peuvent varier en fonction de la saison, de la demande et de la disponibilité</li>
                        <li>Nous nous réservons le droit de modifier les prix sans préavis</li>
                        <li>Le prix au moment de la confirmation de réservation est final</li>
                    </ul>

                    <h3 class="h5 mb-3 mt-4">4.2 Modes de Paiement</h3>
                    <p class="text-muted">Les détails et modes de paiement seront communiqués par e-mail ou WhatsApp après confirmation de réservation. Nous acceptons divers modes de paiement tels que communiqués par notre équipe.</p>

                    <h3 class="h5 mb-3 mt-4">4.3 Conditions de Paiement</h3>
                    <ul class="text-muted">
                        <li>Le paiement doit être effectué dans le délai spécifié dans votre confirmation</li>
                        <li>Les réservations peuvent être annulées si le paiement n'est pas reçu avant la date limite</li>
                        <li>Le paiement intégral est généralement requis avant la date de l'activité</li>
                    </ul>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">5. Annulation et Modifications</h2>
                    <h3 class="h5 mb-3">5.1 Par le Client</h3>
                    <ul class="text-muted">
                        <li>Les demandes d'annulation doivent être faites par e-mail ou WhatsApp</li>
                        <li>Les politiques d'annulation varient selon l'activité et le fournisseur</li>
                        <li>Des frais d'annulation peuvent s'appliquer selon le moment</li>
                        <li>Certaines activités peuvent être non remboursables</li>
                        <li>Les remboursements (le cas échéant) seront traités dans les 14 jours ouvrables</li>
                    </ul>

                    <h3 class="h5 mb-3 mt-4">5.2 Par KENDEA ou le Fournisseur</h3>
                    <p class="text-muted">Nous ou le fournisseur d'activités nous réservons le droit d'annuler les réservations en raison de :</p>
                    <ul class="text-muted">
                        <li>Conditions météorologiques ou préoccupations de sécurité</li>
                        <li>Nombre insuffisant de participants</li>
                        <li>Problèmes opérationnels ou force majeure</li>
                        <li>Non-paiement</li>
                    </ul>
                    <p class="text-muted mt-3">En cas d'annulation de notre part, vous recevrez un remboursement complet ou l'option de reporter.</p>

                    <h3 class="h5 mb-3 mt-4">5.3 Modifications</h3>
                    <p class="text-muted">Les demandes de modification de réservations (date, heure, nombre de participants) doivent être faites au moins 48 heures à l'avance et sont soumises à disponibilité. Des frais de modification peuvent s'appliquer.</p>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">6. Responsabilités du Client</h2>
                    <p class="text-muted">En tant que client, vous acceptez de :</p>
                    <ul class="text-muted">
                        <li>Fournir des informations de contact et personnelles exactes</li>
                        <li>Arriver à l'heure pour les activités programmées</li>
                        <li>Suivre les instructions de sécurité fournies par les opérateurs d'activités</li>
                        <li>Respecter toute exigence d'âge, de santé ou physique pour les activités</li>
                        <li>Respecter les lois, coutumes et réglementations locales</li>
                        <li>Nous informer de toute exigence spéciale ou condition médicale</li>
                        <li>Vous comporter de manière responsable et respectueuse pendant les activités</li>
                    </ul>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">7. Responsabilité et Dénis de Responsabilité</h2>
                    <h3 class="h5 mb-3">7.1 Limitation de Responsabilité</h3>
                    <p class="text-muted">KENDEA Travel agit en tant qu'intermédiaire. Nous ne sommes pas responsables de :</p>
                    <ul class="text-muted">
                        <li>La qualité, la sécurité ou la légalité des activités fournies par des tiers</li>
                        <li>Les actions ou omissions des fournisseurs d'activités</li>
                        <li>Les blessures, pertes ou dommages personnels pendant les activités</li>
                        <li>Les changements effectués par les fournisseurs d'activités</li>
                        <li>Les perturbations liées aux conditions météorologiques</li>
                    </ul>

                    <h3 class="h5 mb-3 mt-4">7.2 Assurance</h3>
                    <p class="text-muted">Nous recommandons fortement aux clients de souscrire une assurance voyage et activité appropriée. KENDEA ne fournit pas de couverture d'assurance.</p>

                    <h3 class="h5 mb-3 mt-4">7.3 Force Majeure</h3>
                    <p class="text-muted">Nous ne sommes pas responsables de l'incapacité à exécuter nos obligations en raison de circonstances indépendantes de notre volonté raisonnable, y compris les catastrophes naturelles, les pandémies, la guerre, les grèves ou les restrictions gouvernementales.</p>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">8. Exigences d'Âge et de Santé</h2>
                    <ul class="text-muted">
                        <li>Les exigences d'âge minimum varient selon l'activité</li>
                        <li>Les enfants doivent être accompagnés d'un adulte</li>
                        <li>Les femmes enceintes doivent consulter les exigences de l'activité</li>
                        <li>Les participants ayant des problèmes médicaux doivent nous en informer à l'avance</li>
                        <li>Certaines activités ont des restrictions de poids, de taille ou de condition physique</li>
                    </ul>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">9. Propriété Intellectuelle</h2>
                    <p class="text-muted">Tout le contenu du site web KENDEA, y compris les textes, images, logos et design, est protégé par des droits de propriété intellectuelle. Vous ne pouvez pas reproduire, distribuer ou utiliser notre contenu sans autorisation écrite.</p>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">10. Confidentialité et Protection des Données</h2>
                    <p class="text-muted">Vos informations personnelles sont traitées conformément à notre <a href="{{ route('privacy') }}">Politique de Confidentialité</a>. En utilisant nos services, vous consentez à la collecte et à l'utilisation de vos informations comme décrit dans la Politique de Confidentialité.</p>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">11. Communication</h2>
                    <p class="text-muted">En fournissant vos coordonnées, vous acceptez de recevoir :</p>
                    <ul class="text-muted">
                        <li>Confirmations de réservation et mises à jour</li>
                        <li>Communications importantes liées au service</li>
                        <li>Messages d'assistance client via WhatsApp ou e-mail</li>
                    </ul>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">12. Réclamations et Litiges</h2>
                    <p class="text-muted">Si vous avez des réclamations ou préoccupations :</p>
                    <ul class="text-muted">
                        <li>Contactez-nous immédiatement par e-mail ou WhatsApp</li>
                        <li>Fournissez votre référence de réservation et détails</li>
                        <li>Nous enquêterons et répondrons dans les 7 jours ouvrables</li>
                    </ul>
                    <p class="text-muted mt-3">Si un litige ne peut être résolu à l'amiable, il sera soumis à la juridiction des tribunaux des EAU.</p>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">13. Modifications des Conditions</h2>
                    <p class="text-muted">Nous nous réservons le droit de modifier ces Conditions Générales à tout moment. Les modifications entreront en vigueur immédiatement après publication. Votre utilisation continue de nos services après les modifications constitue l'acceptation des conditions modifiées.</p>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">14. Loi Applicable</h2>
                    <p class="text-muted">Ces Conditions Générales sont régies et interprétées conformément aux lois des Émirats Arabes Unis.</p>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">15. Coordonnées</h2>
                    <p class="text-muted">Pour toute question concernant ces Conditions Générales :</p>
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
