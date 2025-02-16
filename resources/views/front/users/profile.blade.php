@extends('front.layouts.app')
@section('content')
<div class="container">
        @include('front.users.profile-top')
              <div class="mt-5">
              @forelse($posts as $post) 
                <div class="whiteBox bg-white p-4 mt-4">
                  <div class="d-flex mb-3">
                    <div class="d-flex align-items-center">
                      <div class="pe-3">
                        <img src="{{ $post->profile_image ? asset('storage/' . $post->profile_image) : asset('front-assets/images/profile2.jpg') }}" alt="{{ $post->title }}" class="linkdinImage">
                      </div>
                      <div>
                        <p class="mb-0"><strong>{{ $post->name }}</strong></p>
                        <p class="mb-0"><?php echo date("d M Y", strtotime($post->created_at));?></p>
                      </div>
                    </div>
                  </div>
                  <p>{{ $post->description }}</p>
                  <div class="home-post-img">
                  @if($post->image)
                    <img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->name }}">
                    @endif
                  </div>
                  <div class="reactions d-flex align-items-center justify-content-between pt-3">
                    <div class="d-flex align-items-center text-color">
                      <!-- <img src="{{ asset('front-assets/icons/React.png') }}" alt="Reaction" class="pe-2">
                      React -->
                       {{$post->reactcount}}
                       <div class="emoji-hover">
                    <div class="emoji-container">
                      <picture onclick="postReactFun('{{$post->id}}','smile')">
                        <source srcset="https://fonts.gstatic.com/s/e/notoemoji/latest/1f603/512.webp" type="image/webp">
                        <img src="https://fonts.gstatic.com/s/e/notoemoji/latest/1f603/512.gif" alt="😃" width="40" height="32">
                      </picture>
                      <picture onclick="postReactFun('{{$post->id}}','smileheart')" >
                        <source srcset="https://fonts.gstatic.com/s/e/notoemoji/latest/1f60d/512.webp" type="image/webp">
                        <img src="https://fonts.gstatic.com/s/e/notoemoji/latest/1f60d/512.gif" alt="😍" width="40" height="40">
                      </picture>
                      <picture onclick="postReactFun('{{$post->id}}','heart')">
                        <source srcset="https://fonts.gstatic.com/s/e/notoemoji/latest/2764/512.webp" type="image/webp">
                        <img src="https://fonts.gstatic.com/s/e/notoemoji/latest/2764/512.gif" alt="❤️" width="40" height="40">
                      </picture>
                      <picture onclick="postReactFun('{{$post->id}}','like')">
                        <source srcset="https://fonts.gstatic.com/s/e/notoemoji/latest/1f44d/512.webp" type="image/webp">
                        <img src="https://fonts.gstatic.com/s/e/notoemoji/latest/1f44d/512.gif" alt="👍" width="40" height="64">
                      </picture>
                      <picture onclick="postReactFun('{{$post->id}}','dislike')">
                        <source srcset="https://fonts.gstatic.com/s/e/notoemoji/latest/1f44e/512.webp" type="image/webp">
                        <img src="https://fonts.gstatic.com/s/e/notoemoji/latest/1f44e/512.gif" alt="👎" width="40" height="40">
                      </picture>
                      <div id="postreactionmsg{{$post->id}}"></div>
                    </div>
                    
                  </div>
</div>
                    <!-- <div id="postreactionmsg{{$post->id}}"></div>
              <span onclick="postReactFun('{{$post->id}}','like')" style="cursor: pointer;"><i class="fa fa-thumbs-up" aria-hidden="true"></i></span>
              <span onclick="postReactFun('{{$post->id}}','dislike')" style="cursor: pointer;"><i class="fa fa-thumbs-down" aria-hidden="true"></i></span>
              <span onclick="postReactFun('{{$post->id}}','heart')" style="cursor: pointer;"><i class="fa fa-heart" aria-hidden="true"></i></span>
              <span onclick="postReactFun('{{$post->id}}','smile')" style="cursor: pointer;"><i class="fa fa-smile-o" aria-hidden="true"></i></span>
              <span onclick="postReactFun('{{$post->id}}','smileheart')" style="cursor: pointer;"><i class="fa fa-heartbeat" aria-hidden="true"></i></span> -->
              
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
                  <div>No Events found.</div>
              @endforelse
                
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