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
              </div>
            </div>
            <div class="col-lg-5 mt-4">
            @include('front.users.suggestions') 
            </div>
          </div>
        </div>
@endsection
@section('customJs')
@endsection