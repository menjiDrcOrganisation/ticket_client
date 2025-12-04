<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\PdfController;

Route::get('/ticket', function () {
    return view('ticket');
})->name('accueil');

Route::get('/', [ApiController::class, 'getEvenements'])->name('evenements.all');

Route::get('/{short_url}', [ApiController::class, 'getEvenement'])->name('evenements.single');

Route::get('/ticket/pdf', [PdfController::class, 'generateTicket'])->name('ticket.pdf');

Route::post('/ticket/generate-pdf', [PdfController::class, 'generateTicket'])
    ->name('ticket.generate.pdf');

Route::get('/ticket/test', [PdfController::class, 'testTicket']);
    