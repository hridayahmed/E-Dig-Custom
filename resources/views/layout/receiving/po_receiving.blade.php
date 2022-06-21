@extends('layout/dashboard')

@section('style')

@endsection

@section('dashboard_main_content')
    <div class="col-sm-12">
        <h3 class="page-title">Receiving Portion</h3>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Dashboard</a></li>
            <li class="breadcrumb-item active">PO Wise Receiving</li>
        </ul>
    </div>

    <div class="row text-center">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body custom-edit-service">
                    <label>Purchase Order No</label>
                    <input class="form-control" type="text" name="po_number" id="po_number" onchange="po_details_for_receving(this.value)">
                </div>
            </div>
        </div>
        <div class="col-sm-4"></div>
    </div>

    <div id="po_wise_details">

    </div>
@endsection



@section('script_dashboard')
    <!-- custom style for select2 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <!-- Datetimepicker JS -->
    <script src="{{asset('assets/js/moment.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap-datetimepicker.min.js')}}"></script>

    <!-- Script -->
    <script type='text/javascript'>

        function po_details_for_receving(po_number)
        {
            let _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "po_details_for_receive",
                type: "get",
                data: {_token: _token, po_number:po_number},
                success: function(data)
                {
                    alert(data);
                    document.getElementById("po_wise_details").innerHTML = data;
                }
            });
        }

    </script>

@endsection



