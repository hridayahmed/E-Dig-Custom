<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier=DB::connection('mysql2')
            ->select("Select * from  supplier");
        return view('layout.Purchase.add_purchase')->with(['supplier'=>$supplier]);
    }
    public function supplier_name(){
        $supplier_name=DB::connection('mysql2')
                ->select("Select * from  supplier");
            return json_encode($supplier_name);
    }
    public function add_item(){
        return view('layout.Item.add_item');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $purchase_order_date=$request->purchase_order_date;
        $transection_type=$request->transection_type;
        $supplier_id=$request->supplier_id;
        $res=DB::connection('mysql2')
            ->insert("insert into purchase_order(purchase_order_date,transection_type,
supplier_id,status)
            values('$purchase_order_date','$transection_type','$supplier_id','0')");

        $item=DB::connection('mysql2')
            ->select("Select * from purchase_order Order By purchase_order_id DESC LIMIT 1");

//        $response=Http::get('http://inventory.e-diagnosis.xyz/api/item_search');
//        $res=json_decode($response->getBody()->getContents(),true);
//        $category=[];
//        // var_dump($response);
//        for ($i=0;$i< count($res);$i++){
//            $category[$i]=$res[$i]['category'];
//        }
//        dd($category);

        $item_from_url=[
            ['id'=>1,
            'name'=>'napa'],
            ['id'=>2,
            'name'=>'para']];


       // return redirect()->to('add_item')->with(['item'=>$item]);
        return view('layout.Item.add_item')->with(['item'=>$item,
            'item_from_url'=>$item_from_url
        ]);


    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
    public function api_purchase(){
        $response=Http::get('http://inventory.e-diagnosis.xyz/api/item_search');
        $res=json_decode($response->getBody()->getContents(),true);
        $category=[];
        // var_dump($response);
        for ($i=0;$i< count($res);$i++){
            $category[$i]=$res[$i]['category'];
        }
        dd($category);
    }
}
