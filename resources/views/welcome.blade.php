<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Jatinan Caffe</title>
  <!-- -------- anime css ------ -->
  <link rel="stylesheet" href="{{ asset ('landing/css/animate.css')}}">
  <!-- --------- tiny slider css ------ -->
  <link rel="stylesheet" href="{{ asset ('landing/css/tiny-slider.css')}}">
  <!-- --------- font awsome css ------ -->
  <link rel="stylesheet" href="{{ asset ('landing/css/all.css')}}">
  <!-- -------- venobox css ------- -->
  <link rel="stylesheet" href="{{ asset ('landing/css/venobox.css')}}" type="text/css" media="screen" />
  <!-- ---- Bootstrap css--- -->
  <link rel="stylesheet" href="{{ asset ('landing/css/bootstrap.min.css')}}">
  <!-- ---------- default css --------- -->
  <link rel="stylesheet" href="{{ asset ('landing/css/default.css')}}">
  <!-- --- style css -->
  <link rel="stylesheet" href="{{ asset ('landing/css/style.css')}}">
</head>

<body>
  <!-- --------- preloader ------------ -->
  <div class="preloader">
    <div class="loader">
      <div class="spinner">
        <div class="spinner-container">
          <div class="spinner-rotator">
            <div class="spinner-left">
              <div class="spinner-circle"></div>
            </div>
            <div class="spinner-right">
              <div class="spinner-circle"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-------   Header star ------>
  <header class="header-area">
    <div class="navbar-area">
      <!---- navbar star--->
      <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
          <div class="container-fluid">
            <a class="navbar-brand" href="#">
              <img class="image" style="width:50px;height:60px;" src="{{ asset ('landing/img/header/logo/logo.png')}}" alt="">
              <span style="color:gray;font-size:150%;">Jatinan Caffe</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
              data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
              aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            @if (Route::has('login'))
              <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                @auth
                  <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                @else
                  <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item">
                @if (Route::has('register'))
                  <a class="nav-link" href="{{ route('register') }}">Register</a>
                  @endif
                </li>
                @endauth
              </ul>
              @endif
            </div>
          </div>
        </nav>
      </div>
    </div>
    <!---- navbar end--->
    <div class="header-hero" data-scroll-index="0">
      <!---- home star ------>
      <div class="shape shape-1"></div>
      <div class="shape shape-2"></div>
      <div class="shape shape-3"></div>
      <div class="shape shape-4"></div>
      <div class="shape shape-5"></div>
      <div class="shape shape-6"></div>
      <div class="container">
        <div class="row align-items-center justify-content-center justify-content-lg-between">
          <div class="col-lg-6 col-md-10">
            <div class="header-hero-content">
              <h1 class="header-title wow fadeInLeftBig" data-wow-duration="3s" data-wow-delay="0.2s"><span>Jatinan Caffe</span> With Mobile Apps Order and Payment</h1>
              <p class="text wow fadeInLeftBig" data-wow-duration="3s" data-wow-delay="0.4s">FOOD BEVERAGE ORDERING AND PAYMENT APPLICATIONS IN JATINAN COFFEE BASED ON ANDROID AND CLIENT SERVER</p>
              <ul class="d-flex">
                <li><a href="" class="main-btn wow fadeInLeftBig" data-wow-duration="3s" data-wow-delay="0.8s">Download
                    Now</a></li>
                <li><a href="https://github.com/setiyawan12" class="header-video venobox wow fadeInLeftBig"
                    data-autoplay="true" data-vbtype="video" data-wow-duration="3s" data-wow-delay="1.2s"><i
                      class="fas fa-play"></i></a></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="header-image">
              <img src="{{ asset ('landing/img/header/header-app.png')}}" alt="" class="image-1  wow fadeInRightBig"
                data-wow-duration="3s" data-wow-delay="0.5s">
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="header-shape-1"></div>
        <div class="header-shape-2">
          <img src="{{ asset ('landing/img/header/header-shape-2.svg')}}" alt="">
        </div>
      </div>
    </div>
    <!---- home star ------>
  </header>
  <!-- ---- jquery Js ---- -->
  <script src="{{ asset ('landing/js/jquery-1.12.4.min.js')}}"></script>
  <!-- -------- venobox js ------ -->
  <script type="text/javascript" src="{{ asset ('landing/js/venobox.min.js')}}"></script>
  <!-- ---------- wow js ---------- -->
  <script src="{{ asset ('landing/js/wow.min.js')}}"></script>
  <!-- ---------- tiny slider js --------- -->
  <script src="{{ asset ('landing/js/tiny-slider.js')}}"></script>
  <!-- ---------- scrollit js ---------- -->
  <script src="{{ asset ('landing/js/scrollIt.min.js')}}"></script>
  <!-- -------- font awsome js --------- -->
  <script src="{{ asset ('landing/js/all.js')}}"></script>
  <!-- ---- Bootstrap Js ---- -->
  <script src="{{ asset ('landing/js/bootstrap.min.js')}}"></script>
  <!-- ---- main js --- -->
  <script src="{{ asset ('landing/js/main.js')}}"></script>
</body>

</html>