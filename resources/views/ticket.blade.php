<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>KIMA TICKETS - Party Pass</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

    body {
      background: #f0f2f5;
      font-family: 'Poppins', sans-serif;
      margin: 0; padding: 20px;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      min-height: 100vh;
      color: #212b47;
    }

    .party-pass {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgb(0 0 0 / 0.1);
      max-width: 400px;
      width: 100%;
      overflow: hidden;
      border: 2px solid #096dd9;
    }

    .header-info {
      background: #f7f9fc;
      padding: 16px 24px;
      border-bottom: 2px solid #096dd9;
      font-size: 0.9rem;
      color: #4a5a75;
      font-weight: 500;
      text-align: center;
      line-height: 1.4;
      user-select: none;
    }

    .header-info small {
      font-style: italic;
      color: #64707d;
      display: block;
      margin-top: 6px;
    }

    .banner {
      position: relative;
      height: 140px;
      background: url('https://images.unsplash.com/photo-1506744038136-46273834b3fb?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80') center/cover no-repeat;
      display: flex;
      justify-content: center;
      align-items: center;
      color: #fff;
      font-weight: 700;
      font-size: 1.8rem;
      text-shadow: 2px 2px 6px rgba(0,0,0,0.7);
      letter-spacing: 2px;
      user-select: none;
    }

    .event-info {
      padding: 20px 28px 28px;
      font-size: 1rem;
      color: #33475b;
      line-height: 1.5;
      user-select: text;
    }

    .event-info p {
      margin: 8px 0;
    }

    .event-info p.bold {
      font-weight: 600;
      color: #096dd9;
    }

    .footer-text {
      font-size: 0.85rem;
      color: #64707d;
      padding: 0 28px 20px;
      line-height: 1.4;
      user-select: text;
      border-top: 1px solid #dee4eb;
    }

    .qr-container {
      background: #fff;
      border: 2px dashed #96a8b6;
      border-radius: 10px;
      padding: 18px;
      text-align: center;
      user-select: none;
      max-width: 180px;
      margin: 0 auto 28px;
      box-shadow: 0 3px 8px rgb(0 0 0 / 0.1);
    }

    /* Responsive */
    @media (max-width: 440px) {
      .party-pass {
        max-width: 360px;
      }
      .banner {
        font-size: 1.5rem;
        height: 120px;
      }
      .event-info {
        padding: 16px 20px 24px;
        font-size: 0.95rem;
      }
      .footer-text {
        padding: 0 20px 16px;
      }
    }
  </style>
</head>
<body>

  <div class="party-pass" role="region" aria-label="Billet Party Pass">

    <div class="header-info">
      <div><strong>KIMA TICKETS</strong>  |  by Menji DRC</div>
      <small>"La paix entre vous et vos événements"</small>
    </div>

    <div class="banner" aria-level="1" role="heading">PARTY PASS</div>

    <div class="event-info" aria-label="Informations de l'événement">
      <p class="bold">Concert Peace Vibes 2025</p>
      <p>📍 Stade des Martyrs | Kinshasa</p>
      <p>📅 12 Juillet 2025 | 🕒 18h00</p>
      <p>Catégorie : VIP</p>
      <p>Prix : 20 USD</p>
      <p>N° Billet : KMT-2025-00157</p>
      <p>Acheté le : 02 Juillet 2025</p>
      <p>Participant : Shekinah Kalala</p>
    </div>

    <div class="footer-text">
      <p><strong>Billet nominatif – Non transférable</strong></p>
      <p>Ce billet est vérifié et sécurisé par <strong>Kima Tickets</strong>.</p>
    </div>

    <div class="qr-container" aria-label="Code QR pour la validation">
      <canvas id="qr-code"></canvas>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js"></script>
  <script>
    const qrCanvas = document.getElementById('qr-code');
    const qrOptions = {
      errorCorrectionLevel: 'H',
      margin: 2,
      color: {
        dark: '#096dd9', // bleu
        light: '#f6f9fb' // fond clair
      },
      width: 140,
    };
    // Exemple : lien QR code personnalisé
    const qrData = 'https://kima.example.com/ticket/KMT-2025-00157';

    QRCode.toCanvas(qrCanvas, qrData, qrOptions, function (error) {
      if (error) console.error(error);
    });
  </script>

</body>
</html>