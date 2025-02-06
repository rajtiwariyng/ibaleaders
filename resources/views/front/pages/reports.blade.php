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
                  Alliance Roster Reports
                  </button>
                  
                </h2>
                  
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#reportAccordion">
                  <div class="accordion-body">
                  <div class="tracksubmitdiv">
                    <form id="tracksubmitform" class="vrForm pt-4 row">
                      <div class="col-md-4 form-group">
                        <input type="datetime-local" name="startdatealliance" id="startdatealliance"   class="form-control" placeholder="Start Date" required>
                        <div id="error-startdate"></div>
                      </div>
                      <div class="col-md-4 form-group">
                        <input type="datetime-local" name="enddatealliance" id="enddatealliance"   class="form-control" placeholder="End Start" required>
                        <div id="error-enddate"></div>
                      </div>
                      
                      <div class="col-md-4 form-group">
                        <button type="button" onclick="AllianceRosterReportsFun()" class="btn btn-primary bg-blue">
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
                          <th scope="col">Leader's Name</th>
                          <th scope="col">Category</th>
                          <th scope="col">Company Name</th>
                          <th scope="col">LVP Score</th>
                          <th scope="col">RG</th>
                          <th scope="col">RR</th> 
                          <th scope="col">V</th>
                          <th scope="col">GBR</th>
                          <th scope="col">BG</th>                           
                          <th scope="col">Status</th>               
                        </tr>
                      </thead>
                      <tbody id="alliancerosterreport">
                      @forelse($alliance_roster_report as $alliance_roster_reportlist) 
                      <tr>
                        <th scope="row"><?php echo date("d M Y", strtotime($alliance_roster_reportlist->start_date));?></th>
                        <td>{{$alliance_roster_reportlist->leader_name}}</td>
                        <td>{{$alliance_roster_reportlist->category}}</td>                        
                        <td>{{$alliance_roster_reportlist->company_name}}</td>
                        <td>{{$alliance_roster_reportlist->lvp_score}}</td>
                        <td>{{$alliance_roster_reportlist->rg}}</td>
                        <td>{{$alliance_roster_reportlist->rr}}</td>
                        <td>{{$alliance_roster_reportlist->v}}</td>
                        <td>{{$alliance_roster_reportlist->gbr}}</td>                        
                        <td>{{$alliance_roster_reportlist->bg}}</td>
                        <td>{{$alliance_roster_reportlist->status==1?'Active':'Deactive'}}</td>
                      </tr>
                      @empty
                      <tr>
                      <td colspa='8'>No data</td>
                      </tr>
                      @endforelse
                      </tbody>
                      
                      
                    </table>
                  </div>
                  </div>
                </div>
              </div>
            
              <!-- Leadership Report -->
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  Leadership Report
                  </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#reportAccordion">
                  <div class="accordion-body">
                  <div class="table-responsive-md">
                    <table class="table table-hover">
                      <thead class="table-dark">
                        <tr>
                          <th scope="col">Date</th>
                          <th scope="col">Leader's Name</th>
                          <th scope="col">P</th>
                          <th scope="col">A</th>
                          <th scope="col">L</th>
                          <th scope="col">M</th>
                          <th scope="col">S</th>
                          <th scope="col">RG</th>
                          <th scope="col">RR</th>
                          <th scope="col">BG</th>
                          <th scope="col">GBR</th>
                          <th scope="col">V</th>
                          <th scope="col">DM</th>
                          <th scope="col">Events</th>
                          <th scope="col">T</th>
                          <th scope="col">Status</th>               
                        </tr>
                      </thead>
                      @forelse($leadership_report as $leadership_reportlist) 
                      <tr>
                        <th scope="row"><?php echo date("d M Y", strtotime($leadership_reportlist->start_date));?></th>
                        <td>{{$leadership_reportlist->p}}</td>
                        <td>{{$leadership_reportlist->a}}</td>
                        <td>{{$leadership_reportlist->l}}</td>
                        <td>{{$leadership_reportlist->m}}</td>
                        <td>{{$leadership_reportlist->s}}</td>
                        <td>{{$leadership_reportlist->rg}}</td>
                        <td>{{$leadership_reportlist->rr}}</td>
                        <td>{{$leadership_reportlist->bg}}</td>
                        <td>{{$leadership_reportlist->gbr}}</td>
                        <td>{{$leadership_reportlist->v}}</td>
                        <td>{{$leadership_reportlist->dm}}</td>
                        <td>{{$leadership_reportlist->events}}</td>
                        <td>{{$leadership_reportlist->t}}</td>
                        <td>{{$leadership_reportlist->status==1?'Inside':'Outside'}}</td>
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
                  Event Report
                  </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#reportAccordion">
                  <div class="accordion-body">
                  <div class="table-responsive-md">
                      <table class="table table-hover">
                        <thead class="table-dark">
                          <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Leader's Name</th>
                            <th scope="col">Date of Event</th>
                            <th scope="col">Event Name</th>
                            <th scope="col">Email ID</th>
                            <th scope="col">Status</th>               
                          </tr>
                        </thead>
                        @forelse($event_report as $event_reportlist) 
                        <tr>
                          <th scope="row"><?php echo date("d M Y", strtotime($event_reportlist->start_date));?></th>
                          <td>{{$event_reportlist->leader_name}}</td>
                          <td>{{$event_reportlist->date_of_event}}</td>
                          <td>{{$event_reportlist->event_name}}</td>
                          <td>{{$event_reportlist->email_id}}</td>
                          <td>{{$event_reportlist->status==1?'Inside':'Outside'}}</td>
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
              <!-- <div class="accordion-item">
                <h2 class="accordion-header" id="headingFour">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                  Event Report
                  </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#reportAccordion">
                  <div class="accordion-body">
                  <div class="table-responsive-md">
                      <table class="table table-hover">
                        <thead class="table-dark">
                          <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Leader's Name</th>
                            <th scope="col">Date of Event</th>
                            <th scope="col">Event Name</th>
                            <th scope="col">Email ID</th>
                            <th scope="col">Status</th>               
                          </tr>
                        </thead>
                        @forelse($event_report as $event_reportlist) 
                        <tr>
                          <th scope="row"><?php echo date("d M Y", strtotime($event_reportlist->start_date));?></th>
                          <td>{{$event_reportlist->leader_name}}</td>
                          <td>{{$event_reportlist->date_of_event}}</td>
                          <td>{{$event_reportlist->event_name}}</td>
                          <td>{{$event_reportlist->email_id}}</td>
                          <td>{{$event_reportlist->status==1?'Inside':'Outside'}}</td>
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
              </div> -->
              <!-- Member Event Report -->
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingFour">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                  Leadership Dues Report
                  </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#reportAccordion">
                  <div class="accordion-body">
                  <div class="table-responsive-md">
                      <table class="table table-hover">
                        <thead class="table-dark">
                          <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Leader's Name</th>
                            <th scope="col">Category</th>
                            <th scope="col">Role</th>
                            <th scope="col">Membership Status</th>
                            <th scope="col">Renewal Date</th>
                            <th scope="col">Status</th>               
                          </tr>
                        </thead>
                        @forelse($leadership_dues_report as $leadership_dues_reportlist) 
                        <tr>
                          <th scope="row"><?php echo date("d M Y", strtotime($leadership_dues_reportlist->start_date));?></th>
                          <td>{{$leadership_dues_reportlist->leader_name}}</td>
                          <td>{{$leadership_dues_reportlist->category}}</td>
                          <td>{{$leadership_dues_reportlist->role}}</td>
                          <td>{{$leadership_dues_reportlist->membership_status}}</td>
                          <td>{{$leadership_dues_reportlist->renewal_date}}</td>
                          <td>{{$leadership_dues_reportlist->status==1?'Inside':'Outside'}}</td>
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
                <h2 class="accordion-header" id="headingFive">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                  Vacant Categories
                  </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#reportAccordion">
                  <div class="accordion-body">
                  <div class="table-responsive-md">
                      <table class="table table-hover">
                        <thead class="table-dark">
                          <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">Status</th>               
                          </tr>
                        </thead>
                        @forelse($vacant_category as $vacant_categorylist) 
                        <tr>
                          <th scope="row"><?php echo date("d M Y", strtotime($vacant_categorylist->start_date));?></th>
                          <td>{{$vacant_categorylist->category}}</td>
                          <td>{{$vacant_categorylist->status==1?'Inside':'Outside'}}</td>
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
                <h2 class="accordion-header" id="headingSix">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                  Sponsor Report
                  </button>
                </h2>
                <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#reportAccordion">
                  <div class="accordion-body">
                  <div class="table-responsive-md">
                      <table class="table table-hover">
                        <thead class="table-dark">
                          <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Sponsor Leader Name</th>
                            <th scope="col">Total leaders created</th>               
                            <th scope="col">New Leader Name</th> 
                            <th scope="col">Alliance Name</th> 
                            <th scope="col">Application Date</th> 
                            <th scope="col">Status</th> 
                          </tr>
                        </thead>
                        @forelse($sponsor_report as $sponsor_reportlist) 
                        <tr>
                          <th scope="row"><?php echo date("d M Y", strtotime($sponsor_reportlist->start_date));?></th>
                          <td>{{$sponsor_reportlist->sponsor_leader_name}}</td>
                          <td>{{$sponsor_reportlist->total_leaders_created}}</td>
                          <td>{{$sponsor_reportlist->new_leader_name}}</td>
                          <td>{{$sponsor_reportlist->alliance_name}}</td>
                          <td>{{$sponsor_reportlist->application_date}}</td>
                          <td>{{$sponsor_reportlist->status==1?'Inside':'Outside'}}</td>
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
                <h2 class="accordion-header" id="headingSeven">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                  VP Report
                  </button>
                </h2>
                <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#reportAccordion">
                  <div class="accordion-body">
                  <div class="table-responsive-md">
                      <table class="table table-hover">
                        <thead class="table-dark">
                          <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Leader's Name</th>
                            <th scope="col">Renewal Date</th>               
                            <th scope="col">RG</th> 
                            <th scope="col">RR</th> 
                            <th scope="col">BG</th> 
                            <th scope="col">GBR</th>                
                            <th scope="col">V</th> 
                            <th scope="col">DM</th> 
                            <th scope="col">T</th> 
                            <th scope="col">Status</th> 
                          </tr>
                        </thead>
                        @forelse($vp_report as $vp_reportlist) 
                        <tr>
                          <th scope="row"><?php echo date("d M Y", strtotime($vp_reportlist->start_date));?></th>
                          <td>{{$vp_reportlist->leader_name}}</td>
                          <td>{{$vp_reportlist->renewal_date}}</td>
                          <td>{{$vp_reportlist->rg}}</td>
                          <td>{{$vp_reportlist->rr}}</td>
                          <td>{{$vp_reportlist->bg}}</td>
                          <td>{{$vp_reportlist->gbr}}</td>
                          <td>{{$vp_reportlist->v}}</td>
                          <td>{{$vp_reportlist->dm}}</td>
                          <td>{{$vp_reportlist->t}}</td>
                          <td>{{$vp_reportlist->status==1?'Inside':'Outside'}}</td>
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
                <h2 class="accordion-header" id="headingEight">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                  Visitor Report
                  </button>
                </h2>
                <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#reportAccordion">
                  <div class="accordion-body">
                  <div class="table-responsive-md">
                      <table class="table table-hover">
                        <thead class="table-dark">
                          <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Visitor Name</th>
                            <th scope="col">Company Name</th>               
                            <th scope="col">Category</th> 
                            <th scope="col">Visit Date</th> 
                            <th scope="col">Invited By</th>
                            <th scope="col">Status</th> 
                          </tr>
                        </thead>
                        @forelse($visitor_report as $visitor_reportlist) 
                        <tr>
                          <th scope="row"><?php echo date("d M Y", strtotime($visitor_reportlist->start_date));?></th>
                          <td>{{$visitor_reportlist->visitor_name}}</td>
                          <td>{{$visitor_reportlist->company_name}}</td>
                          <td>{{$visitor_reportlist->category}}</td>
                          <td>{{$visitor_reportlist->visit_date}}</td>
                          <td>{{$visitor_reportlist->invited_by}}</td>
                          <td>{{$visitor_reportlist->status==1?'Inside':'Outside'}}</td>
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
                <h2 class="accordion-header" id="headingNine">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                  Leadership Victory Program
                  </button>
                </h2>
                <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine" data-bs-parent="#reportAccordion">
                  <div class="accordion-body">
                  <div class="table-responsive-md">
                      <table class="table table-hover">
                        <thead class="table-dark">
                          <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Company Name</th>               
                            <th scope="col">Category</th>
                            <th scope="col">Avg referrals</th>
                            <th scope="col">Avg visitors</th>
                            <th scope="col">Business given</th>
                            <th scope="col">Absenteeism</th>
                            <th scope="col">Events attended</th>
                            <th scope="col">Testimonial</th>
                            <th scope="col">Late</th>
                            <th scope="col">LVP Score</th>
                            <th scope="col">Status</th> 
                          </tr>
                        </thead>
                        @forelse($leadership_victory_program as $leadership_victory_programlist) 
                        <tr>
                          <th scope="row"><?php echo date("d M Y", strtotime($leadership_victory_programlist->start_date));?></th>
                          <td>{{$leadership_victory_programlist->company_name}}</td>
                          <td>{{$leadership_victory_programlist->category}}</td>
                          <td>{{$leadership_victory_programlist->avg_referrals}}</td>
                          <td>{{$leadership_victory_programlist->avg_visitors}}</td>                          
                          <td>{{$leadership_victory_programlist->business_given}}</td>
                          <td>{{$leadership_victory_programlist->absenteeism}}</td>
                          <td>{{$leadership_victory_programlist->events_attended}}</td>
                          <td>{{$leadership_victory_programlist->testimonial}}</td>                          
                          <td>{{$leadership_victory_programlist->late}}</td>
                          <td>{{$leadership_victory_programlist->lvp_score}}</td>
                          <td>{{$leadership_victory_programlist->status==1?'Inside':'Outside'}}</td>
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
                <h2 class="accordion-header" id="headingTen">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                  Knowledge Partner Report
                  </button>
                </h2>
                <div id="collapseTen" class="accordion-collapse collapse" aria-labelledby="headingTen" data-bs-parent="#reportAccordion">
                  <div class="accordion-body">
                  <div class="table-responsive-md">
                      <table class="table table-hover">
                        <thead class="table-dark">
                          <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Meeting Date</th>
                            <th scope="col">Knowledge Partner Name</th>               
                            <th scope="col">Meeting Agenda</th> 
                            <th scope="col">Status</th> 
                          </tr>
                        </thead>
                        @forelse($knowledge_partner_report as $knowledge_partner_reportlist) 
                        <tr>
                          <th scope="row"><?php echo date("d M Y", strtotime($knowledge_partner_reportlist->start_date));?></th>
                          <td>{{$knowledge_partner_reportlist->meeting_date}}</td>
                          <td>{{$knowledge_partner_reportlist->knowledge_partner_name}}</td>
                          <td>{{$knowledge_partner_reportlist->meeting_agenda}}</td>
                          <td>{{$knowledge_partner_reportlist->status==1?'Inside':'Outside'}}</td>
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
 

      function AllianceRosterReportsFun(){
      let startdate= $('#startdatealliance').val();
        let enddate= $('#enddatealliance').val();
      $.ajax({
                url: "{{ route('user.track.search') }}?startdate="+startdate+"&enddate="+enddate,
                method: "GET",
                data: {  },
                success: function(response) {
                  console.log(response)
                  var htmldata = '';
                  if(response.data.length>0){
                  for (var i = 0; i < response.data.length; i++) {
                    htmldata += `<tr>
                        <th scope="row">`+response.data.created_at+`</th>
                        <td>`+response.data.user.name+`</td>
                        <td>`+response.data.type+`</td>
                        <td>`+response.data.type==1?"Inside":"Outside"+`</td>
                        <td>`+response.data.email+`</td>
                        <td>`+response.data.telephone+`</td>
                        <td>`+response.data.comments+`</td>
                      </tr>`;
                  }
                }
                  else {
                    htmldata += `<tr>
            <td colspa='8'>No data</td>
            </tr>`;
                  }
                  $('#submittrackdatadiv').html(htmldata);

                    // $("#postreactionmsg"+postid).html(response.message)
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
                } 
            }
            });
    }
  </script>
@endsection