@extends('layout/dashboard')

@section('style')

@endsection

@section('dashboard_main_content')
    <div class="col-sm-12 col-auto">
        <h3 class="page-title">Receiving</h3>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Dashboard</a></li>
            <li class="breadcrumb-item active">Purchase</li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12 col">
            <a href="" class="btn btn-primary float-right mt-2">Purchase List</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">

            <!-- Recent Orders -->
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="purchase-table" class="datatable table table-hover table-center mb-0">
                            <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Receiving Date</th>
                                <th>Receiving No</th>
                                <th>Purchase No</th>
                                <th>Item Name</th>
                                <th>Generic Name</th>
                                <th>Supplier</th>
                                <th>Status</th>
                                <th class="action-btn">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $counter = 1;
                            ?>
                            @foreach ($item_wise_receiving as $data)
                                <tr>
                                    <td>{{$counter}}</td>
                                    <td>{{$data->purchase_order_date}}</td>
                                    <td>RECV_{{$data->purchase_order_id}}</td>
                                    <td>{{$data->supplier_name}}</td>
                                    <td>{{$data->status}}</td>
                                    <td>
                                        <form method="post" action="{{'purchase_order_details'}}">
                                            @csrf
                                            <div class="btn-group">
                                                <input type="hidden" name="purchase_order_id" id="purchase_order_id" value="{{$data->purchase_order_id}}">
                                                <button class="btn btn-primary btn-sm submit-btn" type="submit" >View</button>
                                                <button type="button" class="btn btn-primary btn-sm" id="receive_po{{$counter}}" name="receive_po{{$counter}}" value="{{$data->purchase_order_id}}" onclick="po_wise_receive({{$data->purchase_order_id}})">Receive</button>
                                                @if(!($data->receiving_purchase_order_id))
                                                    <button type="button" class="btn btn-primary btn-sm" id="delete_po{{$counter}}" name="delete_po{{$counter}}" value="{{$data->purchase_order_id}}" onclick="delete_po({{$data->purchase_order_id}})">Delete</button>
                                                @endif
                                                @if($data->receiving_purchase_order_id)
                                                    <button type="button" class="btn btn-primary btn-sm" id="receive_view{{$counter}}" name="receive_view{{$counter}}" value="{{$data->purchase_order_id}}" onclick="receive_view({{$data->purchase_order_id}})">Receive View</button>
                                                @endif
                                            </div>

                                        </form>

                                    </td>
                                </tr>
                                <?php
                                ++$counter;
                                ?>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /Recent Orders -->

            <div id="po_wise_details">

            </div>

        </div>
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

        function po_wise_receive(purchase_order_id)
        {
            let _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "po_wise_receive_from_list",
                type: "get",
                data: {_token: _token, po_number:purchase_order_id},
                success: function(data)
                {
                    //alert(data);
                    document.getElementById("po_wise_details").innerHTML = data;
                }
            });
        }

    </script>

@endsection

