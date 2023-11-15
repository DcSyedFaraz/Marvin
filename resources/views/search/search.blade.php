@extends('user.layouts.master')
@section('main-content')
    <div class="content-wrapper">
        <div class="container mt-5">
            <h2>College Search</h2>
            <form action="{{ route('searchcollege.search') }}" method="GET">
                <div class="row">

                    <div class="form-group col-5">
                        <label for="search">Name:</label>
                        <input type="text" name="name" id="" class="form-control" value="{{old('name')}}">
                    </div>
                    <div class="form-group col-5">
                        <label for="sports">Select Sports:</label>
                        <select class="form-control" id="sports" name="sports">
                            <option value="">Select sport</option>
                            @foreach ($sport as $sports)
                                <option value="{{ $sports->id }}">
                                    {{ $sports->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-4 col-2">

                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>

            </form>

            <!-- Display search results below this line -->
            @if (isset($college) && count($college) > 0)
                <h3>Search Results:</h3>
                <ul>
                    @foreach ($college as $colleges)
                        <li><a href="#" title="show profile">{{ $colleges->title }}</a>
                            <ul>

                                {{-- @dd($colleges->sports) --}}
                                @foreach ($colleges->sports as $names)
                                    <li>{{ $names->title }}</li>
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
