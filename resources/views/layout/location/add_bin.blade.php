@extends('layout/dashboard')

@section('dashboard_main_content')
    <!-- /.start of container-fluid is on dashboard not here -->

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Add Bin</h1>

    <div class="row">

        <div class="offset-lg-1 col-lg-10">

            <!-- Circle Buttons -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Add Bin Details</h6>
                </div>
                <div class="card-body">
                    <p >Please add all information about Bin.</p>

                    @isset($duplicate_bin)
                        <p style="color: red;">Bin already present.</p>
                @endisset


                <!-- Circle Buttons (Default) -->
                    <form action="{{'bin_saving'}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="sub_inventory_name" class="form-label">Organization</label>
                            <select class=" form-select form-control" name="org_id" id="org_id">
                                @foreach ($organization_result as $org)
                                    <option value="{{$org->id}}">{{$org->org_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="sub_inventory_name" class="form-label">Sub Inventory</label>
                            <select class=" form-select form-control" name="sub_inventory_id" id="sub_inventory_id">
                                @foreach ($sub_inventory_result as $sub_inventory)
                                    <option value="{{$sub_inventory->id}}">{{$sub_inventory->sub_inventory_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="rack_id" class="form-label">Rack</label>
                            <select class=" form-select form-control" name="rack_id" id="rack_id">
                                @foreach ($rack_result as $rack)
                                    <option value="{{$rack->id}}">{{$rack->rack_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="row_id" class="form-label">Row</label>
                            <select class=" form-select form-control" name="row_id" id="row_id">
                                @foreach ($row_result as $row)
                                    <option value="{{$row->id}}">{{$row->row_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="bin_name" class="form-label">Bin Name</label>
                            <input type="text" required class="form-control" name="bin_name" id="bin_name" placeholder="Enter New Bin Name">
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </form>

                </div>
            </div>



        </div>



    </div>


    <!-- /.container-fluid is on dashboard not here -->


@endsection
