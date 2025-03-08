@extends('admin.layouts.app')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- Full-width column -->
            <div class="col-md-12">
                <!-- Card container -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Import Reports</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="row">
                            @php
                                $reports = [
                                    ['name' => 'Alliance Roster Reports', 'route' => 'admin.report.import.post', 'file' => 'AllianceRosterReports.csv'],
                                    ['name' => 'Leadership Report', 'route' => 'admin.report2.import.post', 'file' => 'LeadershipReport.csv'],
                                    ['name' => 'Event Report', 'route' => 'admin.report3.import.post', 'file' => 'EventReport.csv'],
                                    ['name' => 'Leadership Dues Report', 'route' => 'admin.report4.import.post', 'file' => 'LeadershipDuesReport.csv'],
                                    ['name' => 'Vacant Categories', 'route' => 'admin.report5.import.post', 'file' => 'VacantCategories.csv'],
                                    ['name' => 'Sponsor Report', 'route' => 'admin.report6.import.post', 'file' => 'SponsorReport.csv'],
                                    ['name' => 'VP Report', 'route' => 'admin.report7.import.post', 'file' => 'VPReport.csv'],
                                    ['name' => 'Visitor Report', 'route' => 'admin.report8.import.post', 'file' => 'VisitorReport.csv'],
                                    ['name' => 'Leadership Victory Program', 'route' => 'admin.report9.import.post', 'file' => 'LeadershipVictoryProgram.csv'],
                                    ['name' => 'Knowledge Partner Report', 'route' => 'admin.report10.import.post', 'file' => 'KnowledgePartnerReport.csv']
                                ];
                            @endphp

                            @foreach($reports as $key => $report)
                                <div class="col-md-6 mb-4">
                                    <form action="{{ route($report['route']) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="excel_file{{ $key + 1 }}">{{ $report['name'] }}</label>
                                            <input type="file" name="excel_file{{ $key + 1 }}" id="excel_file{{ $key + 1 }}" class="form-control" required>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <button type="submit" class="btn btn-primary">Import</button>
                                            <a href="{{ asset('admin-assets/dist/img/'.$report['file']) }}" download class="btn btn-secondary btn-sm">Download Sample</a>
                                        </div>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>
@endsection
