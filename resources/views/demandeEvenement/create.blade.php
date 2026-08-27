<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Demande d'événement</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Tailwind CDN pour le style clair et moderne -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .site-nav {
            background: #ffffff;
            backdrop-filter: blur(12px);
            border-bottom: 1px solid #e2e8f0;
            box-shadow: 0 10px 28px rgba(15, 23, 42, 0.08);
        }

        .site-logo {
            height: 3.2rem;
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

        @media (max-width: 768px) {
            .site-logo {
                height: 2.6rem;
            }

            .brand-title {
                font-size: 0.95rem;
            }
        }
    </style>
</head>
<body class="bg-gray-100">

<nav class="site-nav fixed top-0 left-0 w-full z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between py-3.5 gap-3">
            <a href="{{ route('evenements.all') }}#accueil" class="nav-brand">
                <img src="{{ asset('icons/Icone_Kimia.png') }}" alt="KimiaTicket" class="site-logo">
                <span class="brand-title">KimiaTicket</span>
            </a>

            <div class="hidden md:flex items-center justify-center gap-8">
                <a href="{{ route('evenements.all') }}#accueil" class="nav-link">Accueil</a>
                <a href="{{ route('evenements.all') }}#evenements" class="nav-link">Événements</a>
                <a href="{{ route('demandeEvenement.create') }}" class="nav-link active" aria-current="page">Demander un événement</a>
                <a href="{{ route('evenements.all') }}#apropos" class="nav-link">À propos</a>
                <a href="{{ route('evenements.all') }}#contact" class="nav-link">Contact</a>
            </div>

            <button id="menu-toggle" class="md:hidden text-gray-700 focus:outline-none" aria-label="Ouvrir le menu" aria-controls="mobile-menu" aria-expanded="false">
                <i data-lucide="menu" class="w-7 h-7"></i>
            </button>
        </div>
    </div>

    <div id="mobile-menu" class="md:hidden bg-white border-t border-gray-200 hidden">
        <div class="px-4 py-4 flex flex-col space-y-3 text-left">
            <a href="{{ route('evenements.all') }}#accueil" class="nav-link py-2">Accueil</a>
            <a href="{{ route('evenements.all') }}#evenements" class="nav-link py-2">Événements</a>
            <a href="{{ route('demandeEvenement.create') }}" class="nav-link py-2 active" aria-current="page">Demander un événement</a>
            <a href="{{ route('evenements.all') }}#apropos" class="nav-link py-2">À propos</a>
            <a href="{{ route('evenements.all') }}#contact" class="nav-link py-2">Contact</a>
        </div>
    </div>
</nav>

<div class="max-w-3xl mx-auto mt-28 mb-10 p-6 bg-white rounded shadow-md">

    <h1 class="text-2xl font-bold mb-6 text-gray-800">Créer une demande d'événement</h1>

    {{-- Messages succès/erreur --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    {{-- Erreurs validation --}}
    @if ($errors->any())
        <div class="bg-red-50 border border-red-300 p-3 rounded mb-4">
            <ul class="list-disc list-inside text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('demandeEvenement.send') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf

        <div>
            <label class="block font-semibold text-gray-700 mb-1">Nom de l'événement *</label>
            <input type="text" name="nom_evenement" value="{{ old('nom_evenement') }}"
                   class="w-full border border-gray-300 rounded p-2">
            @error('nom_evenement')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block font-semibold text-gray-700 mb-1">Contact organisateur (mettre l'email ou votre numéro de téléphone) *</label>
            <input type="text" name="contact_organisateur" value="{{ old('contact_organisateur') }}"
                   class="w-full border border-gray-300 rounded p-2">
            @error('contact_organisateur')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

       <div>
            <label class="block font-semibold text-gray-700 mb-1">Type d'événement *</label>
            <select name="type_evenement" class="w-full border border-gray-300 rounded p-2">
                <option value="">-- Choisir --</option>
                <option value="Concert" {{ old('type_evenement') == 'Concert' ? 'selected' : '' }}>Concert</option>
                <option value="Conférence" {{ old('type_evenement') == 'Conférence' ? 'selected' : '' }}>Conférence</option>
                <option value="Atelier" {{ old('type_evenement') == 'Atelier' ? 'selected' : '' }}>Atelier</option>
                <option value="Exposition" {{ old('type_evenement') == 'Exposition' ? 'selected' : '' }}>Exposition</option>
                <option value="Festival" {{ old('type_evenement') == 'Festival' ? 'selected' : '' }}>Festival</option>
                <!-- Tu peux ajouter d'autres options ici -->
            </select>
            @error('type_evenement')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block font-semibold text-gray-700 mb-1">Description *</label>
            <textarea name="description" rows="4"
                      class="w-full border border-gray-300 rounded p-2">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block font-semibold text-gray-700 mb-1">Affiche (Image)</label>
            <input type="file" name="affiche" class="w-full border border-gray-300 rounded p-2">
            @error('affiche')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div style="display: none;">
            <label class="block font-semibold text-gray-700 mb-1">Statut</label>
            <select name="statut" class="w-full border border-gray-300 rounded p-2">
                <option value="en_attente" {{ old('statut') == 'en_attente' ? 'selected' : '' }}>En attente</option>
              
            </select>
            @error('statut')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="text-center">
            <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700">
                Envoyer la demande
            </button>
        </div>

    </form>
</div>

<script>
    lucide.createIcons();

    const menuToggle = document.getElementById('menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');

    if (menuToggle && mobileMenu) {
        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            menuToggle.setAttribute('aria-expanded', (!mobileMenu.classList.contains('hidden')).toString());

            const icon = menuToggle.querySelector('i');
            if (icon) {
                icon.setAttribute('data-lucide', mobileMenu.classList.contains('hidden') ? 'menu' : 'x');
                lucide.createIcons();
            }
        });
    }
</script>

</body>
</html>