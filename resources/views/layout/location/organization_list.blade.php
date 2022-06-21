@extends('layout/dashboard')
@section('style')

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

@endsection

@section('dashboard_main_content')
    <!-- /.start of container-fluid is on dashboard not here -->

    <!-- Page Heading -->

    <div class="row">

        <div class="col-lg-12">

            <!-- Circle Buttons -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Organization List</h6>
                </div>
                <div class="card-body">
                    <p >All information about Organization.</p>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Organization Details</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Organization Name</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $counter = 1;
                                    ?>
                                    @if(@isset($organization_result))
                                        @foreach($organization_result as $organization)
                                            <tr>
                                                <td>{{$counter}}</td>
                                                <td>{{$organization->org_name}}</td>
                                            </tr>
                                            <?php
                                             ++$counter;
                                            ?>
                                        @endforeach
                                    @endif


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div>



        </div>



    </div>


    <!-- /.container-fluid is on dashboard not here -->


@endsection

@section('script_dashboard')
    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
@endsection
