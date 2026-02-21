<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Demande d'événement</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Tailwind CDN pour le style clair et moderne -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-3xl mx-auto mt-10 p-6 bg-white rounded shadow-md">

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
            <label class="block font-semibold text-gray-700 mb-1">Contact organisateur(mettre l'email ou votre numero de telephone) *</label>
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

</body>
</html>