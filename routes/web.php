<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\QuotationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [QuotationController::class, 'index'])->name('cotizacion.index');
Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::post('/purchases', [PurchaseController::class, 'storePurchase']);
Route::get('/purchase-history', [PurchaseController::class, 'purchaseHistory'])->name('purchase.history');
Route::get('/purchase-history/{client}', [PurchaseController::class, 'getClientPurchases'])->name('purchase.history.client');

