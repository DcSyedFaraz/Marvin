{{-- @extends(Auth::user()->hasRole('admin') ? 'admin.layouts.master' : (Auth::user()->hasRole('high_school') ? 'school.layouts.master' : (Auth::user()->hasRole('high_school') ? 'school.layouts.master')) --}}
@extends(
    Auth::user()->hasRole('admin') ? 'admin.layouts.master' : (
    Auth::user()->hasRole('high_school') ? 'school.layouts.master' : (
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
                  <form method="post" action="{{route('profile.update',Auth::user()->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" class="form-control" value="{{ Auth::user()->name }}" required>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <!-- Address -->
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" id="address" name="address" class="form-control" value="{{ isset($user->userdetail->address) ? $user->userdetail->address : '' }}" required>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <!-- Cell Number -->
                            <div class="form-group">
                                <label for="cell_number">Cell Number</label>
                                <input type="tel" id="cell_number" name="cell_number" class="form-control" value="{{ isset($user->userdetail->cell_number) ? $user->userdetail->cell_number : '' }}">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <!-- Office Number -->
                            <div class="form-group">
                                <label for="office_number">Office Number</label>
                                <input type="tel" id="office_number" name="office_number" class="form-control" value="{{ isset($user->userdetail->office_number) ? $user->userdetail->office_number : '' }}">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <!-- A Good Time to Call -->
                            <div class="form-group">
                                <label for="call_time">A Good Time to Call</label>
                                <input type="time" id="call_time" name="call_time" class="form-control" value="{{ isset($user->userdetail->call_time) ? $user->userdetail->call_time : '' }}">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <!-- Twitter Account -->
                            <div class="form-group">
                                <label for="twitter">Twitter Account</label>
                                <input type="url" id="twitter" name="twitter" class="form-control" value="{{ isset($user->userdetail->twitter) ? $user->userdetail->twitter : '' }}">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <!-- Facebook Page -->
                            <div class="form-group">
                                <label for="facebook">Facebook Page</label>
                                <input type="url" id="facebook" name="facebook" class="form-control" value="{{ isset($user->userdetail->facebook) ? $user->userdetail->facebook : '' }}">
                            </div>
                        </div>

                        <!-- Upload School Mascot -->
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="school_mascot">Upload School Mascot</label>
                                <input type="file" id="school_mascot" name="school_mascot" class="form-control-file">
                            </div>
                        </div>
                        @if ($user->userdetail->school_mascot)
                        <img src="{{ asset('storage/school_mascots/' . $user->userdetail->school_mascot) }}" class="img-thumbnail " style="height: 10rem" alt="School Mascot">
                   @endif
                        <!-- Upload Coaches' Photo -->
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="coaches_photo">Upload Coaches' Photo</label>
                                <input type="file" id="coaches_photo" name="coaches_photo" class="form-control-file">
                            </div>
                        </div>
                        @if ($user->userdetail->coaches_photo)
                        <img src="{{ asset('storage/coaches_photos/' . $user->userdetail->coaches_photo) }}" class="img-thumbnail " style="height: 10rem" alt="Coaches' Photo">
                    @endif

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
                            <button type="submit" class="btn btn-primary">Update Profile</button>
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
