<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GenerateDirectSOController extends Controller
{
    //

    function index(Request $request)
    {
        $customer_name = $request->input('customer_name');
        $customer_phone_number = $request->input('customer_phone_number');

//        $request->session()->put('customer_name',$customer_name);
//        $request->session()->put('customer_phone_number',$customer_phone_number);

        return view('layout/sales/direct_sales_order_details')->with(['customer_name'=>$customer_name,
            'customer_phone_number'=>$customer_phone_number
        ]);
    }
}
