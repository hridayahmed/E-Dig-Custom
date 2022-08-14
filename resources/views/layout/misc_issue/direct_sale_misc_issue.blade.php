@extends('layout/dashboard')

@section('dashboard_main_content')
    <!-- /.start of container-fluid is on dashboard not here -->

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Misc. Issue</h1>

    <div class="row">

        <div class="offset-lg-1 col-lg-10">

            <!-- Circle Buttons -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">New Misc. Issue</h6>
                </div>
                <div class="card-body">
                    <p >Please add all information about your misc. issue</p>


                    <!-- Circle Buttons (Default) -->
                    <form action="{{'generate_direct_misc_issue'}}" method="post">
                        @csrf

                        <div class="mb-3">
                            <label for="company_name" class="form-label">Transaction Type:  Misc Issue</label>
                        </div>

                        <div class="mb-3">
                            <label for="company_name" class="form-label">Issue Category:  Direct Sales </label>
                        </div>

                        <div class="mb-3">
                            <label for="company_name" class="form-label">Issue Date:   {{ date('d-m-Y')  }} </label>
                        </div>

                        <div class="mb-3">
                            <label for="reason" class="form-label">Reason</label>
                            <select class="form-control" id="reason" name="reason">
                                <option value="Gift">Gift</option>
                                <option value="Garbage">Garbage</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="vendor_name" class="form-label">Vendor Name</label>
                            <input type="text" class="form-control" name="vendor_name" id="vendor_name">
                        </div>

                        <div class="mb-3">
                            <label for="vendor_phone_number" class="form-label">Vendor Phone Number</label>
                            <input type="text" class="form-control" name="vendor_phone_number" id="vendor_phone_number" >
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <input type="text" class="form-control" name="status" id="status">
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Generate Misc Issue</button>
                        </div>

                    </form>

                </div>
            </div>



        </div>



    </div>


    <!-- /.container-fluid is on dashboard not here -->


@endsection
