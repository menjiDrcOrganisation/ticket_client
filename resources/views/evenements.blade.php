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
        
        /* Styles pour la recherche et filtres */
        .search-filter-container {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            padding: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .search-box {
            position: relative;
            margin-bottom: 1.5rem;
        }
        
        .search-input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 3rem;
            border: 1px solid #e2e8f0;
            border-radius: 0.75rem;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .search-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(225, 29, 72, 0.1);
        }
        
        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
        }
        
        .filter-section {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            align-items: center;
        }
        
        .filter-group {
            display: flex;
            flex-direction: column;
            flex: 1;
            min-width: 150px;
        }
        
        .filter-label {
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: #475569;
        }
        
        .filter-select {
            padding: 0.5rem 1rem;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            background-color: white;
            cursor: pointer;
        }
        
        .filter-select:focus {
            outline: none;
            border-color: var(--primary);
        }
        
        .no-results {
            text-align: center;
            padding: 3rem 1rem;
            color: #64748b;
        }
        
        @media (max-width: 768px) {
            .filter-section {
                flex-direction: column;
                align-items: stretch;
            }
            
            .filter-group {
                min-width: 100%;
            }
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

            <!-- Barre de recherche et filtres -->
            <div class="search-filter-container fade-in">
                <div class="search-box">
                    <i data-lucide="search" class="search-icon w-5 h-5"></i>
                    <input type="text" id="search-input" class="search-input" placeholder="Rechercher un événement par nom...">
                </div>
                
                <div class="filter-section">
                    <!-- <div class="filter-group">
                        <label class="filter-label" for="status-filter">Statut</label>
                        <select id="status-filter" class="filter-select">
                            <option value="all">Tous les statuts</option>
                            <option value="Actif">Actif</option>
                            <option value="À venir">À venir</option>
                            <option value="Complet">Complet</option>
                        </select>
                    </div> -->
                    
                    <div class="filter-group">
                        <label class="filter-label" for="date-filter">Date</label>
                        <select id="date-filter" class="filter-select">
                            <option value="all">Toutes les dates</option>
                            <option value="today">Aujourd'hui</option>
                            <option value="week">Cette semaine</option>
                            <option value="month">Ce mois</option>
                            <option value="future">À venir</option>
                        </select>
                    </div>
                    
                    <!-- <div class="filter-group">
                        <label class="filter-label" for="location-filter">Lieu</label>
                        <select id="location-filter" class="filter-select">
                            <option value="all">Tous les lieux</option>
                            <option value="Salle Splendeur">Salle Splendeur</option>
                            <option value="13'Or Room">13'Or Room</option>
                            <option value="IMMEUBLE EXCELENCIA">IMMEUBLE EXCELENCIA</option>
                        </select>
                    </div> -->
                    
                    <div class="filter-group">
                        <label class="filter-label" for="price-filter">Prix</label>
                        <select id="price-filter" class="filter-select">
                            <option value="all">Tous les prix</option>
                            <option value="free">Gratuit</option>
                            <option value="low">Moins de 10$</option>
                            <option value="medium">10$ - 30$</option>
                            <option value="high">Plus de 30$</option>
                        </select>
                    </div>
                </div>
            </div>

            @if(isset($error))
                <div class="bg-red-50 border border-red-200 rounded-xl p-6 text-center max-w-2xl mx-auto fade-in">
                    <i data-lucide="alert-circle" class="w-12 h-12 text-red-500 mx-auto mb-4"></i>
                    <p class="text-red-700 text-lg">{{ $error }}</p>
                </div>
            @endif

            @if(!empty($evenements))
                <div id="events-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 stagger-animation">
                    @foreach($evenements as $evenement)
                        <div class="event-card bg-white rounded-2xl shadow-lg overflow-hidden group" 
                             data-name="{{ strtolower($evenement['nom']) }}"
                             data-status="{{ $evenement['statut'] }}"
                             data-date="{{ $evenement['date_debut'] }}"
                             data-location="{{ $evenement['salle'] }}"
                             data-price="{{ $evenement['type_billets'][0]['pivot']['prix'] ?? 0 }}">
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
                </div>
                
                <div class="ticket-card p-8 flex flex-col items-center text-center">
                    <div class="bg-purple-100 p-4 rounded-2xl mb-6">
                        <i data-lucide="star" class="w-12 h-12 text-purple-600"></i>
                    </div>
                    <h3 class="text-2xl font-semibold mb-3">Place Premium</h3>
                    <p class="text-gray-600 mb-6">Expérience complète avec avantages exclusifs</p>
                    <p class="text-4xl font-bold text-purple-600 mb-2">15 $</p>
                    <p class="text-sm text-gray-500 mb-6">Par personne</p>
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
        
        // Fonctionnalité de recherche et filtrage
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-input');
            const statusFilter = document.getElementById('status-filter');
            const dateFilter = document.getElementById('date-filter');
            const locationFilter = document.getElementById('location-filter');
            const priceFilter = document.getElementById('price-filter');
            const eventCards = document.querySelectorAll('.event-card');
            const eventsContainer = document.getElementById('events-container');
            
            // Fonction pour filtrer les événements
            function filterEvents() {
                const searchTerm = searchInput.value.toLowerCase();
                const statusValue = statusFilter.value;
                const dateValue = dateFilter.value;
                const locationValue = locationFilter.value;
                const priceValue = priceFilter.value;
                
                let visibleCount = 0;
                
                eventCards.forEach(card => {
                    const eventName = card.getAttribute('data-name');
                    const eventStatus = card.getAttribute('data-status');
                    const eventDate = new Date(card.getAttribute('data-date'));
                    const eventLocation = card.getAttribute('data-location');
                    const eventPrice = parseFloat(card.getAttribute('data-price'));
                    
                    // Vérifier la recherche par nom
                    const nameMatch = eventName.includes(searchTerm);
                    
                    // Vérifier le statut
                    const statusMatch = statusValue === 'all' || 
                        (statusValue === 'Actif' && eventStatus === 'Actif') ||
                        (statusValue === 'À venir' && eventStatus === 'À venir') ||
                        (statusValue === 'Complet' && eventStatus === 'Complet');
                    
                    // Vérifier la date
                    const today = new Date();
                    today.setHours(0, 0, 0, 0);
                    
                    const eventDateOnly = new Date(eventDate);
                    eventDateOnly.setHours(0, 0, 0, 0);
                    
                    let dateMatch = true;
                    if (dateValue !== 'all') {
                        if (dateValue === 'today') {
                            dateMatch = eventDateOnly.getTime() === today.getTime();
                        } else if (dateValue === 'week') {
                            const weekFromNow = new Date(today);
                            weekFromNow.setDate(today.getDate() + 7);
                            dateMatch = eventDateOnly >= today && eventDateOnly <= weekFromNow;
                        } else if (dateValue === 'month') {
                            const monthFromNow = new Date(today);
                            monthFromNow.setMonth(today.getMonth() + 1);
                            dateMatch = eventDateOnly >= today && eventDateOnly <= monthFromNow;
                        } else if (dateValue === 'future') {
                            dateMatch = eventDateOnly > today;
                        }
                    }
                    
                    // Vérifier le lieu
                    const locationMatch = locationValue === 'all' || 
                        eventLocation.toLowerCase().includes(locationValue.toLowerCase());
                    
                    // Vérifier le prix
                    let priceMatch = true;
                    if (priceValue !== 'all') {
                        if (priceValue === 'free') {
                            priceMatch = eventPrice === 0;
                        } else if (priceValue === 'low') {
                            priceMatch = eventPrice < 10;
                        } else if (priceValue === 'medium') {
                            priceMatch = eventPrice >= 10 && eventPrice <= 30;
                        } else if (priceValue === 'high') {
                            priceMatch = eventPrice > 30;
                        }
                    }
                    
                    // Afficher ou masquer la carte selon les critères
                    if (nameMatch && statusMatch && dateMatch && locationMatch && priceMatch) {
                        card.style.display = 'block';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });
                
                // Afficher un message si aucun événement ne correspond
                const noResults = document.getElementById('no-results');
                if (visibleCount === 0) {
                    if (!noResults) {
                        const noResultsDiv = document.createElement('div');
                        noResultsDiv.id = 'no-results';
                        noResultsDiv.className = 'no-results';
                        noResultsDiv.innerHTML = `
                            <i data-lucide="search-x" class="w-16 h-16 text-gray-400 mx-auto mb-4"></i>
                            <h3 class="text-xl font-semibold text-gray-500 mb-2">Aucun événement trouvé</h3>
                            <p class="text-gray-400">Essayez de modifier vos critères de recherche</p>
                        `;
                        eventsContainer.appendChild(noResultsDiv);
                        lucide.createIcons();
                    }
                } else if (noResults) {
                    noResults.remove();
                }
            }
            
            // Écouter les changements dans les filtres
            searchInput.addEventListener('input', filterEvents);
            statusFilter.addEventListener('change', filterEvents);
            dateFilter.addEventListener('change', filterEvents);
            locationFilter.addEventListener('change', filterEvents);
            priceFilter.addEventListener('change', filterEvents);
        });
    </script>

</body>
</html>