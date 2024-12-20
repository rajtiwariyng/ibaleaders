@extends('front.layouts.app')
@section('content')

<div class="container">
        @include('front.users.profile-top')
        <div class="mt-4">
                <h4 class="blue poppins-bold">Edit Profile</h4>
                <form action="{{ route('profile.update') }}" method="POST">
                  @csrf
                 @method('PUT')
                  <div class="mb-3">
                      <label>Name</label>
                      <input type="text" class="form-control" value="{{ $user->name }}" disabled>
                  </div>

                  <div class="mb-3">
                      <label>Email</label>
                      <input type="email" class="form-control" value="{{ $user->email }}" disabled>
                  </div>

                  <div class="mb-3">
                      <label>Industry</label>
                      <input type="text" name="industry" class="form-control" value="{{ old('industry', $user->industry) }}">
                  </div>

                  <div class="mb-3">
                      <label>Mobile Number</label>
                      <input type="text" name="mobile_number" class="form-control" value="{{ old('mobile_number', $user->mobile_number) }}">
                  </div>

                  <div class="mb-3">
                      <label>Address</label>
                      <input type="text" name="address" class="form-control" value="{{ old('address', $user->address) }}">
                  </div>

                  <div class="mb-3">
                      <label>City</label>
                      <input type="text" name="city" class="form-control" value="{{ old('city', $user->city) }}">
                  </div>

                  <div class="mb-3">
                      <label>State</label>
                      <input type="text" name="state" class="form-control" value="{{ old('state', $user->state) }}">
                  </div>

                  <div class="mb-3">
                      <label>Pin Code</label>
                      <input type="text" name="pin_code" class="form-control" value="{{ old('pin_code', $user->pin_code) }}">
                  </div>

                  <div class="mb-3">
                      <label>Brand Name</label>
                      <input type="text" name="brand_name" class="form-control" value="{{ old('brand_name', $user->brand_name) }}">
                  </div>

                  <div class="mb-3">
                      <label>Brand Logo</label>
                      <input type="text" name="brand_logo" class="form-control" value="{{ old('brand_logo', $user->brand_logo) }}">
                  </div>

                  <div class="mb-3">
                      <label>Business Bio</label>
                      <textarea name="business_bio" class="form-control" rows="3">{{ old('business_bio', $user->business_bio) }}</textarea>
                  </div>

                  <div class="mb-3">
                      <label>Keywords</label>
                      <textarea name="keywords" class="form-control" rows="3">{{ old('keywords', $user->keywords) }}</textarea>
                  </div>

                  <button type="submit" class="btn btn-primary">Update</button>
              </form>
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