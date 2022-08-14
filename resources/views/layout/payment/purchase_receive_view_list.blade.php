
    <div class="row">
        <div class="col-md-12">


            <div class="col-lg-4">
                <div class="form-group">
                    <label>Purchase Order (PO)</label>
                    <select class=" form-select form-control" name="purchase_order" id="purchase_order" onchange="purchase_order_selection(this.value)">
                        <option>Select Purchase Order</option>
                        @foreach ($all_purchase_order as $po)
                            <option value="{{$po->purchase_order_id}}">PO_{{$po->purchase_order_id}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Recent payment -->
            <div class="card" id="purchase_order_wise_selection">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="purchase-table" class="datatable table table-hover table-center mb-0">
                            <thead>
                            <tr>
                                <th>Sl</th>
                                <th>PO Number</th>
                                <th>Receiving Date</th>
                                <th>Receiving No</th>
                                <th>Item Name</th>
                                <th>Generic Name</th>
                                <th>Rcv Qty.</th>
                                <th>PUP(B)</th>
                                <th>Price</th>
                                <th>Rem Amount</th>
                                <th>Status</th>
                                <th>Add to Pay</th>
                                <th>Pay Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $counter = 1;
                            ?>
                            @foreach ($item_wise_receiving as $data)
                                <tr>
                                    <td>{{$counter}}</td>
                                    <td>PO_{{$data->purchase_order_id}}</td>
                                    <td>{{$data->receiving_date}}</td>
                                    <td>RECV_{{$data->receiving_id}}</td>
                                    <td>{{$data->item_name}}</td>
                                    <td>{{$data->generic_name}}</td>
                                    <td>{{$data->quantity}}</td>
                                    <td>{{$data->per_unit_price}}</td>
                                    <td>{{ ($data->per_unit_price * $data->quantity) }}</td>
                                    <td>0</td>
                                    <td>{{$data->status}}</td>
                                    <td>
                                        <label><input type="checkbox" name="payment_check[]" id="payment_check{{$counter}}" value="{{($data->per_unit_price * $data->quantity)}}?fs?{{$data->receiving_id}}"
                                                      onclick="calculation_total_amount_for_payment();"> </label>
                                    </td>

                                    <td>
                                        <label><input type="number" name="pay{{$counter}}" id="pay{{$counter}}" value=""> </label>
                                    </td>

                                    <input type="hidden" id="purchase_order_id{{$counter}}" name="purchase_order_id{{$counter}}" value="{{$data->purchase_order_id}}">
                                    <input type="hidden" id="receiving_id{{$counter}}" name="receiving_id{{$counter}}" value="{{$data->receiving_id}}">
                                    <input type="hidden" id="item_id{{$counter}}" name="item_id{{$counter}}" value="{{$data->item_id}}">
                                    <input type="hidden" id="item_category{{$counter}}" name="item_category{{$counter}}" value="{{$data->item_category}}">
                                </tr>
                                <?php
                                ++$counter;
                                ?>
                            @endforeach

                            <input type="hidden" id="total_counter" name="total_counter" value="{{$counter}}">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /Recent Orders -->

            <div id="po_wise_details" class="row">
                <input type="hidden" id="total_amount" name="total_amount" >
                <input type="hidden" id="amount_array" name="amount_array" >
                <input type="hidden" id="receiving_array" name="receiving_array" >
                <div class="col-lg-9">

                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label>Total Amount = </label>
                        <span id="total_amount_view"></span>
                    </div>
                </div>

            </div>

            <div class="container-fluid row">
                <div class="col-lg-3"></div>
                <div class="col-lg-3"></div>

                <div class="col-lg-3">
                    <div class="form-group">
                        <label>Discount percentage</label>
                        <p><span id="discount_percent">0%</span></p>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="form-group">
                        <label>Discount</label>
                        <input class="form-control" type="text" name="discount_amount" id="discount_amount" value="0" onchange="discount_calculation()">
                    </div>
                </div>

            </div>

            <div class="container-fluid row">
                <div class="col-lg-3"></div>
                <div class="col-lg-3"></div>

                <div class="col-lg-3">
                    <div class="form-group">
                        <label>Payment Type</label>
                        <select name="payment_type" id="payment_type" class="form-control">
                            <option value="Cash">Cash</option>
                            <option value="Card">Card</option>
                            <option value="Nagad">Nagad</option>
                            <option value="bKash">bKash</option>
                            <option value="Rocket">Rocket</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label>Payment Amount</label>
                        <input class="form-control" type="text" name="payment_amount" id="payment_amount">
                    </div>
                </div>
            </div>

            <div id="adjustment_amount_form">

            </div>

            <div id="checkbox_selected">

            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Payment</button>
            </div>

        </div>
    </div>
