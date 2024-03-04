<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CashRegisterController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ClientDocumentController;
use App\Http\Controllers\Api\CounterpartyAgreementController;
use App\Http\Controllers\Api\CounterpartyController;
use App\Http\Controllers\Api\CurrencyController;

use App\Http\Controllers\Api\DocumentController;
use App\Http\Controllers\Api\GroupController;
use App\Http\Controllers\Api\ProviderDocumentController;

use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\ExchangeRateController;
use App\Http\Controllers\Api\GoodController;
use App\Http\Controllers\Api\OrganizationBillController;
use App\Http\Controllers\Api\OrganizationController;
use App\Http\Controllers\Api\PositionController;
use App\Http\Controllers\Api\PriceTypeController;

use App\Http\Controllers\Api\StorageController;
use App\Http\Controllers\Api\UnitController;
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

Route::group(['middleware' => 'auth:sanctum'], function () {


    Route::apiResource('currency', CurrencyController::class);


    Route::group(['prefix' => 'currencyRate'], function () {
        Route::post('/add/{currency}', [CurrencyController::class, 'addExchangeRate']);
        Route::get('/{currency}', [ExchangeRateController::class, 'index']);
        Route::patch('/{exchangeRate}', [CurrencyController::class, 'updateExchange']);
        Route::delete('/{exchangeRate}', [CurrencyController::class, 'removeExchangeRate']);
        Route::post('massDelete', [CurrencyController::class, 'massDelete']);
        Route::post('massRestore', [CurrencyController::class, 'massRestore']);
    });

    Route::get('getExchangeRateByCurrencyId/{currency}', [CurrencyController::class, 'getExchangeRateByCurrencyId']);
    Route::apiResource('organizationBill', OrganizationBillController::class);
    Route::apiResource('counterparty', CounterpartyController::class);
    Route::apiResource('priceType', PriceTypeController::class);
    Route::apiResource('cpAgreement', CounterpartyAgreementController::class);
    Route::apiResource('position', PositionController::class);
    Route::apiResource('cashRegister', CashRegisterController::class);
    Route::apiResource('organization', OrganizationController::class);
    Route::apiResource('employee', EmployeeController::class);
    Route::apiResource('user', UserController::class);
    Route::apiResource('storage', StorageController::class);
    Route::apiResource('category', CategoryController::class);
    Route::apiResource('unit', UnitController::class);
    Route::apiResource('good', GoodController::class);
    Route::apiResource('group', GroupController::class);

    Route::get('getExchangeRateByCurrencyId/{currency}', [CurrencyController::class, 'getExchangeRateByCurrencyId']);

    Route::group(['prefix' => 'organizationBill'], function () {
        Route::post('/massDelete', [OrganizationBillController::class, 'massDelete']);
        Route::post('/massRestore', [OrganizationBillController::class, 'massRestore']);
    });

    Route::group(['prefix' => 'priceType'], function () {
        Route::post('/massDelete', [PriceTypeController::class, 'massDelete']);
        Route::post('/massRestore', [PriceTypeController::class, 'massRestore']);
    });

    Route::group(['prefix' => 'cashRegister'], function () {
        Route::post('/massDelete', [CashRegisterController::class, 'massDelete']);
        Route::post('/massRestore', [CashRegisterController::class, 'massRestore']);
    });

    Route::group(['prefix' => 'organization'], function () {
        Route::post('/massDelete', [OrganizationController::class, 'massDelete']);
        Route::post('/massRestore', [OrganizationController::class, 'massRestore']);
    });

    Route::group(['prefix' => 'employee'], function () {
        Route::post('/massDelete', [EmployeeController::class, 'massDelete']);
        Route::post('/massRestore', [EmployeeController::class, 'massRestore']);
    });

    Route::group(['prefix' => 'user'], function () {
        Route::post('/massDelete', [UserController::class, 'massDelete']);
        Route::post('/massRestore', [UserController::class, 'massRestore']);
    });

    Route::group(['prefix' => 'storage'], function () {
        Route::post('/massDelete', [StorageController::class, 'massDelete']);
        Route::post('/massRestore', [StorageController::class, 'massRestore']);
    });

    Route::group(['prefix' => 'category'], function () {
        Route::post('/massDelete', [CategoryController::class, 'massDelete']);
        Route::post('/massRestore', [CategoryController::class, 'massRestore']);
    });

    Route::group(['prefix' => 'unit'], function () {
        Route::post('/massDelete', [UnitController::class, 'massDelete']);
        Route::post('/massRestore', [UnitController::class, 'massRestore']);
    });

    Route::group(['prefix' => 'good'], function () {
        Route::post('/massDelete', [GoodController::class, 'massDelete']);
        Route::post('/massRestore', [GoodController::class, 'massRestore']);
    });

    Route::group(['prefix' => 'cpAgreement'], function () {
        Route::get('/getAgreementByCounterpartyId/{counterparty}', [CounterpartyAgreementController::class, 'getAgreementByCounterpartyId']);
        Route::post('/massDelete', [CounterpartyAgreementController::class, 'massDelete']);
        Route::post('/massRestore', [CounterpartyAgreementController::class, 'massRestore']);
    });

    Route::group(['prefix' => 'counterparty'], function () {
        Route::get('/restore/{counterparty}', [CounterpartyController::class, 'restore']);
        Route::post('/massDelete', [CounterpartyController::class, 'massDelete']);
        Route::post('/massRestore', [CounterpartyController::class, 'massRestore']);
    });

    Route::group(['prefix' => 'currency'], function () {
        Route::get('/restore/{currency}', [CurrencyController::class, 'restore']);
        Route::post('/massDelete', [CurrencyController::class, 'massDelete']);
        Route::post('/massRestore', [CurrencyController::class, 'massRestore']);
    });

    Route::group(['prefix' => 'position'], function () {
        Route::post('/massDelete', [PositionController::class, 'massDelete']);
        Route::post('/massRestore', [PositionController::class, 'massRestore']);
    });

    Route::get('/settings', [\App\Http\Controllers\SettingsController::class, 'index']);
    Route::post('/settings', [\App\Http\Controllers\SettingsController::class, 'store']);


    Route::group(['prefix' => 'document'], function () {
        Route::group(['prefix' => '/provider'], function () {
            Route::get('/purchaseList', [ProviderDocumentController::class, 'index']);
            Route::post('/purchase', [ProviderDocumentController::class, 'purchase']);

            Route::get('/return', [ProviderDocumentController::class, 'return']);
            Route::post('/returnList', [ProviderDocumentController::class, 'returnList']);
        });

        Route::group(['prefix' => '/client'], function () {
            Route::get('/purchasedList', [ClientDocumentController::class, 'index']);
            Route::post('/purchase', [ClientDocumentController::class, 'purchase']);

            Route::get('/returnList', [ClientDocumentController::class, 'returnList']);
            Route::post('/return', [ClientDocumentController::class, 'return']);
        });

        Route::patch('/update/{document}', [DocumentController::class, 'update']);

        Route::get('/changeHistory/{document}', [DocumentController::class, 'changeHistory']);

        Route::get('approve/{document}', [DocumentController::class, 'approve']);
        Route::get('unApprove/{document}', [DocumentController::class, 'unApprove']);
    });


    Route::get('logout', [AuthController::class, 'logout']);
});

Route::post('login', [App\Http\Controllers\Api\AuthController::class, 'login'])->name('login');
