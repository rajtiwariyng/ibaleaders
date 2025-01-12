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
        <form action="" id="validate_otp_form" method="POST">
        @csrf
        @method('POST')

        <div class="form-group">
            <label for="email">Enter Email</label>
            <input type="email" id="email" name="email" placeholder="Email" class="form-control">
            <div id="error-email" class="text-danger"></div>
          </div>
          <div class="form-group">
            <label for="otp">Enter OTP</label>
            <input type="text" id="otp" name="otp" placeholder="OTP" class="form-control">
            <div id="error-otp" class="text-danger"></div>
          </div>
         
         
          <div class="text-center sbmtBtn">
            
            <div id="alert-success" class="text-success mt-3 alert-success" style="display: none;"></div>
            <button type="button" id="send_validate_otp" class="btn btn-primary btn-block">Submit</button>
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
<script>
  $('#send_validate_otp').click(function(){
   
        var that = $(this);
        that.prop('disabled', true);
        var otp = $('#otp').val();
        $('.invalid-feedback').html('');
        let myForm = document.getElementById('validate_otp_form');
        let formData = new FormData(myForm);
        $.ajax({
            // type: "POST",
            // dataType: "json",
            // data: formData,
            method: "POST",
            data: formData,
            async: true,
            processData: false,
            contentType: false,
            url: "{{ route('front.validate.otppost') }}",
            success: function(res) {
                if(res.success){
                    $('#otp').val('');
                    $('#error-email').html('');
                    $('#error-otp').html('');
                    that.prop('disabled', false);
                    $('.alert-success').html(res.message).show();
                	setTimeout(function(){ 
                		$('.alert-success').html('').hide();
                    window.location.href = res.url;
                	}, 4000);
                }
            },
            error:function(error){
            	var response = $.parseJSON(error.responseText);
                let error_messages = response.errors;
                $.each(error_messages, function(key, error_message) {
                    $('#error-'+key).addClass('is-invalid');
                    // alert(key)
                    $('#error-'+key).html(error_message[0]).show();
                });
                that.prop('disabled', false);
            }
        });
    });
  </script>

</body>

</html>