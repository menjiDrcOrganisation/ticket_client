<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #0f172a;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }

        .container {
            max-width: 500px;
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        p {
            font-size: 1.1rem;
            color: #cbd5f5;
        }

        .loader {
            margin: 30px auto;
            border: 5px solid #1e293b;
            border-top: 5px solid #38bdf8;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            100% {
                transform: rotate(360deg);
            }
        }

        .footer {
            margin-top: 20px;
            font-size: 0.9rem;
            color: #94a3b8;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Site en maintenance</h1>
        <p>Nous effectuons actuellement des améliorations.<br>
        Merci de revenir dans quelques instants.</p>

        <div class="loader"></div>

        <div class="footer">
            &copy; 2026 - Votre application
        </div>
    </div>

</body>
</html>