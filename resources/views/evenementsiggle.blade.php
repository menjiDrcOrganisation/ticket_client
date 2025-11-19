<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $evenement['nom'] ?? 'Événement' }} | Billetterie MenjiDRC</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js"></script>
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
        }
        
        .modal-content {
            background: var(--secondary);
            border-radius: 15px;
            max-width: 500px;
            width: 90%;
            padding: 2rem;
            position: relative;
            animation: modalFadeIn 0.3s ease-out;
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
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .text-bounce {
            animation: bounce 2s infinite;
        }
        
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0) }
            40% { transform: translateY(-10px) }
            60% { transform: translateY(-5px) }
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

        /* Styles pour le modal de paiement amélioré */
        .payment-modal {
            max-width: 600px;
            width: 95%;
        }

        .form-input {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 12px 16px;
            color: white;
            width: 100%;
            transition: all 0.3s ease;
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

        #qrcode-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 200px;
        }
    </style>
</head>
<body class="bg-gray-900 text-white relative overflow-x-hidden">

@if(isset($error))
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-900 to-gray-800">
        <div class="text-center p-8 bg-gray-800 rounded-2xl shadow-2xl max-w-md w-full fade-in">
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
                <i data-lucide="ticket" class="w-8 h-8 text-red-500"></i>
                <span class="text-xl font-bold"> {{ $evenement['nom'] }}</span>
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
    <header class="relative min-h-screen bg-cover bg-center bg-fixed flex items-center justify-center pt-16"
        style="background-image: url('https://gestionticket.menjidrc.com/storage/app/public/{{
                $evenement['ressource'][0]['photo_affiche'] ?? 'img/concert.jpg'
            }}'); background-size: cover; ">
        <div class="absolute inset-0 hero-gradient"></div>
        
        <div class="absolute inset-0 bg-pattern"></div>

        <div class="relative z-10 text-center px-4 space-y-8 max-w-6xl mx-auto">
            <div class="inline-block bg-red-600/20 border border-red-500/30 rounded-full px-4 py-2 mb-4">
                <span class="text-red-300 text-sm font-medium">Événement à venir</span>
            </div>
            
            <h1 class="text-5xl md:text-7xl lg:text-8xl font-extrabold uppercase tracking-tight">
                <span class="bg-gradient-to-r from-white to-gray-300 bg-clip-text text-transparent text-typing">
                    {{ $evenement['nom'] }}
                </span>
            </h1>
            
            <div class="text-lg md:text-xl font-medium space-y-3 max-w-2xl mx-auto">
                <p class="flex items-center justify-center gap-2 text-float">
                    <i data-lucide="map-pin" class="w-5 h-5 text-red-500"></i> 
                    <span>{{ $evenement['salle'] }} - {{ $evenement['adresse'] }}</span>
                </p>
                <p class="flex items-center justify-center gap-2 flex-wrap">
                    <span class="font-bold text-yellow-400 flex items-center gap-1 text-bounce">
                        <i data-lucide="calendar" class="w-5 h-5"></i>
                        {{ \Carbon\Carbon::parse($evenement['date_debut'])->translatedFormat('d F Y') }} à {{ \Carbon\Carbon::parse($evenement['heure_debut'])->format('H:i') }}
                    </span>
                    <span class="text-gray-300 mx-2 hidden md:inline">→</span>
                    <span class="text-gray-300 flex items-center gap-1 text-bounce">
                        <i data-lucide="clock" class="w-5 h-5"></i>
                        Jusqu'au {{ \Carbon\Carbon::parse($evenement['date_fin'])->translatedFormat('d F Y') }} à {{ \Carbon\Carbon::parse($evenement['heure_fin'])->format('H:i') }}
                    </span>
                </p>
            </div>

            <!-- Compte à rebours -->
            <div class="py-6">
                <h3 class="text-xl font-semibold mb-4 text-gray-300">L'événement commence dans:</h3>
                <div id="countdown" class="flex justify-center gap-4">
                    <div class="countdown-item flex flex-col items-center">
                        <span id="days" class="text-3xl font-bold text-white">00</span>
                        <span class="text-sm text-gray-400">Jours</span>
                    </div>
                    <div class="countdown-item flex flex-col items-center">
                        <span id="hours" class="text-3xl font-bold text-white">00</span>
                        <span class="text-sm text-gray-400">Heures</span>
                    </div>
                    <div class="countdown-item flex flex-col items-center">
                        <span id="minutes" class="text-3xl font-bold text-white">00</span>
                        <span class="text-sm text-gray-400">Minutes</span>
                    </div>
                </div>
            </div>

            <!-- Phrase d'accroche -->
            @if(isset($evenement['ressource'][0]['phrase_accroche']))
            <div class="bg-white/10 backdrop-blur-md rounded-2xl p-8 max-w-3xl mx-auto border border-white/20">
                <p class="text-xl md:text-2xl text-center italic text-gray-200 text-gradient-animate">
                    "{{ $evenement['ressource'][0]['phrase_accroche'] }}"
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
    <section id="about" class="py-20 bg-gray-800 px-6 md:px-20 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-red-500 to-transparent"></div>
        
        <div class="max-w-6xl mx-auto">
            <h2 class="text-4xl font-bold mb-6 text-center">À propos de l'événement</h2>
            <div class="bg-gray-900/50 rounded-2xl p-8 md:p-12 shadow-2xl">
                <p class="text-lg leading-relaxed text-gray-300 text-center md:text-left">
                    {{ $evenement['ressource'][0]['a_propos'] ?? 'Aucune description disponible pour cet événement.' }}
                </p>
            </div>
        </div>
    </section>

    
    <!-- Section billets -->
