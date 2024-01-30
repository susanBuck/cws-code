<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/invoice', [InvoiceController::class, 'generate']);
