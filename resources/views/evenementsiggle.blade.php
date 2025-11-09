<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>{{ $evenement["nom"] ?? "Événement" }}</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://unpkg.com/lucide@latest"></script>
        <script src="https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    </head>
    <body class="bg-gray-100">
        @if(isset($error))
        <p class="text-red-500 text-center mt-10">{{ $error }}</p>
        @else
        <header
            class="relative bg-cover bg-center h-96 md:h-screen"
            style="background-image: url('http://127.0.0.1:8000/storage/{{
                $evenement['ressource'][0]['photo_affiche'] ?? 'img/concert.jpg'
            }}');"
        >
            <div class="absolute inset-0 bg-black opacity-60"></div>
            <div
                class="relative z-10 flex flex-col items-center justify-center h-full text-center px-4"
            >
                <h1 class="text-3xl md:text-5xl font-bold text-white mb-4">
                    {{ $evenement["ressource"][0]["phrase_accroche"] }}
                </h1>

                <p class="text-white mb-6 max-w-xl">
                    {{ $evenement["ressource"][0]["a_propos"] }}
                </p>
            </div>
        </header>

        <section class="bg-white py-12 px-6">
            <div
                class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 text-center"
            >
                <div>
                    <div class="flex justify-center mb-2">
                        <i
                            data-lucide="map-pin"
                            class="w-10 h-10 text-red-600"
                        ></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-1">Lieu</h3>
                    <p>
                        {{ $evenement["adresse"] }} à la salle
                        {{ $evenement["salle"] }}
                    </p>
                </div>
                <div>
                    <div class="flex justify-center mb-2">
                        <i
                            data-lucide="calendar-days"
                            class="w-10 h-10 text-red-600"
                        ></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-1">Date</h3>
                    <p>{{ $evenement["date_debut"] }}</p>
                </div>
                <div>
                    <div class="flex justify-center mb-2">
                        <i
                            data-lucide="clock"
                            class="w-10 h-10 text-red-600"
                        ></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-1">Heure</h3>
                    <p>À partir de {{ $evenement["heure_debut"] }}</p>
                </div>
            </div>
        </section>
        <!-- Modal de paiement -->
        <div
            id="modal"
            class="fixed inset-0 items-center justify-center bg-black bg-opacity-60 z-50 hidden"
        >
            <div
                class="bg-white rounded-2xl shadow-2xl w-full max-w-lg mx-auto p-4 sm:p-8 relative animate-fade-in"
            >
                <!-- Bouton de fermeture -->
                <button
                    id="closeModal"
                    class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 text-3xl font-bold"
                >
                    ×
                </button>

                <h2
                    class="text-2xl sm:text-3xl font-bold text-center text-gray-800 mb-6"
                >
                    Finalisez votre achat
                </h2>

                <form id="paymentForm" class="space-y-3">
                    <!-- ID Événement caché -->
                    <input
                        type="hidden"
                        value="{{ $evenement['id'] }}"
                        name="id_evenement"
                    />

                    <!-- Nom complet -->
                    <div>
                        <label
                            for="fullname"
                            class="block text-sm font-medium text-gray-700"
                            >Nom complet</label
                        >
                        <input
                            type="text"
                            id="fullname"
                            name="nom_complet_client"
                            required
                            class="mt-1 border block w-full rounded-xl border-gray-300 shadow-sm focus:ring-red-500 focus:border-red-500 p-3"
                        />
                    </div>

                    <!-- Service -->
                    <div>
                        <label
                            for="service"
                            class="block text-sm font-medium text-gray-700"
                            >Services</label
                        >
                        <select
                            id="service"
                            name="service"
                            required
                            class="mt-1 border block w-full rounded-xl border-gray-300 shadow-sm focus:ring-red-500 focus:border-red-500 p-3"
                        >
                            <option value="MPESA">MPESA</option>
                            <option value="orange">ORANGEMONEY</option>
                            <option value="airtel">AIRTELMONEY</option>
                        </select>
                    </div>

                    <!-- Devise -->
                    <div>
                        <label
                            for="devise"
                            class="block text-sm font-medium text-gray-700"
                            >Devise</label
                        >
                        <select
                            id="devise"
                            name="devise"
                            required
                            class="mt-1 border block w-full rounded-xl border-gray-300 shadow-sm focus:ring-red-500 focus:border-red-500 p-3"
                        >
                            <option value="USD">USD</option>
                            <option value="CDF">CDF</option>
                        </select>
                    </div>

                    <!-- Téléphone -->
                    <div>
                        <label
                            for="telephone"
                            class="block text-sm font-medium text-gray-700"
                            >Téléphone</label
                        >
                        <input
                            type="tel"
                            id="telephone"
                            name="numero_client"
                            placeholder="+243xxxxxxxxx"
                            pattern="^\+243\d{9}$"
                            required
                            class="mt-1 block border w-full rounded-xl border-gray-300 shadow-sm focus:ring-red-500 focus:border-red-500 p-3"
                        />
                    </div>

                    <!-- Nombre de tickets -->
                    <div>
                        <label
                            for="quantity"
                            class="block text-sm font-medium text-gray-700"
                            >Nombre de tickets</label
                        >
                        <input
                            type="number"
                            id="quantity"
                            name="nombre_reel"
                            min="1"
                            value="1"
                            required
                            class="mt-1 border block w-full rounded-xl border-gray-300 shadow-sm focus:ring-red-500 focus:border-red-500 p-3"
                        />
                    </div>

                    <!-- Type de billet -->
                    <div>
                        <label
                            for="ticketType"
                            class="block text-sm font-medium text-gray-700"
                            >Type de billet</label
                        >
                        <select
                            id="ticketType"
                            name="type_billet"
                            required
                            class="mt-1 border block w-full rounded-xl border-gray-300 shadow-sm focus:ring-red-500 focus:border-red-500 p-3"
                        >
                            @foreach($evenement['type_billets'] as $billet)
                            <option value="{{ $billet['id'] }}" data-prix="{{ $billet['pivot']['prix_unitaire'] }}">
                                {{ $billet["nom_type"] }} –
                                {{
                                    number_format(
                                        $billet["pivot"]["prix_unitaire"],
                                        0,
                                        ",",
                                        " "
                                    )
                                }} FC
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Affichage du prix total -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-lg font-semibold text-gray-800">
                            Prix total: <span id="totalPrice">0</span> FC
                        </p>
                    </div>

                    <!-- Bouton -->
                    <button
                        type="submit"
                        class="w-full bg-red-600 hover:bg-red-700 text-white text-lg font-semibold py-3 rounded-xl transition duration-200"
                    >
                        Procéder au paiement
                    </button>
                </form>
            </div>
        </div>

        <!-- Modal QR Code -->
        <div
            id="qrModal"
            class="fixed inset-0 items-center justify-center bg-black bg-opacity-60 z-50 hidden"
        >
            <div
                class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-auto p-6 relative"
            >
                <button
                    id="closeQrModal"
                    class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 text-3xl font-bold"
                >
                    ×
                </button>

                <h2 class="text-2xl font-bold text-center text-gray-800 mb-4">
                    Votre billet
                </h2>

                <div class="flex justify-center mb-4">
                    <canvas id="qrcodeCanvas"></canvas>
                </div>

                <div class="text-center">
                    <button
                        onclick="telecharger()"
                        class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg font-semibold mr-2"
                    >
                        Télécharger PDF
                    </button>
                    <button
                        id="closeQrModalBtn"
                        class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg font-semibold"
                    >
                        Fermer
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal de statut -->
        <div
            id="statusModal"
            class="fixed inset-0 items-center justify-center bg-black bg-opacity-60 z-50 hidden"
        >
            <div class="bg-white rounded-2xl shadow-2xl p-8 max-w-sm mx-auto">
                <div class="text-center">
                    <div
                        class="animate-spin rounded-full h-12 w-12 border-b-2 border-red-600 mx-auto mb-4"
                    ></div>
                    <p id="message" class="text-gray-700">
                        Traitement en cours...
                    </p>
                </div>
            </div>
        </div>

        <section class="py-16 px-6">
            <h2 class="text-3xl font-bold text-center mb-10">
                Billets disponibles
            </h2>
            <div
                class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8"
            >
                @foreach($evenement['type_billets'] as $index => $billet)
                <div
                    class="bg-white rounded-xl shadow-lg p-8 flex flex-col items-center text-center transform hover:scale-105 transition open-modal cursor-pointer"
                    data-billet-id="{{ $billet['id'] }}"
                    data-billet-prix="{{ $billet['pivot']['prix_unitaire'] }}"
                >
                    <i
                        data-lucide="ticket"
                        class="w-12 h-12 text-red-600 mb-4"
                    ></i>
                    <h3 class="text-2xl font-semibold mb-2">
                        {{ $billet["nom_type"] }}
                    </h3>
                    <p class="text-3xl font-bold text-red-600 mb-4">
                        {{
                            number_format(
                                $billet["pivot"]["prix_unitaire"],
                                0,
                                ",",
                                " "
                            )
                        }} {{$billet["pivot"]["devise"]}}
                    </p>
                    <p class="text-gray-600 mb-4">
                        Disponible: {{ $billet["pivot"]["nombre_billet"] }} billets
                    </p>
                    <span
                        class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-full font-bold"
                    >
                        Acheter
                    </span>
                </div>
                @endforeach
            </div>
        </section>
        @endif

        <footer class="bg-gray-900 text-white py-8 mt-12 text-center">
            © 2025 MenjiDrc. Tous droits réservés.
        </footer>

        <script>
            lucide.createIcons();

            let nomclient = "";

            function telecharger() {
                const canvas = document.getElementById("qrcodeCanvas");

                if (!canvas) {
                    alert("QR Code non généré !");
                    return;
                }

                const imgData = canvas.toDataURL("image/png");
                const { jsPDF } = window.jspdf;
                const pdf = new jsPDF();

                const pageWidth = pdf.internal.pageSize.getWidth();
                const qrWidth = 100;
                const x = (pageWidth - qrWidth) / 2;
                const y = 40;

                pdf.setFillColor(230, 240, 255);
                pdf.roundedRect(
                    x - 10,
                    y - 10,
                    qrWidth + 20,
                    qrWidth + 20,
                    8,
                    8,
                    "F"
                );

                pdf.setFontSize(18);
                pdf.setTextColor(50, 50, 120);

                pdf.text(
                    "Ceci est votre Billet en code QR",
                    pageWidth / 2,
                    25,
                    { align: "center" }
                );

                pdf.addImage(imgData, "PNG", x, y, qrWidth, qrWidth);

                pdf.setFontSize(12);
                pdf.setTextColor(80, 80, 80);
                pdf.text(
                    "Bienvenu.e au Spectacle " + nomclient,
                    pageWidth / 2,
                    y + qrWidth + 25,
                    { align: "center" }
                );

                pdf.save("billet-de-" + nomclient + ".pdf");
            }

            function showStatusModal(message = "Traitement en cours...") {
                const modal = document.getElementById("statusModal");
                const msg = document.getElementById("message");
                msg.textContent = message;
                modal.classList.remove("hidden");
                modal.classList.add("flex");
            }

            function hideStatusModal() {
                const modal = document.getElementById("statusModal");
                modal.classList.add("hidden");
                modal.classList.remove("flex");
            }

            function calculerPrixTotal() {
                const quantity = parseInt(document.getElementById('quantity').value) || 1;
                const selectedOption = document.getElementById('ticketType').selectedOptions[0];
                const prixUnitaire = parseInt(selectedOption.getAttribute('data-prix')) || 0;
                const prixTotal = quantity * prixUnitaire;

                document.getElementById('totalPrice').textContent =
                    prixTotal.toLocaleString('fr-FR');
            }

            // Initialisation des éléments DOM
            const modal = document.getElementById("modal");
            const qrModal = document.getElementById("qrModal");
            const closeBtn = document.getElementById("closeModal");
            const closeQrBtn = document.getElementById("closeQrModal");
            const closeQrModalBtn = document.getElementById("closeQrModalBtn");
            const openBtns = document.querySelectorAll(".open-modal");
            const quantityInput = document.getElementById('quantity');
            const ticketTypeSelect = document.getElementById('ticketType');

            // Événements d'ouverture des modals
            openBtns.forEach((btn) => {
                btn.addEventListener("click", () => {
                    modal.classList.remove("hidden");
                    modal.classList.add("flex");
                    const billetId = btn.getAttribute("data-billet-id");
                    
                    // Sélectionner le bon billet dans le select
                    ticketTypeSelect.value = billetId;
                    
                    // Calculer le prix total initial
                    calculerPrixTotal();
                });
            });

            // Événements pour le calcul du prix total
            quantityInput.addEventListener('input', calculerPrixTotal);
            ticketTypeSelect.addEventListener('change', calculerPrixTotal);

            // Événements de fermeture
            closeBtn.addEventListener("click", () => {
                modal.classList.add("hidden");
                modal.classList.remove("flex");
            });

            closeQrBtn.addEventListener("click", () => {
                qrModal.classList.add("hidden");
                qrModal.classList.remove("flex");
            });

            closeQrModalBtn.addEventListener("click", () => {
                qrModal.classList.add("hidden");
                qrModal.classList.remove("flex");
            });

            // Fermeture en cliquant à l'extérieur
            modal.addEventListener("click", (e) => {
                if (e.target === modal) {
                    modal.classList.add("hidden");
                    modal.classList.remove("flex");
                }
            });

            qrModal.addEventListener("click", (e) => {
                if (e.target === qrModal) {
                    qrModal.classList.add("hidden");
                    qrModal.classList.remove("flex");
                }
            });

            // Gestion du formulaire de paiement
            document
                .getElementById("paymentForm")
                .addEventListener("submit", async function (e) {
                    e.preventDefault();

                    const data = {
                        id_evenement: this.id_evenement.value,
                        nom_complet_client: this.nom_complet_client.value,
                        numero_client: this.numero_client.value,
                        nombre_reel: this.nombre_reel.value,
                        type_billet: this.type_billet.value,
                        devise: this.devise.value,
                        service: this.service.value
                    };

                    // Affiche le loader
                    showStatusModal("Paiement en cours...");

                    try {
                        const response = await fetch(
                            "http://127.0.0.1:8000/api/billet/achatBillet",
                            {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json",
                                },
                                body: JSON.stringify(data),
                            }
                        );

                        const result = await response.json();
                        console.log(result);

                        if (result.status === true) {
                            hideStatusModal();

                            const uniqueCode = result.billet.code_bilet;
                            const canvas = document.getElementById("qrcodeCanvas");

                            // Générer le QR code
                            QRCode.toCanvas(
                                canvas,
                                uniqueCode,
                                {
                                    width: 200,
                                    color: {
                                        dark: "#000000",
                                        light: "#ffffff",
                                    },
                                },
                                function (error) {
                                    if (error) {
                                        console.error(error);
                                        alert("Erreur lors de la génération du QR Code");
                                        return;
                                    }
                                    qrModal.classList.remove("hidden");
                                    qrModal.classList.add("flex");
                                }
                            );

                            // Fermer le formulaire
                            modal.classList.add("hidden");
                            modal.classList.remove("flex");
                            nomclient = result.billet.nom_complet_client;
                        } else {
                            hideStatusModal();
                            alert(
                                result.message || "Paiement échoué. Vérifiez votre numéro ou votre solde."
                            );
                        }
                    } catch (error) {
                        hideStatusModal();
                        alert(
                            "Le paiement a échoué. Une erreur inattendue est survenue, réessayez plus tard."
                        );
                        console.error(error);
                    }
                });

            // Initialiser le prix total au chargement
            document.addEventListener('DOMContentLoaded', function() {
                calculerPrixTotal();
            });
        </script>
    </body>
</html>