<section id="tickets" class="py-20 bg-gray-900 px-6 md:px-20">
    <div class="max-w-6xl mx-auto">
        <h2 class="text-4xl font-bold mb-12 text-center">Billets disponibles</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($evenement['type_billets'] as $index => $billet)
                <div class="ticket-card shadow-2xl hover-lift rounded-2xl p-8 flex flex-col items-center text-center">
                    <div class="bg-red-100 p-4 rounded-2xl mb-6">
                        <i data-lucide="ticket" class="w-12 h-12 text-red-600"></i>
                    </div>
                    <h3 class="text-2xl font-semibold mb-3">Billet {{ $billet['nom_type'] }}</h3>
                    <p class="text-gray-600 mb-6">Accès à l'événement avec placement libre</p>
                    <p class="text-4xl font-bold text-red-600 mb-2">{{ number_format($billet['pivot']['prix_unitaire'] ?? 0, 0, ',', ' ') }} {{ $billet['pivot']['devise'] ?? 'FC' }}</p>
                    <p class="text-sm text-gray-500 mb-6">Disponible</p>
                    <a  class="w-full buy-ticket-btn  bg-red-600 hover:bg-red-700 text-white py-3 rounded-full font-bold transition-all duration-300 transform hover:scale-105
                    "   data-ticket-type="{{ $billet['nom_type'] }}"
                            data-ticket-price="{{ $billet['pivot']['prix_unitaire'] ?? '0' }}"
                            data-ticket-id="{{ $billet['id'] }}"
                            data-ticket-devise="{{ $billet['pivot']['devise'] }}">
                        Acheter maintenant
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

    <!-- Section lieu -->
    <section id="location" class="py-20 bg-gray-800 px-6 md:px-20">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-4xl font-bold mb-12 text-center">Lieu de l'événement</h2>
            
            <div class="bg-gray-900 rounded-2xl overflow-hidden shadow-2xl">
                <div class="md:flex">
                    <div class="w-full p-8 md:p-12">
                      
                        <div class="space-y-4">

                            <div class="flex items-start gap-3">
                                <i data-lucide="map-pin" class="w-5 h-5 text-red-500 mt-1"></i>
                                <div>
                                    <p class="font-medium">Salle</p>
                                    <p class="text-gray-400">{{ $evenement['salle'] }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <i data-lucide="map-pin" class="w-5 h-5 text-red-500 mt-1"></i>
                                <div>
                                    <p class="font-medium">Adresse</p>
                                    <p class="text-gray-400">{{ $evenement['adresse'] }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start gap-3">
                                <i data-lucide="calendar" class="w-5 h-5 text-red-500 mt-1"></i>
                                <div>
                                    <p class="font-medium">Date et heure</p>
                                    <p class="text-gray-400">
                                        {{ \Carbon\Carbon::parse($evenement['date_debut'])->translatedFormat('d F Y') }} à {{ \Carbon\Carbon::parse($evenement['heure_debut'])->format('H:i') }} - 
                                        {{ \Carbon\Carbon::parse($evenement['date_fin'])->translatedFormat('d F Y') }} à {{ \Carbon\Carbon::parse($evenement['heure_fin'])->format('H:i') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-8">
                            <a href="https://maps.google.com/?q={{ urlencode($evenement['adresse']) }}" 
                               target="_blank" 
                               class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg transition-all duration-300">
                                <i data-lucide="navigation" class="w-5 h-5"></i>
                                Voir sur Google Maps
                            </a>
                        </div>
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
            
            <h3 class="text-2xl font-bold mb-2" id="modal-title">Finalisez votre achat</h3>
            <p class="text-gray-400 mb-6" id="modal-subtitle">Remplissez vos informations pour compléter votre achat</p>
            
            <form id="payment-form" class="space-y-4">
                <input type="hidden" value="{{ $evenement['id'] }}" name="id_evenement" />
                <input type="hidden" id="selected-ticket-type" name="type_billet" />

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="fullname" class="block text-sm font-medium text-gray-300 mb-1">Nom complet</label>
                        <input type="text" id="fullname" name="nom_complet_client" class="form-input" required>
                    </div>
                    
                    <div>
                        <label for="telephone" class="block text-sm font-medium text-gray-300 mb-1">Téléphone</label>
                        <input type="tel" id="telephone" name="numero_client"  placeholder="+243xxxxxxxxx" class="form-input" required  
                        pattern="^\+243[0-9]{9}$"
                        title="Le numéro doit être au format +243 suivi de 9 chiffres.">
                                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="service" class="block text-sm text-black font-medium mb-1">Service de paiement</label>
                        <select id="service" name="service" class="form-input" required>
                            <option value="MPESA">MPESA</option>
                            <option value="orange">ORANGEMONEY</option>
                            <option value="airtel">AIRTELMONEY</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="devise" class="block text-sm font-medium text-gray-300 mb-1">Devise</label>
                        <div id="devise" class="form-input bg-gray-700 font-semibold">
                            USD
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="quantity" class="block text-sm font-medium text-gray-300 mb-1">Nombre de billets</label>
                        <input type="number" id="quantity" name="nombre_reel" min="1" value="1" class="form-input" required>
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
                        <span id="total-price" class="text-2xl font-bold text-white">0 FC</span>
                    </div>
                    
                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white py-3 rounded-lg font-semibold transition-all duration-300 flex items-center justify-center gap-2">
                        <i data-lucide="credit-card" class="w-5 h-5"></i>
                        Procéder au paiement
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal QR Code CORRIGÉ -->
    <div id="qr-modal" class="modal">
        <div class="modal-content">
            <button class="close-modal" onclick="closeQRModal()">
                <i data-lucide="x"></i>
            </button>

            <h2 class="text-2xl font-bold text-center mb-4">Votre billet</h2>

            <div class="flex justify-center mb-6">
                <div id="qrcode-container" class="bg-white p-4 rounded-lg">
                    <!-- Le QR code sera généré ici -->
                </div>
            </div>

            <div class="text-center space-y-4">
                <p class="text-gray-300" id="ticket-info">Billet pour <span id="client-name-display"></span></p>
                <p class="text-sm text-gray-400" id="ticket-code">Code: <span id="code-display"></span></p>
                <div class="flex flex-col sm:flex-row gap-2 justify-center">
                    <button onclick="downloadTicket()" class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-semibold flex items-center justify-center gap-2">
                        <i data-lucide="download" class="w-4 h-4"></i>
                        Télécharger PDF
                    </button>
                </div>
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
                    <p class="text-gray-400 mb-4">Votre plateforme de billetterie de confiance pour les meilleurs événements en République Démocratique du Congo.</p>
                    
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
                        <li><a href="#about" class="text-gray-400 hover:text-white transition-colors">À propos</a></li>
                        <li><a href="#tickets" class="text-gray-400 hover:text-white transition-colors">Billets</a></li>
                        <li><a href="#location" class="text-gray-400 hover:text-white transition-colors">Lieu</a></li>
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
                    </ul>
                </div>
            </div>
            
            <div class="pt-8 border-t border-gray-800 text-center text-gray-500">
                <p>© {{ date('Y') }} Menji DRC — Tous droits réservés.</p>
            </div>
        </div>
    </footer>
@endif


<script>
    lucide.createIcons();
    
    // Variables globales pour le QR code
    let currentQRCode = '';
    let currentClientName = '';
    let currentTicketPrice = 0;
    let currentTicketId = '';
    
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
    
    // Compte à rebours
    function startCountdown() {
        const dateDebut = "{{ $evenement['date_debut'] }}";
        const heureDebut = "{{ $evenement['heure_debut'] }}";
        
        const [year, month, day] = dateDebut.split('-');
        const [hours, minutes] = heureDebut.split(':');
        
        const eventDate = new Date(
            parseInt(year),
            parseInt(month) - 1,
            parseInt(day),
            parseInt(hours),
            parseInt(minutes)
        );
        
        function updateCountdown() {
            const now = new Date();
            const timeDiff = eventDate.getTime() - now.getTime();
            
            if (timeDiff <= 0) {
                document.getElementById('countdown').innerHTML = 
                    '<div class="text-2xl font-bold text-green-400">L\'événement a commencé! 🎉</div>';
                return;
            }
            
            const days = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
            const hours = Math.floor((timeDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));
            
            document.getElementById('days').textContent = days.toString().padStart(2, '0');
            document.getElementById('hours').textContent = hours.toString().padStart(2, '0');
            document.getElementById('minutes').textContent = minutes.toString().padStart(2, '0');
        }
        
        updateCountdown();
        setInterval(updateCountdown, 60000);
    }
    
    // Gestion du modal de paiement
    function openPaymentModal(ticketType, ticketPrice, ticketId,ticketDevise) {
        console.log('Opening modal for:', ticketType, ticketPrice, ticketId);
        
        currentTicketPrice = parseFloat(ticketPrice) || 0;
        currentTicketId = ticketId;
        
        document.getElementById('modal-title').textContent = `Acheter un billet ${ticketType}`;
        document.getElementById('selected-ticket-type').value = ticketId;
        document.getElementById('unit-price').textContent = `${currentTicketPrice.toLocaleString('fr-FR')} FC`;
        document.getElementById('devise').textContent = ticketDevise;
        updateTotalPrice();
        document.getElementById('payment-modal').style.display = 'flex';
        
        // Réinitialiser le formulaire
        document.getElementById('payment-form').reset();
    }
    
    function closePaymentModal() {
        document.getElementById('payment-modal').style.display = 'none';
    }
    
    function updateTotalPrice() {
        const quantity = parseInt(document.getElementById('quantity').value) || 1;
        const total = currentTicketPrice * quantity;
        document.getElementById('total-price').textContent = `${total.toLocaleString('fr-FR')} FC`;
    }
    
    // Modal QR Code - VERSION CORRIGÉE
    function closeQRModal() {
        document.getElementById('qr-modal').style.display = 'none';
        // Nettoyer le QR code précédent
        const container = document.getElementById('qrcode-container');
        container.innerHTML = '';
    }

    // Fonction pour générer le QR code - VERSION SIMPLIFIÉE ET CORRIGÉE
    function generateQRCode(text, containerId) {
        return new Promise((resolve, reject) => {
            const container = document.getElementById(containerId);
            container.innerHTML = ''; // Nettoyer le contenu précédent
            
            // Créer un canvas élément
            const canvas = document.createElement('canvas');
            container.appendChild(canvas);
            
            // Options pour le QR code
            const options = {
                width: 200,
                height: 200,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            };
            
            try {
                // Générer le QR code directement sur le canvas
                QRCode.toCanvas(canvas, text, options, function(error) {
                    if (error) {
                        console.error('Erreur génération QR code:', error);
                        container.innerHTML = '<p class="text-red-500">Erreur génération QR code</p>';
                        reject(error);
                        return;
                    }
                    
                    console.log('QR code généré avec succès');
                    resolve(canvas);
                });
            } catch (error) {
                console.error('Erreur lors de la génération du QR code:', error);
                container.innerHTML = '<p class="text-red-500">Erreur technique</p>';
                reject(error);
            }
        });
    }

    // Alternative plus simple pour générer le QR code
    function generateQRCodeSimple(text, containerId) {

        console.log("erreur ici");
        console.log(text);
        console.log(containerId);
        
        const container = document.getElementById(containerId);
        container.innerHTML = '';
        
        try {
            QRCode.toCanvas(text, {
                width: 200,
                margin: 1,
                color: {
                    dark: '#000000',
                    light: '#FFFFFF'
                }
            }, function(err, canvas) {
                if (err) {
                    console.error('Erreur QR code:', err);
                    container.innerHTML = '<p class="text-red-500 text-center">Erreur de génération du QR code</p>';
                    return;
                }
                
                if (canvas) {
                    container.appendChild(canvas);
                } else {
                    container.innerHTML = '<p class="text-red-500 text-center">Canvas non généré</p>';
                }
            });
        } catch (error) {
            console.error('Erreur capturee:', error);
            container.innerHTML = '<p class="text-red-500 text-center">Erreur technique</p>';
        }
    }

    // Téléchargement du ticket - VERSION CORRIGÉE
   async function downloadTicket() {
    try {
        if (!currentQRCode || !currentClientName) {
            alert("Informations du billet manquantes !");
            return;
        }

        const { jsPDF } = window.jspdf;
        // Format portrait compact type téléphone
        const pdf = new jsPDF('p', 'mm', [120, 80]);
        const pageWidth = pdf.internal.pageSize.getWidth();
        const pageHeight = pdf.internal.pageSize.getHeight();

        // ----------------------
        // En-tête "PARTY PASS"
        // ----------------------
        const headerHeight = 15;
        pdf.setFillColor(0, 0, 0); // Fond noir
        pdf.rect(0, 0, pageWidth, headerHeight, 'F');

        pdf.setFont('helvetica', 'bold');
        pdf.setTextColor(255, 255, 255);
        pdf.setFontSize(16);
        pdf.text("{{ $evenement['nom'] }}", pageWidth / 2, 30, { align: "center" });

        // ----------------------
        // Titre événement
        // ----------------------
        pdf.setTextColor(0, 0, 0);
        pdf.setFontSize(14);
        pdf.text("{{$evenement['nom'] }}", pageWidth / 2, 25, { align: "right" });

        pdf.setFontSize(10);
        pdf.text("Trade Manager OP", pageWidth / 2, 32, { align: "right" });

        // ----------------------
        // Tableau informations
        // ----------------------
        let y = 40;

        // Ligne 1 : Prix / Cilt / Nilt
        pdf.setFontSize(9);
        pdf.setFont('helvetica', 'normal');
        pdf.text("Prix", 10, y);
        pdf.text("Nombre billet", 40, y);
        pdf.text("Total", 65, y);

        y += 5;
        pdf.setFont('helvetica', 'bold');
        pdf.setFontSize(10);
        pdf.text("500 fc", 10, y);
        pdf.text("2", 40, y);
        pdf.text("1000 fc", 65, y);

        y += 8;

        // Ligne 2 : Hru / Date / Temps
        pdf.setFont('helvetica', 'normal');
        pdf.setFontSize(9);
        pdf.text("Date", 40, y);
        pdf.text("Heure", 65, y);

        y += 5;
        pdf.setFont('helvetica', 'bold');
        pdf.setFontSize(10);
        pdf.text("{{ \Carbon\Carbon::parse($evenement['date_debut'])->format('d M Y') }}", 40, y);
        pdf.text("1:20h", 65, y);

        // ----------------------
        // QR Code CENTRÉ EN BAS
        // ----------------------
        const qrCodeDataURL = await new Promise(resolve => {
            QRCode.toDataURL(currentQRCode, {
                width: 80,
                margin: 1,
                color: { dark: '#000000', light: '#FFFFFF' }
            }, (err, url) => {
                if (err) {
                    console.error('Erreur génération QR code:', err);
                    resolve(null);
                } else {
                    resolve(url);
                }
            });
        });

        if (qrCodeDataURL) {
            const qrSize = 30; // Taille réduite pour le bas
            const qrX = (pageWidth - qrSize) / 2; // Centré horizontalement
            const qrY = pageHeight - qrSize - 15; // Positionné en bas avec marge
            
            pdf.addImage(qrCodeDataURL, 'PNG', qrX, qrY, qrSize, qrSize);
            
            // Code texte sous le QR code
            pdf.setFontSize(7);
            pdf.setTextColor(100);
            pdf.text("MenjiDRC", pageWidth / 2, qrY + qrSize + 3, { align: "center" });
            pdf.text("ce code est utilisé pour scanner ", pageWidth / 2, qrY+4 + qrSize + 3, { align: "center" });
        }

        // ----------------------
        // Lignes de séparation
        // ----------------------
        pdf.setDrawColor(200, 200, 200);
        pdf.line(5, 38, pageWidth - 5, 38); // Au-dessus du tableau
        pdf.line(5, 55, pageWidth - 5, 55); // Entre les lignes du tableau

        // ----------------------
        // Informations supplémentaires
        // ----------------------
        pdf.setFontSize(7);
        pdf.setTextColor(100);
        pdf.text(`Nom: ${currentClientName}`, 5, 65);
        
        // ----------------------
        // Sauvegarde PDF
        // ----------------------
        const fileName = `party-pass-${currentClientName.replace(/\s+/g, '-')}.pdf`;
        pdf.save(fileName);

    } catch (error) {
        console.error('Erreur génération PDF:', error);
        alert('Erreur lors de la génération du PDF: ' + error.message);
    }
}

    // Événements
    document.addEventListener('DOMContentLoaded', function() {
        // Gestion des boutons d'achat
        document.querySelectorAll('.buy-ticket-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.stopPropagation(); // Empêche la propagation de l'événement
                
                const ticketType = this.getAttribute('data-ticket-type');
                const ticketPrice = this.getAttribute('data-ticket-price');
                const ticketId = this.getAttribute('data-ticket-id');
                const ticketDevise=this.getAttribute('data-ticket-devise');

                
                openPaymentModal(ticketType, ticketPrice, ticketId,ticketDevise);
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
                devise: this.devise.value,
                service: this.service.value
            };
            
            currentClientName = formData.nom_complet_client;
            
            // Validation basique
            if (!formData.nom_complet_client || !formData.numero_client) {
                alert('Veuillez remplir tous les champs obligatoires.');
                return;
            }
            
            try {
                // Afficher un indicateur de chargement
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i data-lucide="loader" class="w-5 h-5 animate-spin"></i> Traitement...';
                lucide.createIcons();
                
                const response = await fetch("http://127.0.0.1:8000/api/billet/achatBillet", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify(formData),
                });

                const result = await response.json();
                
                console.log('Résultat API:', result);
                
                // Restaurer le bouton
                submitBtn.innerHTML = originalText;
                lucide.createIcons();
                
                if (result.status === true) {
                     
                    closePaymentModal();
                    
                    currentQRCode = result.billet.code_billet;
             

                    currentClientName = formData.nom_complet_client;
                    
                    // Afficher les informations dans le modal
                    document.getElementById('client-name-display').textContent = currentClientName;
                    
                    // Générer le QR code avec la méthode simple
                    generateQRCodeSimple(currentQRCode, 'qrcode-container');
                    document.getElementById('qr-modal').style.display = 'flex';
                    
                } else {
                    alert(result.message || "Paiement échoué. Vérifiez vos informations.");
                }
            } catch (error) {
                console.error('Erreur lors du paiement:', error);
                alert("Le paiement a échoué. Une erreur inattendue est survenue.");
            }
        });
        
        // Fermer les modals en cliquant à l'extérieur
        window.addEventListener('click', function(e) {
            const paymentModal = document.getElementById('payment-modal');
            const qrModal = document.getElementById('qr-modal');
            
            if (e.target === paymentModal) closePaymentModal();
            if (e.target === qrModal) closeQRModal();
        });
        
        // Initialisation
        startCountdown();
        if (typeof ScrollReveal !== 'undefined') {
            ScrollReveal().reveal('.fade-in', { delay: 300, duration: 1000 });
        }
    });
</script>
</body>
</html>