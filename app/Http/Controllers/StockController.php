<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function item_stock()
    {
        $all_items = DB::connection('mysql2')->table('items')
            ->select('*')
            ->get();

        //dd($purchase_order_all_data);

        return view('layout.items.stock')->with(['status'=> '', 'all_items'=> $all_items]);
    }

    public function item_wise_lot(Request $request)
    {
        $item_id = $request->item_id;
        //dd($item_id);
        $item_wise_lot_all_data = DB::connection('mysql2')->table('lot')
            ->select('lot.*','items.*')
            ->leftJoin('items', 'items.item_id' ,'=','lot.item_id')
            ->where('items.item_id', '=', $item_id)
            ->get();

        //dd($item_wise_lot_all_data);

        return view('layout.items.item_wise_stock_info')->with(['item_wise_lot'=> $item_wise_lot_all_data]);
    }

    public function purchase_order_receive(Request $request)
    {
        $purchase_order_id = $request->purchase_order_id;

        $item_wise_receiving_all_data = DB::connection('mysql2')->table('receiving')
            ->select('receiving.*','items.*')
            ->leftJoin('items', 'items.item_id' ,'=','receiving.item_id')
            ->where('receiving.purchase_order_id', '=', $purchase_order_id)
            ->get();

        dd($item_wise_receiving_all_data);

        return view('layout.items.purchase_receive_view_list')->with(['item_wise_receiving'=> $item_wise_receiving_all_data]);
    }
}
