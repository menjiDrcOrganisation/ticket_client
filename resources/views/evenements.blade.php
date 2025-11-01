<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Événements</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans">

    <!-- Hero -->
    <header class="relative bg-cover bg-center h-96 md:h-screen" style="background-image: url('/img/concert.jpg');">
        <div class="absolute inset-0 bg-black opacity-60"></div>
        <div class="relative z-10 flex flex-col items-center justify-center h-full text-center px-4">
            <h1 class="text-3xl md:text-5xl font-bold text-white mb-4">Vivez une soirée inoubliable</h1>
            <p class="text-white mb-6 max-w-xl">Découvrez les événements les plus excitants et réservez vos billets dès maintenant !</p>
        </div>
    </header>

    <!-- Section Événements -->
    <section class="py-12 px-4 md:px-12">
        <h2 class="text-3xl font-bold text-center mb-10">Événements à venir</h2>

        @if(isset($error))
            <p class="text-red-600 text-center">{{ $error }}</p>
        @endif

        @if(!empty($evenements))
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($evenements as $evenement)
                    <div class="bg-white rounded-xl shadow-md p-6 flex flex-col justify-between">
                        <h3 class="text-2xl font-bold mb-2">{{ $evenement['nom'] }}</h3>
                        <p class="mb-1"><strong>Date :</strong> {{ $evenement['date_debut'] }} - {{ $evenement['date_fin'] }}</p>
                        <p class="mb-1"><strong>Adresse :</strong> {{ $evenement['adresse'] }}</p>
                        <p class="mb-1"><strong>Salle :</strong> {{ $evenement['salle'] }}</p>
                        <p class="mb-1"><strong>Statut :</strong> {{ $evenement['statut'] }}</p>
                        <p class="mb-2"><strong>Types de billets :</strong>
                            @if(!empty($evenement['type_billets']))
                                {{ implode(', ', array_map(function($b){ return $b['nom_type'].' ('.$b['pivot']['nombre_billet'].')'; }, $evenement['type_billets'])) }}
                            @else
                                Aucun billet
                            @endif
                        </p>
                        <a href="#billets" class="mt-auto bg-red-600 hover:bg-red-500 text-white px-4 py-2 rounded-lg text-center font-semibold transition">Réserver maintenant</a>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-gray-500">Aucun événement trouvé.</p>
        @endif
    </section>

    <!-- Infos pratiques -->
    <section class="bg-white py-12 px-6">
        <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <div>
                <div class="flex justify-center mb-2">
                    <i data-lucide="map-pin" class="w-10 h-10 text-red-600"></i>
                </div>
                <h3 class="text-xl font-semibold mb-1">Lieu</h3>
                <p>Salle Splendeur ex 13'Or Room, IMMEUBLE EXCELENCIA, Saio & Kasa-vubu Ref: Upak</p>
            </div>
            <div>
                <div class="flex justify-center mb-2">
                    <i data-lucide="calendar-days" class="w-10 h-10 text-red-600"></i>
                </div>
                <h3 class="text-xl font-semibold mb-1">Date</h3>
                <p>Dimanche 31 AOUT 2025</p>
            </div>
            <div>
                <div class="flex justify-center mb-2">
                    <i data-lucide="clock" class="w-10 h-10 text-red-600"></i>
                </div>
                <h3 class="text-xl font-semibold mb-1">Heure</h3>
                <p>À partir de 16h00</p>
            </div>
        </div>
    </section>

    <!-- Billetterie -->
    <section id="billets" class="py-16 bg-gray-100 px-6">
        <h2 class="text-3xl font-bold text-center mb-10">Réservez vos billets</h2>
        <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white rounded-xl shadow-lg p-8 flex flex-col items-center text-center transform hover:scale-105 transition">
                <i data-lucide="ticket" class="w-12 h-12 text-red-600 mb-4"></i>
                <h3 class="text-2xl font-semibold mb-2">Place Standard</h3>
                <p class="text-3xl font-bold text-red-600 mb-4">5 000 FC</p>
                <a href="#!" class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-full font-bold">Acheter</a>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-8 flex flex-col items-center text-center transform hover:scale-105 transition">
                <i data-lucide="ticket" class="w-12 h-12 text-red-600 mb-4"></i>
                <h3 class="text-2xl font-semibold mb-2">Place VIP</h3>
                <p class="text-3xl font-bold text-red-600 mb-4">10 $</p>
                <a href="#!" class="bg-yellow-400 hover:bg-yellow-500 text-black px-6 py-3 rounded-full font-bold">Acheter</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8 mt-12">
        <div class="max-w-5xl mx-auto text-center">
            <p class="mb-4">© 2025 MenjiDrc. Tous droits réservés.</p>
            <div class="flex justify-center space-x-6">
                <a href="#" class="hover:text-gray-400"><i data-lucide="facebook" class="w-6 h-6"></i></a>
                <a href="#" class="hover:text-gray-400"><i data-lucide="instagram" class="w-6 h-6"></i></a>
                <a href="#" class="hover:text-gray-400"><i data-lucide="mail" class="w-6 h-6"></i></a>
            </div>
        </div>
    </footer>

    <script>
        lucide.createIcons();
    </script>

</body>
</html>
