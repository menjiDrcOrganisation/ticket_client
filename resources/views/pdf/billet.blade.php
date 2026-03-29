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
    background: #f4f6f8;
    
    /* CENTRAGE VERTICAL + HORIZONTAL */
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

/* CONTAINER */
.ticket-container {
    width: 80mm;
    min-height: 180mm;
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    overflow: hidden;
    display: flex;
    flex-direction: column;
}

/* HEADER */
.ticket-header {
    position: relative;
    height: 90px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: white;
    background: linear-gradient(135deg, #0f172a, #1e293b);
}

.ticket-header::after {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.5);
}

.event-title {
    position: relative;
    z-index: 2;
    font-size: 14px;
    font-weight: bold;
}

.ticket-subtitle {
    position: relative;
    z-index: 2;
    font-size: 9px;
    margin-top: 4px;
}

/* CONTENT */
.ticket-content {
    padding: 12px;
    flex: 1;
}

/* GRID */
.info-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 8px;
    margin-bottom: 10px;
}

.info-item {
    display: flex;
    flex-direction: column;
}

.info-label {
    font-size: 7px;
    color: #6b7280;
    text-transform: uppercase;
}

.info-value {
    font-size: 10px;
    font-weight: bold;
    color: #111827;
}

/* PARTICIPANT */
.participant-section {
    background: #f9fafb;
    padding: 8px;
    border-radius: 6px;
    margin: 10px 0;
}

.participant-name {
    font-size: 12px;
    font-weight: bold;
}

/* QR */
.qr-section {
    text-align: center;
    margin: 15px 0;
}

.qr-container {
    border: 1px dashed #9ca3af;
    padding: 10px;
    border-radius: 8px;
    display: inline-block;
}

.qr-image {
    width: 35mm;
    height: 35mm;
}

.qr-text {
    font-size: 8px;
    margin-top: 5px;
}

/* FOOTER */
.security-section {
    background: #f3f4f6;
    padding: 10px;
    text-align: center;
}

.security-title {
    font-size: 7px;
    font-weight: bold;
}

.brand-name {
    font-size: 8px;
    color: #e11d48;
    font-weight: bold;
}

/* PRINT */
@media print {
    body {
        background: white;
        display: block;
    }

    .ticket-container {
        box-shadow: none;
        margin: auto;
        page-break-inside: avoid;
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