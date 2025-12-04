<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket d'Événement</title>
    <style>
        /* CSS inchangé */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        
        .ticket-container {
            width: 80mm;
            height: auto;
            min-height: 160mm;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0,0,0,0.2);
            position: relative;
            overflow: hidden;
            margin: 0 auto;
        }
        
        .ticket-header {
            background: #e11d48;
            color: white;
            padding: 15px 10px;
            text-align: center;
            height: 26mm;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }
        
        .ticket-header::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            @if(!empty($ticket['photo_affiche']))
            background: url('{{ env('ENV_IMG_URL') }}/storage/{{ $ticket['photo_affiche'] }}') center/cover;
            @endif
            opacity: 0.3;
        }
        
        .event-title {
            font-size: 14px;
            font-weight: bold;
            margin: 0;
            line-height: 1.2;
            position: relative;
            z-index: 2;
        }
        
        .ticket-subtitle {
            font-size: 8px;
            opacity: 0.9;
            margin: 3px 0 0 0;
            position: relative;
            z-index: 2;
        }
        
        .ticket-content {
            padding: 10px;
        }
        
        .section-title {
            font-size: 8px;
            color: #64707d;
            text-align: center;
            margin: 15px 0 10px 0;
            letter-spacing: 1px;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
            margin-bottom: 15px;
        }
        
        .info-item {
            display: flex;
            flex-direction: column;
        }
        
        .info-label {
            font-size: 7px;
            color: #64707d;
            margin-bottom: 2px;
        }
        
        .info-value {
            font-size: 9px;
            color: #212b47;
            font-weight: bold;
        }
        
        .divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, #dee4eb, transparent);
            margin: 15px 0;
        }
        
        .participant-section {
            margin: 15px 0;
        }
        
        .participant-label {
            font-size: 7px;
            color: #64707d;
            margin-bottom: 5px;
        }
        
        .participant-name {
            font-size: 11px;
            color: #212b47;
            font-weight: bold;
        }
        
        .qr-section {
            text-align: center;
            margin: 20px 0;
        }
        
        .qr-container {
            display: inline-block;
            padding: 10px;
            border: 1px dashed #96a8b6;
            border-radius: 5px;
            background: white;
        }
        
        .qr-image {
            width: 35mm !important;
            height: 35mm !important;
            object-fit: contain;
            display: block;
        }
        
        .qr-text {
            font-size: 7px;
            color: #64707d;
            margin-top: 8px;
            text-align: center;
        }
        
        .security-section {
            text-align: center;
            margin-top: 20px;
            padding: 0 10px;
        }
        
        .security-title {
            font-size: 5px;
            color: #64707d;
            font-weight: bold;
            margin: 3px 0;
            letter-spacing: 0.5px;
        }
        
        .security-subtitle {
            font-size: 4px;
            color: #64707d;
            margin: 2px 0;
        }
        
        .brand-name {
            font-size: 5px;
            color: #e11d48;
            font-weight: bold;
            margin-top: 3px;
        }
        
        .transaction-details {
            margin-top: 15px;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 5px;
        }
        
        .transaction-row {
            display: flex;
            justify-content: space-between;
            margin: 5px 0;
            font-size: 8px;
        }
        
        .transaction-label {
            color: #64707d;
        }
        
        .transaction-value {
            color: #212b47;
            font-weight: bold;
        }
        
        .ticket-container::before,
        .ticket-container::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            background: #f5f5f5;
            border-radius: 50%;
            z-index: 2;
        }
        
        .ticket-container::before {
            top: -10px;
            left: -10px;
        }
        
        .ticket-container::after {
            top: -10px;
            right: -10px;
        }
        
        .event-poster {
            text-align: center;
            margin: 15px 0;
        }
        
        .poster-image {
            max-width: 100%;
            max-height: 40mm;
            object-fit: contain;
            border-radius: 5px;
        }
        
        @media print {
            body {
                background: white;
                padding: 0;
                margin: 0;
            }
            
            .ticket-container {
                box-shadow: none;
                margin: 0;
                page-break-inside: avoid;
                width: 80mm;
                height: auto;
            }
        }
    </style>
</head>
<body>
    <!-- Ticket -->
    <div class="ticket-container">
        <!-- En-tête -->
        <div class="ticket-header">
            <h2 class="event-title">{{ $ticket['event_name'] }}</h2>
            <p class="ticket-subtitle">Billet d'entrée #{{ $ticket['ticket_id'] }}</p>
        </div>
        
        <!-- Contenu -->
        <div class="ticket-content">
            <!-- Informations du billet -->
            <h3 class="section-title">INFORMATIONS DU BILLET</h3>
            
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">LIEU</span>
                    <span class="info-value">{{ $ticket['location'] }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">CATÉGORIE</span>
                    <span class="info-value">{{ $ticket['type'] }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">QUANTITÉ</span>
                    <span class="info-value">{{ $ticket['quantity'] }} billet(s)</span>
                </div>
            </div>
            
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">DATE ÉVÉNEMENT</span>
                    <span class="info-value">{{ $ticket['event_date'] }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">HEURE</span>
                    <span class="info-value">{{ $ticket['event_time'] }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">TOTAL A PAYER</span>
                    <span class="info-value">{{ $ticket['total'] }} {{ $ticket['devise'] }}</span>
                </div>
            </div>
            
            <!-- Divider -->
            <div class="divider"></div>
            
            <!-- Participant -->
            <div class="participant-section">
                <div class="participant-label">PARTICIPANT</div>
                <div class="participant-name">{{ $ticket['user_name'] }}</div>
            </div>
           
            <!-- QR Code - IMPORTANT: remplacé le canvas par une image -->
            <div class="qr-section">
                <div class="qr-container">
                    <!-- Image QR code depuis l'URL générée -->
                    <img src="{{ $ticket['qrcode_url'] }}" 
                         class="qr-image" 
                         alt="QR Code"
                         style="width: 35mm; height: 35mm; display: block; margin: 0 auto;">
                    
                    <div class="qr-text">SCANNEZ-MOI À L'ENTRÉE</div>
                    <div class="qr-text" style="font-size: 6px; margin-top: 3px;">
                        ID: {{ $ticket['ticket_id'] }}
                    </div>
                </div>
            </div>
            
            <!-- Section sécurité -->
            <div class="security-section">
                <div class="security-title">BILLET NOMINATIF - NON TRANSFÉRABLE</div>
                <div class="security-subtitle">SÉCURISÉ ET VÉRIFIÉ PAR</div>
                <div class="brand-name">KIMIA TICKETS</div>
            </div>
            
            <!-- Détails transaction -->
            <div class="transaction-details">
                <div class="transaction-row">
                    <span class="transaction-label">Date d'achat:</span>
                    <span class="transaction-value">{{ $ticket['purchase_date'] }}</span>
                </div>
                <div class="transaction-row">
                    <span class="transaction-label">Prix unitaire:</span>
                    <span class="transaction-value">{{ $ticket['price'] }} {{ $ticket['devise'] }}</span>
                </div>
            </div>
        </div>
    </div>
    <!-- SUPPRIMEZ TOUT LE JAVASCRIPT - il n'est pas utilisé pour les PDF -->
</body>
</html>