@extends('user.layouts.master')


@section('main-content')
    <div class="content-wrapper">
        @include('user.layouts.notification')
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
                                <form method="post" action="{{ route('user_profile.update', Auth::user()->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="text" id="name" name="name" class="form-control"
                                                        value="{{ Auth::user()->name }}" required>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="name">Profile Pic</label>
                                                    <input type="file" id="profile_picture" name="profile_picture" class="form-control"
                                                        >
                                                </div>
                                            </div>



                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <!-- Cell Number -->
                                                <div class="form-group">
                                                    <label for="cell_number">Sports</label>
                                                    <select name="sport" id="" class="form-control">
                                                        @foreach ($sport as $sports)
                                                            <option value="{{ $sports->id }}"
                                                                {{ $sports->id == $user->assigned_sport ? 'selected' : '' }}>
                                                                {{ $sports->title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <small class="text-danger">If you change the sport, your fields will not
                                                        save</small>
                                                </div>
                                            </div>


                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <strong>Email:</strong>
                                                    <input class="form-control" readonly value="{{ Auth::user()->email }}"
                                                        type="email" name="email" required>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <strong>Password:</strong>
                                                    <input class="form-control" type="password" name="password">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            @foreach ($user->sport_name->fields as $file)
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <div class="form-group">
                                                        @php
                                                            $valuess = App\Models\FieldsValue::where('player_id', auth()->user()->id)
                                                                ->where('field_id', $file->id)
                                                                ->first();
                                                        @endphp
                                                        <input type="hidden" value="{{ $file->id }}" name="field_id[]">
                                                        <strong>{{ $file->name }}:</strong>
                                                        <input class="form-control"
                                                            value="{{ $valuess ? $valuess->value : '' }}" type="text"
                                                            name="fields[]">
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>


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
