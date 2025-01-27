@extends('front.layouts.app')
@section('content') 
@php
                $subtotal = 0;
                @$recievesubtotal=0;
            @endphp
           
            @forelse($tyfcbreferralslist as $tyfcbreferrals) 
            @php
                $subtotal += (float)$tyfcbreferrals->amount;
            @endphp
            @if($tyfcbreferrals->received->id==auth()->user()->id)
            @php
            @$recievesubtotal += (float) $tyfcbreferrals->amount;
            @endphp
            @endif
            @empty
            @endforelse
      <div class="container">
        <div class="page-inner">
          <div class="dashboard-slider">
            <div class="whiteBox bg-white p-4">
              <div class="d-flex justify-content-between align-items-center flex-wrap">
                <h4 class="blue poppins-bold mb-0">IBAL® Innovations</h4>
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
                      <td>{{$recievesubtotal}}</td>
                      <td>{{$recievesubtotal}}</td>
                    </tr>
                    <tr>
                      <td>Referrals Received:</td>
                      <td>{{count($receivedReferralslist)}}</td>
                      <td>{{count($receivedReferralslist)}}</td>
                    </tr>
                    <tr>
                      <td>TYFCB Given:</td>
                      <td>{{$subtotal}}</td>
                      <td>{{$subtotal}}</td>
                    </tr>
                    <tr>
                      <td>Referrals Given:</td>
                      <td>{{count($referralslist)}}</td>
                      <td>{{count($referralslist)}}</td>
                    </tr>
                    <tr>
                      <td>Visitor:</td>
                      <td>{{count($visitorlist)}}</td>
                      <td>{{count($visitorlist)}}</td>
                    </tr>
                    <tr>
                      <td>One-to-Ones:</td>
                      <td>{{count($onereferralslists)}}</td>
                      <td>{{count($onereferralslists)}}</td>
                    </tr>
                    <!-- <tr>
                      <td>CEUs:</td>
                      <td>13</td>
                      <td>22</td>
                    </tr> -->
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
            <h4 class="blue poppins-bold mb-0">Reports</h4>
            <div class="accordion mt-4 report-listing" id="reportAccordion">
              <!-- Alliance Roster Report -->
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  Referrals Given Report
                  </button>
                  
                </h2>
                  
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#reportAccordion">
                  <div class="accordion-body">
                  <div class="tracksubmitdiv">
                    <form id="tracksubmitform" class="vrForm pt-4 row">
                      <div class="col-md-4 form-group">
                        <input type="datetime-local" name="startdate" id="startdate"   class="form-control" placeholder="Start Date" required>
                        <div id="error-startdate"></div>
                      </div>
                      <div class="col-md-4 form-group">
                        <input type="datetime-local" name="enddate" id="enddate"   class="form-control" placeholder="End Start" required>
                        <div id="error-enddate"></div>
                      </div>
                      
                      <div class="col-md-4 form-group">
                        <button type="button" onclick="trackSubmitFun()" class="btn btn-primary bg-blue">
                            Search
                        </button>
                      </div>
                    </form>
                  </div>
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
            
              <!-- Leadership Report -->
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  Referrals Received Report
                  </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#reportAccordion">
                  <div class="accordion-body">
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
            
              <!-- Member Event Report -->
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  Thank You Referrals Report
                  </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#reportAccordion">
                  <div class="accordion-body">
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
                        @php
                            $subtotal = 0;
                            @$recievesubtotal=0;
                        @endphp
                      
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
                        @php
                            $subtotal += (float) $tyfcbreferrals->amount;
                        @endphp
                        @if($tyfcbreferrals->received->id==auth()->user()->id)
                        @php
                        @$recievesubtotal += (float) $tyfcbreferrals->amount;
                        @endphp
                        @endif
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
            
              <!-- Add more reports following the same structure -->
            </div>
            
            
          </div>  

        </div>
@endsection

@section('customJs')
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