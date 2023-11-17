@extends('user.layouts.master')
@section('main-content')
    <div class="content-wrapper">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header">
                            {{ $status->title }}
                        </div>
                        <div class="card-body">
                            <p><strong>Type:</strong> {{ $status->type }}</p>
                            <p><strong>Country:</strong> {{ $status->country }}</p>
                            <p><strong>Location:</strong> {{ $status->location }}</p>
                            <p><strong>Website:</strong> {{ $status->website }}</p>
                            <p><strong>Instagram:</strong> {{ $status->instagram }}</p>
                            <p><strong>Facebook:</strong> {{ $status->facebook }}</p>
                            <p><strong>Twitter:</strong> {{ $status->twitter }}</p>
                            <p><strong>Locale:</strong> {{ $status->locale }}</p>
                            <p><strong>Level:</strong> {{ $status->level }}</p>
                            <p><strong>Predominant Degree:</strong> {{ $status->predominant_degree }}</p>
                            <p><strong>Fields of Study:</strong> {{ $status->fields_of_study }}</p>
                            <p><strong>Status:</strong> {{ $status->status }}</p>
                            <p><strong>Photo:</strong> {{ $status->photo }}</p>

                            {{-- Display sports related to the status --}}
                            <p><strong>Sports:</strong>
                                @foreach ($status->sports as $sport)
                                   <span class="badge badge-success">
                                    {{ $sport->title }}
                                    </span> @if (!$loop->last), @endif
                                @endforeach
                            </p>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('searchcollege.index') }}" class="btn btn-primary">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
