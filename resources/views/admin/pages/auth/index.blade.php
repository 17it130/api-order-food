<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Order Food - Admin</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Themesbrand" name="author" />
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <link href="{{ asset('admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('admin/assets/css/metismenu.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('admin/assets/css/icons.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('admin/assets/css/style.css') }}" rel="stylesheet" type="text/css">
    </head>

    <body>        
        <div class="wrapper-page">

            <div class="card overflow-hidden account-card mx-3">
                
                <div class="bg-primary p-4 text-white text-center position-relative">
                    <h4 class="font-20 m-b-5">Welcome Back !</h4>
                    <p class="text-white-50 mb-4">Sign in to continue</p>
                </div>
                <div class="account-card-content"> 

                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <div class="form-group">
                                <a href="{{ route('auth.gRedirect') }}" class="btn btn-danger w-md waves-effect waves-light" type="button">Login with Google</a>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary w-md waves-effect waves-light" type="button">Login with Facebook</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- end wrapper-page -->


        <!-- jQuery  -->
        <script src="{{ asset('admin/assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('admin/assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('admin/assets/js/metisMenu.min.js') }}"></script>
        <script src="{{ asset('admin/assets/js/jquery.slimscroll.js') }}"></script>
        <script src="assets/js/waves.min.js"></script>

        <!-- App js -->
        <script src="{{ asset('admin/assets/js/app.js') }}"></script>
    </body>

</html>