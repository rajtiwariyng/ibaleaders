@extends('front.layouts.app')
@section('content')

<div class="container">
        @include('front.users.profile-top')
        <div class="mt-4">
                <h4 class="blue poppins-bold">Add Testimonial</h4>
                <form id="testimonialFormProfile" method="POST">
                  @csrf
                 @method('POST')
                  

                  <div class="mb-3">
                      <label>Title</label>
                      <input type="text" name="testimonialtitle" id="testimonialtitle" class="form-control">
                      <div id="error-testimonialtitle" class="text-danger"></div>
                  </div>

                  <div class="mb-3">
                      <label>Author</label>
                      <input type="text" name="testimonialauthor" id="testimonialauthor" class="form-control" >
                      <div id="error-testimonialauthor" class="text-danger"></div>
                  </div>

                  <div class="mb-3">
                      <label>Type</label>
                      <input type="text" name="testimonialtype" id="testimonialtype" class="form-control" >
                      <div id="error-testimonialtype" class="text-danger"></div>
                  </div>
                 
                  <div class="mb-3">
                      <label>Description</label>
                      <textarea name="testimonialdescription" id="testimonialdescription" class="form-control" rows="3"></textarea>
                      <div id="error-testimonialdescription" class="text-danger"></div>
                  </div>
                  <div id="successMsgTestimonial" class="text-success mt-3" style="display: none;"></div>
                  <button type="button" onclick="testimonialSubmitForm()"  class="btn btn-primary">Add</button>
              </form>
              </div>
            </div>
            <div class="col-lg-5 mt-4">
              <div class="whiteBox bg-white p-3 mb-3">
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
    function testimonialSubmitForm() {
        // Clear previous error messages
        $('.text-danger').text('');
        var formData = new FormData(document.getElementById("testimonialFormProfile"));
        $.ajax({
            url: "{{ route('user.createtestimonialpost') }}",
            method: "POST",
            data: formData,
            async: true,
            processData: false,
            contentType: false,
            success: function(response) {
              console.log(response)
                

                $('#successMsgTestimonial').text(response.message).show();
                $('#testimonialFormProfile')[0].reset();
                
                setTimeout(() => {
                    $('#successMsgTestimonial').fadeOut();
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
                        $(`#error-${field}`).text(errors[field][0]);
                    }
                } else {
                    $('#successMsgTestimonial').text("An error occurred. Please try again.").css('color', 'red').show();
                }
            }
        });
    }
    function loadFileTestimonial(event) {
    console.log('File input changed');  // Debug: Check if this gets logged

    let file = testimonial.target.files[0];
    console.log('eati'); 
    console.log(file)
    console.log('Sinha'); 
    }
</script>
@endsection