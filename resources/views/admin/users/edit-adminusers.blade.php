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
                <h3 class="card-title">Update Users</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="quickForm" action="{{ route('admin.adminUsers.update', $user->id) }}" method="POST">
              	@csrf
                @method('PUT')
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Email address</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
			            @error('name')
			                <small class="text-danger">{{ $message }}</small>
			            @enderror
                    </div>
                  <div class="form-group">
                    <label for="email">Password</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
			            @error('email')
			                <small class="text-danger">{{ $message }}</small>
			            @enderror
                  </div>
                  <div class="form-group">
			            <label for="mobile_number">Mobile Number</label>
			            <input type="text" name="mobile_number" id="mobile_number" class="form-control" value="{{ old('mobile_number', $user->mobile_number) }}">
			            @error('mobile_number')
			                <small class="text-danger">{{ $message }}</small>
			            @enderror
			       </div>
			       <div class="form-group">
			            <label for="role">Role</label>
			            <select name="role" id="role" class="form-control" required>
			                @foreach($roles as $role)
			                    <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
			                        {{ ucfirst($role->name) }}
			                    </option>
			                @endforeach
			            </select>
			            @error('role')
			                <small class="text-danger">{{ $message }}</small>
			            @enderror
			        </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-success">Update User</button>
                    <a href="{{ route('admin.adminUsers.list') }}" class="btn btn-secondary">Cancel</a>
                </div>
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