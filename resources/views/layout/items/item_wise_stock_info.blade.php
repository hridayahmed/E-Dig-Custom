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

            <!-- header info -->
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="purchase-table" class="datatable table table-hover table-center mb-0">
                            <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Generic Name</th>
                                <th>Ratio</th>
                                <th>Type</th>
                                <th>Brand Name</th>
                                <th>Available Stock</th>
                                <th>Category</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$item_wise_lot[0]->item_name}}</td>
                                    <td>{{$item_wise_lot[0]->generic_name}}</td>
                                    <td>{{$item_wise_lot[0]->ratio}}</td>
                                    <td>{{$item_wise_lot[0]->item_type}}</td>
                                    <td>{{$item_wise_lot[0]->brand_name}}</td>
                                    <td>{{$item_wise_lot[0]->stock_quantity}}</td>
                                    <td>{{$item_wise_lot[0]->item_category}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /header info -->


            <!-- line info -->
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="purchase-table" class="datatable table table-hover table-center mb-0">
                            <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Lot No</th>
                                <th>Quantity</th>
                                <th>Buying price</th>
                                <th>Manufacture date</th>
                                <th>Expire date</th>
                                <th>Transaction Type</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $counter = 1;
                            ?>
                            @foreach ($item_wise_lot as $item)
                                <tr>
                                    <td>{{$counter}}</td>
                                    <td>{{$item->lot_number}}</td>
                                    <td>{{$item->quantity}}</td>
                                    <td>{{$item->purchase_price}}</td>
                                    <td>{{$item->manufacturing_date}}</td>
                                    <td>{{$item->expiry_date}}</td>
                                    <td>{{$item->source_transaction_type}}</td>
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
            <!-- /line info -->

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

@endsection

