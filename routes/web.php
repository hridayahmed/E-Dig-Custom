<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//for dynamic connection

Route::middleware(['protect'])->group(function () {
    //Supplier route
    Route::post('/supplier',[SupplierController::class,'store']);
    Route::get('/supplier',function (){
                return view('layout/supplier/add_supplier');
    });
    Route::get('/supplier_list',[SupplierController::class,'index']);
    Route::post('new_purchase',[PurchaseController::class,'store']);
    //Purchase Route
    Route::get('/add_purchase',[PurchaseController::class,'index']);
    Route::post('/add_purchase',[PurchaseController::class,'store']);
    Route::get('/supplier_name',[PurchaseController::class,'supplier_name']);
    Route::get('/add_item',[PurchaseController::class,'add_item']);

});


Route::get('/', function () {
    return view('login');
})->middleware('throttle:5,1');

Route::post('/login',[AuthController::class,'login'])->middleware('throttle:5,10');

Route::get('/login',function (){
    if (Auth::check()) {
        return view('layout/supplier/add_supplier');
    }
    else
    {
        return view('login');
    }
})->middleware('throttle:5,1');

