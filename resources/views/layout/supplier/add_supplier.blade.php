@extends('layout/dashboard')

@section('dashboard_main_content')
    <!-- /.start of container-fluid is on dashboard not here -->

      <!-- Page Heading -->
<<<<<<< HEAD
            <h1 class="h3 mb-4 text-gray-800">Buttons</h1>

            <div class="row">

                <div class="col-lg-6">
=======
            <h1 class="h3 mb-4 text-gray-800">Add Supplier</h1>

            <div class="row">

                <div class="offset-lg-3 col-lg-6">
>>>>>>> 35313778b16ab4743535990deee621f8613de4dc

                    <!-- Circle Buttons -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
<<<<<<< HEAD
                            <h6 class="m-0 font-weight-bold text-primary">Circle Buttons</h6>
                        </div>
                        <div class="card-body">
                            <p>Use Font Awesome Icons (included with this theme package) along with the circle
                                buttons as shown in the examples below!</p>
                            <!-- Circle Buttons (Default) -->
                            <div class="mb-2">
                                <code>.btn-circle</code>
                            </div>
                            <a href="#" class="btn btn-primary btn-circle">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="btn btn-success btn-circle">
                                <i class="fas fa-check"></i>
                            </a>
                            <a href="#" class="btn btn-info btn-circle">
                                <i class="fas fa-info-circle"></i>
                            </a>
                            <a href="#" class="btn btn-warning btn-circle">
                                <i class="fas fa-exclamation-triangle"></i>
                            </a>
                            <a href="#" class="btn btn-danger btn-circle">
                                <i class="fas fa-trash"></i>
                            </a>
                            <!-- Circle Buttons (Small) -->
                            <div class="mt-4 mb-2">
                                <code>.btn-circle .btn-sm</code>
                            </div>
                            <a href="#" class="btn btn-primary btn-circle btn-sm">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="btn btn-success btn-circle btn-sm">
                                <i class="fas fa-check"></i>
                            </a>
                            <a href="#" class="btn btn-info btn-circle btn-sm">
                                <i class="fas fa-info-circle"></i>
                            </a>
                            <a href="#" class="btn btn-warning btn-circle btn-sm">
                                <i class="fas fa-exclamation-triangle"></i>
                            </a>
                            <a href="#" class="btn btn-danger btn-circle btn-sm">
                                <i class="fas fa-trash"></i>
                            </a>
                            <!-- Circle Buttons (Large) -->
                            <div class="mt-4 mb-2">
                                <code>.btn-circle .btn-lg</code>
                            </div>
                            <a href="#" class="btn btn-primary btn-circle btn-lg">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="btn btn-success btn-circle btn-lg">
                                <i class="fas fa-check"></i>
                            </a>
                            <a href="#" class="btn btn-info btn-circle btn-lg">
                                <i class="fas fa-info-circle"></i>
                            </a>
                            <a href="#" class="btn btn-warning btn-circle btn-lg">
                                <i class="fas fa-exclamation-triangle"></i>
                            </a>
                            <a href="#" class="btn btn-danger btn-circle btn-lg">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Brand Buttons -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Brand Buttons</h6>
                        </div>
                        <div class="card-body">
                            <p>Google and Facebook buttons are available featuring each company's respective
                                brand color. They are used on the user login and registration pages.</p>
                            <p>You can create more custom buttons by adding a new color variable in the
                                <code>_variables.scss</code> file and then using the Bootstrap button variant
                                mixin to create a new style, as demonstrated in the <code>_buttons.scss</code>
                                file.</p>
                            <a href="#" class="btn btn-google btn-block"><i class="fab fa-google fa-fw"></i>
                                .btn-google</a>
                            <a href="#" class="btn btn-facebook btn-block"><i
                                    class="fab fa-facebook-f fa-fw"></i> .btn-facebook</a>
