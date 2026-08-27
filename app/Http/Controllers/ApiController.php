<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    // Récupérer tous les événements
    public function getEvenements()
    {
        $response = http::withOptions([
    'verify' => false,
])->get(env('ENV_POINT_URL') . "/api/v1/evenements");

        if ($response->successful()) {
            $data = $response->json();
            return view('evenements', ['evenements' => $data['data']]);
        } else {
            return view('evenements', ['evenements' => [], 'error' => 'Impossible de récupérer les données']);
        }
    }

    // Récupérer un événement spécifique via short_url
    public function getEvenement($short_url)
    {
        $response = Http::withOptions   ([
    'verify' => false,
])->get(env('ENV_POINT_URL') . "/api/v1/evenements/{$short_url}");

        if ($response->successful()) {
            $data = $response->json();

            if ($data['success']) {
                $evenement = $data['data'];
                return view('evenementsiggle', compact('evenement'));
            } else {
                return view('evenementsiggle', ['error' => 'Événement non trouvé']);
            }
        } else {
            return view('evenementsiggle', ['error' => 'Erreur lors de la récupération des données']);
        }
    }

public function sendDemandeEvenement(Request $request)
{
    // Validation
    $validated = $request->validate([
        'nom_evenement' => 'required|string|max:255',
        'contact_organisateur' => 'required|string|max:255',
        'description' => 'required|string',
        'type_evenement' => 'required|string|max:255',
        'affiche' => 'nullable|image', 
        'statut' => 'required',
    ]);

    try {
        $response = Http::withOptions([
            'verify' => false,
        ])->attach(
            'affiche',
            $request->file('affiche') ? file_get_contents($request->file('affiche')->getRealPath()) : null,
            $request->file('affiche') ? $request->file('affiche')->getClientOriginalName() : null
        )->post(env('ENV_POINT_URL') . "/api/v1/demande-evenement", [
            'nom_evenement' => $validated['nom_evenement'],
            'contact_organisateur' => $validated['contact_organisateur'],
            'description' => $validated['description'],
            'type_evenement' => $validated['type_evenement'],
            'statut' => $validated['statut'],
        ]);

        if ($response->successful()) {
            return redirect()->back()->with('success', 'Demande envoyée avec succès, vous serez contacté dans les plus brefs délais');
        } else {
            return redirect()->back()->with('error', 'Erreur lors de l\'envoi.');
        }

    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Exception rencontrée.');
    }
}

public function telechargerBilletParCode(Request $request)
{
    $validated = $request->validate([
        'transaction_reference' => 'required|string|max:100',
    ]);

    $baseUrl = rtrim((string) env('ENV_POINT_URL', ''), '/');
    $reference = strtoupper(trim($validated['transaction_reference']));

    if ($baseUrl === '') {
        return redirect()->back()->withInput()->with('ticket_download_error', 'Configuration API manquante.');
    }

    try {
        $confirmationResponse = Http::withOptions([
            'verify' => false,
        ])->get($baseUrl . '/api/v1/transactions/' . rawurlencode($reference) . '/confirmation');

        $confirmationData = $confirmationResponse->json();

        if (!$confirmationResponse->successful() || !($confirmationData['status'] ?? false)) {
            $message = $confirmationData['message'] ?? 'Code transaction introuvable.';
            return redirect()->back()->withInput()->with('ticket_download_error', $message);
        }

        $statut = strtolower((string) ($confirmationData['statut'] ?? ''));
        if (!in_array($statut, ['paye', 'paye_sans_billet'], true)) {
            return redirect()->back()->withInput()->with('ticket_download_error', 'Paiement non valide pour ce code transaction.');
        }

        $downloadUrl = (string) ($confirmationData['download_url'] ?? '');
        if ($downloadUrl === '') {
            return redirect()->back()->withInput()->with('ticket_download_error', 'Billet indisponible pour le moment.');
        }

        return redirect()->away($downloadUrl);
    } catch (\Throwable $e) {
        return redirect()->back()->withInput()->with('ticket_download_error', 'Impossible de télécharger le billet pour le moment.');
    }
}

    public function createDemandeEvenement(Request $request)
    {
        return view('demandeEvenement.create');
    }

    }

