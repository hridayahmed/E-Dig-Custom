<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GenerateDirectSOController;
use App\Http\Controllers\ItemSearchController;
use App\Http\Controllers\AddNewLineController;
use App\Http\Controllers\SaveSOInDatabaseController;
use App\Http\Controllers\SaveMiscIssueDatabaseController;
use App\Http\Controllers\SalesOrderListController;
use App\Http\Controllers\MiscIssueListController;
use App\Http\Controllers\GenerateDirectMiscIssueController;
use App\Http\Controllers\NewPurchaseController;
use App\Http\Controllers\RecevingController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\PaymentController;
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

    Route::middleware(['protect'])->group(function () {

        //for supplier
    Route::post('/supplier',[SupplierController::class,'store']);

    Route::get('/supplier',function (){
                return view('layout/supplier/add_supplier');
    });
    Route::get('/supplier_list',[SupplierController::class,'index']);

    //for organization
        Route::get('create_organization', function (){
            return view('layout/location/add_organization');
        });
        Route::post('organization_saving', [LocationController::class, 'org_store']);
        Route::get('/organization_list', [LocationController::class, 'org_index']);

        //for sub_inventory
//        Route::get('create_sub_inventory', function (){
//            return view('layout/location/add_sub_inventory');
//        });
        Route::get('create_sub_inventory', [LocationController::class, 'create_sub_inventory']);
        Route::post('sub_inventory_saving', [LocationController::class, 'sub_inventory_store']);
        Route::get('/sub_inventory_list', [LocationController::class, 'sub_inventory_index']);

        //for rack
        Route::get('create_rack', [LocationController::class, 'create_rack']);
        Route::post('rack_saving', [LocationController::class, 'rack_store']);
        Route::get('/rack_list', [LocationController::class, 'rack_index']);

        //for row
        Route::get('create_row', [LocationController::class, 'create_row']);
        Route::post('row_saving', [LocationController::class, 'row_store']);
        Route::get('/row_list', [LocationController::class, 'row_index']);

        //for bin
        Route::get('create_bin', [LocationController::class, 'create_bin']);
        Route::post('bin_saving', [LocationController::class, 'bin_store']);
        Route::get('/bin_list', [LocationController::class, 'bin_index']);


    //for selling portion
    Route::view('/sales','layout/sales/sales_type');
    Route::view('/direct_sale','layout/sales/direct_sale');
    Route::post('generate_direct_sell_so',[GenerateDirectSOController::class,'index']);

    Route::get('item_search', [ItemSearchController::class, 'getItems']);

    Route::get('lot_search', [ItemSearchController::class, 'getLots']);

    Route::get('item_details_info', [ItemSearchController::class, 'getItemDetails']);

    Route::get('item_quantity', [ItemSearchController::class, 'getItemQuantity']);

    Route::get('add_new_line',[AddNewLineController::class,'index']);

    Route::post('sales_order_generated',[SaveSOInDatabaseController::class,'save']);

    Route::get('sales_order_list',[SalesOrderListController::class,'index']);
    Route::get('sales_order_details_show/{sales_order_id}',[SalesOrderListController::class,'details']);



    //for misc issue portion
    Route::view('/misc_issue','layout/misc_issue/misc_issue_type');
    Route::view('/direct_misc_issue','layout/misc_issue/direct_sale_misc_issue');

    Route::post('generate_direct_misc_issue',[GenerateDirectMiscIssueController::class,'index']);

    Route::post('misc_issue_generated',[SaveMiscIssueDatabaseController::class,'save']);
    Route::get('misc_issue_list',[MiscIssueListController::class,'index']);


    //for purchase portion
        Route::view('/purchase','layout/purchase/purchase_type');
        Route::get('supplier_search', [SupplierController::class, 'getItems']);


        //purchase
        //new
        Route::get('new_purchase', [NewPurchaseController::class, 'create_purchase']);
        Route::get('item_search', [NewPurchaseController::class, 'getItems']);
        Route::get('item_details_info', [NewPurchaseController::class, 'getItemDetails']);
        Route::get('add_new_line',[NewPurchaseController::class,'add_new_line']);
        Route::post('purchase_order_generated',[NewPurchaseController::class,'save']);
        Route::post('purchase_order_details',[NewPurchaseController::class,'get_details_info']);
        Route::get('purchase_order_list',[NewPurchaseController::class,'get_all_data']);
        Route::get('purchase_order_delete',[NewPurchaseController::class,'delete_purchase_order']);

        //receive portion
        Route::get('po_receiving', [RecevingController::class,'po_receiving']);
        Route::get('po_details_for_receive', [RecevingController::class,'po_details']);
        Route::get('po_wise_receive_from_list', [RecevingController::class,'po_details']);
        Route::post('po_receiving_data', [RecevingController::class,'po_receiving_data']);
        Route::get('add_new_line_for_receiving', [RecevingController::class,'add_new_line_for_receiving']);

        //Item Stock portion
        Route::get('item_stock', [StockController::class,'item_stock']);
        Route::post('item_stock_against_lot', [StockController::class,'item_wise_lot']);
        Route::get('purchase_order_receive_view', [StockController::class,'purchase_order_receive']);

        //payment portion
        Route::get('make_payment', [PaymentController::class,'make_payment']);

});



