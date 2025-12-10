{{-- Modified by Claude --}}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de réservation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #ff6b35;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f9f9f9;
            padding: 20px;
            border: 1px solid #ddd;
        }
        .activity-item {
            background-color: white;
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
            border-left: 4px solid #ff6b35;
        }
        .activity-name {
            font-weight: bold;
            color: #ff6b35;
            font-size: 16px;
        }
        .activity-price {
            color: #666;
            margin-top: 5px;
        }
        .total {
            background-color: #ff6b35;
            color: white;
            padding: 15px;
            margin-top: 20px;
            border-radius: 5px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
        }
        .footer {
            margin-top: 20px;
            padding: 20px;
            background-color: #333;
            color: white;
            text-align: center;
            border-radius: 0 0 5px 5px;
        }
        .info-box {
            background-color: #e8f4f8;
            border-left: 4px solid #2196F3;
            padding: 15px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🎉 Confirmation de réservation</h1>
        <p>Dubai Activities</p>
    </div>

    <div class="content">
        <p>Bonjour <strong>{{ $client->prenom }} {{ $client->nom }}</strong>,</p>

        <p>Nous avons bien reçu votre réservation et nous vous remercions pour votre confiance !</p>

        <div class="info-box">
            <p><strong>📋 Numéro de commande :</strong> #{{ $commande->id }}</p>
            <p><strong>📅 Date de réservation :</strong> {{ \Carbon\Carbon::parse($commande->datetime)->format('d/m/Y à H:i') }}</p>
            <p><strong>✉️ Email :</strong> {{ $client->email }}</p>
            <p><strong>📞 Téléphone :</strong> {{ $client->phone }}</p>
        </div>

        <h3>🎫 Activités réservées :</h3>

        @foreach($activities as $activity)
            <div class="activity-item">
                <div class="activity-name">{{ $activity->nom }}</div>
                <div class="activity-price">Prix : {{ number_format($activity->prix, 2) }} AED</div>
                @if($activity->location)
                    <div style="color: #666; margin-top: 5px;">📍 {{ $activity->location }}</div>
                @endif
            </div>
        @endforeach

        <div class="total">
            💰 Montant total : {{ number_format($commande->montant_total, 2) }} AED
        </div>

        <div style="margin-top: 30px; padding: 20px; background-color: #fff3cd; border-radius: 5px;">
            <h4 style="margin-top: 0; color: #856404;">ℹ️ Prochaines étapes :</h4>
            <ul style="margin-bottom: 0;">
                <li>Notre équipe va traiter votre réservation dans les plus brefs délais</li>
                <li>Vous recevrez une confirmation finale avec tous les détails</li>
                <li>En cas de questions, n'hésitez pas à nous contacter</li>
            </ul>
        </div>

        <p style="margin-top: 20px;">
            Merci d'avoir choisi <strong>Dubai Activities</strong> pour vos activités à Dubaï !
        </p>

        <p style="color: #666; font-size: 14px; margin-top: 30px;">
            Si vous avez des questions, vous pouvez nous contacter à tout moment à l'adresse
            <a href="mailto:web@gabrielkalala.com">web@gabrielkalala.com</a>
        </p>
    </div>

    <div class="footer">
        <p style="margin: 0;">&copy; {{ date('Y') }} Dubai Activities. Tous droits réservés.</p>
        <p style="margin: 5px 0 0 0; font-size: 12px;">Votre partenaire pour des expériences inoubliables à Dubaï</p>
    </div>
</body>
</html>
