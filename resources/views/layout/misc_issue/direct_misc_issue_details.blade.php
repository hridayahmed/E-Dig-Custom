@extends('layout/dashboard')

@section('style')
    {{--    custom style for select2--}}

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('dashboard_main_content')
    <!-- /.start of container-fluid is on dashboard not here -->

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Product Misc. Issue</h1>

    <div class="row">

        <div class="offset-lg-1 col-lg-10">

            <!-- Circle Buttons -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Misc. Issue Details</h6>
                </div>
                <div class="card-body">

                    <!-- Circle Buttons (Default) -->
                    <form action="{{'misc_issue_generated'}}" method="post">
                        @csrf

                        <div class="mb-3">
                            <label for="company_name" class="form-label">Transaction Type:  Misc. Issue</label>
                        </div>

                        <div class="mb-3">
                            <label for="company_name" class="form-label">Issue Category:  Direct Sales </label>
                            <input type="hidden" name="sales_category" id="sales_category" value="direct_sales">
                        </div>

                        <div class="mb-3">
                            <label for="company_name" class="form-label">Issue Date:   {{ date('d-m-Y')  }} </label>
                        </div>

                        <div class="mb-3">
                            <label for="company_name" class="form-label">Vendor Name:   {{ $vendor_name }} </label>
                            <input type="hidden" name="vendor_name" id="vendor_name" value="{{ $vendor_name }}">
                        </div>

                        <div class="mb-3">
                            <label for="company_name" class="form-label">Vendor Phone Number:   {{ $vendor_phone_number }} </label>
                            <input type="hidden" name="vendor_phone_number" id="vendor_phone_number" value="{{ $vendor_phone_number }}">
                            <input type="hidden" name="sales_date" id="sales_date" value="{{ date('d-m-Y')  }}">
                            <input type="hidden" name="status" id="status" value="{{ $status }}">
                            <input type="hidden" name="reason" id="reason" value="{{ $reason }}">
                            <input type="hidden" name="reason" id="reason" value="{{ $reason }}">
                        </div>

                        <input type="hidden" class="form-control" name="id" id="id">

                        <div class="form-row" id="line_level_more_data1">
                            <div class="form-group col-md-2">
                                <select name="item_name1" id="item_name1" class="livesearch form-control" onchange="item_wise_details_change(this.value, 1)"></select>
                            </div>
                            <div class="form-group col-md-2">
                                <input type="text" class="form-control generic_name1" id="generic_name1" name="generic_name1" readonly>
                            </div>
                            <div class="form-group col-md-2">
                                <input type="text" class="form-control ratio1" id="ratio1" name="ratio1" readonly>
                            </div>
                            <div class="form-group col-md-1">
                                <input type="text" class="form-control per_unit_price1" id="per_unit_price1" name="per_unit_price1" readonly>
                            </div>
                            <div class="form-group col-md-1">
                                <input type="text" class="form-control item_category1" id="item_category1" name="item_category1" readonly>
                            </div>
                            <div class="form-group col-md-2">
                                <input type="text" class="form-control brand_name1" id="brand_name1" name="brand_name1" readonly>
                            </div>
                            <div class="form-group col-md-1">
                                <input type="number" class="form-control quantity1" id="quantity1" name="quantity1" placeholder="Quantity">
                            </div>
                            <div class="form-group col-md-1">
                                <input type="text" class="form-control discount_amount1" id="discount_amount1" name="discount_amount1" value="0" readonly>
                            </div>

                        </div>

                        <div id="line_level_more_data2">

                        </div>

                        <div>
                            <button type="button" class="btn btn-primary btn-sm" id="row_line" name="row_line" value="2" onclick="add_new_line(this.value)">Add</button>
                        </div>

                        <input type="hidden" name="row_line_no" id="row_line_no" value="2">
                        <br>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Generate Misc Issue</button>
                        </div>

                    </form>




                </div>
            </div>



        </div>



    </div>


    <!-- /.container-fluid is on dashboard not here -->


@endsection

@section('script_dashboard')
    <!-- custom style for select2 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <!-- Script -->
    <script type='text/javascript'>

        $('.livesearch').select2({
            placeholder: 'Select item',
            ajax: {
                url: '/item_search',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.item_name,
                                id: item.item_id
                            };
                        })
                    };
                },
                cache: true
            }
        });

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
                    var ratio = data[0].ratio;
                    var generic_name = data[0].generic_name;
                    var per_unit_price = data[0].per_unit_price;
                    var brand_name = data[0].brand_name;
                    var item_category = data[0].item_category;

                    //alert(data => item_name);
                    document.getElementById("ratio"+serial).value = ratio;
                    document.getElementById("generic_name"+serial).value = generic_name;
                    document.getElementById("per_unit_price"+serial).value = per_unit_price;
                    document.getElementById("brand_name"+serial).value = brand_name;
                    document.getElementById("item_category"+serial).value = item_category;

                }
            });
        }

        function  add_new_line(serial)
        {
            alert(serial);
            let _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "add_new_line",
                type: "GET",
                data: {
                    _token: _token, serial: serial
                },
                success: function(data)
                {
                    document.getElementById("line_level_more_data"+serial).innerHTML = data;
                    document.getElementById("row_line").value = parseInt(serial) + 1;
                    document.getElementById("row_line_no").value = parseInt(serial) + 1;

                    //live search
                    $('.livesearch').select2({
                        placeholder: 'Select item',
                        ajax: {
                            url: '/item_search',
                            dataType: 'json',
                            delay: 250,
                            processResults: function (data) {
                                return {
                                    results: $.map(data, function (item) {
                                        return {
                                            text: item.item_name,
                                            id: item.item_id
                                        };
                                    })
                                };
                            },
                            cache: true
                        }
                    });

                }
            });
        }
    </script>
@endsection

