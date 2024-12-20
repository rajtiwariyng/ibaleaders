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
                    
                  </div>
                  <form id="resetFormProfile" method="POST">
                  @csrf
                  <div class="form-group mb-3">
                      <label for="email" class="blue pb-1">Enter Current Password*</label>
                      <input type="text" placeholder="New Password" class="form-control" name="current_password" id="current_password" >
                      <div id="error-current_password" class="text-danger"></div>
                    </div>
                    <div class="form-group mb-3">
                      <label for="email" class="blue pb-1">Enter New Password*</label>
                      <input type="text" placeholder="New Password" class="form-control" name="newpassword" id="newpassword" >
                      <div id="error-newpassword" class="text-danger"></div>
                    </div>
                    <div class="form-group">
                      <label for="email" class="blue pb-1">Re-enter New Password*</label>
                      <input type="text" placeholder="New Password" class="form-control" name="renewpassword" id="renewpassword" >
                      <div id="error-renewpassword" class="text-danger"></div>
                    </div>
                    <div class=" sbmtBtn w-auto mt-3">
                      <!-- <a href="login.html" class="white"> -->
                        <div class="cornerbox mt-2">
                          <div class="bg"></div>
                          <!-- <p class="mb-0">Submit</p> -->
                          <button type="button" onclick="resetSubmitForm()"  class="btn btn-primary">Submit</button>
                        </div>
                      <!-- </a> -->
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
<script>
    function resetSubmitForm() {
        // Clear previous error messages
        $('.text-danger').text('');
        var formData = new FormData(document.getElementById("resetFormProfile"));
        $.ajax({
            url: "{{ route('front.resetpasswordpost') }}",
            method: "POST",
            data: formData,
            async: true,
            processData: false,
            contentType: false,
            success: function(response) {
              console.log(response)
                

                $('#successMsgReset').text(response.message).show();
                $('#resetFormProfile')[0].reset();
                setTimeout(function () {
                      window.location.href = "{{ route('user.testimonials') }}"
			              }, 1000);
                
                setTimeout(() => {
                    $('#successMsgReset').fadeOut();
                }, 3000);
            },
            error: function(xhr) {
                // console.log(xhr)
                // alert("test")
                // $('#successMsgTestimonial').text(xhr.responseJSON.message).css('color', 'red').show();
                if (xhr.responseJSON.errors) {
                    let errors = xhr.responseJSON.errors;
                    for (let field in errors) {
                        console.log(field)
                        // console.log(errors)
                        if(field=='current_password_match'){
                          $(`#error-current_password`).text(errors[field]);
                        } else {
                          $(`#error-${field}`).text(errors[field][0]);

                        }

                        
                    }
                } else {
                    $('#successMsgReset').text("An error occurred. Please try again.").css('color', 'red').show();
                    
                }
            }
        });
    }
   
</script>
@endsection