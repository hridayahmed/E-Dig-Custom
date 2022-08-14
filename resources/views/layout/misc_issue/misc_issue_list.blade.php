
@extends('layout/dashboard')

@section('style')
    {{--    custom style for select2--}}

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('dashboard_main_content')
    <!-- /.start of container-fluid is on dashboard not here -->

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Product Misc Issue List</h1>

    <div class="row">

        <div class="offset-lg-1 col-lg-10">

            <!-- Circle Buttons -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Product Misc Issue List</h6>
                </div>

                <div class="card-body">

                    <table class="table table-bordered">

                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Vendor Name</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">Date</th>
                            <th scope="col">Type</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @if(!empty($misc_issue_data))
                            @forelse($misc_issue_data as $data)

                                <tr>
                                    <th scope="row">1</th>
                                    <td>{{ $data->vendor_name}}</td>
                                    <td>{{ $data->vendor_phone_number}}</td>
                                    <td>{{ $data->misc_issue_date}}</td>
                                    <td>{{ $data->transection_type}}</td>
                                    <td>
                                        <button class="btn btn-sm"><a href="{{ url('misc_issue_details_show/'.$data->misc_issue_id) }}"> Details </a></button>
                                    </td>
                                </tr>

                            @empty
                                <li>No data found</li>
                            @endforelse
                        @endif

                        </tbody>

                    </table>

                </div>

            </div>



        </div>



    </div>


    <!-- /.container-fluid is on dashboard not here -->


@endsection

@section('script_dashboard')

@endsection




