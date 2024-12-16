@extends('front.layouts.app')
@section('content')
<div class="container">
        @include('front.users.profile-top')
              <div class="mt-4">
                <div class="whiteBox bg-white p-4 mt-4">
                  <div class="d-flex mb-3">
                    <div class="d-flex align-items-center">
                      <div class="pe-3">
                        <img src="{{ asset('front-assets/icons/in.png') }}" alt="" class="linkdinImage">
                      </div>
                      <div>
                        <p class="mb-0"><strong>Linkedin</strong></p>
                        <p class="mb-0">Promoted</p>
                      </div>
                    </div>
                  </div>
                  <p>Update you job preferences to help recruiters find you for the right oppurtunities. </p>
                  <div>
                    <img src="{{ asset('front-assets/images/linkedin-banner.png') }}" alt="">
                  </div>
                  <div class="reactions d-flex align-items-center justify-content-between pt-3">
                    <a class="d-flex align-items-center text-color">
                      <img src="{{ asset('front-assets/icons/React.png') }}" alt="" class="pe-2">
                      React
                    </a>
                    <a class="d-flex align-items-center text-color">
                      <img src="{{ asset('front-assets/icons/Comment.png') }}" alt="" class="pe-2">
                      Comment
                    </a>
                    <a class="d-flex align-items-center text-color">
                      <img src="{{ asset('front-assets/icons/Share.png') }}" alt="" class="pe-2">
                      Share
                    </a>
                  </div>
                </div>
                <div class="whiteBox bg-white p-4 mt-4">
                  <div class="d-flex mb-3">
                    <div class="d-flex align-items-center">
                      <div class="pe-3">
                        <img src="{{ asset('front-assets/icons/in.png') }}" alt="" class="linkdinImage">
                      </div>
                      <div>
                        <p class="mb-0"><strong>Linkedin</strong></p>
                        <p class="mb-0">Promoted</p>
                      </div>
                    </div>
                  </div>
                  <p>Update you job preferences to help recruiters find you for the right oppurtunities. </p>
                  <div>
                    <img src="{{ asset('front-assets/images/linkedin-banner.png') }}" alt="">
                  </div>
                  <div class="reactions d-flex align-items-center justify-content-between pt-3">
                    <a class="d-flex align-items-center text-color">
                      <img src="{{ asset('front-assets/icons/React.png') }}" alt="" class="pe-2">
                      React
                    </a>
                    <a class="d-flex align-items-center text-color">
                      <img src="{{ asset('front-assets/icons/Comment.png') }}" alt="" class="pe-2">
                      Comment
                    </a>
                    <a class="d-flex align-items-center text-color">
                      <img src="{{ asset('front-assets/icons/Share.png') }}" alt="" class="pe-2">
                      Share
                    </a>
                  </div>
                </div> 
                
              </div>
            </div>
            <div class="col-lg-5 mt-4">
              <div class="whiteBox bg-white p-3 mb-3">
                <h5 class="blue poppins-bold mb-0 fs-6">Visitor Registration</h5>
                <form id="visitorFormProfile" class="vrForm pt-4">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <input type="text" name="first_name" class="form-control" placeholder="First Name" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="text" name="mobile_number" class="form-control" placeholder="Mobile Number" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="text" name="company_name" class="form-control" placeholder="Company Name">
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="text" name="city" class="form-control" placeholder="City">
                        </div>
                        <div class="col-md-12 form-group">
                            <textarea name="address" rows="4" cols="2" class="form-control" placeholder="Address"></textarea>
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="text" name="state_country_province" class="form-control" placeholder="State/Country/Province">
                            <input type="text" name="post_code" class="form-control" placeholder="Post Code">
                        </div>
                    </div>
                    <div class="text-center sbmtBtn">
                        <button type="button" onclick="visitorSubmitForm()" class="btn btn-primary">
                                Submit
                            </button>
                    </div>
                    <div id="successMsg" class="text-success mt-3" style="display: none;"></div>
                </form>


              </div>
            </div>
          </div>
        </div>
        @endsection
        
@section('customJs')
<script>
    function visitorSubmitForm() {
        // Clear previous error messages
        $('.text-danger').text('');
        
        $.ajax({
            url: "{{ route('visitor.register') }}",
            method: "POST",
            data: $('#visitorFormProfile').serialize(),
            success: function(response) {
                $('#successMsg').text(response.success).show();
                $('#visitorFormProfile')[0].reset();
                
                setTimeout(() => {
                    $('#successMsg').fadeOut();
                }, 3000);
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    for (let field in errors) {
                        $(`#error-${field}`).text(errors[field][0]);
                    }
                } else {
                    $('#successMsg').text("An error occurred. Please try again.").css('color', 'red').show();
                }
            }
        });
    }
</script>
@endsection