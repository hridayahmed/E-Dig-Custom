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
                    <h6 class="m-0 font-weight-bold text-primary">Supplier List</h6>
                </div>
                <div class="card-body">
                    <p >All information about supplier.</p>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Supplier Details</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Company Name</th>
                                        <th>Supplier Name</th>
                                        <th>Supplier Phone</th>
                                        <th>Supplier Email</th>
                                        <th>Supplier Address</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Company Name</th>
                                        <th>Supplier Name</th>
                                        <th>Supplier Phone</th>
                                        <th>Supplier Email</th>
                                        <th>Supplier Address</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>

                                     @if(@isset($supplier_result))
                                            @foreach($supplier_result as $supplier)
                                                <tr>
                                                 <td>{{$supplier->company_name}}</td>
                                                <td>{{$supplier->supplier_name}}</td>
                                                <td>{{$supplier->supplier_email}}</td>
                                                <td>{{$supplier->supplier_phone_number}}</td>
                                                <td>{{$supplier->supplier_address}}</td>
                                               </tr>
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
