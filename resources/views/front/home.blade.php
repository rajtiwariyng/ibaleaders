@extends('front.layouts.app')
@section('content')
      <div class="container">
        <div class="page-inner">
          <div class="dashboard-slider">
            <div class="whiteBox bg-white p-4">
              <div class="d-flex justify-content-between align-items-center flex-wrap">
                <h3 class="blue poppins-bold mb-0">IBAL® Innovations</h3>
                <p class="mb-0">My Personal Participation Report</p>
                <p class="mb-0"><strong>Renewal Due Date: 01/04/2025</strong></p>
              </div>
              <div class="table-responsive mt-3">
                <table class="table">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Last 12 Months</th>
                      <th>Lifetime</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Revenue Received To My Business:</td>
                      <td>108429800</td>
                      <td>108429800</td>
                    </tr>
                    <tr>
                      <td>Referrals Received:</td>
                      <td>77</td>
                      <td>27505571</td>
                    </tr>
                    <tr>
                      <td>TYFCB Given:</td>
                      <td>77</td>
                      <td>27505571</td>
                    </tr>
                    <tr>
                      <td>Referrals Given:</td>
                      <td>116</td>
                      <td>116</td>
                    </tr>
                    <tr>
                      <td>Visitor:</td>
                      <td>10</td>
                      <td>16</td>
                    </tr>
                    <tr>
                      <td>One-to-Ones:</td>
                      <td>18</td>
                      <td>20</td>
                    </tr>
                    <tr>
                      <td>CEUs:</td>
                      <td>13</td>
                      <td>22</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div>
              <div class="card-body bg-white chartBox">
                <div class="chart-container">
                  <canvas id="lineChart"></canvas>
                </div>
              </div>
            </div>
          </div>
<<<<<<< HEAD
          
=======
          <div class="row">
            <div class="col-md-8">
>>>>>>> a8445b326f46709240e0003560090eb0de4ee731
          @forelse($posts as $post) 
          <div class="whiteBox bg-white p-4 mt-4">
            <div class="d-flex mb-3">
              <div class="d-flex align-items-center">
                <div class="pe-3">
                  <img src="{{ $post->profile_image ? asset('storage/' . $post->profile_image) : asset('front-assets/images/profile2.jpg') }}" alt="{{ $post->title }}">
                </div>
                <div>
                  <p class="mb-0"><strong>{{ $post->title }}</strong></p>
<<<<<<< HEAD
                  <p class="mb-0">{{ \Carbon\Carbon::parse($post->created_at)->format('d M Y') }}</p>
=======
                  <p class="mb-0"><?php echo date("d M Y", strtotime($post->created_at));?></p>
