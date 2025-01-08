<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon"> -->
  <link rel="stylesheet" href="{{ asset('front-assets/vendor/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('front-assets/vendor/css/animate.css') }}" />
  <link rel="stylesheet" href="{{ asset('front-assets/vendor/slick/slick.css') }}">
  <link rel="stylesheet" href="{{ asset('front-assets/vendor/slick/slick-theme.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
  <link rel="stylesheet" href="{{ asset('front-assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('front-assets/css/responsive.css') }}">
  <title>IBA</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
   @include('front.layouts.nav-top')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('front.layouts.side-nav')
  
        <div class="container">
        <div class="page-inner">
  <!-- Contains page content -->
  @include('Chatify::layouts.headLinks')
   <div class="messenger">
    {{-- ----------------------Users/Groups lists side---------------------- --}}
    <div class="messenger-listView {{ !!$channel_id ? 'conversation-active' : '' }}">
        {{-- Header and search bar --}}
        <div class="m-header">
            <nav>
                <a href="#"><i class="fas fa-inbox"></i> <span class="messenger-headTitle">MESSAGES</span> </a>
                {{-- header buttons --}}
                <nav class="m-header-right">
                    <a href="#"><i class="fas fa-users group-btn"></i></a>
                    <a href="#"><i class="fas fa-cog settings-btn"></i></a>
                    <a href="#" class="listView-x"><i class="fas fa-times"></i></a>
                </nav>
            </nav>
            {{-- Search input --}}
            <input type="text" class="messenger-search" placeholder="Search" />
            {{-- Tabs --}}
            {{-- <div class="messenger-listView-tabs">
                <a href="#" class="active-tab" data-view="users">
                    <span class="far fa-user"></span> Contacts</a>
            </div> --}}
        </div>
        {{-- tabs and lists --}}
        <div class="m-body contacts-container">
           {{-- Lists [Users/Group] --}}
           {{-- ---------------- [ User Tab ] ---------------- --}}
           <div class="show messenger-tab users-tab app-scroll" data-view="users">
               {{-- Favorites --}}
               <div class="favorites-section">
                <p class="messenger-title"><span>Favorites</span></p>
                <div class="messenger-favorites app-scroll-hidden"></div>
               </div>
               {{-- Saved Messages --}}
               <p class="messenger-title"><span>Your Space</span></p>
               {!! view('Chatify::layouts.listItem', ['get' => 'saved']) !!}
               {{-- Contact --}}
               <p class="messenger-title"><span>All Messages</span></p>
               <div class="listOfContacts" style="width: 100%;height: calc(100% - 272px);position: relative;"></div>
           </div>
             {{-- ---------------- [ Search Tab ] ---------------- --}}
           <div class="messenger-tab search-tab app-scroll" data-view="search">
                {{-- items --}}
                <p class="messenger-title"><span>Search</span></p>
                <div class="search-records">
                    <p class="message-hint center-el"><span>Type to search..</span></p>
                </div>
             </div>
        </div>
    </div>

    {{-- ----------------------Messaging side---------------------- --}}
    <div class="messenger-messagingView">
        {{-- header title [conversation name] amd buttons --}}
        <div class="m-header m-header-messaging">
            <nav class="chatify-d-flex chatify-justify-content-between chatify-align-items-center">
                {{-- header back button, avatar and user name --}}
                <div class="chatify-d-flex chatify-justify-content-between chatify-align-items-center">
                    <a href="#" class="show-listView"><i class="fas fa-arrow-left"></i></a>
                    <div class="avatar av-s header-avatar" style="margin: 0px 10px; margin-top: -5px; margin-bottom: -5px;">
                    </div>
                    <a href="#" class="user-name">{{ config('chatify.name') }}</a>
                </div>
                {{-- header buttons --}}
                <nav class="m-header-right">
                    <a href="#" class="add-to-favorite"><i class="fas fa-star"></i></a>
                    <a href="/"><i class="fas fa-home"></i></a>
                    <a href="#" class="show-infoSide"><i class="fas fa-info-circle"></i></a>
                </nav>
            </nav>
            {{-- Internet connection --}}
            <div class="internet-connection">
                <span class="ic-connected">Connected</span>
                <span class="ic-connecting">Connecting...</span>
                <span class="ic-noInternet">No internet access</span>
            </div>
        </div>

        {{-- Messaging area --}}
        <div class="m-body messages-container app-scroll">
            <div class="messages">
                <p class="message-hint center-el"><span>Please select a chat to start messaging</span></p>
            </div>
            {{-- Typing indicator --}}
            <div class="typing-indicator">
                <div class="message-card typing">
                    <div class="message">
                        <span class="typing-dots">
                            <span class="dot dot-1"></span>
                            <span class="dot dot-2"></span>
                            <span class="dot dot-3"></span>
                        </span>
                    </div>
                </div>
            </div>

        </div>
        {{-- Send Message Form --}}
        @include('Chatify::layouts.sendForm')
    </div>

    {{-- ---------------------- Info side ---------------------- --}}
    <div class="messenger-infoView app-scroll">
        <nav>
            <p></p>
            <a href="#"><i class="fas fa-times"></i></a>
        </nav>
    </div>
</div>

@include('Chatify::layouts.modals')
@include('Chatify::layouts.footerLinks')

</div>
</div>

   <footer class="bg-blue px-4 py-3 mt-4">
          <div class="d-flex justify-content-between flex-wrap">
            <div class="text-white">
              <a href="#" class="text-white d-block pb-2">Profile</a>
              <a href="{{ route('front.logout')}}" class="text-white d-block pb-2">Signout</a>
              <p>Thursday, August 29 2024</p>
            </div>
            <div class="text-md-end text-white copyright">
              <p class="lh-lg">Copyright 2024 IBAL. All Rights Reserved. <br>
                BNIConnect: Release 2.22.0, Build: 2f5c4086  <br>
                Last Changed Date: 2024-07-18 08:20  </p>
               <ul class="d-flex"> 
                <li><a href="{{ route('front.termsofuse') }}">Terms of Use</a></li>
                <li>|</li>
                <li><a href="{{ route('front.privacypolicy') }}">Privacy Policy</a></li>
                <li>|</li>
                <li><a href="{{ route('front.browserpolicy') }}">Browser Policy</a></li>
               </ul>
            </div>
          </div>
        </footer>
      </div>
    </div>
  </main>
  <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Video</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <iframe width="100%" height="315" src="https://www.youtube.com/embed/K_3qEmOmfcY?si=2QPkHLmbLDQE7can" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary bg-blue border-0" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  
  <!-- All scripts are here -->
  <script src="{{ asset('front-assets/vendor/js/jquery.min.js') }}"></script>
  <script src="{{ asset('front-assets/vendor/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('front-assets/vendor/slick/slick.min.js') }}"></script>
  <script src="{{ asset('front-assets/vendor/js/wow.min.js') }}"></script>
  <script src="{{ asset('front-assets/js/main.js') }}"></script>
  @yield('customJs')
  
</body>

</html>

