<?php

namespace App\Http\Controllers;

use App\Http\Middleware\SetDBMiddleWare;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $supplier_result=DB::connection('mysql2')
            ->select("select * from supplier");
        return view('layout.supplier.supplier_list')->with('supplier_result',$supplier_result);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $company_name=$request->company_name;
        $supplier_name=$request->supplier_name;
        $supplier_email=$request->supplier_email;
        $supplier_phone_number=$request->supplier_phone_number;
        $supplier_address=$request->supplier_address;
        $duplicate=DB::connection('mysql2')
            ->select("select * from supplier where supplier_email='$supplier_email'");
        if (count($duplicate)>0)
        {
            $duplicate_email="Supplier already present";
           return view('layout.supplier.add_supplier')->with('duplicate_email',$duplicate_email);
        }
        else
        {
            $insert_into_supplier=DB::connection('mysql2')
                ->insert("Insert into supplier(company_name,supplier_name,supplier_email,supplier_phone_number,supplier_address) values
('$company_name','$supplier_name','$supplier_email','$supplier_phone_number','$supplier_address')");
            return redirect('supplier_list');
        }








    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
