<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $evenement['nom'] ?? 'Événement' }} | Billetterie</title>
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
            border-radius: 1rem;
            clip-path: polygon(0 0, calc(100% - 1rem) 0, 100% 50%, calc(100% - 1rem) 100%, 0 100%);
            position: relative;
            overflow: hidden;
        }
        
        .ticket-shape::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 100%);
            z-index: 1;
        }
        
        .ticket-shape > * {
            position: relative;
            z-index: 2;
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
            padding: 10px 15px;
            min-width: 80px;
        }
        
        .ticket-stripes {
            background: repeating-linear-gradient(
                45deg,
                transparent,
                transparent 10px,
                rgba(255, 255, 255, 0.05) 10px,
                rgba(255, 255, 255, 0.05) 20px
            );
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
                <span class="text-xl font-bold">Menji<span class="text-red-500">DRC</span></span>
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
        style="background-image: url('https://gestionticket.menjidrc.com/storage/app/public/{{ $evenement['ressource'][0]['photo_affiche'] ?? 'img/concert.jpg' }}');">
        <div class="absolute inset-0 hero-gradient"></div>
        
        <div class="absolute inset-0 bg-pattern"></div>

        <div class="relative z-10 text-center px-4 space-y-8 max-w-6xl mx-auto fade-in">
            <div class="inline-block bg-red-600/20 border border-red-500/30 rounded-full px-4 py-2 mb-4">
                <span class="text-red-300 text-sm font-medium">Événement à venir</span>
            </div>
            
            <h1 class="text-5xl md:text-7xl lg:text-8xl font-extrabold uppercase tracking-tight">
                <span class="bg-gradient-to-r from-white to-gray-300 bg-clip-text text-transparent">
                    {{ $evenement['nom'] }}
                </span>
            </h1>
            
            <div class="text-lg md:text-xl font-medium space-y-3 max-w-2xl mx-auto">
                <p class="flex items-center justify-center gap-2">
                    <i data-lucide="map-pin" class="w-5 h-5 text-red-500"></i> 
                    <span>{{ $evenement['salle'] }} - {{ $evenement['adresse'] }}</span>
                </p>
                <p class="flex items-center justify-center gap-2 flex-wrap">
                    <span class="font-bold text-yellow-400 flex items-center gap-1">
                        <i data-lucide="calendar" class="w-5 h-5"></i>
                        {{ $evenement['date_debut'] }} {{ $evenement['heure_debut'] }}
                    </span>
                    <span class="text-gray-300 mx-2">→</span>
                    <span class="text-gray-300 flex items-center gap-1">
                        <i data-lucide="clock" class="w-5 h-5"></i>
                        {{ $evenement['date_fin'] }} {{ $evenement['heure_fin'] }}
                    </span>
                </p>
                <p class="text-gray-300 flex items-center justify-center gap-2">
                    Statut : 
                    <span class="inline-flex items-center gap-1 bg-green-900/30 text-green-400 px-3 py-1 rounded-full">
                        <i data-lucide="check-circle" class="w-4 h-4"></i>
                        {{ $evenement['statut'] }}
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
                    <div class="countdown-item flex flex-col items-center">
                        <span id="seconds" class="text-3xl font-bold text-white">00</span>
                        <span class="text-sm text-gray-400">Secondes</span>
                    </div>
                </div>
            </div>

            <div class="pt-8">
                <a href="#tickets" class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-8 py-4 rounded-full text-lg font-semibold transition-all duration-300 transform hover:scale-105 pulse-animation">
                    <i data-lucide="shopping-cart" class="w-5 h-5"></i>
                    Acheter des billets
                </a>
            </div>
        </div>
        
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2">
            <a href="#about" class="text-white animate-bounce">
                <i data-lucide="chevron-down" class="w-8 h-8"></i>
            </a>
        </div>
    </header>

    <!-- Section description -->
    <section id="about" class="py-20 bg-gray-800 px-6 md:px-20 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-red-500 to-transparent"></div>
        
        <div class="max-w-6xl mx-auto">
            <h2 class="text-4xl font-bold mb-6 text-center slide-in-left">À propos de l'événement</h2>
            <div class="bg-gray-900/50 rounded-2xl p-8 md:p-12 shadow-2xl slide-in-right">
                <p class="text-lg leading-relaxed text-gray-300 text-center md:text-left">
                    {{ $evenement['description'] ?? 'Aucune description disponible pour cet événement.' }}
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
                    <div class="ticket-shape bg-gradient-to-br from-gray-800 to-gray-900 text-white p-6 shadow-2xl hover-lift ticket-stripes transform transition-all duration-500"
                         style="animation-delay: {{ $index * 100 }}ms">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-2xl font-bold">{{ $billet['nom_type'] }}</h3>
                            <span class="bg-red-600 text-white text-sm font-bold px-3 py-1 rounded-full">
                                {{ $billet['pivot']['nombre_billet'] }} disponibles
                            </span>
                        </div>
                        
                        <div class="my-6">
                            <p class="text-4xl font-extrabold text-red-500 mb-2">{{ $billet['prix'] ?? '—' }}$</p>
                            <p class="text-gray-400 text-sm">par personne</p>
                        </div>
                        
                        <ul class="space-y-3 mb-6">
                            <li class="flex items-center gap-2 text-gray-300">
                                <i data-lucide="check" class="w-4 h-4 text-green-500"></i>
                                <span>Accès à l'événement</span>
                            </li>
                            <li class="flex items-center gap-2 text-gray-300">
                                <i data-lucide="check" class="w-4 h-4 text-green-500"></i>
                                <span>Support client 24/7</span>
                            </li>
                            @if($billet['nom_type'] == 'VIP')
                            <li class="flex items-center gap-2 text-gray-300">
                                <i data-lucide="check" class="w-4 h-4 text-green-500"></i>
                                <span>Accès zone VIP</span>
                            </li>
                            <li class="flex items-center gap-2 text-gray-300">
                                <i data-lucide="check" class="w-4 h-4 text-green-500"></i>
                                <span>Rencontre avec les artistes</span>
                            </li>
                            @endif
                        </ul>
                        
                        <button class="w-full bg-red-600 hover:bg-red-700 text-white py-3 rounded-lg font-semibold transition-all duration-300 flex items-center justify-center gap-2"
                                onclick="openModal('{{ $billet['nom_type'] }}', '{{ $billet['prix'] ?? '0' }}')">
                            <i data-lucide="shopping-cart" class="w-5 h-5"></i>
                            Acheter maintenant
                        </button>
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
                    <div class="md:w-1/2 p-8 md:p-12">
                        <h3 class="text-2xl font-bold mb-4">{{ $evenement['salle'] }}</h3>
                        <div class="space-y-4">
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
                                        {{ $evenement['date_debut'] }} {{ $evenement['heure_debut'] }} - 
                                        {{ $evenement['date_fin'] }} {{ $evenement['heure_fin'] }}
                                    </p>
                                </div>
                            </div>
                            
                            <div class="flex items-start gap-3">
                                <i data-lucide="info" class="w-5 h-5 text-red-500 mt-1"></i>
                                <div>
                                    <p class="font-medium">Informations</p>
                                    <p class="text-gray-400">Parking disponible • Accès PMR • Restauration sur place</p>
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
                    
                    <div class="md:w-1/2 h-80 md:h-auto">
                        <!-- Carte Google Maps intégrée -->
                        <div class="w-full h-full bg-gray-700 flex items-center justify-center">
                            <div class="text-center p-4">
                                <i data-lucide="map" class="w-12 h-12 text-gray-500 mx-auto mb-4"></i>
                                <p class="text-gray-400">Carte de localisation</p>
                                <p class="text-sm text-gray-500 mt-2">{{ $evenement['adresse'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal d'achat -->
    <div id="purchase-modal" class="modal">
        <div class="modal-content">
            <button class="close-modal" onclick="closeModal()">
                <i data-lucide="x"></i>
            </button>
            
            <h3 class="text-2xl font-bold mb-2" id="modal-title">Acheter un billet</h3>
            <p class="text-gray-400 mb-6" id="modal-subtitle">Remplissez vos informations pour compléter votre achat</p>
            
            <form id="purchase-form" class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-300 mb-1">Nom complet</label>
                    <input type="text" id="name" class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-red-500" required>
                </div>
                
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Adresse email</label>
                    <input type="email" id="email" class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-red-500" required>
                </div>
                
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-300 mb-1">Téléphone</label>
                    <input type="tel" id="phone" class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-red-500" required>
                </div>
                
                <div>
                    <label for="quantity" class="block text-sm font-medium text-gray-300 mb-1">Nombre de billets</label>
                    <select id="quantity" class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-red-500">
                        <option value="1">1 billet</option>
                        <option value="2">2 billets</option>
                        <option value="3">3 billets</option>
                        <option value="4">4 billets</option>
                        <option value="5">5 billets</option>
                    </select>
                </div>
                
                <div class="pt-4 border-t border-gray-700">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-gray-400">Total:</span>
                        <span id="total-price" class="text-xl font-bold text-white">0$</span>
                    </div>
                    
                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white py-3 rounded-lg font-semibold transition-all duration-300 flex items-center justify-center gap-2">
                        <i data-lucide="credit-card" class="w-5 h-5"></i>
                        Payer maintenant
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer id="contact" class="bg-gray-900 py-12 px-6 border-t border-gray-800">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <i data-lucide="ticket" class="w-8 h-8 text-red-500"></i>
                        <span class="text-xl font-bold">Menji<span class="text-red-500">DRC</span></span>
                    </div>
                    <p class="text-gray-400">Votre plateforme de billetterie de confiance pour les meilleurs événements.</p>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4">Liens rapides</h4>
                    <ul class="space-y-2">
                        <li><a href="#about" class="text-gray-400 hover:text-white transition-colors">À propos</a></li>
                        <li><a href="#tickets" class="text-gray-400 hover:text-white transition-colors">Billets</a></li>
                        <li><a href="#location" class="text-gray-400 hover:text-white transition-colors">Lieu</a></li>
                        <li><a href="#contact" class="text-gray-400 hover:text-white transition-colors">Contact</a></li>
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
            
            <div class="pt-8 border-t border-gray-800 text-center text-gray-500">
                <p>© {{ date('Y') }} Menji DRC — Tous droits réservés.</p>
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
    
    // Compte à rebours
    const eventDate = new Date("{{ $evenement['date_debut'] ?? '' }} {{ $evenement['heure_debut'] ?? '' }}").getTime();
    if (!isNaN(eventDate)) {
        const countdownFunction = setInterval(() => {
            const now = new Date().getTime();
            const distance = eventDate - now;
            
            if (distance < 0) {
                document.getElementById('countdown').innerHTML = "<div class='text-2xl font-bold text-green-400'>L'événement a commencé! 🎉</div>";
                clearInterval(countdownFunction);
                return;
            }
            
            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
            document.getElementById('days').textContent = days.toString().padStart(2, '0');
            document.getElementById('hours').textContent = hours.toString().padStart(2, '0');
            document.getElementById('minutes').textContent = minutes.toString().padStart(2, '0');
            document.getElementById('seconds').textContent = seconds.toString().padStart(2, '0');
        }, 1000);
    }
    
    // Modal d'achat
    let currentTicketPrice = 0;
    
    function openModal(ticketType, ticketPrice) {
        currentTicketPrice = parseFloat(ticketPrice) || 0;
        document.getElementById('modal-title').textContent = `Acheter un billet ${ticketType}`;
        document.getElementById('modal-subtitle').textContent = `Prix unitaire: ${ticketPrice}$`;
        updateTotalPrice();
        document.getElementById('purchase-modal').style.display = 'flex';
    }
    
    function closeModal() {
        document.getElementById('purchase-modal').style.display = 'none';
    }
    
    function updateTotalPrice() {
        const quantity = parseInt(document.getElementById('quantity').value) || 1;
        const total = currentTicketPrice * quantity;
        document.getElementById('total-price').textContent = `${total}$`;
    }
    
    document.getElementById('quantity').addEventListener('change', updateTotalPrice);
    
    document.getElementById('purchase-form').addEventListener('submit', function(e) {
        e.preventDefault();
        // Ici, vous ajouteriez la logique de traitement du paiement
        alert('Fonctionnalité de paiement à implémenter!');
        closeModal();
    });
    
    // Fermer le modal en cliquant à l'extérieur
    window.addEventListener('click', function(e) {
        const modal = document.getElementById('purchase-modal');
        if (e.target === modal) {
            closeModal();
        }
    });
</script>
</body>
</html>