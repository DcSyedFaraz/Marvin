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
                <h3>Search Results:</h3>
                <ul>
                    @foreach ($athletes as $athlete)
                        <li><a href="{{route('manage-players.show',$athlete->id)}}" title="show profile">{{ $athlete->name }}</a> - {{ $athlete->sport_name->title }}
                            <ul>

                                {{-- @dd($athlete->sport_name->fields) --}}
                                @foreach ($athlete->sport_name->fields as $names)
                                    <li>{{ $names->name }}</li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
                @else
                <p>No Record Found</p>
            @endif
        </div>
    </div>
@endsection
