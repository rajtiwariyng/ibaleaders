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
          
          @forelse($posts as $post) 
          <div class="whiteBox bg-white p-4 mt-4">
            <div class="d-flex mb-3">
              <div class="d-flex align-items-center">
                <div class="pe-3">
                  <img src="{{ $post->profile_image ? asset('storage/' . $post->profile_image) : asset('front-assets/images/profile2.jpg') }}" alt="{{ $post->title }}">
                </div>
                <div>
                  <p class="mb-0"><strong>{{ $post->title }}</strong></p>
                  <p class="mb-0">{{ \Carbon\Carbon::parse($post->created_at)->format('d M Y') }}</p>
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
        </div>
@endsection

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