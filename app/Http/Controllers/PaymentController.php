<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function make_payment()
    {
        $suppliers = DB::connection('mysql2')->table('supplier')
            ->select('*')
            ->get();

        return view('layout.payment.payment_form')->with(['suppliers'=> $suppliers]);
    }

    public function details_for_payment(Request $request)
    {
        $supplier_id = $request->supplier_id;
        //dd($supplier_id);
        $item_wise_receiving_all_data = DB::connection('mysql2')->table('receiving')
            ->select('receiving.*','items.*')
            ->leftJoin('items', 'items.item_id' ,'=','receiving.item_id')
            ->where('receiving.supplier_id', '=', $supplier_id)
            ->get();

        $item_wise_receiving_for_po = DB::connection('mysql2')->table('receiving')
            ->select('receiving.purchase_order_id')
            ->distinct()
            ->where('receiving.supplier_id', '=', $supplier_id)
            ->get();

        //dd($item_wise_receiving_all_data);

        return view('layout.payment.purchase_receive_view_list')->with(['item_wise_receiving'=> $item_wise_receiving_all_data, 'all_purchase_order'=> $item_wise_receiving_for_po]);
    }

    function details_for_purchase_order_wise_payment(Request $request)
    {
        $purchase_order_id = $request->purchase_order_id;

        $item_wise_receiving_all_data = DB::connection('mysql2')->table('receiving')
            ->select('receiving.*','items.*')
            ->leftJoin('items', 'items.item_id' ,'=','receiving.item_id')
            ->where('receiving.purchase_order_id', '=', $purchase_order_id)
            ->get();

        return view('layout.payment.purchase_order_wise_receive_view_list')->with(['item_wise_receiving'=> $item_wise_receiving_all_data]);
    }

    function adjustment_amount_form()
    {
        return view('layout.payment.adjustment_amount_form');
    }

    function payment_to_database(Request $request)
    {
        //dd($request->payment_check[0]);

        //payment header value asign
        $payment_date = date('Y-m-d');
        $supplier_id = $request->supplier;
        $discount_amount = $request->discount_amount;
        $payment_type = $request->payment_type;
        $payment_amount = $request->payment_amount;
        $adjustment_type = $request->adjustment_type;
        $adjustment_amount = $request->adjustment_amount;

        //receiving data insert
        $payment_set_data_insert = [
            'payment_date' => $payment_date,
            'supplier_id' => $supplier_id,
            'discount_amount' => $discount_amount,
            'payment_type' => $payment_type,
            'payment_amount' => $payment_amount,
            'adjustment_type' => $adjustment_type,
            'adjustment_amount' => $adjustment_amount
        ];

        $payment_set_insert_id = DB::connection('mysql2')->table('payment_set')
            ->insertGetId($payment_set_data_insert);

        //money transaction details value
        $source_transaction_id = $payment_set_insert_id;
        $source_transaction_type =  'RECEIVING_PAYMENT';
        $transaction_date = date('Y-m-d');
        $price = $payment_amount;

         //receiving data insert
        $money_transaction_details_insert = [
            'source_transaction_id' => $source_transaction_id,
            'source_transaction_type' => $source_transaction_type,
            'transaction_date' => $transaction_date,
            'price' => $price
        ];

        $money_transaction_details_id = DB::connection('mysql2')->table('money_transection_details')
                    ->insertGetId($money_transaction_details_insert);

        //payment line value assign
        echo $row_count = $request->total_counter;

        for ($i=1; $i < $row_count; $i++)
        {
            if ( isset($request->payment_check[$i-1]) )
            {

                //item stock information value
                $payment_voucher_date = date('Y-m-d');
                $source_transaction_id = $request->input('receiving_id'.$i);
                $source_transaction_type =  'RECEIVING_PAYMENT';
                $source_item_id = $request->input('item_id'.$i);
                $payment_set_id = $payment_set_insert_id;
                $status = '';

                //receiving data insert
                $payment_voucher_data_insert = [
                    'payment_voucher_date' => $payment_voucher_date,
                    'source_transaction_id' => $source_transaction_id,
                    'source_transaction_type' => $source_transaction_type,
                    'source_item_id' => $source_item_id,
                    'payment_set_id' => $payment_set_id,
                    'status' => $status
                ];

                $payment_voucher_insert_id = DB::connection('mysql2')->table('payment_voucher')
                    ->insertGetId($payment_voucher_data_insert);

            }
        }

    }

}
