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
                <h3 class="card-title">Update Event</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="eventCreate" action="{{ route('admin.events.update',$event->id) }}" method="POST">
              	@csrf
                @method('PUT')
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Event Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $event->name) }}" required>
			            @error('name')
			                <small class="text-danger">{{ $message }}</small>
			            @enderror
                    </div>
                  <div class="form-group">
                    <label for="location">Location</label>
                    <input type="location" name="location" id="location" class="form-control" value="{{ old('location',$event->location) }}" required>
			            @error('location')
			                <small class="text-danger">{{ $message }}</small>
			            @enderror
                  </div>
                  <div class="form-group">
			            <label for="start_date">Start Date</label>
			            <input type="datetime-local" name="start_date" id="start_date" class="form-control" value="{{ old('start_date', $event->start_date) }}">
			            @error('start_date')
			                <small class="text-danger">{{ $message }}</small>
			            @enderror
			       </div>
		             <div class="form-group">
		                <label for="user_id">Assign to User</label>
		                <select name="user_id" id="user_id" required>
			                @foreach ($users as $user)
			                    <option value="{{ $user->id }}">{{ $user->name }}</option>
			                @endforeach
			            </select>
		                @error('user_id')
		                    <small class="text-danger">{{ $message }}</small>
		                @enderror
		            </div>
            
			       
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-success">Update Event</button>
                    <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Cancel</a>
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