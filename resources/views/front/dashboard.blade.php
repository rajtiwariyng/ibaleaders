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

          <div class="whiteBox bg-white p-4 mt-4">
            <h3 class="blue poppins-bold">Submit and Track</h3>

            <div class="d-flex flex-wrap sbmtTrck">
              <ul>
                <li class="poppins-semibold">Submit</li>
                <li>Gratitude for Business achieved slips-same as BNI
                </li>
                <li>Referral Slips-same as BNI</li>
                <li>Direct Meeting Slips-same as BNI</li>
                <li>Virtual Direct Meeting Slips</li>
                <li>Event Slips-event title and event date subfield.</li>
              </ul>
              <ul>
                <li class="poppins-semibold">Track</li>
                <li>Gratitude for Business achieved slips-same as BNI
                </li>
                <li>Referral Slips-same as BNI</li>
                <li>Direct Meeting Slips-same as BNI</li>
                <li>Virtual Direct Meeting Slips</li>
                <li>Event Slips-event title and event date subfield.</li>
              </ul>
            </div>
          </div>
          
          <div class="whiteBox bg-white p-4 mt-4">
            <h3 class="blue poppins-bold">Visitor Registration</h3>

            <form id="visitorForm" class="vrForm pt-4">
        @csrf
        <div class="row">
            <div class="col-md-6 form-group">
                <input type="text" name="first_name" class="form-control" placeholder="First Name" required>
                <div class="text-danger" id="error-first_name"></div>
            </div>
            <div class="col-md-6 form-group">
                <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
                <div class="text-danger" id="error-last_name"></div>
            </div>
            <div class="col-md-6 form-group">
                <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                <div class="text-danger" id="error-email"></div>
            </div>
            <div class="col-md-6 form-group">
                <input type="text" name="mobile_number" class="form-control" placeholder="Mobile Number" required>
                <div class="text-danger" id="error-mobile_number"></div>
            </div>
            <div class="col-md-6 form-group">
                <input type="text" name="company_name" class="form-control" placeholder="Company Name">
                <div class="text-danger" id="error-company_name"></div>
            </div>
            <div class="col-md-6 form-group">
                <input type="text" name="city" class="form-control" placeholder="City">
                <div class="text-danger" id="error-city"></div>
            </div>
            <div class="col-md-6 form-group">
                <textarea name="address" rows="4" cols="2" class="form-control" placeholder="Address"></textarea>
                <div class="text-danger" id="error-address"></div>
            </div>
            <div class="col-md-6 form-group">
                <input type="text" name="state_country_province" class="form-control" placeholder="State/Country/Province">
                <div class="text-danger" id="error-state_country_province"></div>
                <input type="text" name="post_code" class="form-control mt-2" placeholder="Post Code">
                <div class="text-danger" id="error-post_code"></div>
            </div>
        </div>
        <div class="text-center sbmtBtn">
            <button type="button" onclick="submitForm()" class="btn btn-primary">
                Submit
            </button>
        </div>
        <div id="successMessage" class="text-success mt-3" style="display: none;"></div>
    </form>
          </div>

          <div class="row twoCol flex-wrap">
            <div class="whiteBox bg-white p-4 mt-4 ms-2" >
              <h3 class="blue poppins-bold">Email My Alliance </h3>
              <div class="card-list">
              @forelse ($connections as $connection)
                <div class="item-list">
                  <div class="avatar">
<<<<<<< HEAD
                    <img src="{{ $connection->profile_image ? asset('storage/' . $connection->profile_image) : asset('front-assets/images/default.jpg') }}" alt="{{ $connection->name }}" class="avatar-img rounded-circle">
=======
                    <img src="{{ $connection->profile_image ?? asset('front-assets/images/default.jpg') }}" alt="{{ $connection->name }}" class="avatar-img rounded-circle">
>>>>>>> a8445b326f46709240e0003560090eb0de4ee731
                  </div>
                  <div class="info-user ms-3">
                    <div class="username">{{ $connection->name }}</div>
                    <div class="status">{{ $connection->email ?? 'N/A' }}</div>
                  </div>
                </div>
                @empty
                <div>No Events found.</div>
                @endforelse
                
              </div>
            </div>
            <!-- <div class="whiteBox bg-white p-4 mt-4 me-2">
              <h3 class="blue poppins-bold">About Us</h3>
              <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Facere iusto enim eius, adipisci illo quidem vitae, architecto recusandae voluptatibus molestiae explicabo possimus omnis velit consequuntur nulla debitis maxime veritatis in, vero alias sit tempora. Nostrum at, accusamus sunt iusto sapiente eligendi ipsa perspiciatis in dolorum. Eligendi, ipsam sequi ut nostrum soluta ad omnis facilis harum similique quis earum incidunt sunt nisi, molestias numquam enim deleniti aut, odio unde. Ullam obcaecati, reiciendis quod voluptas architecto sed enim eius quia. Deleniti reprehenderit ex eveniet numquam nesciunt, debitis voluptatum sequi aut aliquid consequuntur! Rerum obcaecati ad soluta unde distinctio. Nesciunt veniam magnam laudantium.</p>
            </div> -->
          </div>

          <div class="master-slider-container mt-5">
            <h3 class="blue poppins-bold">Master IBAL</h3>
            <div class="master-slider">
              <div class="item">
                <div>
                  <img src="{{ asset('front-assets/images/slider.png') }}" alt="">
                </div>
                <div class="caption">
                  <div>
                    <h5>Education Videos</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
                  </div>
                  <div class="play-btn">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                      <i class="fa-solid fa-play"></i>
                    </button>
                  </div>
                </div>
              </div>
              <div class="item">
                <div>
                  <img src="{{ asset('front-assets/images/slider.png') }}" alt="">
                </div>
                <div class="caption">
                  <div>
                    <h5>Education Videos</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
                  </div>
                  <div class="play-btn">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                      <i class="fa-solid fa-play"></i>
                    </button>
                  </div>
                </div>
              </div>
              <div class="item">
                <div>
                  <img src="{{ asset('front-assets/images/slider.png') }}" alt="">
                </div>
                <div class="caption">
                  <div>
                    <h5>Education Videos</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
                  </div>
                  <div class="play-btn">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                      <i class="fa-solid fa-play"></i>
                    </button>
                  </div>
                </div>
              </div>
              <div class="item">
                <div>
                  <img src="{{ asset('front-assets/images/slider.png') }}" alt="">
                </div>
                <div class="caption">
                  <div>
                    <h5>Education Videos</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
                  </div>
                  <div class="play-btn">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                      <i class="fa-solid fa-play"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection

@section('customJs')
<script>
    function submitForm() {
        // Clear previous error messages
        $('.text-danger').text('');
        
        $.ajax({
            url: "{{ route('visitor.register') }}",
            method: "POST",
            data: $('#visitorForm').serialize(),
            success: function(response) {
                $('#successMessage').text(response.success).show();
                $('#visitorForm')[0].reset();
                
                setTimeout(() => {
                    $('#successMessage').fadeOut();
                }, 3000);
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    for (let field in errors) {
                        $(`#error-${field}`).text(errors[field][0]);
                    }
                } else {
                    $('#successMessage').text("An error occurred. Please try again.").css('color', 'red').show();
                }
            }
        });
    }
</script>
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
@endsection
        