@extends('front.layouts.app')
@section('content')

<div class="container">
        <div class="page-inner p-0 bio-page">
          <div class="cover-pic">
            <img src="images/about-banner.jpg" alt="" class="w-100">
          </div>
        </div>
        <div class="bg-white">
          <div class="container">
            <div class="row">
              <div class="col-xl-2">
                <div class="user-profile-header">
                  <div class="p-1 bg-white">
                    <img src="images/profile2.jpg" alt="">
                  </div>
                </div>
              </div>
              <div class="col-xl-10">
                <nav class="bio-menu">
                  <div class="toggle"><i class="fa-solid fa-bars"></i></div>
                  <div class="user-menu">
                    <ul class="d-flex flex-lg-row bg-white justify-content-end p-3">
                      <li><a href="profile-details.html">Personal Details</a></li>
                      <li class="active"><a href="edit-bio.html">Bio</a></li>
                      <li><a href="connections.html">Connections</a></li>
                      <li><a href="testimonials.html">Testimonials</a></li>
                      <li><a href="groups-joined.html">Groups joined</a></li>
                      <li><a href="events.html">Events attended</a></li>
                    </ul>
                  </div>
                </nav>
              </div>
            </div>
          </div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-lg-7">
              <div class="userStoryBox d-flex flex-column">
                <div class="d-flex">
                  <div class="userStoryImg">
                    <img src="images/profile2.jpg" alt="" class="rounded-circle">
                  </div>
                  <div class="userStoryShare d-flex">
                    <input type="text" placeholder="Share Your Success Story" class="bg-white border-0 form-control">
                    <button type="button" class="bg-blue text-white share-btn border-0">Share</button>
                  </div>
                </div>
                <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-4 mt-4 fs-8">
                  <li class="list-inline-item">
                    <i class="fa-regular fa-image"></i> <span class="fw-medium">Photo / Video </span>
                  </li>
                  <li class="list-inline-item">
                    <i class="fa-solid fa-people-group"></i> <span class="fw-medium">Create Groups</span>
                  </li>
                  <li class="list-inline-item">
                    <i class="fa-solid fa-calendar-week"></i> <span class="fw-medium">Create Event</span>
                  </li>
                </ul>
              </div>
              <div class="mt-4">
                <h4 class="blue poppins-bold">Edit Profile</h4>
                <form action="" class="pt-3 profile-form">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="year in business">Name</label>
                        <input type="text" id="year in business" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="previous-jobs">Industry</label>
                        <input type="text" id="previous-jobs" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="spouse">Mobile Number</label>
                        <input type="text" id="spouse" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="children">Email Address</label>
                        <input type="text" id="children" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="mb-3">
                        <label for="hobbies">Address</label>
                        <input type="text" id="hobbies" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="city-residence">City</label>
                        <input type="text" id="city-residence" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="city-residence">State</label>
                        <input type="text" id="city-residence" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="city-residence">Pin Code</label>
                        <input type="text" id="city-residence" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="years-in-city">Brand Name</label>
                        <input type="text" id="years-in-city" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="burning-desire">Brand Logo</label>
                        <input type="text" id="burning-desire" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="mb-3">
                        <label for="key-success">Business Bio</label>
                        <textarea name="" id="" rows="3" class="form-control"></textarea>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="mb-3">
                        <label for="key-success">Keywords for Business</label>
                        <textarea name="" id="" rows="3" class="form-control"></textarea>
                      </div>
                    </div>
                    
                    <div class="col-md-12 form-btns py-3">
                      <button type="button" class="bg-blue text-white btn">Update</button>
                      <button type="button" class="blue btn backBtn">Back</button>
                    </div>                    
                  </div>

                </form>
              </div>
            </div>
            <div class="col-lg-5 mt-4">
              <div class="whiteBox bg-white p-3 mb-3">
                <h5 class="blue poppins-bold mb-0 fs-6">Visitor Registration</h5>
                <form action="" class="vrForm pt-4">
                  <div class="row">
                    <div class="col-md-12 form-group">
                      <input type="text" class="form-control" placeholder="First Name">
                    </div>
                    <div class="col-md-12 form-group">
                      <input type="text" class="form-control" placeholder="Last Name">
                    </div>
                    <div class="col-md-12 form-group">
                      <input type="text" class="form-control" placeholder="Email Address">
                    </div>
                    <div class="col-md-12 form-group">
                      <input type="text" class="form-control" placeholder="Mobile Number">
                    </div>
                    <div class="col-md-12 form-group">
                      <input type="text" class="form-control" placeholder="Company Name">
                    </div>
                    <div class="col-md-12 form-group">
                      <input type="text" class="form-control" placeholder="City">
                    </div>
                    <div class="col-md-12 form-group">
                      <textarea name="" id="" rows="4" cols="2" class="form-control" placeholder="Address"></textarea>
                    </div>
                    <div class="col-md-12 form-group">
                      <input type="text" class="form-control" placeholder="State/Country/Province">
                      <input type="text" class="form-control" placeholder="Post Code">
                    </div>
                  </div>
                  <div class="text-center sbmtBtn">
                    <a href="#" class="white">
                      <div class="cornerbox mt-2">
                        <div class="bg"></div>
                        <p class="mb-0">Submit</p>
                      </div>
                    </a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
@endsection
@section('customJs')
@endsection