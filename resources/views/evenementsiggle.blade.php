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
        .qr-wrapper {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* QR code */
.qr-canvas {
    filter: blur(4px) contrast(1.2) brightness(0.9);
    transform: scale(1.02);
}

/* masque de sécurité (empêche lecture) */
.qr-wrapper::after {
    content: "";
    position: absolute;
    inset: 0;

    /* effet billet sécurisé */
    background: repeating-linear-gradient(
        135deg,
        rgba(255, 255, 255, 0.25),
        rgba(255, 255, 255, 0.25) 8px,
        rgba(0, 0, 0, 0.05) 8px,
        rgba(0, 0, 0, 0.05) 16px
    );

    backdrop-filter: blur(1.5px);
    -webkit-backdrop-filter: blur(1.5px);

    pointer-events: none;

    border-radius: 10px;
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

        #recap-modal .close-modal {
            width: 36px;
            height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 9999px;
            background: rgba(0, 0, 0, 0.7);
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.25);
            z-index: 30;
        }

        #recap-modal .close-modal:hover {
            background: rgba(245, 158, 11, 0.25);
            color: #fde68a;
            border-color: rgba(245, 158, 11, 0.7);
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
            border: none;
            border-radius: 10px;
            padding: 12px 16px;
            color: white;
            width: 100%;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }
        
        .form-input:focus {
            outline: none;
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

        .recap-grid {
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 0.75rem;
        }

        @media (min-width: 768px) {
            .recap-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        .recap-field {
            display: flex;
            flex-direction: column;
            gap: 0.35rem;
        }

        .recap-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: #9ca3af;
        }

        .recap-value {
            background: rgba(255, 255, 255, 0.05);
            border: none;
            border-radius: 10px;
            padding: 10px 12px;
            color: #ffffff;
            line-height: 1.3;
            min-height: 44px;
            display: flex;
            align-items: center;
        }

        .recap-value.recap-total {
            color: #fde68a;
            font-weight: 700;
            background: rgba(245, 158, 11, 0.12);
        }

        .status-recap-link {
            color: #fde68a;
            text-decoration: underline;
            font-weight: 700;
            cursor: pointer;
        }

        .status-recap-link:hover {
            color: #facc15;
        }

        .blink-download {
            animation: blinkDownload 1s ease-in-out infinite;
        }

        @keyframes blinkDownload {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.35; }
        }

        .recap-spinner {
            width: 18px;
            height: 18px;
            border: 2px solid rgba(255, 255, 255, 0.25);
            border-top-color: #34d399;
            border-radius: 9999px;
            animation: recapSpin 0.8s linear infinite;
            flex-shrink: 0;
        }

        @keyframes recapSpin {
            to {
                transform: rotate(360deg);
            }
        }

        .button-spinner {
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top-color: currentColor;
            border-radius: 9999px;
            animation: buttonSpin 0.8s linear infinite;
            flex-shrink: 0;
        }

        @keyframes buttonSpin {
            to {
                transform: rotate(360deg);
            }
        }

        .status-box {
            display: none;
            margin-top: 0.75rem;
            padding: 0.65rem 0.85rem;
            border-radius: 0.75rem;
            border: 1px solid rgba(255, 255, 255, 0.18);
            background: rgba(15, 23, 42, 0.7);
            font-size: 0.9rem;
            line-height: 1.35;
        }

        .status-info {
            color: #c7d2fe;
            border-color: rgba(99, 102, 241, 0.45);
            background: rgba(99, 102, 241, 0.18);
        }

        .status-progress {
            color: #bfdbfe;
            border-color: rgba(59, 130, 246, 0.45);
            background: rgba(59, 130, 246, 0.18);
        }

        .status-success {
            color: #d1fae5;
            border-color: rgba(16, 185, 129, 0.5);
            background: rgba(16, 185, 129, 0.2);
        }

        .status-warning {
            color: #fef3c7;
            border-color: rgba(245, 158, 11, 0.5);
            background: rgba(245, 158, 11, 0.2);
        }

        .status-error {
            color: #fecaca;
            border-color: rgba(239, 68, 68, 0.5);
            background: rgba(239, 68, 68, 0.2);
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
    <nav class="fixed top-0 left-0 w-full z-50 bg-white/80 backdrop-blur-md border-b border-gray-300">
        <div class=" px-12 py-3 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <img src="{{ asset('icons/Icone_Kimia.png') }}" alt="KimiaTicket" class="h-8 md:h-10 lg:h-12">
                <span class="text-xl font-bold truncate max-w-[150px] md:max-w-none">{{ $evenement['nom'] }}</span>
            </div>
            
            <div class="hidden md:flex space-x-8">
                <a href="#about" class="text-gray-600 hover:text-white transition-colors">À propos</a>
                <a href="#tickets" class="text-gray-600 hover:text-white transition-colors">Billets</a>
                <a href="#location" class="text-gray-600 hover:text-white transition-colors">Lieu</a>
                <a href="#contact" class="text-gray-600 hover:text-white transition-colors">Contact</a>
            </div>
            
            <button id="menu-toggle" class="md:hidden text-white">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>
        </div>
        
        <!-- Mobile menu -->
        <div id="mobile-menu" class="md:hidden bg-gray-900 border-t border-gray-700 hidden">
            <div class="container mx-auto px-4 py-4 flex flex-col space-y-4">
                <a href="#about" class="text-gray-600 hover:text-white transition-colors">À propos</a>
                <a href="#tickets" class="text-gray-600 hover:text-white transition-colors">Billets</a>
                <a href="#location" class="text-gray-600 hover:text-white transition-colors">Lieu</a>
                <a href="#contact" class="text-gray-600 hover:text-white transition-colors">Contact</a>
            </div>
        </div>
    </nav>

    <!-- Section Hero -->
    <header class="relative min-h-screen hero-bg flex items-center justify-center pt-16 px-4"
       style="background-image: url('{{ env('ENV_POINT_URL') }}/storage/app/public/{{ $evenement['ressource'][0]['photo_affiche'] ?? 'img/concert.jpg' }}')">

        <div class="absolute inset-0 hero-gradient"></div>
        <div class="absolute inset-0 bg-pattern"></div>
        
        <div class="relative z-10 text-center w-full max-w-6xl mx-auto space-y-8">
            
            
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
            <h2 class="section-title text-white text-3xl md:text-4xl font-bold mb-6 text-center">
                À propos de l'événement
            </h2>
            <div class="bg-gray-800/50 rounded-2xl p-6 md:p-12 shadow-2xl">
                <p class="text-lg leading-relaxed text-gray-300 text-center md:text-left">
                    {{ $evenement["ressource"][0]["a_propos"] ?? "Aucune description disponible pour cet événement." }}
                </p>
            </div>
        </div>
    </section>

    <!-- Section billets -->
    <section id="tickets" class="py-16 md:py-20 bg-gray-900 section-padding">
        <div class="max-w-6xl mx-auto">
            <h2 class="section-title text-3xl text-white md:text-4xl font-bold mb-8 md:mb-12 text-center">
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
                   
                    <a href="http://">
                         {{$billet["pivot"]["devise"]}}

                    </a>
                    
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
            <h2 class="section-title text-white text-3xl md:text-4xl font-bold mb-8 md:mb-12 text-center">
                Lieu de l'événement
            </h2>
            
            <div class="bg-gray-800 text-white rounded-2xl overflow-hidden shadow-2xl">
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
            
            <h3 class="text-xl md:text-2xl text-white font-bold mb-2" id="modal-title">
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
                        <input type="tel" id="telephone" name="numero_client" placeholder="+243xxxxxxxxx" class="form-input" required pattern="^(\+243|243|0)?[0-9]{9}$" title="Formats acceptés: +243XXXXXXXXX, 243XXXXXXXXX, 0XXXXXXXXX ou XXXXXXXXX" />
                    </div>
                </div>
                
                <div class="form-grid grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="service" class="block text-sm font-medium text-gray-300 mb-1">Service de paiement</label>
                        <select id="service" name="service" class="form-input bg-gray-800" required>
                            <option value="MPESA" class=" hover:bg-red-500">M-Pesa</option>
                            <option value="ORANGE" class=" hover:bg-red-500">Orange Money</option>
                            <option value="AIRTEL" class=" hover:bg-red-500">Airtel Money</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="devise" class="block text-sm font-medium text-gray-300 mb-1">Devise</label>
                        
                        <select id="devise-display" name="devise_display" class="form-input bg-gray-800">
                            <option value="CDF">CDF</option>
                            <option value="USD">USD</option>
                        </select>
                        <div class="text-sm text-yellow-400 mt-1" id="taux-info">
                            Taux: chargement...
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
                        <div class="form-input bg-gray-800">
                            <span id="unit-price" class="text-yellow-400 font-semibold">0 FC</span>
                        </div>
                    </div>
                </div>
                
                <div class="pt-4 border-t border-gray-700">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-gray-400 text-lg">Total:</span>
                        <span id="total-price" class="text-xl md:text-2xl font-bold text-yellow-400">0 FC</span>
                    </div>
                    
                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white py-3 rounded-lg font-semibold transition-all duration-300 flex items-center justify-center gap-2">
                        <span class="button-content flex items-center justify-center gap-2">
                            <i data-lucide="credit-card" class="w-5 h-5"></i>
                            <span>Acheter votre billet</span>
                        </span>
                        <span class="button-loader" style="display:none; align-items:center; justify-content:center; gap:0.5rem;">
                            <span class="button-spinner"></span>
                            <span class="loader-text">Chargement...</span>
                        </span>
                    </button>

                    <div id="status" class="status-box"></div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal recapitulatif transaction -->
    <div id="recap-modal" class="modal">
        <div class="modal-content max-w-lg bg-gray-900">
            <button class="close-modal" onclick="closeRecapModal()">
                <i data-lucide="x"></i>
            </button>

            <h3 class="text-xl md:text-2xl text-white font-bold mb-2">
                Recapitulatif de votre achat
            </h3>
           
            <label for="transaction-reference" class="block text-sm font-medium text-gray-300 mb-1">Reference d'achat</label>
            <div class="flex flex-col md:flex-row gap-2 mb-3">
                <input id="transaction-reference" type="text" readonly class="form-input bg-gray-800" value="" />
                <button type="button" id="btnCopyReference" class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg font-semibold transition-all duration-300">
                    Copier
                </button>
            </div>

            <div id="recap" class="mt-2 text-sm text-gray-200 bg-gray-800 rounded-lg p-4"></div>

            <button type="button" id="btnDownloadRecap" style="display:none;" class="mb-3 w-full bg-yellow-500 hover:bg-yellow-600 text-black py-3 rounded-lg font-bold transition-all duration-300 blink-download">
                Télécharger le billet
            </button>

            <button type="button" id="btnConfirmerRecap" class="mt-4 w-full bg-yellow-500 hover:bg-yellow-600 text-black py-3 rounded-lg font-bold transition-all duration-300 flex items-center justify-center gap-2">
                <span class="button-content flex items-center justify-center gap-2">
                    <span>Valider et payer</span>
                </span>
                <span class="button-loader" style="display:none; align-items:center; justify-content:center; gap:0.5rem;">
                    <span class="button-spinner"></span>
                    <span class="loader-text">Traitement...</span>
                </span>
            </button>
        </div>
    </div>

    <!-- Modal QR Code -->
    <div id="qr-modal" class="modal">
        <div class="modal-content">
            <button class="close-modal" onclick="closeQRModal()">
                <i data-lucide="x"></i>
            </button>
            
            <h2 class="text-xl md:text-2xl font-bold text-white text-center mb-4">
                Votre billet est pret
            </h2>
            
            <div class="qr-wrapper flex justify-center mb-6">
    <canvas id="qrcode-canvas" class="qr-canvas"></canvas>
</div>
            
            <div class="text-center">
                <button id="download"  class="bg-yellow-500 hover:bg-yellow-600 text-black px-6 py-3 rounded-lg font-semibold mr-2 w-full md:w-auto mb-2 md:mb-0">
                    Télécharger votre billet
                </button>

            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer id="contact" class="bg-gray-900 text-white py-12 px-6 border-t border-gray-700">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div class="md:col-span-2">
                    <div class="flex items-center space-x-2 mb-4">
                        <i data-lucide="ticket" class="w-8 h-8 text-red-500"></i>
                        <span class="text-xl font-bold">Kimia<span class="text-red-500">Ticket</span></span>
                    </div>
                    <p class="text-gray-400 mb-4">
                        Votre plateforme de billetterie de confiance pour les meilleurs événements en République Démocratique du Congo.
                    </p>
                    
                    <div class="flex space-x-4">
                        <a href="#" class="bg-yellow-500 p-3 rounded-full text-black hover:bg-yellow-600 transition-all">
                            <i data-lucide="facebook" class="w-5 h-5"></i>
                        </a>
                        <a href="#" class="bg-yellow-500 p-3 rounded-full text-black hover:bg-yellow-600 transition-all">
                            <i data-lucide="twitter" class="w-5 h-5"></i>
                        </a>
                        <a href="#" class="bg-yellow-500 p-3 rounded-full text-black hover:bg-yellow-600 transition-all">
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
            
            <div class="pt-8 border-t border-red-600 text-center text-gray-400">
                <p>© {{ date("Y") }} Menji DRC — Tous droits réservés.</p>
            </div>
        </div>
    </footer>
    @endif

    <script>
    lucide.createIcons();

    const API_BASE = "{{ rtrim((string) env('ENV_POINT_URL', ''), '/') }}/api";
    const STORAGE_KEY = 'pending_transaction_reference';
    const POLLING_INTERVAL_MS = 1500;
    const POLLING_TIMEOUT_MS = 20000;

    // ====== VARIABLES GLOBALES ======
    let tauxUSD_CDF = 0;
    let currentTicketPrice = 0;
    let baseTicketPrice = 0;
    let currentTicketId = '';
    let currentTicketDevise = 'CDF';
    let currentReference = null;
    let currentDownloadUrl = null;
    let pollTimer = null;
    let pollStartedAt = null;
    let pollInFlight = false;
    let pollingSessionId = 0;
    let recapConfirmed = false;
    let currentBuyerName = '';

    const statusEl = document.getElementById('status');
    const recapEl = document.getElementById('recap');
    const paymentForm = document.getElementById('payment-form');
    const btnAcheter = paymentForm ? paymentForm.querySelector('button[type="submit"]') : null;
    const recapModalEl = document.getElementById('recap-modal');
    const transactionReferenceEl = document.getElementById('transaction-reference');
    const btnCopyReference = document.getElementById('btnCopyReference');
    const btnConfirmerRecap = document.getElementById('btnConfirmerRecap');
    const btnDownloadRecap = document.getElementById('btnDownloadRecap');

    // ====== MENU MOBILE ======
    const menuToggle = document.getElementById('menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');

    if (menuToggle && mobileMenu) {
        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');

            const icon = menuToggle.querySelector('i');
            icon.setAttribute(
                'data-lucide',
                mobileMenu.classList.contains('hidden') ? 'menu' : 'x'
            );

            lucide.createIcons();
        });
    }

    // ====== TAUX DE CHANGE ======
    async function getTaux() {
        try {
            const response = await fetch("https://api.exchangerate-api.com/v4/latest/USD");
            const data = await response.json();
            return data.rates.CDF;
        } catch (error) {
            console.error("Erreur récupération taux:", error);
            return null;
        }
    }

    async function chargerTaux() {
        const taux = await getTaux();

        if (taux) {
            tauxUSD_CDF = taux;
            document.getElementById('taux-info').textContent =
                `1 USD = ${taux.toLocaleString('fr-FR')} CDF`;
        }
    }

    // lancer au chargement
    chargerTaux();

    // ====== MODAL PAIEMENT ======
    function openPaymentModal(ticketType, ticketPrice, ticketId, ticketDevise) {
        currentTicketPrice = parseFloat(ticketPrice) || 0;
        baseTicketPrice = parseFloat(ticketPrice) || 0;
        currentTicketId = ticketId;
        currentTicketDevise = ticketDevise || 'CDF';

        document.getElementById('modal-title').textContent =
            `Acheter un billet ${ticketType}`;

        document.getElementById('selected-ticket-type').value = ticketId;

        document.getElementById('unit-price').textContent =
            `${currentTicketPrice.toLocaleString('fr-FR')} ${currentTicketDevise}`;

        document.getElementById('devise-display').value =
            currentTicketDevise === 'CDF' ? 'CDF' : 'USD';

        updateTotalPrice();

        document.getElementById('payment-modal').style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closePaymentModal() {
        document.getElementById('payment-modal').style.display = 'none';
        syncBodyScrollLock();
    }

    function closeQRModal() {
        document.getElementById('qr-modal').style.display = 'none';
        syncBodyScrollLock();
    }

    function openRecapModal() {
        if (!recapModalEl) return;
        recapModalEl.style.display = 'flex';
        syncBodyScrollLock();
    }

    function closeRecapModal() {
        if (!recapModalEl) return;
        recapModalEl.style.display = 'none';
        syncBodyScrollLock();
    }

    function syncBodyScrollLock() {
        const paymentModal = document.getElementById('payment-modal');
        const qrModal = document.getElementById('qr-modal');
        const hasOpenModal =
            (paymentModal && paymentModal.style.display === 'flex') ||
            (qrModal && qrModal.style.display === 'flex') ||
            (recapModalEl && recapModalEl.style.display === 'flex');

        document.body.style.overflow = hasOpenModal ? 'hidden' : 'auto';
    }

    function setStatus(text) {
        if (!statusEl) return;
        const type = arguments[1] || 'info';
        const allowHtml = Boolean(arguments[2]);
        const normalizedType = ['info', 'progress', 'success', 'warning', 'error'].includes(type)
            ? type
            : 'info';

        statusEl.classList.remove('status-info', 'status-progress', 'status-success', 'status-warning', 'status-error');

        if (!text) {
            statusEl.textContent = '';
            statusEl.style.display = 'none';
            return;
        }

        if (allowHtml) {
            statusEl.innerHTML = text;
        } else {
            statusEl.textContent = text;
        }
        statusEl.style.display = 'block';
        statusEl.classList.add(`status-${normalizedType}`);
    }

    function setStatusRecapLink(prefixText, type = 'success') {
        setStatus(`${prefixText} <a href="#" id="status-recap-link" data-open-recap class="status-recap-link">cliquer ici</a>.`, type, true);

        const recapLinkEl = document.getElementById('status-recap-link');
        if (recapLinkEl) {
            recapLinkEl.addEventListener('click', function (e) {
                e.preventDefault();
                openRecapFromStatus();
            });
        }
    }

    function setStatusDownloadReadyLink(prefixText) {
        setStatus(`${prefixText} <a href="#" id="status-download-link" data-download-ticket class="status-recap-link">telecharger ici</a>.`, 'success', true);

        const downloadLinkEl = document.getElementById('status-download-link');
        if (downloadLinkEl) {
            downloadLinkEl.addEventListener('click', function (e) {
                e.preventDefault();
                if (currentDownloadUrl) {
                    downloadTicketNow();
                } else {
                    openRecapFromStatus();
                }
            });
        }
    }

    function openRecapFromStatus() {
        if (!currentReference && !recapEl?.innerHTML?.trim()) {
            setStatus('Aucun recapitulatif disponible pour le moment.', 'error');
            return;
        }

        openRecapModal();
    }

    function setLoading(button, loading, labelLoading = 'Chargement...') {
        if (!button) return;
        
        const content = button.querySelector('.button-content');
        const loader = button.querySelector('.button-loader');
        const loaderText = loader?.querySelector('.loader-text');
        
        if (loading) {
            button.disabled = true;
            if (content) content.style.display = 'none';
            if (loader) {
                loader.style.display = 'flex';
                if (loaderText) loaderText.textContent = labelLoading;
            }
        } else {
            button.disabled = false;
            if (content) content.style.display = 'flex';
            if (loader) loader.style.display = 'none';
        }
    }

    function setAcheterDisabled(disabled) {
        if (!btnAcheter) return;

        btnAcheter.disabled = disabled;
        btnAcheter.classList.toggle('opacity-60', disabled);
        btnAcheter.classList.toggle('cursor-not-allowed', disabled);
    }

    function savePendingReference(reference) {
        localStorage.setItem(STORAGE_KEY, reference);
    }

    function clearPendingReference() {
        localStorage.removeItem(STORAGE_KEY);
    }

    function normalizePhoneNumber(raw) {
        const value = String(raw || '').trim();
        let digits = value.replace(/\D/g, '');

        if (digits.startsWith('00')) {
            digits = digits.slice(2);
        }

        if (digits.startsWith('243') && digits.length === 12) {
            return `+${digits}`;
        }

        if (digits.startsWith('0') && digits.length === 10) {
            return `+243${digits.slice(1)}`;
        }

        if (digits.length === 9) {
            return `+243${digits}`;
        }

        if (value.startsWith('+') && digits.length >= 10) {
            return `+${digits}`;
        }

        throw new Error('Numero invalide. Format attendu: +243XXXXXXXXX');
    }

    function normalizeService(rawService) {
        const service = String(rawService || '').trim().toUpperCase();
        const map = {
            MPESA: 'MPESA',
            'M-PESA': 'MPESA',
            ORANGE: 'ORANGE',
            AIRTEL: 'AIRTEL'
        };

        if (!map[service]) {
            throw new Error('Service de paiement invalide');
        }

        return map[service];
    }

    function renderRecap(tx) {
        if (!recapEl) return;

        const billet = tx.billet || {};
        if (tx.nom_complet_client) {
            currentBuyerName = tx.nom_complet_client;
        }

        const acheteur = tx.nom_complet_client || currentBuyerName || '-';
        const type = billet.type || tx.type_billet || '-';
        const quantite = billet.quantite || tx.nombre_billet || 0;
        const total = billet.montant_total || tx.montant || 0;
        const devise = billet.devise || tx.devise || '';

        recapEl.innerHTML = `
            <div class="recap-grid">
                <div class="recap-field md:col-span-2">
                    <span class="recap-label">Acheteur</span>
                    <div class="recap-value">${acheteur}</div>
                </div>
                <div class="recap-field">
                    <span class="recap-label">Type de billet</span>
                    <div class="recap-value">${type}</div>
                </div>
                <div class="recap-field">
                    <span class="recap-label">Quantite</span>
                    <div class="recap-value">${quantite}</div>
                </div>
                <div class="recap-field md:col-span-2">
                    <span class="recap-label">Total a payer</span>
                    <div class="recap-value recap-total">${total} ${devise}</div>
                </div>
            </div>
        `;

        if (transactionReferenceEl) {
            transactionReferenceEl.value = tx.reference || '';
        }

    }

    async function apiPost(url, body) {
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(body || {})
        });

        const data = await response.json().catch(() => ({}));

        if (!response.ok || data.status === false) {
            throw new Error(data.message || 'Erreur API');
        }

        return data;
    }

    async function apiGet(url) {
        const response = await fetch(url, {
            headers: {
                'Accept': 'application/json'
            }
        });

        const data = await response.json().catch(() => ({}));

        if (!response.ok || data.status === false) {
            throw new Error(data.message || 'Erreur API');
        }

        return data;
    }

    function stopPolling() {
        if (pollTimer) {
            clearInterval(pollTimer);
            pollTimer = null;
        }
        pollInFlight = false;
        pollStartedAt = null;
    }

    function resetTransactionUi() {
        recapConfirmed = false;

        if (btnDownloadRecap) {
            btnDownloadRecap.style.display = 'none';
        }
        if (btnConfirmerRecap) {
            btnConfirmerRecap.style.display = 'block';
            setLoading(btnConfirmerRecap, false);
        }
        currentDownloadUrl = null;
    }

    function highlightDownloadAction() {
        if (btnDownloadRecap) {
            btnDownloadRecap.style.display = 'block';
        }
        if (btnConfirmerRecap) {
            btnConfirmerRecap.style.display = 'none';
        }

        openRecapModal();
    }

    function downloadTicketNow() {
        if (!currentDownloadUrl) {
            setStatus('Le lien de telechargement n\'est pas encore disponible.', 'warning');
            return;
        }

        window.open(currentDownloadUrl, '_blank');
        closeRecapModal();
    }

    async function chargerRecap(reference) {
        try {
            const recap = await apiGet(`${API_BASE}/transactions/${reference}/recapitulatif`);
            renderRecap(recap.transaction || {});
        } catch (error) {
            console.warn('Recap indisponible:', error.message);
        }
    }

    async function initierTransaction(form) {
        setLoading(btnAcheter, true, 'Creation...');

        try {
            const payload = {
                type_billet: Number(form.type_billet.value),
                nombre_reel: Number(form.nombre_reel.value || 1),
                nom_complet_client: String(form.nom_complet_client.value || '').trim(),
                numero_client: normalizePhoneNumber(form.numero_client.value),
                service: normalizeService(form.service.value),
                id_evenement: Number(form.id_evenement.value),
                devise: form.devise_display.value
            };

            const data = await apiPost(`${API_BASE}/transactions/initier`, payload);
            const tx = data.transaction || {};

            if (!tx.reference) {
                throw new Error('Reference de transaction absente');
            }

            currentReference = tx.reference;
            currentBuyerName = payload.nom_complet_client;
            savePendingReference(currentReference);
            recapConfirmed = false;

            renderRecap(tx);
            await chargerRecap(currentReference);

            if (btnDownloadRecap) {
                btnDownloadRecap.style.display = 'none';
            }
            if (btnConfirmerRecap) {
                btnConfirmerRecap.style.display = 'block';
                setLoading(btnConfirmerRecap, false);
            }

            openRecapModal();
        } catch (error) {
            setStatus(`Nous n'avons pas pu lancer votre achat: ${error.message}`, 'error');
        } finally {
            setLoading(btnAcheter, false);
        }
    }

    async function validerPaiement() {
        if (!currentReference) {
            setStatus('Aucun achat en cours pour le moment.', 'error');
            return;
        }

        setAcheterDisabled(true);
        setLoading(btnConfirmerRecap, true, 'Traitement...');

        try {
            const data = await apiPost(`${API_BASE}/transactions/${currentReference}/valider-paiement`);

            if (data.pending) {
                setLoading(btnConfirmerRecap, true, 'Verification...');
            }

            startPollingConfirmation(currentReference);
        } catch (error) {
            setStatus(`Le paiement n'a pas pu etre lance: ${error.message}`, 'error');

            if (/expiree|introuvable/i.test(error.message)) {
                clearPendingReference();
                resetTransactionUi();
                currentReference = null;
            }

            setAcheterDisabled(false);
            setLoading(btnConfirmerRecap, false);
        }
    }

    function handleConfirmationStatus(data, reference) {
        const statut = data.statut;
        const downloadUrl = data.download_url;

        if (statut === 'paye' && downloadUrl) {
            stopPolling();
            currentDownloadUrl = downloadUrl;
            clearPendingReference();

            highlightDownloadAction();
            setAcheterDisabled(false);
            setLoading(btnConfirmerRecap, false);
            setStatusDownloadReadyLink('Votre billet est deja pret,');
            return;
        }

        if (statut === 'paye' && !downloadUrl) {
            setLoading(btnConfirmerRecap, true, 'Generation du billet...');
            return;
        }

        if (statut === 'paye_sans_billet') {
            setLoading(btnConfirmerRecap, true, 'Generation du billet...');
            return;
        }

        if (statut === 'echoue') {
            stopPolling();
            clearPendingReference();
            setAcheterDisabled(false);
            setLoading(btnConfirmerRecap, false);
            if (btnConfirmerRecap) btnConfirmerRecap.style.display = 'block';
            setStatus('Le paiement a echoue. Vous pouvez relancer un nouvel achat.', 'error');
            return;
        }

        if (statut === 'en_attente' || statut === 'paiement_en_cours') {
            setLoading(btnConfirmerRecap, true, 'Verification...');
            return;
        }
    }

    async function startPollingConfirmation(reference) {
        stopPolling();

        const sessionId = ++pollingSessionId;
        pollStartedAt = Date.now();

        const checkStatus = async () => {
            if (sessionId !== pollingSessionId || pollInFlight) {
                return;
            }

            pollInFlight = true;

            if (Date.now() - pollStartedAt > POLLING_TIMEOUT_MS) {
                stopPolling();
                await chargerRecap(reference);
                setAcheterDisabled(false);
                setLoading(btnConfirmerRecap, false);
                pollInFlight = false;
                return;
            }

            try {
                const data = await apiGet(`${API_BASE}/transactions/${reference}/confirmation`);
                if (sessionId !== pollingSessionId) {
                    return;
                }
                console.log('[Verification] Reponse confirmation', {
                    reference,
                    data,
                    statut: data?.statut,
                    downloadUrl: data?.download_url,
                });
                handleConfirmationStatus(data, reference);
            } catch (error) {
                console.error('[Verification] Erreur confirmation', {
                    reference,
                    error: error?.message || error,
                });
                setLoading(btnConfirmerRecap, true, 'Verification...');
            } finally {
                pollInFlight = false;
            }
        };

        await checkStatus();
        if (sessionId !== pollingSessionId) {
            return;
        }
        pollTimer = setInterval(checkStatus, POLLING_INTERVAL_MS);
    }

    function reprendreApresRefresh() {
        const saved = localStorage.getItem(STORAGE_KEY);
        if (!saved) return;

        currentReference = saved;
        recapConfirmed = true;
        setAcheterDisabled(true);

        if (btnConfirmerRecap) {
            btnConfirmerRecap.style.display = 'block';
            setLoading(btnConfirmerRecap, true, 'Verification...');
        }

        chargerRecap(saved);
        startPollingConfirmation(saved);
    }

    // ====== CALCUL PRIX ======
    function updateTotalPrice() {
        const qty = parseInt(document.getElementById('quantity').value) || 1;
        const total = currentTicketPrice * qty;

        document.getElementById('total-price').textContent =
            `${total.toLocaleString('fr-FR')} ${currentTicketDevise}`;
    }

    // ====== CHANGE DE DEVISE ======
    document.addEventListener('DOMContentLoaded', function () {

        document.getElementById('devise-display').addEventListener('change', function () {
            const devise = this.value;

            if (!tauxUSD_CDF) return;

            if (devise === 'USD') {
                currentTicketPrice = baseTicketPrice / tauxUSD_CDF;
                currentTicketDevise = 'USD';
            } else {
                currentTicketPrice = baseTicketPrice;
                currentTicketDevise = 'CDF';
            }

            document.getElementById('unit-price').textContent =
                `${currentTicketPrice.toLocaleString('fr-FR')} ${currentTicketDevise}`;

            updateTotalPrice();
        });

        // ====== BOUTONS ACHAT ======
        document.querySelectorAll('.buy-ticket-btn').forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();

                openPaymentModal(
                    this.dataset.ticketType,
                    this.dataset.ticketPrice,
                    this.dataset.ticketId,
                    this.dataset.ticketDevise
                );
            });
        });

        // ====== QUANTITE ======
        document.getElementById('quantity')
            .addEventListener('input', updateTotalPrice);

        // ====== SUBMIT CREATION TRANSACTION ======
        if (paymentForm) {
            paymentForm.addEventListener('submit', async function (e) {
                e.preventDefault();
                await initierTransaction(this);
            });
        }

        if (btnDownloadRecap) {
            btnDownloadRecap.addEventListener('click', function () {
                downloadTicketNow();
            });
        }

        if (btnCopyReference) {
            btnCopyReference.addEventListener('click', async function () {
                const reference = transactionReferenceEl ? transactionReferenceEl.value.trim() : '';
                if (!reference) {
                    setStatus('Aucune reference d\'achat a copier.', 'warning');
                    return;
                }

                try {
                    if (navigator.clipboard && navigator.clipboard.writeText) {
                        await navigator.clipboard.writeText(reference);
                    } else {
                        if (transactionReferenceEl) {
                            transactionReferenceEl.focus();
                            transactionReferenceEl.select();
                        }
                        document.execCommand('copy');
                    }

                    setStatus('Reference d\'achat copiee avec succes.', 'success');
                } catch (error) {
                    setStatus('Copie automatique impossible. Copiez le code manuellement.', 'warning');
                }
            });
        }

        if (statusEl) {
            statusEl.addEventListener('click', function (e) {
                const link = e.target.closest('[data-open-recap]');
                if (link) {
                    e.preventDefault();
                    openRecapFromStatus();
                    return;
                }

                const downloadLink = e.target.closest('[data-download-ticket]');
                if (!downloadLink) return;

                e.preventDefault();
                if (currentDownloadUrl) {
                    downloadTicketNow();
                } else {
                    openRecapFromStatus();
                }
            });
        }

        if (btnConfirmerRecap) {
            btnConfirmerRecap.addEventListener('click', async function () {
                recapConfirmed = true;
                try {
                    setLoading(btnConfirmerRecap, true, 'Validation...');
                    setStatus('Recapitulatif confirme. Lancement du paiement...', 'progress');
                    await validerPaiement();
                } catch (error) {
                    setLoading(btnConfirmerRecap, false);
                }
            });
        }

        // ====== CLICK OUTSIDE MODAL ======
        window.addEventListener('click', function (e) {
            if (e.target.id === 'payment-modal') closePaymentModal();
            if (e.target.id === 'recap-modal') closeRecapModal();
            if (e.target.id === 'qr-modal') closeQRModal();
        });

        // ====== ESCAPE KEY ======
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closePaymentModal();
                closeRecapModal();
                closeQRModal();
            }
        });

        reprendreApresRefresh();

        if (typeof ScrollReveal !== 'undefined') {
            ScrollReveal().reveal('.fade-in', {
                delay: 300,
                duration: 1000
            });
        }
    });

</script>
</body>
</html>