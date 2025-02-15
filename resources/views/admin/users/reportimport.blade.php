@extends('admin.layouts.app')

@section('content')
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Import Report</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ route('admin.report.import.post') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="excel_file">Alliance Roster Reports</label>
                      <input type="file" name="excel_file"  id="excel_file" required>
                      <button type="submit">Import</button>
                    </div>
                  </div>
                  <a href="{{ asset('admin-assets/dist/img/AllianceRosterReports.csv') }}" download> Download Sample</a>
              </form>
              <form action="{{ route('admin.report2.import.post') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="excel_file2">Leadership Report</label>
                      <input type="file" name="excel_file2"  id="excel_file2" required>
                      <button type="submit">Import</button>
                    </div>
                  </div>
                  <a href="{{ asset('admin-assets/dist/img/LeadershipReport.csv') }}" download> Download Sample</a>
              </form>
              <form action="{{ route('admin.report3.import.post') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="excel_file3">Event Report</label>
                      <input type="file" name="excel_file3"  id="excel_file3" required>
                      <button type="submit">Import</button>
                    </div>
                  </div>
                  <a href="{{ asset('admin-assets/dist/img/EventReport.csv') }}" download> Download Sample</a>
              </form>
              <form action="{{ route('admin.report4.import.post') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="excel_file4">Leadership Dues Report</label>
                      <input type="file" name="excel_file4"  id="excel_file4" required>
                      <button type="submit">Import</button>
                    </div>
                  </div>
                  <a href="{{ asset('admin-assets/dist/img/LeadershipDuesReport.csv') }}" download> Download Sample</a>
              </form>
              <form action="{{ route('admin.report5.import.post') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="excel_file5">Vacant Categories</label>
                      <input type="file" name="excel_file5"  id="excel_file5" required>
                      <button type="submit">Import</button>
                    </div>
                  </div>
                  <a href="{{ asset('admin-assets/dist/img/VacantCategories.csv') }}" download> Download Sample</a>
              </form>
              <form action="{{ route('admin.report6.import.post') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="excel_file6">Sponsor Report</label>
                      <input type="file" name="excel_file6"  id="excel_file6" required>
                      <button type="submit">Import</button>
                    </div>
                  </div>
                  <a href="{{ asset('admin-assets/dist/img/SponsorReport.csv') }}" download> Download Sample</a>
              </form>
              <form action="{{ route('admin.report7.import.post') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="excel_file7">VP Report</label>
                      <input type="file" name="excel_file7"  id="excel_file7" required>
                      <button type="submit">Import</button>
                    </div>
                  </div>
                  <a href="{{ asset('admin-assets/dist/img/VPReport.csv') }}" download> Download Sample</a>
              </form>
              <form action="{{ route('admin.report8.import.post') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="excel_file8">Visitor Report</label>
                      <input type="file" name="excel_file8"  id="excel_file8" required>
                      <button type="submit">Import</button>
                    </div>
                  </div>
                  <a href="{{ asset('admin-assets/dist/img/VisitorReport.csv') }}" download> Download Sample</a>
              </form>
              <form action="{{ route('admin.report9.import.post') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="excel_file9">Leadership Victory Program</label>
                      <input type="file" name="excel_file9"  id="excel_file9" required>
                      <button type="submit">Import</button>
                    </div>
                  </div>
                  <a href="{{ asset('admin-assets/dist/img/LeadershipVictoryProgram.csv') }}" download> Download Sample</a>
              </form>
              <form action="{{ route('admin.report10.import.post') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="excel_file10">Knowledge Partner Report</label>
                      <input type="file" name="excel_file10"  id="excel_file10" required>
                      <button type="submit">Import</button>
                    </div>
                  </div>
                  <a href="{{ asset('admin-assets/dist/img/KnowledgePartnerReport.csv') }}" download> Download Sample</a>
              </form>
             
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
	@endsection