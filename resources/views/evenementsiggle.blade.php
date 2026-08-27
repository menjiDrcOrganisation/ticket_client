<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $evenement['nom'] ?? 'Événement' }} | Billetterie KimiaTicket</title>
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

        .site-nav {
            background: #ffffff;
            backdrop-filter: blur(12px);
            border-bottom: 1px solid #e2e8f0;
            box-shadow: 0 10px 28px rgba(15, 23, 42, 0.08);
        }

        .site-logo {
            height: 3rem;
            width: auto;
            max-width: 220px;
            object-fit: contain;
            object-position: left center;
            display: block;
        }

        .nav-brand {
            display: inline-flex;
            align-items: center;
            gap: 0.62rem;
            min-width: 190px;
        }

        .brand-title {
            font-size: 1.05rem;
            font-weight: 800;
            letter-spacing: 0.01em;
            color: #0f172a;
            line-height: 1;
            white-space: nowrap;
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

        #mobile-menu .nav-link {
            display: block;
            padding: 0.8rem 1rem;
            border-radius: 0.75rem;
            font-size: 1.05rem;
            font-weight: 700;
            color: #334155;
            text-align: left;
            transition: background-color 0.2s ease, color 0.2s ease;
        }

        #mobile-menu .nav-link::after {
            display: none;
        }

        #mobile-menu .nav-link:hover,
        #mobile-menu .nav-link.active {
            background: #f8fafc;
            color: #0f172a;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1.4fr 1fr 1fr;
            gap: 2.25rem;
        }

        .footer-col-center {
            text-align: left;
        }

        .footer-col-center .footer-list {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .section-padding {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .clean-panel {
            border-radius: 1.2rem;
            border: 1px solid rgba(148, 163, 184, 0.22);
            box-shadow: none;
        }

        .clean-panel-dark {
            background: rgba(15, 23, 42, 0.42);
        }

        .about-section {
            background: #0f172a;
        }

        .about-text {
            text-align: left;
            color: #f1f5f9;
            line-height: 1.6;
            max-width: 100%;
            font-size: clamp(1.15rem, 1.9vw, 1.95rem);
        }

        .about-heading {
            color: #f8fafc;
            letter-spacing: -0.01em;
        }

        .clean-panel-slate {
            background: rgba(30, 41, 59, 0.72);
        }

        .location-info-row {
            padding: 0.85rem 1rem;
            border: 1px solid rgba(148, 163, 184, 0.24);
            border-radius: 0.9rem;
            background: rgba(15, 23, 42, 0.34);
        }

        .download-form-input {
            border: 1px solid rgba(100, 116, 139, 0.5);
            background: rgba(15, 23, 42, 0.85);
        }

        .download-form-input:focus {
            border-color: rgba(250, 204, 21, 0.7);
            box-shadow: 0 0 0 2px rgba(250, 204, 21, 0.18);
        }

        .footer-detail {
            border-top: 1px solid rgba(30, 41, 59, 0.55);
        }

        .section-title-right {
            text-align: left !important;
            margin-bottom: 0.75rem !important;
            padding-right: 0;
        }

        .location-section-light {
            background: #f7f7f5;
        }

        .location-showcase {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 1.25rem;
            padding: 1.2rem;
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.1rem;
        }

        .location-route-card {
            border-radius: 1rem;
            border: 1px solid #ececec;
            min-height: 280px;
            background-color: #f7f5f0;
            background-image: repeating-linear-gradient(
                45deg,
                rgba(15, 23, 42, 0.06) 0,
                rgba(15, 23, 42, 0.06) 1px,
                transparent 1px,
                transparent 16px
            );
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 0.55rem;
            text-align: center;
            color: #0f172a;
            transition: border-color 0.2s ease, background-color 0.2s ease;
        }

        .location-route-card:hover {
            border-color: #d1d5db;
            background-color: #f5f3ee;
        }

        .location-route-title {
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: 0.02em;
        }

        .location-route-subtitle {
            font-size: 1.45rem;
            color: #64748b;
        }

        .location-copy-title {
            font-size: clamp(2rem, 4.2vw, 3rem);
            font-weight: 800;
            line-height: 1.2;
            color: #1f2937;
        }

        .location-copy-text {
            margin-top: 0.7rem;
            font-size: 1.95rem;
            color: #6b7280;
            line-height: 1.35;
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

        .gallery-card {
            border-radius: 1rem;
            overflow: hidden;
            border: 1px solid rgba(148, 163, 184, 0.35);
            background: rgba(15, 23, 42, 0.35);
            color: #ffffff;
        }

        .gallery-image {
            height: 210px;
            width: 100%;
            object-fit: cover;
            object-position: center;
            display: block;
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

        .ticket-selector-wrap {
            background: rgba(15, 23, 42, 0.56);
            border: 1px solid rgba(148, 163, 184, 0.28);
            border-radius: 1.35rem;
            padding: 1rem;
            box-shadow: 0 12px 32px rgba(15, 23, 42, 0.08);
        }

        .ticket-selector-desktop {
            width: 100%;
            max-width: 860px;
            margin-left: 0;
            margin-right: auto;
        }

        .ticket-selector-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 0.8rem;
            margin-bottom: 1rem;
        }

        .ticket-selector-label {
            font-size: 0.82rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #cbd5e1;
            font-weight: 700;
        }

        .ticket-selector-devise {
            border: 1px solid rgba(148, 163, 184, 0.35);
            border-radius: 9999px;
            padding: 0.4rem 0.75rem;
            font-size: 0.88rem;
            font-weight: 700;
            color: #f8fafc;
            background: rgba(30, 41, 59, 0.78);
            min-width: 3.2rem;
            text-align: center;
        }

        .ticket-selector-list {
            display: grid;
            grid-template-columns: 1fr;
            gap: 0.95rem;
        }

        .ticket-selector-item {
            border: 1px solid rgba(148, 163, 184, 0.28);
            border-radius: 1rem;
            padding: 0.9rem;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
            cursor: pointer;
            background: rgba(15, 23, 42, 0.34);
        }

        .ticket-selector-item.active {
            border-color: #22c55e;
            box-shadow: 0 0 0 2px rgba(34, 197, 94, 0.16);
            background: rgba(22, 101, 52, 0.24);
        }

        .ticket-selector-item.complet {
            border-color: #fca5a5;
            background: #fff7f7;
        }

        .ticket-selector-title {
            font-size: 1.02rem;
            font-weight: 700;
            color: #f8fafc;
            line-height: 1;
        }

        .ticket-selector-desc {
            color: #cbd5e1;
            margin-top: 0.35rem;
            font-size: 0.9rem;
        }

        .ticket-selector-stock {
            margin-top: 0.35rem;
            font-size: 0.82rem;
            font-weight: 600;
            color: #16a34a;
        }

        .ticket-selector-stock.is-low {
            color: #f59e0b;
        }

        .ticket-selector-stock.is-complete {
            color: #dc2626;
        }

        .ticket-selector-price {
            font-size: 1.4rem;
            font-weight: 700;
            color: #f8fafc;
        }

        .ticket-selector-check {
            width: 1.35rem;
            height: 1.35rem;
            border-radius: 9999px;
            color: #16a34a;
            opacity: 0;
            transform: scale(0.85);
            transition: opacity 0.2s ease, transform 0.2s ease;
        }

        .ticket-selector-check svg {
            width: 100%;
            height: 100%;
        }

        .ticket-selector-check.visible {
            opacity: 1;
            transform: scale(1);
        }

        .ticket-selector-stepper {
            display: inline-flex;
            align-items: center;
            border: 1px solid rgba(148, 163, 184, 0.28);
            border-radius: 9999px;
            overflow: hidden;
            background: rgba(30, 41, 59, 0.72);
        }

        .ticket-selector-stepper button {
            border: none;
            width: 2.35rem;
            height: 2.35rem;
            font-size: 1.15rem;
            font-weight: 700;
            line-height: 1;
            color: #e2e8f0;
            background: transparent;
        }

        .ticket-selector-stepper button:hover {
            background: rgba(51, 65, 85, 0.6);
            color: #ffffff;
        }

        .ticket-selector-stepper button:disabled {
            opacity: 0.4;
            cursor: not-allowed;
            background: rgba(30, 41, 59, 0.45);
        }

        .ticket-selector-qty {
            min-width: 2.1rem;
            text-align: center;
            font-size: 1.05rem;
            font-weight: 700;
            color: #f8fafc;
        }

        .ticket-selector-total {
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 2px dashed rgba(148, 163, 184, 0.38);
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
        }

        .ticket-selector-total-label {
            color: #e2e8f0;
            font-size: 0.95rem;
            line-height: 1.3;
        }

        .ticket-selector-total-value {
            color: #ffffff;
            font-size: 1.95rem;
            font-weight: 700;
            line-height: 1;
            text-align: right;
        }

        .ticket-selector-cta {
            display: block;
            width: 100%;
            margin-top: 1.2rem;
            border: none;
            border-radius: 1rem;
            min-height: 3.2rem;
            font-size: 1rem;
            font-weight: 700;
            background: rgba(71, 85, 105, 0.52);
            color: #cbd5e1;
            transition: all 0.25s ease;
        }

        .ticket-selector-cta:disabled {
            cursor: not-allowed;
            opacity: 1;
        }

        .ticket-selector-cta.active {
            cursor: pointer;
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: #ffffff;
            box-shadow: 0 10px 24px rgba(220, 38, 38, 0.28);
        }

        .ticket-selector-cta.active:hover {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            transform: translateY(-1px);
        }

        .ticket-selector-safe {
            margin-top: 1rem;
            border-radius: 0.9rem;
            background: rgba(15, 23, 42, 0.56);
            color: #e2e8f0;
            border: 1px solid rgba(148, 163, 184, 0.25);
            padding: 0.8rem 1rem;
            font-weight: 600;
            font-size: 0.86rem;
            line-height: 1.35;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        @media (min-width: 1024px) {
            .ticket-selector-desktop {
                max-width: 900px;
            }

            .ticket-selector-wrap {
                padding: 1.55rem;
                border-radius: 2.2rem;
            }

            .ticket-selector-head {
                margin-bottom: 1.15rem;
            }

            .ticket-selector-list {
                gap: 1.1rem;
            }

            .ticket-selector-item {
                padding: 1.2rem 1.25rem;
                border-radius: 1.1rem;
            }

            .ticket-selector-item-main {
                margin-bottom: 0.6rem;
            }

            .ticket-selector-item-controls {
                justify-content: flex-end;
            }

            .ticket-selector-total {
                margin-top: 1.35rem;
                padding-top: 1.2rem;
            }
        }
        
        /* Responsive améliorations */
        @media (max-width: 768px) {
            .site-logo {
                height: 2.6rem;
            }

            .brand-title {
                font-size: 0.95rem;
            }

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

            .ticket-selector-wrap {
                border-radius: 1.45rem;
                padding: 1rem;
            }

            .ticket-selector-desktop {
                margin-left: 0;
                margin-right: 0;
            }

            .ticket-selector-head {
                align-items: flex-start;
            }

            .ticket-selector-title {
                font-size: 0.96rem;
            }

            .ticket-selector-price {
                font-size: 1.2rem;
            }

            .ticket-selector-desc {
                font-size: 0.83rem;
            }

            .ticket-selector-total-label {
                font-size: 0.88rem;
            }

            .ticket-selector-total-value {
                font-size: 1.4rem;
            }

            .ticket-selector-cta {
                font-size: 0.95rem;
                min-height: 3rem;
            }

            .ticket-selector-safe {
                font-size: 0.8rem;
            }
            
            .countdown-item {
                min-width: 80px;
                padding: 10px 15px;
            }
            
            .form-grid {
                grid-template-columns: 1fr !important;
                gap: 1rem;
            }

            .footer-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .gallery-image {
                height: 170px;
            }

            .section-title-right {
                margin-bottom: 0.65rem !important;
            }

            .location-showcase {
                padding: 0.9rem;
                gap: 0.9rem;
            }

            .location-route-card {
                min-height: 230px;
            }

            .location-route-title {
                font-size: 1.7rem;
            }

            .location-route-subtitle {
                font-size: 1.2rem;
            }

            .location-copy-title {
                font-size: 2.05rem;
            }

            .location-copy-text {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 520px) {
            .ticket-selector-item-main {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.65rem;
            }

            .ticket-selector-item-controls {
                justify-content: flex-start;
            }

            .ticket-selector-total {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.35rem;
            }

            .ticket-selector-total-value {
                text-align: left;
            }
        }

        @media (min-width: 1024px) {
            .location-showcase {
                grid-template-columns: 0.95fr 1fr;
                align-items: center;
                padding: 1.45rem;
                gap: 1.6rem;
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

        .theme-toggle-btn {
            position: fixed;
            right: 1rem;
            bottom: 1rem;
            z-index: 90;
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            border: 1px solid rgba(148, 163, 184, 0.4);
            border-radius: 9999px;
            padding: 0.55rem 0.9rem;
            background: rgba(15, 23, 42, 0.9);
            color: #f8fafc;
            font-size: 0.82rem;
            font-weight: 700;
            box-shadow: 0 12px 28px rgba(2, 6, 23, 0.35);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .theme-toggle-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 16px 30px rgba(2, 6, 23, 0.45);
        }

        .theme-toggle-btn i {
            width: 1rem;
            height: 1rem;
        }

        body.light-mode {
            background: #f8fafc;
            color: #0f172a;
        }

        body.light-mode .site-nav {
            background: #ffffff;
            border-bottom-color: #e2e8f0;
            box-shadow: 0 10px 28px rgba(15, 23, 42, 0.08);
        }

        body.light-mode .brand-title,
        body.light-mode .nav-link,
        body.light-mode #mobile-menu .nav-link {
            color: #334155;
        }

        body.light-mode #mobile-menu {
            background: #ffffff;
            border-top-color: #e2e8f0;
        }

        body.light-mode #about,
        body.light-mode #galerie,
        body.light-mode #tickets {
            background: #f8fafc !important;
        }

        body.light-mode #about .section-title,
        body.light-mode #galerie .section-title,
        body.light-mode #tickets .section-title {
            color: #0f172a !important;
        }

        body.light-mode #about {
            background: #f1f5f9 !important;
        }

        body.light-mode #about .about-heading {
            color: #0f172a !important;
        }

        body.light-mode .about-text {
            color: #1e293b !important;
        }

        body.light-mode .clean-panel-dark,
        body.light-mode .clean-panel-slate,
        body.light-mode .gallery-card,
        body.light-mode .ticket-selector-wrap,
        body.light-mode .ticket-selector-item,
        body.light-mode .ticket-selector-safe {
            background: #ffffff;
            border-color: #e2e8f0;
            color: #0f172a;
        }

        body.light-mode .gallery-card p,
        body.light-mode .gallery-card .text-white {
            color: #0f172a !important;
        }

        body.light-mode .gallery-card .text-gray-300 {
            color: #64748b !important;
        }

        body.light-mode #galerie .col-span-full {
            background: #ffffff;
            border-color: #e2e8f0;
            color: #475569;
        }

        body.light-mode .ticket-selector-item.active {
            background: #f8fff9;
        }

        body.light-mode .ticket-selector-item.complet {
            border-color: #fecaca;
            background: #fff7f7;
        }

        body.light-mode .ticket-selector-title,
        body.light-mode .ticket-selector-price,
        body.light-mode .ticket-selector-total-value,
        body.light-mode .ticket-selector-qty {
            color: #0f172a;
        }

        body.light-mode .ticket-selector-desc,
        body.light-mode .ticket-selector-label,
        body.light-mode .ticket-selector-total-label,
        body.light-mode .ticket-selector-safe,
        body.light-mode .ticket-selector-devise {
            color: #475569;
        }

        body.light-mode .ticket-selector-devise {
            background: #ffffff;
            border-color: #cbd5e1;
            color: #334155;
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.5);
        }

        body.light-mode .ticket-selector-stock {
            color: #166534;
        }

        body.light-mode .ticket-selector-stock.is-low {
            color: #b45309;
        }

        body.light-mode .ticket-selector-stock.is-complete {
            color: #b91c1c;
        }

        body.light-mode .ticket-selector-stepper {
            background: #ffffff;
            border-color: #d1d5db;
        }

        body.light-mode .ticket-selector-stepper button {
            color: #334155;
        }

        body.light-mode .ticket-selector-stepper button:hover {
            background: #f8fafc;
            color: #0f172a;
        }

        body.light-mode .ticket-selector-stepper button:disabled {
            background: #f1f5f9;
            color: #94a3b8;
        }

        body.light-mode .ticket-selector-total {
            border-top-color: #cbd5e1;
        }

        body.light-mode .ticket-selector-cta:not(.active) {
            background: #e2e8f0;
            color: #64748b;
        }

        body.light-mode #tickets .clean-panel-slate h3,
        body.light-mode #tickets .clean-panel-slate p,
        body.light-mode #tickets .clean-panel-slate label {
            color: #0f172a !important;
        }

        body.light-mode #tickets .clean-panel-slate .text-red-200 {
            color: #b91c1c !important;
        }

        body.light-mode .download-form-input {
            background: #ffffff;
            color: #0f172a;
            border-color: #cbd5e1;
        }

        body.light-mode .theme-toggle-btn {
            background: #ffffff;
            color: #0f172a;
            border-color: #cbd5e1;
        }

        @media (max-width: 640px) {
            .theme-toggle-btn span {
                display: none;
            }

            .theme-toggle-btn {
                padding: 0.7rem;
            }
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
    <nav class="site-nav fixed top-0 left-0 w-full z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between py-3.5 gap-3">
                <a href="/" class="nav-brand">
                    <img src="{{ asset('icons/Icone_Kimia.png') }}" alt="KimiaTicket" class="site-logo">
                    <span class="brand-title">KimiaTicket</span>
                </a>

                <div class="hidden md:flex items-center justify-center gap-8">
                    <a href="{{ request()->fullUrl() }}" class="nav-link">Accueil</a>
                    <a href="#tickets" class="nav-link" data-nav-link>Billets</a>
                    <a href="#about" class="nav-link" data-nav-link>À propos</a>
                    <a href="#galerie" class="nav-link" data-nav-link>Galerie</a>
                    <a href="#location" class="nav-link" data-nav-link>Lieu</a>
                    <a href="#contact" class="nav-link" data-nav-link>Contact</a>
                </div>

                <button id="menu-toggle" class="md:hidden text-gray-700 focus:outline-none" aria-label="Ouvrir le menu" aria-controls="mobile-menu" aria-expanded="false">
                    <i data-lucide="menu" class="w-7 h-7"></i>
                </button>
            </div>
        </div>

        <div id="mobile-menu" class="md:hidden bg-white border-t border-gray-200 hidden">
            <div class="px-4 py-4 flex flex-col space-y-3 text-left">
                <a href="{{ request()->fullUrl() }}" class="nav-link py-2">Accueil</a>
                <a href="#tickets" class="nav-link py-2" data-nav-link>Billets</a>
                <a href="#about" class="nav-link py-2" data-nav-link>À propos</a>
                <a href="#galerie" class="nav-link py-2" data-nav-link>Galerie</a>
                <a href="#location" class="nav-link py-2" data-nav-link>Lieu</a>
                <a href="#contact" class="nav-link py-2" data-nav-link>Contact</a>
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
                <p class="flex items-center justify-center gap-2 flex-wrap">
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
    <section id="about" class="about-section py-16 md:py-20 section-padding">
        <div class="max-w-6xl mx-auto">
            <h2 class="section-title section-title-right about-heading text-3xl md:text-4xl font-bold">
                À propos de l'événement
            </h2>
            @php
                $aboutTextRaw = data_get($evenement, 'ressource.0.a_propos');
                $aboutText = is_string($aboutTextRaw)
                    ? trim(preg_replace('/\s+/u', ' ', $aboutTextRaw))
                    : '';
            @endphp
            <p class="about-text mt-8">
                {{ $aboutText !== '' ? $aboutText : "La description de cet événement n'est pas encore disponible." }}
            </p>
        </div>
    </section>

    

    <section id="galerie" class="py-16 md:py-20 bg-gray-900 section-padding">
        <div class="max-w-6xl mx-auto">
            <h2 class="section-title section-title-right text-white text-3xl md:text-4xl font-bold">
                Galerie
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 md:gap-6">
                @php
                    $heroGalleryPhoto = data_get($evenement, 'ressource.0.photo_affiche');
                    $heroGalleryUrl = $heroGalleryPhoto
                        ? env('ENV_POINT_URL') . '/storage/app/public/' . $heroGalleryPhoto
                        : asset('img/concert.jpg');

                    $galleryItems = collect($evenement['ressource'] ?? [])->filter(function ($item) {
                        return !empty($item['photo_affiche']);
                    });
                @endphp

                @forelse($galleryItems as $item)
                    <article class="gallery-card">
                        <img
                            src="{{ env('ENV_POINT_URL') }}/storage/app/public/{{ $item['photo_affiche'] }}"
                            alt="{{ $item['nom_artiste'] ?? $evenement['nom'] }}"
                            class="gallery-image"
                        />
                        @if(!empty($item['nom_artiste']) || !empty($item['phrase_accroche']))
                            <div class="p-4">
                                @if(!empty($item['nom_artiste']))
                                    <p class="text-white font-semibold">{{ $item['nom_artiste'] }}</p>
                                @endif
                                @if(!empty($item['phrase_accroche']))
                                    <p class="text-gray-300 text-sm mt-1">{{ $item['phrase_accroche'] }}</p>
                                @endif
                            </div>
                        @endif
                    </article>
                @empty
                    <article class="gallery-card col-span-full">
                        <img
                            src="{{ $heroGalleryUrl }}"
                            alt="{{ $evenement['nom'] ?? 'Visuel événement' }}"
                            class="gallery-image"
                        />
                        <div class="p-4">
                            <p class="text-white font-semibold">Visuel principal de l'événement</p>
                        </div>
                    </article>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Section billets -->
    <section id="tickets" class="py-16 md:py-20 bg-gray-900 section-padding">
        <div class="max-w-6xl mx-auto">
            <h2 class="section-title section-title-right text-3xl text-white md:text-4xl font-bold">
                Billets
            </h2>

            <div class="ticket-selector-wrap ticket-selector-desktop">
                <div class="ticket-selector-head">
                    <p class="ticket-selector-label">Choisis tes billets</p>
                    <span id="ticket-selector-devise" class="ticket-selector-devise">USD</span>
                </div>

                <div class="ticket-selector-list">
                    @foreach($evenement['type_billets'] as $billet)
                        @php
                            $ticketId = (string) ($billet['id'] ?? '');
                            $ticketType = $billet['nom_type'] ?? 'Standard';
                            $ticketPrice = (float) ($billet['pivot']['prix_unitaire'] ?? 0);
                            $ticketDevise = $billet['pivot']['devise'] ?? 'USD';
                            $ticketStockRaw = data_get($billet, 'pivot.quantite_disponible')
                                ?? data_get($billet, 'pivot.quantite')
                                ?? data_get($billet, 'pivot.stock')
                                ?? data_get($billet, 'quantite_disponible')
                                ?? data_get($billet, 'quantite')
                                ?? data_get($billet, 'stock')
                                ?? data_get($billet, 'nombre_billet_restant')
                                ?? data_get($billet, 'billets_restants');
                            $ticketStock = is_numeric($ticketStockRaw) ? max(0, (int) $ticketStockRaw) : null;
                        @endphp
                        <article class="ticket-selector-item" data-ticket-row="{{ $ticketId }}" data-ticket-max="{{ $ticketStock ?? '' }}">
                            <div class="ticket-selector-item-main flex items-start justify-between gap-4 mb-3">
                                <div>
                                    <h3 class="ticket-selector-title">{{ $ticketType }}</h3>
                                    <p class="ticket-selector-desc">Accès au festival</p>
                                    <p
                                        class="ticket-selector-stock {{ is_int($ticketStock) && $ticketStock === 0 ? 'is-complete' : '' }}"
                                        data-ticket-stock="{{ $ticketId }}"
                                        data-ticket-max="{{ $ticketStock ?? '' }}"
                                    >
                                        @if(is_int($ticketStock))
                                            @if($ticketStock > 0)
                                                {{ $ticketStock }} billet(s) restant(s)
                                            @else
                                                Complet
                                            @endif
                                        @else
                                            Disponible
                                        @endif
                                    </p>
                                </div>
                                <div class="flex flex-col items-end gap-1">
                                    <p class="ticket-selector-price">${{ number_format($ticketPrice, 2, '.', ',') }}</p>
                                    <span class="ticket-selector-check" data-ticket-check="{{ $ticketId }}">
                                        <i data-lucide="check-circle-2"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="ticket-selector-item-controls flex justify-end">
                                <div class="ticket-selector-stepper">
                                    <button
                                        type="button"
                                        data-stepper-action="minus"
                                        data-ticket-id="{{ $ticketId }}"
                                        data-ticket-type="{{ $ticketType }}"
                                        data-ticket-price="{{ $ticketPrice }}"
                                        data-ticket-devise="{{ $ticketDevise }}"
                                        data-ticket-max="{{ $ticketStock ?? '' }}"
                                    >-</button>
                                    <span class="ticket-selector-qty" data-ticket-qty="{{ $ticketId }}">0</span>
                                    <button
                                        type="button"
                                        data-stepper-action="plus"
                                        data-ticket-id="{{ $ticketId }}"
                                        data-ticket-type="{{ $ticketType }}"
                                        data-ticket-price="{{ $ticketPrice }}"
                                        data-ticket-devise="{{ $ticketDevise }}"
                                        data-ticket-max="{{ $ticketStock ?? '' }}"
                                    >+</button>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="ticket-selector-total">
                    <p class="ticket-selector-total-label">Total (<span id="ticket-selector-total-qty">0</span> billet)</p>
                    <p id="ticket-selector-total-price" class="ticket-selector-total-value">$0.00</p>
                </div>

                <button id="ticket-selector-continue" type="button" class="ticket-selector-cta" disabled>
                    Sélectionne au moins 1 billet
                </button>

                <div class="ticket-selector-safe">
                    <i data-lucide="lock"></i>
                    Paiement sécurisé · M-Pesa · Airtel · Orange Money
                </div>
            </div>

            <div class="mt-10 clean-panel clean-panel-slate p-6 md:p-8 max-w-3xl mr-auto">
                <h3 class="text-xl md:text-2xl font-bold text-white text-left mb-2">Télécharger mon billet</h3>
                <p class="text-gray-300 mb-5">
                    Entrez votre code transaction pour récupérer votre billet déjà payé.
                </p>

                @if(session('ticket_download_error'))
                    <div class="mb-4 p-3 rounded-lg border border-red-500/50 bg-red-500/15 text-red-200 text-sm">
                        {{ session('ticket_download_error') }}
                    </div>
                @endif

                <form action="{{ route('ticket.download.by.transaction') }}" method="POST" class="flex flex-col md:flex-row gap-3">
                    @csrf
                    <input
                        type="text"
                        name="transaction_reference"
                        value="{{ old('transaction_reference') }}"
                        placeholder="Ex: CMD-20260530120000-AB12CD34EF56"
                        class="form-input download-form-input flex-1"
                        required
                    />
                    <button
                        type="submit"
                        class="bg-yellow-500 hover:bg-yellow-600 text-black px-5 py-3 rounded-lg font-bold transition-all duration-300"
                    >
                        Télécharger
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Section lieu -->
    <section id="location" class="py-16 md:py-20 section-padding location-section-light">
        <div class="max-w-6xl mx-auto">
            <h2 class="section-title section-title-right text-gray-900 text-3xl md:text-4xl font-bold">
                Lieu de l'événement
            </h2>
            
            <div class="location-showcase">
                <a href="https://maps.google.com/?q={{ urlencode($evenement['adresse']) }}"
                   target="_blank"
                   class="location-route-card"
                   aria-label="Ouvrir l'itinéraire Google Maps">
                    <i data-lucide="map-pin" class="w-9 h-9 text-gray-700"></i>
                    <p class="location-route-title">Ouvrir l'itinéraire</p>
                    <p class="location-route-subtitle">Google Maps</p>
                </a>

                <div>
                    <h3 class="location-copy-title">
                        {{ $evenement["salle"] }},<br>{{ $evenement["adresse"] }}
                    </h3>
                    <p class="location-copy-text">{{ $evenement["salle"] }}, {{ $evenement["adresse"] }}</p>
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

    <!-- Modal récapitulatif transaction -->
    <div id="recap-modal" class="modal">
        <div class="modal-content max-w-lg bg-gray-900">
            <button class="close-modal" onclick="closeRecapModal()">
                <i data-lucide="x"></i>
            </button>

            <h3 class="text-xl md:text-2xl text-white font-bold mb-2">
                Récapitulatif de votre achat
            </h3>
           
            <label for="transaction-reference" class="block text-sm font-medium text-gray-300 mb-1">Référence d'achat</label>
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
                Votre billet est prêt
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
    <footer id="contact" class="bg-gray-900 text-white py-12 footer-detail">
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
                    @php
                        $numeroOrganisateur = $evenement['organisateur']['telephone']
                            ?? $evenement['organisateur_telephone']
                            ?? $evenement['contact_organisateur']
                            ?? null;
                    @endphp
                    <p class="text-gray-300 mt-4 text-center md:text-left font-medium">Contact: {{ $numeroOrganisateur ?? 'Non disponible' }}</p>
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

                <div class="footer-col-center">
                    <h4 class="text-lg font-semibold mb-4">Navigation</h4>
                    <ul class="footer-list space-y-2">
                        <li><a href="{{ request()->fullUrl() }}">Accueil</a></li>
                        <li><a href="#tickets" data-nav-link>Billets</a></li>
                        <li><a href="#about" data-nav-link>À propos</a></li>
                        <li><a href="#galerie" data-nav-link>Galerie</a></li>
                        <li><a href="#location" data-nav-link>Lieu</a></li>
                    </ul>
                </div>

                <div class="footer-col-center">
                    <h4 class="text-lg font-semibold mb-4">Informations</h4>
                    <ul class="footer-list space-y-2">
                        <li><a href="#contact" data-nav-link>Contact</a></li>
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
    @endif

    <button id="theme-toggle" class="theme-toggle-btn" type="button" aria-label="Basculer le thème">
        <i data-lucide="sun"></i>
        <span id="theme-toggle-label">Mode clair</span>
    </button>

    <script>
    lucide.createIcons();

    const API_BASE = "{{ rtrim((string) env('ENV_POINT_URL', ''), '/') }}/api/v1";
    const STORAGE_KEY = 'pending_transaction_reference';
    const THEME_STORAGE_KEY = 'kimia_ticket_theme';
    const POLLING_INTERVAL_MS = 4000;
    const POLLING_TIMEOUT_MS = 180000;

    function applyTheme(theme) {
        const isLight = theme === 'light';
        document.body.classList.toggle('light-mode', isLight);

        const themeIcon = document.querySelector('#theme-toggle i');
        const themeLabel = document.getElementById('theme-toggle-label');
        if (themeIcon) {
            themeIcon.setAttribute('data-lucide', isLight ? 'moon' : 'sun');
        }
        if (themeLabel) {
            themeLabel.textContent = isLight ? 'Mode sombre' : 'Mode clair';
        }

        if (window.lucide && typeof lucide.createIcons === 'function') {
            lucide.createIcons();
        }
    }

    function initThemeToggle() {
        const savedTheme = localStorage.getItem(THEME_STORAGE_KEY);
        const preferredTheme = savedTheme || 'dark';
        applyTheme(preferredTheme);

        const themeToggle = document.getElementById('theme-toggle');
        if (!themeToggle) {
            return;
        }

        themeToggle.addEventListener('click', () => {
            const nextTheme = document.body.classList.contains('light-mode') ? 'dark' : 'light';
            localStorage.setItem(THEME_STORAGE_KEY, nextTheme);
            applyTheme(nextTheme);
        });
    }

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
    const ticketSelectorState = {};
    let selectedTicketId = null;

    const statusEl = document.getElementById('status');
    const recapEl = document.getElementById('recap');
    const paymentForm = document.getElementById('payment-form');
    const btnAcheter = paymentForm ? paymentForm.querySelector('button[type="submit"]') : null;
    const recapModalEl = document.getElementById('recap-modal');
    const transactionReferenceEl = document.getElementById('transaction-reference');
    const btnCopyReference = document.getElementById('btnCopyReference');
    const btnConfirmerRecap = document.getElementById('btnConfirmerRecap');
    const btnDownloadRecap = document.getElementById('btnDownloadRecap');
    const ticketSelectorContinueBtn = document.getElementById('ticket-selector-continue');

    // ====== MENU MOBILE ======
    const menuToggle = document.getElementById('menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    const navLinks = document.querySelectorAll('[data-nav-link]');
    const trackedSections = ['about', 'galerie', 'tickets', 'location', 'contact']
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
        let activeSection = 'about';

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

            const icon = menuToggle.querySelector('i');
            icon.setAttribute(
                'data-lucide',
                mobileMenu.classList.contains('hidden') ? 'menu' : 'x'
            );

            menuToggle.setAttribute('aria-expanded', (!mobileMenu.classList.contains('hidden')).toString());

            lucide.createIcons();
        });
    }

    navLinks.forEach((link) => {
        link.addEventListener('click', () => {
            if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                mobileMenu.classList.add('hidden');
                menuToggle?.setAttribute('aria-expanded', 'false');
                const icon = menuToggle?.querySelector('i');
                if (icon) {
                    icon.setAttribute('data-lucide', 'menu');
                    lucide.createIcons();
                }
            }
        });
    });

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
    function openPaymentModal(ticketType, ticketPrice, ticketId, ticketDevise, ticketQty = 1) {
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

        const qtyInput = document.getElementById('quantity');
        if (qtyInput) {
            qtyInput.value = String(Math.max(1, parseInt(ticketQty, 10) || 1));
        }

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
        setStatus(`${prefixText} <a href="#" id="status-download-link" data-download-ticket class="status-recap-link">télécharger ici</a>.`, 'success', true);

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
            setStatus('Aucun récapitulatif disponible pour le moment.', 'error');
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
                    <span class="recap-label">Total à payer</span>
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
            setStatus('Le lien de téléchargement n\'est pas encore disponible.', 'warning');
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
                throw new Error('Référence de transaction absente');
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
                setLoading(btnConfirmerRecap, true, 'Vérification...');
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
            setStatusDownloadReadyLink('Votre billet est déjà prêt,');
            return;
        }

        if (statut === 'paye' && !downloadUrl) {
            setLoading(btnConfirmerRecap, true, 'Génération du billet...');
            return;
        }

        if (statut === 'paye_sans_billet') {
            setLoading(btnConfirmerRecap, true, 'Génération du billet...');
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
            setLoading(btnConfirmerRecap, true, 'Vérification...');
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
                setLoading(btnConfirmerRecap, true, 'Vérification...');
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
            setLoading(btnConfirmerRecap, true, 'Vérification...');
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

    function initializeTicketSelectorState() {
        document.querySelectorAll('[data-ticket-qty]').forEach((qtyEl) => {
            const ticketId = qtyEl.getAttribute('data-ticket-qty');
            if (ticketId) {
                ticketSelectorState[ticketId] = 0;
            }
        });
    }

    function getSelectedTicketInfo() {
        const stepperButtons = document.querySelectorAll('[data-stepper-action="plus"]');
        for (const btn of stepperButtons) {
            const ticketId = btn.getAttribute('data-ticket-id');
            const qty = ticketSelectorState[ticketId] || 0;
            if (qty > 0) {
                return {
                    id: ticketId,
                    type: btn.getAttribute('data-ticket-type') || 'Standard',
                    price: parseFloat(btn.getAttribute('data-ticket-price') || '0') || 0,
                    devise: btn.getAttribute('data-ticket-devise') || 'USD',
                    qty,
                };
            }
        }
        return null;
    }

    function renderTicketSelectorSummary() {
        let totalQty = 0;
        let totalAmount = 0;
        const firstDeviseEl = document.querySelector('[data-stepper-action="plus"]');
        let totalDevise = firstDeviseEl?.getAttribute('data-ticket-devise') || 'USD';

        const plusButtons = document.querySelectorAll('[data-stepper-action="plus"]');
        plusButtons.forEach((btn) => {
            const ticketId = btn.getAttribute('data-ticket-id');
            const qty = ticketSelectorState[ticketId] || 0;
            const price = parseFloat(btn.getAttribute('data-ticket-price') || '0') || 0;
            const devise = btn.getAttribute('data-ticket-devise') || 'USD';
            const maxAttr = btn.getAttribute('data-ticket-max');
            const maxStock = maxAttr !== null && maxAttr !== '' ? Math.max(0, parseInt(maxAttr, 10) || 0) : null;

            const rowEl = document.querySelector(`[data-ticket-row="${ticketId}"]`);
            const checkEl = document.querySelector(`[data-ticket-check="${ticketId}"]`);
            const stockEl = document.querySelector(`[data-ticket-stock="${ticketId}"]`);
            const plusBtn = document.querySelector(`[data-stepper-action="plus"][data-ticket-id="${ticketId}"]`);
            const minusBtn = document.querySelector(`[data-stepper-action="minus"][data-ticket-id="${ticketId}"]`);
            const isSelected = selectedTicketId === ticketId;

            if (rowEl) {
                rowEl.classList.toggle('active', isSelected);
                rowEl.classList.toggle('complet', maxStock === 0);
            }
            if (checkEl) {
                checkEl.classList.toggle('visible', isSelected);
            }

            if (stockEl) {
                stockEl.classList.remove('is-low', 'is-complete');
                if (maxStock === null) {
                    stockEl.textContent = 'Disponible';
                } else {
                    const remaining = Math.max(0, maxStock - qty);
                    if (remaining === 0) {
                        stockEl.textContent = 'Complet';
                        stockEl.classList.add('is-complete');
                    } else {
                        stockEl.textContent = `${remaining} billet(s) restant(s)`;
                        if (remaining <= 5) {
                            stockEl.classList.add('is-low');
                        }
                    }
                }
            }

            if (plusBtn && maxStock !== null) {
                plusBtn.disabled = maxStock === 0 || qty >= maxStock;
            }

            if (minusBtn) {
                minusBtn.disabled = qty <= 0;
            }

            if (qty > 0) {
                totalQty += qty;
                totalAmount += qty * price;
                totalDevise = devise;
            }
        });

        const totalQtyEl = document.getElementById('ticket-selector-total-qty');
        const totalPriceEl = document.getElementById('ticket-selector-total-price');
        const deviseEl = document.getElementById('ticket-selector-devise');

        if (totalQtyEl) {
            totalQtyEl.textContent = String(totalQty);
        }

        if (totalPriceEl) {
            totalPriceEl.textContent = `${totalAmount.toLocaleString('fr-FR', { minimumFractionDigits: 2, maximumFractionDigits: 2 })} ${totalDevise}`;
        }

        if (deviseEl) {
            deviseEl.textContent = totalDevise;
        }

        if (ticketSelectorContinueBtn) {
            const enabled = totalQty > 0;
            ticketSelectorContinueBtn.disabled = !enabled;
            ticketSelectorContinueBtn.classList.toggle('active', enabled);
            ticketSelectorContinueBtn.textContent = enabled
                ? 'Continuer vers le paiement'
                : 'Sélectionne au moins 1 billet';
        }

        const totalLabelEl = document.querySelector('.ticket-selector-total-label');
        if (totalLabelEl) {
            totalLabelEl.innerHTML = `Total (<span id="ticket-selector-total-qty">${totalQty}</span> ${totalQty > 1 ? 'billets' : 'billet'})`;
        }
    }

    function adjustTicketQty(buttonEl) {
        const action = buttonEl.getAttribute('data-stepper-action');
        const ticketId = buttonEl.getAttribute('data-ticket-id');
        if (!ticketId) return;

        selectedTicketId = ticketId;

        const currentQty = ticketSelectorState[ticketId] || 0;
        const maxAttr = buttonEl.getAttribute('data-ticket-max');
        const maxStock = maxAttr !== null && maxAttr !== '' ? Math.max(0, parseInt(maxAttr, 10) || 0) : null;

        if (action === 'plus') {
            if (maxStock !== null && (maxStock === 0 || currentQty >= maxStock)) {
                renderTicketSelectorSummary();
                return;
            }

            Object.keys(ticketSelectorState).forEach((id) => {
                ticketSelectorState[id] = 0;
                const qtyEl = document.querySelector(`[data-ticket-qty="${id}"]`);
                if (qtyEl) qtyEl.textContent = '0';
            });

            ticketSelectorState[ticketId] = currentQty + 1;
        } else {
            ticketSelectorState[ticketId] = Math.max(0, currentQty - 1);
        }

        const activeQtyEl = document.querySelector(`[data-ticket-qty="${ticketId}"]`);
        if (activeQtyEl) {
            activeQtyEl.textContent = String(ticketSelectorState[ticketId]);
        }

        renderTicketSelectorSummary();
    }

    function selectTicketRow(rowEl) {
        const ticketId = rowEl.getAttribute('data-ticket-row');
        if (!ticketId) return;

        const maxAttr = rowEl.getAttribute('data-ticket-max');
        const maxStock = maxAttr !== null && maxAttr !== '' ? Math.max(0, parseInt(maxAttr, 10) || 0) : null;
        if (maxStock === 0) {
            selectedTicketId = null;
            Object.keys(ticketSelectorState).forEach((id) => {
                ticketSelectorState[id] = 0;
                const qtyEl = document.querySelector(`[data-ticket-qty="${id}"]`);
                if (qtyEl) qtyEl.textContent = '0';
            });
            renderTicketSelectorSummary();
            return;
        }

        selectedTicketId = ticketId;

        Object.keys(ticketSelectorState).forEach((id) => {
            if (id !== ticketId) {
                ticketSelectorState[id] = 0;
                const qtyEl = document.querySelector(`[data-ticket-qty="${id}"]`);
                if (qtyEl) qtyEl.textContent = '0';
            }
        });

        renderTicketSelectorSummary();
    }

    // ====== CHANGE DE DEVISE ======
    document.addEventListener('DOMContentLoaded', function () {
        initThemeToggle();
        setActiveLink('about');
        updateActiveLinkOnScroll();
        window.addEventListener('scroll', updateActiveLinkOnScroll, { passive: true });

        initializeTicketSelectorState();
        renderTicketSelectorSummary();

        document.querySelectorAll('[data-ticket-row]').forEach((row) => {
            row.addEventListener('click', function (e) {
                if (e.target.closest('[data-stepper-action]')) {
                    return;
                }
                selectTicketRow(this);
            });
        });

        document.querySelectorAll('[data-stepper-action]').forEach((btn) => {
            btn.addEventListener('click', function () {
                adjustTicketQty(this);
            });
        });

        if (ticketSelectorContinueBtn) {
            ticketSelectorContinueBtn.addEventListener('click', function () {
                const selected = getSelectedTicketInfo();
                if (!selected) {
                    return;
                }

                openPaymentModal(
                    selected.type,
                    selected.price,
                    selected.id,
                    selected.devise,
                    selected.qty
                );
            });
        }

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
                    setStatus('Aucune référence d\'achat à copier.', 'warning');
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

                    setStatus('Référence d\'achat copiée avec succès.', 'success');
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
                    setStatus('Récapitulatif confirmé. Lancement du paiement...', 'progress');
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