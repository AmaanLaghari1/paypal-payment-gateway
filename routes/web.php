<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaypalController;

Route::get('/', [PaypalController::class, 'index']);

Route::post('/paypal', [PaypalController::class, 'paypal']);
Route::get('/success', [PaypalController::class, 'success']);
Route::get('/cancel', [PaypalController::class, 'cancel']);