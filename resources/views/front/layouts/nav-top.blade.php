<div class="main-header">
        <div class="main-header-logo ">
          <div class="logo-header">
            <a href="home.html" class="logo">
              <img src="{{ asset('front-assets/images/white-logo.png') }}" alt="navbar brand" class="navbar-brand" height="20">
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
        </div>
        <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg">
          <div class="container-fluid">
            <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
              <div class="input-group">
                  <input type="text" id="searchInput" placeholder="Search ..." class="form-control fs-7 border-0">
                  <div class="input-group-prepend">
                      <button type="submit" class="btn btn-search bg-blue">
                          <img src="{{ asset('front-assets/icons/search.png') }}" alt="">
                      </button>
                  </div>
              </div>
              <div id="suggestions" class="list-group mt-2" style="display: none;"></div>
            </nav>
            <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
              <li>
                <div class="dropdown">
                  <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{ asset('front-assets/icons/settings.png') }}" alt="">
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{ route('user.profile') }}">View Profile</a>
                    <a class="dropdown-item" href="{{ route('front.resetpassword') }}">Reset Password</a>
                    <a class="dropdown-item" href="{{ route('user.privacy.setting') }}">Privacy Setting</a>
                    <a class="dropdown-item" href="{{ route('front.logout') }}">Log Out</a>
                  </div>
                </div>
              </li>
              <li class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" aria-haspopup="true">
                  <i class="fa fa-search"></i>
                </a>
                <ul class="dropdown-menu dropdown-search animated fadeIn">
                  <form class="navbar-left navbar-form nav-search">
                    <div class="input-group">
                      <input type="text" placeholder="Search ..." class="form-control">
                    </div>
                  </form>
                </ul>
              </li>
              <li class="nav-item topbar-icon dropdown hidden-caret">
                <a class="nav-link" href="{{ route('front.notifications') }}">
                  <img src="{{ asset('front-assets/icons/ringing.png') }}" alt="">
                  <span class="notification">4</span>
                </a>
              </li>
              <li class="nav-item topbar-icon dropdown hidden-caret submenu">
                <a class="nav-link dropdown-toggle" href="{{ route('front.chats') }}">
                  <img src="{{ asset('front-assets/icons/mesg.png') }}" alt="">
                  <span class="notification">2</span>
                </a>
              </li>
              <li>
                <a href="#"><img src="{{ asset('front-assets/icons/help.png') }}" alt=""></a>
              </li>
              <li class="nav-item topbar-user dropdown hidden-caret">
                <div class="d-flex align-items-center">
                  <span class="profile-username">
                    <span class="fw-bold">{{ auth()->user()->name }}</span>
                    <p class="mb-0 fs-8">{{ auth()->user()->industry }}</p>
                  </span>
                  <div class="profile-container">
                      <img id="profileImage" src="{{ auth()->user()->profile_image ? asset('storage/' . auth()->user()->profile_image) : asset('front-assets/images/profile.jpg') }}" 
                           alt="User Profile" class="profile-image">
                      <label for="fileUpload" class="camera-icon">
                          <i class="fa-solid fa-camera"></i>
                      </label>
                      <input type="file" id="fileUpload" class="upload-input" accept="image/*" onchange="loadFile(event)">
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </div>

        <script>
    $('#searchInput').on('keyup', function() {
        let query = $(this).val();

        // Only perform search when input has 5 or more characters
        if (query.length >= 5) {
            $.ajax({
                url: "{{ route('user.search') }}",
                method: "GET",
                data: { query: query },
                success: function(response) {
                    let suggestions = $('#suggestions');
                    suggestions.empty(); // Clear previous suggestions
                    if (response.length > 0) {
                        response.forEach(user => {
                            suggestions.append(
                                `<a href="#" class="list-group-item list-group-item-action">${user.name}</a>`
                            );
                        });
                        suggestions.show();
                    } else {
                        suggestions.hide();
                    }
                }
            });
        } else {
            $('#suggestions').hide();
        }
    });
</script>

