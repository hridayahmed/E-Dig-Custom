@extends('layout/dashboard')

@section('dashboard_main_content')
    <!-- /.start of container-fluid is on dashboard not here -->

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Product Purchase</h1>

    <div class="row">

        <div class="offset-lg-1 col-lg-10">

            <!-- Circle Buttons -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">New Product Purchase</h6>
                </div>
                <div class="card-body">
                    <p >Please add all information about your purchase.</p>


                    <!-- Circle Buttons (Default) -->
                    <form action="{{'generate_purchase_po'}}" method="post">
                        @csrf

                        <div class="mb-3">
                            <label for="transaction_type" class="form-label">Transaction Type:  Purchase </label>
                        </div>

                        <div class="mb-3">
                            <label for="purchase_order_date" class="form-label">Purchase Order Date:   {{ date('d-m-Y')  }} </label>
                        </div>

                        <div class="mb-3">
                            <label for="supplier_name" class="form-label">Supplier Name</label>
                            <select class="livesearch form-control p-3" id="supplier_name" name="supplier_name"></select>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Generate PO</button>
                        </div>

                    </form>

                </div>
            </div>



        </div>



    </div>


    <!-- /.container-fluid is on dashboard not here -->


@endsection



@section('script_dashboard')
    <!-- custom style for select2 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <!-- Script -->
    <script type='text/javascript'>

        $('.livesearch').click({
            placeholder: 'Select Supplier',
            ajax: {
                url: '/supplier_search',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.item_name,
                                id: item.item_id
                            };
                        })
                    };
                },
                cache: true
            }
        });

    </script>
@endsection
