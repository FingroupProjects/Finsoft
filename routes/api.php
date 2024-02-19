<?php

use App\Http\Controllers\Api\CashRegisterController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CounterpartyAgreementController;
use App\Http\Controllers\Api\CounterpartyController;
use App\Http\Controllers\Api\CurrencyController;

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
//
//Route::group(['middleware' => 'auth:sanctum'], function (){
//

Route::apiResource('currency', CurrencyController::class);



Route::group(['prefix' => 'currencyRate'], function () {
    Route::post('/add/{currency}', [CurrencyController::class, 'addExchangeRate']);
    Route::get('/{currency}', [ExchangeRateController::class, 'index']);
    Route::patch('/{exchangeRate}', [CurrencyController::class, 'updateExchange']);
    Route::delete('/{exchangeRate}', [CurrencyController::class, 'removeExchangeRate']);
});
Route::get('getExchangeRateByCurrencyId/{currency}', [CurrencyController::class, 'getExchangeRateByCurrencyId']);

    Route::apiResource('organizationBill', OrganizationBillController::class);
    Route::apiResource('counterparty', CounterpartyController::class);
    Route::apiResource('priceType', PriceTypeController::class);
    Route::apiResource('cpAgreement', CounterpartyAgreementController::class);
    Route::apiResource('position', PositionController::class);
    Route::apiResource('cashRegister',CashRegisterController::class);
    Route::apiResource('organization',OrganizationController::class);
    Route::apiResource('employee',EmployeeController::class);
    Route::apiResource('user',UserController::class);
    Route::apiResource('storage',StorageController::class);
    Route::apiResource('category',CategoryController::class);
    Route::apiResource('unit',UnitController::class);
    Route::apiResource('good',GoodController::class);

    Route::apiResource('providerDocument',ProviderDocumentController::class);


    Route::group(['prefix' => 'providerDocument'], function () {
        Route::get('/purchaseDocuments', [ProviderDocumentController::class, 'purchaseDocuments']);
        Route::post('/purchase', [ProviderDocumentController::class, 'purchase']);

        Route::get('/returnToProviderDocuments', [ProviderDocumentController::class, 'returnToProviderDocuments']);
        Route::post('/returnToProvider', [ProviderDocumentController::class, 'returnToProvider']);
    });



Route::get('logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);

//});

Route::post('login', [App\Http\Controllers\Api\AuthController::class, 'login']);
