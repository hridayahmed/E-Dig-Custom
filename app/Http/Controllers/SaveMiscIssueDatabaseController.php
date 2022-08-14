<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaveMiscIssueDatabaseController extends Controller
{
    function save(Request $request)
    {
        $count = $request->input('row_line_no');
        $misc_issue_data = [];
        $misc_issue_details_data = [];
        $today_date = date('Y-m-d H:i');
        $message = 'Error Occure';
        $misc_issue_id = '';

        $misc_issue_data = [
            'misc_issue_date' => $today_date,
            'vendor_name' => $request->input('vendor_name'),
            'vendor_phone_number' => $request->input('vendor_phone_number'),
            'reason' => $request->input('reason'),
            'transection_type' => 'Misc Issue',
            'status' => $request->input('status')
        ];

        $transection = DB::transaction(function () use ($today_date, $request, $count, $misc_issue_data, &$message, &$misc_issue_id)
        {
            $misc_issue_data_saving = DB::connection('mysql2')->table('misc_issue')
                ->insertGetId($misc_issue_data);

            $misc_issue_id = $misc_issue_data_saving;

            for ($i = 1; $i < $count; $i++)
            {
                $get_lod_id = DB::connection('mysql2')->table('lot')
                    ->where('item_id', '=', $request->input('item_name'.$i))
                    ->pluck('lot_id');
                //dd($get_lod_id[0]);
                $lot_id = $get_lod_id[0];

                //item details info
                $item_details_info = DB::connection('mysql2')->table('items')
                    ->where('item_id', '=', $request->input('item_name'.$i) )
                    ->get();

                $item_per_unit_price = $item_details_info[0]->per_unit_price;
                $item_stock_quantity = $item_details_info[0]->stock_quantity;
                $item_total_price = $request->input('quantity'.$i) * $item_per_unit_price;

                $misc_issue_details_data = [
                    'misc_issue_id' => $misc_issue_id,
                    'item_id' => $request->input('item_name'.$i),
                    'item_category' => $request->input('item_category'.$i),
                    'quantity' => $request->input('quantity'.$i),
                    'lot_id' => $lot_id,
                    'per_unit_price' => $item_per_unit_price
                ];

                $transection_table_data = [
                    'item_id' => $request->input('item_name'.$i),
                    'item_category' => $request->input('item_category'.$i),
                    'quantity' => $request->input('quantity'.$i),
                    'source_transaction_type' => 'misc_issue',
                    'source_transaction_id' => 'misc_issue',
                    'transaction_date' => $today_date,
                    'lot_id' => $lot_id,
                    'price' => $item_per_unit_price,
                    'total_price' => $item_total_price
                ];

                $update_item_stock_table_data = [
                    'stock_quantity' => ( $item_stock_quantity - $request->input('quantity'.$i))
                ];

                $misc_issue_details_saving = DB::connection('mysql2')->table('misc_issue_details')
                    ->insert($misc_issue_details_data);

                $material_transection_saving = DB::connection('mysql2')->table('material_transection_details')
                    ->insert($transection_table_data);

                $item_stock_table_updating = DB::connection('mysql2')->table('items')
                    ->where('item_id', '=', $request->input('item_name'.$i))
                    ->update($update_item_stock_table_data);

            }

            $message = 'Misc Issue Submitted Successfully';

            return compact('message', 'misc_issue_id');
        });

        $message = $transection['message'];
        $misc_issue_id = $transection['misc_issue_id'];

        $misc_issue_after_insert_data = DB::connection('mysql2')->table('misc_issue')
            ->where('misc_issue_id', '=', $misc_issue_id)
            ->get();

        $misc_issue_details_after_insert_data = DB::connection('mysql2')->table('misc_issue_details')
            ->where('misc_issue_id', '=', $misc_issue_id)
            ->get();

        return view('layout/misc_issue/misc_issue_against_details')->with(['status'=> $message, 'misc_issue_data'=> $misc_issue_after_insert_data,
            'misc_issue_details_data'=> $misc_issue_details_after_insert_data]);
    }
}
