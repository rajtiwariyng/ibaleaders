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
                <h3 class="card-title">Create User</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="frontusersCreate" action="{{ route('admin.frontedUsers.store') }}" method="POST">
              	@csrf

                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
			            @error('name')
			                <small class="text-danger">{{ $message }}</small>
			            @enderror
                    </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
			            @error('email')
			                <small class="text-danger">{{ $message }}</small>
			            @enderror
                  </div>
                  <div class="form-group">
			            <label for="mobile_number">Mobile No.</label>
			            <input type="text" name="mobile_number" id="mobile_number" class="form-control" value="{{ old('mobile_number') }}">
			            @error('mobile_number')
			                <small class="text-danger">{{ $message }}</small>
			            @enderror
			       </div>
             <div class="form-group">
                  <label for="industry">Industry</label>
                  <input type="text" name="industry" id="industry" class="form-control" value="{{ old('industry') }}">
                  @error('industry')
                      <small class="text-danger">{{ $message }}</small>
                  @enderror
             </div>
             <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                @error('password_confirmation')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
			       <div class="form-group">
                <label for="role">Role</label>
                <select name="role" id="role" class="form-control" required>
                    <option value="" disabled selected>Select Role</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                    @endforeach
                </select>
                @error('role')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-success">Create User</button>
                    <a href="{{ route('admin.frontedUsers.list') }}" class="btn btn-secondary">Cancel</a>
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