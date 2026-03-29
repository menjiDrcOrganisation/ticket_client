<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Billet Événement - Style Boarding Pass</title>
    <!-- Font Awesome 6 (gratuit, icônes pro) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #EFF3F8;
            font-family: 'Inter', 'Segoe UI', system-ui, -apple-system, BlinkMacSystemFont, 'Helvetica Neue', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        /* Ticket principal - style boarding pass */
        .boarding-ticket {
            max-width: 380px;
            width: 100%;
            background: white;
            border-radius: 32px;
            box-shadow: 0 20px 35px -10px rgba(0, 0, 0, 0.2), 0 0 0 1px rgba(0, 0, 0, 0.02);
            overflow: hidden;
            transition: transform 0.2s;
        }

        .boarding-ticket:hover {
            transform: translateY(-3px);
        }

        /* En-tête "boarding pass" avec effet d'étiquette */
        .pass-header {
            background: #0B1A2F;
            padding: 20px 20px 12px;
            color: white;
            position: relative;
        }

        .pass-type {
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            opacity: 0.75;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pass-type i {
            font-size: 14px;
        }

        .event-name {
            font-size: 22px;
            font-weight: 800;
            margin: 12px 0 6px;
            line-height: 1.2;
            letter-spacing: -0.3px;
        }

        .ticket-ref {
            font-size: 9px;
            font-family: monospace;
            background: rgba(255,255,255,0.15);
            display: inline-block;
            padding: 3px 10px;
            border-radius: 30px;
            margin-top: 6px;
        }

        /* section centrale inspirée des aéroports (départ / arrivée) */
        .journey-section {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #FFFFFF;
            padding: 20px 20px 12px;
            border-bottom: 2px dashed #E2E8F0;
            position: relative;
        }

        .location {
            text-align: center;
            flex: 1;
        }

        .location-code {
            font-size: 28px;
            font-weight: 800;
            color: #0F2B3D;
            letter-spacing: 1px;
        }

        .location-city {
            font-size: 11px;
            font-weight: 500;
            color: #5C6F87;
            margin-top: 4px;
        }

        .journey-icon {
            font-size: 22px;
            color: #94A3B8;
            margin: 0 8px;
        }

        /* infos supplémentaires type vol / porte / catégorie */
        .flight-info {
            display: flex;
            justify-content: space-between;
            padding: 16px 20px;
            background: #F9FCFE;
            border-bottom: 1px solid #EFF3F8;
            flex-wrap: wrap;
            gap: 12px;
        }

        .info-chip {
            text-align: center;
            flex: 1;
            min-width: 65px;
        }

        .chip-label {
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
            color: #7F8FA4;
            letter-spacing: 0.8px;
        }

        .chip-value {
            font-size: 15px;
            font-weight: 700;
            color: #1E2F3E;
            margin-top: 5px;
        }

        /* participant */
        .passenger-block {
            padding: 16px 20px;
            background: white;
            border-bottom: 1px solid #EDF2F7;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .passenger-icon {
            background: #EFF6FF;
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 40px;
            color: #2C6E9E;
            font-size: 20px;
        }

        .passenger-detail {
            flex: 1;
        }

        .passenger-label {
            font-size: 8px;
            font-weight: 700;
            text-transform: uppercase;
            color: #6F8FAC;
        }

        .passenger-name {
            font-size: 16px;
            font-weight: 800;
            color: #0F2A3B;
        }

        /* QR code zone façon boarding pass */
        .qr-boarding {
            padding: 20px 20px 16px;
            text-align: center;
            background: white;
            border-bottom: 1px solid #ECF3F9;
        }

        .qr-container {
            display: inline-block;
            background: white;
            padding: 6px;
            border-radius: 20px;
            box-shadow: 0 8px 18px -8px rgba(0, 0, 0, 0.1);
        }

        .qr-image {
            width: 110px;
            height: 110px;
            display: block;
            margin: 0 auto;
        }

        .qr-caption {
            font-size: 8px;
            font-weight: 600;
            color: #2C6280;
            margin-top: 10px;
            letter-spacing: 0.5px;
        }

        /* détails transaction / achat */
        .transaction-details {
            padding: 14px 20px;
            background: #FEFEFE;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            font-size: 10px;
            padding: 6px 0;
            border-bottom: 1px dashed #EFF3F8;
        }

        .detail-label {
            color: #6E85A0;
            font-weight: 500;
        }

        .detail-value {
            font-weight: 700;
            color: #1C3C54;
        }

        /* sécurité / footer */
        .security-footer {
            background: #F1F5F9;
            padding: 12px 20px;
            text-align: center;
            font-size: 7px;
            color: #5A6F89;
            font-weight: 600;
            text-transform: uppercase;
            display: flex;
            justify-content: space-between;
            align-items: center;
            letter-spacing: 0.3px;
        }

        .brand {
            font-weight: 800;
            color: #1F6E8C;
            font-size: 9px;
        }

        /* ligne pointillée décorative type boarding pass */
        .dashed-divider {
            height: 2px;
            background: repeating-linear-gradient(90deg, #CBD5E1, #CBD5E1 8px, transparent 8px, transparent 16px);
            margin: 0 0;
        }

        /* poster optionnel (si image) avec un style plus intégré */
        .poster-mini {
            padding: 12px 20px 8px;
            background: #FAFDFF;
            text-align: center;
            border-bottom: 1px solid #EFF3F8;
        }

        .poster-mini img {
            max-width: 100%;
            max-height: 55px;
            border-radius: 12px;
            object-fit: cover;
        }

        /* impression */
        @media print {
            body {
                background: white;
                padding: 0;
            }
            .boarding-ticket {
                box-shadow: none;
                max-width: 85mm;
                margin: 0 auto;
                border-radius: 12px;
            }
            .security-footer {
                break-inside: avoid;
            }
        }
    </style>
</head>
<body>

<div class="boarding-ticket">
    <!-- En-tête style boarding pass -->
    <div class="pass-header">
        <div class="pass-type">
            <span><i class="fas fa-ticket-alt"></i> BILLET ÉLECTRONIQUE</span>
            <span><i class="fas fa-mobile-alt"></i> SCAN@ENTRY</span>
        </div>
        <div class="event-name">{{ $ticket['event_name'] ?? 'SPECTACLE LIVE' }}</div>
        <div class="ticket-ref">#{{ $ticket['ticket_id'] ?? 'KM' . rand(10000,99999) }}</div>
    </div>

    <!-- Section inspiration "aéroport" : lieu principal transformé en départ / arrivée (suggéré par l'image) -->
    <div class="journey-section">
        <div class="location">
            <div class="location-code">{{ strtoupper(substr($ticket['location'] ?? 'LIEU', 0, 3)) }}</div>
            <div class="location-city">{{ $ticket['location'] ?? 'Lieu principal' }}</div>
        </div>
        <div class="journey-icon">
            <i class="fas fa-arrow-right"></i>
        </div>
        <div class="location">
            <div class="location-code">ENTRÉE</div>
            <div class="location-city">{{ $ticket['gate_info'] ?? 'Scannez QR' }}</div>
        </div>
    </div>

    <!-- Infos type "vol" = événement / catégorie / horaire -->
    <div class="flight-info">
        <div class="info-chip">
            <div class="chip-label"><i class="far fa-calendar-alt"></i> DATE</div>
            <div class="chip-value">{{ $ticket['event_date'] ?? '--/--/----' }}</div>
        </div>
        <div class="info-chip">
            <div class="chip-label"><i class="far fa-clock"></i> HORAIRE</div>
            <div class="chip-value">{{ $ticket['event_time'] ?? '--:--' }}</div>
        </div>
        <div class="info-chip">
            <div class="chip-label"><i class="fas fa-tag"></i> CATÉGORIE</div>
            <div class="chip-value">{{ $ticket['type'] ?? 'Standard' }}</div>
        </div>
        <div class="info-chip">
            <div class="chip-label"><i class="fas fa-chair"></i> PLACE / QTE</div>
            <div class="chip-value">{{ $ticket['quantity'] ?? 1 }} billet(s)</div>
        </div>
    </div>

    <!-- Participant (nom + icône) -->
    <div class="passenger-block">
        <div class="passenger-icon">
            <i class="fas fa-user-check"></i>
        </div>
        <div class="passenger-detail">
            <div class="passenger-label">PASSAGER / TITULAIRE</div>
            <div class="passenger-name">{{ $ticket['user_name'] ?? 'Participant' }}</div>
        </div>
        <div style="font-size: 10px; color:#2A6F8F;">
            <i class="fas fa-check-circle"></i>
        </div>
    </div>

    <!-- Affiche de l'événement si disponible (intégrée légèrement) -->
    @if(!empty($ticket['photo_affiche']))
    <div class="poster-mini">
        <img src="{{ env('ENV_POINT_URL') }}/storage/app/public/{{ $ticket['photo_affiche'] }}" alt="affiche">
    </div>
    @endif

    <!-- QR Code proche du style boarding pass -->
    <div class="qr-boarding">
        <div class="qr-container">
            <img src="{{ $ticket['qrcode_url'] ?? 'https://quickchart.io/qr?text=TICKET_' . ($ticket['ticket_id'] ?? '000000') . '&size=200&margin=2&dark=1A3B4C' }}" 
                 class="qr-image" 
                 alt="QR Code">
        </div>
        <div class="qr-caption">
            <i class="fas fa-qrcode"></i> PRÉSENTEZ CE CODE À L'ENTRÉE
        </div>
        <div style="font-size: 8px; color:#7B8FA2; margin-top: 5px;">ID unique: {{ $ticket['ticket_id'] ?? '000000' }}</div>
    </div>

    <!-- Ligne décorative pointillée (rappel boarding pass) -->
    <div class="dashed-divider"></div>

    <!-- Détails transaction (prix, achat) -->
    <div class="transaction-details">
        <div class="detail-row">
            <span class="detail-label"><i class="fas fa-receipt"></i> Date d'achat</span>
            <span class="detail-value">{{ $ticket['purchase_date'] ?? date('d/m/Y H:i') }}</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Prix unitaire</span>
            <span class="detail-value">{{ $ticket['price'] ?? '0' }} {{ $ticket['devise'] ?? 'FCFA' }}</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Total payé</span>
            <span class="detail-value">{{ $ticket['total'] ?? '0' }} {{ $ticket['devise'] ?? 'FCFA' }}</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Référence</span>
            <span class="detail-value">{{ $ticket['transaction_ref'] ?? substr(md5($ticket['ticket_id'] ?? 'KIMIA'), 0, 8) }}</span>
        </div>
    </div>

    <!-- Footer sécurité / marque -->
    <div class="security-footer">
        <span><i class="fas fa-lock"></i> BILLET NOMINATIF</span>
        <span class="brand">KIMIA TICKETS</span>
        <span><i class="fas fa-check-double"></i> SÉCURISÉ</span>
    </div>
</div>

</body>
</html>