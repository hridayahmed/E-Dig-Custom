
@extends('layout/dashboard')

@section('style')
    {{--    custom style for select2--}}

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('dashboard_main_content')
    <!-- /.start of container-fluid is on dashboard not here -->

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Product Sales List</h1>

    <div class="row">

        <div class="offset-lg-1 col-lg-10">

            <!-- Circle Buttons -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Product Misc Issue</h6>
                </div>
                <div class="card-body">

                    <!-- Circle Buttons (Default) -->
                    <form >
                        @csrf
                        <h2>{{$status}}</h2>

                        <div class="mb-3">
                            <label for="company_name" class="form-label">Transection Type: Misc Issue</label>
                        </div>

                        <div class="mb-3">
                            <label for="company_name" class="form-label">Issue Date:   {{$misc_issue_data[0]->misc_issue_date}} </label>
                        </div>

                        <div class="mb-3">
                            <label for="company_name" class="form-label">Vendor Name: {{$misc_issue_data[0]->vendor_name}}  </label>
                        </div>

                        <div class="mb-3">
                            <label for="company_name" class="form-label">Vendor Phone Number: {{$misc_issue_data[0]->vendor_phone_number}} </label>
                        </div>

                        @if(!empty($misc_issue_details_data))
                            @forelse($misc_issue_details_data as $data)

                                <div class="form-row" id="line_level_more_data1">
                                    <div class="form-group col-md-2">
                                        <p>Item: {{ $data->item_id}}</p>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <p>Generic Name: {{ $data->item_id}}</p>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <p>Ratio: {{ $data->item_id}}</p>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <p>Per Unit Price: {{ $data->item_id}}</p>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <p>Per Unit Price: {{ $data->item_category}}</p>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <p>Brand Name: {{ $data->item_category}}</p>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <p>Quantity: {{ $data->quantity}}</p>
                                    </div>

                                </div>

                                {{--                                <li><a href="{{ route('category.show', $category->id)}}">{{ $category->name }}</a></li>--}}
                            @empty
                                <li>No data found</li>
                            @endforelse
                        @endif


                    </form>




                </div>
            </div>



        </div>



    </div>


    <!-- /.container-fluid is on dashboard not here -->


@endsection

@section('script_dashboard')

@endsection




