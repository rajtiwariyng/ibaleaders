@extends('front.layouts.app')
@section('content') 
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
            <h4 class="blue poppins-bold mb-0">Reports</h4>
            <div class="accordion mt-4 report-listing" id="reportAccordion">
              <!-- Alliance Roster Report -->
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Alliance Roster Report- Display list in tabular form with detailed report with mentioned positions in alliance.
                  </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#reportAccordion">
                  <div class="accordion-body">
                    <form>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="field1" class="form-label">Field 1</label>
                            <input type="text" class="form-control" id="field1">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="field2" class="form-label">Field 2</label>
                            <input type="text" class="form-control" id="field2">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="field3" class="form-label">Field 3</label>
                            <input type="text" class="form-control" id="field3">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="field4" class="form-label">Field 4</label>
                            <input type="text" class="form-control" id="field4">
                          </div>
                        </div>
                      </div>
                      <button type="submit" class="btn btn-primary bg-blue border-0">Save</button>
                    </form>
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
                    <form>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="field1" class="form-label">Field 1</label>
                            <input type="text" class="form-control" id="field1">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="field2" class="form-label">Field 2</label>
                            <input type="text" class="form-control" id="field2">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="field3" class="form-label">Field 3</label>
                            <input type="text" class="form-control" id="field3">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="field4" class="form-label">Field 4</label>
                            <input type="text" class="form-control" id="field4">
                          </div>
                        </div>
                      </div>
                      <button type="submit" class="btn btn-primary bg-blue border-0">Save</button>
                    </form>
                  </div>
                </div>
              </div>
            
              <!-- Member Event Report -->
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Member Event Report
                  </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#reportAccordion">
                  <div class="accordion-body">
                    <form>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="field1" class="form-label">Field 1</label>
                            <input type="text" class="form-control" id="field1">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="field2" class="form-label">Field 2</label>
                            <input type="text" class="form-control" id="field2">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="field3" class="form-label">Field 3</label>
                            <input type="text" class="form-control" id="field3">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="field4" class="form-label">Field 4</label>
                            <input type="text" class="form-control" id="field4">
                          </div>
                        </div>
                      </div>
                      <button type="submit" class="btn btn-primary bg-blue border-0">Save</button>
                    </form>
                  </div>
                </div>
              </div>
            
              <!-- Add more reports following the same structure -->
            </div>
            
            
          </div>  

        </div>
@endsection

@section('customJs')
@endsection