@extends('front.layouts.app')
@section('content')

<div class="container">
        @include('front.users.profile-top')
        <div class="mt-4">
                <h4 class="blue poppins-bold">Add Event</h4>
                <form id="eventFormProfile" method="POST">
                  @csrf
                 @method('POST')
                  <!-- <div class="mb-3 profile-container">
                  <img id="eventImage" src="{{ asset('front-assets/images/profile.jpg') }}" 
                           alt="User Profile" class="profile-image-event">
                      <label for="fileUploadevent" class="camera-icon">
                          <i class="fa-solid fa-camera"></i>
                      </label>
                      <input type="file" name="eventimage" id="fileUploadevent" class="upload-input-event" accept="image/*" onchange="loadFileEvent(event)">
                      <div id="error-eventimage" class="text-danger"></div>
                  
                  </div> -->

                  <div class="mb-3">
                      <label>Title</label>
                      <input type="text" name="eventtitle" id="eventtitle" class="form-control">
                      <div id="error-eventtitle" class="text-danger"></div>
                  </div>

                  <div class="mb-3">
                      <label>Location</label>
                      <input type="text" name="eventlocation" id="eventlocation" class="form-control" >
                      <div id="error-eventlocation" class="text-danger"></div>
                  </div>
                  <div class="mb-3">
                      <label>Date</label>
                      <input type="datetime-local" name="eventdate" id="eventdate" class="form-control" >
                      <div id="error-eventdate" class="text-danger"></div>
                  </div>

                  <div class="mb-3">
                      <label>Type</label>
                      <input type="text" name="eventtype" id="eventtype" class="form-control" >
                      <div id="error-eventtype" class="text-danger"></div>
                  </div>
                 
                  <div class="mb-3">
                      <label>Description</label>
                      <textarea name="eventdescription" id="eventdescription" class="form-control" rows="3"></textarea>
                      <div id="error-eventdescription" class="text-danger"></div>
                  </div>
                  <div id="successMsgEvent" class="text-success mt-3" style="display: none;"></div>
                  <button type="button" onclick="eventSubmitForm()"  class="btn btn-primary">Add</button>
              </form>
              </div>
            </div>
            <div class="col-lg-5 mt-4">
            @include('front.users.suggestions') 
              
              </div>
            </div>
          </div>
        </div>
        @endsection
        
@section('customJs')
<script>
    function eventSubmitForm() {
        // Clear previous error messages
        $('.text-danger').text('');
        var formData = new FormData(document.getElementById("eventFormProfile"));
        $.ajax({
            url: "{{ route('user.createeventpost') }}",
            method: "POST",
            data: formData,
            async: true,
            processData: false,
            contentType: false,
            success: function(response) {
                

                $('#successMsgEvent').text(response.message).show();
                $('#eventFormProfile')[0].reset();
                setTimeout(function () {
                      window.location.href = "{{ route('user.events') }}"
			              }, 1000);
                
                setTimeout(() => {
                    $('#successMsgEvent').fadeOut();
                }, 3000);
            },
            error: function(xhr) {
                // console.log(xhr)
                // alert("test")
                // $('#successMsgEvent').text(xhr.responseJSON.message).css('color', 'red').show();
                if (xhr.responseJSON.errors) {
                    let errors = xhr.responseJSON.errors;
                    for (let field in errors) {
                        console.log(field)
                        $(`#error-${field}`).text(errors[field][0]);
                    }
                } else {
                    $('#successMsgEvent').text("An error occurred. Please try again.").css('color', 'red').show();
                   
                }
            }
        });
    }
    function loadFileEvent(event) {
    console.log('File input changed');  // Debug: Check if this gets logged

    let file = event.target.files[0];
    console.log('eati'); 
    console.log(file)
    console.log('Sinha'); 
    }
</script>
@endsection