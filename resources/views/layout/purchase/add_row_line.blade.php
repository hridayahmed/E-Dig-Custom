
<div class="service-fields mb-3 border">
    <div class="container-fluid mt-3 row">
        <div class="col-lg-2">
            <h6>Line {{$serial}}</h6>
        </div>
        <div class="col-lg-9">

        </div>
        <div class="col-lg-1">
            <div class="form-group">
                <label> </label>
                <button type="button" class="btn btn-danger btn-sm" id="remove_line{{$serial}}" name="remove_line{{$serial}}" value="{{$serial}}" onclick="remove_line(this.value)"><i class="fa fa-trash" aria-hidden="true"></i></button>
            </div>
        </div>

    </div>
    <div class="container-fluid row">
        <div class="col-lg-2">
            <div class="form-group">
                <label>Category<span class="text-danger">*</span></label>
                <select class=" form-select form-control" name="category{{$serial}}" id="category{{$serial}}">
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
                <select name="item_name{{$serial}}" id="item_name{{$serial}}" class="livesearch form-control" onchange="item_wise_details_change(this.value, {{$serial}})"></select>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <label>Quantity<span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="quantity{{$serial}}" id="quantity{{$serial}}" onchange="item_quantity_check(this.value, {{$serial}})">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label>Per Unit Price<span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="per_unit_price{{$serial}}" id="per_unit_price{{$serial}}" onchange="item_total_amount(this.value, {{$serial}})">
            </div>
        </div>
    </div>

    <div class="container-fluid row">
        <div class="col-lg-3">
            <div class="form-group">
                <label>Generic Name</label>
                <input class="form-control" type="text" name="generic_name{{$serial}}" id="generic_name{{$serial}}" readonly>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <label>Type</label>
                <input class="form-control" type="text" name="type{{$serial}}" id="type{{$serial}}" readonly>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label>Brand</label>
                <input class="form-control" type="text" name="brand_name{{$serial}}" id="brand_name{{$serial}}" readonly>
            </div>
        </div>
        <div class="col-lg-1">
            <div class="form-group">
                <label>UOM</label>
                <input class="form-control" type="text" name="uom{{$serial}}" id="uom{{$serial}}" readonly>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <label>Total</label>
                <input class="form-control" type="text" name="item_total_price{{$serial}}" id="item_total_price{{$serial}}" readonly>
            </div>
        </div>

    </div>
</div>

{{--<div id="line_level_more_data{{($serial + 1)}}">--}}

{{--</div>--}}

