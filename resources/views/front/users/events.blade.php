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
                      <?php 
                       $eventapplycount=count(countEventApplyUser($event->id));
                          $getapplystatus=checkEventApplyStatus($event->id);
                          ?>
                        <!-- <p class="text-white fs-7 mb-0">Topics: 211</p> -->
                        <p class="text-white fs-7 mb-0">Participants: {{$eventapplycount}}</p>
                        <?php 
                          
                          if(!$getapplystatus){?>
                        <p><a class="dropdown-item" href="#"  type="button" data-bs-toggle="modal" data-bs-target="#eventApplyModal"   data-toggle="modal" data-target="#eventApplyModal" data-message="Are you sure you want to apply event on - {{ date('d M Y', strtotime($event->start_date)) }}" data-action="{{ route('user.event.apply') }}" data-eventid="{{$event->id}}">Apply</a></p>
                        <?php } else { ?>
                          <p class="text-white fs-7 mb-0">Applied</p>
                          <?php } ?>
                      </div>
                      
                    </div>
                    <div class="item">
                      <div class="d-flex align-items-center gap-3">
                        <div class="user-img pb-2">
                        <img src="{{ $event->user->profile_image ? asset('storage/' . $event->user->profile_image) : asset('front-assets/images/profile2.jpg') }}" alt="{{ $event->user->name }}" 
                        class="rounded-circle m-auto">
                        </div>
                        <div>
                          <h6 class="blue mb-0">{{ $event->title }}</h6>
                          <p class="fs-7 pb-1">{{ $event->user->name }} | {{ $event->location }}</p>
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