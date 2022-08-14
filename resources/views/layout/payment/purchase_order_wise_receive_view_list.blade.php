

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
                    <td>PO_{{$data->purchase_order_id}}</td>
                    <td>{{$data->receiving_date}}</td>
                    <td>RECV_{{$data->receiving_id}}</td>
                    <td>{{$data->item_name}}</td>
                    <td>{{$data->generic_name}}</td>
                    <td>{{$data->quantity}}</td>
                    <td>{{$data->per_unit_price}}</td>
                    <td>{{ ($data->per_unit_price * $data->quantity) }}</td>
                    <td>{{$data->status}}</td>
                    <td>
                        <label><input type="checkbox" name="payment_check[]" id="payment_check{{$counter}}" value="{{($data->per_unit_price * $data->quantity)}}?fs?{{$data->receiving_id}}"
                                      onclick="calculation_total_amount_for_payment();"> </label>
                    </td>

                    <input type="hidden" id="purchase_order_id{{$counter}}" name="purchase_order_id{{$counter}}" value="{{$data->purchase_order_id}}">
                    <input type="hidden" id="receiving_id{{$counter}}" name="receiving_id{{$counter}}" value="{{$data->receiving_id}}">
                    <input type="hidden" id="item_id{{$counter}}" name="item_id{{$counter}}" value="{{$data->item_id}}">
                    <input type="hidden" id="item_category{{$counter}}" name="item_category{{$counter}}" value="{{$data->item_category}}">
                    <input type="hidden" id="quantity{{$counter}}" name="quantity{{$counter}}" value="{{$data->quantity}}">

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