=======
                            <h6 class="m-0 font-weight-bold text-primary">Add Supplier Details</h6>
                        </div>
                        <div class="card-body">
                            <p >Please add all information about supplier.</p>

                            @isset($duplicate_email)
                                <p style="color: red;">Supplier already present.</p>
                           @endisset


                            <!-- Circle Buttons (Default) -->
                            <form action="{{'supplier'}}" method="post">
                                @csrf
                            <div class="mb-3">
                                <label for="company_name" class="form-label">Company Name</label>
                                <input type="text" required class="form-control" name="company_name" id="company_name" placeholder="">
                            </div>
                            <div class="mb-3">
                                <label for="supplier_name" class="form-label">Supplier Name</label>
                                <input type="text" required class="form-control" name="supplier_name" id="supplier_name" placeholder="">
                            </div>
                            <div class="mb-3">
                                <label for="supplier_email" class="form-label">Supplier Email</label>
                                <input type="email" required  class="form-control" name="supplier_email" id="supplier_email" placeholder="">
                            </div>
                            <div class="mb-3">
                                <label for="supplier_phone_number" class="form-label">Supplier Phone Number</label>
                                <input type="text" required class="form-control" name="supplier_phone_number" id="supplier_phone_number" placeholder="">
                            </div>
                            <div class="mb-3">
                                <label for="supplier_address" class="form-label">Supplier Address</label>
                                <input type="text" required class="form-control" name="supplier_address" id="supplier_address" placeholder="">
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>

                            </form>
>>>>>>> 35313778b16ab4743535990deee621f8613de4dc

                        </div>
                    </div>

<<<<<<< HEAD
                </div>

                <div class="col-lg-6">

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Split Buttons with Icon</h6>
                        </div>
                        <div class="card-body">
                            <p>Works with any button colors, just use the <code>.btn-icon-split</code> class and
                                the markup in the examples below. The examples below also use the
                                <code>.text-white-50</code> helper class on the icons for additional styling,
                                but it is not required.</p>
                            <a href="#" class="btn btn-primary btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-flag"></i>
                                        </span>
                                <span class="text">Split Button Primary</span>
                            </a>
                            <div class="my-2"></div>
                            <a href="#" class="btn btn-success btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-check"></i>
                                        </span>
                                <span class="text">Split Button Success</span>
                            </a>
                            <div class="my-2"></div>
                            <a href="#" class="btn btn-info btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-info-circle"></i>
                                        </span>
                                <span class="text">Split Button Info</span>
                            </a>
                            <div class="my-2"></div>
                            <a href="#" class="btn btn-warning btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </span>
                                <span class="text">Split Button Warning</span>
                            </a>
                            <div class="my-2"></div>
                            <a href="#" class="btn btn-danger btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                <span class="text">Split Button Danger</span>
                            </a>
                            <div class="my-2"></div>
                            <a href="#" class="btn btn-secondary btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-arrow-right"></i>
                                        </span>
                                <span class="text">Split Button Secondary</span>
                            </a>
                            <div class="my-2"></div>
                            <a href="#" class="btn btn-light btn-icon-split">
                                        <span class="icon text-gray-600">
                                            <i class="fas fa-arrow-right"></i>
                                        </span>
                                <span class="text">Split Button Light</span>
                            </a>
                            <div class="mb-4"></div>
                            <p>Also works with small and large button classes!</p>
                            <a href="#" class="btn btn-primary btn-icon-split btn-sm">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-flag"></i>
                                        </span>
                                <span class="text">Split Button Small</span>
                            </a>
                            <div class="my-2"></div>
                            <a href="#" class="btn btn-primary btn-icon-split btn-lg">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-flag"></i>
                                        </span>
                                <span class="text">Split Button Large</span>
                            </a>
                        </div>
                    </div>

                </div>

=======


                </div>



>>>>>>> 35313778b16ab4743535990deee621f8613de4dc
            </div>


        <!-- /.container-fluid is on dashboard not here -->


@endsection
