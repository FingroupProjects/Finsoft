<?php

use App\Http\Controllers\Api\CurrencyController;
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

    Route::post('login', [\App\Http\Controllers\Api\AuthController::class, 'login']);

















Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
