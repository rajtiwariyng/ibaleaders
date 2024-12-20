@extends('front.layouts.app')
@section('content')

      <div class="container">
        @include('front.users.profile-top')
            <div class="mt-4">
                <h4 class="blue poppins-bold">Edit Bio</h4>
                <form action="{{ route('profile.update') }}" method="POST" class="pt-3 profile-form">
                  @csrf
                  @method('PUT')
                  <div class="row">
                      <!-- Years in Business -->
                      <div class="col-md-6">
                          <div class="mb-3">
                              <label for="years_in_business">Years in Business</label>
                              <input type="text" id="years_in_business" name="years_in_business" class="form-control" value="{{ old('years_in_business', auth()->user()->years_in_business) }}">
                          </div>
                      </div>

                      <!-- Previous Jobs -->
                      <div class="col-md-6">
                          <div class="mb-3">
                              <label for="previous_jobs">Previous Types of Jobs</label>
                              <input type="text" id="previous_jobs" name="previous_jobs" class="form-control" value="{{ old('previous_jobs', auth()->user()->previous_jobs) }}">
                          </div>
                      </div>

                      <!-- Spouse -->
                      <div class="col-md-6">
                          <div class="mb-3">
                              <label for="spouse">Spouse</label>
                              <input type="text" id="spouse" name="spouse" class="form-control" value="{{ old('spouse', auth()->user()->spouse) }}">
                          </div>
                      </div>

                      <!-- Children -->
                      <div class="col-md-6">
                          <div class="mb-3">
                              <label for="children">Children</label>
                              <input type="text" id="children" name="children" class="form-control" value="{{ old('children', auth()->user()->children) }}">
                          </div>
                      </div>

                      <!-- Hobbies and Interests -->
                      <div class="col-md-12">
                          <div class="mb-3">
                              <label for="hobbies">Hobbies and Interests</label>
                              <input type="text" id="hobbies" name="hobbies" class="form-control" value="{{ old('hobbies', auth()->user()->hobbies) }}">
                          </div>
                      </div>

                      <!-- Skills -->
                      <div class="col-md-12">
                          <div class="mb-3">
                              <label for="skills">Skills</label>
                              <input type="text" id="skills" name="skills" class="form-control" value="{{ old('skills', auth()->user()->skills) }}">
                          </div>
                      </div>

                      <!-- City of Residence -->
                      <div class="col-md-6">
                          <div class="mb-3">
                              <label for="city_residence">City of Residence</label>
                              <input type="text" id="city_residence" name="city_residence" class="form-control" value="{{ old('city_residence', auth()->user()->city_residence) }}">
                          </div>
                      </div>

                      <!-- Years in City -->
                      <div class="col-md-6">
                          <div class="mb-3">
                              <label for="years_in_city">Years in City</label>
                              <input type="text" id="years_in_city" name="years_in_city" class="form-control" value="{{ old('years_in_city', auth()->user()->years_in_city) }}">
                          </div>
                      </div>

                      <!-- Burning Desire -->
                      <div class="col-md-6">
                          <div class="mb-3">
                              <label for="burning_desire">Burning Desire</label>
                              <input type="text" id="burning_desire" name="burning_desire" class="form-control" value="{{ old('burning_desire', auth()->user()->burning_desire) }}">
                          </div>
                      </div>

                      <!-- Key to Success -->
                      <div class="col-md-6">
                          <div class="mb-3">
                              <label for="key_success">Key to Success</label>
                              <input type="text" id="key_success" name="key_success" class="form-control" value="{{ old('key_success', auth()->user()->key_success) }}">
                          </div>
                      </div>

                      <!-- GAINS Profile -->
                      <div class="col-md-6">
                          <div class="mb-3">
                              <label for="gains_profile">GAINS Profile</label>
                              <input type="text" id="gains_profile" name="gains_profile" class="form-control" value="{{ old('gains_profile', auth()->user()->gains_profile) }}">
                          </div>
                      </div>

                      <!-- Ambitions -->
                      <div class="col-md-6">
                          <div class="mb-3">
                              <label for="ambitions">Ambitions</label>
                              <input type="text" id="ambitions" name="ambitions" class="form-control" value="{{ old('ambitions', auth()->user()->ambitions) }}">
                          </div>
                      </div>

                      <!-- Achievements -->
                      <div class="col-md-6">
                          <div class="mb-3">
                              <label for="achievements">Achievements</label>
                              <input type="text" id="achievements" name="achievements" class="form-control" value="{{ old('achievements', auth()->user()->achievements) }}">
                          </div>
                      </div>

                      <!-- TOPS Profile -->
                      <div class="col-md-6">
                          <div class="mb-3">
                              <label for="tops_profile">TOPS Profile</label>
                              <input type="text" id="tops_profile" name="tops_profile" class="form-control" value="{{ old('tops_profile', auth()->user()->tops_profile) }}">
                          </div>
                      </div>

                      <!-- Ideal Referrals -->
                      <div class="col-md-6">
                          <div class="mb-3">
                              <label for="ideal_referrals">Ideal Referrals for me</label>
                              <input type="text" id="ideal_referrals" name="ideal_referrals" class="form-control" value="{{ old('ideal_referrals', auth()->user()->ideal_referrals) }}">
                          </div>
                      </div>

                      <!-- Best Selling Product -->
                      <div class="col-md-6">
                          <div class="mb-3">
                              <label for="best_product">Best Selling Product</label>
                              <input type="text" id="best_product" name="best_product" class="form-control" value="{{ old('best_product', auth()->user()->best_product) }}">
                          </div>
                      </div>

                      <!-- Networking Groups -->
                      <div class="col-md-12">
                          <div class="mb-3">
                              <label for="networking_groups">Networking Groups You're Part Of</label>
                              <input type="text" id="networking_groups" name="networking_groups" class="form-control" value="{{ old('networking_groups', auth()->user()->networking_groups) }}">
                          </div>
                      </div>

                      <div class="col-md-12 form-btns py-3">
                          <button type="submit" class="bg-blue text-white btn">Update</button>
                          <button type="button" class="blue btn backBtn">Back</button>
                      </div>
                  </div>
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