<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    public function org_store(Request $request)
    {
        $organization_name = $request->organization_name;

        $duplicate=DB::connection('mysql2')
            ->select("select * from organization where org_name='$organization_name'");
        if (count($duplicate)>0)
        {
            $duplicate_org = "Organization already present";
            return view('layout.location.add_organization')->with('duplicate_org',$duplicate_org);
        }
        else
        {
            $insert_into_supplier= DB::connection('mysql2')
                ->insert("Insert into organization (org_name) values
                        ('$organization_name')");
            return redirect('organization_list');
        }


    }

    public function org_index()
    {
        $organization_result = DB::connection('mysql2')
            ->select("select * from organization");
        return view('layout.location.organization_list')->with('organization_result',$organization_result);
    }

    //for sub_inventory
    public function create_sub_inventory()
    {
        $organization_result = DB::connection('mysql2')
            ->select("select * from organization");
        return view('layout/location/add_sub_inventory')->with('organization_result',$organization_result);
    }

    public function sub_inventory_store(Request $request)
    {
        $sub_inventory_name = $request->sub_inventory_name;
        $org_id = $request->org_id;

        $duplicate=DB::connection('mysql2')
            ->select("select * from sub_inventory where sub_inventory_name='$sub_inventory_name'");
        if (count($duplicate)>0)
        {
            $duplicate_sub_inventory = "Sub-inventory already present";
            return view('layout.location.add_sub_inventory')->with('duplicate_sub_inventory',$duplicate_sub_inventory);
        }
        else
        {
            $insert_into_sub_inventory= DB::connection('mysql2')
                ->insert("Insert into sub_inventory (sub_inventory_name, org_id) values
                        ('$sub_inventory_name', $org_id)");
            return redirect('sub_inventory_list');
        }


    }

    public function sub_inventory_index()
    {
        $sub_inventory_result = DB::connection('mysql2')
            ->select("select sub_inventory.*, organization.org_name from sub_inventory, organization where
                sub_inventory.org_id = organization.id ");
        return view('layout.location.sub_inventory_list')->with('sub_inventory_result',$sub_inventory_result);
    }


    //for rack
    public function create_rack()
    {
        $organization_result = DB::connection('mysql2')
            ->select("select * from organization");
        $sub_inventory_result = DB::connection('mysql2')
            ->select("select * from sub_inventory");

        return view('layout/location/add_rack')->with(['organization_result'=> $organization_result, 'sub_inventory_result' => $sub_inventory_result]);
    }

    public function rack_store(Request $request)
    {
        $rack_name = $request->rack_name;
        $org_id = $request->org_id;
        $sub_inventory_id = $request->sub_inventory_id;

        $duplicate=DB::connection('mysql2')
            ->select("select * from rack where rack_name='$rack_name'");

        if (count($duplicate)>0)
        {
            $duplicate_rack = "Rack already present";

            return view('layout.location.add_rack')->with('duplicate_rack',$duplicate_rack);
        }
        else
        {
            $insert_into_rack = DB::connection('mysql2')
                ->insert("Insert into rack (rack_name, org_id, sub_inventory_id) values
                        ('$rack_name', $org_id, $sub_inventory_id)");
            return redirect('rack_list');
        }


    }

    public function rack_index()
    {
        $rack_result = DB::connection('mysql2')
            ->select("select rack.*, organization.org_name, sub_inventory.sub_inventory_name  from rack, sub_inventory, organization where
              rack.org_id = organization.id and rack.sub_inventory_id = sub_inventory.id");
        return view('layout.location.rack_list')->with('rack_result', $rack_result);
    }


    //for row
    public function create_row()
    {
        $organization_result = DB::connection('mysql2')
            ->select("select * from organization");
        $sub_inventory_result = DB::connection('mysql2')
            ->select("select * from sub_inventory");
        $rack_result = DB::connection('mysql2')
            ->select("select * from rack");

        return view('layout/location/add_row')->with(['organization_result'=> $organization_result, 'sub_inventory_result' => $sub_inventory_result,
            'rack_result' => $rack_result]);
    }

    public function row_store(Request $request)
    {
        $row_name = $request->row_name;
        $rack_id = $request->rack_id;
        $org_id = $request->org_id;
        $sub_inventory_id = $request->sub_inventory_id;

        $duplicate=DB::connection('mysql2')
            ->select("select * from row where row_name='$row_name'");

        if (count($duplicate)>0)
        {
            $duplicate_row = "Row already present";

            return view('layout.location.add_row')->with('duplicate_row',$duplicate_row);
        }
        else
        {
            $insert_into_row = DB::connection('mysql2')
                ->insert("Insert into row (row_name, org_id, sub_inventory_id, rack_id) values
                        ('$row_name', $org_id, $sub_inventory_id, $rack_id)");
            return redirect('row_list');
        }


    }

    public function row_index()
    {
        $row_result = DB::connection('mysql2')
            ->select("select row.*, organization.org_name, sub_inventory.sub_inventory_name, rack.rack_name  from row, sub_inventory, organization, rack where
              row.org_id = organization.id and row.sub_inventory_id = sub_inventory.id and row.rack_id = rack.id ");
        return view('layout.location.row_list')->with('row_result', $row_result);
    }


    //for bin
    public function create_bin()
    {
        $organization_result = DB::connection('mysql2')
            ->select("select * from organization");
        $sub_inventory_result = DB::connection('mysql2')
            ->select("select * from sub_inventory");
        $rack_result = DB::connection('mysql2')
            ->select("select * from rack");
        $row_result = DB::connection('mysql2')
            ->select("select * from row");

        return view('layout/location/add_bin')->with(['organization_result'=> $organization_result, 'sub_inventory_result' => $sub_inventory_result,
            'rack_result' => $rack_result, 'row_result' => $row_result]);
    }

    public function bin_store(Request $request)
    {
        $bin_name = $request->bin_name;
        $row_id = $request->row_id;
        $rack_id = $request->rack_id;
        $org_id = $request->org_id;
        $sub_inventory_id = $request->sub_inventory_id;

        $duplicate = DB::connection('mysql2')
            ->select("select * from bin where bin_name='$bin_name'");

        if (count($duplicate)>0)
        {
            $duplicate_bin = "Bin already present";

            return view('layout.location.add_bin')->with('duplicate_bin', $duplicate_bin);
        }
        else
        {
            $insert_into_bin = DB::connection('mysql2')
                ->insert("Insert into bin (bin_name, row_id, org_id, sub_inventory_id, rack_id) values
                        ('$bin_name', '$row_id', $org_id, $sub_inventory_id, $rack_id)");
            return redirect('bin_list');
        }


    }

    public function bin_index()
    {
        $bin_result = DB::connection('mysql2')
            ->select("select bin.*, row.row_name, organization.org_name, sub_inventory.sub_inventory_name, rack.rack_name  from bin, row, sub_inventory, organization, rack where
              bin.org_id = organization.id and bin.sub_inventory_id = sub_inventory.id and bin.rack_id = rack.id and bin.row_id = row.id ");
        return view('layout.location.bin_list')->with('bin_result', $bin_result);
    }

}
