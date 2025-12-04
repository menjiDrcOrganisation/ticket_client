<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $evenement['nom'] ?? 'Événement' }} | Billetterie Kimiaticket</title>
    <!-- Favicon : logo dans l'onglet -->
    <link rel="icon" href="{{ asset('icons/Icone_Kimia.png') }}" type="image/png" />
    <!-- Optionnel : favicon pour Apple touch (iPhone/iPad) -->
    <link rel="apple-touch-icon" href="{{ asset('icons/Icone_Kimia.png') }}" />
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
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
        
        .ticket-shape {
            border-radius: 1.5rem;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .hero-gradient {
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.9) 0%, rgba(225, 29, 72, 0.7) 100%);
        }
        
        .pulse-animation {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        .fade-in {
            animation: fadeIn 1s ease-in-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .bg-pattern {
            background-image: radial-gradient(circle at 1px 1px, rgba(255, 255, 255, 0.15) 1px, transparent 0);
            background-size: 20px 20px;
        }
        
        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }
        
        .countdown-item {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            padding: 15px 20px;
            min-width: 100px;
        }
        
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            box-sizing: border-box;
            overflow-y: auto;
        }
        
        .modal-content {
            background: var(--secondary);
            border-radius: 15px;
            max-width: 500px;
            width: 100%;
            padding: 1.5rem;
            position: relative;
            animation: modalFadeIn 0.3s ease-out;
            max-height: 90vh;
            overflow-y: auto;
        }
        
        @keyframes modalFadeIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }
        
        .close-modal {
            position: absolute;
            top: 15px;
            right: 15px;
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            z-index: 10;
        }
        
        .text-typing {
            overflow: hidden;
            border-right: 2px solid var(--primary);
            white-space: nowrap;
            animation: typing 3.5s steps(40, end), blink-caret 0.75s step-end infinite;
        }
        
        @keyframes typing {
            from { width: 0 }
            to { width: 100% }
        }
        
        @keyframes blink-caret {
            from, to { border-color: transparent }
            50% { border-color: var(--primary) }
        }
        
        .text-float {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0% { transform: translateY(0px) }
            50% { transform: translateY(-10px) }
            100% { transform: translateY(0px) }
        }
        
        .text-gradient-animate {
            background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
            background-size: 400% 400%;
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: gradient 15s ease infinite;
        }
        
        @keyframes gradient {
            0% { background-position: 0% 50% }
            50% { background-position: 100% 50% }
            100% { background-position: 0% 50% }
        }
        
        .text-fade-in-up {
            animation: fadeInUp 1.5s ease-out;
        }
        
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .text-bounce {
            animation: bounce 2s infinite;
        }
        
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-10px); }
            60% { transform: translateY(-5px); }
        }
        
        .stagger-animation > * {
            opacity: 0;
            transform: translateY(20px);
            animation: staggerFadeIn 0.6s ease forwards;
        }
        
        .stagger-animation > *:nth-child(1) { animation-delay: 0.1s; }
        .stagger-animation > *:nth-child(2) { animation-delay: 0.2s; }
        .stagger-animation > *:nth-child(3) { animation-delay: 0.3s; }
        .stagger-animation > *:nth-child(4) { animation-delay: 0.4s; }
        .stagger-animation > *:nth-child(5) { animation-delay: 0.5s; }
        
        @keyframes staggerFadeIn {
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Styles pour le modal de paiement amélioré */
        .payment-modal {
            max-width: 600px;
            width: 100%;
        }
        
        .form-input {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 12px 16px;
            color: white;
            width: 100%;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }
        
        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(225, 29, 72, 0.2);
        }
        
        .ticket-card {
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .ticket-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        }
        
        /* Responsive améliorations */
        @media (max-width: 768px) {
            .modal-content {
                padding: 1.25rem;
                margin: 1rem;
            }
            
            .hero-title {
                font-size: 2.5rem !important;
                line-height: 1.2;
            }
            
            .section-padding {
                padding-left: 1rem;
                padding-right: 1rem;
            }
            
            .ticket-grid {
                grid-template-columns: 1fr !important;
                gap: 1.5rem;
            }
            
            .countdown-item {
                min-width: 80px;
                padding: 10px 15px;
            }
            
            .form-grid {
                grid-template-columns: 1fr !important;
                gap: 1rem;
            }
        }
        
        @media (max-width: 480px) {
            .modal-content {
                padding: 1rem;
                margin: 0.5rem;
            }
            
            .hero-title {
                font-size: 2rem !important;
            }
            
            .countdown-item {
                min-width: 70px;
                padding: 8px 12px;
            }
            
            .section-title {
                font-size: 2rem !important;
            }
        }
        
        /* Améliorations pour très petits écrans */
        @media (max-width: 360px) {
            .hero-title {
                font-size: 1.75rem !important;
            }
            
            .modal-content {
                padding: 0.75rem;
            }
            
            .form-input {
                padding: 10px 12px;
            }
        }
        
        /* Améliorations pour les grands écrans */
        @media (min-width: 1440px) {
            .container-wide {
                max-width: 1200px;
                margin-left: auto;
                margin-right: auto;
            }
        }
        
        /* Scrollbar personnalisée pour les modals */
        .modal-content::-webkit-scrollbar {
            width: 6px;
        }
        
        .modal-content::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }
        
        .modal-content::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 10px;
        }
        
        /* Amélioration de la lisibilité sur mobile */
        .text-responsive {
            font-size: clamp(1rem, 4vw, 1.25rem);
        }
        
        .title-responsive {
            font-size: clamp(1.5rem, 8vw, 3.5rem);
        }
        
        /* Optimisation des images de fond */
        .hero-bg {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: scroll;
        }
        
        /* Correction pour le logo dans la navbar */
        .navbar-logo {
            height: 8px;
            width: auto;
        }
    </style>
