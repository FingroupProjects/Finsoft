<?php

use App\Http\Controllers\Api\CashRegisterController;
use App\Http\Controllers\Api\CounterpartyAgreementController;
use App\Http\Controllers\Api\CounterpartyController;
use App\Http\Controllers\Api\CurrencyController;
use App\Http\Controllers\Api\OrganizationBillController;
use App\Http\Controllers\Api\OrganizationController;
use App\Http\Controllers\Api\PositionController;
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
    Route::get('getExchangeRateByCurrencyId/{currency}', [CurrencyController::class, 'getExchangeRateByCurrencyId']);
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

    Route::group(['prefix' => 'position'], function () {
        Route::get('/', [PositionController::class, 'index']);
        Route::post('/store', [PositionController::class, 'store']);
        Route::patch('/update/{position}', [PositionController::class, 'update']);
        Route::delete('/delete/{position}', [PositionController::class, 'delete']);
    });

    Route::group(['prefix' => 'cashRegister'], function () {
        Route::get('/', [CashRegisterController::class, 'index']);
        Route::post('/store', [CashRegisterController::class, 'store']);
        Route::patch('/update/{cashRegister}', [CashRegisterController::class, 'update']);
    });

    Route::group(['prefix' => 'organization'], function () {
        Route::get('/', [OrganizationController::class, 'index']);
        Route::post('/store', [OrganizationController::class, 'store']);
        Route::patch('/update/{organization}', [OrganizationController::class, 'update']);
        Route::delete('/delete/{organization}', [OrganizationController::class, 'delete']);
    });

    Route::get('logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);

});

    Route::post('login', [\App\Http\Controllers\Api\AuthController::class, 'login']);

