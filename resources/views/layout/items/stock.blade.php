@extends('layout/dashboard')

@section('style')

@endsection

@section('dashboard_main_content')
    <div class="col-sm-12 col-auto">
        <h3 class="page-title">Items Stock</h3>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Dashboard</a></li>
            <li class="breadcrumb-item active">Stock</li>
        </ul>
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
                                <th>Item Name</th>
                                <th>Generic Name</th>
                                <th>Ratio</th>
                                <th>Type</th>
                                <th>Brand Name</th>
                                <th>Available Stock</th>
                                <th>Category</th>
                                <th class="action-btn">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $counter = 1;
                            ?>
                            @foreach ($all_items as $item)
                                <tr>
                                    <td>{{$counter}}</td>
                                    <td>{{$item->item_name}}</td>
                                    <td>{{$item->generic_name}}</td>
                                    <td>{{$item->ratio}}</td>
                                    <td>{{$item->item_type}}</td>
                                    <td>{{$item->brand_name}}</td>
                                    <td>{{$item->stock_quantity}}</td>
                                    <td>{{$item->item_category}}</td>
                                    <td>
                                        <form method="post" action="{{'item_stock_against_lot'}}">
                                            @csrf
                                            <div class="btn-group">
                                                <input type="hidden" name="item_id" id="item_id" value="{{$item->item_id}}">
                                                <button class="btn btn-primary btn-sm submit-btn" type="submit" >View</button>
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

    </script>

@endsection

