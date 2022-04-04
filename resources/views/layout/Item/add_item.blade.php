@extends('layout/dashboard')

@section('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endsection

@section('dashboard_main_content')

    <div class="row">
        <div class="offset-lg-3 col-lg-6">

            <!-- Circle Buttons -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 background_font_color">
                    <h6 class="m-0 font-weight-bold text-center">Add Item</h6>
                </div>
                <div class="card-body">
                    <!-- Circle Buttons (Default) -->
                    <form action="{{'add_item'}}" method="post">
                        @csrf
                        @isset($item)
                            <div class="mb-3 ">
                                <div class="d-flex">
                                    <label for="item_id" class="w-50 font-weight-bold form-label text-right ">purchase Order No :</label>
                                    <label for="item_id" class="w-50 form-label">{{$item[0]->purchase_order_id}}</label>
                                </div>
                                <div class="d-flex">
                                    <label for="item_category" class="w-50 form-label text-right">Purchase Order Date:</label>
                                    <label for="item_category" class="w-50 form-label">{{$item[0]->purchase_order_date}}</label>
                                </div>
                                <div class="d-flex">
                                    <label for="item_category" class="form-label w-50 text-right">Supplier Name:</label>
                                    <label for="item_category" class="w-50 form-label">{{$item[0]->supplier_id}}</label>
                                </div>
                                <div class="d-flex">
                                    <label for="item_category" class="form-label w-50 text-right">Supplier Name:</label>
                                    <label for="item_category" class="w-50 form-label">{{$item[0]->status}}</label>
                                </div>
                            </div>
                        @endisset

                        <div class="mb-3 pb-2 pr-1" style="background: grey;color: white">
                            <div class="d-flex mt-2">
                            <label for="item_id" class="w-50  pr-1 text-right font-weight-bold form-label">Item Category:</label>
                            <label for="item_id" class="w-50 form-label">Medicine</label>
                            </div>
                            <div class="d-flex mt-2">
                                <div for="item_id" class="w-50 pr-1 text-right font-weight-bold form-label">Item Name:</div>
                                <select class="w-50 item_list form-control" name="item_name" id="item_name">
                                    <option value="select"> Select Item Name</option>

                                    @foreach($item_from_url as $item)
                                        <option value="{{$item['id']}}"> {{$item['name']}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="d-flex mt-2">
                                <div for="item_id" class="w-50 pr-1 text-right font-weight-bold form-label">Generic Name:</div>
                                <select class="w-50 item_list form-control" name="item_name" id="item_name">
                                    <option value="select"> Select Item Name</option>

                                    @foreach($item_from_url as $item)
                                        <option value="{{$item['id']}}"> {{$item['name']}}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="d-flex mt-2">
                                <div for="item_id" class="w-50 pr-1 text-right font-weight-bold form-label">Type:</div>
                                <select class="w-50 item_list form-control" name="item_name" id="item_name">
                                    <option value="select"> Select Item Name</option>
                                    @foreach($item_from_url as $item)
                                        <option value="{{$item['id']}}"> {{$item['name']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="d-flex mt-2">
                                <div for="item_id" class="w-50 pr-1 text-right font-weight-bold form-label">Brand Name:</div>
                                <select class="w-50 item_list form-control" name="brand_name" id="brand_name">
                                    <option value="select"> Select Item Name</option>
                                    @foreach($item_from_url as $item)
                                        <option value="{{$item['id']}}"> {{$item['name']}}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="d-flex mt-2">
                                <div for="item_id" class="w-50 pr-1 text-right font-weight-bold form-label">Expire Date:</div>
                                <input type="date" class="w-50 form-control" placeholder="">
                            </div>
                            <div class="d-flex mt-2">
                                <div for="item_id" class="w-50 pr-1 text-right font-weight-bold form-label">UOM:</div>
                                <input type="text" class="w-50 form-control" placeholder="">
                            </div>

                            <div class="d-flex mt-2">
                                <div for="item_id" class="w-50 pr-1 text-right font-weight-bold form-label">Quantity:</div>
                                <input type="text" class="w-50 form-control" placeholder="">
                            </div>

                            <div class="d-flex mt-2">
                                <div for="item_id" class="w-50 pr-1 text-right font-weight-bold form-label">Per Unit Price:</div>
                                <input type="text" class="w-50 form-control" placeholder="">
                            </div>

                            <div class="d-flex mt-2">
                                <div for="item_id" class="w-50 pr-1 text-right font-weight-bold form-label">Total Price:</div>
                                <input type="text" class="w-50 form-control" placeholder="">
                            </div>
                        </div>

                        <div class="text-light mb-2 d-flex justify-content-center bg-gradient-secondary">
                            Add More Sale (+)
                        </div>

                        <div class="mb-3 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>

                </div>
            </div>


    </div>

    <!-- /.container-fluid is on dashboard not here -->

@endsection


@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.item_list').select2();
        });


    </script>


    <style>
        .background_font_color {
            background: #4e73df;
            color: white;
        }
    </style>


@endsection

