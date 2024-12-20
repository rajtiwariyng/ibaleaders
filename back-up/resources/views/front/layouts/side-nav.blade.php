  <main class="">
    <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark sidebar dash-side">
      <a href="{{ route('front.login') }}" class="d-flex align-items-center mb-3 me-md-auto text-white text-decoration-none">
        <span class="fs-4 side-logo"><img src="{{ asset('front-assets/images/white-logo.png') }}" alt=""></span>
      </a>
      <ul class="nav nav-pills flex-column mb-auto">
          <li class="nav-item">
              <a href="{{ route('front.home') }}" class="nav-link {{ Request::routeIs('front.home') ? 'active' : 'text-white' }}" aria-current="page">
                  <img src="{{ asset('front-assets/icons/Home.png') }}" alt=""> Home
              </a>
          </li>
          <li>
              <a href="{{ route('front.dashboard') }}" class="nav-link {{ Request::routeIs('front.dashboard') ? 'active' : 'text-white' }}">
                  <img src="{{ asset('front-assets/icons/Dashboard.png') }}" alt=""> Dashboard
              </a>
          </li>
          <li>
              <a href="{{ route('front.alliance') }}" class="nav-link {{ Request::routeIs('front.alliance') ? 'active' : 'text-white' }}">
                  <img src="{{ asset('front-assets/icons/Alliance.png') }}" alt=""> Alliance
              </a>
          </li>
          <li>
              <a href="{{ route('front.reports') }}" class="nav-link {{ Request::routeIs('front.reports') ? 'active' : 'text-white' }}">
                  <img src="{{ asset('front-assets/icons/report.png') }}" alt=""> Report
              </a>
          </li>
          <li>
              <a href="{{ route('front.aboutus') }}" class="nav-link {{ Request::routeIs('front.aboutus') ? 'active' : 'text-white' }}">
                  <img src="{{ asset('front-assets/icons/About-Us.png') }}" alt=""> About us
              </a>
          </li>
      </ul>

    </div>
        <div class="main-panel">