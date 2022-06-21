<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GenerateDirectMiscIssueController extends Controller
{
    //GenerateDirectMiscIssueController
    function index(Request $request)
    {
        $vendor_name = $request->input('vendor_name');
        $vendor_phone_number = $request->input('vendor_phone_number');
        $reason = $request->input('reason');
        $status = $request->input('status');

        return view('layout/misc_issue/direct_misc_issue_details')->with(['vendor_name'=>$vendor_name,
            'vendor_phone_number'=>$vendor_phone_number, 'reason'=>$reason, 'status'=>$status
        ]);
    }
}
