{{-- @extends(Auth::user()->hasRole('admin') ? 'admin.layouts.master' : (Auth::user()->hasRole('high_school') ? 'school.layouts.master' : (Auth::user()->hasRole('high_school') ? 'school.layouts.master')) --}}
@extends(
    Auth::user()->hasRole('admin') ? 'admin.layouts.master' : (
    Auth::user()->hasRole('high_school') ? 'schol.layouts.master' : (
    Auth::user()->hasRole('college') ? 'college.layouts.master' : (
    Auth::user()->hasRole('coach') ? 'coach.layouts.master' : (
    Auth::user()->hasRole('athlete') ? 'athlete.layouts.master' : 'layouts.default'
)))))




@section('main-content')
<div class="content-wrapper">
    @include('college.layouts.notification')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
    <div class="container-fluid">
    @if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif
        <div class="row">
          <div class="col-12">
              <div class="card">
                  <div class="card-header">
                  <form method="post" action="{{route('profile.update',Auth::user()->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Name:</strong>
                                <input class="form-control" value="{{Auth::user()->name}}" name="name" required>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Email:</strong>
                                <input class="form-control" readonly value="{{Auth::user()->email}}" type="email" name="email" required>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Password:</strong>
                                <input class="form-control" type="password" name="password" required>
                            </div>
                        </div>
                        {{-- <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Confirm Password:</strong>
                                <input class="form-control" type="password" name="password_confirmation" required>
                            </div>
                        </div> --}}

                        <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                  </form>
                  </div>
              </div>
          </div>
        </div>
    </div>
</section>

</div>
@endsection
