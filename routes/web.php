<?php

use Illuminate\Support\Facades\Route;
use App\Http\Conbtrollers\ApiController;
use App\Http\Controllers\PdfController;

Route::get('/', function () {
    return view('maintenance.maintenance');
});

// Route::get('/ticket', function () {
//     return view('ticket');
// })->name('accueil');

// Route::get('/', [ApiController::class, 'getEvenements'])->name('evenements.all');

// Route::get('/{short_url}', [ApiController::class, 'getEvenement'])->name('evenements.single');

// Route::get('/ticket/pdf', [PdfController::class, 'generateTicket'])->name('ticket.pdf');

// Route::post('/ticket/generate-pdf', [PdfController::class, 'generateTicket'])
//     ->name('ticket.generate.pdf');

// Route::get('/ticket/test', [PdfController::class, 'testTicket']);

// Route::get('/demandeEvenement/create', [ApiController::class, 'createDemandeEvenement'])->name('demandeEvenement.create');
// Route::post('/demandeEvenement/send', [ApiController::class, 'sendDemandeEvenement'])->name('demandeEvenement.send');
