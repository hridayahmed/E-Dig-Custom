@extends('layout/dashboard')

@section('dashboard_main_content')
    <!-- /.start of container-fluid is on dashboard not here -->

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Add Purchase</h1>

    <div class="row">

        <div class="offset-lg-3 col-lg-6">

            <!-- Circle Buttons -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Add Purchase Details</h6>
                </div>
                <div class="card-body">
                    <p >Please add all information about purchase.</p>


                <!-- Circle Buttons (Default) -->
                    <form action="{{'purchase'}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="item_id" class="form-label">Item Name</label>
                            <input type="text" required class="form-control" name="item_id" id="item_id" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label for="item_category" class="form-label">Item Category</label>
                            <input type="text" required class="form-control" name="item_category" id="item_category" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="text" required  class="form-control" name="quantity" id="quantity" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label for="per_unit_price" class="form-label">per_unit_price</label>
                            <input type="text" required class="form-control" name="per_unit_price" id="per_unit_price" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label for="supplier_id" class="form-label">Supplier Name</label>
                            <input type="text" required class="form-control" name="supplier_id" id="supplier_id" placeholder="">
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <input type="text" required class="form-control" name="status" id="status" placeholder="">
                        </div>

                        <div class="mb-3">
                            <label for="transection_type" class="form-label">Transection Type</label>
                            <input type="text" required class="form-control" name="transection_type" id="transection_type" placeholder="">
                        </div>

                        <div class="mb-3">
                            <label for="purchase_order_date" class="form-label">Purchase Order Date</label>
                            <input type="text" required class="form-control" name="purchase_order_date" id="purchase_order_date" placeholder="">
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
