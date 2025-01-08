@extends('front.layouts.app')
@section('content')

<div class="container">
        @include('front.users.profile-top')
        <div class="mt-4">
                <h4 class="blue poppins-bold">Create Post</h4>
                <form id="postFormProfile" method="POST">
                  @csrf
                 @method('POST')
                  <div class="mb-3 profile-container">
                  <img id="postImage" src="{{ asset('front-assets/images/profile.jpg') }}" 
                           alt="User Profile" class="profile-image-post">
                      <label for="fileUploadpost" class="camera-icon">
                          <i class="fa-solid fa-camera"></i>
                      </label>
                      <input type="file" name="postimage" id="fileUploadpost" class="upload-input-post" accept="image/*" onchange="loadFilePost(event)">
                      <div id="error-postimage" class="text-danger"></div>
                  
                  </div>

                  <div class="mb-3">
                      <label>Title</label>
                      <input type="text" name="posttitle" id="posttitle" class="form-control">
                      <div id="error-posttitle" class="text-danger"></div>
                  </div>
                 
                  <div class="mb-3">
                      <label>Description</label>
                      <textarea name="postdescription" id="postdescription" class="form-control" rows="3"></textarea>
                      <div id="error-postdescription" class="text-danger"></div>
                  </div>
                  <div id="successMsgPost" class="text-success mt-3" style="display: none;"></div>
                  <button type="button" onclick="postSubmitForm()"  class="btn btn-primary">Post</button>
              </form>
              </div>
            </div>
            <div class="col-lg-5 mt-4">
            @include('front.users.suggestions')
              <div class="whiteBox bg-white p-3 mb-3 d-none">
                <div class="d-flex justify-content-between mb-4">
                  <h5 class="blue poppins-bold mb-0 fs-6">Suggestions</h5>
                  <div class="d-flex align-items-center siderbar-search">
                    <div class="al-search d-flex justify-content-end w-100">
                      <button class="border-0 bg-white">
                        <i class="fa-solid fa-magnifying-glass"></i>
                      </button>
                      <input type="text" placeholder="Search">
                    </div>
                  </div>
                </div>
                
                <div class="notification-wrapper mb-4 d-none">
                  <div class="note-img">
                    <img src="{{ asset('front-assets/images/jm_denis.jpg') }}" alt="">
                  </div>
                  <div class="note-content">
                    <p class="mb-0 fs-7" ><a href="#" class="grey"><strong>Aashna Sabharwal</strong></a></p>
                    <p class="mb-0 fs-8" >Health & Wellness, Nutritionist</p>
                  </div>
                  <div class="sr-btn">
                    <button class="bg-blue btn text-white fs-8" type="button">View Group</button>
                  </div>
                </div>
                <div class="notification-wrapper mb-4">
                  <div class="note-img">
                    <img src="{{ asset('front-assets/images/jm_denis.jpg') }}" alt="">
                  </div>
                  <div class="note-content">
                    <p class="mb-0 fs-7" ><a href="#" class="grey"><strong>Aashna Sabharwal</strong></a></p>
                    <p class="mb-0 fs-8" >Health & Wellness, Nutritionist</p>
                  </div>
                  <div class="sr-btn">
                    <button class="bg-blue btn text-white fs-8" type="button">View Group</button>
                  </div>
                </div>
                <div class="notification-wrapper mb-4">
                  <div class="note-img">
                    <img src="{{ asset('front-assets/images/jm_denis.jpg') }}" alt="">
                  </div>
                  <div class="note-content">
                    <p class="mb-0 fs-7" ><a href="#" class="grey"><strong>Aashna Sabharwal</strong></a></p>
                    <p class="mb-0 fs-8" >Health & Wellness, Nutritionist</p>
                  </div>
                  <div class="sr-btn">
                    <button class="bg-blue btn text-white fs-8" type="button">View Group</button>
                  </div>
                </div>
                <div class="notification-wrapper mb-4">
                  <div class="note-img">
                    <img src="{{ asset('front-assets/images/jm_denis.jpg') }}" alt="">
                  </div>
                  <div class="note-content">
                    <p class="mb-0 fs-7" ><a href="#" class="grey"><strong>Aashna Sabharwal</strong></a></p>
                    <p class="mb-0 fs-8" >Health & Wellness, Nutritionist</p>
                  </div>
                  <div class="sr-btn">
                    <button class="bg-blue btn text-white fs-8" type="button">View Group</button>
                  </div>
                </div>
                <div class="notification-wrapper mb-4">
                  <div class="note-img">
                    <img src="{{ asset('front-assets/images/jm_denis.jpg') }}" alt="">
                  </div>
                  <div class="note-content">
                    <p class="mb-0 fs-7" ><a href="#" class="grey"><strong>Aashna Sabharwal</strong></a></p>
                    <p class="mb-0 fs-8" >Health & Wellness, Nutritionist</p>
                  </div>
                  <div class="sr-btn">
                    <button class="bg-blue btn text-white fs-8" type="button">View Group</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endsection
        
@section('customJs')
<script>
    function postSubmitForm() {
        // Clear previous error messages
        $('.text-danger').text('');
        var formData = new FormData(document.getElementById("postFormProfile"));
        $.ajax({
            url: "{{ route('user.createpostpost') }}",
            method: "POST",
            data: formData,
            async: true,
            processData: false,
            contentType: false,
            success: function(response) {
                

                $('#successMsgPost').text(response.message).show();
                $('#postFormProfile')[0].reset();
                
                setTimeout(function () {
                      window.location.href = "{{ route('user.profile') }}"
			              }, 1000);
                
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
    function loadFilePost(event) {
    console.log('File input changed');  // Debug: Check if this gets logged

    let file = event.target.files[0];
    console.log('eati'); 
    console.log(file)
    console.log('Sinha'); 
    }
</script>
@endsection