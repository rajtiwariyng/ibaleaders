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
  

  <!-- Contains page content -->
   @yield('content')

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
  <script>
    function loadFile(event) {
    console.log('File input changed');  // Debug: Check if this gets logged

    let file = event.target.files[0];
    if (!file) {
        console.log('No file selected');
        return;  // Make sure a file is selected
    }

    let formData = new FormData();
    formData.append('profile_image', file);

    // Get CSRF token from meta tag
    let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    if (!csrfToken) {
        console.error('CSRF token missing');
        return;
    }

    // Debugging the CSRF token
    console.log('CSRF Token:', csrfToken);

    // Send the request
    fetch("{{ route('profile.updateImage') }}", {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
        },
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('Image uploaded successfully');
            document.getElementById('profileImage').src = data.profile_image_url;  // Update profile image
        } else {
            console.error('Upload failed:', data.message);
        }
    })
    .catch(error => {
        console.error('Error uploading image:', error);
    });
}


</script>
</body>

</html>