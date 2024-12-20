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
          
          <div class="row">
          <div class="col-md-8">
            <div class="whiteBox bg-white p-4 mt-4">
              <div class="d-flex mb-3">
                <div class="d-flex align-items-center">
                  <div class="pe-3">
                    <img src="{{ asset('front-assets/icons/in.png') }}" alt="">
                  </div>
                  <div>
                    <p class="mb-0"><strong>Linkedin</strong></p>
                    <p class="mb-0">Promoted</p>
                  </div>
                </div>
              </div>
              <p>Update you job preferences to help recruiters find you for the right oppurtunities. </p>
              <div>
                <img src="{{ asset('front-assets/images/linkedin-banner.png') }}" alt="">
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

            <div class="whiteBox bg-white p-4 mt-4">
              <div class="d-flex mb-3">
                <div class="d-flex align-items-center">
                  <div class="pe-3">
                    <img src="{{ asset('front-assets/icons/in.png') }}" alt="">
                  </div>
                  <div>
                    <p class="mb-0"><strong>Linkedin</strong></p>
                    <p class="mb-0">Promoted</p>
                  </div>
                </div>
              </div>
              <p>Update you job preferences to help recruiters find you for the right oppurtunities. </p>
              <div>
                <img src="{{ asset('front-assets/images/linkedin-banner.png') }}" alt="">
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

            <div class="whiteBox bg-white p-4 mt-4">
              <div class="d-flex mb-3">
                <div class="d-flex align-items-center">
                  <div class="pe-3">
                    <img src="{{ asset('front-assets/icons/in.png') }}" alt="">
                  </div>
                  <div>
                    <p class="mb-0"><strong>Linkedin</strong></p>
                    <p class="mb-0">Promoted</p>
                  </div>
                </div>
              </div>
              <p>Update you job preferences to help recruiters find you for the right oppurtunities. </p>
              <div>
                <img src="{{ asset('front-assets/images/linkedin-banner.png') }}" alt="">
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
                  <button class="bg-blue btn text-white fs-8" type="button">My Personal Participation Report</button>
                </div>
              </div>
              <div class="whiteBox bg-white p-4 mt-4">
                <h6 class="blue poppins-bold pb-2 fs-6 fw-600">Referrals Received: </h6>
                <div class="blue poppins-bold fs-6 fw-600 Revenue-number">
                  <img src="images/ref-rec.png" alt=""> 
                  <p class="blue poppins-bold fs-4">1365852</p>
                </div>
                <div class="mb-2">
                  <button class="bg-blue btn text-white fs-8" data-bs-toggle="modal" data-bs-target="#modal1" type="button">Track Online</button>
                </div>
                
              </div>
              <div class="whiteBox bg-white p-4 mt-4">
                <h6 class="blue poppins-bold pb-2 fs-6 fw-600">Referrals Given: </h6>
                <div class="blue poppins-bold fs-6 fw-600 Revenue-number">
                  <img src="images/ref-given.png" alt=""> 
                  <p class="blue poppins-bold fs-4">1765852</p>
                </div>
                <div class="mb-2">
                  <button class="bg-blue btn text-white fs-8" type="button">Submit</button>
                  <button class="bg-blue btn text-white fs-8" type="button">Review</button>
                </div>
                
              </div>
              <div class="whiteBox bg-white p-4 mt-4">
                <h6 class="blue poppins-bold pb-2 fs-6 fw-600">TYFCB Given: </h6>
                <div class="blue poppins-bold fs-6 fw-600 Revenue-number">
                  <img src="images/tyfcb.png" alt=""> 
                  <p class="blue poppins-bold fs-4">1765852</p>
                </div>
                <div class="mb-2">
                  <button class="bg-blue btn text-white fs-8" data-bs-toggle="modal" data-bs-target="#modal2" type="button">Submit</button>
                  <button class="bg-blue btn text-white fs-8" data-bs-toggle="modal" data-bs-target="#modal3" type="button">Review</button>
                </div>
                
              </div>
              <div class="whiteBox bg-white p-4 mt-4">
                <h6 class="blue poppins-bold pb-2 fs-6 fw-600">One to Ones: </h6>
                <div class="blue poppins-bold fs-6 fw-600 Revenue-number">
                  <img src="images/one-to-one.png" alt=""> 
                  <p class="blue poppins-bold fs-4">1765852</p>
                </div>
                <div class="mb-2">
                  <button class="bg-blue btn text-white fs-8" type="button">Submit</button>
                  <button class="bg-blue btn text-white fs-8" type="button">Review</button>
                </div>
                
              </div>
              <div class="whiteBox bg-white p-4 mt-4">
                <h6 class="blue poppins-bold pb-2 fs-6 fw-600">Visitor: </h6>
                <div class="blue poppins-bold fs-6 fw-600 Revenue-number">
                  <img src="images/visitor.png" alt=""> 
                  <p class="blue poppins-bold fs-4">1765852</p>
                </div>
                <div class="mb-2">
                  <button class="bg-blue btn text-white fs-8" type="button">Visitor Portal</button>
                </div>
                
              </div>
              <div class="whiteBox bg-white p-4 mt-4">
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
@endsection
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
                <select name="" id="" placeholder="Select a member from your chapter" class="form-control">
                  <option value="1">Ashu</option>
                  <option value="2">Manoj</option>
                  <option value="3">Jitendar</option>
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
@section('customJs')
<script src="{{ asset('front-assets/js/chart.min.js') }}"></script>
  <script>
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