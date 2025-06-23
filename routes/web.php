<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\PositionController;
use App\Models\Activity;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {

    return Inertia::render('Home', [
        'activity_id' => request('activity_id')
    ]);
})->name('Home');

Route::get('/home', function () {
    return Inertia::render('Home', );
})->name('Home');

Route::resources([
    'activity' => ActivityController::class,
    'position' => PositionController::class
]);

require __DIR__ . '/settings.php';
