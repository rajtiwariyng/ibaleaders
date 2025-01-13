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
        <form action="" id="reset_password_form" method="POST">
        @csrf
        @method('POST')
        <input type="hidden" id="token" name="token" value="{{$token}}">
            
            
            
          <div class="form-group">
            <label for="password">Enter Password</label>
            <input type="password" id="password" name="password" placeholder="Password"  class="form-control">
            <div id="error-password" class="text-danger"></div>
          </div> 
          <div class="form-group">
            <label for="password_confirmation">Enter Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password"  class="form-control">
            <div id="error-password_confirmation" class="text-danger"></div>
          </div> 
        <!--   <div class="text-end">
            <a href="{{ route('front.forgetpassword') }}" class="blue">Forget Password</a>
          </div>-->
          <div class="text-center sbmtBtn">
            <!-- <a href="/IBA/home.html" class="white">
              <div class="cornerbox mt-2">
                <div class="bg"></div>
                <p class="mb-0">Submit</p>
              </div>
            </a> -->
            <div id="alert-success" class="text-success mt-3 alert-success" style="display: none;"></div>
            <button type="button" id="send_password_reset_link" class="btn btn-primary btn-block">Submit</button>
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
  $('#send_password_reset_link').click(function(){
   
        var that = $(this);
        that.prop('disabled', true);
        var email = $('#email').val();
        $('.invalid-feedback').html('');
        let myForm = document.getElementById('reset_password_form');
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
            url: "{{ route('front.changepasswordpost') }}",
            success: function(res) {
                if(res.success){
                    $('#email').val('');
                    that.prop('disabled', false);
                    $('.alert-success').html(res.message).show();
                	setTimeout(function(){ 
                		$('.alert-success').html('').hide();
                    window.location.href = "{{ route('front.login') }}";
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