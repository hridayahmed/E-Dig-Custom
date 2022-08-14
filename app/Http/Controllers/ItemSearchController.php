<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Item;

class ItemSearchController extends Controller
{

    public function getItems(Request $request)
    {
        $movies = [];

        if($request->has('term'))
        {
            $search = $request->term;
            $movies = DB::connection('mysql2')->table('items')
                ->select(DB::raw("*"))
               ->where('item_name', 'LIKE', "%{$search}%")
                ->where('stock_quantity', '>', "0")
                ->get();
        }
        else {

            $movies = DB::connection('mysql2')->table('items')
                ->select(DB::raw("*"))
                ->where('stock_quantity', '>', "0")
                ->get();
        }

        //dd($movies);

        return response()->json($movies);
    }

    public function getLots(Request $request)
    {
        $movies = [];

        if($request->has('term'))
        {
            $search = $request->term;
            $movies = DB::connection('mysql2')->table('items')
                ->select(DB::raw("*"))
                ->where('item_name', 'LIKE', "%{$search}%")
                ->where('stock_quantity', '>', "0")
                ->get();
        }
        else {

            $movies = DB::connection('mysql2')->table('items')
                ->select(DB::raw("*"))
                ->where('stock_quantity', '>', "0")
                ->get();
        }

        return response()->json($movies);
    }

    public function getItemQuantity(Request $request)
    {
        $item_id = $request->item_id;
        $quantity = $request->quantity;
        $item_all = [];

        $item_all = DB::connection('mysql2')->table('items')
            ->select(DB::raw("*"))
            ->where('item_id', '=', "$item_id")
            ->where('stock_quantity', '>=', "$quantity")
            ->get();

        return response()->json($item_all);
    }

    public function getItemDetails(Request $request)
    {
        $item_id = $request->item_id;
        $item_all = [];

//        $item_all = DB::connection('mysql2')->table('items')
//            ->select(  'items.*', 'lot.lot_number', 'lot.lot_id', DB::raw('count(items.item_id) as total'))
//            ->join('lot','lot.item_id','=','items.item_id')
//            ->groupBy('items.item_id')
//            ->where('items.item_id', '=', "$item_id")
//            ->get();

        $item_all = DB::connection('mysql2')->table('items')
            ->select(  'items.*', DB::raw('count(items.item_id) as total'))
            ->groupBy('items.item_id')
            ->where('items.item_id', '=', "$item_id")
            ->get();



        $get_lot_info = DB::connection('mysql2')->table('lot')
            ->select(  'lot.lot_number', 'lot.lot_id')
            ->where('lot.item_id', '=', "$item_id")
            ->get();

        $total_count = count($get_lot_info);

        //dd($item_all);
        //return response()->json($item_all);
        return response()->json(array(
            'item_all' => $item_all,
            'lot_info' => $get_lot_info,
            'total_lot' => $total_count,
        ));
    }

}
