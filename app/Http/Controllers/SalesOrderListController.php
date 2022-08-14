<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesOrderListController extends Controller
{
    //
    function index()
    {
        $sales_order_after_insert_data = DB::connection('mysql2')->table('sales_order')
            ->get();

        return view('layout/sales/sales_order_list')->with(['sales_order_data'=> $sales_order_after_insert_data]);
    }

    function details($sales_order_id)
    {
        $sales_order_after_insert_data = DB::connection('mysql2')->table('sales_order')
            ->where('sales_order_id', '=', $sales_order_id)
            ->get();

        $sales_order_details_after_insert_data = DB::connection('mysql2')->table('sales_order_details')
            ->where('sales_order_id', '=', $sales_order_id)
            ->get();


        return view('layout/sales/sales_order_againest_details')->with(['status'=> '', 'sales_order_data'=> $sales_order_after_insert_data,
            'sales_order_details_data'=> $sales_order_details_after_insert_data]);
    }
}
