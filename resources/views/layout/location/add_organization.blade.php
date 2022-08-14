@extends('layout/dashboard')

@section('dashboard_main_content')
    <!-- /.start of container-fluid is on dashboard not here -->

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Add Organization</h1>

    <div class="row">

        <div class="offset-lg-1 col-lg-10">

            <!-- Circle Buttons -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Add Organization Details</h6>
                </div>
                <div class="card-body">
                    <p >Please add all information about Organization.</p>

                    @isset($duplicate_org)
                        <p style="color: red;">Organization already present.</p>
                @endisset


                <!-- Circle Buttons (Default) -->
                    <form action="{{'organization_saving'}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="organization_name" class="form-label">Organization Name</label>
                            <input type="text" required class="form-control" name="organization_name" id="organization_name" placeholder="Enter New Organization Name">
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
