@extends('layout.dashboard')

@section('dashboard_main_content')
    <!-- /.start of container-fluid is on dashboard not here -->

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Add Supplier</h1>

    <div class="row">

        <div class="offset-lg-3 col-lg-6">

            <!-- Circle Buttons -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Add Supplier Details</h6>
                </div>
                <div class="card-body">
                    <p >Please add all information about supplier.</p>

                    @isset($duplicate_email)
                        <p style="color: red;">Supplier already present.</p>
                @endisset


                <!-- Circle Buttons (Default) -->
                    <form action="{{'supplier'}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="company_name" class="form-label">Company Name</label>
                            <input type="text" required class="form-control" name="company_name" id="company_name" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label for="supplier_name" class="form-label">Supplier Name</label>
                            <input type="text" required class="form-control" name="supplier_name" id="supplier_name" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label for="supplier_email" class="form-label">Supplier Email</label>
                            <input type="email" required  class="form-control" name="supplier_email" id="supplier_email" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label for="supplier_phone_number" class="form-label">Supplier Phone Number</label>
                            <input type="text" required class="form-control" name="supplier_phone_number" id="supplier_phone_number" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label for="supplier_address" class="form-label">Supplier Address</label>
                            <input type="text" required class="form-control" name="supplier_address" id="supplier_address" placeholder="">
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

