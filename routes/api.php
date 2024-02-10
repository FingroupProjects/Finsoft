<?php

use App\Http\Controllers\Api\CashRegisterController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CounterpartyAgreementController;
use App\Http\Controllers\Api\CounterpartyController;
use App\Http\Controllers\Api\CurrencyController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\OrganizationBillController;
use App\Http\Controllers\Api\OrganizationController;
use App\Http\Controllers\Api\PositionController;
use App\Http\Controllers\Api\PriceTypeController;
use App\Http\Controllers\Api\StorageController;
use App\Http\Controllers\Api\UserController;
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

    Route::group(['prefix' => 'employee'], function () {
        Route::get('/', [EmployeeController::class, 'index']);
        Route::post('/store', [EmployeeController::class, 'store']);
        Route::patch('/update/{employee}', [EmployeeController::class, 'update']);
        Route::delete('/delete/{employee}', [EmployeeController::class, 'delete']);
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('/', [UserController::class, 'index']);
        Route::post('/store', [UserController::class, 'store']);
        Route::patch('/update/{user}', [UserController::class, 'update']);
    });

    Route::group(['prefix' => 'storage'], function () {
        Route::get('/', [StorageController::class, 'index']);
        Route::post('/store', [StorageController::class, 'store']);
        Route::patch('/update/{storage}', [StorageController::class, 'update']);
    });

    Route::group(['prefix' => 'category'], function () {
        Route::get('/', [CategoryController::class, 'index']);
        Route::post('/store', [CategoryController::class, 'store']);
        Route::patch('/update/{category}', [CategoryController::class, 'update']);
    });



    Route::get('logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);

});

    Route::post('login', [\App\Http\Controllers\Api\AuthController::class, 'login']);

