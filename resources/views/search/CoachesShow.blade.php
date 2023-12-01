@extends('user.layouts.master')
@section('main-content')
    <div class="content-wrapper">
        <div class="container mt-5">
            <h2>Coach's Info</h2>


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
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Twitter</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($coach as $key => $coaches)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $coaches->name }}</td>
                                        <td>
                                           <a href="mailto:{{ $coaches->email }}">{{ $coaches->email }}</a>
                                        </td>
                                        <td>
                                            {{ $coaches->userdetail->cell_number ?? 'Not Found' }}
                                        </td>

                                        <td>
                                            <a href="{{ $coaches->userdetail->twitter ?? '#' }}">{{ $coaches->userdetail->twitter ?? 'Not Found' }}</a>


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
