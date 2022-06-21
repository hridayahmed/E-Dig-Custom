@extends('layout/dashboard')

@section('style')
    {{--    custom style for select2--}}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    {{--    style for font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Datetimepicker CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-datetimepicker.min.css')}}">

@endsection

@section('dashboard_main_content')

    <div class="col-sm-12">
        <h3 class="page-title">Add Purchase</h3>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a >Dashboard</a></li>
            <li class="breadcrumb-item active">Add Purchase</li>
        </ul>
    </div>


    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body custom-edit-service">

                    <!-- Add Medicine -->
                    <form method="post" enctype="multipart/form-data" autocomplete="off" action="{{'purchase_order_generated'}}">
                        @csrf
                        <div class="service-fields mb-3 border border-success">
                            <div class="container-fluid row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Transaction Type<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="status" id="status" value="Purchase Order" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Supplier <span class="text-danger">*</span></label>
                                        <select class="form-select form-control" name="supplier" id="supplier">
                                            @foreach ($suppliers as $supplier)
                                                <option value="{{$supplier->supplier_id}}">{{$supplier->supplier_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Purchase Order Date<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="purchase_order_date" id="purchase_order_date" value="{{ date('m/d/Y') }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="service-fields mb-3 border">
                            <div class="container-fluid mt-3">
                                <h6>Line 1</h6>
                            </div>
                            <div class="container-fluid row">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label>Category<span class="text-danger">*</span></label>
                                        <select class=" form-select form-control" name="category1" id="category1">
                                            @foreach ($categories as $category)
                                                <option value="{{$category}}">{{$category}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label>Item Name<span class="text-danger">*</span></label>
{{--                                        <input class="form-control livesearch" type="text" id="item_name1" name="item_name1" onchange="item_wise_details_change(this.value, 1)">--}}
                                        <select name="item_name1" id="item_name1" class="livesearch form-control" onchange="item_wise_details_change(this.value, 1)"></select>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label>Quantity<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="quantity1" id="quantity1" onchange="item_quantity_check(this.value, 1)">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Per Unit Price<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="per_unit_price1" id="per_unit_price1" onchange="item_total_amount(this.value, 1)">
                                    </div>
                                </div>
                            </div>

                            <div class="container-fluid row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Generic Name</label>
                                        <input class="form-control" type="text" name="generic_name1" id="generic_name1" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label>Type</label>
                                        <input class="form-control" type="text" name="type1" id="type1" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Brand</label>
                                        <input class="form-control" type="text" name="brand_name1" id="brand_name1" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <div class="form-group">
                                        <label>UOM</label>
                                        <input class="form-control" type="text" name="uom1" id="uom1" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label>Total</label>
                                        <input class="form-control" type="text" name="item_total_price1" id="item_total_price1" onchange="po_total_amount(this.value)" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="line_level_more_data2">

                        </div>

                        <div id="line_level_more_data3">

                        </div>

                        <div id="line_level_more_data4">

                        </div>

                        <div id="line_level_more_data5">

                        </div>

                        <div id="line_level_more_data6">

                        </div>

                        <div id="line_level_more_data7">

                        </div>
                        <div id="line_level_more_data8">

                        </div>

                        <div id="line_level_more_data9">

                        </div>

                        <div id="line_level_more_data10">

                        </div>

                        <div id="line_level_more_data11">

                        </div>
                        <div id="line_level_more_data12">

                        </div>
                        <div id="line_level_more_data13">

                        </div>
                        <div id="line_level_more_data14">

                        </div>
                        <div id="line_level_more_data15">

                        </div>
                        <div id="line_level_more_data16">

                        </div>
                        <div id="line_level_more_data17">

                        </div>
                        <div id="line_level_more_data18">

                        </div>
                        <div id="line_level_more_data19">

                        </div>
                        <div id="line_level_more_data20">

                        </div>
                        <div id="line_level_more_data21">

                        </div>
                        <div id="line_level_more_data22">

                        </div>
                        <div id="line_level_more_data23">

                        </div>
                        <div id="line_level_more_data24">

                        </div>
                        <div id="line_level_more_data25">

                        </div>
                        <div id="line_level_more_data26">

                        </div>
                        <div id="line_level_more_data27">

                        </div>
                        <div id="line_level_more_data28">

                        </div>
                        <div id="line_level_more_data29">

                        </div>
                        <div id="line_level_more_data30">

                        </div>
                        <div id="line_level_more_data31">

                        </div>
                        <div id="line_level_more_data32">

                        </div>
                        <div id="line_level_more_data33">

                        </div>
                        <div id="line_level_more_data34">

                        </div>
                        <div id="line_level_more_data35">

                        </div>
                        <div id="line_level_more_data36">

                        </div>
                        <div id="line_level_more_data37">

                        </div>
                        <div id="line_level_more_data38">

                        </div>
                        <div id="line_level_more_data39">

                        </div>
                        <div id="line_level_more_data40">

                        </div>
                        <div id="line_level_more_data41">

                        </div>
                        <div id="line_level_more_data42">

                        </div>
                        <div id="line_level_more_data43">

                        </div>
                        <div id="line_level_more_data44">

                        </div>
                        <div id="line_level_more_data45">

                        </div>
                        <div id="line_level_more_data46">

                        </div>
                        <div id="line_level_more_data47">

                        </div>
                        <div id="line_level_more_data48">

                        </div>
                        <div id="line_level_more_data49">

                        </div>
                        <div id="line_level_more_data50">

                        </div>



                        <div class="row container-fluid">
                            <div class="col-lg-3">
                                <button type="button" class="btn btn-primary btn-sm" id="row_line" name="row_line" value="2" onclick="add_new_line(this.value)">Add</button>
                            </div>

                            <div class="col-lg-2">

                            </div>

                            <div class="col-lg-2">
                                <p>Total Line: <span id="total_line"></span></p>
                            </div>

                            <div class="col-lg-2">
                                <p>Total Category: <span id="total_category"></span></p>
                            </div>

                            <div class="col-lg-3">
{{--                                <span>Total PO Amount =  <input class="form-control" type="number" name="po_total_amount" id="po_total_amount" value="0" readonly>  </span>--}}
                                <p>Total PO Amount:  <span name="po_total_amount" id="po_total_amount"> </span> </p>
                            </div>
                        </div>

                        <input type="hidden" name="row_line_no" id="row_line_no" value="2">

                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn" type="submit" >Generate PO</button>
                        </div>
                    </form>
                    <!-- /Add Medicine -->

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

        $('.livesearch').select2({
            placeholder: 'Select item using name',
            ajax: {
                url: '/item_search',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {

                            return {
                                text: item.brand_name+" ("+item.company+") - "+item.strength,
                                id: item.id
                            };
                        })
                    };
                },
                cache: true
            }
        });

        $('.lotsearch').select2({
            placeholder: 'Select Lot',
            ajax: {
                url: '/lot_search',
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

        function  item_quantity_check(quantity, serial)
        {
            var per_unit_price = document.getElementById("per_unit_price"+serial).value;
            var total = parseInt(quantity) * parseInt(per_unit_price);

            document.getElementById("item_total_price"+serial).value = total;

            total_price_calculation();
        }

        function total_price_calculation()
        {
            var total = 0;
            var line_counter = 0;
            const category_array = [];
            for (var i= 1; i <= 50; i++)
            {
                if (document.getElementById("item_total_price"+i))
                {
                    var item_price = parseInt(document.getElementById("item_total_price"+i).value);
                    total = total + item_price;
                    ++line_counter;

                    if ( !(category_array.includes(document.getElementById("category"+i).value)))
                    {
                        category_array.push(document.getElementById("category"+i).value);
                    }
                }
            }
            document.getElementById("po_total_amount").innerHTML = total;
            document.getElementById("total_line").innerHTML = line_counter;
            document.getElementById("total_category").innerHTML = category_array.length;


        }

        function  item_total_amount (per_unit_price, serial)
        {
            var quantity = document.getElementById("quantity"+serial).value;
            var total = parseInt(quantity) * parseInt(per_unit_price);

            document.getElementById("item_total_price"+serial).value = total;
            total_price_calculation();
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

        function  add_new_line(serial)
        {
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
                        placeholder: 'Select item wise search',
                        ajax: {
                            url: '/item_search',
                            dataType: 'json',
                            delay: 250,
                            processResults: function (data) {
                                return {
                                    results: $.map(data, function (item) {
                                        return {
                                            text: item.brand_name+" ("+item.company+") - "+item.strength,
                                            id: item.id
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

        function remove_line(serial)
        {
            const element = document.getElementById("line_level_more_data"+serial);
            element.remove();
            total_price_calculation();
        }

    </script>

@endsection


