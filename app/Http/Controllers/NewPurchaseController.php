<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class NewPurchaseController extends Controller
{
    public function create_purchase()
    {
        $title = 'create purchase';

        //$categories = Category::get();
        //$suppliers = Supplier::get();

        $categories = ['medicine', 'baby_care', 'health', 'others'];

        $suppliers = DB::connection('mysql2')->table('supplier')
            ->select(DB::raw("*"))
            ->get();


        $purchase_order_id = DB::connection('mysql2')
            ->table('purchase_order')
            ->select('purchase_order_id')
            ->orderBy('purchase_order_id','desc')->first();

        if (is_null($purchase_order_id))
        {
            $last_purchase_order_id = 0;
        }
        else{
            $last_purchase_order_id = $purchase_order_id->purchase_order_id;
        }

        return view('layout.purchase.add_new_purchase',compact(
            'title','categories','suppliers', 'last_purchase_order_id'
        ));
    }

    public function getItems(Request $request)
    {
        $movies = [];
        if($request->has('term'))
        {
            $search = $request->term;
            $movies = DB::connection('mysql2')->table('brands_url')
                ->select(DB::raw("*"))
                ->where('brand_name', 'LIKE', "%{$search}%")
                ->get();
        }
        else {
            $movies = DB::connection('mysql2')->table('brands_url')
                ->select(DB::raw("*"))
                ->get();
        }

        return response()->json($movies);
    }


    public function getItemDetails(Request $request)
    {
        $item_id = $request->item_id;
        $item_all = [];

        $item_all = DB::connection('mysql2')->table('brands_url')
            ->select(  '*')
            ->where('id', '=', "$item_id")
            ->get();
        //dd($item_all);
        return response()->json($item_all);
    }

    public function add_new_line(Request $request)
    {
        $serial = $request->serial;
        //$categories = Category::get();
        $categories = ['medicine', 'baby_care', 'health', 'others'];
        return view('layout.purchase.add_row_line')->with(['serial'=>$serial, 'categories'=>$categories]);
    }



    function save(Request $request)
    {
        $today_date = date('Y-m-d H:i');
        $message = 'Error Occure';
        $purchase_order_id = '';

        $purchase_order_header_data = [
            'purchase_order_date' => $today_date,
            'supplier_id' => $request->input('supplier'),
            'status' => 'PO_GENERATED',
            'transection_type' => 'purchase_order'
        ];

        $transection = DB::transaction(function () use ($today_date, $request, $purchase_order_header_data, &$message, &$purchase_order_id)
        {

            $purchase_order_header_saving = DB::connection('mysql2')->table('purchase_order')
                ->insertGetId($purchase_order_header_data);

            $purchase_order_id = $purchase_order_header_saving;

            for ($i = 1; $i <= 50; $i++)
            {
                if ($request->input('category'.$i))
                {
                    $purchase_order_details_data = [
                        'purchase_order_id' => $purchase_order_id,
                        'item_category' => $request->input('category'.$i),
                        'item_id' => $request->input('item_name'.$i),
                        'quantity' => $request->input('quantity'.$i),
                        'per_unit_price' =>$request->input('per_unit_price'.$i)
                    ];

                    $purchase_order_details_saving = DB::connection('mysql2')->table('purchase_order_details')
                        ->insert($purchase_order_details_data);
                }
            }

            $message = 'Sales Order Submitted Successfully';

            return compact('message', 'purchase_order_id');
        });


        $message = $transection['message'];
        $purchase_order_id = $transection['purchase_order_id'];

        $purchase_order_after_insert_data = DB::connection('mysql2')->table('purchase_order')
            ->select('purchase_order.*', 'supplier.supplier_name')
            ->join('supplier', 'supplier.supplier_id', '=', 'purchase_order.supplier_id')
            ->where('purchase_order.purchase_order_id', '=', $purchase_order_id)
            ->get();

        $purchase_order_details_after_insert_data = DB::connection('mysql2')->table('purchase_order_details')
            ->select('purchase_order_details.*', 'brands_url.*')
            ->join('brands_url', 'brands_url.id', '=', 'purchase_order_details.item_id')
            ->where('purchase_order_details.purchase_order_id', '=', $purchase_order_id)
            ->get();

        //dd($purchase_order_details_after_insert_data);

        return view('layout.purchase.purchase_order_details')->with(['status'=> $message, 'purchase_order_data'=> $purchase_order_after_insert_data,
            'purchase_order_details_data'=> $purchase_order_details_after_insert_data]);
    }


    public function get_all_data()
    {
        $purchase_order_all_data = DB::connection('mysql2')->table('purchase_order')
            ->select('purchase_order.*','supplier.supplier_name', 'purchase_order.purchase_order_id AS purchase_order_id',
                 'receiving.purchase_order_id AS receiving_purchase_order_id')
            ->distinct()
            ->leftJoin('supplier', 'supplier.supplier_id' ,'=','purchase_order.supplier_id')
            ->leftJoin('receiving', 'receiving.purchase_order_id' ,'=','purchase_order.purchase_order_id')
            ->get();

        //dd($purchase_order_all_data);

        return view('layout.purchase.purchase_order_list')->with(['purchase_order_data'=> $purchase_order_all_data]);
    }

    public function get_details_info(Request $request)
    {
        $purchase_order_id = $request->purchase_order_id;

        $purchase_order_all_data = DB::connection('mysql2')->table('purchase_order')
            ->select('purchase_order.*','supplier.supplier_name', 'supplier.supplier_id', 'purchase_order_details.*', 'brands_url.*')
            ->join('supplier', 'supplier.supplier_id' ,'=','purchase_order.supplier_id')
            ->join('purchase_order_details', 'purchase_order.purchase_order_id' ,'=','purchase_order_details.purchase_order_id')
            ->join('brands_url', 'purchase_order_details.item_id' ,'=','brands_url.id')
            ->where('purchase_order_details.purchase_order_id' , '=', $purchase_order_id)
            ->get();

        //dd($purchase_order_all_data);

        return view('layout.purchase.purchase_order_details')->with(['purchase_order_data'=> $purchase_order_all_data]);
    }

    public function delete_purchase_order(Request $request)
    {
        $purchase_order_id = $request->purchase_order_id;

        //start inserting data to purchase temp file

        //fetch purchase order header information
        $fetch_purchase_order_header_data = DB::connection('mysql2')->table('purchase_order')
            ->select('*')
            ->where('purchase_order_id' , '=', $purchase_order_id)
            ->get();


        //insert purchase order temp header information
        $temp_purchase_order_header_data = [
            'purchase_order_id' => $fetch_purchase_order_header_data[0]->purchase_order_id,
            'purchase_order_date' => $fetch_purchase_order_header_data[0]->purchase_order_date,
            'supplier_id' => $fetch_purchase_order_header_data[0]->supplier_id,
            'status' => $fetch_purchase_order_header_data[0]->status,
            'transection_type' => $fetch_purchase_order_header_data[0]->transection_type
        ];

        $temp_purchase_order_header_saving = DB::connection('mysql2')->table('purchase_order_temp')
                ->insert($temp_purchase_order_header_data);


        //fetch purchase order line data information
        $fetch_purchase_order_line_data = DB::connection('mysql2')->table('purchase_order_details')
            ->select('*')
            ->where('purchase_order_id' , '=', $purchase_order_id)
            ->get();


        $total_rows = count($fetch_purchase_order_line_data);

        //insert temp purchase order line wise data
        for ($i = 0; $i < $total_rows; $i++)
        {
            $temp_purchase_order_details_data = [
                'purchase_order_details_id' => $fetch_purchase_order_line_data[$i]->purchase_order_details_id,
                'purchase_order_id' => $fetch_purchase_order_line_data[$i]->purchase_order_id,
                'item_category' => $fetch_purchase_order_line_data[$i]->item_category,
                'item_id' => $fetch_purchase_order_line_data[$i]->item_id,
                'quantity' => $fetch_purchase_order_line_data[$i]->quantity,
                'per_unit_price' => $fetch_purchase_order_line_data[$i]->per_unit_price
            ];

            $purchase_order_details_saving = DB::connection('mysql2')->table('purchase_order_details_temp')
                ->insert($temp_purchase_order_details_data);
        }
        //end inserting data to purchase temp file

        //delete data from purchase table
        $purchase_order_delete = DB::connection('mysql2')->table('purchase_order')
            ->where('purchase_order_id', '=', $purchase_order_id)->delete();

        $purchase_order_details_delete = DB::connection('mysql2')->table('purchase_order_details')
            ->where('purchase_order_id','=',  $purchase_order_id)->delete();


        $purchase_order_all_data = DB::connection('mysql2')->table('purchase_order')
            ->select('purchase_order.*','supplier.supplier_name', 'receiving.receiving_id')
            ->join('supplier', 'supplier.supplier_id' ,'=','purchase_order.supplier_id')
            ->leftJoin('receiving', 'receiving.purchase_order_id' ,'=','purchase_order.purchase_order_id')
            ->get();

        return view('layout.purchase.purchase_order_list')->with(['purchase_order_data'=> $purchase_order_all_data]);
    }
}