>>>>>>> a8445b326f46709240e0003560090eb0de4ee731
                </div>
              </div>
            </div>
            <p>{{ $post->description }}</p>
            <div>
              <img src="{{ url('storage/'.$post->image) }}" alt="">
            </div>
            <div class="reactions d-flex align-items-center justify-content-between pt-3">
              <a class="d-flex align-items-center text-color">
                <img src="{{ asset('front-assets/icons/React.png') }}" alt="" class="pe-2">
                React
              </a>
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
<<<<<<< HEAD
=======
          </div>
          <div class="col-md-4">
              <div class="whiteBox bg-white p-4 mt-4">
                <h6 class="blue poppins-bold pb-2 fs-6 fw-600">Revenue Received To My Business: </h6>
                <div class="blue poppins-bold fs-6 fw-600 Revenue-number">
                  <img src="images/earning.png" alt=""> 
                  <p class="blue poppins-bold fs-4">136558852</p>
                </div>
                <div class="mb-2">
                  <button class="bg-blue btn text-white fs-8" type="button">Print your weekly slip</button>
                </div>
                <div class="mb-2">
                  <button class="bg-blue btn text-white fs-8" type="button">Received refferal report</button>
                </div>
                <div class="mb-2">
                  <button class="bg-blue btn text-white fs-8 d-none" type="button">My Personal Participation Report</button>
                </div>
              </div>
              <div class="whiteBox bg-white p-4 mt-4">
                <h6 class="blue poppins-bold pb-2 fs-6 fw-600">Referrals Received: </h6>
                <div class="blue poppins-bold fs-6 fw-600 Revenue-number">
                  <img src="images/ref-rec.png" alt=""> 
                  <p class="blue poppins-bold fs-4">{{count($receivedReferralslist)}}</p>
                </div>
                <div class="mb-2">
                  <button class="bg-blue btn text-white fs-8" data-bs-toggle="modal" data-bs-target="#modalGetReferralView" type="button">Track Online</button>
                </div>
                
              </div>
              <div class="whiteBox bg-white p-4 mt-4">
                <h6 class="blue poppins-bold pb-2 fs-6 fw-600">Referrals Given: </h6>
                <div class="blue poppins-bold fs-6 fw-600 Revenue-number">
                  <img src="images/ref-given.png" alt=""> 
                  <p class="blue poppins-bold fs-4">{{count($referralslist)}}</p>
                </div>
                <div class="mb-2">
                <button class="bg-blue btn text-white fs-8" data-bs-toggle="modal" data-bs-target="#modalReferral" type="button">Submit</button>
                <button class="bg-blue btn text-white fs-8" data-bs-toggle="modal" data-bs-target="#modalReferralView" type="button">Review</button>
                </div>
                
              </div>
              <div class="whiteBox bg-white p-4 mt-4">
                <h6 class="blue poppins-bold pb-2 fs-6 fw-600">TYFCB Given: </h6>
                <div class="blue poppins-bold fs-6 fw-600 Revenue-number">
                  <img src="images/tyfcb.png" alt=""> 
                  <p class="blue poppins-bold fs-4">{{$tyfcbreferralstotal[0]->subtotal}}</p>
                </div>
                <div class="mb-2">
                <button class="bg-blue btn text-white fs-8" data-bs-toggle="modal" data-bs-target="#modalReferralTYFCB" type="button">Submit</button>
                  <button class="bg-blue btn text-white fs-8" data-bs-toggle="modal" data-bs-target="#modalTyfcbReferralView" type="button">Review</button>
                </div>
                
              </div>
              <div class="whiteBox bg-white p-4 mt-4">
                <h6 class="blue poppins-bold pb-2 fs-6 fw-600">One to Ones: </h6>
                <div class="blue poppins-bold fs-6 fw-600 Revenue-number">
                  <img src="images/one-to-one.png" alt=""> 
                  <p class="blue poppins-bold fs-4">{{count($onereferralslists)}}</p>
                </div>
                <div class="mb-2">
                
                <button class="bg-blue btn text-white fs-8" data-bs-toggle="modal" data-bs-target="#modalOnetooneReferral" type="button">Submit</button>
                
                <button class="bg-blue btn text-white fs-8" data-bs-toggle="modal" data-bs-target="#modalOneReferralView" type="button">Review</button>
                </div>
                
              </div>
              <div class="whiteBox bg-white p-4 mt-4 d-none">
                <h6 class="blue poppins-bold pb-2 fs-6 fw-600">Visitor: </h6>
                <div class="blue poppins-bold fs-6 fw-600 Revenue-number">
                  <img src="images/visitor.png" alt=""> 
                  <p class="blue poppins-bold fs-4">1765852</p>
                </div>
                <div class="mb-2">
                  <button class="bg-blue btn text-white fs-8" type="button">Visitor Portal</button>
                </div>
                
              </div>
              <div class="whiteBox bg-white p-4 mt-4 d-none">
                <h6 class="blue poppins-bold pb-2 fs-6 fw-600">CEUs: </h6>
                <div class="blue poppins-bold fs-6 fw-600 Revenue-number">
                  <img src="images/ceus.png" alt=""> 
                  <p class="blue poppins-bold fs-4">1765852</p>
                </div>
                <div class="mb-2">
                  <button class="bg-blue btn text-white fs-8" data-bs-toggle="modal" data-bs-target="#modal4" type="button">Submit</button>
                  <button class="bg-blue btn text-white fs-8" type="button">Review</button>
                </div>
                
              </div>
            </div>
          </div>
>>>>>>> a8445b326f46709240e0003560090eb0de4ee731
        </div>