</head>
<body>
    @if(isset($error))
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-900 to-gray-800 px-4">
        <div class="text-center p-6 bg-gray-800 rounded-2xl shadow-2xl max-w-md w-full fade-in">
            <i data-lucide="alert-circle" class="w-16 h-16 text-red-500 mx-auto mb-4"></i>
            <h2 class="text-2xl font-bold text-white mb-2">Erreur</h2>
            <p class="text-red-400 mb-6">{{ $error }}</p>
            <a href="/" class="inline-block bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-full transition-all duration-300 transform hover:scale-105">
                Retour à l'accueil
            </a>
        </div>
    </div>
    @else
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 w-full z-50 bg-gray-900/80 backdrop-blur-md border-b border-gray-800">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <img src="{{ asset('icons/Icone_Kimia.png') }}" alt="KimiaTicket" class="h-8 md:h-10 lg:h-12">
                <span class="text-xl font-bold truncate max-w-[150px] md:max-w-none">{{ $evenement['nom'] }}</span>
            </div>
            
            <div class="hidden md:flex space-x-8">
                <a href="#about" class="text-gray-300 hover:text-white transition-colors">À propos</a>
                <a href="#tickets" class="text-gray-300 hover:text-white transition-colors">Billets</a>
                <a href="#location" class="text-gray-300 hover:text-white transition-colors">Lieu</a>
                <a href="#contact" class="text-gray-300 hover:text-white transition-colors">Contact</a>
            </div>
            
            <button id="menu-toggle" class="md:hidden text-white">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>
        </div>
        
        <!-- Mobile menu -->
        <div id="mobile-menu" class="md:hidden bg-gray-900 border-t border-gray-800 hidden">
            <div class="container mx-auto px-4 py-4 flex flex-col space-y-4">
                <a href="#about" class="text-gray-300 hover:text-white transition-colors py-2">À propos</a>
                <a href="#tickets" class="text-gray-300 hover:text-white transition-colors py-2">Billets</a>
                <a href="#location" class="text-gray-300 hover:text-white transition-colors py-2">Lieu</a>
                <a href="#contact" class="text-gray-300 hover:text-white transition-colors py-2">Contact</a>
            </div>
        </div>
    </nav>

    <!-- Section Hero -->
    <header class="relative min-h-screen hero-bg flex items-center justify-center pt-16 px-4"
       style="background-image: url('{{ env('ENV_POINT_URL') }}/storage/app/public/{{ $evenement['ressource'][0]['photo_affiche'] ?? 'img/concert.jpg' }}')">

        <div class="absolute inset-0 hero-gradient"></div>
        <div class="absolute inset-0 bg-pattern"></div>
        
        <div class="relative z-10 text-center w-full max-w-6xl mx-auto space-y-8">
            <div class="inline-block bg-red-600/20 border border-red-500/30 rounded-full px-4 py-2 mb-4">
                <span class="text-red-300 text-sm font-medium">Événement à venir</span>
            </div>
            
            <h1 class="title-responsive font-extrabold uppercase tracking-tight">
                <span class="bg-gradient-to-r from-white to-gray-300 bg-clip-text text-transparent text-typing">
                    {{ $evenement["nom"] }}
                </span>
            </h1>
            
            <div class="text-responsive font-medium space-y-3 max-w-2xl mx-auto">
                <p class="flex items-center justify-center gap-2 text-float flex-wrap">
                    <i data-lucide="map-pin" class="w-5 h-5 text-red-500 flex-shrink-0"></i>
                    <span class="text-center">{{ $evenement["salle"] }} - {{ $evenement["adresse"] }}</span>
                </p>
                <p class="flex items-center justify-center gap-2 flex-wrap justify-center">
                    <span class="font-bold text-yellow-400 flex items-center gap-1 text-bounce">
                        <i data-lucide="calendar" class="w-5 h-5"></i>
                        {{ \Carbon\Carbon::parse($evenement['date_debut'])->translatedFormat('d F Y') }}
                        à
                        {{ \Carbon\Carbon::parse($evenement['heure_debut'])->format('H:i') }}
                    </span>
                    <span class="text-gray-300 mx-2 hidden md:inline">→</span>
                    <span class="text-gray-300 flex items-center gap-1 text-bounce">
                        <i data-lucide="clock" class="w-5 h-5"></i>
                        Jusqu'au
                        {{ \Carbon\Carbon::parse($evenement['date_fin'])->translatedFormat('d F Y') }}
                        à
                        {{ \Carbon\Carbon::parse($evenement['heure_fin'])->format('H:i') }}
                    </span>
                </p>
            </div>
            
            <!-- Phrase d'accroche -->
            @if(isset($evenement['ressource'][0]['phrase_accroche']))
            <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 md:p-8 max-w-3xl mx-auto border border-white/20">
                <p class="text-lg md:text-2xl text-center italic text-gray-200 text-gradient-animate">
                    "{{ $evenement["ressource"][0]["phrase_accroche"] }}"
                </p>
            </div>
            @endif
        </div>
        
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 text-bounce">
            <a href="#about" class="text-white">
                <i data-lucide="chevron-down" class="w-8 h-8"></i>
            </a>
        </div>
    </header>

    <!-- Section description -->
    <section id="about" class="py-16 md:py-20 bg-gray-800 section-padding relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-red-500 to-transparent"></div>
        
        <div class="max-w-6xl mx-auto">
            <h2 class="section-title text-3xl md:text-4xl font-bold mb-6 text-center">
                À propos de l'événement
            </h2>
            <div class="bg-gray-900/50 rounded-2xl p-6 md:p-12 shadow-2xl">
                <p class="text-lg leading-relaxed text-gray-300 text-center md:text-left">
                    {{ $evenement["ressource"][0]["a_propos"] ?? "Aucune description disponible pour cet événement." }}
                </p>
            </div>
        </div>
    </section>

    <!-- Section billets -->
    <section id="tickets" class="py-16 md:py-20 bg-gray-900 section-padding">
        <div class="max-w-6xl mx-auto">
            <h2 class="section-title text-3xl md:text-4xl font-bold mb-8 md:mb-12 text-center">
                Billets disponibles
            </h2>
            
            <div class="ticket-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                @foreach($evenement['type_billets'] as $index => $billet)
                <div class="ticket-card bg-white shadow-2xl hover-lift rounded-2xl p-6 md:p-8 flex flex-col items-center text-center">
                    <div class="bg-red-100 p-4 rounded-2xl mb-6">
                        <i data-lucide="ticket" class="w-10 h-10 md:w-12 md:h-12 text-red-600"></i>
                    </div>
                    <h3 class="text-xl md:text-2xl font-semibold mb-3 text-gray-800">
                        Billet {{ $billet["nom_type"] }}
                    </h3>
                    <p class="text-gray-600 mb-6">
                        Accès à l'événement avec placement libre
                    </p>
                    <p class="text-3xl md:text-4xl font-bold text-red-600 mb-2">
                        {{ number_format($billet["pivot"]["prix_unitaire"] ?? 0, 0, ",", " ") }} {{ $billet["pivot"]["devise"] ?? "FC" }}
                    </p>
                    <p class="text-sm text-gray-500 mb-6">Disponible</p>
                    <button class="w-full buy-ticket-btn bg-red-600 hover:bg-red-700 text-white py-3 rounded-full font-bold transition-all duration-300 transform hover:scale-105"
                        data-ticket-type="{{ $billet['nom_type'] }}"
                        data-ticket-price="{{ $billet['pivot']['prix_unitaire'] ?? '0' }}"
                        data-ticket-id="{{ $billet['id'] }}"
                        data-ticket-devise="{{ $billet['pivot']['devise'] ?? 'FC' }}">
                        Acheter maintenant
                    </button>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Section lieu -->
    <section id="location" class="py-16 md:py-20 bg-gray-800 section-padding">
        <div class="max-w-6xl mx-auto">
            <h2 class="section-title text-3xl md:text-4xl font-bold mb-8 md:mb-12 text-center">
                Lieu de l'événement
            </h2>
            
            <div class="bg-gray-900 rounded-2xl overflow-hidden shadow-2xl">
                <div class="w-full p-6 md:p-12">
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <i data-lucide="map-pin" class="w-5 h-5 text-red-500 mt-1 flex-shrink-0"></i>
                            <div>
                                <p class="font-medium">Salle</p>
                                <p class="text-gray-400">{{ $evenement["salle"] }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <i data-lucide="map-pin" class="w-5 h-5 text-red-500 mt-1 flex-shrink-0"></i>
                            <div>
                                <p class="font-medium">Adresse</p>
                                <p class="text-gray-400">{{ $evenement["adresse"] }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start gap-3">
                            <i data-lucide="calendar" class="w-5 h-5 text-red-500 mt-1 flex-shrink-0"></i>
                            <div>
                                <p class="font-medium">Date et heure</p>
                                <p class="text-gray-400">
                                    {{ \Carbon\Carbon::parse($evenement['date_debut'])->translatedFormat('d F Y') }}
                                    à
                                    {{ \Carbon\Carbon::parse($evenement['heure_debut'])->format('H:i') }}
                                    -
                                    {{ \Carbon\Carbon::parse($evenement['date_fin'])->translatedFormat('d F Y') }}
                                    à
                                    {{ \Carbon\Carbon::parse($evenement['heure_fin'])->format('H:i') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6 md:mt-8">
                        <a href="https://maps.google.com/?q={{ urlencode($evenement['adresse']) }}"
                           target="_blank"
                           class="inline-flex items-center justify-center gap-2 bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg transition-all duration-300 w-full md:w-auto">
                            <i data-lucide="navigation" class="w-5 h-5"></i>
                            Voir sur Google Maps
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal de paiement amélioré -->
    <div id="payment-modal" class="modal">
        <div class="modal-content payment-modal">
            <button class="close-modal" onclick="closePaymentModal()">
                <i data-lucide="x"></i>
            </button>
            
            <h3 class="text-xl md:text-2xl font-bold mb-2" id="modal-title">
                Finalisez votre achat
            </h3>
            <p class="text-gray-400 mb-4 md:mb-6 text-sm md:text-base" id="modal-subtitle">
                Remplissez vos informations pour compléter votre achat
            </p>
            
            <form id="payment-form" class="space-y-4">
                <input type="hidden" value="{{ $evenement['id'] }}" name="id_evenement" />
                <input type="hidden" id="selected-ticket-type" name="type_billet" />
                
                <div class="form-grid grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="fullname" class="block text-sm font-medium text-gray-300 mb-1">Nom complet</label>
                        <input type="text" id="fullname" name="nom_complet_client" class="form-input" required />
                    </div>
                    
                    <div>
                        <label for="telephone" class="block text-sm font-medium text-gray-300 mb-1">Téléphone</label>
                        <input type="tel" id="telephone" name="numero_client" placeholder="+243xxxxxxxxx" class="form-input" required pattern="^\+243[0-9]{9}$" title="Entrez un numéro congolais valide au format +243 suivi de 9 chiffres" />
                    </div>
                </div>
                
                <div class="form-grid grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="service" class="block text-sm font-medium text-gray-300 mb-1">Service de paiement</label>
                        <select id="service" name="service" class="form-input" required>
                            <option value="MPESA">MPESA</option>
                            <option value="orange">ORANGEMONEY</option>
                            <option value="airtel">AIRTELMONEY</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="devise" class="block text-sm font-medium text-gray-300 mb-1">Devise</label>
                        <div class="form-input bg-gray-700">
                            <span id="devise-display" class="text-white font-semibold">FC</span>
                        </div>
                    </div>
                </div>
                
                <div class="form-grid grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="quantity" class="block text-sm font-medium text-gray-300 mb-1">Nombre de billets</label>
                        <input type="number" id="quantity" name="nombre_reel" min="1" value="1" class="form-input" required />
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Prix unitaire</label>
                        <div class="form-input bg-gray-700">
                            <span id="unit-price" class="text-white font-semibold">0 FC</span>
                        </div>
                    </div>
                </div>
                
                <div class="pt-4 border-t border-gray-700">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-gray-400 text-lg">Total:</span>
                        <span id="total-price" class="text-xl md:text-2xl font-bold text-white">0 FC</span>
                    </div>
                    
                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white py-3 rounded-lg font-semibold transition-all duration-300 flex items-center justify-center gap-2">
                        <i data-lucide="credit-card" class="w-5 h-5"></i>
                        Procéder au paiement
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal QR Code -->
    <div id="qr-modal" class="modal">
        <div class="modal-content">
            <button class="close-modal" onclick="closeQRModal()">
                <i data-lucide="x"></i>
            </button>
            
            <h2 class="text-xl md:text-2xl font-bold text-center mb-4">
                Votre billet
            </h2>
            
            <div class="flex justify-center mb-6">
                <canvas id="qrcode-canvas" class="max-w-full"></canvas>
            </div>
            
            <div class="text-center">
                <button id="download"  class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-semibold mr-2 w-full md:w-auto mb-2 md:mb-0">
                    Télécharger PDF
                </button>
                <button onclick="closeQRModal()" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg font-semibold w-full md:w-auto">
                    Fermer
                </button>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer id="contact" class="bg-gray-900 py-12 px-6 border-t border-gray-800">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div class="md:col-span-2">
                    <div class="flex items-center space-x-2 mb-4">
                        <i data-lucide="ticket" class="w-8 h-8 text-red-500"></i>
                        <span class="text-xl font-bold">Menji<span class="text-red-500">DRC</span></span>
                    </div>
                    <p class="text-gray-400 mb-4">
                        Votre plateforme de billetterie de confiance pour les meilleurs événements en République Démocratique du Congo.
                    </p>
                    
                    <div class="flex space-x-4">
                        <a href="#" class="bg-gray-800 p-3 rounded-full text-gray-300 hover:bg-red-600 hover:text-white transition-all">
                            <i data-lucide="facebook" class="w-5 h-5"></i>
                        </a>
                        <a href="#" class="bg-gray-800 p-3 rounded-full text-gray-300 hover:bg-red-600 hover:text-white transition-all">
                            <i data-lucide="twitter" class="w-5 h-5"></i>
                        </a>
                        <a href="#" class="bg-gray-800 p-3 rounded-full text-gray-300 hover:bg-red-600 hover:text-white transition-all">
                            <i data-lucide="instagram" class="w-5 h-5"></i>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4">Liens rapides</h4>
                    <ul class="space-y-2">
                        <li>
                            <a href="#about" class="text-gray-400 hover:text-white transition-colors">À propos</a>
                        </li>
                        <li>
                            <a href="#tickets" class="text-gray-400 hover:text-white transition-colors">Billets</a>
                        </li>
                        <li>
                            <a href="#location" class="text-gray-400 hover:text-white transition-colors">Lieu</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Contact</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li class="flex items-center gap-2">
                            <i data-lucide="mail" class="w-4 h-4"></i>
                            <span>contact@menjidrc.com</span>
                        </li>
                        <li class="flex items-center gap-2 text-fade-in-up">
                            <i data-lucide="phone" class="w-4 h-4 text-bounce"></i>
                            <span>+243 973439644</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="pt-8 border-t border-gray-800 text-center text-gray-500">
                <p>© {{ date("Y") }} Menji DRC — Tous droits réservés.</p>
            </div>
        </div>
    </footer>
    @endif

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
        
        // Gestion du modal de paiement
        let currentTicketPrice = 0;
        let currentTicketId = '';
        let clientName = '';
        let currentTicketDevise = 'FC';
        let currentTicketData = null;
        
        function openPaymentModal(ticketType, ticketPrice, ticketId, ticketDevise) {
            console.log('Opening modal for:', ticketType, ticketPrice, ticketId, ticketDevise);
            
            currentTicketPrice = parseFloat(ticketPrice) || 0;
            currentTicketId = ticketId;
            currentTicketDevise = ticketDevise || 'FC';
            
            document.getElementById('modal-title').textContent = `Acheter un billet ${ticketType}`;
            document.getElementById('selected-ticket-type').value = ticketId;
            document.getElementById('unit-price').textContent = `${currentTicketPrice.toLocaleString('fr-FR')} ${currentTicketDevise}`;
            document.getElementById('devise-display').textContent = currentTicketDevise;
            updateTotalPrice();
            document.getElementById('payment-modal').style.display = 'flex';
            document.body.style.overflow = 'hidden';
            
            // Réinitialiser le formulaire
            document.getElementById('payment-form').reset();
        }
        
        function closePaymentModal() {
            document.getElementById('payment-modal').style.display = 'none';
            document.body.style.overflow = 'auto';
        }
        
        function closeQRModal() {
            document.getElementById('qr-modal').style.display = 'none';
            document.body.style.overflow = 'auto';
        }
        
        function updateTotalPrice() {
            const quantity = parseInt(document.getElementById('quantity').value) || 1;
            const total = currentTicketPrice * quantity;
            document.getElementById('total-price').textContent = `${total.toLocaleString('fr-FR')} ${currentTicketDevise}`;
        }
        
        // Fonction pour télécharger le ticket


        
        document.addEventListener('DOMContentLoaded', function() {
            // Gestion des boutons d'achat
            document.querySelectorAll('.buy-ticket-btn').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    const ticketType = this.getAttribute('data-ticket-type');
                    const ticketPrice = this.getAttribute('data-ticket-price');
                    const ticketId = this.getAttribute('data-ticket-id');
                    const ticketDevise = this.getAttribute('data-ticket-devise');
                    
                    openPaymentModal(ticketType, ticketPrice, ticketId, ticketDevise);
                });
            });
            
            // Calcul du prix total
            document.getElementById('quantity').addEventListener('input', updateTotalPrice);
            
            // Soumission du formulaire
            document.getElementById('payment-form').addEventListener('submit', async function(e) {
                e.preventDefault();
                
                const formData = {
                    id_evenement: this.id_evenement.value,
                    nom_complet_client: this.nom_complet_client.value,
                    numero_client: this.numero_client.value,
                    nombre_reel: this.nombre_reel.value,
                    type_billet: this.type_billet.value,
                    service: this.service.value
                };
                
                clientName = formData.nom_complet_client;
                
                // Validation basique
                if (!formData.nom_complet_client || !formData.numero_client) {
                    alert('Veuillez remplir tous les champs obligatoires.');
                    return;
                }
                
                try {
                    // Afficher un indicateur de chargement
                 // ⏳ 1. Loader du bouton
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                 submitBtn.innerHTML = '<i data-lucide="loader" class="w-5 h-5 animate-spin"></i> Traitement...';
                    lucide.createIcons();

         // 🌍 2. Envoi de la requête API
                const response = await fetch("{{ env('ENV_POINT_URL') }}/api/billet/achatBillet", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(formData),
    });
        
    const evenement = @json($evenement);
     // si tu as 

    const result = await response.json();
    console.log(result);

    // 🔄 3. Restaurer le bouton
    submitBtn.innerHTML = originalText;
    lucide.createIcons();

    // 🚨 Vérification
    if (result.status !== true) {
        alert(result.message || "Paiement échoué.");
        return;
    }

    
    
                    
                    if (result.status === true) {
                        
                        const billet = result.billet; 
                        const uniqueCode = billet.code_billet;
                        const canvas = document.getElementById("qrcode-canvas");
                        const download=document.getElementById('download');
                console.log(evenement);
                            const data_info_billet = {
                                name_user: billet.nom_auteur,
                                name_event: evenement.nom,
                                location: evenement.adresse,
                                type : formData.type_billet,// evenement.type_billet[0].nom_type,
                                quantity: fromData.nombre_reel,
                                price: billet["type_billet"][0].pivot.prix_unitaire,
                                devise: billet["type_billet"][0].pivot.devise,
                                photo_affiche: evenement.ressource[0].photo_affiche,
                                qrcode: billet.code_billet,
                                date_achat: billet.date_achat,
                                debut: evenement.date_debut,
                                heure: evenement.heure_debut
                            };

                            // Assurez-vous que 'download' est bien votre bouton
                            // Par exemple: <button id="downloadBtn">Télécharger</button>
                            const downloadBtn = document.getElementById('download');

                            downloadBtn.addEventListener('click', function() {
                                // Appeler VOTRE contrôleur Laravel
                                fetch("{{ route('ticket.generate.pdf') }}", {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Accept': 'application/pdf'
                                    },
                                    body: JSON.stringify(data_info_billet)
                                })
                                .then(response => {
                                    // Vérifier si la réponse est OK
                                    if (!response.ok) {
                                        throw new Error('Erreur réseau: ' + response.status);
                                    }
                                    return response.blob();
                                })
                                .then(blob => {
                                    // Créer un URL pour le blob
                                    const url = window.URL.createObjectURL(blob);
                                    
                                    // Créer un lien de téléchargement
                                    const a = document.createElement('a');
                                    a.href = url;
                                    a.download = 'billet-' + data_info_billet.qrcode + '.pdf'; // Nom personnalisé
                                    document.body.appendChild(a);
                                      
                                    // Déclencher le téléchargement
                                    a.click();
                                    
                                    // Nettoyer
                                    document.body.removeChild(a);
                                    window.URL.revokeObjectURL(url);
                                })
                                .catch(error => {
                                    console.error('Erreur:', error);
                                    alert('Erreur lors du téléchargement: ' + error.message);
                                });
                            });

                                 
                                console.log(data_info_billet);
                                
                        QRCode.toCanvas(
                            canvas,
                            uniqueCode,
                            {
                                width: 200,
                                color: { dark: "#000000", light: "#ffffff" },
                            },
                            function (error) {
                                if (error) {
                                    console.error(error);
                                    alert("Erreur lors de la génération du QR Code");
                                    return;
                                }
                                document.getElementById('qr-modal').style.display = 'flex';
                                document.body.style.overflow = 'hidden';
                            }
                        );
                    } else {
                        console.error(result.error);
                        alert(result.error || "Paiement échoué. Vérifiez vos informations.");
                    }
                } catch (error) {
                    alert("Le paiement a échoué. Une erreur inattendue est survenue.");
                    console.error(error);
                }
            });
            
            // Fermer les modals en cliquant à l'extérieur
            window.addEventListener('click', function(e) {
                const paymentModal = document.getElementById('payment-modal');
                const qrModal = document.getElementById('qr-modal');
                
                if (e.target === paymentModal) closePaymentModal();
                if (e.target === qrModal) closeQRModal();
            });
            
            // Fermer les modals avec la touche Échap
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closePaymentModal();
                    closeQRModal();
                }
            });
            
            // Initialisation
            if (typeof ScrollReveal !== 'undefined') {
                ScrollReveal().reveal('.fade-in', { delay: 300, duration: 1000 });
            }
        });
    </script>
</body>
</html>