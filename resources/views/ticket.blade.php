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
      margin: 0; 
      padding: 20px;
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
      height: 250px;
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

    /* --- SECTION TICKET INFOS (Infinity War Layout) --- */

    .event-info {
      padding: 26px;
      user-select: text;
    }

    .category {
      font-size: 0.85rem;
      color: #64707d;
      margin-bottom: 2px;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    .title {
      font-size: 1.5rem;
      font-weight: 600;
      margin: 0 0 18px;
      color: #096dd9;
    }

    .grid-3 {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 16px;
      margin: 25px 0;
    }

    .label {
      font-size: 0.75rem;
      color: #64707d;
      display: block;
      margin-bottom: 4px;
    }

    .value {
      font-size: 1rem;
      font-weight: 600;
      color: #33475b;
    }

    .buyer {
      margin-top: 16px;
      font-size: 0.95rem;
      color: #33475b;
    }

    /* QR */

    .qr-container {
      background: #fff;
      border: 2px dashed #96a8b6;
      border-radius: 10px;
      padding: 18px;
      text-align: center;
      user-select: none;
      max-width: 200px;
      margin: 0 auto 28px;
      box-shadow: 0 3px 8px rgb(0 0 0 / 0.1);
    }

    .footer-text {
      font-size: 0.85rem;
      color: #64707d;
      padding: 0 28px 20px;
      line-height: 1.4;
      user-select: text;
      /* border-top: 1px solid #dee4eb; */
    }

    @media (max-width: 440px) {
      .party-pass {
        max-width: 360px;
      }
      .banner {
        font-size: 1.5rem;
        height: 120px;
      }
    }

  </style>
</head>

<body>

  <div class="party-pass" role="region" aria-label="Billet Party Pass">

    <div class="banner">PARTY PASS</div>

    <!-- --- INFOS VERSION "INFINITY WAR 2018" --- -->
    <div class="event-info">

      <p class="category">Party</p>
      <h2 class="title">Peace Vibes 2025</h2>

      <div class="grid-3">
        <div>
          <span class="label">Lieu</span>
          <span class="value">Stade des Martyrs</span>
        </div>
        <div>
          <span class="label">Catégorie</span>
          <span class="value">VIP</span>
        </div>
        <div>
          <span class="label">Prix</span>
          <span class="value">20 USD</span>
        </div>
      </div>

      <div class="grid-3" style="border-top: 1px solid #dee4eb;padding-top:25px">
        <div>
          <span class="label">Date</span>
          <span class="value">12 Juillet 2025</span>
        </div>
        <div>
          <span class="label">Heure</span>
          <span class="value">18h00</span>
        </div>
        <div>
          <span class="label">N° Ticket</span>
          <span class="value">KMT-2025-00157</span>
        </div>
      </div>

      <p class="buyer">Participant : Shekinah Kalala</p>

    </div>

    <!-- QR CODE -->
    <div class="qr-container">
      <canvas id="qr-code"></canvas>
    </div>

    <div class="footer-text">
      <p><strong>Billet nominatif – Non transférable</strong></p>
      <p>Ce billet est vérifié et sécurisé par <strong>Kima Tickets</strong>.</p> à 
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js"></script>

  <script>
    const qrCanvas = document.getElementById('qr-code');
    const qrOptions = {
      errorCorrectionLevel: 'H',
      margin: 2,
      width: 140,
      color: {
        dark: '#096dd9',
        light: '#f6f9fb'
      }
    };

    const qrData = 'https://kima.example.com/ticket/KMT-2025-00157';

    QRCode.toCanvas(qrCanvas, qrData, qrOptions, function (error) {
      if (error) console.error(error);
    });
  </script>

</body>
</html>
