@extends('admin.layouts.app')

@section('content')
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<a href="{{route('admin.roles.create')}}">Create Roles</a>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th style="width: 10px">#</th>
									<th style="width: 30%">Name</th>
									<th style="width: 30%">Permissions</th>
									<th>Created_at</th>
					                <th>Action</th>
								</tr>
							</thead>
							<tbody>
								@forelse($roles as $role)
					                <tr>
					                    <td>{{ $loop->iteration }}</td>
					                    <td>{{ $role->name }}</td>
					                    <td>{{ $role->permissions->pluck('name')->implode(', ') }}</td>
					                    <td>{{ $role->created_at->format('d-M-Y') }}</td>
					                    
					                    <td>
					                        <!-- <a href="{{-- route('admin.users.show', $user->id) --}}" class="btn btn-primary btn-sm">View</a> -->
					                        <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-warning btn-sm">Edit</a>
						                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" 
						                      data-target="#globalDeleteModal" data-action="{{ route('admin.roles.destroy', $role->id) }}" 
						                      data-message="Are you sure you want to delete user {{ $role->name }}?">Delete
					                        </button>
					                    </td>
					                </tr>
					            @empty
					                <tr>
					                    <td colspan="6" class="text-center">No users found.</td>
					                </tr>
					            @endforelse
							</tbody>
						</table>
					</div>
					{{ $roles->links()}}
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