<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MiscIssueListController extends Controller
{
    function index()
    {
        $misc_issue_after_insert_data = DB::connection('mysql2')->table('misc_issue')
            ->get();

        return view('layout/misc_issue/misc_issue_list')->with(['misc_issue_data'=> $misc_issue_after_insert_data]);
    }

    function details($misc_issue_id)
    {
        $misc_issue_after_insert_data = DB::connection('mysql2')->table('misc_issue')
            ->where('misc_issue_id', '=', $misc_issue_id)
            ->get();

        $misc_issue_details_after_insert_data = DB::connection('mysql2')->table('misc_issue_details')
            ->where('misc_issue_id', '=', $misc_issue_id)
            ->get();


        return view('layout/misc_issue/misc_issue_against_details')->with(['status'=> '', 'misc_issue_data'=> $misc_issue_after_insert_data,
            'misc_issue_details_data'=> $misc_issue_details_after_insert_data]);
    }
}
