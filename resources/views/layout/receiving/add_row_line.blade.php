<?php
    $counter;
    $new_counter = (int) substr($counter, 0, 1);
    $line = substr($counter, -1);
    $new_counter_row = $new_counter.($line + 1);
?>
    <div class="row">
        <div class="col-lg-3">
            <div class="form-group">
                <label>Quantity</label>
                <input class="form-control" type="text" name="quantity{{$new_counter_row}}" id="quantity{{$new_counter_row}}" onchange="quantity_check({{$counter}})" >
            </div>
        </div>

        <div class="col-lg-3">
            <div class="form-group">
                <label>Expire date </label>
                <input class="form-control" type="date" name="expire_date{{$new_counter_row}}" id="expire_date{{$new_counter_row}}" >
            </div>
        </div>
        <div class="col-lg-3 mt-5">
            <div class="form-group">
                <label> </label>
                <button type="button" class="btn btn-danger btn-sm" id="remove_line{{$new_counter_row}}" name="remove_line{{$new_counter_row}}" value="{{$new_counter_row}}" onclick="remove_line(this.value)"><i class="fa fa-trash" aria-hidden="true"></i></button>
            </div>
        </div>

    </div>

<div id="add_new_line{{$new_counter_row}}">

</div>

