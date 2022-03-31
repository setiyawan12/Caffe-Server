<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Login | Jatinan Caffe</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset ('core/images/logo.png')}}">

    <!-- preloader css -->
    <link rel="stylesheet" href="{{ asset ('core/css/preloader.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/6.6.96/css/materialdesignicons.min.css" integrity="sha512-dAWyuzC1uq8T14qaENg+n0Vc7LkKjbC0FLEmYBRmd+1v74V9I5mCTvPZDclpsgd0FMPcySSMWG/s1yq2pa8MRw==" crossorigin="anonymous" referrerpolicy="no-referrer" />    
    <!-- Bootstrap Css -->
    <link href="{{ asset ('core/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset ('core/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset ('core/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body>

    <!-- <body data-layout="horizontal"> -->
    <div class="auth-page">
        <div class="container-fluid p-0">
            <div class="row g-0">
                <div class="col-xxl-3 col-lg-4 col-md-5">
                    <div class="auth-full-page-content d-flex p-sm-5 p-4">
                        <div class="w-100">
                            <div class="d-flex flex-column h-100">
                                <div class="mb-4 mb-md-5 text-center">
                                    <a href="index.html" class="d-block auth-logo">
                                        <img src="{{ asset ('core/images/logo.png')}}" alt="" height="28"> <span
                                            class="logo-txt">Jatinan Caffe</span>
                                    </a>
                                </div>
                                <div class="auth-content my-auto">
                                    <div class="text-center">
                                        <h5 class="mb-0">Welcome Back !</h5>
                                        <p class="text-muted mt-2">Sign in to continue to Jatinan Caffe.</p>
                                    </div>
                                    <form class="mt-4 pt-2" method="POST" action="{{ route('login') }}">
                                    @csrf   
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email" autofocus>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <div class="d-flex align-items-start">
                                                <div class="flex-grow-1">
                                                    <label class="form-label">Password</label>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <div class="">
                                                        <a href="auth-recoverpw.html" class="text-muted">Forgot
                                                            password?</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="input-group auth-pass-inputgroup">
                                                <input type="password" class="form-control @error('password') is-invalid @enderror"  name="password" required autocomplete="current-password"
                                                    aria-label="Password" aria-describedby="password-addon">
                                                <button class="btn btn-light shadow-none ms-0" type="button"
                                                    id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="remember-check">
                                                    <label class="form-check-label" for="remember-check">
                                                        Remember me
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="mb-3">
                                            <button class="btn btn-primary w-100 waves-effect waves-light"
                                                type="submit">{{ __('Login') }}</button>
                                        </div>
                                    </form>


                                    <div class="mt-5 text-center">
                                        <p class="text-muted mb-0">Don't have an account ? <a href="{{route('register')}}"
                                                class="text-primary fw-semibold"> Signup now </a> </p>
                                    </div>
                                </div>
                                <div class="mt-4 mt-md-5 text-center">
                                    <p class="mb-0">© <script>
                                            document.write(new Date().getFullYear())

                                        </script> Jatinan Caffe . Crafted with <i class="mdi mdi-heart text-danger"></i> by
                                        Setiyawan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end auth full page content -->
                </div>
                <!-- end col -->
                <div class="col-xxl-9 col-lg-8 col-md-7">
                    <div class="auth-bg pt-md-5 p-4 d-flex">
                        <div class="bg-overlay bg-primary"></div>
                        <ul class="bg-bubbles">
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                        <!-- end bubble effect -->
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container fluid -->
    </div>


    <!-- JAVASCRIPT -->
    <script src="{{ asset ('core/libs/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset ('core/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset ('core/libs/metismenu/metisMenu.min.js')}}"></script>
    <script src="{{ asset ('core/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{ asset ('core/libs/node-waves/waves.min.js')}}"></script>
    <script src="{{ asset ('core/libs/feather-icons/feather.min.js')}}"></script>
    <!-- pace js -->
    <script src="{{ asset ('core/libs/pace-js/pace.min.js')}}"></script>
    <!-- password addon init -->
    <script src="{{ asset ('core/js/pages/pass-addon.init.js')}}"></script>

</body>

</html>
