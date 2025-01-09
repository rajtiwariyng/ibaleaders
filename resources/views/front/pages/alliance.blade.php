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
                        <th>Action</th>

                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($upcomingEvents as $event)
                          <tr>
                              <td>{{ $event->name }}</td>
                              <td>{{ $event->location }}</td>
                              <td> <?php 
                              $getapplystatus=checkEventApplyStatus($event->id);
                          
                          if(!$getapplystatus){?><a class="dropdown-item" href="#"  type="button" data-bs-toggle="modal" data-bs-target="#eventApplyModal"   data-toggle="modal" data-target="#eventApplyModal" data-message="Are you sure you want to apply event on - {{ date('d M Y', strtotime($event->start_date)) }}" data-action="{{ route('user.event.apply') }}" data-eventid="{{$event->id}}">Apply</a>
                          <?php } else { ?>
                          <p class="">Applied</p>
                          <?php } ?></td>
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
                    
<!-- Global Delete Confirmation Modal -->
<div class="modal fade" id="eventApplyModal" tabindex="-1" role="dialog" aria-labelledby="eventApplyModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventApplyModalLabel">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="eventApplyModalMessage">Are you sure you want to delete this item? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form id="eventApplyModalForm" method="POST">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="event_id" id="event_id" value="">
                    <button type="button" id="eventapplyid" onclick="eventApplyModalFun()" class="btn btn-danger">Apply</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('customJs')
<script src="https://apis.google.com/js/api.js"></script>
<script>
      document.addEventListener('DOMContentLoaded', function () {
        $('#eventApplyModal').on('show.bs.modal', function (event) {
          // alert("test")
            var button = $(event.relatedTarget); // Button that triggered the modal
            var action = button.data('action'); // Extract the action URL
            var message = button.data('message'); // Extract the custom message (optional)

            var eventid = button.data('eventid');

            // Update the form action in the modal
            var modal = $(this);
            // modal.find('#UserConnectionRemoveForm').attr('action', action);
            modal.find('#eventapplyid').attr('data-id', eventid);
            modal.find('#eventapplyid').attr('data-action', action);
            modal.find('#event_id').val(eventid);


            // Update the confirmation message if provided
            if (message) {
                modal.find('#eventApplyModalMessage').text(message);
            } else {
                modal.find('#eventApplyModalMessage').text('Are you sure you want to delete this item? This action cannot be undone.');
            }
        });
    });
    function eventApplyModalFun(){
      var actionroute=$('#eventapplyid').attr('data-action');
      $.ajax({
            url: actionroute,
            method: "POST",
            data: $('#eventApplyModalForm').serialize(),
            success: function(response) {
              console.log(response)
                $('#eventApplyModalMessage').text(response.message).show();
                gapiInit();
                // setTimeout(function () {
                //   location.reload();
			          //     }, 2000);
                // $('#visitorFormProfile')[0].reset();
                
                // setTimeout(() => {
                //     $('#successMsg').fadeOut();
                // }, 3000);
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    for (let field in errors) {
                        $(`#eventApplyModalMessage`).text(errors[field][0]);
                    }
                } else {
                    $('#eventApplyModalMessage').text("An error occurred. Please try again.").css('color', 'red').show();
                }
            }
        });
    }
    const CLIENT_ID = '573613589023-iored1s2vi3apkcqs0894c7u0g35itfr.apps.googleusercontent.com'; 
    // Replace with your client ID
        const API_KEY = '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'; // Replace with your API key
        const SCOPES = 'https://www.googleapis.com/auth/calendar.events';

        // Load the Google API client
        function gapiInit() {
            gapi.load('client:auth2', () => {
                gapi.client.init({
                    apiKey: API_KEY,
                    clientId: CLIENT_ID,
                    discoveryDocs: ['https://www.googleapis.com/discovery/v1/apis/calendar/v3/rest'],
                    scope: SCOPES,
                }).then(() => {
                    const authorizeButton = document.getElementById('authorize-button');
                    const addEventButton = document.getElementById('add-event-button');

                    authorizeButton.onclick = handleAuthClick;
                    addEventButton.onclick = addEvent;

                    // Check if already signed in
                    gapi.auth2.getAuthInstance().isSignedIn.listen(updateSigninStatus);
                    updateSigninStatus(gapi.auth2.getAuthInstance().isSignedIn.get());
                });
            });
        }

        // Update UI based on sign-in status
        function updateSigninStatus(isSignedIn) {
            if (isSignedIn) {
                document.getElementById('authorize-button').style.display = 'none';
                document.getElementById('add-event-button').style.display = 'block';
            } else {
                document.getElementById('authorize-button').style.display = 'block';
                document.getElementById('add-event-button').style.display = 'none';
            }
        }

        // Handle sign-in
        function handleAuthClick() {
            gapi.auth2.getAuthInstance().signIn();
        }

        // Add an event to the user's calendar
        function addEvent() {
            const event = {
                summary: 'Team Meeting',
                location: '123 Main St, City',
                description: 'Discussing the new project launch.',
                start: {
                    dateTime: '2025-01-08T10:00:00-07:00',
                    timeZone: 'America/Los_Angeles',
                },
                end: {
                    dateTime: '2025-01-08T11:00:00-07:00',
                    timeZone: 'America/Los_Angeles',
                },
                attendees: [
                    { email: 'eati.scitm@gmail.com' },
                    { email: 'rajtiwariyng@gmail.com' },
                ],
            };

            gapi.client.calendar.events.insert({
                calendarId: 'primary',
                resource: event,
            }).then((response) => {
                alert(`Event created: ${response.result.htmlLink}`);
            }).catch((error) => {
                console.error('Error creating event:', error);
            });
        }

        // Initialize the API client when the page loads
        
  </script>

@endsection