<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Kimiaticket Menjidrc</title>
    
<!-- Favicon : logo dans l'onglet -->
<link rel="icon" href="{{ asset('icons/Icone_Kimia.png') }}" type="image/png" />

<!-- Optionnel : favicon pour Apple touch (iPhone/iPad) -->
<link rel="apple-touch-icon" href="{{ asset('icons/Icone_Kimia.png') }}" />


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
            overflow-x: hidden;
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
            width: 100%;
            box-sizing: border-box;
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
            box-sizing: border-box;
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
            align-items: flex-start;
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
            width: 100%;
            box-sizing: border-box;
        }
        
        .filter-select:focus {
            outline: none;
            border-color: var(--primary);
        }
        
        .no-results {
            text-align: center;
            padding: 3rem 1rem;
            color: #64748b;
            width: 100%;
            grid-column: 1 / -1;
        }
        
        /* Responsive amélioré */
        @media (max-width: 768px) {
            .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }
            
            .hero-title {
                font-size: 2.25rem !important;
                line-height: 1.2;
                text-align: center;
            }
            
            .hero-subtitle {
                font-size: 1.125rem !important;
                text-align: center;
                padding: 0 0.5rem;
            }
            
            .section-title {
                font-size: 2rem !important;
                text-align: center;
                line-height: 1.3;
            }
            
            .section-subtitle {
                font-size: 1.125rem !important;
                text-align: center;
                padding: 0 0.5rem;
            }
            
            .event-card {
                margin: 0 auto;
                max-width: 100%;
            }
            
            .ticket-card {
                transform: none !important;
                margin-bottom: 1.5rem;
            }
            
            .filter-section {
                flex-direction: column;
                gap: 0.75rem;
            }
            
            .filter-group {
                min-width: 100%;
                width: 100%;
            }
            
            .search-filter-container {
                padding: 1rem;
                margin-left: 0;
                margin-right: 0;
            }
            
            .event-image {
                height: 180px;
            }
            
            .status-badge {
                padding: 0.375rem 0.75rem;
                font-size: 0.75rem;
            }
            
            .mobile-padding {
                padding-left: 1rem;
                padding-right: 1rem;
            }
            
            .mobile-text-center {
                text-align: center;
            }
            
            .card-title {
                font-size: 1.5rem !important;
                text-align: center;
            }
            
            .card-text {
                font-size: 0.875rem !important;
                text-align: center;
            }
            
            .info-card {
                padding: 1.5rem !important;
            }
            
            .info-card h3 {
                font-size: 1.25rem !important;
            }
            
            .ticket-price {
                font-size: 2.5rem !important;
            }
        }
        
        @media (max-width: 640px) {
            .hero-title {
                font-size: 2rem !important;
            }
            
            .section-title {
                font-size: 1.75rem !important;
            }
            
            .hero-subtitle,
            .section-subtitle {
                font-size: 1rem !important;
            }
        }
        
        @media (max-width: 480px) {
            .hero-title {
                font-size: 1.75rem !important;
            }
            
            .section-title {
                font-size: 1.5rem !important;
            }
            
            .event-image {
                height: 160px;
            }
            
            .search-input {
                font-size: 0.875rem;
                padding: 0.625rem 0.875rem 0.625rem 2.5rem;
            }
            
            .search-icon {
                left: 0.875rem;
            }
            
            .card-title {
                font-size: 1.25rem !important;
            }
            
            .ticket-price {
                font-size: 2rem !important;
            }
            
            .info-card {
                padding: 1rem !important;
            }
        }
        
        @media (max-width: 360px) {
            .hero-title {
                font-size: 1.5rem !important;
            }
            
            .section-title {
                font-size: 1.375rem !important;
            }
            
            .event-image {
                height: 140px;
            }
            
            .hero-subtitle,
            .section-subtitle {
                font-size: 0.875rem !important;
            }
        }
        
        /* Correction des débordements */
        * {
            box-sizing: border-box;
        }
        
        img, video {
            max-width: 100%;
            height: auto;
        }
        
        .overflow-fix {
            overflow: hidden;
        }
        
        /* Centrage forcé pour tous les textes sur mobile */
        @media (max-width: 768px) {
            .text-center-mobile {
                text-align: center !important;
            }
            
            .mx-auto-mobile {
                margin-left: auto !important;
                margin-right: auto !important;
            }
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 overflow-x-hidden">

    <!-- Navigation -->
    <nav class="fixed top-0 left-0 w-full z-50 bg-white/80 backdrop-blur-md border-b border-gray-200 overflow-fix">
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
        <div id="mobile-menu" class="md:hidden bg-white border-t border-gray-200 hidden overflow-fix">
            <div class="container mx-auto px-4 py-4 flex flex-col space-y-4 stagger-animation text-center-mobile">
                <a href="#evenements" class="text-gray-600 hover:text-red-600 transition-colors py-2 font-medium">Événements</a>
                <a href="#billets" class="text-gray-600 hover:text-red-600 transition-colors py-2 font-medium">Billetterie</a>
                <a href="#contact" class="text-gray-600 hover:text-red-600 transition-colors py-2 font-medium">Contact</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="relative bg-cover bg-center bg-fixed min-h-screen flex items-center justify-center pt-16 overflow-fix" 
            style="background-image: url('https://images.unsplash.com/photo-1533174072545-7a4b6ad7a6c3?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');">
        <div class="absolute inset-0 hero-gradient"></div>
        
        <div class="absolute inset-0 bg-pattern"></div>

        <div class="relative z-10 text-center px-4 space-y-6 max-w-4xl mx-auto fade-in w-full mobile-padding">
            <div class="inline-block bg-red-600/20 border border-red-500/30 rounded-full px-6 py-2 mb-4 mx-auto-mobile">
                <span class="text-red-100 text-sm font-medium uppercase tracking-wide">Événements Exclusifs</span>
            </div>
            
            <h1 class="hero-title text-4xl md:text-6xl lg:text-7xl font-extrabold text-white mb-6 text-center-mobile">
                Vivez des <span class="text-gradient">expériences</span> inoubliables
            </h1>
            
            <p class="hero-subtitle text-xl text-gray-200 mb-8 max-w-2xl mx-auto leading-relaxed text-center-mobile">
                Découvrez les événements les plus excitants de Kinshasa et réservez vos billets en toute simplicité
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center mx-auto-mobile">
                <a href="#evenements" class="bg-red-600 hover:bg-red-700 text-white px-6 sm:px-8 py-3 sm:py-4 rounded-full font-semibold transition-all duration-300 transform hover:scale-105 pulse-animation flex items-center justify-center gap-2 text-center-mobile">
                    <i data-lucide="calendar" class="w-5 h-5"></i>
                    Voir les événements
                </a>
                <a href="#billets" class="bg-white/20 hover:bg-white/30 text-white backdrop-blur-sm px-6 sm:px-8 py-3 sm:py-4 rounded-full font-semibold transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-2 border border-white/30 text-center-mobile">
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
    <section id="evenements" class="py-16 sm:py-20 px-4 md:px-12 bg-white overflow-fix">
        <div class="max-w-7xl mx-auto w-full">
            <div class="text-center mb-12 sm:mb-16 mobile-padding">
                <h2 class="section-title text-3xl sm:text-4xl font-bold mb-4  text-center-mobile">
                    Événements à venir
                </h2>
                <p class="section-subtitle text-lg sm:text-xl text-gray-600 max-w-2xl mx-auto  text-center-mobile">
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
                        <label class="filter-label text-center-mobile" for="status-filter">Statut</label>
                        <select id="status-filter" class="filter-select">
                            <option value="all">Tous les statuts</option>
                            <option value="Actif">Actif</option>
                            <option value="À venir">À venir</option>
                            <option value="Complet">Complet</option>
                        </select>
                    </div> -->
                    
                    <div class="filter-group">
                        <label class="filter-label text-center-mobile" for="date-filter">Date</label>
                        <select id="date-filter" class="filter-select">
                            <option value="all">Toutes les dates</option>
                            <option value="today">Aujourd'hui</option>
                            <option value="week">Cette semaine</option>
                            <option value="month">Ce mois</option>
                            <option value="future">À venir</option>
                        </select>
                    </div>
                    
                    <!-- <div class="filter-group">
                        <label class="filter-label text-center-mobile" for="location-filter">Lieu</label>
                        <select id="location-filter" class="filter-select">
                            <option value="all">Tous les lieux</option>
                            <option value="Salle Splendeur">Salle Splendeur</option>
                            <option value="13'Or Room">13'Or Room</option>
                            <option value="IMMEUBLE EXCELENCIA">IMMEUBLE EXCELENCIA</option>
                        </select>
                    </div> -->
                    
                    <div class="filter-group">
                        <label class="filter-label text-center-mobile" for="price-filter">Prix</label>
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

          

            @if(!empty($evenements))
                <div id="events-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8 stagger-animation">
                    @foreach($evenements as $evenement)
                        <div class="event-card bg-white rounded-2xl shadow-lg overflow-hidden group mx-auto-mobile" 
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
                                 style="background-image: url('https://gestionticket.menjidrc.com/storage/app/public/{{
                $evenement['ressource'][0]['photo_affiche'] ?? 'https://images.unsplash.com/photo-1501281668745-f7f57925c3b4?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80' }}');">
                            </div>
                            
                            <!-- Contenu de la carte -->
                            <div class="p-4 sm:p-6">
                                <h3 class="card-title text-xl sm:text-2xl font-bold mb-3 text-gray-800 group-hover:text-red-600 transition-colors text-center-mobile">
                                    {{ $evenement['nom'] }}
                                </h3>
                                
                                <div class="space-y-2 sm:space-y-3 mb-4">
                                    <div class="flex items-center gap-3 text-gray-600">
                                        <i data-lucide="calendar" class="w-4 h-4 text-red-500 flex-shrink-0"></i>
                                        <span class="card-text text-sm">
                                            {{ \Carbon\Carbon::parse($evenement['date_debut'])->translatedFormat('d F Y') }}
                                            @if($evenement['date_debut'] !== $evenement['date_fin'])
                                                - {{ \Carbon\Carbon::parse($evenement['date_fin'])->translatedFormat('d F Y') }}
                                            @endif
                                        </span>
                                    </div>
                                    
                                    <div class="flex items-center gap-3 text-gray-600">
                                        <i data-lucide="map-pin" class="w-4 h-4 text-red-500 flex-shrink-0"></i>
                                        <span class="card-text text-sm">{{ $evenement['salle'] }}, {{ $evenement['adresse'] }}</span>
                                    </div>
                                    
                                    @if(!empty($evenement['type_billets']))
                                    <div class="flex items-center gap-3 text-gray-600">
                                        <i data-lucide="ticket" class="w-4 h-4 text-red-500 flex-shrink-0"></i>
                                        <span class="card-text text-sm">
                                            {{ count($evenement['type_billets']) }} type(s) de billet disponible(s)
                                        </span>
                                    </div>
                                    @endif
                                </div>
                                
                                <!-- Types de billets -->
                                @if(!empty($evenement['type_billets']))
                                    <div class="mb-4 sm:mb-6">
                                        <div class="flex flex-wrap gap-2 justify-center sm:justify-start">
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
                                
                                <a href="/{{ $evenement['url_evenement'] ?? '1' }}" 
                                   class="w-full bg-red-600 hover:bg-red-700 text-white py-3 rounded-lg font-semibold transition-all duration-300 flex items-center justify-center gap-2 group-hover:scale-105">
                                    <i data-lucide="eye" class="w-4 h-4"></i>
                                    Acheter
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12 fade-in mobile-padding text-center-mobile">
                    <i data-lucide="calendar-x" class="w-16 h-16 text-gray-400 mx-auto mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-500 mb-2">Aucun événement trouvé</h3>
                    <p class="text-gray-400">Revenez bientôt pour découvrir nos prochains événements</p>
                </div>
            @endif

            
        </div>
    </section>


    <footer id="contact" class="bg-gray-900 text-white py-12">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8 stagger-animation">
                <div class="md:col-span-2">
                    <div class="flex items-center space-x-2 mb-4">
                        <i data-lucide="ticket" class="w-8 h-8 text-red-500"></i>
                        <span class="text-xl font-bold">Menji<span class="text-red-500">DRC</span></span>
                    </div>
                    <p class="text-gray-400 mb-6 text-center md:text-left">
                        Votre plateforme de billetterie de confiance pour les meilleurs événements en République Démocratique du Congo.
                    </p>
                    <div class="flex space-x-4 justify-center md:justify-start">
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
                
                <div class="text-center-mobile">
                    <h4 class="text-lg font-semibold mb-4">Liens rapides</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#evenements" class="hover:text-white transition-colors">Événements</a></li>
                        <li><a href="#billets" class="hover:text-white transition-colors">Billetterie</a></li>
                        <li><a href="#contact" class="hover:text-white transition-colors">Contact</a></li>
                    </ul>
                </div>
                
                <div class="text-center-mobile">
                    <h4 class="text-lg font-semibold mb-4">Contact</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li class="flex items-center gap-2 justify-center md:justify-start">
                            <i data-lucide="mail" class="w-4 h-4"></i>
                            <span>kimia@formation.menjidrc.com</span>
                        </li>
                        <li class="flex items-center gap-2 justify-center md:justify-start">
                            <i data-lucide="phone" class="w-4 h-4"></i>
                            <span>+243 847 473 745</span>
                        </li>
                        <li class="flex items-center gap-2 justify-center md:justify-start">
                            <i data-lucide="map-pin" class="w-4 h-4"></i>
                            <span>Kinshasa, RDC</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="pt-8 border-t border-gray-800 text-center text-gray-500 fade-in text-center-mobile">
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
        
        // FONCTIONNALITÉ DE FILTRAGE AMÉLIORÉE
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-input');
            // const statusFilter = document.getElementById('status-filter');
            const dateFilter = document.getElementById('date-filter');
            // const locationFilter = document.getElementById('location-filter');
            const priceFilter = document.getElementById('price-filter');
            const eventCards = document.querySelectorAll('.event-card');
            const eventsContainer = document.getElementById('events-container');
            
            // Fonction pour formater la date
            function formatDate(dateString) {
                const date = new Date(dateString);
                return date.toISOString().split('T')[0]; // Format YYYY-MM-DD
            }
            
            // Fonction pour obtenir le début de la journée
            function getStartOfDay(date) {
                const newDate = new Date(date);
                newDate.setHours(0, 0, 0, 0);
                return newDate;
            }
            
            // Fonction pour obtenir la fin de la journée
            function getEndOfDay(date) {
                const newDate = new Date(date);
                newDate.setHours(23, 59, 59, 999);
                return newDate;
            }
            
            // Fonction pour obtenir le début de la semaine
            function getStartOfWeek(date) {
                const newDate = new Date(date);
                const day = newDate.getDay();
                const diff = newDate.getDate() - day + (day === 0 ? -6 : 1); // Ajuster pour lundi comme premier jour
                return new Date(newDate.setDate(diff));
            }
            
            // Fonction pour obtenir la fin de la semaine
            function getEndOfWeek(date) {
                const startOfWeek = getStartOfWeek(date);
                const endOfWeek = new Date(startOfWeek);
                endOfWeek.setDate(startOfWeek.getDate() + 6);
                return getEndOfDay(endOfWeek);
            }
            
            // Fonction pour obtenir le début du mois
            function getStartOfMonth(date) {
                return new Date(date.getFullYear(), date.getMonth(), 1);
            }
            
            // Fonction pour obtenir la fin du mois
            function getEndOfMonth(date) {
                return new Date(date.getFullYear(), date.getMonth() + 1, 0, 23, 59, 59, 999);
            }
            
            // Fonction pour filtrer les événements
            function filterEvents() {
                const searchTerm = searchInput.value.toLowerCase().trim();
                // const statusValue = statusFilter.value;
                const dateValue = dateFilter.value;
                // const locationValue = locationFilter.value;
                const priceValue = priceFilter.value;
                
                const today = new Date();
                let visibleCount = 0;
                
                eventCards.forEach(card => {
                    const eventName = card.getAttribute('data-name');
                    // const eventStatus = card.getAttribute('data-status');
                    const eventDate = new Date(card.getAttribute('data-date'));
                    // const eventLocation = card.getAttribute('data-location');
                    const eventPrice = parseFloat(card.getAttribute('data-price')) || 0;
                    
                    // Vérifier la recherche par nom
                    const nameMatch = !searchTerm || eventName.includes(searchTerm);
                    
                    // Vérifier le statut
                    // const statusMatch = statusValue === 'all' || eventStatus === statusValue;
                    
                    // Vérifier la date
                    let dateMatch = true;
                    if (dateValue !== 'all') {
                        const eventDateOnly = getStartOfDay(eventDate);
                        const todayOnly = getStartOfDay(today);
                        
                        if (dateValue === 'today') {
                            dateMatch = eventDateOnly.getTime() === todayOnly.getTime();
                        } else if (dateValue === 'week') {
                            const startOfWeek = getStartOfWeek(today);
                            const endOfWeek = getEndOfWeek(today);
                            dateMatch = eventDate >= startOfWeek && eventDate <= endOfWeek;
                        } else if (dateValue === 'month') {
                            const startOfMonth = getStartOfMonth(today);
                            const endOfMonth = getEndOfMonth(today);
                            dateMatch = eventDate >= startOfMonth && eventDate <= endOfMonth;
                        } else if (dateValue === 'future') {
                            dateMatch = eventDate > today;
                        }
                    }
                    
                    // Vérifier le lieu
                    // const locationMatch = locationValue === 'all' || 
                    //     eventLocation.toLowerCase().includes(locationValue.toLowerCase());
                    
                    // Vérifier le prix
                    let priceMatch = true;
                    if (priceValue !== 'all') {
                        if (priceValue === 'free') {
                            priceMatch = eventPrice === 0;
                        } else if (priceValue === 'low') {
                            priceMatch = eventPrice > 0 && eventPrice < 10;
                        } else if (priceValue === 'medium') {
                            priceMatch = eventPrice >= 10 && eventPrice <= 30;
                        } else if (priceValue === 'high') {
                            priceMatch = eventPrice > 30;
                        }
                    }
                    
                    // Afficher ou masquer la carte selon les critères
                    if (nameMatch && dateMatch && priceMatch) {
                        card.style.display = 'block';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });
                
                // Afficher un message si aucun événement ne correspond
                showNoResultsMessage(visibleCount === 0);
            }
            
            // Fonction pour afficher/masquer le message "Aucun résultat"
            function showNoResultsMessage(show) {
                let noResults = document.getElementById('no-results');
                
                if (show && !noResults) {
                    noResults = document.createElement('div');
                    noResults.id = 'no-results';
                    noResults.className = 'no-results';
                    noResults.innerHTML = `
                        <i data-lucide="search-x" class="w-16 h-16 text-gray-400 mx-auto mb-4"></i>
                        <h3 class="text-xl font-semibold text-gray-500 mb-2">Aucun événement trouvé</h3>
                        <p class="text-gray-400">Essayez de modifier vos critères de recherche</p>
                    `;
                    eventsContainer.appendChild(noResults);
                    lucide.createIcons();
                } else if (!show && noResults) {
                    noResults.remove();
                }
            }
            
            // Réinitialiser les filtres
            function resetFilters() {
                searchInput.value = '';
                // statusFilter.value = 'all';
                dateFilter.value = 'all';
                // locationFilter.value = 'all';
                priceFilter.value = 'all';
                filterEvents();
            }
            
            // Ajouter un bouton de réinitialisation
            function addResetButton() {
                const filterSection = document.querySelector('.filter-section');
                const resetButton = document.createElement('button');
                resetButton.type = 'button';
                resetButton.className = 'bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors mt-6';
                resetButton.textContent = 'Réinitialiser les filtres';
                resetButton.addEventListener('click', resetFilters);
                filterSection.appendChild(resetButton);
            }
            
            // Écouter les changements dans les filtres
            searchInput.addEventListener('input', filterEvents);
            // statusFilter.addEventListener('change', filterEvents);
            dateFilter.addEventListener('change', filterEvents);
            // locationFilter.addEventListener('change', filterEvents);
            priceFilter.addEventListener('change', filterEvents);
            
            // Initialiser les filtres et ajouter le bouton de réinitialisation
            filterEvents();
            addResetButton();
            
            console.log('Système de filtrage initialisé avec succès');
        })
    </script>

</body>
</html>