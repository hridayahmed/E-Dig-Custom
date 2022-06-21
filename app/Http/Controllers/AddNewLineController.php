<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddNewLineController extends Controller
{
    //
    function index(Request $request)
    {
        $serial = $request->serial;
        return view('layout/sales/row_line')->with(['serial'=>$serial]);
    }
}
