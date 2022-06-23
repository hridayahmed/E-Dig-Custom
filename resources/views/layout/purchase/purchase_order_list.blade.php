@extends('layout/dashboard')

@section('style')

@endsection

@section('dashboard_main_content')
    <div id="full_content">
        <div class="col-sm-12 col-auto">
            <h3 class="page-title">Purchase</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                <li class="breadcrumb-item active">Purchase</li>
            </ul>
        </div>
        <div class="row">
            <div class="col-sm-12 col">
                <a href="" class="btn btn-primary float-right mt-2">Add New</a>
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
                                    <th>PO Date</th>
                                    <th>PO No</th>
                                    <th>Supplier</th>
                                    <th>Status</th>
                                    <th class="action-btn">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $counter = 1;
                                ?>
                                @foreach ($purchase_order_data as $data)
                                    <tr>
                                        <td>{{$counter}}</td>
                                        <td>{{$data->purchase_order_date}}</td>
                                        <td>PO_{{$data->purchase_order_id}}</td>
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
                                                        <button type="button" class="btn btn-primary btn-sm" id="receive_view{{$counter}}" name="receive_view{{$counter}}" value="{{$data->purchase_order_id}}" onclick="receive_view({{$data->purchase_order_id}})">Payment</button>
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

        function item_wise_details_change(item_id, serial)
        {

            let _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "item_details_info",
                type: "GET",
                data: {
                    _token: _token, item_id:item_id, serial: serial
                },
                success: function(data)
                {
                    //alert(data);

                    var ratio = data[0].strength;
                    var item_type = data[0].dosage_form;
                    var generic_name = data[0].name;
                    var per_unit_price = data[0].uom_price;
                    var brand_name = data[0].company;
                    var item_category = data[0].category;
                    var uom = data[0].uom;

                    document.getElementById("type"+serial).value = item_type;
                    document.getElementById("generic_name"+serial).value = generic_name;
                    document.getElementById("per_unit_price"+serial).value = per_unit_price;
                    document.getElementById("brand_name"+serial).value = brand_name;
                    document.getElementById("uom"+serial).value = uom;
                    //document.getElementById("item_category"+serial).value = item_category;

                }
            });
        }

        function delete_po(purchase_order_id)
        {
            let _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "purchase_order_delete",
                type: "get",
                data: {_token: _token, purchase_order_id:purchase_order_id},
                success: function(data)
                {
                    alert(data);
                }
            });
        }

        function receive_view(purchase_order_id)
        {
            let _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "purchase_order_receive_view",
                type: "get",
                data: {_token: _token, purchase_order_id:purchase_order_id},
                success: function(data)
                {
                    //alert(data);
                    document.getElementById("full_content").innerHTML = data;
                }
            });
        }


        function quantity_check(counter)
        {
            var po_quantity = document.getElementById("po_quantity"+counter).value;
            var receive_quantity = document.getElementById("quantity"+counter).value;

            alert(po_quantity);
            alert(receive_quantity);

            if (receive_quantity > po_quantity)
            {
                alert("You can not receive more item");
                document.getElementById("quantity"+counter).style.color = "#ff0000";
                //document.getElementById("quantity"+counter).value = '';
            }
            else
            {
                document.getElementById("quantity"+counter).style.color = 'black';
            }
        }

        function  add_new_line(counter)
        {
            let _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "add_new_line_for_receiving",
                type: "GET",
                data: {
                    _token: _token, counter: counter
                },
                success: function(data)
                {
                    const new_counter = counter.charAt(0);
                    const line = parseInt(counter.charAt(counter.length - 1)) + 1;

                    document.getElementById("add_new_line"+counter).innerHTML = data;
                    document.getElementById("row_line"+new_counter).value = new_counter+line;
                    //document.getElementById("add_new_line11"+counter+"1").innerHTML = data;
                    //document.getElementById("row_line").value = parseInt(serial) + 1;
                    //document.getElementById("row_line_no").value = parseInt(serial) + 1;
                }
            });
        }

        function remove_line(counter)
        {
            const new_counter = counter.charAt(0);
            const line = parseInt(counter.charAt(counter.length - 1)) - 1;

            document.getElementById("add_new_line"+counter).innerHTML = '';
            document.getElementById("row_line"+new_counter).value = new_counter+line;
        }

        function calculation_total_amount_for_payment()
        {
            var checkboxes = document.querySelectorAll('input[name="payment_check"]:checked'), values = [];
            Array.prototype.forEach.call(checkboxes, function(el) {
                values.push(el.value);
            });

            var amount_array = [];
            var receiving_array = [];
            var total_amount = 0;

            for (var i=0; i < values.length; i++)
            {
                var split = values[i].split("?fs?");

                if ( !(receiving_array.includes(split[1]) ))
                {
                    amount_array.push(split[0]);
                    receiving_array.push(split[1]);
                    total_amount += parseInt(split[0]);
                }
            }

            document.getElementById("amount_array").value = amount_array;
            document.getElementById("receiving_array").value = receiving_array;
            document.getElementById("total_amount").value = total_amount;
            document.getElementById("total_amount_view").innerHTML = total_amount;
            document.getElementById("payment_amount").value = total_amount;

        }

        function discount_calculation()
        {
            var discount = document.getElementById("discount_amount").value;
            var total_amount = document.getElementById("total_amount").value;
            var percentage = (parseInt(discount) * 100) / parseInt(total_amount);
            document.getElementById("discount_percent").innerHTML = percentage.toFixed(2)+"%";
            document.getElementById("payment_amount").value = total_amount - discount;

        }

    </script>

@endsection

