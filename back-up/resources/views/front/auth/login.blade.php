<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon"> -->
  <link rel="stylesheet" href="{{ asset('front-assets/vendor/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('front-assets/vendor/css/animate.css') }}" />
  <link rel="stylesheet" href="{{ asset('front-assets/vendor/slick/slick.css') }}">
  <link rel="stylesheet" href="{{ asset('front-assets/vendor/slick/slick-theme.css') }}">
  <link rel="stylesheet" href="{{ asset('front-assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('front-assets/css/responsive.css') }}">
  <title>IBA</title>
</head>

<body>
  <div class="login-page">
    <div class="login-wrapper">
      <div class="login-form">
        <div>
          <img src="{{ asset('front-assets/images/logo.png') }}" alt="">
        </div>
        <h5 class="blue poppins-bold py-3">Sign-in to IBA Leader</h5>
        <form action="{{ route('front.login.submit') }}" method="POST">
          @csrf
          <div class="form-group">
            <label for="email">Enter Username</label>
            <input type="email" id="email" name="email" placeholder="Username" class="form-control">
          </div>
          <div class="form-group">
            <label for="email">Enter Password</label>
            <input type="password" id="password" name="password" placeholder="Password"  class="form-control">
          </div>
          <div class="text-end">
            <a href="{{ route('front.forgetpassword') }}" class="blue">Forget Password</a>
          </div>
          <div class="text-center sbmtBtn">
            <!-- <a href="/IBA/home.html" class="white">
              <div class="cornerbox mt-2">
                <div class="bg"></div>
                <p class="mb-0">Submit</p>
              </div>
            </a> -->
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
          </div>
          @if($errors->any())
            <div>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        </form>
      </div>
      <div class="login-banner">
        <img src="{{ asset('front-assets/images/login-banner.png') }}" alt="" class="h-100">
      </div>
    </div>
    <div class="playstoreBtns mt-md-5 mt-4">
      <div class="d-flex">
        <a href="#">
          <img src="{{ asset('front-assets/images/apple.png') }}" alt="">
        </a>
        <a href="#">
          <img src="{{ asset('front-assets/images/google.png') }}" alt="">
        </a>
      </div>
    </div>
  </div>
  <!-- All scripts are here -->
  <script src="{{ asset('front-assets/vendor/js/jquery.min.js') }}"></script>
  <script src="{{ asset('front-assets/vendor/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('front-assets/vendor/slick/slick.min.js') }}"></script>
  <script src="{{ asset('front-assets/vendor/js/wow.min.js') }}"></script>
  <script src="{{ asset('front-assets/js/main.js') }}"></script>
</body>

</html>