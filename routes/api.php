<?php

use App\Http\Controllers\Api\CurrencyController;
use App\Http\Controllers\Api\PriceTypeController;
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

Route::apiResource('currency', CurrencyController::class);

Route::group(['prefix' => 'currencyRate'], function () {
    Route::post('/add/{currency}', [CurrencyController::class, 'addExchangeRate']);
    Route::patch('/{exchangeRate}', [CurrencyController::class, 'updateExchange']);
    Route::delete('/{exchangeRate}', [CurrencyController::class, 'removeExchangeRate']);
});

Route::group(['prefix' => 'priceType'], function (){
    Route::post('/', [PriceTypeController::class, 'store']);
    Route::post('/{priceType}', [PriceTypeController::class, 'update']);
    Route::post('/{priceType}', [PriceTypeController::class, 'delete']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
