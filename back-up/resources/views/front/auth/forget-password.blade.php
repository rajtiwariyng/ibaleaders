@extends('front.layouts.app')
@section('content') 
      <div class="container">
        <div class="page-inner">
          <div class="whiteBox bg-white p-4">
             <div class="password-container">
                <div class="pw-box px-md-4">
                  <div class="logo pb-4">
                    <img src="images/logo.png" alt="">
                  </div>
                  <div class="pw-header">
                    <h5 class="blue poppins-bold">Reset Password</h5>
                    <p><small>Enter your email address and we'll send you an email with instructions to reset your password.</small></p>
                  </div>
                  <form action="">
                    <div class="form-group">
                      <label for="email" class="blue pb-1">Email*</label>
                      <input type="text" placeholder="Enter email" class="form-control">
                    </div>
                    <div class=" sbmtBtn w-auto mt-3">
                      <a href="otp.html" class="white">
                        <div class="cornerbox mt-2">
                          <div class="bg"></div>
                          <p class="mb-0">Submit</p>
                        </div>
                      </a>
                    </div>
                  </form>
                </div>
                <div class="pw-image">
                  <img src="images/pw-lock.png" alt="">
                </div>
             </div>
          </div>
          <div class="back-to-login">
            <p class="grey poppins-semibold pt-4 ps-5 fs-5">Back to <a href="{{ route('front.login') }}" class="blue">Login</a></p>
          </div>
        </div>

@endsection

@section('customJs')
@endsection