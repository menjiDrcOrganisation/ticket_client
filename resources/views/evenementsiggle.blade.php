<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $evenement['nom'] ?? 'Événement' }}</title>
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://unpkg.com/lucide@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</head>
<body class="bg-gray-100">

@if(isset($error))
    <p class="text-red-500 text-center mt-10">{{ $error }}</p>
@else
    <header class="relative bg-cover bg-center h-96 md:h-screen"
    style="background-image: url('http://127.0.0.1:8000/storage/{{ $evenement['ressource'][0]['photo_affiche'] ?? 'img/concert.jpg' }}');">
        <div class="absolute inset-0 bg-black opacity-60"></div>
        <div class="relative z-10 flex flex-col items-center justify-center h-full text-center px-4">
            <h1 class="text-3xl md:text-5xl font-bold text-white mb-4">{{ $evenement['nom'] }}</h1>
            <p class="text-white mb-6 max-w-xl">
                Salle: {{ $evenement['salle'] }} | Adresse: {{ $evenement['adresse'] }}
            </p>
            <p class="text-white mb-6 max-w-xl">
                Du {{ $evenement['date_debut'] }} {{ $evenement['heure_debut'] }} 
                au {{ $evenement['date_fin'] }} {{ $evenement['heure_fin'] }}
            </p>
            <p class="text-white mb-6 max-w-xl">Statut : {{ $evenement['statut'] }}</p>
        </div>
    </header>

    <section class="py-16 px-6">
        <h2 class="text-3xl font-bold text-center mb-10">Billets disponibles</h2>
        <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach($evenement['type_billets'] as $billet)
                <div class="bg-white rounded-xl shadow-lg p-8 flex flex-col items-center text-center transform hover:scale-105 transition">
                    <i data-lucide="ticket" class="w-12 h-12 text-red-600 mb-4"></i>
                    <h3 class="text-2xl font-semibold mb-2">{{ $billet['nom_type'] }}</h3>
                    <p class="text-xl mb-4">Nombre disponible : {{ $billet['pivot']['nombre_billet'] }}</p>
                    <a href="#!" class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-full font-bold">Acheter</a>
                </div>
            @endforeach
        </div>
    </section>
@endif

<footer class="bg-gray-900 text-white py-8 mt-12 text-center">
    © 2025 MenjiDrc. Tous droits réservés.
</footer>

<script>
    lucide.createIcons();
</script>
</body>
</html>
