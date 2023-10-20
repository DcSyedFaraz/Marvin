@extends('coach.layouts.master')

@section('main-content')
    <style>
        /* Custom CSS for styling */
        /* Custom CSS for styling */

        .profile-card {
            border: 1px solid #ddd;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
        }

        .profile-card img {
            max-width: 100%;
            height: auto;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .profile-card h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .profile-card p {
            margin-bottom: 5px;
        }

        .profile-card .card {
            border: none;
            background-color: #f8f9fa;
            padding: 10px;
            text-align: center;
            box-shadow: none;
        }

        .profile-card .card-title {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .profile-card .card-text {
            font-size: 14px;
            margin-bottom: 0;
        }

        .profile-card .embed-responsive {
            margin-top: 20px;
        }


        .profile-card {
            border: 1px solid #ddd;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .profile-card img {
            max-width: 100%;
            height: auto;
        }
    </style>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="profile-card p-4">
                    <h1 class="text-center">{{ $player->name }}</h1>
                    <div class="text-center mb-4">
                        <img src="{{ asset($player->profile->profile_picture) }}" alt="Profile Picture" class="img-fluid">
                    </div>
                    <p class="mb-3"><strong>Email:</strong> {{ $player->email }}</p>
                    <p><strong>Introduction:</strong> {{ $player->profile->introduction }}</p>
                    @if (isset($player->sport_name->fields))
                    <div class="col-md-12">
                        <div class="row mt-4">
                            <div class="card-header col-md-3">
                                <h3>
                                 Fields
                             </h3>
                             </div>
                            @foreach ($player->sport_name->fields as $file)
                                <div class="col-md-3 border border-primary">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            @php
                                                $valuess = App\Models\FieldsValue::where('player_id', $player->id)
                                                    ->where('field_id', $file->id)
                                                    ->first();
                                            @endphp
                                            {{-- @dd($valuess) --}}
                                            <h5 class="card-title">{{ $file->name }}</h5>
                                            <p class="card-text">{{ $valuess->value ?? '' }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    @if (isset($player->sport_name->stats))
                    <div class="col-md-12">
                        <div class="row mt-4">

                            <div class="card-header col-md-3">
                               <h3>
                                Stats
                            </h3>
                            </div>
                            @foreach ($player->sport_name->stats as $file)
                            <div class="col-md-3 border border-secondary">
                                <div class="card mb-4">
                                        <div class="card-body">
                                            @php
                                                $valuess = App\Models\StatsValue::where('player_id', $player->id)
                                            ->where('stats_id', $file->id)
                                            ->first();
                                            @endphp
                                            {{-- @dd($valuess) --}}
                                            <h5 class="card-title">{{ $file->name }}</h5>
                                            <p class="card-text">{{ $valuess->value ?? '' }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    {{-- <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">40 Times</h5>
                                <p class="card-text">{{ $player->profile->forty_times }}</p>
                            </div>
                        </div>
                    </div> --}}
                    {{-- <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">Vertical Jump</h5>
                                <p class="card-text">{{ $player->profile->vertical_jump }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">GPA</h5>
                                <p class="card-text">{{ $player->profile->gpa }}</p>
                            </div>
                        </div>
                    </div> --}}

                    <div class="text-center">
                        @if ($player->profile->video_embed)
                            <div class="embed-responsive embed-responsive-16by9">
                                {!! $player->profile->video_embed !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
