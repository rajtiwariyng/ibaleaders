@extends('front.layouts.app')
@section('content')
<div class="container">
        @include('front.users.profile-top')

              <div class="mt-4">
                @if($privacysettings && $privacysettings->postshow==1)
              @forelse($posts as $post) 
              <div class="whiteBox bg-white p-4 mt-4">
            <div class="d-flex mb-3">
              <div class="d-flex align-items-center">
                <div class="pe-3">
                  <img src="{{ $post->byuser->profile_image ? asset('storage/' . $post->byuser->profile_image) : asset('front-assets/images/profile2.jpg') }}" alt="{{ $post->name }}">
                </div>
                <div>
                  <p class="mb-0"><strong>{{ $post->byuser->name }}</strong></p>
                  <p class="mb-0">{{ \Carbon\Carbon::parse($post->created_at)->format('d M Y') }}</p>
                </div>
              </div>
            </div>
            <p>{{ $post->description }}</p>
            <div>
              @if($post->image)
              <img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->name }}">
              @endif
            </div>
            <div class="reactions d-flex align-items-center justify-content-between pt-3">
              <a class="d-flex align-items-center text-color">
                <img src="{{ asset('front-assets/icons/React.png') }}" alt="" class="pe-2">
                React {{$post->reactcount}}
              </a>
              <div id="postreactionmsg{{$post->id}}"></div>
              <span onclick="postReactFun('{{$post->id}}','like')" style="cursor: pointer;"><i class="fa fa-thumbs-up" aria-hidden="true"></i></span>
              <span onclick="postReactFun('{{$post->id}}','dislike')" style="cursor: pointer;"><i class="fa fa-thumbs-down" aria-hidden="true"></i></span>
              <span onclick="postReactFun('{{$post->id}}','heart')" style="cursor: pointer;"><i class="fa fa-heart" aria-hidden="true"></i></span>
              <span onclick="postReactFun('{{$post->id}}','smile')" style="cursor: pointer;"><i class="fa fa-smile-o" aria-hidden="true"></i></span>
              <span onclick="postReactFun('{{$post->id}}','smileheart')" style="cursor: pointer;"><i class="fa fa-heartbeat" aria-hidden="true"></i></span>
              <!-- <a class="d-flex align-items-center text-color">
                <img src="{{ asset('front-assets/icons/Comment.png') }}" alt="" class="pe-2">
                Comment
              </a>
              <a class="d-flex align-items-center text-color">
                <img src="{{ asset('front-assets/icons/Share.png') }}" alt="" class="pe-2">
                Share
              </a> -->
            </div>
          </div>  
           
                @empty
					                <div>No post found.</div>
					            @endforelse
                      @endif
                <!-- <div class="whiteBox bg-white p-4 mt-4">
                  <div class="d-flex mb-3">
                    <div class="d-flex align-items-center">
                      <div class="pe-3">
                        <img src="{{ asset('front-assets/icons/in.png') }}" alt="" class="linkdinImage">
                      </div>
                      <div>
                        <p class="mb-0"><strong>Linkedin</strong></p>
                        <p class="mb-0">Promoted</p>
                      </div>
                    </div>
                  </div>
                  <p>Update you job preferences to help recruiters find you for the right oppurtunities. </p>
                  <div>
                    <img src="{{ asset('front-assets/images/linkedin-banner.png') }}" alt="">
                  </div>
                  <div class="reactions d-flex align-items-center justify-content-between pt-3">
                    <a class="d-flex align-items-center text-color">
                      <img src="{{ asset('front-assets/icons/React.png') }}" alt="" class="pe-2">
                      React
                    </a>
                    <a class="d-flex align-items-center text-color">
                      <img src="{{ asset('front-assets/icons/Comment.png') }}" alt="" class="pe-2">
                      Comment
                    </a>
                    <a class="d-flex align-items-center text-color">
                      <img src="{{ asset('front-assets/icons/Share.png') }}" alt="" class="pe-2">
                      Share
                    </a>
                  </div>
                </div>  -->
                
              </div>
            </div>
            <div class="col-lg-5 mt-4">
              <div class="whiteBox bg-white p-3 mb-3">
                <h5 class="blue poppins-bold mb-0 fs-6">Visitor Registration</h5>
                <form id="visitorFormProfile" class="vrForm pt-4">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <input type="text" name="first_name" class="form-control" placeholder="First Name" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="text" name="mobile_number" class="form-control" placeholder="Mobile Number" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="text" name="company_name" class="form-control" placeholder="Company Name">
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="text" name="city" class="form-control" placeholder="City">
                        </div>
                        <div class="col-md-12 form-group">
                            <textarea name="address" rows="4" cols="2" class="form-control" placeholder="Address"></textarea>
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="text" name="state_country_province" class="form-control" placeholder="State/Country/Province">
                            <input type="text" name="post_code" class="form-control" placeholder="Post Code">
                        </div>
                    </div>
                    <div class="text-center sbmtBtn">
                        <button type="button" onclick="visitorSubmitForm()" class="btn btn-primary">
                                Submit
                            </button>
                    </div>
                    <div id="successMsg" class="text-success mt-3" style="display: none;"></div>
                </form>


              </div>
            </div>
          </div>
        </div>

                
