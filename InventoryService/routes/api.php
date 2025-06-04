<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get('/inventories/{id}', [InventoryController::class, 'show']);
Route::get('/inventories', [InventoryController::class, 'index']);
Route::get('/inventories/{product_id}', [InventoryController::class, 'show']);
Route::post('/inventories', [InventoryController::class, 'store']);
Route::put('/inventories/{product_id}', [InventoryController::class, 'update']);
