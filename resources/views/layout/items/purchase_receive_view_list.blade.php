
    <div class="col-sm-12 col-auto">
        <h3 class="page-title">Receiving</h3>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Dashboard</a></li>
            <li class="breadcrumb-item active">Purchase</li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12 col">
            <a href="" class="btn btn-primary float-right mt-2">Purchase List</a>
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
                                <th>Receiving Date</th>
                                <th>Receiving No</th>
                                <th>Item Name</th>
                                <th>Generic Name</th>
                                <th>Rcv Qty.</th>
                                <th>PUP(B)</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Add to Pay</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $counter = 1;
                            ?>
                            @foreach ($item_wise_receiving as $data)
                                <tr>
                                    <td>{{$counter}}</td>
                                    <td>{{$data->receiving_date}}</td>
                                    <td>RECV_{{$data->receiving_id}}</td>
                                    <td>{{$data->item_name}}</td>
                                    <td>{{$data->generic_name}}</td>
                                    <td>{{$data->quantity}}</td>
                                    <td>{{$data->per_unit_price}}</td>
                                    <td>{{ ($data->per_unit_price * $data->quantity) }}</td>
                                    <td>{{$data->status}}</td>
                                    <td>
                                        <label><input type="checkbox" name="payment_check" id="payment_check{{$counter}}" value="{{($data->per_unit_price * $data->quantity)}}?fs?{{$data->receiving_id}}"
                                                      onclick="calculation_total_amount_for_payment();"> </label>
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

        </div>
    </div>
