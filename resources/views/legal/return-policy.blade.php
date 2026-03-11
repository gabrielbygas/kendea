{{-- Modified by Claude --}}
@extends('layouts.app')

@section('title', __('Politique de Retour') . ' - KENDEA')

@section('content')
<div class="page-header py-5" style="background: linear-gradient(135deg, #FF6A00 0%, #E55F00 100%);">
    <div class="container text-center text-white">
        <h1 class="display-4 fw-bold" style="color: white !important;">
            {{ app()->getLocale() === 'en' ? 'Return and Refund Policy' : 'Politique de Retour et Remboursement' }}
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
                    <h2 class="h3 mb-3">1. Overview</h2>
                    <p class="text-muted">At KENDEA Travel, we strive to provide excellent service and memorable experiences. This Return and Refund Policy outlines the conditions under which cancellations, refunds, and modifications are handled for activity bookings in Dubai and the UAE.</p>
                    <p class="text-muted mt-3"><strong>Important:</strong> This policy is subject to the specific terms and conditions of individual activity providers. Always review the specific cancellation policy for your booked activity in your confirmation email.</p>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">2. Cancellation Policy</h2>
                    <h3 class="h5 mb-3">2.1 Standard Cancellation Terms</h3>
                    <p class="text-muted">Cancellation fees and refund eligibility depend on the timing of your cancellation request:</p>
                    
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Cancellation Timing</th>
                                    <th>Refund Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>More than 7 days before activity</td>
                                    <td>90% refund (10% administrative fee)</td>
                                </tr>
                                <tr>
                                    <td>4-7 days before activity</td>
                                    <td>50% refund</td>
                                </tr>
                                <tr>
                                    <td>2-3 days before activity</td>
                                    <td>25% refund</td>
                                </tr>
                                <tr>
                                    <td>Less than 48 hours before activity</td>
                                    <td>No refund</td>
                                </tr>
                                <tr>
                                    <td>No-show (did not attend)</td>
                                    <td>No refund</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <h3 class="h5 mb-3 mt-4">2.2 How to Cancel</h3>
                    <p class="text-muted">To request a cancellation:</p>
                    <ol class="text-muted">
                        <li>Contact us via email at <a href="mailto:admin@kendeatravel.com">admin@kendeatravel.com</a> or WhatsApp at <a href="https://wa.me/971582032582" target="_blank">+971 582032582</a></li>
                        <li>Include your booking reference number</li>
                        <li>Specify which activities you wish to cancel</li>
                        <li>Provide a reason for cancellation (optional but helpful)</li>
                    </ol>
                    <p class="text-muted mt-3">Cancellation requests are processed during business hours (9 AM - 6 PM UAE time, Sunday to Friday). Requests received outside these hours will be processed on the next business day.</p>

                    <h3 class="h5 mb-3 mt-4">2.3 Non-Refundable Activities</h3>
                    <p class="text-muted">Certain activities and special offers may be designated as non-refundable at the time of booking. These will be clearly marked as "Non-Refundable" in:</p>
                    <ul class="text-muted">
                        <li>Activity description on our website</li>
                        <li>Booking confirmation email</li>
                        <li>WhatsApp booking details</li>
                    </ul>
                    <p class="text-muted mt-3">Non-refundable bookings cannot be cancelled for a refund under any circumstances, though rescheduling may be available (see section 4).</p>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">3. Refund Process</h2>
                    <h3 class="h5 mb-3">3.1 Refund Timeline</h3>
                    <ul class="text-muted">
                        <li>Refund requests are reviewed within 3-5 business days</li>
                        <li>Approved refunds are processed within 10-14 business days</li>
                        <li>Refunds are issued to the original payment method</li>
                        <li>Bank processing may add 3-7 additional business days</li>
                    </ul>

                    <h3 class="h5 mb-3 mt-4">3.2 Refund Method</h3>
                    <p class="text-muted">Refunds will be processed using the same payment method used for the original booking. If the original payment method is no longer available, alternative arrangements will be discussed.</p>

                    <h3 class="h5 mb-3 mt-4">3.3 Partial Refunds</h3>
                    <p class="text-muted">If you have booked multiple activities and wish to cancel only some of them, partial refunds will be calculated individually for each cancelled activity based on its specific cancellation terms.</p>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">4. Modifications and Rescheduling</h2>
                    <h3 class="h5 mb-3">4.1 Date or Time Changes</h3>
                    <p class="text-muted">Requests to change your booking date or time:</p>
                    <ul class="text-muted">
                        <li>Must be made at least 48 hours in advance</li>
                        <li>Are subject to availability</li>
                        <li>May incur a modification fee (typically 10-20% of booking value)</li>
                        <li>Can be made once per booking without additional fees if requested more than 7 days in advance</li>
                    </ul>

                    <h3 class="h5 mb-3 mt-4">4.2 Participant Number Changes</h3>
                    <ul class="text-muted">
                        <li><strong>Increasing participants:</strong> Pay the difference for additional participants (subject to availability)</li>
                        <li><strong>Decreasing participants:</strong> Must be done at least 72 hours in advance; partial refunds based on cancellation policy</li>
                    </ul>

                    <h3 class="h5 mb-3 mt-4">4.3 Activity Substitution</h3>
                    <p class="text-muted">In some cases, you may be able to substitute one activity for another of equal or greater value, subject to availability and approval. Price differences and modification fees may apply.</p>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">5. Cancellations by KENDEA or Activity Provider</h2>
                    <h3 class="h5 mb-3">5.1 Due to Weather or Safety</h3>
                    <p class="text-muted">If an activity is cancelled due to weather conditions or safety concerns:</p>
                    <ul class="text-muted">
                        <li>You will be notified as soon as possible</li>
                        <li>Full refund OR free rescheduling to another date</li>
                        <li>No cancellation fees apply</li>
                    </ul>

                    <h3 class="h5 mb-3 mt-4">5.2 Due to Insufficient Participants</h3>
                    <p class="text-muted">Some activities require a minimum number of participants. If this minimum is not met:</p>
                    <ul class="text-muted">
                        <li>You will be notified at least 24 hours before the activity</li>
                        <li>Full refund OR option to reschedule</li>
                        <li>Alternative activity options may be offered</li>
                    </ul>

                    <h3 class="h5 mb-3 mt-4">5.3 Due to Operational Issues</h3>
                    <p class="text-muted">In the rare event of operational issues, equipment failure, or force majeure:</p>
                    <ul class="text-muted">
                        <li>Full refund will be provided</li>
                        <li>OR free rescheduling to a mutually agreed date</li>
                        <li>No additional compensation is provided</li>
                    </ul>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">6. No-Show Policy</h2>
                    <p class="text-muted">If you do not show up for your scheduled activity without prior cancellation:</p>
                    <ul class="text-muted">
                        <li>No refund will be provided</li>
                        <li>No rescheduling options available</li>
                        <li>Full payment is forfeited</li>
                    </ul>
                    <p class="text-muted mt-3"><strong>Important:</strong> If you anticipate being late or unable to attend, contact us immediately. We may be able to accommodate late arrivals or arrange alternatives, depending on the circumstances and activity type.</p>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">7. Vouchers and Gift Certificates</h2>
                    <ul class="text-muted">
                        <li>Vouchers and gift certificates are typically non-refundable</li>
                        <li>They may be transferable to another person</li>
                        <li>Expiration dates cannot usually be extended</li>
                        <li>Contact us for specific terms related to your voucher</li>
                    </ul>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">8. Special Circumstances</h2>
                    <h3 class="h5 mb-3">8.1 Medical Emergencies</h3>
                    <p class="text-muted">If you cannot attend due to a medical emergency:</p>
                    <ul class="text-muted">
                        <li>Contact us as soon as possible</li>
                        <li>Provide medical documentation (doctor's note or hospital certificate)</li>
                        <li>We will review your case individually</li>
                        <li>Partial or full refunds may be granted at our discretion</li>
                    </ul>

                    <h3 class="h5 mb-3 mt-4">8.2 Travel Restrictions or Visa Issues</h3>
                    <p class="text-muted">If you are unable to travel to the UAE due to visa denial or travel restrictions:</p>
                    <ul class="text-muted">
                        <li>Provide official documentation (visa denial letter, travel restriction notice)</li>
                        <li>Standard cancellation fees apply, but may be waived depending on timing</li>
                        <li>Each case reviewed individually</li>
                    </ul>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">9. Group Bookings</h2>
                    <p class="text-muted">Group bookings (10+ participants) may have different cancellation and refund terms:</p>
                    <ul class="text-muted">
                        <li>Custom policies negotiated at time of booking</li>
                        <li>Typically require longer advance notice for cancellations</li>
                        <li>May have non-refundable deposits</li>
                        <li>Specific terms outlined in group booking agreement</li>
                    </ul>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">10. Disputes and Complaints</h2>
                    <p class="text-muted">If you are dissatisfied with a service or believe you are entitled to a refund:</p>
                    <ol class="text-muted">
                        <li>Contact us within 48 hours of the activity</li>
                        <li>Provide your booking reference and detailed explanation</li>
                        <li>Include any supporting evidence (photos, videos, witness statements)</li>
                        <li>We will investigate and respond within 7 business days</li>
                    </ol>
                    <p class="text-muted mt-3">Refunds for service quality issues are evaluated case-by-case and may require verification with the activity provider.</p>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">11. Travel Insurance Recommendation</h2>
                    <p class="text-muted">We strongly recommend purchasing travel insurance that covers:</p>
                    <ul class="text-muted">
                        <li>Trip cancellation for any reason</li>
                        <li>Medical emergencies</li>
                        <li>Travel delays or interruptions</li>
                        <li>Activity participation coverage</li>
                    </ul>
                    <p class="text-muted mt-3">Travel insurance can provide more comprehensive protection than our cancellation policy alone.</p>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">12. Contact Information</h2>
                    <p class="text-muted">For cancellations, refunds, or questions about this policy:</p>
                    <ul class="list-unstyled text-muted">
                        <li><i class="bi bi-envelope me-2"></i><strong>Email:</strong> <a href="mailto:admin@kendeatravel.com">admin@kendeatravel.com</a></li>
                        <li><i class="bi bi-whatsapp me-2"></i><strong>WhatsApp:</strong> <a href="https://wa.me/971582032582" target="_blank">+971 582032582</a></li>
                        <li><i class="bi bi-clock me-2"></i><strong>Business Hours:</strong> Sunday - Friday, 9:00 AM - 6:00 PM (UAE Time)</li>
                        <li><i class="bi bi-envelope me-2"></i><strong>Contact Form:</strong> <a href="{{ route('contact') }}">Contact Page</a></li>
                    </ul>
                </section>

            @else
                {{-- French Version --}}
                <section class="mb-5">
                    <h2 class="h3 mb-3">1. Aperçu</h2>
                    <p class="text-muted">Chez KENDEA Travel, nous nous efforçons de fournir un excellent service et des expériences mémorables. Cette Politique de Retour et Remboursement décrit les conditions dans lesquelles les annulations, remboursements et modifications sont traités pour les réservations d'activités à Dubaï et aux EAU.</p>
                    <p class="text-muted mt-3"><strong>Important :</strong> Cette politique est soumise aux termes et conditions spécifiques des fournisseurs d'activités individuels. Consultez toujours la politique d'annulation spécifique de votre activité réservée dans votre e-mail de confirmation.</p>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">2. Politique d'Annulation</h2>
                    <h3 class="h5 mb-3">2.1 Conditions d'Annulation Standard</h3>
                    <p class="text-muted">Les frais d'annulation et l'éligibilité au remboursement dépendent du moment de votre demande d'annulation :</p>
                    
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Moment de l'Annulation</th>
                                    <th>Montant du Remboursement</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Plus de 7 jours avant l'activité</td>
                                    <td>90% de remboursement (10% de frais administratifs)</td>
                                </tr>
                                <tr>
                                    <td>4-7 jours avant l'activité</td>
                                    <td>50% de remboursement</td>
                                </tr>
                                <tr>
                                    <td>2-3 jours avant l'activité</td>
                                    <td>25% de remboursement</td>
                                </tr>
                                <tr>
                                    <td>Moins de 48 heures avant l'activité</td>
                                    <td>Aucun remboursement</td>
                                </tr>
                                <tr>
                                    <td>Absence (non présent)</td>
                                    <td>Aucun remboursement</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <h3 class="h5 mb-3 mt-4">2.2 Comment Annuler</h3>
                    <p class="text-muted">Pour demander une annulation :</p>
                    <ol class="text-muted">
                        <li>Contactez-nous par e-mail à <a href="mailto:admin@kendeatravel.com">admin@kendeatravel.com</a> ou WhatsApp au <a href="https://wa.me/971582032582" target="_blank">+971 582032582</a></li>
                        <li>Incluez votre numéro de référence de réservation</li>
                        <li>Spécifiez les activités que vous souhaitez annuler</li>
                        <li>Fournissez une raison d'annulation (facultatif mais utile)</li>
                    </ol>
                    <p class="text-muted mt-3">Les demandes d'annulation sont traitées pendant les heures d'ouverture (9h - 18h heure des EAU, dimanche à vendredi). Les demandes reçues en dehors de ces heures seront traitées le prochain jour ouvrable.</p>

                    <h3 class="h5 mb-3 mt-4">2.3 Activités Non Remboursables</h3>
                    <p class="text-muted">Certaines activités et offres spéciales peuvent être désignées comme non remboursables au moment de la réservation. Elles seront clairement marquées comme « Non Remboursable » dans :</p>
                    <ul class="text-muted">
                        <li>Description de l'activité sur notre site web</li>
                        <li>E-mail de confirmation de réservation</li>
                        <li>Détails de réservation WhatsApp</li>
                    </ul>
                    <p class="text-muted mt-3">Les réservations non remboursables ne peuvent pas être annulées pour un remboursement dans aucune circonstance, bien que la reprogrammation puisse être disponible (voir section 4).</p>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">3. Processus de Remboursement</h2>
                    <h3 class="h5 mb-3">3.1 Délai de Remboursement</h3>
                    <ul class="text-muted">
                        <li>Les demandes de remboursement sont examinées dans les 3-5 jours ouvrables</li>
                        <li>Les remboursements approuvés sont traités dans les 10-14 jours ouvrables</li>
                        <li>Les remboursements sont émis vers le mode de paiement d'origine</li>
                        <li>Le traitement bancaire peut ajouter 3-7 jours ouvrables supplémentaires</li>
                    </ul>

                    <h3 class="h5 mb-3 mt-4">3.2 Méthode de Remboursement</h3>
                    <p class="text-muted">Les remboursements seront traités en utilisant le même mode de paiement utilisé pour la réservation d'origine. Si le mode de paiement d'origine n'est plus disponible, des arrangements alternatifs seront discutés.</p>

                    <h3 class="h5 mb-3 mt-4">3.3 Remboursements Partiels</h3>
                    <p class="text-muted">Si vous avez réservé plusieurs activités et souhaitez en annuler seulement certaines, les remboursements partiels seront calculés individuellement pour chaque activité annulée en fonction de ses conditions d'annulation spécifiques.</p>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">4. Modifications et Reprogrammation</h2>
                    <h3 class="h5 mb-3">4.1 Changements de Date ou d'Heure</h3>
                    <p class="text-muted">Les demandes de modification de la date ou de l'heure de votre réservation :</p>
                    <ul class="text-muted">
                        <li>Doivent être faites au moins 48 heures à l'avance</li>
                        <li>Sont soumises à disponibilité</li>
                        <li>Peuvent entraîner des frais de modification (généralement 10-20% de la valeur de réservation)</li>
                        <li>Peuvent être faites une fois par réservation sans frais supplémentaires si demandées plus de 7 jours à l'avance</li>
                    </ul>

                    <h3 class="h5 mb-3 mt-4">4.2 Changements de Nombre de Participants</h3>
                    <ul class="text-muted">
                        <li><strong>Augmentation des participants :</strong> Payez la différence pour les participants supplémentaires (sous réserve de disponibilité)</li>
                        <li><strong>Diminution des participants :</strong> Doit être faite au moins 72 heures à l'avance ; remboursements partiels basés sur la politique d'annulation</li>
                    </ul>

                    <h3 class="h5 mb-3 mt-4">4.3 Substitution d'Activité</h3>
                    <p class="text-muted">Dans certains cas, vous pouvez substituer une activité pour une autre de valeur égale ou supérieure, sous réserve de disponibilité et d'approbation. Des différences de prix et des frais de modification peuvent s'appliquer.</p>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">5. Annulations par KENDEA ou le Fournisseur d'Activité</h2>
                    <h3 class="h5 mb-3">5.1 En raison de la Météo ou de la Sécurité</h3>
                    <p class="text-muted">Si une activité est annulée en raison de conditions météorologiques ou de préoccupations de sécurité :</p>
                    <ul class="text-muted">
                        <li>Vous serez notifié dès que possible</li>
                        <li>Remboursement complet OU reprogrammation gratuite à une autre date</li>
                        <li>Aucun frais d'annulation ne s'applique</li>
                    </ul>

                    <h3 class="h5 mb-3 mt-4">5.2 En raison d'un Nombre Insuffisant de Participants</h3>
                    <p class="text-muted">Certaines activités nécessitent un nombre minimum de participants. Si ce minimum n'est pas atteint :</p>
                    <ul class="text-muted">
                        <li>Vous serez notifié au moins 24 heures avant l'activité</li>
                        <li>Remboursement complet OU option de reprogrammation</li>
                        <li>Des options d'activités alternatives peuvent être proposées</li>
                    </ul>

                    <h3 class="h5 mb-3 mt-4">5.3 En raison de Problèmes Opérationnels</h3>
                    <p class="text-muted">Dans le cas rare de problèmes opérationnels, de panne d'équipement ou de force majeure :</p>
                    <ul class="text-muted">
                        <li>Un remboursement complet sera fourni</li>
                        <li>OU reprogrammation gratuite à une date convenue mutuellement</li>
                        <li>Aucune compensation supplémentaire n'est fournie</li>
                    </ul>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">6. Politique d'Absence</h2>
                    <p class="text-muted">Si vous ne vous présentez pas à votre activité programmée sans annulation préalable :</p>
                    <ul class="text-muted">
                        <li>Aucun remboursement ne sera fourni</li>
                        <li>Aucune option de reprogrammation disponible</li>
                        <li>Le paiement complet est perdu</li>
                    </ul>
                    <p class="text-muted mt-3"><strong>Important :</strong> Si vous prévoyez d'être en retard ou incapable d'assister, contactez-nous immédiatement. Nous pourrons peut-être accommoder les arrivées tardives ou arranger des alternatives, selon les circonstances et le type d'activité.</p>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">7. Bons et Certificats-Cadeaux</h2>
                    <ul class="text-muted">
                        <li>Les bons et certificats-cadeaux sont généralement non remboursables</li>
                        <li>Ils peuvent être transférables à une autre personne</li>
                        <li>Les dates d'expiration ne peuvent généralement pas être prolongées</li>
                        <li>Contactez-nous pour les conditions spécifiques liées à votre bon</li>
                    </ul>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">8. Circonstances Spéciales</h2>
                    <h3 class="h5 mb-3">8.1 Urgences Médicales</h3>
                    <p class="text-muted">Si vous ne pouvez pas assister en raison d'une urgence médicale :</p>
                    <ul class="text-muted">
                        <li>Contactez-nous dès que possible</li>
                        <li>Fournissez une documentation médicale (certificat médical ou certificat d'hôpital)</li>
                        <li>Nous examinerons votre cas individuellement</li>
                        <li>Des remboursements partiels ou complets peuvent être accordés à notre discrétion</li>
                    </ul>

                    <h3 class="h5 mb-3 mt-4">8.2 Restrictions de Voyage ou Problèmes de Visa</h3>
                    <p class="text-muted">Si vous ne pouvez pas voyager aux EAU en raison d'un refus de visa ou de restrictions de voyage :</p>
                    <ul class="text-muted">
                        <li>Fournissez une documentation officielle (lettre de refus de visa, avis de restriction de voyage)</li>
                        <li>Les frais d'annulation standard s'appliquent, mais peuvent être annulés selon le moment</li>
                        <li>Chaque cas examiné individuellement</li>
                    </ul>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">9. Réservations de Groupe</h2>
                    <p class="text-muted">Les réservations de groupe (10+ participants) peuvent avoir des conditions d'annulation et de remboursement différentes :</p>
                    <ul class="text-muted">
                        <li>Politiques personnalisées négociées au moment de la réservation</li>
                        <li>Nécessitent généralement un préavis plus long pour les annulations</li>
                        <li>Peuvent avoir des acomptes non remboursables</li>
                        <li>Conditions spécifiques décrites dans l'accord de réservation de groupe</li>
                    </ul>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">10. Litiges et Réclamations</h2>
                    <p class="text-muted">Si vous êtes insatisfait d'un service ou croyez avoir droit à un remboursement :</p>
                    <ol class="text-muted">
                        <li>Contactez-nous dans les 48 heures suivant l'activité</li>
                        <li>Fournissez votre référence de réservation et une explication détaillée</li>
                        <li>Incluez toute preuve justificative (photos, vidéos, témoignages)</li>
                        <li>Nous enquêterons et répondrons dans les 7 jours ouvrables</li>
                    </ol>
                    <p class="text-muted mt-3">Les remboursements pour des problèmes de qualité de service sont évalués au cas par cas et peuvent nécessiter une vérification avec le fournisseur d'activité.</p>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">11. Recommandation d'Assurance Voyage</h2>
                    <p class="text-muted">Nous recommandons fortement de souscrire une assurance voyage couvrant :</p>
                    <ul class="text-muted">
                        <li>Annulation de voyage pour toute raison</li>
                        <li>Urgences médicales</li>
                        <li>Retards ou interruptions de voyage</li>
                        <li>Couverture de participation aux activités</li>
                    </ul>
                    <p class="text-muted mt-3">L'assurance voyage peut fournir une protection plus complète que notre politique d'annulation seule.</p>
                </section>

                <section class="mb-5">
                    <h2 class="h3 mb-3">12. Coordonnées</h2>
                    <p class="text-muted">Pour les annulations, remboursements ou questions sur cette politique :</p>
                    <ul class="list-unstyled text-muted">
                        <li><i class="bi bi-envelope me-2"></i><strong>E-mail :</strong> <a href="mailto:admin@kendeatravel.com">admin@kendeatravel.com</a></li>
                        <li><i class="bi bi-whatsapp me-2"></i><strong>WhatsApp :</strong> <a href="https://wa.me/971582032582" target="_blank">+971 582032582</a></li>
                        <li><i class="bi bi-clock me-2"></i><strong>Heures d'Ouverture :</strong> Dimanche - Vendredi, 9h00 - 18h00 (Heure des EAU)</li>
                        <li><i class="bi bi-envelope me-2"></i><strong>Formulaire de Contact :</strong> <a href="{{ route('contact') }}">Page de Contact</a></li>
                    </ul>
                </section>
            @endif
        </div>
    </div>
</div>
@endsection
