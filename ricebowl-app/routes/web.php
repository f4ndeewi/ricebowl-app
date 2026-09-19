<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RiceBowlController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ricebowl', [RiceBowlController::class, 'index'])->name('ricebowl.index');
Route::post('/ricebowl/order', [RiceBowlController::class, 'order'])->name('ricebowl.order');