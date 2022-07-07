@extends('layout/dashboard')

@section('style')

@endsection

@section('dashboard_main_content')
    <div id="full_content">
        <div class="col-sm-12 col-auto">
            <h3 class="page-title">Payment</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                <li class="breadcrumb-item active">Make Payment</li>
            </ul>
        </div>

        <form action="{{'payment_save_to_database'}}" method="post">
            @csrf
            <div class="row text-center">
                <div class="col-md-4"></div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Supplier</label>
                        <select class=" form-select form-control" name="supplier" id="supplier" onchange="supplier_selection(this.value)">
                            <option>Select Supplier</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{$supplier->supplier_id}}">{{$supplier->supplier_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>

            <div id="payment_full_data">

            </div>

        </form>
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

        function supplier_selection(supplier)
        {
            let _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "details_info_for_payment",
                type: "post",
                data: {_token: _token, supplier_id:supplier},
                success: function(data)
                {
                    //alert(data);
                    document.getElementById("payment_full_data").innerHTML = data;
                }
            });
        }

        function purchase_order_selection(purchase_order)
        {
            let _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "details_info_for_purchase_order_wise_payment",
                type: "post",
                data: {_token: _token, purchase_order_id:purchase_order},
                success: function(data_for_purchase_order_wise_payment)
                {
                    //adjustment amount form pick
                    let _token = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "adjustment_amount_form_receive",
                        type: "post",
                        data: {_token: _token},
                        success: function(data_for_adjustment_amount_form)
                        {
                            //adjustment amount form pick
                            document.getElementById("purchase_order_wise_selection").innerHTML = data_for_purchase_order_wise_payment;
                            document.getElementById("adjustment_amount_form").innerHTML = data_for_adjustment_amount_form;
                        }
                    });

                }
            });
        }

        function calculation_total_amount_for_payment()
        {
            var checkboxes = document.querySelectorAll('input[name="payment_check[]"]:checked'), values = [];
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

            //selected checkbox
            // var selected_data = " <input class='form-control' type='text' name='payment_amount' id='payment_amount'> ";
            //
            // document.getElementById("checkbox_selected").innerHTML = selected_data;

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

