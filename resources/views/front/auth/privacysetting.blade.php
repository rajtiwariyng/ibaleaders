@extends('front.layouts.app')
@section('content')

<div class="container">
        @include('front.users.profile-top')
        <div class="mt-4">
                <h4 class="blue poppins-bold">Privacy Setting</h4>
                <form action="" id="postFormPrivacySetting"  method="POST">
                  @csrf
                 @method('POST')
                  <div class="mb-3">
                      <label>Phone Number Show</label>
                      <input type="radio" class="form-control" value="1" id="phoneshow1" name="phoneshow" {{ (isset($privacysettings) && $privacysettings->phoneshow == 1) ? "checked" : "" }} >
                      <label for="phoneshow1">Yes</label>
                      <input type="radio" class="form-control" value="0" id="phoneshow2" name="phoneshow" {{ (isset($privacysettings) && $privacysettings->phoneshow == 0) ? "checked" : "" }}>
                      <label for="phoneshow2">No</label>
                  </div>
                  <div class="mb-3">
                      <label>Email Show</label>
                      <input type="radio" class="form-control" value="1" id="emailshow1" name="emailshow" {{ ($privacysettings?->emailshow == 1) ? "checked" : "" }}>
                      <label for="emailshow1">Yes</label>
                      <input type="radio" class="form-control" value="0" id="emailshow2" name="emailshow" {{ ($privacysettings?->emailshow == 0) ? "checked" : "" }}>
                      <label for="emailshow2">No</label>
                  </div>
                  <div class="mb-3">
                      <label>Allow Add Testimonial</label>
                      <input type="radio" class="form-control" value="1" id="addtestimonial1" name="addtestimonial" {{ ($privacysettings?->addtestimonial == 1) ? "checked" : "" }}>
                      <label for="addtestimonial1">Yes</label>
                      <input type="radio" class="form-control" value="0" id="addtestimonial2" name="addtestimonial" {{ ($privacysettings?->addtestimonial == 0) ? "checked" : "" }}>
                      <label for="addtestimonial2">No</label>
                  </div>
                  <div class="mb-3">
                      <label>Show Post</label>
                      <input type="radio" class="form-control" value="1" id="postshow1" name="postshow" {{($privacysettings?->postshow==1)?"checked":""}}>
                      <label for="postshow1">Yes</label>
                      <input type="radio" class="form-control" value="0" id="postshow2" name="postshow" {{($privacysettings?->postshow==0)?"checked":""}}>
                      <label for="postshow2">No</label>
                  </div>

                  <!-- <button type="submit" class="btn btn-primary">Save</button> -->
                  <div id="successMsgPost" class="text-success mt-3" style="display: none;"></div>
                  <button type="button" onclick="privacySettingSubmitForm()" class="btn btn-primary">Save</button>
              </form>
              </div>
            </div>
            <div class="col-lg-5 mt-4">
            @include('front.users.suggestions')
            </div>
          </div>
        </div>
        @endsection
        
@section('customJs')
<script>
   function privacySettingSubmitForm() {
        // Clear previous error messages
        $('.text-danger').text('');
        var formData = new FormData(document.getElementById("postFormPrivacySetting"));
        $.ajax({
            url: "{{ route('user.post.privacy.setting') }}",
            method: "POST",
            data: formData,
            async: true,
            processData: false,
            contentType: false,
            success: function(response) {              

                $('#successMsgPost').text(response.message).show();
                // $('#postFormPrivacySetting')[0].reset();
                
                // setTimeout(function () {
                //       window.location.href = "{{ route('user.profile') }}"
			          //     }, 1000);
                
                setTimeout(() => {
                    $('#successMsgPost').fadeOut();
                }, 3000);
            },
            error: function(xhr) {
                // console.log(xhr)
                // alert("test")
                // $('#successMsgPost').text(xhr.responseJSON.message).css('color', 'red').show();
                if (xhr.responseJSON.errors) {
                    let errors = xhr.responseJSON.errors;
                    for (let field in errors) {
                        console.log(field)
                        $(`#error-${field}`).text(errors[field][0]);
                    }
                } else {
                    $('#successMsgPost').text("An error occurred. Please try again.").css('color', 'red').show();
                }
            }
        });
    }
   
</script>
@endsection