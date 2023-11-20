@extends('coach.layouts.master')
@section('main-content')
    <div class="content-wrapper">
        <div class="container mt-5">
            <h2>Athlete Search</h2>
            <form action="{{ route('coach.search') }}" method="GET">
                <div class="form-group">
                    <label for="search">Name:</label>
                    <input type="text" name="name" id="" class="form-control">
                </div>
                <div class="form-group">
                    <label for="sports">Select Sports:</label>
                    <select class="form-control" id="sports" name="sports">
                        @foreach ($sport as $sports)
                            <option value="{{ $sports->id }}">
                                {{ $sports->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                {{-- <div class="form-group">
                    <label for="position">Select Position:</label>
                    <select class="form-control" id="position" name="position">
                        @foreach ($field as $fields)
                            <option value="{{ $fields->name }}">
                                {{ $fields->name }}
                            </option>
                        @endforeach
                    </select>
                </div> --}}
                <button type="submit" class="btn btn-primary">Search</button>
            </form>

            <!-- Display search results below this line -->
            @if (isset($athletes) && count($athletes) > 0)
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="example1" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th>Name</th>
                                    <th>Sport</th>
                                    <th>Fields</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($athletes as $key => $athlete)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $athlete->name }}</td>
                                        <td>{{$athlete->sport_name->title}}</td>
                                        <td>
                                            {{-- @dd($athlete->coachSports->sports) --}}
                                            @if (isset($athlete->sport_name->fields))

                                            @foreach ($athlete->sport_name->fields as $sport)
                                                {{-- @dd($sport->sports) --}}
                                                <span class="badge badge-success">
                                                    {{ $sport->name }}
                                                </span>
                                                @if (!$loop->last)
                                                    ,
                                                @endif
                                            @endforeach
                                            @endif

                                        </td>
                                        <td>
                                            @if ($athlete->status == 'active')
                                                <span class="badge badge-success">{{ $athlete->status }}</span>
                                            @else
                                                <span class="badge badge-warning">{{ $athlete->status }}</span>
                                            @endif
                                        </td>

                                        <td>
                                            <a href="{{ route('manage-players.show', $athlete->id) }}"
                                                class="btn btn-primary btn-sm "
                                                style="height:30px; width:32px;border-radius:50%" data-toggle="tooltip"
                                                title="show profile"><i class="fas fa-eye"></i></a>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- <ul>

                    @foreach ($athletes as $athlete)
                        <li><a href="{{route('manage-players.show',$athlete->id)}}" title="show profile">{{ $athlete->name }}</a> - {{ $athlete->sport_name->title }}
                            <ul>

                                @foreach ($athlete->sport_name->fields as $names)
                                    <li>{{ $names->name }}</li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul> --}}
            @else
                <p>No Record Found</p>
            @endif
        </div>
    </div>
@endsection