@endsection
 <!-- Modal -->
 <div class="modal fade" id="modalReferralTYFCB" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title fs-5 blue" id="exampleModalLabel">BNI® Thank you for closed business</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <p>Chapter: {{ $user->name }} | Date: <?php echo date("d M Y", time());?></p>
      <form id="tyfcbreferralPostForm" class="vrForm pt-2" method="POST">
                  @csrf
                 @method('POST')
          <div class="row">
            <div class="col-md-12 form-group">
              <p>Thank you to*</p>
              <p class="fs-8 mb-1">Please select from dropdown below or search cross chapter</p>
              <div class="d-flex">
                <select name="tyfcbreferraluser" id="tyfcbreferraluser" placeholder="Select a member from your chapter" class="form-control">
                <option value=''>Select Referral</div>
                @forelse($referralslist as $referrals) 
                  <option value="{{$referrals->received_to}}">{{$referrals->received->name}}</option>
                  @empty
					                <option value=''>No user found.</div>
					            @endforelse
                 
                </select>
              </div>
              <div id="error-tyfcbreferraluser" class="text-danger"></div>
            </div>
            <div class="col-md-12 form-group">
              <input type="text" class="form-control" name="tyfcbreferralamount" id="tyfcbreferralamount" placeholder="For a referral in the amount of">
              <div id="error-tyfcbreferralamount" class="text-danger"></div>
            </div>
            <div>
              <p>Business Type </p>
              <div class="d-flex radio-container">
                <p>
                  <input type="radio" name="tyfcbreferralbusinesstype" id="tyfcbreferralbusinesstype1" class="gallery-radios"  checked="" value="new">
                  <label for="tyfcbreferralbusinesstype1">New</label>
                </p>
                <p class="ms-3">
                  <input type="radio" name="tyfcbreferralbusinesstype" id="tyfcbreferralbusinesstype2"  class="gallery-radios" value="repeat">
                  <label for="tyfcbreferralbusinesstype2">Repeat</label>
                </p>
              </div>
              <div id="error-tyfcbreferralbusinesstype" class="text-danger"></div>
            </div>
            <div>
              <p>Referral Type </p>
              <div class="d-flex radio-container">
                <p>
                  <input type="radio" name="tyfcbreferraltype" id="tyfcbreferraltype1"   class="gallery-radios"  checked="" value="inside">
                  <label for="tyfcbreferraltype1">Tier 1 (inside)</label>
                </p>
                <p class="ms-3">
                  <input type="radio" name="tyfcbreferraltype" id="tyfcbreferraltype2"  class="gallery-radios" value="outside" >
                  <label for="tyfcbreferraltype2">Tier 2 (outside)</label>
                </p>
                <p class="ms-3">
                  <input type="radio" name="tyfcbreferraltype" id="tyfcbreferraltype3"  class="gallery-radios" value="other">
                  <label for="tyfcbreferraltype3">Tier 3+</label>
                </p>
              </div>
              <div id="error-tyfcbreferraltype" class="text-danger"></div>
            </div>
            
            <div class="col-md-12 form-group">
              <textarea  name="tyfcbreferralcomment" id="tyfcbreferralcomment"  rows="4" cols="2" class="form-control" placeholder="Comments"></textarea>
              <div id="error-tyfcbreferralcomment" class="text-danger"></div>
            </div>
            <div class="mb-2 text-center">
            <div id="tyfbreferralsuccessMsgPost" class="text-success mt-3" style="display: none;"></div>
            <button class="bg-blue btn text-white fs-6" onclick="tyfcbreferralSubmitForm()" type="button">Submit</button>
              <button class="bg-blue btn text-white fs-6" type="button">Close</button>
            </div>
            
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title fs-5 blue" id="exampleModalLabel">BNI® Thank you for closed business</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Chapter: BNI Triumph | Date: 12/12/2024</p>
        <form action="" class="vrForm pt-2">
          <div class="row">
            <div class="col-md-12 form-group">
              <p>Thank you to*</p>
              <p class="fs-8 mb-1">Please select from dropdown below or search cross chapter</p>
              <div class="d-flex">
                <select name="tyfcbreferraluser" id="tyfcbreferraluser" placeholder="Select a member from your chapter" class="form-control">
                <option value=''>Select Referral</div>
                @forelse($referralslist as $referrals) 
                  <option value="{{$referrals->received_to}}">{{$referrals->received->name}}</option>
                  @empty
					                <option value=''>No user found.</div>
					            @endforelse
                 
                </select>
              </div>
            </div>
            <div>
              <p>Business Type </p>
              <div class="d-flex radio-container">
                <p>
                  <input type="radio" id="test3" class="gallery-radios" name="radio-group" checked="">
                  <label for="test3">New</label>
                </p>
                <p class="ms-3">
                  <input type="radio" id="test5" class="gallery-radios" name="radio-group">
                  <label for="test5">Repeat</label>
                </p>
              </div>
            </div>
            <div>
              <p>Referral Type </p>
              <div class="d-flex radio-container">
                <p>
                  <input type="radio" id="test32" class="gallery-radios" name="radio-group1" checked="">
                  <label for="test32">Tier 1 (inside)</label>
                </p>
                <p class="ms-3">
                  <input type="radio" id="test55" class="gallery-radios" name="radio-group1">
                  <label for="test55">Tier 2 (outside)</label>
                </p>
                <p class="ms-3">
                  <input type="radio" id="test6" class="gallery-radios" name="radio-group1">
                  <label for="test6">Tier 3+</label>
                </p>
              </div>
            </div>
            <div class="col-md-12 form-group">
              <input type="text" class="form-control" placeholder="For a referral in the amount of">
            </div>
            <div class="col-md-12 form-group">
              <textarea name="" id="" rows="4" cols="2" class="form-control" placeholder="Comments"></textarea>
            </div>
            <div class="mb-2 text-center">
              <button class="bg-blue btn text-white fs-6" type="button">Submit</button>
              <button class="bg-blue btn text-white fs-6" type="button">Close</button>
            </div>
            
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title fs-5" id="exampleModalLabel">Referral Tracking Sheet</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="field1" class="form-label">Start Date</label>
                <input type="text" class="form-control" id="field1">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="field2" class="form-label">End Date</label>
                <input type="text" class="form-control" id="field2">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="field3" class="form-label">Status</label>
                <input type="text" class="form-control" id="field3">
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary bg-blue border-0">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
  <!-- Modal -->
  <div class="modal fade" id="modal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title fs-5 blue" id="exampleModalLabel">Chapter : TYFCB Given Report</h2>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p></p>
          <form>
            <div class="row dates">
              <div>
                <label for="date" class="col-form-label">Start Date</label>
                <div class="">
                  <div class="input-group date" id="datepicker">
                    <input type="text" class="form-control" id="date"/>
                    <span class="input-group-append">
                      <span class="input-group-text bg-light d-block">
                        <i class="fa fa-calendar"></i>
                      </span>
                    </span>
                  </div>
                </div>
              </div>
              <div>
                <label for="date1" class="col-form-label">End Date</label>
                <div class="">
                  <div class="input-group date" id="datepicker1">
                    <input type="text" class="form-control" id="date1"/>
                    <span class="input-group-append">
                      <span class="input-group-text bg-light d-block">
                        <i class="fa fa-calendar"></i>
                      </span>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="text-center mt-4">
              <button type="submit" class="btn btn-primary bg-blue border-0">Go</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade bigWidth" id="modal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title fs-5 blue" id="exampleModalLabel">BNI® Chapter Education Units (CEU)</h2>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Member: Manish Juneja

            </p>
            <p>Date: 14/12/2024</p>
          <div class="table-responsive-md">
            <table class="table table-hover">
              <thead class="bg-blue text-white">
                <tr>
                  <th scope="col">Course Title</th>
                  <th scope="col">Credit/Course</th>
                  <th scope="col">Qty Earned</th>
                  <th scope="col">Total Credits Earned Last Week</th>
                </tr>
              </thead>
              <tr valign="middle">
                <td>1 Hour of BNI Podcasts, Webinars, BNI SuccessNet, etc</td>
                <td class="text-center">1</td>
                <td class="text-center"><input type="text" class="form-control"></td>
                <td class="text-center">1</td>
              </tr>
              <tr valign="middle">
                <td>1 Hour of BNI Podcasts, Webinars, BNI SuccessNet, etc</td>
                <td class="text-center">1</td>
                <td class="text-center"><input type="text" class="form-control"></td>
                <td class="text-center">1</td>
              </tr>
              <tr valign="middle">
                <td>1 Hour of BNI Podcasts, Webinars, BNI SuccessNet, etc</td>
                <td class="text-center">1</td>
                <td class="text-center"><input type="text" class="form-control"></td>
                <td class="text-center">1</td>
              </tr>
              <tr valign="middle">
                <td>1 Hour of BNI Podcasts, Webinars, BNI SuccessNet, etc</td>
                <td class="text-center">1</td>
                <td class="text-center"><input type="text" class="form-control"></td>
                <td class="text-center">1</td>
              </tr>
              
            </table>
          </div>
          <div class="mb-2 text-center">
            <button class="bg-blue btn text-white fs-6" type="button">Submit</button>
            <button class="bg-blue btn text-white fs-6" type="button">Close</button>
          </div>
          
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->
 <div class="modal fade" id="modalReferral" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title fs-5 blue" id="exampleModalLabel">BNI® Referral Slip (Be Sure To Announce This At The Meeting)
        </h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Chapter: {{ $user->name }} | Date: <?php echo date("d M Y", time());?></p>
        
        <form id="referralPostForm" class="vrForm pt-2" method="POST">
                  @csrf
                 @method('POST')
          <div class="row">
            <div class="col-md-12 form-group">
              <p>Thank you to*</p>
              <p class="fs-8 mb-1">Please select from dropdown below or search cross chapter</p>
              <div>
              <p>Referral Type </p>
              <div class="d-flex radio-container">
                <p>
                  <input type="radio" onchange="referralTypeChange(1)" id="referralType1" value="inside" class="gallery-radios" name="referraltype" checked="">
                  <label for="referralType1">Tier 1 (inside)</label>
                </p>
                <p class="ms-3">
                  <input type="radio" onchange="referralTypeChange(2)" id="referralType2" value="outside" class="gallery-radios" name="referraltype">
                  <label for="referralType2">Tier 2 (outside)</label>
                </p>
              </div>
              <div id="error-referraltype" class="text-danger"></div>
            </div>
            <div>
              <p>Referral </p>
              <div class="d-flex">
                <select name="referraluser" id="referraluser" placeholder="Select a member from your chapter" class="form-control">
                  <option value="1">Ashu</option>
                  <option value="2">Manoj</option>
                  <option value="3">Jitendar</option>
                </select>
              </div>
              <div id="error-referraluser" class="text-danger"></div>
            </div>
            </div>
            <div>
              <p>Referral Status</p>
              <div class="d-flex radio-container">
                <p>
                  <input type="radio" id="referralstatus1" class="gallery-radios" name="referralstatus" checked="" value='card'>
                  <label for="referralstatus1">Given your card</label>
                </p>
                <p class="ms-3">
                  <input type="radio" id="referralstatus2" class="gallery-radios" name="referralstatus">
                  <label for="referralstatus2" value='call'>Told them you would call</label>
                </p>
              </div>
              <div id="error-referralstatus" class="text-danger"></div>
            </div>
            <div class="col-md-12 form-group">
              <textarea name="referraladdress" id="referraladdress" rows="4" cols="2" class="form-control" placeholder="Address"></textarea>
              <div id="error-referraladdress" class="text-danger"></div>
            </div>
            
            <div class="col-md-12 form-group">
              <input type="text" name="referraltelephone" id="referraltelephone" class="form-control" placeholder="Telephone">
              <div id="error-referraltelephone" class="text-danger"></div>
            </div>
            <div class="col-md-12 form-group">
              <input type="text" name="referralemail" id="referralemail" class="form-control" placeholder="Email">
              <div id="error-referralemail" class="text-danger"></div>
            </div>
            <div class="col-md-12 form-group">
              <textarea name="referralcomment" id="referralcomment" rows="4" cols="2" class="form-control" placeholder="Comments"></textarea>
              <div id="error-referralcomment" class="text-danger"></div>
            </div>
            <div class="mb-2 text-center">
            <div id="referralsuccessMsgPost" class="text-success mt-3" style="display: none;"></div>
              <button class="bg-blue btn text-white fs-6" onclick="referralSubmitForm()" type="button">Submit</button>
              <button class="bg-blue btn text-white fs-6" type="button">Close</button>
            </div>
            
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalReferralView" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title fs-5 blue" id="exampleModalLabel">Chapter : Referrals Given Report
        </h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="table-responsive-md">
          <table class="table table-hover">
            <thead class="table-dark">
              <tr>
                <th scope="col">Date</th>
                <th scope="col">Referral To</th>
                <th scope="col">Referral By</th>
                <th scope="col">Type</th>
                <th scope="col">Status</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Comments</th>                
              </tr>
            </thead>
            @forelse($referralslist as $referrals) 
            <tr>
              <th scope="row"><?php echo date("d M Y", strtotime($referrals->created_at));?></th>
              <td>{{$referrals->received->name}}</td>
              <td>{{$referrals->user->name}}</td>
              <td>{{$referrals->type}}</td>
              <td>{{$referrals->referralstatus==1?'Inside':'Outside'}}</td>
              <td>{{$referrals->email}}</td>
              <td>{{$referrals->telephone}}</td>
              <td>{{$referrals->comments}}</td>
            </tr>
            @empty
            <tr>
            <td colspa='8'>No data</td>
            </tr>
            @endforelse
            
            
          </table>
        </div>
        
        
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalGetReferralView" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title fs-5 blue" id="exampleModalLabel">Chapter : Referrals Given Report
        </h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="table-responsive-md">
          <table class="table table-hover">
            <thead class="table-dark">
              <tr>
                <th scope="col">Date</th>
                <th scope="col">Referral Name</th>
                <th scope="col">Type</th>
                <th scope="col">Status</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Comments</th>                
              </tr>
            </thead>
            @forelse($receivedReferralslist as $getreferrals) 
            <tr>
              <th scope="row"><?php echo date("d M Y", strtotime($getreferrals->created_at));?></th>
              <td>{{$getreferrals->user->name}}</td>
              <td>{{$getreferrals->type}}</td>
              <td>{{$getreferrals->referralstatus==1?'Inside':'Outside'}}</td>
              <td>{{$getreferrals->email}}</td>
              <td>{{$getreferrals->telephone}}</td>
              <td>{{$getreferrals->comments}}</td>
            </tr>
            @empty
            <tr>
            <td colspa='8'>No data</td>
            </tr>
            @endforelse
            
            
          </table>
        </div>
        
        
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalTyfcbReferralView" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title fs-5 blue" id="exampleModalLabel">Chapter : Referrals Given Report
        </h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="table-responsive-md">
          <table class="table table-hover">
            <thead class="table-dark">
              <tr>
                <th scope="col">Date</th>
                <th scope="col">Thank you to</th>
                <th scope="col">Referral By</th>
                <th scope="col">Amount</th>
                <th scope="col">Business Type</th>
                <th scope="col">Types</th>
                <th scope="col">Comments</th>                
              </tr>
            </thead>
            @$subtotal=0
            @forelse($tyfcbreferralslist as $tyfcbreferrals) 
            <tr>
              <th scope="row"><?php echo date("d M Y", strtotime($tyfcbreferrals->created_at));?></th>
              <td>{{$tyfcbreferrals->received->name}}</td>
              <td>{{$tyfcbreferrals->user->name}}</td>
              <td>{{$tyfcbreferrals->amount}}</td>
              <td>{{$tyfcbreferrals->businesstype}}</td>
              <td>{{$tyfcbreferrals->type}}</td>
              <td>{{$tyfcbreferrals->comments}}</td>
            </tr>
            @$subtotal +=$tyfcbreferrals->amount
            @empty
            <tr>
            <td colspa='8'>No data</td>
            </tr>
            @endforelse
            
            
          </table>
        </div>
        
        
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalOnetooneReferral" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title fs-5 blue" id="exampleModalLabel">BNI® One-to-One follow up
        </h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Chapter: {{ $user->name }} | Date: <?php echo date("d M Y", time());?></p>
        
        <form id="oneReferralPostForm" class="vrForm pt-2" method="POST">
                  @csrf
                 @method('POST')
          <div class="row">
            <div class="col-md-12 form-group">
              <!-- <p>Thank you to*</p> -->
              <p class="fs-8 mb-1">Please select from dropdown below or search cross chapter</p>
              <div>
              <p>Referral </p>
              <div class="d-flex">
                <select name="onereferraluser" id="onereferraluser" placeholder="Select a member from your chapter" class="form-control">
                  <option value="1">Ashu</option>
                  <option value="2">Manoj</option>
                  <option value="3">Jitendar</option>
                </select>
              </div>
              <div id="error-onereferraluser" class="text-danger"></div>
            </div>
            <div class="col-md-12 form-group">
              <input type="text" name="onereferrallocation" id="onereferrallocation" class="form-control" placeholder="Location">
              <div id="error-onereferrallocation" class="text-danger"></div>
            </div>
            <div class="col-md-12 form-group">
              <textarea name="onereferralconversation" id="onereferralconversation" rows="4" cols="2" class="form-control" placeholder="Topics of Conversation"></textarea>
              <div id="error-onereferralconversation" class="text-danger"></div>
            </div>
            <div class="col-md-12 form-group">
              <input type="date" name="onereferraldate" id="onereferraldate" class="form-control" placeholder="Date">
              <div id="error-onereferraldate" class="text-danger"></div>
            </div>
              <!-- <div>
              <p>Referral Type </p>
              <div class="d-flex radio-container">
                <p>
                  <input type="radio" onchange="referralTypeChange(1)" id="referralType1" value="inside" class="gallery-radios" name="referraltype" checked="">
                  <label for="referralType1">Tier 1 (inside)</label>
                </p>
                <p class="ms-3">
                  <input type="radio" onchange="referralTypeChange(2)" id="referralType2" value="outside" class="gallery-radios" name="referraltype">
                  <label for="referralType2">Tier 2 (outside)</label>
                </p>
              </div>
              <div id="error-referraltype" class="text-danger"></div>
            </div>-->
           
            </div> 
            <!-- <div>
              <p>Referral Status</p>
              <div class="d-flex radio-container">
                <p>
                  <input type="radio" id="referralstatus1" class="gallery-radios" name="referralstatus" checked="" value='card'>
                  <label for="referralstatus1">Given your card</label>
                </p>
                <p class="ms-3">
                  <input type="radio" id="referralstatus2" class="gallery-radios" name="referralstatus">
                  <label for="referralstatus2" value='call'>Told them you would call</label>
                </p>
              </div>
              <div id="error-referralstatus" class="text-danger"></div>
            </div> -->
            <!-- <div class="col-md-12 form-group">
              <textarea name="referraladdress" id="referraladdress" rows="4" cols="2" class="form-control" placeholder="Address"></textarea>
              <div id="error-referraladdress" class="text-danger"></div>
            </div>
            
            <div class="col-md-12 form-group">
              <input type="text" name="referraltelephone" id="referraltelephone" class="form-control" placeholder="Telephone">
              <div id="error-referraltelephone" class="text-danger"></div>
            </div>
            <div class="col-md-12 form-group">
              <input type="text" name="referralemail" id="referralemail" class="form-control" placeholder="Email">
              <div id="error-referralemail" class="text-danger"></div>
            </div>
            <div class="col-md-12 form-group">
              <textarea name="referralcomment" id="referralcomment" rows="4" cols="2" class="form-control" placeholder="Comments"></textarea>
              <div id="error-referralcomment" class="text-danger"></div>
            </div> -->
            <div class="mb-2 text-center">
            <div id="onereferralsuccessMsgPost" class="text-success mt-3" style="display: none;"></div>
              <button class="bg-blue btn text-white fs-6" onclick="onereferralSubmitForm()" type="button">Submit</button>
              <button class="bg-blue btn text-white fs-6" type="button">Close</button>
            </div>
            
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalOneReferralView" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title fs-5 blue" id="exampleModalLabel">Chapter : Referrals Given Report
        </h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="table-responsive-md">
          <table class="table table-hover">
            <thead class="table-dark">
              <tr>
                <th scope="col">Date</th>
                <th scope="col">Referral To</th>
                <th scope="col">Referral By</th>
                <th scope="col">Location</th>
                <th scope="col">Conversation</th>               
              </tr>
            </thead>
            @forelse($onereferralslists as $onereferralslist) 
            <tr>
              <th scope="row"><?php echo date("d M Y", strtotime($onereferralslist->start_date));?></th>
              <td>{{$onereferralslist->received->name}}</td>
              <td>{{$onereferralslist->user->name}}</td>
              <td>{{$onereferralslist->location}}</td>
              <td>{{$onereferralslist->conversation}}</td>
            </tr>
            @empty
            <tr>
            <td colspa='8'>No data</td>
            </tr>
            @endforelse
            
            
          </table>
        </div>
        
        
      </div>
    </div>
  </div>
