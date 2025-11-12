<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::get('/ticket', function () {
    return view('ticket');
})->name('accueil');

Route::get('/', [ApiController::class, 'getEvenements'])->name('evenements.all');

Route::get('/{short_url}', [ApiController::class, 'getEvenement'])->name('evenements.single');
