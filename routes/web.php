<?php

use App\Http\Controllers\AuthController;
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

Route::get('/', function () {
    return view('login');
});

Route::post('/login',[AuthController::class,'login']);
Route::get('/login',function (){
    if (Auth::check()) {
        return view('layout/supplier/add_supplier');
    }
    else
    {
        return view('login');
    }
});


//for dynamic connection

Route::middleware(['web'])->group(function () {
    Route::post('/supplier',[SupplierController::class,'store']);

    Route::get('/supplier',function (){

                return view('layout/supplier/add_supplier');



    });



    Route::get('/supplier_list',[SupplierController::class,'index']);
});


