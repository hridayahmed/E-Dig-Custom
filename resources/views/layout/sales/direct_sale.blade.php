@extends('layout/dashboard')

@section('dashboard_main_content')
    <!-- /.start of container-fluid is on dashboard not here -->

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Product Sales</h1>

    <div class="row">

        <div class="offset-lg-1 col-lg-10">

            <!-- Circle Buttons -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">New Product Sells</h6>
                </div>
                <div class="card-body">
                    <p >Please add all information about your sell.</p>


                <!-- Circle Buttons (Default) -->
                    <form action="{{'generate_direct_sell_so'}}" method="post">
                        @csrf

                        <div class="mb-3">
                            <label for="company_name" class="form-label">Transection Type:  Sales</label>
                        </div>

                        <div class="mb-3">
                            <label for="company_name" class="form-label">Sales Category:  Direct Sale </label>
                        </div>

                        <div class="mb-3">
                            <label for="company_name" class="form-label">Sale Order Date:   {{ date('d-m-Y')  }} </label>
                        </div>

                        <div class="mb-3">
                            <label for="customer_name" class="form-label">Customer Name</label>
                            <input type="text" class="form-control" name="customer_name" id="customer_name">
                        </div>

                        <div class="mb-3">
                            <label for="customer_phone_number" class="form-label">Customer Phone Number</label>
                            <input type="text" class="form-control" name="customer_phone_number" id="customer_phone_number" >
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Generate SO</button>
                        </div>

                    </form>

                </div>
            </div>



        </div>



    </div>


    <!-- /.container-fluid is on dashboard not here -->


@endsection
