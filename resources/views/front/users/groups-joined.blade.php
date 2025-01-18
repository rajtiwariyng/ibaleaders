@extends('front.layouts.app')
@section('content')

      <div class="container">
        @include('front.users.profile-top')
              <div class="mt-4">
                <h5 class="blue poppins-bold pb-2">Your Groups</h5>
				
				       <?php  foreach($Groupdata as $Groupdatas){  ?>  
                <div class="whiteBox bg-white mb-3">
                  <div class="testimonialBox p-3">
                    <div class="top-info">
                      <div class="d-flex bg-blue info-contain">
                       <!-- <p class="text-white fs-7 mb-0">Topics: 211</p> -->
                       <a  href="{{ route('chatify') }}/<?php echo $Groupdatas['channel_id'] ?> " ><p class="text-white fs-7 mb-0">Participants: <?php echo $Groupdatas['total_User'] ?></p></a>
                      </div>    
                    </div>
                    <div class="item">
                      <div class="d-flex align-items-center gap-3">
                        <div class="user-img pb-2">
                          <img src="<?php echo $Groupdatas['image']  ?>" alt="" class="rounded-circle m-auto">
                        </div>
                        <div>
                          <h6 class="blue mb-0"><?php echo $Groupdatas['name']  ?></h6>  
                        <!--  <p class="fs-7 pb-1">Interior Designer | Phillipines</p> -->
                        </div>
                      </div>
                      <!--<p class="fs-7 content">BNI is more than just helping you grow your business – it is helping you build your network. You will gain colleagues, business partners, and friends who will become part of your newfound family. This positive and supportive group of people will help you go through any crisis because you can not do this alone.</p> -->
                    </div>
                  </div>
                </div>
                <?php } ?>
                
                <div class="col-md-12 form-btns py-3">
                  <button type="button" class="blue btn backBtn">View More</button>
                </div>
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