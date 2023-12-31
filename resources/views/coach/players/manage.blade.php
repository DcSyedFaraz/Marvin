@extends('coach.layouts.master')

@section('main-content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Manage Player Profile</h1>
        </div>

        <!-- Player Profile Form -->
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('manage-players.update', $player->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">

                        <div class="col-xs-6 col-sm-6 col-md-6">

                            <div class="form-group">
                                <label for="name">Player Name:</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $player->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Email:</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ $player->email }}" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Password:</label>
                                <input type="text" class="form-control" id="password" name="password">
                            </div>
                            <small class="text-danger">Leave The Password Fields Blank if you don't want to change
                                password</small>
                            <div class="form-group">
                                <label for="name">Confirm Password:</label>
                                <input type="text" class="form-control" id="confirm-password" name="confirm-password">
                            </div>

                            <div class="form-group">
                                <label for="name">Sport:</label>
                                <select name="sport" id="" class="form-control">
                                    @foreach ($sport as $sports)
                                        <option value="{{ $sports->id }}"
                                            {{ $sports->id == $player->assigned_sport ? 'selected' : '' }}>
                                            {{ $sports->title }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-danger">If you change the sport, your fields will not
                                    save</small>
                            </div>
                            <div class="form-group">
                                <label for="profile_picture">Profile Picture:</label>
                                <input type="file" class="form-control-file" id="profile_picture" name="profile_picture"
                                    accept="image/jpeg,image/png,image/gif">
                            </div>
                            @if ($player->profile->profile_picture)
                                <div class="col-md-4">
                                    <div class="card mb-4">
                                        <img src="{{ asset($player->profile->profile_picture) }}" class="card-img-top">

                                    </div>
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="introduction">Introduction:</label>
                                <textarea class="form-control" id="introduction" name="introduction">{{ $player->profile->introduction }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="video_embed">Video Embed:</label>
                                <input class="form-control" id="video_embed" name="video_embed"
                                    value="{{ $player->profile->video_embed }}">
                            </div>
                            @if ($player->profile->video_embed)
                                <div class="col-md-4">
                                    <div class="card mb-4">
                                        {!! $player->profile->video_embed !!}

                                    </div>
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="forty_times">40 Times:</label>
                                <input type="number" class="form-control" id="forty_times" name="forty_times"
                                    value="{{ $player->profile->forty_times }}">
                            </div>
                            <div class="form-group">
                                <label for="vertical_jump">Vertical Jump:</label>
                                <input type="number" class="form-control" id="vertical_jump" name="vertical_jump"
                                    value="{{ $player->profile->vertical_jump }}">
                            </div>
                            <div class="form-group">
                                <label for="gpa">GPA:</label>
                                <input type="number" class="form-control" id="gpa" name="gpa"
                                    value="{{ $player->profile->gpa }}">
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            @if ($player->sport_name->fields->count() > 0)
                                <h3>Sport's Required Fields</h3>
                                @foreach ($player->sport_name->fields as $file)
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            @php
                                                $valuess = App\Models\FieldsValue::where('player_id', $player->id)
                                                    ->where('field_id', $file->id)
                                                    ->first();
                                            @endphp
                                            <input type="hidden" value="{{ $file->id }}" name="field_id[]">
                                            <strong>{{ $file->name }}:</strong>
                                            <input class="form-control" value="{{ $valuess ? $valuess->value : '' }}"
                                                type="text" name="fields[]">
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            @if ($player->sport_name->stats->count() > 0)
                                <h3>Stats</h3>
                                @foreach ($player->sport_name->stats as $file)
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            @php
                                                $valuess = App\Models\StatsValue::where('player_id', $player->id)
                                                    ->where('stats_id', $file->id)
                                                    ->first();
                                            @endphp
                                            <input type="hidden" value="{{ $file->id }}" name="stats_id[]">
                                            <strong>{{ $file->name }}:</strong>
                                            <input class="form-control" value="{{ $valuess ? $valuess->value : '' }}"
                                                type="number" name="stats[]">
                                        </div>

                                    </div>
                                @endforeach
                            @endif

                        </div>
                    </div>
                    <!-- Add more form fields for player profile data here -->
                    <button type="submit" class="btn btn-primary">Update Player</button>
                </form>
            </div>
        </div>
    </div>

@endsection
