@extends('front.layouts.app')
@section('content') 
      <div class="container">
        <div class="page-inner">
          <h5 class="blue poppins-bold pb-3">Alliance</h5>
          <div class="row">
            <div class="col-md-8 alliance">
              <div class="whiteBox bg-white p-3 mb-3">
                <div class="d-flex justify-content-between mb-4">
                  <h6 class="blue poppins-boldfs-6 mb-0 fw-600">Connections ({{count($connections)}})</h6>
                  <div class="d-flex align-items-center justify-content-end">
                    <div class="al-search d-flex justify-content-end">
                      <button class="border-0 bg-white">
                        <i class="fa-solid fa-magnifying-glass"></i>
                      </button>
                      <input type="text" placeholder="Search"></i>
                    </div>
                    <div class="dropdown ellipse-action ps-3">
                      <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa-solid fa-sliders"></i> Filters
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                      </div>
                    </div>
                  </div>
                </div>
                @forelse ($connections as $connection)
                <div class="mb-4">
                  <div class="notification-wrapper">
                    <div class="note-img"><img src="{{ $connection->profile_image ?? asset('front-assets/images/default.jpg') }}" alt="{{ $connection->name }}"></div>
                    <div class="note-content">
                      <p class="mb-0 fs-7" ><strong>{{ $connection->name }}</strong></p>
                      <p class="mb-0 fs-8" >{{ $connection->industry ?? 'N/A' }}</p>
                    </div>
                    <div class="connection-place">
                      <ul class="d-flex fs-8">
                        <li>{{$connection->state}}</li>
                        <li>></li>
                        <li>{{$connection->city}}</li>
                      </ul>
                    </div>
                    <a href='{{ URL::route("user.connection.userprofile", [base64_encode($connection->id)]) }}' class="trans-btn mx-4">
                      View Details
                    </a>
                    <!-- <div class="dropdown ellipse-action">
                      <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa-solid fa-ellipsis-vertical fs-6"></i>
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                      </div>
                    </div> -->
                  </div>
                </div>
                @empty
                <div></div>
                @endforelse
                
                <div>
                  <a href="{{ route('user.connections') }}" class="trans-btn">
                    Manage
                  </a>
                  <!-- <a href="" class="trans-btn ms-3">
                    Add Connections
                  </a> -->
                </div>
              </div>

              <div class="whiteBox bg-white p-3 mb-3">
            
                <div class="d-flex justify-content-between mb-4">
                  <h6 class="blue poppins-boldfs-6 mb-0 fw-600">Testimonials ({{count($testimonials)}})</h6>
                  <div class="d-flex align-items-center">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                      <li class="nav-item" role="presentation">
                        <button class="nav-link active trans-btn" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Given Testimonials</button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link  trans-btn" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Received Testimonials</button>
                      </li>
                    </ul> 
                  </div>
                </div>
                <div class="tab-content">
                  <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="testimonial-wrapper">
                    @forelse($testimonials as $testimonial) 
                    @if(auth()->user()->id!=$testimonial->received_to)
                      <div class="item text-center">
                        <div class="user-img pb-2">
                          <img src="{{ $testimonial->profile_image ? asset('storage/' . $testimonial->profile_image) : asset('front-assets/images/profile2.jpg') }}" alt="" class="rounded-circle m-auto">
                        </div>
                        <h6 class="blue mb-0">{{$testimonial->title}}</h6>
                        <p class="pb-1">{{$testimonial->type}} | {{$testimonial->name}}</p>
                        <p class="fs-7 content">{{$testimonial->description}}</p>
                      </div>
                      @endif
                      @empty
					                <div>No Events found.</div>
					            @endforelse
                      
                    </div>
                  </div>
                  <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="testimonial-wrapper">
                    @forelse($testimonials as $testimonial) 
                    @if(auth()->user()->id==$testimonial->received_to)
                      <div class="item text-center">
                        <div class="user-img pb-2">
                          <img src="{{ $testimonial->profile_image ? asset('storage/' . $testimonial->profile_image) : asset('front-assets/images/profile2.jpg') }}" alt="" class="rounded-circle m-auto">
                        </div>
                        <h6 class="blue mb-0">{{$testimonial->title}}</h6>
                        <p class="pb-1">{{$testimonial->type}} | {{$testimonial->name}}</p>
                        <p class="fs-7 content">{{$testimonial->description}}</p>
                      </div>
                      @endif
                      @empty
					                <div>No Events found.</div>
					            @endforelse
                      
                    </div>
                  </div>
                </div>
              </div>

              <div class="whiteBox bg-white p-3 mb-3">
                <div class="d-flex justify-content-between mb-4">
                  <h6 class="blue poppins-boldfs-6 mb-0 fw-600">Upcoming Events</h6>
                  <div class="d-flex align-items-center">
                    <div class="al-search d-flex justify-content-end w-100">
                      <!-- <button class="border-0 bg-white">
                        <i class="fa-solid fa-magnifying-glass"></i>
                      </button>
                      <input type="text" placeholder="Search"></i> -->
                    </div>
                  </div>
                </div>
                <div class="table-responsive event-table">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Event Name</th>
                        <!-- <th>Event Start Time</th> -->
                        <th>Event Location</th>

                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($upcomingEvents as $event)
                          <tr>
                              <td>{{ $event->name }}</td>
                              <td>{{ $event->location }}</td>
                          </tr>
                      @empty
                          <tr>
                              <td colspan="3">No upcoming events available.</td>
                          </tr>
                      @endforelse
                      <!-- <tr>
                        <td>BNI Connect: EXTRA Deep Dive for
                          Directors and Admins</td>
                        <td>27/12/2024</td>
                        <td>*GoToMeeting\GoToWebinar
                        </td>
                      </tr>
                      <tr>
                         <td>BNI Connect: EXTRA Deep Dive for
                          Directors and Admins</td>
                        <td>27/12/2024</td>
                        <td>*GoToMeeting\GoToWebinar
                        </td>
                      </tr>
                      <tr>
                         <td>BNI Connect: EXTRA Deep Dive for
                          Directors and Admins</td>
                        <td>27/12/2024</td>
                        <td>*GoToMeeting\GoToWebinar
                        </td>
                      </tr> -->
                    </tbody>
                  </table>
                </div>
                <a href="#" class="trans-btn">
                  More Events
                </a> 
              </div>
            </div>
            <div class="col-md-4">
              <div class="whiteBox bg-white p-3 mb-3">
                <h6 class="blue poppins-bold pb-3 fs-6 fw-600">Unread Messages(3)</h6>
                <div class="unread-messages mb-4 d-flex align-items-center justify-content-between">
                  <div class="pe-4">
                    <h6 class="mb-0 fs-7 fw-600"><a href="chats.html" class="light-grey">Join Group: Cctv And
                      Access Biometric</a></h6>
                      <p class="mb-0 fs-8">Jasbir Singh</p>
                      <p class="mb-0 fs-8 blue">23 Aug 2024</p>
                  </div>
                  <div class="envelop bg-blue text-white text-center">
                    <i class="fa-regular fa-envelope"></i>
                  </div>
                </div>
                <div class="unread-messages mb-4 d-flex align-items-center justify-content-between">
                  <div class="pe-4">
                    <h6 class="mb-0 fs-7 fw-600"><a href="chats.html" class="light-grey">Join Group: Cctv And
                      Access Biometric</a></h6>
                      <p class="mb-0 fs-8">Jasbir Singh</p>
                      <p class="mb-0 fs-8 blue">23 Aug 2024</p>
                  </div>
                  <div class="envelop bg-blue text-white text-center">
                    <i class="fa-regular fa-envelope"></i>
                  </div>
                </div>
                <div class="unread-messages mb-4 d-flex align-items-center justify-content-between">
                  <div class="pe-4">
                    <h6 class="mb-0 fs-7 fw-600"><a href="chats.html" class="light-grey">Join Group: Cctv And
                      Access Biometric</a></h6>
                      <p class="mb-0 fs-8">Jasbir Singh</p>
                      <p class="mb-0 fs-8 blue">23 Aug 2024</p>
                  </div>
                  <div class="envelop bg-blue text-white text-center">
                    <i class="fa-regular fa-envelope"></i>
                  </div>
                </div>
                <a href="#" class="trans-btn">
                  View Messages
                </a>             
              </div>

              <!-- <div class="whiteBox bg-white p-3 mb-3">
                <h6 class="blue poppins-bold fs-6 fw-600">Documents(0)</h6>
                <div class="pb-4">
                  <p class="fs-7">There are no Documents</p>
                </div>
                <a href="#" class="trans-btn">
                  View Messages
                </a>
              </div> -->
              <div class="whiteBox bg-white p-3 mb-3">
                <h6 class="blue poppins-bold fs-6 fw-600">Groups(1)</h6>
                <div class="pb-4">
                  <h6 class="mb-0 fs-7 fw-600"><a href="#" class="light-grey">Architecture, interior and Real Estate</a></h6>
                    <p class="mb-0 fs-8">149 Topic, Participants</p>
                </div>
                <a href="#" class="trans-btn">
                  View All Groups
                </a>
              </div>
            </div>
          </div>
        </div>

@endsection

@section('customJs')
@endsection