<?php

use App\Http\Controllers\Api\CounterpartyAgreementController;
use App\Http\Controllers\Api\CounterpartyController;
use App\Http\Controllers\Api\CurrencyController;
use App\Http\Controllers\Api\OrganizationBillController;
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

Route::group(['middleware' => 'auth:sanctum'], function (){

    Route::apiResource('currency', CurrencyController::class);
    Route::apiResource('organizationBill', OrganizationBillController::class);
    Route::apiResource('counterparty', CounterpartyController::class);

    Route::group(['prefix' => 'currencyRate'], function () {
        Route::post('/add/{currency}', [CurrencyController::class, 'addExchangeRate']);
        Route::patch('/{exchangeRate}', [CurrencyController::class, 'updateExchange']);
        Route::delete('/{exchangeRate}', [CurrencyController::class, 'removeExchangeRate']);
    });

    Route::group(['prefix' => 'priceType'], function (){
        Route::get('/', [PriceTypeController::class, 'index']);
        Route::post('/', [PriceTypeController::class, 'store']);
        Route::patch('/{priceType}', [PriceTypeController::class, 'update']);
        Route::delete('/{priceType}', [PriceTypeController::class, 'delete']);
    });

    Route::group(['prefix' => 'cpAgreement'], function () {
        Route::get('/', [CounterpartyAgreementController::class, 'index']);
        Route::post('/store', [CounterpartyAgreementController::class, 'store']);
        Route::patch('/update/{counterpartyAgreement}', [CounterpartyAgreementController::class, 'update']);
    });

    Route::get('logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);

});

    Route::post('login', [\App\Http\Controllers\Api\AuthController::class, 'login']);


