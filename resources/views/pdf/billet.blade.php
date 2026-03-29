<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Ticket d'Événement</title>
    <style>
        /* CSS amélioré avec plus de largeur */
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
            width: 100%;
            max-width: 120mm;  /* Augmenté de 85mm à 120mm */
            height: auto;
            min-height: 200mm;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            position: relative;
            overflow: visible;
            margin: 0 auto;
        }
        
        .ticket-header {
            color: white;
            padding: 25px 20px;
            text-align: center;
            min-height: 110px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            border-radius: 12px 12px 0 0;
        }
        
        /* Style pour l'image d'arrière-plan de l'en-tête */
        .ticket-header.has-poster {
            position: relative;
        }
        
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
            opacity: 0.5;
            z-index: 1;
            border-radius: 12px 12px 0 0;
        }
        
        .ticket-header::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            z-index: 1;
            border-radius: 12px 12px 0 0;
        }
        
        .event-title {
            font-size: 20px;  /* Augmenté */
            font-weight: bold;
            margin: 0;
            line-height: 1.3;
            position: relative;
            z-index: 2;
            word-wrap: break-word;
        }
        
        .ticket-subtitle {
            font-size: 11px;  /* Augmenté */
            opacity: 0.95;
            margin: 8px 0 0 0;
            position: relative;
            z-index: 2;
        }
        
        .ticket-content {
            padding: 20px;  /* Augmenté */
        }
        
        .section-title {
            font-size: 12px;  /* Augmenté */
            color: #64707d;
            text-align: center;
            margin: 15px 0 15px 0;
            letter-spacing: 2px;
            font-weight: bold;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;  /* Augmenté */
            margin-bottom: 20px;  /* Augmenté */
        }
        
        .info-item {
            display: flex;
            flex-direction: column;
        }
        
        .info-label {
            font-size: 10px;  /* Augmenté */
            color: #64707d;
            margin-bottom: 5px;
            text-transform: uppercase;
            font-weight: 600;
        }
        
        .info-value {
            font-size: 13px;  /* Augmenté */
            color: #212b47;
            font-weight: bold;
            word-wrap: break-word;
        }
        
        .divider {
            height: 2px;  /* Augmenté */
            background: linear-gradient(90deg, transparent, #dee4eb, transparent);
            margin: 20px 0;  /* Augmenté */
        }
        
        .participant-section {
            margin: 20px 0;  /* Augmenté */
            padding: 15px;  /* Augmenté */
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 10px;
            border-left: 4px solid #667eea;
        }
        
        .participant-label {
            font-size: 10px;  /* Augmenté */
            color: #64707d;
            margin-bottom: 8px;
            text-transform: uppercase;
            font-weight: 600;
        }
        
        .participant-name {
            font-size: 16px;  /* Augmenté */
            color: #212b47;
            font-weight: bold;
        }
        
        /* Section de l'affiche */
        .poster-section {
            text-align: center;
            margin: 20px 0;  /* Augmenté */
            padding: 15px;  /* Augmenté */
            background: #f8f9fa;
            border-radius: 10px;
        }
        
        .poster-title {
            font-size: 10px;  /* Augmenté */
            color: #64707d;
            margin-bottom: 10px;
            text-transform: uppercase;
            font-weight: bold;
        }
        
        .poster-image {
            max-width: 100%;
            max-height: 80mm;  /* Augmenté */
            width: auto;
            height: auto;
            object-fit: contain;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        
        .qr-section {
            text-align: center;
            margin: 25px 0;  /* Augmenté */
        }
        
        .qr-container {
            display: inline-block;
            padding: 15px;  /* Augmenté */
            border: 2px dashed #96a8b6;
            border-radius: 12px;
            background: white;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .qr-image {
            width: 45mm !important;  /* Augmenté */
            height: 45mm !important;  /* Augmenté */
            object-fit: contain;
            display: block;
        }
        
        .qr-text {
            font-size: 10px;  /* Augmenté */
            color: #64707d;
            margin-top: 12px;
            text-align: center;
            font-weight: bold;
        }
        
        .security-section {
            text-align: center;
            margin-top: 25px;  /* Augmenté */
            padding: 15px;  /* Augmenté */
            background: linear-gradient(135deg, #f0f1f3 0%, #e2e3e5 100%);
            border-radius: 10px;
        }
        
        .security-title {
            font-size: 9px;  /* Augmenté */
            color: #64707d;
            font-weight: bold;
            margin: 5px 0;
            letter-spacing: 1px;
        }
        
        .security-subtitle {
            font-size: 8px;  /* Augmenté */
            color: #64707d;
            margin: 3px 0;
        }
        
        .brand-name {
            font-size: 11px;  /* Augmenté */
            color: #e11d48;
            font-weight: bold;
            margin-top: 8px;
        }
        
        .transaction-details {
            margin-top: 20px;  /* Augmenté */
            padding: 15px;  /* Augmenté */
            background: #f8f9fa;
            border-radius: 10px;
        }
        
        .transaction-row {
            display: flex;
            justify-content: space-between;
            margin: 8px 0;  /* Augmenté */
            font-size: 11px;  /* Augmenté */
        }
        
        .transaction-label {
            color: #64707d;
            font-weight: 600;
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
            width: 25px;
            height: 25px;
            background: #f5f5f5;
            border-radius: 50%;
            z-index: 2;
        }
        
        .ticket-container::before {
            top: -12px;
            left: -12px;
        }
        
        .ticket-container::after {
            top: -12px;
            right: -12px;
        }
        
        @media print {
            body {
                background: white;
                padding: 0;
                margin: 0;
            }
            
            .ticket-container {
                box-shadow: none;
                margin: 0 auto;
                page-break-inside: avoid;
                width: 120mm;
                height: auto;
            }
            
            .ticket-container::before,
            .ticket-container::after {
                background: white;
            }
            
            @page {
                size: 120mm auto;
                margin: 5mm;
            }
        }
        
        /* Responsive */
        @media (max-width: 120mm) {
            body {
                padding: 10px;
            }
            
            .ticket-container {
                width: 100%;
                max-width: 100%;
            }
        }
        
        /* Améliorations supplémentaires */
        .info-value.highlight {
            color: #e11d48;
            font-size: 14px;
        }
        
        .ticket-footer {
            margin-top: 5px;
            text-align: center;
            font-size: 7px;
            color: #64707d;
            padding: 10px;
            border-top: 1px solid #dee4eb;
        }
    </style>
</head>
<body>
    <!-- Ticket avec largeur augmentée et photo -->
    <div class="ticket-container">
        <!-- En-tête avec image d'arrière-plan conditionnelle -->
        <div class="ticket-header <?php echo !empty($ticket['photo_affiche']) ? 'has-poster' : ''; ?>" 
             <?php if(!empty($ticket['photo_affiche'])): ?> 
                 style="background-image: url('{{ env('ENV_POINT_URL') }}/storage/app/public/{{ $ticket['photo_affiche'] }}'); background-size: cover; background-position: center;"
             <?php endif; ?>>
            <h2 class="event-title">{{ $ticket['event_name'] ?? 'ÉVÉNEMENT' }}</h2>
            <p class="ticket-subtitle">Billet d'entrée #{{ $ticket['ticket_id'] ?? '000000' }}</p>
        </div>
        
        <!-- Contenu -->
        <div class="ticket-content">
            <!-- Affichage de l'affiche si disponible -->
            <?php if(!empty($ticket['photo_affiche'])): ?>
            <div class="poster-section">
                <div class="poster-title"> AFFICHE DE L'ÉVÉNEMENT</div>
                <img src="{{ env('ENV_POINT_URL') }}/storage/app/public/{{ $ticket['photo_affiche'] }}" 
                     class="poster-image" 
                     alt="Affiche événement"
                     loading="lazy">
            </div>
            <?php endif; ?>
            
            <!-- Informations du billet -->
            <h3 class="section-title"> INFORMATIONS DU BILLET</h3>
            
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label"> LIEU</span>
                    <span class="info-value">{{ $ticket['location'] ?? 'Non spécifié' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label"> CATÉGORIE</span>
                    <span class="info-value">{{ $ticket['type'] ?? 'Standard' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label"> QUANTITÉ</span>
                    <span class="info-value">{{ $ticket['quantity'] ?? '1' }} billet(s)</span>
                </div>
            </div>
            
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label"> DATE</span>
                    <span class="info-value">{{ $ticket['event_date'] ?? 'Date non définie' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label"> HEURE</span>
                    <span class="info-value">{{ $ticket['event_time'] ?? 'Horaire non défini' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label"> TOTAL</span>
                    <span class="info-value highlight">{{ $ticket['total'] ?? '0' }} {{ $ticket['devise'] ?? 'FCFA' }}</span>
                </div>
            </div>
            
            <!-- Divider -->
            <div class="divider"></div>
            
            <!-- Participant -->
            <div class="participant-section">
                <div class="participant-label">👤 PARTICIPANT</div>
                <div class="participant-name">{{ $ticket['user_name'] ?? 'Participant' }}</div>
            </div>
           
            <!-- QR Code agrandi -->
            <div class="qr-section">
                <div class="qr-container">
                    <img src="{{ $ticket['qrcode_url'] ?? 'https://quickchart.io/qr?text=TICKET_' . ($ticket['ticket_id'] ?? '000000') . '&size=200' }}" 
                         class="qr-image" 
                         alt="QR Code"
                         style="width: 45mm; height: 45mm; display: block; margin: 0 auto;">
                    
                    <div class="qr-text"> SCANNEZ-MOI À L'ENTRÉE</div>
                    <div class="qr-text" style="font-size: 9px; margin-top: 5px; color: #e11d48;">
                        ID: {{ $ticket['ticket_id'] ?? '000000' }}
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
                    <span class="transaction-value">{{ $ticket['price'] ?? '0' }} {{ $ticket['devise'] ?? 'FCFA' }}</span>
                </div>
                <?php if(!empty($ticket['transaction_id'])): ?>
                <div class="transaction-row">
                    <span class="transaction-label"> Transaction:</span>
                    <span class="transaction-value">{{ $ticket['transaction_id'] }}</span>
                </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="ticket-footer">
            Ce billet est valable pour une seule entrée
        </div>
    </div>
</body>
</html>