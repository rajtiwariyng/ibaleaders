@extends('front.layouts.app')
@section('content')

      <div class="container">
        @include('front.users.profile-top')
              <div class="mt-4">
                <h5 class="blue poppins-bold pb-2">Your Groups</h5>
                @forelse($events as $event) 
                <div class="whiteBox bg-white mb-3">
                  <div class="testimonialBox p-3">
                    <div class="top-info">
                      <div class="d-flex bg-blue info-contain">
                        <p class="text-white fs-7 mb-0">Topics: 211</p>
                        <p class="text-white fs-7 mb-0">Participants: 989</p>
                      </div>
                      
                    </div>
                    <div class="item">
                      <div class="d-flex align-items-center gap-3">
                        <div class="user-img pb-2">
                          <img src="{{ asset($event->imege) }}" alt="" class="rounded-circle m-auto">
                        </div>
                        <div>
                          <h6 class="blue mb-0">{{ $event->title }}</h6>
                          <p class="fs-7 pb-1">{{ $event->author }} | {{ $event->type }}</p>
                        </div>
                      </div>
                      <p class="fs-7 content">{{ $event->description }}</p>
                    </div>
                  </div>
                </div>
                @empty
					                <div>No Events found.</div>
					            @endforelse
                <div class="whiteBox bg-white mb-3">
                  <div class="testimonialBox p-3">
                    <div class="top-info">
                      <div class="d-flex bg-blue info-contain">
                        <p class="text-white fs-7 mb-0">Topics: 211</p>
                        <p class="text-white fs-7 mb-0">Participants: 989</p>
                      </div>
                      
                    </div>
                    <div class="item">
                      <div class="d-flex align-items-center gap-3">
                        <div class="user-img pb-2">
                          <img src="{{ asset('front-assets/images/jm_denis.jpg') }}" alt="" class="rounded-circle m-auto">
                        </div>
                        <div>
                          <h6 class="blue mb-0">Samuel paul</h6>
                          <p class="fs-7 pb-1">Interior Designer | Phillipines</p>
                        </div>
                      </div>
                      <p class="fs-7 content">BNI is more than just helping you grow your business – it is helping you build your network. You will gain colleagues, business partners, and friends who will become part of your newfound family. This positive and supportive group of people will help you go through any crisis because you can not do this alone.</p>
                    </div>
                  </div>
                </div>
                <div class="whiteBox bg-white mb-3">
                  <div class="testimonialBox p-3">
                    <div class="top-info">
                      <div class="d-flex bg-blue info-contain">
                        <p class="text-white fs-7 mb-0">Topics: 211</p>
                        <p class="text-white fs-7 mb-0">Participants: 989</p>
                      </div>
                      
                    </div>
                    <div class="item">
                      <div class="d-flex align-items-center gap-3">
                        <div class="user-img pb-2">
                          <img src="{{ asset('front-assets/images/jm_denis.jpg') }}" alt="" class="rounded-circle m-auto">
                        </div>
                        <div>
                          <h6 class="blue mb-0">Samuel paul</h6>
                          <p class="fs-7 pb-1">Interior Designer | Phillipines</p>
                        </div>
                      </div>
                      <p class="fs-7 content">BNI is more than just helping you grow your business – it is helping you build your network. You will gain colleagues, business partners, and friends who will become part of your newfound family. This positive and supportive group of people will help you go through any crisis because you can not do this alone.</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-12 form-btns py-3">
                  <button type="button" class="blue btn backBtn">View More</button>
                </div>
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
@endsection