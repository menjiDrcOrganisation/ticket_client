<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket d'Événement</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 10px;
        }
        
        .ticket-container {
            width: 100%;
            max-width: 80mm;
            height: auto;
            min-height: 160mm;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0,0,0,0.2);
            position: relative;
            overflow: hidden;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
        }
        
        .ticket-header {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            color: white;
            padding: 20px 15px;
            text-align: center;
            min-height: 80px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            flex-shrink: 0;
        }
        
        .ticket-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
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
            font-size: 10px;
            opacity: 0.9;
            margin: 5px 0 0 0;
            position: relative;
            z-index: 2;
        }
        
        .ticket-content {
            padding: 15px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        
        .section-title {
            font-size: 10px;
            color: #64707d;
            text-align: center;
            margin: 0 0 12px 0;
            letter-spacing: 1px;
            font-weight: bold;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-bottom: 15px;
        }
        
        .info-item {
            display: flex;
            flex-direction: column;
        }
        
        .info-label {
            font-size: 8px;
            color: #64707d;
            margin-bottom: 4px;
            text-transform: uppercase;
        }
        
        .info-value {
            font-size: 11px;
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
            margin: 10px 0;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 5px;
        }
        
        .participant-label {
            font-size: 8px;
            color: #64707d;
            margin-bottom: 5px;
            text-transform: uppercase;
        }
        
        .participant-name {
            font-size: 14px;
            color: #212b47;
            font-weight: bold;
        }
        
        .qr-section {
            text-align: center;
            margin: 15px 0;
            flex-shrink: 0;
        }
        
        .qr-container {
            display: inline-block;
            padding: 10px;
            border: 1px dashed #96a8b6;
            border-radius: 5px;
            background: white;
        }
        
        .qr-image {
            width: 100%;
            max-width: 35mm;
            height: auto;
            object-fit: contain;
            display: block;
            margin: 0 auto;
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
            margin-top: 15px;
            padding: 10px;
            background: #f0f1f3;
            border-radius: 5px;
            flex-shrink: 0;
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
            border-radius: 5px;
            flex-shrink: 0;
        }
        
        .transaction-row {
            display: flex;
            justify-content: space-between;
            margin: 8px 0;
            font-size: 9px;
        }
        
        .transaction-label {
            color: #64707d;
        }
        
        .transaction-value {
            color: #212b47;
            font-weight: bold;
        }
        
        /* Suppression des pseudo-éléments problématiques */
        
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
        
        /* Style pour l'impression - prend toute la page */
        @media print {
            body {
                background: white;
                padding: 0;
                margin: 0;
                height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            
            .ticket-container {
                box-shadow: none;
                margin: 0;
                page-break-inside: avoid;
                page-break-after: avoid;
                page-break-before: avoid;
                width: 100%;
                height: 100%;
                max-width: none;
                border-radius: 0;
                display: flex;
                flex-direction: column;
            }
            
            .ticket-content {
                flex: 1;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
            }
            
            .qr-section {
                margin: 20px 0;
            }
            
            @page {
                size: 80mm auto;
                margin: 0mm;
            }
        }
        
        /* Responsive pour petits écrans */
        @media (max-width: 80mm) {
            body {
                padding: 0;
            }
            
            .ticket-container {
                border-radius: 0;
                box-shadow: none;
            }
        }
    </style>
</head>
<body>
    <!-- Ticket qui prend tout l'espace -->
    <div class="ticket-container">
        <!-- En-tête -->
        <div class="ticket-header">
            <h2 class="event-title">{{ $ticket['event_name'] ?? 'Événement' }}</h2>
            <p class="ticket-subtitle">Billet d'entrée #{{ $ticket['ticket_id'] ?? '000000' }}</p>
        </div>
        
        <!-- Contenu principal qui s'étend -->
        <div class="ticket-content">
            <!-- Informations du billet -->
            <div>
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
                    <img src="{{ $ticket['qrcode_url'] ?? 'data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'100\' height=\'100\' viewBox=\'0 0 100 100\'%3E%3Crect width=\'100\' height=\'100\' fill=\'%23000\'/%3E%3C/svg%3E' }}" 
                         class="qr-image" 
                         alt="QR Code"
                         style="width: 35mm; height: 35mm; display: block; margin: 0 auto;">
                    
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