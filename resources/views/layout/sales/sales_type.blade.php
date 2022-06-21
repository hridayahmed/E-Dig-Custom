@extends('layout/dashboard')

@section('dashboard_main_content')
    <!-- /.start of container-fluid is on dashboard not here -->

    <!-- Brand Buttons -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Select Sales Type</h6>
        </div>
        <div class="card-body">
            <p>Select which types of sales you occured.</p>

            <a href="#" class="btn btn-google btn-block"><i class="fa fa-internet-explorer"></i>
                Online Sales</a>
            <a href="{{'direct_sale'}}" class="btn btn-facebook btn-block"><i
                    class="fa fa-handshake-o"></i> Direct Sale</a>

        </div>
    </div>


@endsection
