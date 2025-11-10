<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Événements | MenjiDRC</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/scrollreveal"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #e11d48;
            --primary-dark: #be123c;
            --secondary: #0f172a;
            --accent: #f59e0b;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            scroll-behavior: smooth;
        }
        
        .hero-gradient {
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.8) 0%, rgba(225, 29, 72, 0.6) 100%);
        }
        
        .event-card {
            transition: all 0.3s ease;
            border-radius: 1rem;
            overflow: hidden;
        }
        
        .event-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }
        
        .ticket-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border-radius: 1rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .ticket-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary) 0%, var(--accent) 100%);
        }
        
        .ticket-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }
        
        .bg-pattern {
            background-image: radial-gradient(circle at 1px 1px, rgba(255, 255, 255, 0.1) 1px, transparent 0);
            background-size: 20px 20px;
        }
        
        .fade-in {
            animation: fadeIn 1s ease-in-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .slide-in-left {
            animation: slideInLeft 0.8s ease-out;
        }
        
        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-50px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        .slide-in-right {
            animation: slideInRight 0.8s ease-out;
        }
        
        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(50px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        .text-gradient {
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .stagger-animation > * {
            opacity: 0;
            transform: translateY(20px);
            animation: staggerFadeIn 0.6s ease forwards;
        }
        
        .stagger-animation > *:nth-child(1) { animation-delay: 0.1s }
        .stagger-animation > *:nth-child(2) { animation-delay: 0.2s }
        .stagger-animation > *:nth-child(3) { animation-delay: 0.3s }
        .stagger-animation > *:nth-child(4) { animation-delay: 0.4s }
        .stagger-animation > *:nth-child(5) { animation-delay: 0.5s }
        
        @keyframes staggerFadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .pulse-animation {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        .status-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            padding: 0.5rem 1rem;
            border-radius: 2rem;
            font-size: 0.875rem;
            font-weight: 600;
            z-index: 10;
        }
        
        .status-active {
            background: rgba(34, 197, 94, 0.2);
            color: #16a34a;
            border: 1px solid rgba(34, 197, 94, 0.3);
        }
        
        .status-upcoming {
            background: rgba(59, 130, 246, 0.2);
            color: #2563eb;
            border: 1px solid rgba(59, 130, 246, 0.3);
        }
        
        .status-soldout {
            background: rgba(239, 68, 68, 0.2);
            color: #dc2626;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }
        
        .event-image {
            height: 200px;
            background-size: cover;
            background-position: center;
            position: relative;
        }
        
        .event-image::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 60%;
            background: linear-gradient(transparent, rgba(0,0,0,0.7));
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <!-- Navigation -->
    <nav class="fixed top-0 left-0 w-full z-50 bg-white/80 backdrop-blur-md border-b border-gray-200">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center space-x-2 slide-in-left">
                <i data-lucide="ticket" class="w-8 h-8 text-red-600"></i>
                <span class="text-xl font-bold">Menji<span class="text-red-600">DRC</span></span>
            </div>
            
            <div class="hidden md:flex space-x-8 stagger-animation">
                <a href="#evenements" class="text-gray-600 hover:text-red-600 transition-colors font-medium">Événements</a>
                <!-- <a href="#infos" class="text-gray-600 hover:text-red-600 transition-colors font-medium">Infos</a> -->
                <a href="#billets" class="text-gray-600 hover:text-red-600 transition-colors font-medium">Billetterie</a>
                <a href="#contact" class="text-gray-600 hover:text-red-600 transition-colors font-medium">Contact</a>
            </div>
            
            <button id="menu-toggle" class="md:hidden text-gray-600">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>
        </div>
        
        <!-- Mobile menu -->
        <div id="mobile-menu" class="md:hidden bg-white border-t border-gray-200 hidden">
            <div class="container mx-auto px-4 py-4 flex flex-col space-y-4 stagger-animation">
                <a href="#evenements" class="text-gray-600 hover:text-red-600 transition-colors py-2 font-medium">Événements</a>
                <a href="#infos" class="text-gray-600 hover:text-red-600 transition-colors py-2 font-medium">Infos</a>
                <a href="#billets" class="text-gray-600 hover:text-red-600 transition-colors py-2 font-medium">Billetterie</a>
                <a href="#contact" class="text-gray-600 hover:text-red-600 transition-colors py-2 font-medium">Contact</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="relative bg-cover bg-center bg-fixed min-h-screen flex items-center justify-center pt-16" 
            style="background-image: url('https://images.unsplash.com/photo-1533174072545-7a4b6ad7a6c3?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');">
        <div class="absolute inset-0 hero-gradient"></div>
        
        <div class="absolute inset-0 bg-pattern"></div>

        <div class="relative z-10 text-center px-4 space-y-6 max-w-4xl mx-auto fade-in">
            <div class="inline-block bg-red-600/20 border border-red-500/30 rounded-full px-6 py-2 mb-4">
                <span class="text-red-100 text-sm font-medium uppercase tracking-wide">Événements Exclusifs</span>
            </div>
            
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold text-white mb-6">
                Vivez des <span class="text-gradient">expériences</span> inoubliables
            </h1>
            
            <p class="text-xl text-gray-200 mb-8 max-w-2xl mx-auto leading-relaxed">
                Découvrez les événements les plus excitants de Kinshasa et réservez vos billets en toute simplicité
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#evenements" class="bg-red-600 hover:bg-red-700 text-white px-8 py-4 rounded-full font-semibold transition-all duration-300 transform hover:scale-105 pulse-animation flex items-center justify-center gap-2">
                    <i data-lucide="calendar" class="w-5 h-5"></i>
                    Voir les événements
                </a>
                <a href="#billets" class="bg-white/20 hover:bg-white/30 text-white backdrop-blur-sm px-8 py-4 rounded-full font-semibold transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-2 border border-white/30">
                    <i data-lucide="ticket" class="w-5 h-5"></i>
                    Acheter des billets
                </a>
            </div>
        </div>
        
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce">
            <a href="#evenements" class="text-white">
                <i data-lucide="chevron-down" class="w-8 h-8"></i>
            </a>
        </div>
    </header>

    <!-- Section Événements -->
    <section id="evenements" class="py-20 px-4 md:px-12 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4 slide-in-left">Événements à venir</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto slide-in-right">
                    Découvrez notre sélection d'événements exceptionnels et réservez votre place dès maintenant
                </p>
            </div>

            @if(isset($error))
                <div class="bg-red-50 border border-red-200 rounded-xl p-6 text-center max-w-2xl mx-auto fade-in">
                    <i data-lucide="alert-circle" class="w-12 h-12 text-red-500 mx-auto mb-4"></i>
                    <p class="text-red-700 text-lg">{{ $error }}</p>
                </div>
            @endif

            @if(!empty($evenements))
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 stagger-animation">
                    @foreach($evenements as $evenement)
                        <div class="event-card bg-white rounded-2xl shadow-lg overflow-hidden group">
                            <!-- Badge de statut -->
                            @php
                                $statusClass = 'status-upcoming';
                                $statusText = 'À venir';
                                if ($evenement['statut'] === 'Actif') {
                                    $statusClass = 'status-active';
                                    $statusText = 'Actif';
                                } elseif ($evenement['statut'] === 'Complet') {
                                    $statusClass = 'status-soldout';
                                    $statusText = 'Complet';
                                }
                            @endphp
                            <div class="status-badge {{ $statusClass }}">
                                {{ $statusText }}
                            </div>
                            
                            <!-- Image de l'événement -->
                            <div class="event-image" 
                                 style="background-image: url('{{ $evenement['ressource'][0]['photo_affiche'] ?? 'https://images.unsplash.com/photo-1501281668745-f7f57925c3b4?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80' }}');">
                            </div>
                            
                            <!-- Contenu de la carte -->
                            <div class="p-6">
                                <h3 class="text-2xl font-bold mb-3 text-gray-800 group-hover:text-red-600 transition-colors">
                                    {{ $evenement['nom'] }}
                                </h3>
                                
                                <div class="space-y-3 mb-4">
                                    <div class="flex items-center gap-3 text-gray-600">
                                        <i data-lucide="calendar" class="w-4 h-4 text-red-500"></i>
                                        <span class="text-sm">
                                            {{ \Carbon\Carbon::parse($evenement['date_debut'])->translatedFormat('d F Y') }}
                                            @if($evenement['date_debut'] !== $evenement['date_fin'])
                                                - {{ \Carbon\Carbon::parse($evenement['date_fin'])->translatedFormat('d F Y') }}
                                            @endif
                                        </span>
                                    </div>
                                    
                                    <div class="flex items-center gap-3 text-gray-600">
                                        <i data-lucide="map-pin" class="w-4 h-4 text-red-500"></i>
                                        <span class="text-sm">{{ $evenement['salle'] }}, {{ $evenement['adresse'] }}</span>
                                    </div>
                                    
                                    @if(!empty($evenement['type_billets']))
                                    <div class="flex items-center gap-3 text-gray-600">
                                        <i data-lucide="ticket" class="w-4 h-4 text-red-500"></i>
                                        <span class="text-sm">
                                            {{ count($evenement['type_billets']) }} type(s) de billet disponible(s)
                                        </span>
                                    </div>
                                    @endif
                                </div>
                                
                                <!-- Types de billets -->
                                @if(!empty($evenement['type_billets']))
                                    <div class="mb-6">
                                        <div class="flex flex-wrap gap-2">
                                            @foreach(array_slice($evenement['type_billets'], 0, 3) as $billet)
                                                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs font-medium">
                                                    {{ $billet['nom_type'] }} ({{ $billet['pivot']['nombre_billet'] }})
                                                </span>
                                            @endforeach
                                            @if(count($evenement['type_billets']) > 3)
                                                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs font-medium">
                                                    +{{ count($evenement['type_billets']) - 3 }} autres
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                
                                <a href="/evenement/{{ $evenement['id'] ?? '1' }}" 
                                   class="w-full bg-red-600 hover:bg-red-700 text-white py-3 rounded-lg font-semibold transition-all duration-300 flex items-center justify-center gap-2 group-hover:scale-105">
                                    <i data-lucide="eye" class="w-4 h-4"></i>
                                    Voir détails
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12 fade-in">
                    <i data-lucide="calendar-x" class="w-16 h-16 text-gray-400 mx-auto mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-500 mb-2">Aucun événement trouvé</h3>
                    <p class="text-gray-400">Revenez bientôt pour découvrir nos prochains événements</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Section Infos pratiques -->
    <section id="infos" class="py-20 bg-gray-50 px-6">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4 slide-in-left">Informations pratiques</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto slide-in-right">
                    Tout ce que vous devez savoir pour profiter au maximum de votre expérience
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 stagger-animation">
                <div class="bg-white rounded-2xl shadow-lg p-8 text-center transform hover:scale-105 transition duration-300">
                    <div class="flex justify-center mb-4">
                        <div class="bg-red-100 p-4 rounded-2xl">
                            <i data-lucide="map-pin" class="w-8 h-8 text-red-600"></i>
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Lieu</h3>
                    <p class="text-gray-600">Salle Splendeur ex 13'Or Room, IMMEUBLE EXCELENCIA, Saio & Kasa-vubu Ref: Upak</p>
                </div>
                
                <div class="bg-white rounded-2xl shadow-lg p-8 text-center transform hover:scale-105 transition duration-300">
                    <div class="flex justify-center mb-4">
                        <div class="bg-blue-100 p-4 rounded-2xl">
                            <i data-lucide="calendar-days" class="w-8 h-8 text-blue-600"></i>
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Date</h3>
                    <p class="text-gray-600">Dimanche 31 Août 2025</p>
                </div>
                
                <div class="bg-white rounded-2xl shadow-lg p-8 text-center transform hover:scale-105 transition duration-300">
                    <div class="flex justify-center mb-4">
                        <div class="bg-green-100 p-4 rounded-2xl">
                            <i data-lucide="clock" class="w-8 h-8 text-green-600"></i>
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Heure</h3>
                    <p class="text-gray-600">À partir de 16h00</p>
                </div>
            </div>
            
            <!-- Informations supplémentaires -->
            <!-- <div class="mt-12 bg-white rounded-2xl shadow-lg p-8 stagger-animation">
                <h3 class="text-2xl font-bold mb-6 text-center">Services sur place</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 text-center">
                    <div class="flex flex-col items-center">
                        <i data-lucide="utensils" class="w-10 h-10 text-red-600 mb-3"></i>
                        <p class="font-medium">Restauration</p>
                    </div>
                    <div class="flex flex-col items-center">
                        <i data-lucide="car" class="w-10 h-10 text-red-600 mb-3"></i>
                        <p class="font-medium">Parking sécurisé</p>
                    </div>
                    <div class="flex flex-col items-center">
                        <i data-lucide="wheelchair" class="w-10 h-10 text-red-600 mb-3"></i>
                        <p class="font-medium">Accès PMR</p>
                    </div>
                    <div class="flex flex-col items-center">
                        <i data-lucide="wifi" class="w-10 h-10 text-red-600 mb-3"></i>
                        <p class="font-medium">Wi-Fi gratuit</p>
                    </div>
                </div>
            </div> -->
        </div>
    </section>

    <!-- Section Billetterie -->
    <section id="billets" class="py-20 bg-white px-6">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4 slide-in-left">Réservez vos billets</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto slide-in-right">
                    Choisissez la formule qui correspond le mieux à vos attentes
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 stagger-animation">
                <div class="ticket-card p-8 flex flex-col items-center text-center">
                    <div class="bg-red-100 p-4 rounded-2xl mb-6">
                        <i data-lucide="ticket" class="w-12 h-12 text-red-600"></i>
                    </div>
                    <h3 class="text-2xl font-semibold mb-3">Place Standard</h3>
                    <p class="text-gray-600 mb-6">Accès à l'événement avec placement libre</p>
                    <p class="text-4xl font-bold text-red-600 mb-2">5 000 FC</p>
                    <p class="text-sm text-gray-500 mb-6">Par personne</p>
                    <!-- <a href="#!" class="w-full bg-red-600 hover:bg-red-700 text-white py-3 rounded-full font-bold transition-all duration-300 transform hover:scale-105">
                        Acheter maintenant
                    </a> -->
                </div>
                
                <div class="ticket-card p-8 flex flex-col items-center text-center transform scale-105 relative">
                    <div class="absolute top-0 right-0 bg-yellow-400 text-black px-4 py-1 rounded-bl-xl rounded-tr-xl text-sm font-bold">
                        Populaire
                    </div>
                    <div class="bg-yellow-100 p-4 rounded-2xl mb-6">
                        <i data-lucide="crown" class="w-12 h-12 text-yellow-600"></i>
                    </div>
                    <h3 class="text-2xl font-semibold mb-3">Place VIP</h3>
                    <p class="text-gray-600 mb-6">Accès privilégié avec services exclusifs</p>
                    <p class="text-4xl font-bold text-yellow-600 mb-2">10 $</p>
                    <p class="text-sm text-gray-500 mb-6">Par personne</p>
                    <!-- <a href="#!" class="w-full bg-yellow-400 hover:bg-yellow-500 text-black py-3 rounded-full font-bold transition-all duration-300 transform hover:scale-105">
                        Acheter maintenant
                    </a> -->
                </div>
                
                <div class="ticket-card p-8 flex flex-col items-center text-center">
                    <div class="bg-purple-100 p-4 rounded-2xl mb-6">
                        <i data-lucide="star" class="w-12 h-12 text-purple-600"></i>
                    </div>
                    <h3 class="text-2xl font-semibold mb-3">Place Premium</h3>
                    <p class="text-gray-600 mb-6">Expérience complète avec avantages exclusifs</p>
                    <p class="text-4xl font-bold text-purple-600 mb-2">15 $</p>
                    <p class="text-sm text-gray-500 mb-6">Par personne</p>
                    <!-- <a href="#!" class="w-full bg-purple-600 hover:bg-purple-700 text-white py-3 rounded-full font-bold transition-all duration-300 transform hover:scale-105">
                        Acheter maintenant
                    </a> -->
                </div>
            </div>
            
            <!-- Information de paiement -->
            <div class="mt-12 text-center fade-in">
                <p class="text-gray-600 mb-4">Paiement sécurisé accepté :</p>
                <div class="flex justify-center gap-6 text-gray-400">
                    <i data-lucide="credit-card" class="w-8 h-8"></i>
                    <i data-lucide="smartphone" class="w-8 h-8"></i>
                    <i data-lucide="shield" class="w-8 h-8"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact" class="bg-gray-900 text-white py-12">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8 stagger-animation">
                <div class="md:col-span-2">
                    <div class="flex items-center space-x-2 mb-4">
                        <i data-lucide="ticket" class="w-8 h-8 text-red-500"></i>
                        <span class="text-xl font-bold">Menji<span class="text-red-500">DRC</span></span>
                    </div>
                    <p class="text-gray-400 mb-6">
                        Votre plateforme de billetterie de confiance pour les meilleurs événements en République Démocratique du Congo.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="social-icon bg-gray-800 p-3 rounded-full text-gray-300 hover:bg-red-600 hover:text-white transition-all duration-300">
                            <i data-lucide="facebook" class="w-5 h-5"></i>
                        </a>
                        <a href="#" class="social-icon bg-gray-800 p-3 rounded-full text-gray-300 hover:bg-red-600 hover:text-white transition-all duration-300">
                            <i data-lucide="twitter" class="w-5 h-5"></i>
                        </a>
                        <a href="#" class="social-icon bg-gray-800 p-3 rounded-full text-gray-300 hover:bg-red-600 hover:text-white transition-all duration-300">
                            <i data-lucide="instagram" class="w-5 h-5"></i>
                        </a>
                        <a href="#" class="social-icon bg-gray-800 p-3 rounded-full text-gray-300 hover:bg-red-600 hover:text-white transition-all duration-300">
                            <i data-lucide="youtube" class="w-5 h-5"></i>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4">Liens rapides</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#evenements" class="hover:text-white transition-colors">Événements</a></li>
                        <li><a href="#infos" class="hover:text-white transition-colors">Infos pratiques</a></li>
                        <li><a href="#billets" class="hover:text-white transition-colors">Billetterie</a></li>
                        <li><a href="#contact" class="hover:text-white transition-colors">Contact</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4">Contact</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li class="flex items-center gap-2">
                            <i data-lucide="mail" class="w-4 h-4"></i>
                            <span>contact@menjidrc.com</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="phone" class="w-4 h-4"></i>
                            <span>+243 XX XXX XXX</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="map-pin" class="w-4 h-4"></i>
                            <span>Kinshasa, RDC</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="pt-8 border-t border-gray-800 text-center text-gray-500 fade-in">
                <p>© {{ date('Y') }} Menji DRC — Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <script>
        lucide.createIcons();
        
        // Menu mobile
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        
        if (menuToggle && mobileMenu) {
            menuToggle.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
                const icon = menuToggle.querySelector('i');
                if (mobileMenu.classList.contains('hidden')) {
                    icon.setAttribute('data-lucide', 'menu');
                } else {
                    icon.setAttribute('data-lucide', 'x');
                }
                lucide.createIcons();
            });
        }
        
        // Animation d'apparition
        ScrollReveal().reveal('.slide-in-left', { 
            delay: 200, 
            distance: '50px', 
            origin: 'left',
            duration: 800
        });
        
        ScrollReveal().reveal('.slide-in-right', { 
            delay: 200, 
            distance: '50px', 
            origin: 'right',
            duration: 800
        });
        
        ScrollReveal().reveal('.fade-in', { 
            delay: 300, 
            duration: 1000 
        });
        
        // Smooth scrolling pour les ancres
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>

</body>
</html>