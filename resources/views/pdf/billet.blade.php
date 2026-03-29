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
            padding: 20px;
        }
        
        .ticket-container {
            width: 100%;
            max-width: 100mm;  /* Augmenté de 80mm à 100mm */
            height: auto;
            min-height: 180mm;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            position: relative;
            overflow: visible;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
        }
        
        .ticket-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 25px 20px;
            text-align: center;
            min-height: 100px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            flex-shrink: 0;
            border-radius: 12px 12px 0 0;
        }
        
        .ticket-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.2);
            z-index: 1;
            border-radius: 12px 12px 0 0;
        }
        
        .event-title {
            font-size: 18px;
            font-weight: bold;
            margin: 0;
            line-height: 1.3;
            position: relative;
            z-index: 2;
            word-wrap: break-word;
        }
        
        .ticket-subtitle {
            font-size: 11px;
            opacity: 0.95;
            margin: 8px 0 0 0;
            position: relative;
            z-index: 2;
        }
        
        .ticket-content {
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        
        .section-title {
            font-size: 11px;
            color: #64707d;
            text-align: center;
            margin: 0 0 15px 0;
            letter-spacing: 1.5px;
            font-weight: bold;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .info-item {
            display: flex;
            flex-direction: column;
        }
        
        .info-label {
            font-size: 9px;
            color: #64707d;
            margin-bottom: 5px;
            text-transform: uppercase;
            font-weight: 600;
        }
        
        .info-value {
            font-size: 12px;
            color: #212b47;
            font-weight: bold;
            word-wrap: break-word;
        }
        
        .divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, #dee4eb, transparent);
            margin: 20px 0;
        }
        
        .participant-section {
            margin: 15px 0;
            padding: 12px;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 8px;
            border-left: 4px solid #667eea;
        }
        
        .participant-label {
            font-size: 9px;
            color: #64707d;
            margin-bottom: 6px;
            text-transform: uppercase;
            font-weight: 600;
        }
        
        .participant-name {
            font-size: 16px;
            color: #212b47;
            font-weight: bold;
        }
        
        .qr-section {
            text-align: center;
            margin: 20px 0;
            flex-shrink: 0;
        }
        
        .qr-container {
            display: inline-block;
            padding: 15px;
            border: 2px dashed #96a8b6;
            border-radius: 10px;
            background: white;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .qr-image {
            width: 100%;
            max-width: 45mm;  /* Augmenté de 35mm à 45mm */
            height: auto;
            object-fit: contain;
            display: block;
            margin: 0 auto;
        }
        
        .qr-text {
            font-size: 9px;
            color: #64707d;
            margin-top: 10px;
            text-align: center;
            font-weight: bold;
        }
        
        .security-section {
            text-align: center;
            margin-top: 20px;
            padding: 12px;
            background: linear-gradient(135deg, #f0f1f3 0%, #e2e3e5 100%);
            border-radius: 8px;
            flex-shrink: 0;
        }
        
        .security-title {
            font-size: 8px;
            color: #64707d;
            font-weight: bold;
            margin: 3px 0;
            letter-spacing: 0.5px;
        }
        
        .security-subtitle {
            font-size: 7px;
            color: #64707d;
            margin: 2px 0;
        }
        
        .brand-name {
            font-size: 10px;
            color: #e11d48;
            font-weight: bold;
            margin-top: 6px;
        }
        
        .transaction-details {
            margin-top: 20px;
            padding: 12px;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 8px;
            flex-shrink: 0;
        }
        
        .transaction-row {
            display: flex;
            justify-content: space-between;
            margin: 10px 0;
            font-size: 10px;
        }
        
        .transaction-label {
            color: #64707d;
            font-weight: 600;
        }
        
        .transaction-value {
            color: #212b47;
            font-weight: bold;
        }
        
        .event-poster {
            text-align: center;
            margin: 15px 0;
        }
        
        .poster-image {
            max-width: 100%;
            max-height: 50mm;
            object-fit: contain;
            border-radius: 8px;
        }
        
        /* Style pour l'impression */
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
                margin: 25px 0;
            }
            
            @page {
                size: 100mm auto;  /* Augmenté à 100mm */
                margin: 5mm;
            }
        }
        
        /* Responsive pour différents écrans */
        @media (max-width: 100mm) {
            body {
                padding: 10px;
            }
            
            .ticket-container {
                max-width: 95%;
            }
        }
        
        /* Améliorations visuelles supplémentaires */
        .ticket-container::before {
            content: '';
            position: absolute;
            top: 10px;
            left: -10px;
            width: 20px;
            height: 20px;
            background: #f5f5f5;
            border-radius: 50%;
            z-index: 1;
        }
        
        .ticket-container::after {
            content: '';
            position: absolute;
            top: 10px;
            right: -10px;
            width: 20px;
            height: 20px;
            background: #f5f5f5;
            border-radius: 50%;
            z-index: 1;
        }
        
        /* Style pour les bordures décoratives */
        .ticket-content {
            position: relative;
        }
        
        .ticket-content::before {
            content: '';
            position: absolute;
            top: 0;
            left: 10px;
            right: 10px;
            height: 2px;
            background: linear-gradient(90deg, transparent, #667eea, #764ba2, transparent);
        }
    </style>
</head>
<body>
    <!-- Ticket avec largeur augmentée -->
    <div class="ticket-container">
        <!-- En-tête amélioré -->
        <div class="ticket-header">
            <h2 class="event-title">{{ $ticket['event_name'] ?? 'Événement Spécial' }}</h2>
            <p class="ticket-subtitle">Billet d'entrée VIP #{{ $ticket['ticket_id'] ?? '000000' }}</p>
        </div>
        
        <!-- Contenu principal -->
        <div class="ticket-content">
            <!-- Informations du billet -->
            <div>
                <h3 class="section-title">INFORMATIONS DU BILLET</h3>
                
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label"> LIEU</span>
                        <span class="info-value">{{ $ticket['location'] ?? 'Palais des Congrès' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label"> CATÉGORIE</span>
                        <span class="info-value">{{ $ticket['type'] ?? 'VIP' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label"> QUANTITÉ</span>
                        <span class="info-value">{{ $ticket['quantity'] ?? '2' }} billet(s)</span>
                    </div>
                </div>
                
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label"> DATE ÉVÉNEMENT</span>
                        <span class="info-value">{{ $ticket['event_date'] ?? '15 Décembre 2024' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label"> HEURE</span>
                        <span class="info-value">{{ $ticket['event_time'] ?? '19:00 - 23:00' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label"> TOTAL</span>
                        <span class="info-value">{{ $ticket['total'] ?? '25 000' }} {{ $ticket['devise'] ?? 'FCFA' }}</span>
                    </div>
                </div>
            </div>
            
            <!-- Divider décoratif -->
            <div class="divider"></div>
            
            <!-- Participant -->
            <div class="participant-section">
                <div class="participant-label"> PARTICIPANT</div>
                <div class="participant-name">{{ $ticket['user_name'] ?? 'Jean Dupont' }}</div>
            </div>
           
            <!-- QR Code agrandi -->
            <div class="qr-section">
                <div class="qr-container">
                    <img src="{{ $ticket['qrcode_url'] ?? 'https://quickchart.io/qr?text=TICKET_' . ($ticket['ticket_id'] ?? '000000') . '&size=200' }}" 
                         class="qr-image" 
                         alt="QR Code"
                         style="width: 45mm; height: 45mm; display: block; margin: 0 auto;">
                    
                    <div class="qr-text"> SCANNEZ-MOI À L'ENTRÉE</div>
                    <div class="qr-text" style="font-size: 8px; margin-top: 5px; color: #e11d48;">
                        ID: {{ $ticket['ticket_id'] ?? 'KIM-2024-001' }}
                    </div>
                </div>
            </div>
            
            <!-- Section sécurité -->
            <div class="security-section">
                <div class="security-title"> BILLET NOMINATIF - NON TRANSFÉRABLE</div>
                <div class="security-subtitle">SÉCURISÉ ET VÉRIFIÉ PAR</div>
                <div class="brand-name"> KIMIA TICKETS </div>
            </div>
            
            <!-- Détails transaction -->
            <div class="transaction-details">
                <div class="transaction-row">
                    <span class="transaction-label"> Date d'achat:</span>
                    <span class="transaction-value">{{ $ticket['purchase_date'] ?? date('d/m/Y H:i') }}</span>
                </div>
                <div class="transaction-row">
                    <span class="transaction-label"> Prix unitaire:</span>
                    <span class="transaction-value">{{ $ticket['price'] ?? '12 500' }} {{ $ticket['devise'] ?? 'FCFA' }}</span>
                </div>
                <div class="transaction-row">
                    <span class="transaction-label"> Code transaction:</span>
                    <span class="transaction-value">{{ $ticket['transaction_id'] ?? 'TRX-' . rand(100000, 999999) }}</span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>