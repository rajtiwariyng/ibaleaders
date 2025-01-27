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
                <h3 class="card-title">Update Role</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="usersUpdate" action="{{ route('admin.roles.update',$role->id) }}" method="POST">
              	@csrf

                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $role->name) }}">
			            @error('name')
			                <small class="text-danger">{{ $message }}</small>
			            @enderror
                    </div>
                    <div class="row">
                      @if($permissions->isNotEmpty())
                        @foreach($permissions as $permission)
                          <div class="col-3 mt-3">
                            <div class="form-check">
                              <input {{ ($hasPermissions->contains($permission->name)) ? 'checked' : '' }} type="checkbox" id="permission-{{$permission->id}}" class="form-check-input" name="permission[]" value="{{ $permission->name }}" id="permission_{{ $loop->index }}">
                              <label class="form-check-label" for="permission-{{$permission->id}}">{{ $permission->name }}</label>
                            </div>
                          </div>
                        @endforeach
                      @endif
                    </div>
                  
            </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-success">Update Permission</button>
                    <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary">Cancel</a>
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