</div>
@section('customJs')
<script src="{{ asset('front-assets/js/chart.min.js') }}"></script>
  <script>
    function tyfcbreferralSubmitForm() {
        // Clear previous error messages
        $('.text-danger').text('');
        var formData = new FormData(document.getElementById("tyfcbreferralPostForm"));
        $.ajax({
            url: "{{ route('user.tyfcbpostReferral') }}",
            method: "POST",
            data: formData,
            async: true,
            processData: false,
            contentType: false,
            success: function(response) {
                

                $('#tyfbreferralsuccessMsgPost').text(response.message).show();
                $('#tyfcbreferralPostForm')[0].reset();
                
                // setTimeout(function () {
                //       window.location.href = "{{ route('user.profile') }}"
			          //     }, 1000);
                
                setTimeout(() => {
                    $('#tyfcbreferralsuccessMsgPost').fadeOut();
                }, 3000);
            },
            error: function(xhr) {
                // console.log(xhr)
                // alert("test")
                // $('#referralsuccessMsgPost').text(xhr.responseJSON.message).css('color', 'red').show();
                if (xhr.responseJSON.errors) {
                    let errors = xhr.responseJSON.errors;
                    for (let field in errors) {
                        console.log(field)
                        $(`#error-${field}`).text(errors[field][0]);
                    }
                } else {
                    $('#tyfcbreferralsuccessMsgPost').text("An error occurred. Please try again.").css('color', 'red').show();
                }
            }
        });
    }
    function onereferralSubmitForm() {
        // Clear previous error messages
        $('.text-danger').text('');
        var formData = new FormData(document.getElementById("oneReferralPostForm"));
        $.ajax({
            url: "{{ route('user.onepostReferral') }}",
            method: "POST",
            data: formData,
            async: true,
            processData: false,
            contentType: false,
            success: function(response) {
                

                $('#onereferralsuccessMsgPost').text(response.message).show();
                $('#onereferralPostForm')[0].reset();
                
                // setTimeout(function () {
                //       window.location.href = "{{ route('user.profile') }}"
			          //     }, 1000);
                
                setTimeout(() => {
                    $('#onereferralsuccessMsgPost').fadeOut();
                }, 3000);
            },
            error: function(xhr) {
                // console.log(xhr)
                // alert("test")
                // $('#referralsuccessMsgPost').text(xhr.responseJSON.message).css('color', 'red').show();
                if (xhr.responseJSON.errors) {
                    let errors = xhr.responseJSON.errors;
                    for (let field in errors) {
                        console.log(field)
                        $(`#error-${field}`).text(errors[field][0]);
                    }
                } else {
                    $('#onereferralsuccessMsgPost').text("An error occurred. Please try again.").css('color', 'red').show();
                }
            }
        });
    }
    function referralSubmitForm() {
        // Clear previous error messages
        $('.text-danger').text('');
        var formData = new FormData(document.getElementById("referralPostForm"));
        $.ajax({
            url: "{{ route('user.postReferral') }}",
            method: "POST",
            data: formData,
            async: true,
            processData: false,
            contentType: false,
            success: function(response) {
                

                $('#referralsuccessMsgPost').text(response.message).show();
                $('#referralPostForm')[0].reset();
                
                // setTimeout(function () {
                //       window.location.href = "{{ route('user.profile') }}"
			          //     }, 1000);
                
                setTimeout(() => {
                    $('#referralsuccessMsgPost').fadeOut();
                }, 3000);
            },
            error: function(xhr) {
                // console.log(xhr)
                // alert("test")
                // $('#referralsuccessMsgPost').text(xhr.responseJSON.message).css('color', 'red').show();
                if (xhr.responseJSON.errors) {
                    let errors = xhr.responseJSON.errors;
                    for (let field in errors) {
                        console.log(field)
                        $(`#error-${field}`).text(errors[field][0]);
                    }
                } else {
                    $('#referralsuccessMsgPost').text("An error occurred. Please try again.").css('color', 'red').show();
                }
            }
        });
    }
    
    onereferralTypeChange(2)
    function onereferralTypeChange(type){
      // alert("tets")
      var reftype=$("#referralType"+type).val();
      // console.log(reftype) 
      $.ajax({
            url: "{{ route('user.userListReferralType') }}",
            method: "POST",
            data: {type:reftype},
            // async: true,
            // processData: false,
            // contentType: false,
            dataType: "json",
            headers: {
            'X-CSRF-TOKEN': '{{csrf_token()}}'
            },
            // headers : {
            // 'CSRFToken' : getCSRFTokenValue()
            // }
            success: function(response) {
                
              var cityname = '<option value=""></option>';
            for (var i = 0; i < response.userlist.length; i++) {
                cityname += '<option value="' + response.userlist[i].id + '">' + response.userlist[i].name + '</option>'
            }
            $('#onereferraluser').html(cityname);
                
            },
            error: function(xhr) {
              
            }
        });
    }
    referralTypeChange(1)
    function referralTypeChange(type){
      // alert("tets")
      var reftype=$("#referralType"+type).val();
      // console.log(reftype) 
      $.ajax({
            url: "{{ route('user.userListReferralType') }}",
            method: "POST",
            data: {type:reftype},
            // async: true,
            // processData: false,
            // contentType: false,
            dataType: "json",
            headers: {
            'X-CSRF-TOKEN': '{{csrf_token()}}'
            },
            // headers : {
            // 'CSRFToken' : getCSRFTokenValue()
            // }
            success: function(response) {
                
              var cityname = '<option value=""></option>';
            for (var i = 0; i < response.userlist.length; i++) {
                cityname += '<option value="' + response.userlist[i].id + '">' + response.userlist[i].name + '</option>'
            }
            $('#referraluser').html(cityname);
                
            },
            error: function(xhr) {
              
            }
        });
    }
    var lineChart = document.getElementById("lineChart").getContext("2d");
    var myLineChart = new Chart(lineChart, {
        type: "line",
        data: {
          labels: [
            "Jan",
            "Feb",
            "Mar",
            "Apr",
            "May",
            "Jun",
            "Jul",
            "Aug",
            "Sep",
            "Oct",
            "Nov",
            "Dec",
          ],
          datasets: [
            {
              label: "",
              borderColor: "#003386",
              pointBorderColor: "#FFF",
              pointBackgroundColor: "#fcc31c",
              pointBorderWidth: 2,
              pointHoverRadius: 6,
              pointHoverBorderWidth: 1,
              pointRadius: 4,
              backgroundColor: "transparent",
              fill: true,
              borderWidth: 4,
              data: [
                0, 280, 330, 450, 630, 653, 780, 834, 568, 610, 700, 900,
              ],
            },
          ],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          legend: {
            position: "bottom",
            labels: {
              padding: 10,
              fontColor: "#1d7af3",
            },
          },
          tooltips: {
            bodySpacing: 4,
            mode: "nearest",
            intersect: 0,
            position: "nearest",
            xPadding: 10,
            yPadding: 10,
            caretPadding: 10,
          },
          layout: {
            padding: { left: 15, right: 15, top: 15, bottom: 15 },
          },
        },
      });
  </script>
  <script>
    $('#searchInput').on('keyup', function() {
        let query = $(this).val();

        // Only perform search when input has 5 or more characters
        if (query.length >= 3) {
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
@endsection   