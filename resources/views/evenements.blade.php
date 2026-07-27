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

        .site-nav {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid #f1f5f9;
        }

        .site-logo {
            height: 2.6rem;
            width: auto;
        }

        .nav-link {
            position: relative;
            color: #475569;
            font-weight: 600;
            font-size: 0.95rem;
            transition: color 0.25s ease;
        }

        .nav-link:hover {
            color: #0f172a;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -0.45rem;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, #ef4444 0%, #f59e0b 100%);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.25s ease;
        }

        .nav-link.active {
            color: #0f172a;
        }

        .nav-link.active::after {
            transform: scaleX(1);
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1.4fr 1fr 1fr;
            gap: 2.25rem;
        }

        .footer-list a {
            color: #94a3b8;
            transition: color 0.2s ease;
        }

        .footer-list a:hover {
            color: #f8fafc;
        }

        .social-icon {
            width: 3rem;
            height: 3rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 9999px;
            color: #cbd5e1;
            transition: color 0.2s ease, background 0.2s ease, transform 0.2s ease;
        }

        .social-icon svg {
            width: 1.25rem;
            height: 1.25rem;
            fill: currentColor;
        }

        .social-icon:hover {
            color: #ffffff;
            transform: translateY(-1px);
        }

        .about-feature {
            display: flex;
            align-items: flex-start;
            gap: 0.65rem;
            color: #475569;
            font-size: 0.95rem;
            line-height: 1.5;
        }

        .about-feature i {
            color: #dc2626;
            width: 1rem;
            height: 1rem;
            margin-top: 0.2rem;
            flex-shrink: 0;
        }

        .about-metric {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            padding: 1rem;
            text-align: center;
        }
        
        .hero-gradient {
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.8) 0%, rgba(225, 29, 72, 0.6) 100%);
        }
        
        .event-card {
            position: relative;
            display: flex;
            flex-direction: column;
            height: 100%;
            background: linear-gradient(180deg, #ffffff 0%, #fbfdff 100%);
            border: 1px solid rgba(226, 232, 240, 0.9);
            border-radius: 1.35rem;
            overflow: hidden;
            box-shadow: 0 16px 40px rgba(15, 23, 42, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
        }
        
        .event-card:hover {
            transform: translateY(-6px);
            border-color: rgba(248, 113, 113, 0.35);
            box-shadow: 0 24px 48px rgba(15, 23, 42, 0.14);
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
        
        .status-badge,
        .event-category-badge {
            position: absolute;
            top: 0.95rem;
            z-index: 10;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 2.2rem;
            padding: 0.45rem 0.9rem;
            border-radius: 9999px;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.01em;
            backdrop-filter: blur(10px);
            box-shadow: 0 12px 24px rgba(15, 23, 42, 0.16);
        }

        .status-badge {
            right: 0.95rem;
            background: rgba(255, 255, 255, 0.92);
        }

        .event-category-badge {
            left: 0.95rem;
            background: rgba(15, 23, 42, 0.82);
            color: #f8fafc;
            border: 1px solid rgba(255, 255, 255, 0.2);
            max-width: 68%;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .filter-badge-count {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-left: 0.45rem;
            min-width: 1.4rem;
            min-height: 1.4rem;
            padding: 0 0.35rem;
            border-radius: 9999px;
            background: #eef2f7;
            color: #334155;
            font-size: 0.72rem;
            font-weight: 700;
            line-height: 1;
        }

        .filter-badge.active .filter-badge-count {
            background: rgba(255, 255, 255, 0.22);
            color: #ffffff;
        }

        .status-combo-wrap {
            display: flex;
            justify-content: center;
            margin-top: 0.95rem;
        }

        .status-combo {
            width: min(23rem, 100%);
            min-height: 3.15rem;
            padding: 0.8rem 2.9rem 0.8rem 1.25rem;
            border: 1px solid #cfe0f5;
            border-radius: 9999px;
            background: #ffffff;
            color: #0f172a;
            font-size: 1rem;
            font-weight: 700;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: linear-gradient(45deg, transparent 50%, #475569 50%), linear-gradient(135deg, #475569 50%, transparent 50%);
            background-position: calc(100% - 1.15rem) calc(50% - 0.12rem), calc(100% - 0.8rem) calc(50% - 0.12rem);
            background-size: 0.52rem 0.52rem, 0.52rem 0.52rem;
            background-repeat: no-repeat;
            transition: border-color 0.25s ease, box-shadow 0.25s ease;
        }

        .status-combo:focus {
            outline: none;
            border-color: #0f172a;
            box-shadow: 0 0 0 3px rgba(15, 23, 42, 0.12);
        }
        
        .status-active {
            color: #15803d;
            border: 1px solid rgba(34, 197, 94, 0.32);
        }
        
        .status-upcoming {
            color: #ef4444;
            border: 1px solid rgba(248, 113, 113, 0.35);
        }
        
        .status-soldout {
            color: #b91c1c;
            border: 1px solid rgba(239, 68, 68, 0.32);
        }
        
        .event-image {
            height: 220px;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .event-image::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(15, 23, 42, 0.12) 0%, rgba(15, 23, 42, 0.5) 100%);
            z-index: 0;
        }
        
        .event-image::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 50%;
            background: linear-gradient(transparent, rgba(0,0,0,0.45));
        }

        .event-card-content {
            display: flex;
            flex: 1;
            flex-direction: column;
            gap: 0.95rem;
            padding: 1.2rem 1.2rem 1.3rem;
        }

        .event-type-inline {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            width: fit-content;
            padding: 0.28rem 0.7rem;
            border-radius: 9999px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            color: #334155;
            font-size: 0.78rem;
            font-weight: 600;
            line-height: 1;
            margin-top: -0.35rem;
        }

        .event-type-inline svg {
            width: 0.82rem;
            height: 0.82rem;
        }

        .event-meta-list {
            display: flex;
            flex-direction: column;
            gap: 0.65rem;
        }

        .event-meta-item {
            display: flex;
            align-items: flex-start;
            gap: 0.65rem;
            color: #475569;
        }

        .event-meta-icon {
            width: 1.9rem;
            height: 1.9rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 9999px;
            background: #f8fafc;
            color: #334155;
            flex-shrink: 0;
        }

        .event-meta-icon svg {
            width: 0.95rem;
            height: 0.95rem;
        }

        .event-card-footer {
            margin-top: auto;
            padding-top: 0.3rem;
        }

        .event-cta {
            width: 100%;
            min-height: 3.15rem;
            border-radius: 0.9rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: #ffffff;
            font-size: 0.98rem;
            font-weight: 700;
            transition: transform 0.25s ease, box-shadow 0.25s ease, background 0.25s ease;
            box-shadow: 0 16px 30px rgba(220, 38, 38, 0.24);
        }

        .event-cta:hover {
            transform: translateY(-1px);
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            box-shadow: 0 20px 36px rgba(220, 38, 38, 0.3);
        }
        
        /* Styles pour la recherche et filtres */
        .search-filter-container {
            background: white;
            border-radius: 1rem;
            box-shadow: none;
            padding: 1.5rem;
            margin-bottom: 2rem;
            width: 100%;
            box-sizing: border-box;
        }
        
        .search-box {
            position: relative;
            width: 70%;
            margin: 0 auto 1.5rem;
        }
        
        .search-input {
            width: 100%;
            min-height: 3.2rem;
            padding: 0.95rem 1.15rem 0.95rem 3rem;
            border: 1px solid #e2e8f0;
            border-radius: 9999px;
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

        .filter-badges {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 0.65rem;
        }

        .filter-badge {
            border: 1px solid #dbe4ef;
            background: #ffffff;
            color: #0f172a;
            padding: 0.55rem 1rem;
            border-radius: 9999px;
            font-size: 0.88rem;
            font-weight: 600;
            transition: all 0.25s ease;
            white-space: nowrap;
        }

        .filter-badge:hover {
            border-color: #cbd5e1;
            background: #f8fafc;
        }

        .filter-badge.active {
            background: #1e293b;
            border-color: #0f172a;
            color: #ffffff;
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

            .site-logo {
                height: 3rem;
            }

            .footer-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
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

            .search-box {
                width: 100%;
            }

            .status-combo {
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

            .event-category-badge {
                font-size: 0.72rem;
                max-width: 52%;
            }

            .event-card-content {
                padding: 1rem;
            }
            
            .mobile-padding {
                padding-left: 1rem;
                padding-right: 1rem;
            }
            
            .mobile-text-center {
                text-align: center;
            }
            
            .card-title {
                font-size: 1.4rem !important;
                text-align: left;
            }
            
            .card-text {
                font-size: 0.9rem !important;
                text-align: left;
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

            .event-meta-icon {
                width: 1.75rem;
                height: 1.75rem;
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

            .event-cta {
                min-height: 3rem;
                font-size: 0.92rem;
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
<nav class="site-nav fixed top-0 left-0 w-full z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-[auto_1fr_auto] items-center py-3 gap-3">
            <a href="#accueil" class="flex items-center slide-in-left" data-nav-link>
                <img src="{{ asset('icons/Icone_Kimia.png') }}" alt="KimiaTicket" class="site-logo">
            </a>

            <div class="hidden md:flex items-center justify-center gap-8">
                <a href="#accueil" class="nav-link" data-nav-link>Accueil</a>
                <a href="#evenements" class="nav-link" data-nav-link>Événements</a>
                <a href="#apropos" class="nav-link" data-nav-link>À propos</a>
                <a href="#contact" class="nav-link" data-nav-link>Contact</a>
            </div>

            <div class="flex items-center justify-end">
                <button id="menu-toggle" class="md:hidden text-gray-700 focus:outline-none" aria-label="Ouvrir le menu" aria-controls="mobile-menu" aria-expanded="false">
                    <i data-lucide="menu" class="w-7 h-7"></i>
                </button>
            </div>
        </div>
    </div>

    <div id="mobile-menu" class="md:hidden bg-white border-t border-gray-200 hidden">
        <div class="px-4 py-4 flex flex-col space-y-3 text-center">
            <a href="#accueil" class="nav-link py-2" data-nav-link>Accueil</a>
            <a href="#evenements" class="nav-link py-2" data-nav-link>Événements</a>
            <a href="#apropos" class="nav-link py-2" data-nav-link>À propos</a>
            <a href="#contact" class="nav-link py-2" data-nav-link>Contact</a>
        </div>
    </div>
</nav>

    <!-- Hero Section -->
    <header id="accueil" class="relative bg-cover bg-center bg-fixed min-h-screen flex items-center justify-center pt-16 overflow-fix" 
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
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center  mx-auto-mobile">
                <a href="#evenements" class="bg-red-600 hover:bg-red-700 text-white  sm:px-8 py-3 sm:py-4 rounded-full font-semibold transition-all duration-300 transform hover:scale-105 pulse-animation flex items-center justify-center  text-center-mobile">
                    
                    Voir les événements
                </a>
                <a href="{{ route('demandeEvenement.create') }}" class="bg-white/20 hover:bg-white/30 text-white backdrop-blur-sm px-6 sm:px-8 py-3 sm:py-4 rounded-full font-semibold transition-all duration-300 transform hover:scale-105 flex items-center justify-center  border border-white/30 text-center-mobile">
                    Demander un evenement
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
                    Tous les événements
                </h2>
                <p class="section-subtitle text-lg sm:text-xl text-gray-600 max-w-2xl mx-auto  text-center-mobile">
                    Parcourez les événements en cours et les événements passés classés automatiquement par date
                </p>
            </div>

            <!-- Barre de recherche et filtres -->
            @php
                $resolveEventType = function ($eventItem) {
                    $typeField = $eventItem['type_evenement'] ?? null;

                    if (is_array($typeField)) {
                        $rawType = $typeField['nom'] ?? $typeField['libelle'] ?? $typeField['label'] ?? null;
                    } elseif (is_string($typeField)) {
                        $rawType = $typeField;
                    } else {
                        $rawType = null;
                    }

                    $rawType = $rawType ?? ($eventItem['categorie'] ?? $eventItem['type'] ?? null);
                    $label = trim((string) $rawType);

                    return $label !== '' ? $label : 'Autre';
                };

                $categoryPairs = collect($evenements ?? [])
                    ->map(function ($eventItem) use ($resolveEventType) {
                        $label = $resolveEventType($eventItem);

                        $key = strtolower($label);

                        return [
                            'key' => $key,
                            'label' => ucwords(str_replace(['-', '_'], ' ', $label)),
                        ];
                    });

                $categoryStats = $categoryPairs
                    ->pluck('key')
                    ->countBy()
                    ->sortDesc();

                $categoryLabels = $categoryPairs
                    ->mapWithKeys(function ($item) {
                        return [$item['key'] => $item['label']];
                    });

                $availableCategories = $categoryStats->keys()->values();
            @endphp
            <div class="search-filter-container fade-in">
                <div class="search-box">
                    <i data-lucide="search" class="search-icon w-5 h-5"></i>
                    <input type="text" id="search-input" class="search-input" placeholder="Rechercher un événement par nom...">
                </div>
                
                <div class="filter-section">
                    <div class="filter-group">
                        <label class="filter-label text-center-mobile">Catégories</label>
                        <div class="filter-badges" id="category-badges">
                            <button type="button" class="filter-badge active" data-category="all">Toutes<span class="filter-badge-count">{{ collect($evenements ?? [])->count() }}</span></button>
                            @foreach($availableCategories as $categoryKey)
                                <button type="button" class="filter-badge" data-category="{{ $categoryKey }}">
                                    {{ $categoryLabels[$categoryKey] ?? 'Autre' }}
                                    <span class="filter-badge-count">{{ $categoryStats[$categoryKey] ?? 0 }}</span>
                                </button>
                            @endforeach
                        </div>

                        <div class="status-combo-wrap">
                            <select id="status-filter" class="status-combo" aria-label="Filtrer par statut">
                                <option value="all" selected>Tous les événements</option>
                                <option value="avenir">Événements à venir</option>
                                <option value="encours">Événements en cours</option>
                                <option value="passe">Événements passés</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

          

            @if(!empty($evenements))
                @php
                    $today = now()->startOfDay();
                    $evenementsCollection = collect($evenements);

                    $evenementsAvenir = $evenementsCollection->filter(function ($evenement) use ($today) {
                        $debut = \Carbon\Carbon::parse($evenement['date_debut'])->startOfDay();
                        return $debut->greaterThan($today);
                    })->values();

                    $evenementsEncours = $evenementsCollection->filter(function ($evenement) use ($today) {
                        $debut = \Carbon\Carbon::parse($evenement['date_debut'])->startOfDay();
                        $fin = \Carbon\Carbon::parse($evenement['date_fin'] ?? $evenement['date_debut'])->endOfDay();
                        return $debut->lessThanOrEqualTo($today) && $fin->greaterThanOrEqualTo($today);
                    })->values();

                    $evenementsPasses = $evenementsCollection->filter(function ($evenement) use ($today) {
                        $fin = \Carbon\Carbon::parse($evenement['date_fin'] ?? $evenement['date_debut'])->endOfDay();
                        return $fin->lessThan($today);
                    })->values();
                @endphp

                <div id="events-container" class="space-y-10 stagger-animation">
                    @foreach([
                        'Événements à venir' => $evenementsAvenir,
                        'Événements en cours' => $evenementsEncours,
                        'Événements passés' => $evenementsPasses,
                    ] as $sectionTitle => $sectionEvents)
                        @if($sectionEvents->isNotEmpty())
                            <div class="event-section">
                                <h3 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-6 text-center-mobile">{{ $sectionTitle }}</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                                    @foreach($sectionEvents as $evenement)
                                        @php
                                            $eventStartDate = \Carbon\Carbon::parse($evenement['date_debut'])->startOfDay();
                                            $eventEndDate = \Carbon\Carbon::parse($evenement['date_fin'] ?? $evenement['date_debut'])->endOfDay();

                                            if ($eventStartDate->greaterThan(now()->startOfDay())) {
                                                $statusClass = 'status-upcoming';
                                                $statusText = 'A venir';
                                                $statusValue = 'avenir';
                                            } elseif ($eventEndDate->lessThan(now()->startOfDay())) {
                                                $statusClass = 'status-soldout';
                                                $statusText = 'Passe';
                                                $statusValue = 'passe';
                                            } else {
                                                $statusClass = 'status-active';
                                                $statusText = 'En cours';
                                                $statusValue = 'encours';
                                            }
                                        @endphp
                                        @php
                                            $eventTypeRaw = $resolveEventType($evenement);
                                            $eventTypeLabel = ucwords(str_replace(['-', '_'], ' ', $eventTypeRaw));
                                            $eventTypeKey = strtolower($eventTypeRaw);
                                        @endphp
                                        <div class="event-card group mx-auto-mobile"
                                            data-name="{{ strtolower($evenement['nom']) }}"
                                            data-status="{{ $statusValue }}"
                                            data-date="{{ $evenement['date_debut'] }}"
                                            data-category="{{ $eventTypeKey }}"
                                            data-location="{{ $evenement['salle'] }}"
                                            data-price="{{ $evenement['type_billets'][0]['pivot']['prix'] ?? 0 }}">
                                            <div class="event-category-badge">
                                                {{ $eventTypeLabel }}
                                            </div>

                                            <!-- Badge de statut -->
                                            <div class="status-badge {{ $statusClass }}">
                                                {{ $statusText }}
                                            </div>

                                            <!-- Image de l'événement -->
                                            <div class="event-image"
                                                style="background-image: url('{{
                                                    isset($evenement['ressource'][0]['photo_affiche'])
                                                        ? env('ENV_POINT_URL') . '/storage/app/public/' . $evenement['ressource'][0]['photo_affiche']
                                                        : 'https://images.unsplash.com/photo-1501281668745-f7f57925c3b4?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80'
                                                }}');">
                                            </div>

                                            <!-- Contenu de la carte -->
                                            <div class="event-card-content">
                                                <h3 class="card-title text-xl sm:text-2xl font-bold mb-3 text-gray-800 group-hover:text-red-600 transition-colors text-center-mobile">
                                                    {{ ucfirst($evenement['nom']) }}
                                                </h3>

                                                <div class="event-type-inline" aria-label="Type d'événement">
                                                    <i data-lucide="tag"></i>
                                                    {{ $eventTypeLabel }}
                                                </div>

                                                <div class="event-meta-list">
                                                    @php
                                                        $numeroOrganisateur = $evenement['organisateur']['telephone']
                                                            ?? $evenement['organisateur_telephone']
                                                            ?? $evenement['contact_organisateur']
                                                            ?? null;
                                                    @endphp
                                                    <div class="event-meta-item">
                                                        <span class="event-meta-icon">
                                                            <i data-lucide="calendar-days"></i>
                                                        </span>
                                                        <span class="card-text text-sm">
                                                            {{ \Carbon\Carbon::parse($evenement['date_debut'])->translatedFormat('d F Y') }}
                                                            @if($evenement['date_debut'] !== $evenement['date_fin'])
                                                                - {{ \Carbon\Carbon::parse($evenement['date_fin'])->translatedFormat('d F Y') }}
                                                            @endif
                                                        </span>
                                                    </div>

                                                    <div class="event-meta-item">
                                                        <span class="event-meta-icon">
                                                            <i data-lucide="map-pin"></i>
                                                        </span>
                                                        <span class="card-text text-sm">{{ $evenement['salle'] }}, {{ $evenement['adresse'] }}</span>
                                                    </div>

                                                    @if(!empty($numeroOrganisateur))
                                                        <div class="event-meta-item">
                                                            <span class="event-meta-icon">
                                                                <i data-lucide="phone"></i>
                                                            </span>
                                                            <span class="card-text text-sm">Numero organisateur: {{ $numeroOrganisateur }}</span>
                                                        </div>
                                                    @endif

                                                    @if(!empty($evenement['type_billets']))
                                                        <div class="event-meta-item">
                                                            <span class="event-meta-icon">
                                                                <i data-lucide="ticket"></i>
                                                            </span>
                                                            <span class="card-text text-sm">
                                                                {{ count($evenement['type_billets']) }} type(s) de billet disponible(s)
                                                            </span>
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="event-card-footer">
                                                    <a href="/{{ $evenement['url_evenement'] ?? '1' }}" class="event-cta">
                                                        Acheter
                                                        <i data-lucide="arrow-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
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

    <section id="apropos" class="py-16 sm:py-20 px-4 md:px-12 bg-slate-50">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
                <div>
                    <h2 class="section-title text-3xl sm:text-4xl font-bold text-slate-900 mb-4 text-center-mobile">À propos de KimiaTicket</h2>
                    <p class="text-slate-600 leading-relaxed text-center-mobile mb-6">
                        KimiaTicket simplifie l'accès aux événements culturels, business et grand public en RDC.
                        Notre mission est d'offrir une expérience de billetterie fluide, fiable et rapide sur mobile comme sur desktop.
                    </p>

                    <div class="space-y-3">
                        <div class="about-feature">
                            <i data-lucide="check-circle-2"></i>
                            <span>Découverte rapide d'événements vérifiés et régulièrement mis à jour.</span>
                        </div>
                        <div class="about-feature">
                            <i data-lucide="check-circle-2"></i>
                            <span>Réservation simple avec informations claires sur le lieu, la date et les types de billets.</span>
                        </div>
                        <div class="about-feature">
                            <i data-lucide="check-circle-2"></i>
                            <span>Plateforme pensée pour une utilisation mobile fluide et une navigation intuitive.</span>
                        </div>
                    </div>

                    <div class="mt-6 flex flex-wrap gap-3 justify-center md:justify-start">
                        <span class="px-3 py-1.5 rounded-full border border-slate-200 bg-white text-slate-700 text-sm font-medium">Paiements sécurisés</span>
                        <span class="px-3 py-1.5 rounded-full border border-slate-200 bg-white text-slate-700 text-sm font-medium">Support local</span>
                        <span class="px-3 py-1.5 rounded-full border border-slate-200 bg-white text-slate-700 text-sm font-medium">Billets digitaux</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="about-metric">
                        <p class="text-2xl font-bold text-red-600">100%</p>
                        <p class="text-slate-600 text-sm mt-1">Digital</p>
                    </div>
                    <div class="about-metric">
                        <p class="text-2xl font-bold text-red-600">24/7</p>
                        <p class="text-slate-600 text-sm mt-1">Accessible</p>
                    </div>
                    <div class="about-metric">
                        <p class="text-2xl font-bold text-red-600">Rapide</p>
                        <p class="text-slate-600 text-sm mt-1">Réservation</p>
                    </div>
                    <div class="about-metric">
                        <p class="text-2xl font-bold text-red-600">Fiable</p>
                        <p class="text-slate-600 text-sm mt-1">Infos événement</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <footer id="contact" class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-6">
            <div class="footer-grid mb-10">
                <div>
                    <div class="flex items-center gap-2 mb-4 justify-center md:justify-start">
                        <img src="{{ asset('icons/Icone_Kimia.png') }}" alt="KimiaTicket" class="h-10 w-auto">
                        <span class="text-xl font-bold">Kimia<span class="text-red-500">Ticket</span></span>
                    </div>
                    <p class="text-gray-400 text-center md:text-left leading-relaxed">
                        Votre plateforme de billetterie pour découvrir, réserver et partager les meilleurs événements en RDC.
                    </p>
                    <p class="text-gray-300 mt-4 text-center md:text-left font-medium">Contact: +243 824 307 504</p>
                    <div class="flex gap-3 mt-5 justify-center md:justify-start">
                        <a href="https://www.facebook.com/share/1BfdJ6i7mD/" class="social-icon bg-gray-800 p-3 rounded-full text-gray-300 hover:bg-red-600 transition-all" aria-label="Facebook">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M13.5 9H16l-.5 3h-2v9h-3v-9H8V9h2.5V7.4C10.5 5.3 11.8 4 13.9 4H16v3h-1.6c-.6 0-.9.3-.9.9V9Z"></path>
                            </svg>
                        </a>
                        <a href="https://www.instagram.com/menjidrc?igsh=NDg1dm56dDZ5OHQx" class="social-icon bg-gray-800 p-3 rounded-full text-gray-300 hover:bg-red-600 transition-all" aria-label="Instagram">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12 7a5 5 0 1 0 0 10 5 5 0 0 0 0-10Zm0 8a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z"></path>
                                <path d="M16.8 3H7.2A4.2 4.2 0 0 0 3 7.2v9.6A4.2 4.2 0 0 0 7.2 21h9.6a4.2 4.2 0 0 0 4.2-4.2V7.2A4.2 4.2 0 0 0 16.8 3Zm2.2 13.8a2.2 2.2 0 0 1-2.2 2.2H7.2A2.2 2.2 0 0 1 5 16.8V7.2A2.2 2.2 0 0 1 7.2 5h9.6A2.2 2.2 0 0 1 19 7.2v9.6Z"></path>
                                <circle cx="17.5" cy="6.5" r="1"></circle>
                            </svg>
                        </a>
                        <a href="https://wa.me/243824307504" class="social-icon bg-gray-800 p-3 rounded-full text-gray-300 hover:bg-red-600 transition-all" aria-label="WhatsApp">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12 3a9 9 0 0 0-7.7 13.7L3 21l4.5-1.2A9 9 0 1 0 12 3Zm0 16a7 7 0 0 1-3.6-1l-.3-.2-2.7.7.7-2.6-.2-.3A7 7 0 1 1 12 19Zm3.8-5.3c-.2-.1-1.2-.6-1.4-.7-.2-.1-.3-.1-.4.1-.1.2-.5.7-.6.8-.1.1-.2.1-.4 0s-.9-.3-1.6-1c-.6-.5-1-1.2-1.1-1.4-.1-.2 0-.3.1-.4l.3-.3.2-.3c.1-.1.1-.2 0-.4l-.7-1.7c-.2-.4-.4-.4-.6-.4h-.5c-.2 0-.4.1-.6.3-.2.2-.8.8-.8 2s.8 2.3.9 2.5c.1.2 1.5 2.3 3.6 3.2.5.2.9.4 1.2.5.5.2 1 .2 1.4.1.4-.1 1.2-.5 1.3-1 .2-.5.2-.9.1-1 0-.1-.2-.2-.4-.3Z"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="text-center-mobile">
                    <h4 class="text-lg font-semibold mb-4">Navigation</h4>
                    <ul class="footer-list space-y-2">
                        <li><a href="#accueil" data-nav-link>Accueil</a></li>
                        <li><a href="#evenements" data-nav-link>Événements</a></li>
                        <li><a href="#apropos" data-nav-link>À propos</a></li>
                        <li><a href="#contact" data-nav-link>Contact</a></li>
                    </ul>
                </div>

                <div class="text-center-mobile">
                    <h4 class="text-lg font-semibold mb-4">Informations</h4>
                    <ul class="footer-list space-y-2">
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Politique de confidentialité</a></li>
                        <li><a href="#">Conditions d'utilisation</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="pt-6 border-t border-gray-800 text-center text-gray-500 fade-in text-center-mobile">
                <p>© {{ date('Y') }} Menji DRC — Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <script>
        lucide.createIcons();
        
        // Menu mobile
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const navLinks = document.querySelectorAll('[data-nav-link]');
        const trackedSections = ['accueil', 'evenements', 'apropos', 'contact']
            .map((id) => document.getElementById(id))
            .filter(Boolean);

        function setActiveLink(sectionId) {
            navLinks.forEach((link) => {
                const isActive = link.getAttribute('href') === `#${sectionId}`;
                link.classList.toggle('active', isActive);
                link.setAttribute('aria-current', isActive ? 'page' : 'false');
            });
        }

        function updateActiveLinkOnScroll() {
            const scrollPosition = window.scrollY + 140;
            let activeSection = 'accueil';

            trackedSections.forEach((section) => {
                if (scrollPosition >= section.offsetTop) {
                    activeSection = section.id;
                }
            });

            setActiveLink(activeSection);
        }
        
        if (menuToggle && mobileMenu) {
            menuToggle.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
                menuToggle.setAttribute('aria-expanded', (!mobileMenu.classList.contains('hidden')).toString());
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
                const href = this.getAttribute('href') || '';
                if (href.length < 2 || href === '#') {
                    return;
                }

                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    const navbarHeight = document.querySelector('nav')?.offsetHeight || 0;
                    const targetPosition = target.getBoundingClientRect().top + window.scrollY - navbarHeight + 4;
                    window.scrollTo({ top: targetPosition, behavior: 'smooth' });

                    if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                        mobileMenu.classList.add('hidden');
                        menuToggle?.setAttribute('aria-expanded', 'false');
                        const icon = menuToggle?.querySelector('i');
                        if (icon) {
                            icon.setAttribute('data-lucide', 'menu');
                            lucide.createIcons();
                        }
                    }

                    const sectionId = href.replace('#', '');
                    if (sectionId) {
                        setActiveLink(sectionId);
                    }
                }
            });
        });

        window.addEventListener('scroll', updateActiveLinkOnScroll, { passive: true });
        updateActiveLinkOnScroll();
        
        // FONCTIONNALITÉ DE FILTRAGE AMÉLIORÉE
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-input');
            const categoryBadges = document.querySelectorAll('#category-badges .filter-badge');
            const statusFilter = document.getElementById('status-filter');
            const eventCards = document.querySelectorAll('.event-card');
            const eventsContainer = document.getElementById('events-container');
            const eventSections = document.querySelectorAll('.event-section');
            let selectedCategory = 'all';
            let selectedStatus = statusFilter ? (statusFilter.value || 'all').toLowerCase() : 'all';

            if (!searchInput || !eventsContainer) {
                return;
            }
            
            // Fonction pour filtrer les événements
            function filterEvents() {
                const searchTerm = searchInput.value.toLowerCase().trim();
                let visibleCount = 0;
                
                eventCards.forEach(card => {
                    const eventName = (card.getAttribute('data-name') || '').toLowerCase();
                    const eventCategory = (card.getAttribute('data-category') || '').toLowerCase();
                    const eventStatus = (card.getAttribute('data-status') || '').toLowerCase();
                    
                    // Vérifier la recherche par nom
                    const nameMatch = !searchTerm || eventName.includes(searchTerm);
                    
                    // Vérifier la catégorie
                    const categoryMatch = selectedCategory === 'all' || eventCategory === selectedCategory;

                    // Vérifier le statut
                    const statusMatch = selectedStatus === 'all' || eventStatus === selectedStatus;
                    
                    // Afficher ou masquer la carte selon les critères
                    if (nameMatch && categoryMatch && statusMatch) {
                        card.style.display = '';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Masquer les sections vides après filtrage
                eventSections.forEach(section => {
                    const cardsInSection = section.querySelectorAll('.event-card');
                    let hasVisibleCard = false;

                    cardsInSection.forEach(card => {
                        if (card.style.display !== 'none') {
                            hasVisibleCard = true;
                        }
                    });

                    section.style.display = hasVisibleCard ? '' : 'none';
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
            
            // Écouter les changements dans les filtres
            searchInput.addEventListener('input', filterEvents);
            categoryBadges.forEach((badge) => {
                badge.addEventListener('click', () => {
                    selectedCategory = (badge.getAttribute('data-category') || 'all').toLowerCase();
                    categoryBadges.forEach((btn) => {
                        btn.classList.toggle('active', btn === badge);
                    });
                    filterEvents();
                });
            });

            if (statusFilter) {
                statusFilter.addEventListener('change', () => {
                    selectedStatus = (statusFilter.value || 'all').toLowerCase();
                    filterEvents();
                });
            }
            
            // Initialiser les filtres
            filterEvents();

            console.log('Filtrage par nom et catégorie initialisé avec succès');
        })
    </script>

</body>
</html>