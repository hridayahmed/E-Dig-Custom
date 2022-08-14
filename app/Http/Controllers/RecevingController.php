<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecevingController extends Controller
{
    public function po_receiving()
    {
        return view('layout.receiving.po_receiving');
    }

    public function po_details(Request $request)
    {
        $po_number = $request->po_number;

        $purchase_order_all_data = DB::connection('mysql2')->table('purchase_order')
            ->select('purchase_order.*','supplier.supplier_name', 'purchase_order_details.*', 'brands_url.*')
            ->join('supplier', 'supplier.supplier_id' ,'=','purchase_order.supplier_id')
            ->join('purchase_order_details', 'purchase_order.purchase_order_id' ,'=','purchase_order_details.purchase_order_id')
            ->join('brands_url', 'purchase_order_details.item_id' ,'=','brands_url.id')
            ->where('purchase_order_details.purchase_order_id' , '=', $po_number)
            ->get();

        if ($purchase_order_all_data->count() == 0)
        {
            $purchase_order_all_data = '';
        }

        $location = DB::connection('mysql2')
            ->select("select bin.*, row.row_name, organization.org_name, sub_inventory.sub_inventory_name, rack.rack_name  from bin, row, sub_inventory, organization, rack where
              bin.org_id = organization.id and bin.sub_inventory_id = sub_inventory.id and bin.rack_id = rack.id and bin.row_id = row.id ");

        //dd($purchase_order_all_data);

        return view('layout.receiving.purchase_order_details')->with(['purchase_order_data'=> $purchase_order_all_data, 'location' => $location]);
    }

    public function add_new_line_for_receiving(Request $request)
    {
        $counter = $request->counter;
        return view('layout.receiving.add_row_line')->with(['counter'=>$counter]);
    }

    public function po_receiving_data(Request $request)
    {
        //total rows
        $total_rows_count = $request->total_rows_count;

        for ($i=1; $i < $total_rows_count; $i++)
        {
            //multiple row for specefic item
            for ($j=1; $j <= 10; $j++ )
            {
                //receiving initial value
                $receiving_date = date('Y-m-d');
                $purchase_order_id = $request->purchase_order_id;
                $supplier_id = $request->supplier_id;
                $quantity = $request->input('quantity'.$i.$j);
                $buy_per_unit_price = $request->input('per_unit_price'.$i);
                $expire_date = $request->expire_date;
                $status = '';

                //item stock information value
                $item_name = $request->input('item_name'.$i);
                $generic_name = $request->input('generic_name'.$i);
                $ratio =  $request->input('ratio'.$i);
                $item_type = $request->input('item_type'.$i);
                $brand_name = $request->input('brand_name'.$i);
                $sales_per_unit_price = $request->input('sales_per_unit_price'.$i);
                $unit_of_measurement = $request->input('unit_of_measurement'.$i);
                $item_category = $request->input('item_category'.$i);
                $manufacturing_date =  date('Y-m-d');
                $expiry_date = $request->input('expire_date'.$i.$j);
                //$expiry_date = date('Y-m-d');
                $prescriptions_necessity = $request->input('prescriptions_necessity'.$i);

                //lot initial value
                $source_transaction_type = 'purchase_order';
                $source_transaction_id = $request->purchase_order_id;
                $quantity = $request->input('quantity'.$i.$j);
                $lot_number = 'po_'.$request->purchase_order_id;
                $creation_date = date('Y-m-d');

                //material transection details value
                $item_category = $request->input('item_category'.$i);
                $quantity = $request->input('quantity'.$i.$j);
                $source_transaction_type = 'purchase_order';
                $source_transaction_id = $request->purchase_order_id;
                $transaction_date = date('Y-m-d');
                $price = $request->per_unit_price;
                $total_price = $price * $quantity;


                //check item previously stock or new item
                $item_stock = DB::connection('mysql2')
                    ->select("select * from items where
                item_name = '$item_name' and generic_name = '$generic_name' and ratio = '$ratio' and item_type = '$item_type'
                and brand_name = '$brand_name' LIMIT 1");

                if (count($item_stock) > 0)
                {
                    if ($quantity != null)
                    {
                        $previous_stock_quantity = $item_stock[0]->stock_quantity;
                        $now_stock_quantity = $quantity + $previous_stock_quantity;
                        $item_stock_insert_id = $item_stock[0]->item_id;

                        //item stock update
                        $item_stock_update = DB::connection('mysql2')
                            ->table('items')
                            ->where('item_id', $item_stock_insert_id)
                            ->update(['stock_quantity' => $now_stock_quantity]);


                        //receiving data insert
                        $item_receiving_data_insert = [
                            'receiving_date' => $receiving_date,
                            'purchase_order_id' => $purchase_order_id,
                            'supplier_id' => $supplier_id,
                            'item_id' => $item_stock_insert_id,
                            'quantity' => $quantity,
                            'per_unit_price' => $buy_per_unit_price,
                            'expire_date' => $expiry_date,
                            'status' => 'PO_RECEIVE'
                        ];

                        $item_receiving_insert_id = DB::connection('mysql2')->table('receiving')
                            ->insertGetId($item_receiving_data_insert);

                        //lot data insert
                        $lot_data_insert = [
                            'source_transaction_type' => 'PO_RECEIVING',
                            'source_transaction_id' => $item_receiving_insert_id,
                            'item_id' => $item_stock_insert_id,
                            'quantity' => $quantity,
                            'purchase_price' => $buy_per_unit_price,
                            'lot_number' => $item_receiving_insert_id,
                            'creation_date' => $creation_date,
                            'manufacturing_date' => $manufacturing_date,
                            'expiry_date' => $expiry_date
                        ];

                        $lot_insert_id = DB::connection('mysql2')->table('lot')
                            ->insertGetId($lot_data_insert);


                        //material transaction  insert
                        $material_transaction_data_insert = [
                            'item_id' => $item_stock_insert_id,
                            'item_category' => $item_category,
                            'quantity' => $quantity,
                            'source_transaction_type' => 'PO_RECEIVING',
                            'source_transaction_id' => $item_receiving_insert_id,
                            'transaction_date' => $creation_date,
                            'lot_id' => $lot_insert_id,
                            'price' => $buy_per_unit_price,
                            'total_price' => ( $quantity * $buy_per_unit_price )
                        ];

                        $material_transaction_insert_id = DB::connection('mysql2')->table('material_transection_details')
                            ->insertGetId($material_transaction_data_insert);
                    }
                }
                else
                {
                    if ($quantity != null)
                    {
                        //item_stock insert
                        $new_item_data = [
                            'item_name' => $item_name,
                            'generic_name' => $generic_name,
                            'ratio' => $ratio,
                            'item_type' => $item_type,
                            'brand_name' => $brand_name,
                            'per_unit_price' => $buy_per_unit_price,
                            'unit_of_measurement' => $unit_of_measurement,
                            'item_category' => $item_category,
                            'stock_quantity' => $quantity,
                            'prescriptions_necessity' => $prescriptions_necessity
                        ];

                        $item_stock_insert_id = DB::connection('mysql2')->table('items')
                            ->insertGetId($new_item_data);

                        //receiving data insert
                        $item_receiving_data_insert = [
                            'receiving_date' => $receiving_date,
                            'purchase_order_id' => $purchase_order_id,
                            'supplier_id' => $supplier_id,
                            'item_id' => $item_stock_insert_id,
                            'quantity' => $quantity,
                            'per_unit_price' => $buy_per_unit_price,
                            'expire_date' => $expiry_date,
                            'status' => 'PO_RECEIVE'
                        ];

                        $item_receiving_insert_id = DB::connection('mysql2')->table('receiving')
                            ->insertGetId($item_receiving_data_insert);

                        //lot data insert
                        $lot_data_insert = [
                            'source_transaction_type' => 'PO_RECEIVING',
                            'source_transaction_id' => $item_receiving_insert_id,
                            'item_id' => $item_stock_insert_id,
                            'quantity' => $quantity,
                            'purchase_price' => $buy_per_unit_price,
                            'lot_number' => $item_receiving_insert_id,
                            'creation_date' => $creation_date,
                            'manufacturing_date' => $manufacturing_date,
                            'expiry_date' => $expiry_date
                        ];

                        $lot_insert_id = DB::connection('mysql2')->table('lot')
                            ->insertGetId($lot_data_insert);


                        //material transaction  insert
                        $material_transaction_data_insert = [
                            'item_id' => $item_stock_insert_id,
                            'item_category' => $item_category,
                            'quantity' => $quantity,
                            'source_transaction_type' => 'PO_RECEIVING',
                            'source_transaction_id' => $item_receiving_insert_id,
                            'transaction_date' => $creation_date,
                            'lot_id' => $lot_insert_id,
                            'price' => $buy_per_unit_price,
                            'total_price' => ( $quantity * $buy_per_unit_price )
                        ];

                        $material_transaction_insert_id = DB::connection('mysql2')->table('material_transection_details')
                            ->insertGetId($material_transaction_data_insert);
                    }
                }
            }

        }

        $all_items = DB::connection('mysql2')->table('items')
            ->select('*')
            ->get();

        //dd($purchase_order_all_data);

        return view('layout.items.stock')->with(['status'=> 'Item Received and Stock Available', 'all_items'=> $all_items]);

    }


}
