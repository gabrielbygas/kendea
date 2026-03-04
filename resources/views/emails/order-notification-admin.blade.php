{{-- Modified by Claude --}}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle commande</title>
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
            background-color: #2c3e50;
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
        .alert {
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
            font-weight: bold;
        }
        .info-section {
            background-color: white;
            padding: 15px;
            margin: 15px 0;
            border-radius: 5px;
            border-left: 4px solid #2196F3;
        }
        .info-section h3 {
            margin-top: 0;
            color: #2c3e50;
        }
        .activity-item {
            background-color: #f0f0f0;
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
        .total {
            background-color: #2c3e50;
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
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table td {
            padding: 8px 0;
        }
        table td:first-child {
            font-weight: bold;
            width: 40%;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🔔 Nouvelle commande reçue</h1>
        <p>KendeaTravel - Administration</p>
    </div>

    <div class="content">
        <div class="alert">
            ✅ Une nouvelle commande vient d'être créée !
        </div>

        <div class="info-section">
            <h3>📋 Informations de la commande</h3>
            <table>
                <tr>
                    <td>Numéro de commande :</td>
                    <td><strong>#{{ $commande->id }}</strong></td>
                </tr>
                <tr>
                    <td>Date de création :</td>
                    <td>{{ \Carbon\Carbon::parse($commande->created_at)->format('d/m/Y à H:i:s') }}</td>
                </tr>
                <tr>
                    <td>Date de réservation :</td>
                    <td>{{ \Carbon\Carbon::parse($commande->datetime)->format('d/m/Y à H:i') }}</td>
                </tr>
                <tr>
                    <td>Statut :</td>
                    <td><span style="color: #ff9800; font-weight: bold;">{{ strtoupper($commande->statut) }}</span></td>
                </tr>
            </table>
        </div>

        <div class="info-section">
            <h3>👤 Informations du client</h3>
            <table>
                <tr>
                    <td>Nom complet :</td>
                    <td><strong>{{ $client->prenom }} {{ $client->nom }}</strong></td>
                </tr>
                <tr>
                    <td>Email :</td>
                    <td><a href="mailto:{{ $client->email }}">{{ $client->email }}</a></td>
                </tr>
                <tr>
                    <td>Téléphone :</td>
                    <td><a href="tel:{{ $client->phone }}">{{ $client->phone }}</a></td>
                </tr>
                <tr>
                    <td>Client ID :</td>
                    <td>#{{ $client->id }}</td>
                </tr>
            </table>
        </div>

        <div class="info-section">
            <h3>🎫 Activités commandées ({{ count($activities) }})</h3>

            @foreach($activities as $activity)
                <div class="activity-item">
                    <div class="activity-name">{{ $activity->nom }}</div>
                    <div style="color: #666; margin-top: 5px;">
                        <strong>Prix :</strong> {{ number_format($activity->prix, 2) }} AED
                    </div>
                    @if($activity->location)
                        <div style="color: #666; margin-top: 5px;">
                            📍 {{ $activity->location }}
                        </div>
                    @endif
                    @if($activity->notes)
                        <div style="color: #666; margin-top: 5px;">
                            ⭐ Note : {{ $activity->notes }}/5
                        </div>
                    @endif
                    <div style="color: #999; margin-top: 5px; font-size: 12px;">
                        ID Activité : #{{ $activity->id }}
                    </div>
                </div>
            @endforeach
        </div>

        <div class="total">
            💰 Montant total de la commande : {{ number_format($commande->montant_total, 2) }} AED
        </div>

        <div style="margin-top: 30px; padding: 20px; background-color: #fff3cd; border-radius: 5px;">
            <h4 style="margin-top: 0; color: #856404;">⚠️ Actions à effectuer :</h4>
            <ul style="margin-bottom: 0;">
                <li>Vérifier la disponibilité des activités pour la date demandée</li>
                <li>Contacter le client pour confirmer la réservation</li>
                <li>Mettre à jour le statut de la commande après traitement</li>
                <li>Préparer les documents nécessaires pour les activités</li>
            </ul>
        </div>

        <div style="margin-top: 20px; padding: 15px; background-color: #e3f2fd; border-radius: 5px; text-align: center;">
            <p style="margin: 0; color: #1976d2;">
                📧 Un email de confirmation a été automatiquement envoyé au client
            </p>
        </div>
    </div>

    <div class="footer">
        <p style="margin: 0;">&copy; {{ date('Y') }} KendeaTravel - Administration</p>
        <p style="margin: 5px 0 0 0; font-size: 12px;">Notification automatique du système</p>
    </div>
</body>
</html>
