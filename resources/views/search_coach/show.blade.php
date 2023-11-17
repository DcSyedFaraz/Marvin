@extends('user.layouts.master')

@section('main-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Show Profile</li>
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
                                <h3 class="card-title">Profile Information</h3>
                            </div>
                            <div class="card-body">
                                <style>
                                    .profile-wrapper {
                                        max-width: 700px;
                                        margin-left: auto;
                                        margin-right: auto;
                                        margin-top: 10%;
                                    }

                                    .user-photo {
                                        border-radius: 10px;
                                        width: auto;
                                        height: auto;
                                        box-shadow: 0 0 1px 2px rgba(75, 62, 115, .1);
                                    }

                                    .left {
                                        width: 400px;
                                        padding: 0;
                                        border-radius: 10px;
                                        -webkit-box-shadow: 0px 0px 47px -4px rgba(75, 62, 115, 1);
                                        -moz-box-shadow: 0px 0px 47px -4px rgba(75, 62, 115, 1);
                                        box-shadow: 0px 0px 47px -4px rgba(75, 62, 115, 1);
                                    }

                                    div.links a {
                                        color: #8e8e8e;
                                        transition: color 0.3s;
                                    }

                                    div.links a:hover {
                                        color: #343a40;
                                        transition: color 0.3s;
                                    }

                                    div.links a:active {
                                        color: ##6c757d;
                                    }

                                    .right {
                                        border-left: solid 1px rgba(75, 62, 115, .4);
                                        height: 400px;
                                        margin-top: 10px;
                                        -webkit-box-shadow: 0px 0px 47px -4px rgba(75, 62, 115, 1);
                                        -moz-box-shadow: 0px 0px 47px -4px rgba(75, 62, 115, 1);
                                        box-shadow: 0px 0px 47px -4px rgba(75, 62, 115, 1);
                                        background-color: #fff;
                                        width: 350px;
                                        padding: 0;
                                        border-radius: 0 10px 10px 0;
                                        padding: 60px 10px 10px 10px;
                                    }

                                    .right>h1 {
                                        font-size: 1.4em;
                                        font-weight: 700;
                                    }

                                    .right>h2 {
                                        font-size: 1.2em;
                                    }

                                    .right>h3 {
                                        font-size: 1em;
                                        font-weight: 700;
                                    }

                                    .phone>h2 {
                                        font-size: 1.5em;
                                    }

                                    .phone>h3 {
                                        font-size: 1em;
                                    }

                                    .phone>h2 a {
                                        color: #000;
                                        transition: color .2s ease-out .2s;
                                    }

                                    .phone>h2 a:hover {
                                        color: rgba(75, 62, 115, 1);
                                        text-decoration: none;
                                        transition: color .2s ease-out .2s;
                                    }

                                    @media (max-width: 767.98px) {
                                        .user-photo {
                                            box-shadow: none;
                                        }

                                        .right {
                                            border-radius: 0 0 10px 10px;
                                            padding-top: 15px;
                                            margin-top: -10px;
                                        }

                                        .profile-wrapper {
                                            max-width: 350px;
                                        }
                                    }
                                </style>
                                <div class="profile-wrapper container">
                                    <div class="row">
                                        <div class="col-md-6 left">
                                            @if (isset($user->userdetail->coaches_photo))
                                                <p>
                                                <strong>Choach's Photo</strong>
                                            </p>
                                                <img src="{{ asset('storage/coaches_photos/' . $user->userdetail->coaches_photo) }}"
                                                    itemprop="image" style="height: 12rem; width: 21rem;" class="user-photo"
                                                    alt="Coaches' Photo">
                                            @endif
                                            @if (isset($user->userdetail->school_mascot))
                                                <p>
                                                <strong>School Mascot</strong>
                                            </p>
                                                <img src="{{ asset('storage/school_mascots/' . $user->userdetail->school_mascot) }}"
                                                    itemprop="image" class="user-photo" style="height: 10rem; width: 21rem;"
                                                    alt="School Mascot">
                                            @endif

                                        </div>
                                        <div class="col-md-6 right text-center">
                                            <h1 itemprop="name">{{ $user->name }}</h1><!-- Name -->
                                            <h2>{{ $user->email }}</h2><!-- Job -->
                                            <h3>{{ isset($user->userdetail->address) ? $user->userdetail->address : '' }}
                                            </h3>
                                            <hr>
                                            <div class="links">
                                                <p><strong>Cell Number:</strong>
                                                    {{ isset($user->userdetail->cell_number) ? $user->userdetail->cell_number : '' }}
                                                </p>
                                                <p><strong>Office Number:</strong>
                                                    {{ isset($user->userdetail->office_number) ? $user->userdetail->office_number : '' }}
                                                </p>
                                                <p><strong>A Good Time to Call:</strong>
                                                    {{ isset($user->userdetail->call_time) ? $user->userdetail->call_time : '' }}
                                                </p>
                                                <p><strong>Twitter Account:</strong>
                                                    {{ isset($user->userdetail->twitter) ? $user->userdetail->twitter : '' }}
                                                </p>
                                                <p><strong>Facebook Page:</strong>
                                                    {{ isset($user->userdetail->facebook) ? $user->userdetail->facebook : '' }}
                                                </p>
                                            </div>
                                            <hr>
                                            {{-- <div class="phone">
                                                <h3>Contact me:</h3>
                                                <h2><a id="contact-phone" href="tel:+121231232323">+12 (123) 123-23-23</a>
                                                </h2>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>

                            </div>
                            {{-- <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4><strong>Name:</strong> {{ $user->name }}</h4>
                                    <p><strong>Email:</strong> {{ $user->email }}</p>
                                    <p><strong>Address:</strong> {{ isset($user->userdetail->address) ? $user->userdetail->address : '' }}</p>
                                    <p><strong>Cell Number:</strong> {{ isset($user->userdetail->cell_number) ? $user->userdetail->cell_number : '' }}</p>
                                    <p><strong>Office Number:</strong> {{ isset($user->userdetail->office_number) ? $user->userdetail->office_number : '' }}</p>
                                    <p><strong>A Good Time to Call:</strong> {{ isset($user->userdetail->call_time) ? $user->userdetail->call_time : '' }}</p>
                                    <p><strong>Twitter Account:</strong> {{ isset($user->userdetail->twitter) ? $user->userdetail->twitter : '' }}</p>
                                    <p><strong>Facebook Page:</strong> {{ isset($user->userdetail->facebook) ? $user->userdetail->facebook : '' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-center">
                                        @if (isset($user->userdetail->school_mascot))
                                        <p>
                                            <strong>School Mascot</strong>
                                        </p>
                                            <img src="{{ asset('storage/school_mascots/' . $user->userdetail->school_mascot) }}" class="img-thumbnail rounded-circle" style="height: 10rem; width: 10rem;" alt="School Mascot">
                                        @endif
                                    </div>
                                    <div class="text-center mt-3">
                                        @if (isset($user->userdetail->coaches_photo))
                                        <p>
                                            <strong>Choach's Photo</strong>
                                        </p>
                                            <img src="{{ asset('storage/coaches_photos/' . $user->userdetail->coaches_photo) }}" class="img-thumbnail rounded-circle" style="height: 10rem; width: 10rem;" alt="Coaches' Photo">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                            <div class="card-footer">
                                <a href="{{ route('searchCoach.index') }}" class="btn btn-primary">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
