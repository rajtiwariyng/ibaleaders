<div class="main-header">
    <div class="main-header-logo">
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
            <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                @if(!Route::is('blog.show'))
                    <li>
                        <div class="dropdown">
                            <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{ asset('front-assets/icons/settings.png') }}" alt="">
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ route('user.profile') }}">View Profile</a>
                                <a class="dropdown-item" href="{{ route('front.resetpassword') }}">Reset Password</a>
                                <a class="dropdown-item" href="{{ route('front.privacysettings') }}">Privacy Setting</a>
                                <a class="dropdown-item" href="{{ route('front.logout') }}">Log Out</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item topbar-icon dropdown hidden-caret">
                        <a class="nav-link" href="{{ route('front.notifications') }}">
                            <img src="{{ asset('front-assets/icons/ringing.png') }}" alt="">
                            <span class="notification">4</span>
                        </a>
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
                            </div>
                        </div>
                    </li>
                @else
                    <!-- Placeholder content for `blog.show` route -->
                    <li>
                        <span>IBAL BLOGS</span>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
</div>
