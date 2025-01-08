<div class="page-inner p-0 bio-page">
   @include('front.layouts.message')
  <div class="cover-pic">
    <a href="{{ route('user.profile') }}"><img src="{{ asset('front-assets/images/about-banner.jpg') }}" alt="" class="w-100"></a>
  </div>
</div>
<div class="bg-white">
  <div class="container">
    <div class="row">
      <div class="col-xl-2">
        <div class="user-profile-header">
          <div class="p-1 bg-white">
            <a href="{{ route('user.profile') }}"><img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('front-assets/images/profile2.jpg') }}" alt=""></a>
          </div>
        </div>
      </div>
      <div class="col-xl-10">
        <nav class="bio-menu">
          <div class="toggle"><i class="fa-solid fa-bars"></i></div>
          <div class="user-menu">
            <ul class="d-flex flex-lg-row bg-white justify-content-end p-3">
              <li class="{{ request()->routeIs('user.profiledetails') ? 'active' : '' }}">
                <a href="{{ route('user.profiledetails') }}">Personal Details</a>
              </li>
              <li class="{{ request()->routeIs('user.editbio') ? 'active' : '' }}">
                <a href="{{ route('user.editbio') }}">Bio</a>
              </li>
              <li class="{{ request()->routeIs('user.connections') ? 'active' : '' }}">
                <a href="{{ route('user.connections') }}">Connections</a>
              </li>
              <li class="{{ request()->routeIs('user.testimonials') ? 'active' : '' }}">
                <a href="{{ route('user.testimonials') }}">Testimonials</a>
              </li>
              <li class="{{ request()->routeIs('user.groupsjoined') ? 'active' : '' }}">
                <a href="{{ route('user.groupsjoined') }}">Groups joined</a>
              </li>
              <li class="{{ request()->routeIs('user.events') ? 'active' : '' }}">
                <a href="{{ route('user.events') }}">Events attended</a>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </div>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-lg-7">

      
       @if(Route::currentRouteName() === 'user.connection.userprofile')
      <!-- Content for Profile Pages -->
      <div class="userStoryBox d-flex flex-column">
        <div class="userStoryBoxHeader">
          <h6 class="blue poppins-semibold">{{ $user->name }}</h6>
          <p class="mb-0 fs-8">{{ old('industry', $user->industry) }}</p>
          <div class="d-flex align-items-center profile-btns">
            <?php 
            $getstatus=checkUserConnectionStatus($user->id);
            ?>
            @if($getstatus)
            @if($getstatus->status=='approved')
            <button class="bg-blue text-white border-0 px-3 py-2 fs-8">Connected</button>
            <button class="blue btn fs-8">Message</button>
            <div class="dropdown morebtn">
              <button class="btn btn-icon btn-clean me-0 fs-8" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                More
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                <a class="dropdown-item" href="#">Send profile in a message</a>
                <a class="dropdown-item" href="#" type="button" data-bs-toggle="modal" data-bs-target="#UserConnectionRemoveModal"   data-toggle="modal" data-target="#UserConnectionRemoveModal" data-message="Are you sure you want to remove connection user - {{ $user->name }}?" data-action="{{ route('user.connection.remove') }}" data-userid="{{$user->id}}">Remove Connection</a>
                <a class="dropdown-item" href="#"  type="button" data-bs-toggle="modal" data-bs-target="#UserConnectionRemoveModal"   data-toggle="modal" data-target="#UserConnectionRemoveModal" data-message="Are you sure you want to block connection user - {{ $user->name }}?" data-action="{{ route('user.connection.block') }}" data-userid="{{$user->id}}">Report/Block</a>
                <a href='{{ URL::route("user.createtestimonial", [base64_encode($customer)]) }}' class="grey dropdown-item">Testimonial</a>              
              </div>
            </div>
            @endif
            @else
            <div class="sr-btn">
                        <form action="{{ route('user.sendConnection') }}" method="POST">
                            @csrf
                            <input type="hidden" name="receiver_id" value="{{ $user->id }}">
                            <button class="bg-blue btn text-white fs-8" type="submit">Send Request</button>
                        </form>
                    </div>
            @endif
          </div>
        </div>
      </div>
      @else
      
      <!-- Content for the other Page -->
      <div class="userStoryBox d-flex flex-column">
        <!-- <div class="d-flex">
          <div class="userStoryImg">
            <a href="{{ route('user.profile') }}"><img src="{{ auth()->user()->profile_image ? asset('storage/' . auth()->user()->profile_image) : asset('front-assets/images/profile2.jpg') }}" alt="" class="rounded-circle"></a>
          </div>
          <div class="userStoryShare d-flex">
            <input type="text" placeholder="Share Your Success Story" class="bg-white border-0 form-control">
            <button type="button" class="bg-blue text-white share-btn border-0">Share</button>
          </div>
        </div> -->
        <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-4 mt-4 fs-8">
          <li class="list-inline-item">
            
          <a href="{{ route('user.createpost') }}"><i class="fa-regular fa-image"></i> <span class="fw-medium">Photo   </span></a>
          </li>
          
          <li class="list-inline-item">
            <a href="{{ route('front.chats') }}" ><i class="fa-solid fa-people-group"></i> <span class="fw-medium">Create Group</span></a>
          </li>
          
          <li class="list-inline-item">
          <a href="{{ route('user.createevent') }}"><i class="fa-solid fa-calendar-week"></i> <span class="fw-medium">Create Event</span></a>
          </li>
          
          
        </ul>
      </div>
      @endif
