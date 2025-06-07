<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
})->name('Home');

Route::get('/home', function () {
    return Inertia::render('Home');
})->name('Home');

require __DIR__.'/settings.php';
