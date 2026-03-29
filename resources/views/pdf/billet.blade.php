<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket d'Événement</title>
    <style>
        /* CSS amélioré avec la photo */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
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
            width: 115mm;
            max-width: 100%;
            height: auto;
            min-height: 180mm;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            position: relative;
            overflow: hidden;
            margin: 0 auto;
        }
        
        .ticket-header {
            color: white;
            padding: 20px 15px;
            text-align: center;
            min-height: 90px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
        }
        
        /* Style pour l'image d'arrière-plan de l'en-tête */
        .ticket-header.has-poster::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0.6;
            z-index: 1;
        }
        
        .ticket-header::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.4);
            z-index: 1;
        }
        
        .event-title {
            font-size: 16px;
            font-weight: bold;
            margin: 0;
            line-height: 1.3;
            position: relative;
            z-index: 2;
            word-wrap: break-word;
        }
        
        .ticket-subtitle {
            font-size: 9px;
            opacity: 0.95;
            margin: 5px 0 0 0;
            position: relative;
            z-index: 2;
        }
        
        .ticket-content {
            padding: 15px;
        }
        
        .section-title {
            font-size: 9px;
            color: #64707d;
            text-align: center;
            margin: 10px 0 12px 0;
            letter-spacing: 1.5px;
            font-weight: bold;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-bottom: 15px;
        }
        
        .info-item {
            display: flex;
            flex-direction: column;
        }
        
        .info-label {
            font-size: 8px;
            color: #64707d;
            margin-bottom: 3px;
            text-transform: uppercase;
        }
        
        .info-value {
            font-size: 10px;
            color: #212b47;
            font-weight: bold;
            word-wrap: break-word;
        }
        
        .divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, #dee4eb, transparent);
            margin: 15px 0;
        }
        
        .participant-section {
            margin: 15px 0;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 8px;
            border-left: 3px solid #667eea;
        }
        
        .participant-label {
            font-size: 8px;
            color: #64707d;
            margin-bottom: 5px;
            text-transform: uppercase;
        }
        
        .participant-name {
            font-size: 13px;
            color: #212b47;
            font-weight: bold;
        }
        
        /* Section de l'affiche */
        .poster-section {
            text-align: center;
            margin: 15px 0;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 8px;
        }
        
        .poster-title {
            font-size: 8px;
            color: #64707d;
            margin-bottom: 8px;
            text-transform: uppercase;
            font-weight: bold;
        }
        
        .poster-image {
            max-width: 100%;
            max-height: 60mm;
            width: auto;
            height: auto;
            object-fit: contain;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .qr-section {
            text-align: center;
            margin: 20px 0;
        }
        
        .qr-container {
            display: inline-block;
            padding: 12px;
            border: 2px dashed #96a8b6;
            border-radius: 8px;
            background: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        
        .qr-image {
            width: 38mm !important;
            height: 38mm !important;
            object-fit: contain;
            display: block;
        }
        
        .qr-text {
            font-size: 8px;
            color: #64707d;
            margin-top: 8px;
            text-align: center;
            font-weight: bold;
        }
        
        .security-section {
            text-align: center;
            margin-top: 20px;
            padding: 12px;
            background: #f0f1f3;
            border-radius: 8px;
        }
        
        .security-title {
            font-size: 7px;
            color: #64707d;
            font-weight: bold;
            margin: 3px 0;
            letter-spacing: 0.5px;
        }
        
        .security-subtitle {
            font-size: 6px;
            color: #64707d;
            margin: 2px 0;
        }
        
        .brand-name {
            font-size: 8px;
            color: #e11d48;
            font-weight: bold;
            margin-top: 5px;
        }
        
        .transaction-details {
            margin-top: 15px;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 8px;
        }
        
        .transaction-row {
            display: flex;
            justify-content: space-between;
            margin: 6px 0;
            font-size: 9px;
        }
        
        .transaction-label {
            color: #64707d;
        }
        
        .transaction-value {
            color: #212b47;
            font-weight: bold;
        }
        
        /* Effets de découpe */
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
                width: 85mm;
                height: auto;
            }
            
            .ticket-container::before,
            .ticket-container::after {
                background: white;
            }
        }
        
        /* Responsive */
        @media (max-width: 85mm) {
            body {
                padding: 10px;
            }
            
            .ticket-container {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <!-- Ticket avec photo d'affiche -->
    <div class="ticket-container">
        <!-- En-tête avec image d'arrière-plan conditionnelle -->
        <div class="ticket-header" 
             @if(!empty($ticket['photo_affiche'])) 
                 style="background-image: url('{{ env('ENV_POINT_URL') }}/storage/app/public/{{ $ticket['photo_affiche'] }}'); background-size: cover; background-position: center;"
             @endif>
            <h2 class="event-title">{{ $ticket['event_name'] ?? 'Événement' }}</h2>
            <p class="ticket-subtitle">Billet d'entrée #{{ $ticket['ticket_id'] ?? '000000' }}</p>
        </div>
        
        <!-- Contenu -->
        <div class="ticket-content">
            <!-- Affichage de l'affiche si disponible -->
            @if(!empty($ticket['photo_affiche']))
            <div class="poster-section">
                <div class="poster-title">AFFICHE DE L'ÉVÉNEMENT</div>
                <img src="{{ env('ENV_POINT_URL') }}/storage/app/public/{{ $ticket['photo_affiche'] }}" 
                     class="poster-image" 
                     alt="Affiche événement">
            </div>
            @endif
            
            <!-- Informations du billet -->
            <h3 class="section-title">INFORMATIONS DU BILLET</h3>
            
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">LIEU</span>
                    <span class="info-value">{{ $ticket['location'] ?? 'Non spécifié' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">CATÉGORIE</span>
                    <span class="info-value">{{ $ticket['type'] ?? 'Standard' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">QUANTITÉ</span>
                    <span class="info-value">{{ $ticket['quantity'] ?? '1' }} billet(s)</span>
                </div>
            </div>
            
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">DATE ÉVÉNEMENT</span>
                    <span class="info-value">{{ $ticket['event_date'] ?? 'Date non définie' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">HEURE</span>
                    <span class="info-value">{{ $ticket['event_time'] ?? 'Horaire non défini' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">TOTAL A PAYER</span>
                    <span class="info-value">{{ $ticket['total'] ?? '0' }} {{ $ticket['devise'] ?? 'FCFA' }}</span>
                </div>
            </div>
            
            <!-- Divider -->
            <div class="divider"></div>
            
            <!-- Participant -->
            <div class="participant-section">
                <div class="participant-label">PARTICIPANT</div>
                <div class="participant-name">{{ $ticket['user_name'] ?? 'Participant' }}</div>
            </div>
           
            <!-- QR Code -->
            <div class="qr-section">
                <div class="qr-container">
                    <img src="{{ $ticket['qrcode_url'] ?? 'https://quickchart.io/qr?text=TICKET_' . ($ticket['ticket_id'] ?? '000000') . '&size=150' }}" 
                         class="qr-image" 
                         alt="QR Code"
                         style="width: 38mm; height: 38mm; display: block; margin: 0 auto;">
                    
                    <div class="qr-text">SCANNEZ-MOI À L'ENTRÉE</div>
                    <div class="qr-text" style="font-size: 7px; margin-top: 3px;">
                        ID: {{ $ticket['ticket_id'] ?? '000000' }}
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
                    <span class="transaction-value">{{ $ticket['purchase_date'] ?? date('d/m/Y H:i') }}</span>
                </div>
                <div class="transaction-row">
                    <span class="transaction-label">Prix unitaire:</span>
                    <span class="transaction-value">{{ $ticket['price'] ?? '0' }} {{ $ticket['devise'] ?? 'FCFA' }}</span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>