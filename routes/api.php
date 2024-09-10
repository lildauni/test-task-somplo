<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\UtilityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/product/set_data', [ProductController::class, 'setData']);
Route::post('/seller/set_data', [SellerController::class, 'setData']);
Route::get('/product/get_data/{id}', [ProductController::class, 'getData']);
Route::post('/product/update_data_bulk', [ProductController::class, 'updateDataBulk']);
Route::post('/bulk_insert', [ProductController::class, 'bulkInsert']);
Route::get('/utilities/parser', [UtilityController::class, 'parser']);
