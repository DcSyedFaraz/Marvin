@extends('user.layouts.master')
@section('main-content')
    <div class="content-wrapper">
        <div class="container mt-5">
            <h2>Coach Search</h2>
            <form action="{{ route('searchCoach.search') }}" method="GET">
                <div class="row">

                    <div class="form-group col-10">
                        <label for="search">Name:</label>
                        <input type="text" name="name" id="" class="form-control" value="{{ old('name') }}">
                    </div>
                    {{-- <div class="form-group col-5">
                        <label for="sports">Select Sports:</label>
                        <select class="form-control" id="sports" name="sports">
                            <option value="">Select sport</option>
                            @foreach ($sport as $sports)
                                <option value="{{ $sports->id }}">
                                    {{ $sports->title }}
                                </option>
                            @endforeach
                        </select>
                    </div> --}}
                    <div class="mt-4 col-2">

                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>

            </form>

            <!-- Display search results below this line -->
            @if (isset($coach) && count($coach) > 0)
                {{-- <h3>Search Results:</h3> --}}
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="example1" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th>Name</th>
                                    <th>Sports</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($coach as $key => $coaches)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $coaches->name }}</td>
                                        <td>
                                            {{-- @dd($coaches->coachSports->sports) --}}
                                            @foreach ($coaches->coachSports as $sport)
                                                {{-- @dd($sport->sports) --}}
                                                <span class="badge badge-success">
                                                    {{ $sport->sports->title }}
                                                </span>
                                                @if (!$loop->last)
                                                    ,
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @if ($coaches->status == 'active')
                                                <span class="badge badge-success">{{ $coaches->status }}</span>
                                            @else
                                                <span class="badge badge-warning">{{ $coaches->status }}</span>
                                            @endif
                                        </td>

                                        <td>
                                            <a href="{{ route('searchCoach.show', $coaches->id) }}"
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
            @else
                <p>No Record Found</p>
            @endif
        </div>
    </div>
@endsection
