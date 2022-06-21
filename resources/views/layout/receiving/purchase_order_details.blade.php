
    <div class="card mt-4 text-center">
        <div class="card-body custom-edit-service">
            <h3>Purchase Receiving</h3>
            <label>Purchase Order No</label>
            <h4>{{$purchase_order_data[0]->purchase_order_id}}</h4>

        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body custom-edit-service">

                    <!-- Add Medicine -->
                    <form method="post" enctype="multipart/form-data" autocomplete="off" action="{{'po_receiving_data'}}">
                        @csrf
                        <div class="service-fields mb-3 border border-success">
                            <div class="container-fluid row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Transaction Type<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="status" id="status" value="Purchase Order" readonly>
                                        <input class="form-control" type="hidden" name="purchase_order_id" id="purchase_order_id" value="{{$purchase_order_data[0]->purchase_order_id}}" >
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Supplier <span class="text-danger">*</span></label>
                                        <span>{{$purchase_order_data[0]->supplier_name}}</span>
                                        <input class="form-control" type="hidden" name="supplier_id" id="supplier_id" value="{{$purchase_order_data[0]->supplier_name}}" >
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
                            @foreach ($purchase_order_data as $data)
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
                                                <input class="form-control" type="hidden" name="item_name{{$counter}}" id="item_name{{$counter}}" value="{{$data->brand_name}}">
                                                <input class="form-control" type="hidden" name="generic_name{{$counter}}" id="generic_name{{$counter}}" value="{{$data->name}}">
                                                <input class="form-control" type="hidden" name="ratio{{$counter}}" id="ratio{{$counter}}" value="{{$data->strength}}">
                                                <input class="form-control" type="hidden" name="item_type{{$counter}}" id="item_type{{$counter}}" value="{{$data->dosage_form}}">
                                                <input class="form-control" type="hidden" name="brand_name{{$counter}}" id="brand_name{{$counter}}" value="{{$data->company}}">
                                                <input class="form-control" type="hidden" name="sales_per_unit_price{{$counter}}" id="sales_per_unit_price{{$counter}}" value="{{$data->uom_price}}">
                                                <input class="form-control" type="hidden" name="unit_of_measurement{{$counter}}" id="unit_of_measurement{{$counter}}" value="{{$data->uom}}">
                                                <input class="form-control" type="hidden" name="item_category{{$counter}}" id="item_category{{$counter}}" value="{{$data->category}}">
                                                <input class="form-control" type="hidden" name="manufacturing_date{{$counter}}" id="manufacturing_date{{$counter}}" value="">
                                                <input class="form-control" type="hidden" name="prescriptions_necessity{{$counter}}" id="prescriptions_necessity{{$counter}}" value="no">
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label>Quantity<span class="text-danger">*</span></label>
                                                <span>{{$data->quantity}}</span>
                                                <input class="form-control" type="hidden" name="po_quantity{{$counter}}" id="po_quantity{{$counter}}" value="{{$data->quantity}}">
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

                                    <div class="container-fluid row">
                                        <div class="col-lg-9">
                                            <div class="form-group">
                                                <label>Location</label>
    {{--                                             <input class="form-control" type="text" name="item_total_price{{$counter}}" id="item_total_price{{$counter}}" onchange="po_total_amount(this.value)" readonly>--}}
                                                <select name="location{{$counter}}" id="location{{$counter}}" class="locationsearch form-control" >
                                                    @foreach ($location as $loc_data)
                                                        <option value="{{$loc_data->id}}">ORG-{{$loc_data->org_name}}, SubInventory-{{$loc_data->sub_inventory_name}}, Rack- {{$loc_data->rack_name}}, Row- {{$loc_data->row_name}}, Bin- {{$loc_data->bin_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Per Unit Price</label>
                                                <input class="form-control" type="text" name="per_unit_price{{$counter}}" id="per_unit_price{{$counter}}" >
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Quantity</label>
                                                <input class="form-control" type="text" name="quantity{{$counter}}1" id="quantity{{$counter}}1" onchange="quantity_check({{$counter}})" >
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Expire date </label>
                                                <input class="form-control" type="date" name="expire_date{{$counter}}1" id="expire_date{{$counter}}1" >
                                            </div>
                                        </div>

                                    </div>

                                    <div class="container-fluid row">
                                        <div id="add_new_line{{$counter}}1">

                                        </div>
                                    </div>

                                    <div class="container-fluid row">
                                        <div class="col-lg-3">
                                            <button type="button" class="btn btn-primary btn-sm" id="row_line{{$counter}}" name="row_line{{$counter}}" value="{{$counter}}1" onclick="add_new_line(this.value)">Add Row</button>
                                        </div>
                                    </div>

                                </div>
                                <?php
                                    $counter++;
                                ?>
                            @endforeach

                        <input class="form-control" type="text" name="total_rows_count" id="total_rows_count" value="{{$counter}}" >

                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-primary">Receiving</button>
                        </div>

                    </form>
                    <!-- /Add Medicine -->

                </div>
            </div>
        </div>
    </div>