<!-- Global Delete Confirmation Modal -->
<div class="modal fade" id="UserConnectionRemoveModal" tabindex="-1" role="dialog" aria-labelledby="UserConnectionRemoveModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="UserConnectionRemoveModalLabel">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="UserConnectionRemoveModalMessage">Are you sure you want to delete this item? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form id="UserConnectionRemoveForm" method="POST">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="user_id" value="{{$user->id}}">
                    <button type="button" id="userconnectionid" onclick="UserConnectionRemoveFun()" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

        @endsection

@section('customJs')
<script>
    function visitorSubmitForm() {
        // Clear previous error messages
        $('.text-danger').text('');
        
        $.ajax({
            url: "{{ route('visitor.register') }}",
            method: "POST",
            data: $('#visitorFormProfile').serialize(),
            success: function(response) {
                $('#successMsg').text(response.success).show();
                $('#visitorFormProfile')[0].reset();
                
                setTimeout(() => {
                    $('#successMsg').fadeOut();
                }, 3000);
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    for (let field in errors) {
                        $(`#error-${field}`).text(errors[field][0]);
                    }
                } else {
                    $('#successMsg').text("An error occurred. Please try again.").css('color', 'red').show();
                }
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        $('#UserConnectionRemoveModal').on('show.bs.modal', function (event) {
          // alert("test")
            var button = $(event.relatedTarget); // Button that triggered the modal
            var action = button.data('action'); // Extract the action URL
            var message = button.data('message'); // Extract the custom message (optional)

            var userid = button.data('userid');

            // Update the form action in the modal
            var modal = $(this);
            // modal.find('#UserConnectionRemoveForm').attr('action', action);
            modal.find('#userconnectionid').attr('data-id', userid);
            modal.find('#userconnectionid').attr('data-action', action);


            // Update the confirmation message if provided
            if (message) {
                modal.find('#UserConnectionRemoveModalMessage').text(message);
            } else {
                modal.find('#UserConnectionRemoveModalMessage').text('Are you sure you want to delete this item? This action cannot be undone.');
            }
        });
    });
    function UserConnectionRemoveFun(){
      var actionroute=$('#userconnectionid').attr('data-action');
      $.ajax({
            url: actionroute,
            method: "POST",
            data: $('#UserConnectionRemoveForm').serialize(),
            success: function(response) {
              console.log(response)
                $('#UserConnectionRemoveModalMessage').text(response.message).show();
                setTimeout(function () {
                  location.reload();
			              }, 2000);
                // $('#visitorFormProfile')[0].reset();
                
                // setTimeout(() => {
                //     $('#successMsg').fadeOut();
                // }, 3000);
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    for (let field in errors) {
                        $(`#error-${field}`).text(errors[field][0]);
                    }
                } else {
                    $('#successMsg').text("An error occurred. Please try again.").css('color', 'red').show();
                }
            }
        });
    }
    function postReactFun(postid,type){
      console.log(' postid '+postid+' type '+type)
      $.ajax({
                url: "{{ route('user.post.react') }}",
                method: "GET",
                data: { postid: postid,type:type },
                success: function(response) {

                    $("#postreactionmsg"+postid).html(response.message)
                }
            });
    }
    </script>
@endsection