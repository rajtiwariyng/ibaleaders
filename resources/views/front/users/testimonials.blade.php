@extends('front.layouts.app')
@section('content')

      <div class="container">
        @include('front.users.profile-top')

              <div class="mt-4">
                <h5 class="blue poppins-bold pb-2">Testimonials</h5>
                @forelse($testimonials as $testimonial) 
                <div class="whiteBox bg-white mb-3">
                  <div class="testimonialBox p-3">
                    <p class="text-end fs-7">{{(auth()->user()->id==$testimonial->received_to) ? 'Received Testimonials':'Given Testimonials'}}</p>
                    <div class="item">
                      <div class="d-flex align-items-center gap-3">
                        <div class="user-img pb-2">
                          <img src="{{ $testimonial->profile_image ? asset('storage/' . $testimonial->profile_image) : asset('front-assets/images/profile2.jpg') }}" alt="" class="rounded-circle m-auto">
                        </div>
                        <div>
                          <h6 class="blue mb-0">{{$testimonial->title}}</h6>
                          <p class="fs-7 pb-1">{{$testimonial->type}} | {{$testimonial->name}}</p>
                        </div>
                      </div>
                      <p class="fs-7 content">{{$testimonial->description}}</p>
                    </div>
                  </div>
                </div>
                @empty
					                <div>No Events found.</div>
					            @endforelse
                
                
                <div class="col-md-12 form-btns py-3">
                  <!-- <button type="button" class="blue btn backBtn">View More</button> -->
                </div>
              </div>
            </div>
           
            <div class="col-lg-5 mt-4">
            @include('front.users.suggestions') 
              <div class="whiteBox bg-white p-3 mb-3 d-none">
                <div class="d-flex justify-content-between mb-4">
                  <h5 class="blue poppins-bold mb-0 fs-6">Upcoming Events</h5>
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
                  <div class="note-content">
                    <h6 class="mb-0 fs-7 fw-600"><a href="#" class="light-grey">BNI Connect: Extra Deep Dive for Directors and Admins</a></h6>
                    <p class="mb-0 fs-8">27/12/2024</p>
                  </div>
                  <div class="sr-btn">
                    <button class="bg-blue btn text-white fs-8" type="button">View Details</button>
                  </div>
                </div>
                <div class="notification-wrapper mb-4">
                  <div class="note-content">
                    <h6 class="mb-0 fs-7 fw-600"><a href="#" class="light-grey">BNI Connect: Extra Deep Dive for Directors and Admins</a></h6>
                    <p class="mb-0 fs-8">27/12/2024</p>
                  </div>
                  <div class="sr-btn">
                    <button class="bg-blue btn text-white fs-8" type="button">View Details</button>
                  </div>
                </div>
                <div class="notification-wrapper mb-4">
                  <div class="note-content">
                    <h6 class="mb-0 fs-7 fw-600"><a href="#" class="light-grey">BNI Connect: Extra Deep Dive for Directors and Admins</a></h6>
                    <p class="mb-0 fs-8">27/12/2024</p>
                  </div>
                  <div class="sr-btn">
                    <button class="bg-blue btn text-white fs-8" type="button">View Details</button>
                  </div>
                </div>
                <div class="notification-wrapper mb-4">
                  <div class="note-content">
                    <h6 class="mb-0 fs-7 fw-600"><a href="#" class="light-grey">BNI Connect: Extra Deep Dive for Directors and Admins</a></h6>
                    <p class="mb-0 fs-8">27/12/2024</p>
                  </div>
                  <div class="sr-btn">
                    <button class="bg-blue btn text-white fs-8" type="button">View Details</button>
                  </div>
                </div>
                <div class="notification-wrapper mb-4">
                  <div class="note-content">
                    <h6 class="mb-0 fs-7 fw-600"><a href="#" class="light-grey">BNI Connect: Extra Deep Dive for Directors and Admins</a></h6>
                    <p class="mb-0 fs-8">27/12/2024</p>
                  </div>
                  <div class="sr-btn">
                    <button class="bg-blue btn text-white fs-8" type="button">View Details</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection
@section('customJs')
@endsection