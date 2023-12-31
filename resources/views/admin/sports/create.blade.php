@extends('admin.layouts.master')

@section('main-content')

<div class="card">
@if(session('success'))
    <div class="alert alert-success alert-dismissable fade show">
        <button class="close" data-dismiss="alert" aria-label="Close">×</button>
        {{session('success')}}
    </div>
@endif


@if(session('error'))
    <div class="alert alert-danger alert-dismissable fade show">
        <button class="close" data-dismiss="alert" aria-label="Close">×</button>
        {{session('error')}}
    </div>
@endif            
@include('admin.layouts.notification')
     
    <h5 class="card-header">Add Sport</h5>
    <div class="card-body">
      <form method="post" action="{{route('sport.store')}}">
        {{csrf_field()}}
          <div class="form-group">
            <label for="inputTitle" class="col-form-label">Title</label>
            <input id="inputTitle" type="text" name="title" placeholder="Enter Title"  value="{{old('title')}}" class="form-control">
            @error('title')
              <span class="text-danger">{{$message}}</span>
            @enderror
          </div>

          <div class="form-group">
          <label for="inputPhoto" class="col-form-label">Photo</label>
          <div class="input-group">
              <span class="input-group-btn">
                  <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                  <i class="fa fa-picture-o"></i> Choose
                  </a>
              </span>
              <input id="thumbnail" class="form-control" type="text" name="logo" value="{{old('logo')}}">
          </div>
        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
            @error('photo')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>


          <div class="form-group">
            <label for="status" class="col-form-label">Status</label>
            <select name="status" class="form-control">
                <option value="active" >Active</option>
                <option value="inactive">Inactive</option>
            </select>
            @error('status')
              <span class="text-danger">{{$message}}</span>
            @enderror
          </div>

        <div class="form-group mb-3">
          <button type="reset" class="btn btn-warning">Reset</button>
           <button class="btn btn-success" type="submit">Submit</button>
        </div>
      </form>
    </div>
</div>

@endsection
@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>


<script>
  $('#lfm').filemanager('image');
  </script>
@endpush