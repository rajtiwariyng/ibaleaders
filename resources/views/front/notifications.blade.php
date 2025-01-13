@extends('front.layouts.app')
@section('content')
      <div class="container">
        <div class="page-inner">
          @include('front.layouts.message')
          <h5 class="blue poppins-bold pb-3">Notifications</h5>
          <div class="row">
            <div class="col-md-7">
            @forelse ($notificationslists as $notificationslist) 
              <div class="whiteBox bg-white p-3 mb-3">
                <div class="notification-wrapper">
                  <div class="note-img"> <img src="{{ $notificationslist->user && $notificationslist->user->profile_image ? asset('storage/' . $notificationslist->user->profile_image) : asset('front-assets/images/profile2.jpg') }}" alt="{{ $notificationslist->name }}" class="linkdinImage"></div>
                  <div class="note-content">
                    <p class="mb-0 fs-7" ><strong>{{ $notificationslist->user && $notificationslist->user->name?$notificationslist->user->name:'' }}</strong>
                   
                    <?php $decodedata=json_decode($notificationslist->data, true); 
                    print_r($decodedata['message']);
                    
                    ?>
                    {{ $notificationslist->name }} </p>
                    <div class="d-flex fs-8">
                      <p class="d-flex mb-0"><span class="blue pe-4"><?php echo date("d M Y", strtotime($notificationslist->created_at));?></span></p>
                      <ul class="blue  mb-0 pb-0"><li>{{ $notificationslist->user && $notificationslist->user->city?$notificationslist->user->city:'' }} > {{ $notificationslist->user && $notificationslist->user->state?$notificationslist->user->state:'' }}</li> </ul>
                    </div>
                  </div>
                  <div class="dropdown ellipse-action d-none">
                    <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fa-solid fa-ellipsis-vertical fs-6"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                    </div>
                  </div>
                  
                </div>
              </div>
              @empty
                <p>No suggestions available.</p>
            @endforelse
              
              <div class="whiteBox bg-white p-3 mb-3 d-none">
                <div class="notification-wrapper">
                  <div class="note-img"></div>
                  <div class="note-content">
                    <p class="mb-0 fs-7" ><strong>Manoj</strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
                    <div class="d-flex fs-8">
                      <p class="d-flex mb-0"><span class="blue pe-4">2 Days</span></p>
                      <ul class="blue  mb-0 pb-0"><li>India > Delhi North</li> </ul>
                    </div>
                  </div>
                  <div class="dropdown ellipse-action">
                    <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fa-solid fa-ellipsis-vertical fs-6"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-5">
              <div class="whiteBox bg-white p-3 mb-3">
                <h5 class="blue poppins-bold pb-3 fs-6">Connections Requests</h5>
                @if($pendingRequests->isEmpty())
                    <p>No pending connection requests.</p>
                @else
                    @foreach ($pendingRequests as $request)
                        <div class="notification-wrapper mb-4">
                            <div class="note-img">
                                <!-- Add profile image if available -->
                                <img src="{{ $connection->profile_image ?? asset('front-assets/images/default.jpg') }}" alt="Profile" style="width: 50px; height: 50px; border-radius: 50%;">
                            </div>
                            <div class="note-content">
                                <p class="mb-0 fs-7"><strong>{{ $request->sender?->name ?? 'Unknown User' }}</strong></p>
                                <p class="mb-0 fs-8">{{ $request->sender->profession ?? 'Profession not available' }}</p>
                            </div>
                            <div class="action-btns d-flex">
                                <!-- Approve Button -->
                                <form action="{{ route('user.approveConnection') }}" method="POST" style="margin-right: 10px;">
                                    @csrf
                                    <input type="hidden" name="connection_id" value="{{ $request->id }}">
                                    <button type="submit" class="tick" title="Approve">
                                        <i class="fa-solid fa-check"></i>
                                    </button>
                                </form>

                                <!-- Reject Button -->
                                <form action="{{ route('user.rejectConnection') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="connection_id" value="{{ $request->id }}">
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="trash" title="Reject">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @endif
                <!-- <div class="notification-wrapper mb-4">
                  <div class="note-img">
                  </div>
                  <div class="note-content">
                    <p class="mb-0 fs-7" ><strong>Aashna Sabharwal</strong></p>
                    <p class="mb-0 fs-8" >Health & Wellness, Nutritionist</p>
                  </div>
                  <div class="action-btns d-flex">
                    <button class="tick"><i class="fa-solid fa-check"></i></button>
                    <button class="trash"><i class="fa-solid fa-trash-can"></i></button>
                  </div>
                </div>
                <div class="notification-wrapper mb-4">
                  <div class="note-img">
                  </div>
                  <div class="note-content">
                    <p class="mb-0 fs-7" ><strong>Aashna Sabharwal</strong></p>
                    <p class="mb-0 fs-8" >Health & Wellness, Nutritionist</p>
                  </div>
                  <div class="action-btns d-flex">
                    <button class="tick"><i class="fa-solid fa-check"></i></button>
                    <button class="trash"><i class="fa-solid fa-trash-can"></i></button>
                  </div>
                </div>
                <div class="notification-wrapper mb-4">
                  <div class="note-img">
                  </div>
                  <div class="note-content">
                    <p class="mb-0 fs-7" ><strong>Aashna Sabharwal</strong></p>
                    <p class="mb-0 fs-8" >Health & Wellness, Nutritionist</p>
                  </div>
                  <div class="action-btns d-flex">
                    <button class="tick"><i class="fa-solid fa-check"></i></button>
                    <button class="trash"><i class="fa-solid fa-trash-can"></i></button>
                  </div>
                </div>
                <div class="notification-wrapper mb-4">
                  <div class="note-img">
                  </div>
                  <div class="note-content">
                    <p class="mb-0 fs-7" ><strong>Aashna Sabharwal</strong></p>
                    <p class="mb-0 fs-8" >Health & Wellness, Nutritionist</p>
                  </div>
                  <div class="action-btns d-flex">
                    <button class="tick"><i class="fa-solid fa-check"></i></button>
                    <button class="trash"><i class="fa-solid fa-trash-can"></i></button>
                  </div>
                </div> -->
              </div>
            </div>
          </div>
          
        </div>
        
@endsection
@section('customJs')

@endsection 