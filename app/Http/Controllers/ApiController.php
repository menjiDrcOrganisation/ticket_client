<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    // Récupérer tous les événements
    public function getEvenements()
    {
        // $response = Http::get('https://gestionticket.menjidrc.com/api/evenements');
        $response = Http::withoutVerifying()->get('https://gestionticket.menjidrc.com/api/evenements');
 
// dd($response->json());
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
        // $response = Http::get("https://gestionticket.menjidrc.com/api/evenements/{$short_url}");
        $response = Http::withoutVerifying()->get("https://gestionticket.menjidrc.com/api/evenements/{$short_url}");

            // dd($response->json());
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
    }

