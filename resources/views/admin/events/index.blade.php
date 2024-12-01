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
									<th>Name</th>
					                <th>Location</th>
					                <th>Start Date</th>
					                <th>Organizer</th>
					                <th>Status</th>
					                <th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@forelse($events as $event)
					                <tr>
					                    <td>{{ $loop->iteration }}</td>
					                    <td>{{ $event->name }}</td>
					                    <td>{{ $event->location }}</td>
					                    <td>{{ $event->start_date }}</td>
					                    <td>{{ $event->user->name }}</td>
					                    <td>{{ $event->status }}</td>
					                    <td>
					                    	<form action="{{ route('admin.events.changeStatus', $event->id) }}" method="POST" style="display:inline-block;">
											    @csrf
											    <input type="hidden" name="status" value="{{ $event->status === 'active' ? 'inactive' : 'active' }}">
											    <button type="submit" class="btn btn-sm {{ $event->status === 'active' ? 'btn-success' : 'btn-danger' }}">
											        {{ $event->status === 'active' ? 'Deactivate' : 'Activate' }}
											    </button>
											</form>
										</td>
					                    <td>
					                        <!-- <a href="{{-- route('admin.users.show', $user->id) --}}" class="btn btn-primary btn-sm">View</a> -->
					                        <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-warning btn-sm">Edit</a>
						                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" 
						                      data-target="#globalDeleteModal" data-action="{{ route('admin.events.destroy', $event->id) }}" 
						                      data-message="Are you sure you want to delete Event - {{ $event->name }}?">Delete
					                        </button>
					                    </td>
					                </tr>
					            @empty
					                <tr>
					                    <td colspan="6" class="text-center">No Events found.</td>
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