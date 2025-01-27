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
                <h3 class="card-title">Create Roles</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="rolesCreate" action="{{ route('admin.roles.store') }}" method="POST">
              	@csrf

                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
			            @error('name')
			                <small class="text-danger">{{ $message }}</small>
			            @enderror
                    </div>
                    <div class="row">
                      @if($permissions->isNotEmpty())
                        @foreach($permissions as $permission)
                          <div class="col-3 mt-3">
                            <div class="form-check">
                              <input type="checkbox" id="permission-{{$permission->id}}" class="form-check-input" name="permission[]" value="{{ $permission->name }}" id="permission_{{ $loop->index }}">
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
                  <button type="submit" class="btn btn-success">Create Roles</button>
                    <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">Cancel</a>
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