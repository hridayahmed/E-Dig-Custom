@extends('layout/dashboard')

@section('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endsection

@section('dashboard_main_content')
    <!-- /.start of container-fluid is on dashboard not here -->

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">New Purchase</h1>

    <div class="row">

        <div class="offset-lg-3 col-lg-6">

            <!-- Circle Buttons -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">New Purchase Details</h6>
                </div>
                <div class="card-body">
                    <p >Please add  information about new purchase.</p>

                <!-- Circle Buttons (Default) -->
                    <form action="{{'new_purchase'}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="item_id" class="form-label">Transactions Type</label>
                            <input type="text" required class="form-control" name="transection_type" id="transection_type" placeholder="">

                        </div>
                        <div class="mb-3">
                            <label for="item_category" class="form-label">Purchase Order Date</label>
                            <input type="date" required class="form-control" name="purchase_order_date" id="purchase_order_date" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label for="item_category" class="form-label">Supplier Name</label>

                            <select class="supplierName form-control" name="supplier_id" id="supplier_id">
                                <option value="select"> Select Supplier Name</option>

                            @foreach($supplier as $sup)
                                <option value="{{$sup->supplier_id}}"> {{$sup->supplier_name}}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Generate PO</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- /.container-fluid is on dashboard not here -->

@endsection


@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.supplierName').select2();
        });


    </script>



@endsection

