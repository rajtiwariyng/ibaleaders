@extends('admin.layouts.app')

@section('content')
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<!-- <div class="card-header">
						<h3 class="card-title">Bordered Table</h3>
					</div> -->
					<!-- /.card-header -->
					<div class="card-body">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th style="width: 10px">#</th>
									<th>First Name</th>
									<th>Last Name</th>
					                <th>Email</th>
					                <th>Mobile Number</th>
					                <th>Company Name</th>
					                <th>City</th>
					                <th>Postcode</th>
								</tr>
							</thead>
							<tbody>
								@forelse($visitors as $visitor)
					                <tr>
					                    <td>{{ $loop->iteration }}</td>
					                    <td>{{ $visitor->first_name }}</td>
					                    <td>{{ $visitor->last_name }}</td>
					                    <td>{{ $visitor->email }}</td>
					                    <td>{{ $visitor->mobile_number }}</td>
					                    <td>{{ $visitor->company_name }}</td>
					                    <td>{{ $visitor->city }}</td>
					                    <td>{{ $visitor->post_code }}</td>
					                </tr>
					            @empty
					                <tr>
					                    <td colspan="6" class="text-center">No users found.</td>
					                </tr>
					            @endforelse
							</tbody>
						</table>
					</div>
					<!-- /.card-body -->
					<!-- <div class="card-footer clearfix">
						<ul class="pagination pagination-sm m-0 float-right">
							<li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
							<li class="page-item"><a class="page-link" href="#">1</a></li>
							<li class="page-item"><a class="page-link" href="#">2</a></li>
							<li class="page-item"><a class="page-link" href="#">3</a></li>
							<li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
						</ul>
					</div> -->
				</div>
			</div>


	</div><!--container-fluid -->
</section>
	@endsection