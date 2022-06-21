
<div class="form-row">
    <div class="form-group col-md-2">
        <select name="item_name{{$serial}}" id="item_name{{$serial}}" class="livesearch form-control" onchange="item_wise_details_change(this.value, {{$serial}})"></select>
    </div>
    <div class="form-group col-md-2">
        <input type="text" class="form-control generic_name{{$serial}}" id="generic_name{{$serial}}" name="generic_name{{$serial}}" readonly>
    </div>
    <div class="form-group col-md-1">
        <input type="text" class="form-control ratio{{$serial}}" id="ratio{{$serial}}" name="ratio{{$serial}}" readonly>
    </div>
    <div class="form-group col-md-1">
        <input type="text" class="form-control per_unit_price{{$serial}}" id="per_unit_price{{$serial}}" name="per_unit_price{{$serial}}" readonly>
    </div>
    <div class="form-group col-md-1">
        <input type="text" class="form-control item_category{{$serial}}" id="item_category{{$serial}}" name="item_category{{$serial}}" readonly>
    </div>
    <div class="form-group col-md-1">
        <input type="text" class="form-control brand_name{{$serial}}" id="brand_name{{$serial}}" name="brand_name{{$serial}}" readonly>
    </div>
    <div class="form-group col-md-1">
        <select name="lot{{$serial}}" id="lot{{$serial}}" class="lotsearch form-control"></select>
    </div>
    <div class="form-group col-md-1">
        <input type="number" class="form-control quantity{{$serial}}" id="quantity{{$serial}}" name="quantity{{$serial}}" placeholder="Quantity">
    </div>
    <div class="form-group col-md-1">
        <input type="text" class="form-control discount_amount{{$serial}}" id="discount_amount{{$serial}}" name="discount_amount{{$serial}}" value="0" readonly>
    </div>
</div>

<div id="line_level_more_data{{($serial + 1)}}">

</div>
