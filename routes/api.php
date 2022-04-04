<?php

use App\Http\Controllers\PurchaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthenticationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/create-account', [AuthenticationController::class, 'createAccount']);

Route::post('/login', [AuthenticationController::class,'login']);

Route::get('/purchase', [PurchaseController::class,'api_purchase']);

Route::get('/supplier_name',[PurchaseController::class,'supplier_name']);
