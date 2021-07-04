<?php

use App\Http\Controllers\Products\PriceCalculatorController;
use App\Http\Controllers\Products\PriceCalculatorViewController;
use Illuminate\Support\Facades\Route;

Route::get('/', PriceCalculatorViewController::class);
Route::post('/', PriceCalculatorController::class)->name('price-calculator');

