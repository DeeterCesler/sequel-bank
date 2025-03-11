<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('BankWelcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('account/{number}', function ($number) {
    return Inertia::render('Dashboard', [
        'lookupAccount' => $number
    ]);
})->middleware(['auth', 'verified'])->name('account.lookup');

Route::get('/accounts/{number}', [App\Http\Controllers\AccountController::class, 'show']);


require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
