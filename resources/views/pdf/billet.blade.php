<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            width: 300px;
            height: 500px;
        }
        .ticket {
            border: 2px solid #000;
            padding: 15px;
            background: white;
        }
        .header {
            background: black;
            color: white;
            text-align: center;
            padding: 10px;
            margin: -15px -15px 15px -15px;
            font-size: 18px;
            font-weight: bold;
        }
        .event-title {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .subtitle {
            text-align: center;
            font-size: 12px;
            color: #666;
            margin-bottom: 20px;
        }
        .info-table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }
        .info-table td {
            padding: 5px 0;
            border-bottom: 1px solid #eee;
        }
        .info-label {
            font-size: 10px;
            color: #666;
        }
        .info-value {
            font-size: 12px;
            font-weight: bold;
        }
        .qr-container {
            text-align: center;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            font-size: 10px;
            color: #999;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="ticket">
        <div class="header">PARTY PASS</div>
        
        <div class="event-title">{{ $eventName }}</div>
        <div class="subtitle">Trade Manager OP</div>
        
        <table class="info-table">
            <tr>
                <td class="info-label">Prix</td>
                <td class="info-label">Cilt</td>
                <td class="info-label">Nilt</td>
            </tr>
            <tr>
                <td class="info-value">15</td>
                <td class="info-value">Dout</td>
                <td class="info-value">#</td>
            </tr>
            <tr>
                <td class="info-label">Hru</td>
                <td class="info-label">Date</td>
                <td class="info-label">Temps</td>
            </tr>
            <tr>
                <td class="info-value">10g</td>
                <td class="info-value">{{ $eventDate }}</td>
                <td class="info-value">1:20h</td>
            </tr>
        </table>
        
        <div class="qr-container">
            <img src="{{ $qrCodeDataURL }}" width="120" height="120">
            <div style="font-size: 10px; margin-top: 5px;">Code: {{ $ticketCode }}</div>
        </div>
        
        <div class="footer">
            <div>Nom: {{ $clientName }}</div>
            <div style="margin-top: 5px;">MenjiDRC - www.menjidrc.com</div>
        </div>
    </div>
</body>
</html>