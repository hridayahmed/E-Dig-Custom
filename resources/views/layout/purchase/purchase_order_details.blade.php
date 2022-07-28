@extends('layout/dashboard')

@section('style')
    {{--    custom style for select2--}}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Datetimepicker CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-datetimepicker.min.css')}}">
@endsection

@section('dashboard_main_content')
    <div class="col-sm-12">
        <h3 class="page-title">Add Purchase</h3>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Dashboard</a></li>
            <li class="breadcrumb-item active">View Purchase</li>
        </ul>
    </div>


    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body custom-edit-service">

                    <!-- Add Medicine -->
                    <form method="post" enctype="multipart/form-data" autocomplete="off" action="">
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
                                        <span>{{$purchase_order_data[0]->supplier_name}}</span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Purchase Order Date<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="purchase_order_date" id="purchase_order_date" value="{{$purchase_order_data[0]->purchase_order_date}}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>



                            <?php
                                $counter = 1;
                            ?>
                            @foreach ($purchase_order_details_data as $data)
                                <div class="service-fields mb-3 border">
                                    <div class="container-fluid mt-3">
                                        <h6>Line {{$counter}}</h6>
                                    </div>

                                    <div class="container-fluid row">
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label>Category<span class="text-danger">*</span></label>
                                                <p><span>Medicine</span></p>
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label>Item Name<span class="text-danger">*</span></label>
                                                <span>{{$data->brand_name}}</span>
                                                {{--                                        <input class="form-control livesearch" type="text" id="item_name1" name="item_name1" onchange="item_wise_details_change(this.value, 1)">--}}
{{--                                                <select name="item_name1" id="item_name1" class="livesearch form-control" onchange="item_wise_details_change(this.value, 1)"></select>--}}
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label>Quantity<span class="text-danger">*</span></label>
                                                <span>{{$data->quantity}}</span>
{{--                                                <input class="form-control" type="text" name="quantity1" id="quantity1" onchange="item_quantity_check(this.value, 1)">--}}
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Per Unit Price<span class="text-danger">*</span></label>
                                                <span>{{$data->per_unit_price}}</span>
{{--                                                <input class="form-control" type="text" name="per_unit_price1" id="per_unit_price1" onchange="item_total_amount(this.value, 1)">--}}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="container-fluid row">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Generic Name</label>
                                                <span>{{$data->name}}</span>
{{--                                                <input class="form-control" type="text" name="generic_name1" id="generic_name1" readonly>--}}
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label>Type</label>
                                                <span>{{$data->dosage_form}}</span>
{{--                                                <input class="form-control" type="text" name="type1" id="type1" readonly>--}}
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Brand</label>
                                                <span>{{$data->company}}</span>
{{--                                                <input class="form-control" type="text" name="brand_name1" id="brand_name1" readonly>--}}
                                            </div>
                                        </div>
                                        <div class="col-lg-1">
                                            <div class="form-group">
                                                <label>UOM</label>
                                                <span>{{$data->uom}}</span>

{{--                                                <input class="form-control" type="text" name="uom1" id="uom1" readonly>--}}
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label>Total</label>
                                                <span>{{ ($data->quantity) * ($data->per_unit_price) }}</span>
{{--                                                <input class="form-control" type="text" name="item_total_price1" id="item_total_price1" onchange="po_total_amount(this.value)" readonly>--}}
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <?php
                                    ++$counter;
                                ?>
                            @endforeach


                    </form>
                    <!-- /Add Medicine -->

                </div>
            </div>
        </div>
    </div>
@endsection



