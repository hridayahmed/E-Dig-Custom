<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaveSOInDatabaseController extends Controller
{
    //
    function save(Request $request)
    {
        $count = $request->input('row_line_no');
        $sales_order_data = [];
        $sales_order_details_data = [];
        $sales_order_saving = [];
        $sales_order_details_saving = [];
        $today_date = date('Y-m-d H:i');
        $message = 'Error Occure';
        $sales_order_id = '';

        $sales_order_data = [
            'sales_category' => $request->input('sales_category'),
            'customer_purchase_order_id' => $request->input('customer_purchase_order_id'),
            'customer_name' => $request->input('customer_name'),
            'customer_phone_number' => $request->input('customer_phone_number'),
            'discount_amount' => $request->input('discount_amount'),
            'sales_date' => $today_date,
            'status' => $request->input('status')
        ];

        $transection = DB::transaction(function () use ($today_date, $request, $count, $sales_order_data, &$message, &$sales_order_id)
        {

            $sales_order_saving = DB::connection('mysql2')->table('sales_order')
                ->insertGetId($sales_order_data);

            $sales_order_id = $sales_order_saving;

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

                $sales_order_details_data = [
                    'sales_order_id' => $sales_order_id,
                    'item_id' => $request->input('item_name'.$i),
                    'item_category' => $request->input('item_category'.$i),
                    'quantity' => $request->input('quantity'.$i),
                    'lot_id' => $lot_id,
                    'discount_amount' => $request->input('discount_amount'.$i)
                ];

                $transection_table_data = [
                    'item_id' => $request->input('item_name'.$i),
                    'item_category' => $request->input('item_category'.$i),
                    'quantity' => $request->input('quantity'.$i),
                    'source_transaction_type' => 'sales_order',
                    'source_transaction_id' => 'so',
                    'transaction_date' => $today_date,
                    'lot_id' => $lot_id,
                    'price' => $item_per_unit_price,
                    'total_price' => $item_total_price
                ];

                $update_item_stock_table_data = [
                    'stock_quantity' => ( $item_stock_quantity - $request->input('quantity'.$i))
                ];

                $sales_order_details_saving = DB::connection('mysql2')->table('sales_order_details')
                    ->insert($sales_order_details_data);

                $material_transection_saving = DB::connection('mysql2')->table('material_transection_details')
                    ->insert($transection_table_data);

                $item_stock_table_updating = DB::connection('mysql2')->table('items')
                    ->where('item_id', '=', $request->input('item_name'.$i))
                    ->update($update_item_stock_table_data);

            }

            $message = 'Sales Order Submitted Successfully';

            return compact('message', 'sales_order_id');
        });

        $message = $transection['message'];
        $sales_order_id = $transection['sales_order_id'];

        $sales_order_after_insert_data = DB::connection('mysql2')->table('sales_order')
            ->where('sales_order_id', '=', $sales_order_id)
            ->get();

        $sales_order_details_after_insert_data = DB::connection('mysql2')->table('sales_order_details')
            ->where('sales_order_id', '=', $sales_order_id)
            ->get();

        //dd($sales_order_after_insert_data);



        return view('layout/sales/sales_order_againest_details')->with(['status'=> $message, 'sales_order_data'=> $sales_order_after_insert_data,
            'sales_order_details_data'=> $sales_order_details_after_insert_data]);
    }

}
