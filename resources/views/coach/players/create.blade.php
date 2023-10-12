@extends('coach.layouts.master')

@section('main-content')
<div class="container-fluid">
    @include('coach.layouts.notification')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add New Player Profile</h1>
    </div>

    <!-- Player Profile Form -->
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('manage-players.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- @method('PUT') --}}
                <div class="form-group">
                    <label for="name">Player Name:</label>
                    <input type="text" class="form-control" id="name" name="name"  required>
                </div>
                <div class="form-group">
                    <label for="name">Email:</label>
                    <input type="email" class="form-control" id="email" name="email"  required>
                </div>
                <div class="form-group">
                    <label for="name">Password:</label>
                    <input type="password" class="form-control" id="password" name="password"  required>
                </div>
                <div class="form-group">
                    <label for="name">Confirm Password:</label>
                    <input type="password" class="form-control" id="confirm-password" name="confirm-password" >
                </div>
                <div class="form-group">
                    <label for="profile_picture">Profile Picture:</label>
                    <input type="file" class="form-control-file" id="profile_picture" name="profile_picture" accept="image/jpeg,image/png,image/gif">
                </div>

                <div class="form-group">
                    <label for="introduction">Introduction:</label>
                    <textarea class="form-control" id="introduction" name="introduction"></textarea>
                </div>
                <div class="form-group">
                    <label for="video_embed">Video Embed:</label>
                    <input type="text" class="form-control" id="video_embed" name="video_embed">
                </div>
                <div class="form-group">
                    <label for="forty_times">40 Times:</label>
                    <input type="number" class="form-control" id="forty_times" name="forty_times" value="">
                </div>
                <div class="form-group">
                    <label for="vertical_jump">Vertical Jump:</label>
                    <input type="number" class="form-control" id="vertical_jump" name="vertical_jump" value="">
                </div>
                <div class="form-group">
                    <label for="gpa">GPA:</label>
                    <input type="number" class="form-control" id="gpa" name="gpa" value="">
                </div>
                <!-- Add more form fields for player profile data here -->
                <button type="submit" class="btn btn-primary">Create Player</button>
            </form>
        </div>
    </div>
</div>
@endsection
