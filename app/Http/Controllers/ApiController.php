<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    // Récupérer tous les événements
    public function getEvenements()
    {
        $response = Http::withOptions([
    'verify' => true,
])->get('https://'.env('ENV_POINT_URL').'/api/evenements');

        if ($response->successful()) {
            $data = $response->json();
            $events = array_reverse($data['data']);
            return view('evenements', ['evenements' => $events]);
        } else {
            return view('evenements', ['evenements' => [], 'error' => 'Impossible de récupérer les données']);
        }
    }

    // Récupérer un événement spécifique via short_url
    public function getEvenement($short_url)
    {
        $response = Http::withOptions([
    'verify' => true,
])->get("https://".env('ENV_POINT_URL')."/api/evenements/{$short_url}");


            // dd($response->json());
        if ($response->successful()) {
            $data = $response->json();

            if ($data['success']) {
                $evenement =$data['data'];
                return view('evenementsiggle', compact('evenement'));
            } else {
                return view('evenementsiggle', ['error' => 'Événement non trouvé']);
            }
        } else {
            return view('evenementsiggle', ['error' => 'Erreur lors de la récupération des données']);
        }
    }
    }

